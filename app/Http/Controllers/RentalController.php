<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Pelanggan;
use App\Models\Return;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RentalController extends Controller
{
    public function index()
    {
        // Get approved rentals that haven't been returned
        $rentals = Order::with(['pengguna', 'user'])
            ->where('status', 'disetujui')
            ->where('status_peminjaman', '!=', 'sudah_dikembalikan')
            ->orderBy('tanggal_pemesanan', 'desc')
            ->get()
            ->map(function ($rental) {
                if ($rental->user) {
                    $rental->nama_pelanggan = $rental->user->name;
                } else {
                    $rental->nama_pelanggan = 'Pelanggan Tidak Diketahui';
                }
                return $rental;
            });
    
        return view('pages.dashboard.rental.index', compact('rentals'));
    }
    
    public function updateStatusRental(Request $request)
    {
        $request->validate([
            'id_pemesanan' => 'required|exists:pemesanan,id',
            'status_peminjaman' => 'required|in:belum_dipinjam,sedang_dipinjam'
        ]);
    
        try {
            $rental = Order::where('id', $request->id_pemesanan)
                ->where('status', 'disetujui')
                ->firstOrFail();
    
            $rental->update(['status_peminjaman' => $request->status_peminjaman]);
    
            return redirect()->route('dashboard.peminjaman.index')->with('success', 'Status peminjaman berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.peminjaman.index')->with('error', 'Gagal memperbarui status: ' . $e->getMessage());
        }
    }
}