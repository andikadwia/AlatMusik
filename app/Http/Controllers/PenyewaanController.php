<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Product;
use App\Models\ItemPemesanan;
use App\Models\VerifikasiPembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PenyewaanController extends Controller
{
    // Menampilkan form checkout
    public function showCheckoutForm(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:produk,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date'
        ]);

        $product = Product::findOrFail($request->product_id);
        
        // Cek ketersediaan produk
        if ($product->stok < 1) {
            return redirect()->back()
                ->with('error', 'Maaf, produk ini sedang tidak tersedia untuk disewa.');
        }

        // Cek ketersediaan tanggal
        $isAvailable = $this->checkProductAvailability(
            $product->id,
            $request->start_date,
            $request->end_date
        );

        if (!$isAvailable) {
            return redirect()->back()
                ->with('error', 'Produk tidak tersedia pada tanggal yang dipilih. Silakan pilih tanggal lain.');
        }

        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $duration = $this->calculateDuration($start_date, $end_date);
        $total_price = $this->calculateTotalPrice($product->harga, $start_date, $end_date);

        return view('penyewaan.checkout', compact(
            'product', 
            'start_date',
            'end_date',
            'duration',
            'total_price'
        ));
    }

    // Proses penyewaan
    public function processPenyewaan(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:produk,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_jaminan' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'jenis_jaminan' => 'required|string|in:ktp,sim,kartu_pelajar,lainnya'
        ]);

        DB::beginTransaction();

        try {
            $user = Auth::user();
            $product = Product::findOrFail($request->product_id);
            
            // Hitung durasi dan total harga
            $startDate = Carbon::parse($request->start_date);
            $endDate = Carbon::parse($request->end_date);
            $duration = $endDate->diffInDays($startDate) + 1;
            $totalPrice = $product->harga * $duration;

            // Simpan file
            $buktiPath = $request->file('bukti_pembayaran')->store('pembayaran', 'public');
            $jaminanPath = $request->file('foto_jaminan')->store('jaminan', 'public');

            // Buat pemesanan
            $pemesanan = Pemesanan::create([
                'id_pengguna' => $user->id,
                'tanggal_pemesanan' => now(),
                'total_harga' => $totalPrice,
                'tanggal_mulai' => $startDate,
                'tanggal_selesai' => $endDate,
                'status' => 'menunggu'
            ]);

            // Buat item pemesanan
            ItemPemesanan::create([
                'id_pemesanan' => $pemesanan->id,
                'id_produk' => $product->id,
                'jumlah' => 1,
                'hari_sewa' => $duration,
                'harga_per_hari' => $product->harga,
                'path_gambar' => $product->path_gambar
            ]);

            // Buat verifikasi pembayaran
            VerifikasiPembayaran::create([
                'id_pemesanan' => $pemesanan->id,
                'bukti_pembayaran' => $buktiPath,
                'bukti_jaminan' => $jaminanPath,
                'status_verifikasi' => 'menunggu',
                'tanggal_pembayaran' => now()
            ]);

            // Kurangi stok produk
            $product->decrement('stok');

            DB::commit();

            return redirect()->route('home')
                   ->with('success', 'Pembayaran berhasil dikonfirmasi! Pemesanan Anda sedang diproses.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            // Hapus file jika ada error
            if (isset($buktiPath)) {
                Storage::disk('public')->delete($buktiPath);
            }
            if (isset($jaminanPath)) {
                Storage::disk('public')->delete($jaminanPath);
            }

            return back()->withInput()
                ->with('error', 'Gagal membuat pemesanan: '.$e->getMessage());
        }
    }

    // Riwayat penyewaan
    public function riwayatPenyewaan()
    {
        $pemesanans = Pemesanan::with(['items', 'items.produk', 'verifikasiPembayaran'])
                        ->where('id_pengguna', Auth::id())
                        ->orderBy('tanggal_pemesanan', 'desc')
                        ->paginate(10);

        return view('penyewaan.history', compact('pemesanans'));
    }

    // Detail penyewaan
    public function detailPenyewaan($pemesanan_id)
    {
        $pemesanan = Pemesanan::with(['items', 'items.produk', 'verifikasiPembayaran', 'user'])
                      ->where('id', $pemesanan_id)
                      ->where('id_pengguna', Auth::id())
                      ->firstOrFail();

        return view('penyewaan.detail', compact('pemesanan'));
    }

    // Approve penyewaan (untuk admin)
    public function approveRental($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        
        if ($pemesanan->status !== 'menunggu') {
            return redirect()->back()
                ->with('error', 'Pemesanan ini sudah diproses sebelumnya.');
        }

        $pemesanan->update([
            'status' => 'disetujui',
            'tanggal_pembayaran' => now()
        ]);

        return redirect()->back()
            ->with('success', 'Pemesanan berhasil disetujui.');
    }

    // Reject penyewaan (untuk admin)
    public function rejectRental(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required|string|max:500'
        ]);

        $pemesanan = Pemesanan::findOrFail($id);
        
        if ($pemesanan->status !== 'menunggu') {
            return redirect()->back()
                ->with('error', 'Pemesanan ini sudah diproses sebelumnya.');
        }

        DB::transaction(function () use ($pemesanan, $request) {
            // Update status pemesanan
            $pemesanan->update([
                'status' => 'ditolak',
                'catatan' => $request->catatan
            ]);

            // Kembalikan stok produk
            foreach ($pemesanan->items as $item) {
                Product::where('id', $item->id_produk)
                    ->increment('stok', $item->jumlah);
            }
        });

        return redirect()->back()
            ->with('success', 'Pemesanan berhasil ditolak dan stok produk dikembalikan.');
    }

    // Fungsi bantuan
    private function checkProductAvailability($productId, $startDate, $endDate)
    {
        $conflictingOrders = Pemesanan::whereHas('items', function($query) use ($productId) {
                $query->where('id_produk', $productId);
            })
            ->where(function($query) use ($startDate, $endDate) {
                $query->whereBetween('tanggal_mulai', [$startDate, $endDate])
                    ->orWhereBetween('tanggal_selesai', [$startDate, $endDate])
                    ->orWhere(function($query) use ($startDate, $endDate) {
                        $query->where('tanggal_mulai', '<=', $startDate)
                            ->where('tanggal_selesai', '>=', $endDate);
                    });
            })
            ->where('status', 'disetujui')
            ->count();

        return $conflictingOrders === 0;
    }

    private function calculateDuration($startDate, $endDate)
    {
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);
        return $start->diffInDays($end) + 1;
    }

    private function calculateTotalPrice($pricePerDay, $startDate, $endDate)
    {
        $duration = $this->calculateDuration($startDate, $endDate);
        return $pricePerDay * $duration;
    }
}