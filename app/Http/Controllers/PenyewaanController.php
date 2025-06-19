<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Pemesanan;
use App\Models\ItemPemesanan;
use App\Models\Pengembalian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PenyewaanController extends Controller
{
    // Show rental checkout form
    public function showCheckoutForm(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:produk,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date'
        ]);

        $product = Product::findOrFail($request->product_id);
        
        // Check product availability
        if ($product->stok < 1) {
            return redirect()->back()
                ->with('error', 'Maaf, produk ini sedang tidak tersedia untuk disewa.');
        }

        // Check date availability
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

    public function processPenyewaan(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'product_id' => 'required|exists:produk,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_jaminan' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'jenis_jaminan' => 'required|string|in:ktp,sim,kartu_pelajar,lainnya',
            'metode_pembayaran' => 'required|string|in:transfer,bca,bri,bni,madiri',
            'catatan' => 'nullable|string|max:500'
        ]);

        // Mulai transaction
        DB::beginTransaction();

        try {
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
                'id_pengguna' => Auth::id(),
                'tanggal_pemesanan' => now(),
                'total_harga' => $totalPrice,
                'metode_pembayaran' => $request->metode_pembayaran,
                'bukti_pembayaran' => $buktiPath,
                'foto_jaminan' => $jaminanPath,
                'jenis_jaminan' => $request->jenis_jaminan,
                'tanggal_pembayaran' => now(),
                'tanggal_mulai' => $startDate,
                'tanggal_selesai' => $endDate,
                'status' => 'menunggu',
                'catatan' => $request->catatan
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

            // Kurangi stok
            $product->decrement('stok');

            DB::commit();

            return redirect()->route('penyewaan.success', $pemesanan->id)
                   ->with('success', 'Pemesanan berhasil dibuat!');

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

    // Tampilan sukses
    public function showSuccess($pemesanan_id)
    {
        $pemesanan = Pemesanan::with(['items', 'items.produk'])
                    ->where('id', $pemesanan_id)
                    ->where('id_pengguna', Auth::id())
                    ->firstOrFail();

        return view('penyewaan.success', compact('pemesanan'));
    }

    // Proses pengembalian alat
    public function processPengembalian(Request $request, $pemesanan_id)
    {
        $request->validate([
            'kondisi' => 'required|in:sangat_baik,baik,rusak,hilang',
            'catatan' => 'nullable|string|max:500',
            'foto_kondisi' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        DB::beginTransaction();

        try {
            $pemesanan = Pemesanan::findOrFail($pemesanan_id);
            
            // Simpan foto kondisi
            $fotoPath = $request->file('foto_kondisi')->store('pengembalian', 'public');

            // Hitung denda jika ada
            $denda = 0;
            $kondisi = $request->kondisi;
            
            if ($kondisi === 'rusak') {
                $denda = $pemesanan->total_harga * 0.5; // Denda 50% dari total harga
            } elseif ($kondisi === 'hilang') {
                $denda = $pemesanan->total_harga * 2; // Denda 2x total harga
            }

            // Buat record pengembalian
            $pengembalian = Pengembalian::create([
                'id_pemesanan' => $pemesanan->id,
                'tanggal_pengembalian' => now(),
                'kondisi' => $kondisi,
                'catatan' => $request->catatan,
                'denda' => $denda,
                'foto_kondisi' => $fotoPath
            ]);

            // Update status pemesanan
            $pemesanan->update([
                'status' => 'selesai',
                'denda' => $denda
            ]);

            // Kembalikan stok produk jika tidak hilang
            if ($kondisi !== 'hilang') {
                foreach ($pemesanan->items as $item) {
                    $item->produk->increment('stok', $item->jumlah);
                }
            }

            DB::commit();

            return redirect()->route('penyewaan.history')
                   ->with('success', 'Pengembalian berhasil dicatat!');

        } catch (\Exception $e) {
            DB::rollBack();
            
            if (isset($fotoPath)) {
                Storage::disk('public')->delete($fotoPath);
            }

            return back()->with('error', 'Gagal memproses pengembalian: '.$e->getMessage());
        }
    }

    // Riwayat penyewaan
    public function riwayatPenyewaan()
    {
        $pemesanans = Pemesanan::with(['items', 'items.produk', 'pengembalian'])
                        ->where('id_pengguna', Auth::id())
                        ->orderBy('tanggal_pemesanan', 'desc')
                        ->paginate(10);

        return view('penyewaan.history', compact('pemesanans'));
    }

    // Detail penyewaan
    public function detailPenyewaan($pemesanan_id)
    {
        $pemesanan = Pemesanan::with(['items', 'items.produk', 'pengembalian'])
                      ->where('id', $pemesanan_id)
                      ->where('id_pengguna', Auth::id())
                      ->firstOrFail();

        return view('penyewaan.detail', compact('pemesanan'));
    }

    private function checkProductAvailability($productId, $startDate, $endDate)
    {
        $conflictingOrders = Pemesanan::whereHas('itemPemesanan', function($query) use ($productId) {
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
            ->where('status', 'disetujui') // Only check approved orders now
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
            // Update order status
            $pemesanan->update([
                'status' => 'ditolak',
                'catatan' => $request->catatan
            ]);

            // Return product stock
            foreach ($pemesanan->itemPemesanan as $item) {
                Product::where('id', $item->id_produk)
                    ->increment('stok', $item->jumlah);
            }
        });

        return redirect()->back()
            ->with('success', 'Pemesanan berhasil ditolak dan stok produk dikembalikan.');
    }


}