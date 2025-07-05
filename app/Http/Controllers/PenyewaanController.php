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
    /**
     * Menampilkan form checkout penyewaan
     */
    public function showCheckoutForm(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:produk,id',
        'quantity' => 'required|integer|min:1',
        'start_date' => 'required|date|after_or_equal:today',
        'end_date' => 'required|date|after_or_equal:start_date'
    ]);

    $product = Product::findOrFail($request->product_id);
    
    // Cek ketersediaan stok produk
    if ($product->stok < $request->quantity) {
        return redirect()->back()
            ->with('error', 'Maaf, stok produk tidak mencukupi.');
    }

    // Cek ketersediaan tanggal dengan quantity
    if (!$this->checkProductAvailability($product->id, $request->start_date, $request->end_date, $request->quantity)) {
        return redirect()->back()
            ->with('error', 'Produk tidak tersedia pada tanggal yang dipilih. Silakan pilih tanggal lain.');
    }

    // Hitung durasi dan total harga
    $startDate = Carbon::parse($request->start_date)->startOfDay();
    $endDate = Carbon::parse($request->end_date)->startOfDay();
    $duration = $this->calculateDuration($startDate, $endDate);
    $totalPrice = $this->calculateTotalPrice($product->harga, $duration, $request->quantity);

    return view('penyewaan.checkout', [
        'product' => $product,
        'quantity' => $request->quantity,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'duration' => $duration,
        'total_price' => $totalPrice
    ]);
}
    /**
     * Memproses penyewaan produk
     */
    public function processPenyewaan(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:produk,id',
            'quantity' => 'required|integer|min:1',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_jaminan' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'jenis_jaminan' => 'required|string|in:ktp,sim,kartu_pelajar,lainnya'
        ]);

        DB::beginTransaction();

        try {
            $user = Auth::user();
            $product = Product::findOrFail($request->product_id);
            
            // Validasi stok produk dengan quantity
            if ($product->stok < $request->quantity) {
                throw new \Exception('Produk tidak tersedia. Stok tidak mencukupi.');
            }

            // Validasi ketersediaan tanggal dengan quantity
            if (!$this->checkProductAvailability($product->id, $request->start_date, $request->end_date, $request->quantity)) {
                throw new \Exception('Produk tidak tersedia pada tanggal yang dipilih.');
            }

            // Hitung durasi dan total harga
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate = Carbon::parse($request->end_date)->startOfDay();
            $duration = $this->calculateDuration($startDate, $endDate);
            $totalPrice = $this->calculateTotalPrice($product->harga, $duration, $request->quantity);

                        // Pastikan folder pembayaran dan jaminan ada
            if (!file_exists(public_path('pembayaran'))) {
                mkdir(public_path('pembayaran'), 0755, true);
            }
            if (!file_exists(public_path('jaminan'))) {
                mkdir(public_path('jaminan'), 0755, true);
            }

            // Simpan bukti pembayaran
            $buktiPembayaran = $request->file('bukti_pembayaran');
            $buktiName = time().'_'.$buktiPembayaran->getClientOriginalName();
            $buktiPembayaran->move(public_path('pembayaran'), $buktiName);
            $buktiPath = 'pembayaran/'.$buktiName;

                        // Simpan foto jaminan
            $fotoJaminan = $request->file('foto_jaminan');
            $jaminanName = time().'_'.$fotoJaminan->getClientOriginalName();
            $fotoJaminan->move(public_path('jaminan'), $jaminanName);
            $jaminanPath = 'jaminan/'.$jaminanName;

            // Verifikasi penyimpanan file
            if (!file_exists(public_path($buktiPath))) {
                throw new \Exception("Gagal menyimpan bukti pembayaran");
            }
            if (!file_exists(public_path($jaminanPath))) {
                throw new \Exception("Gagal menyimpan foto jaminan");
            }

            // Buat pemesanan
            $pemesanan = Pemesanan::create([
                'id_pengguna' => $user->id,
                'tanggal_pemesanan' => now(),
                'total_harga' => $totalPrice,
                'tanggal_mulai' => $startDate,
                'tanggal_selesai' => $endDate,
                'status_penyewaan' => 'belum_dipinjam'
            ]);

            // Buat item pemesanan
            ItemPemesanan::create([
                'id_pemesanan' => $pemesanan->id,
                'id_produk' => $product->id,
                'jumlah' => $request->quantity,
                'hari_sewa' => $duration,
                'harga_per_hari' => $product->harga,
                'path_gambar' => $product->path_gambar
            ]);

            // Buat verifikasi pembayaran
            VerifikasiPembayaran::create([
                'id_pemesanan' => $pemesanan->id,
                'bukti_pembayaran' => $buktiPath,
                'bukti_jaminan' => $jaminanPath,
                'jenis_jaminan' => $request->jenis_jaminan,
                'status_verifikasi' => 'menunggu',
                'tanggal_pembayaran' => now()
            ]);

            // Kurangi stok produk
            $product->decrement('stok', $request->quantity);

            DB::commit();

            return redirect()->route('riwayat')
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

    // ... [fungsi lainnya tetap sama seperti sebelumnya] ...

    /**
     * Fungsi bantuan: Cek ketersediaan produk dengan quantity
     */
    private function checkProductAvailability($productId, $startDate, $endDate, $quantity)
{
    $start = Carbon::parse($startDate)->startOfDay();
    $end = Carbon::parse($endDate)->startOfDay();
    
    // Hitung jumlah produk yang sudah dipesan
    $bookedQuantity = ItemPemesanan::where('id_produk', $productId)
        ->whereHas('pemesanan', function($query) use ($start, $end) {
            $query->where(function($q) use ($start, $end) {
                $q->where('tanggal_mulai', '<=', $end)
                  ->where('tanggal_selesai', '>=', $start);
            })
            ->whereHas('verifikasiPembayaran', function($q) {
                $q->where('status_verifikasi', 'diterima');
            })
            ->whereIn('status_penyewaan', ['belum_dipinjam', 'sedang_dipinjam']);
        })
        ->sum('jumlah');
    
    // Dapatkan stok produk
    $product = Product::find($productId);
    
    if (!$product) {
        return false;
    }
    
    return ($product->stok - $bookedQuantity) >= $quantity;
}

    /**
     * Fungsi bantuan: Hitung durasi sewa (24 jam = 1 hari)
     */
    private function calculateDuration($startDate, $endDate)
    {
        $start = Carbon::parse($startDate)->startOfDay();
        $end = Carbon::parse($endDate)->startOfDay();
        
        if ($end->lt($start)) {
            throw new \InvalidArgumentException('Tanggal selesai tidak boleh sebelum tanggal mulai');
        }
        
        // Hitung selisih hari
        $diffDays = $start->diffInDays($end);
        
        // Minimal 1 hari
        return $diffDays == 0 ? 1 : $diffDays;
    }

    /**
     * Fungsi bantuan: Hitung total harga sewa
     */
    private function calculateTotalPrice($pricePerDay, $duration, $quantity = 1)
    {
        return $pricePerDay * $duration * $quantity;
    }
}