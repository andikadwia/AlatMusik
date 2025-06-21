<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Pelanggan;
use App\Models\AlatMusik;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController; // Tambahkan ini

class DashboardController extends BaseController // Extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
                // Total produk (alat musik)
        $totalProduk = Product::count();
        
        // Total pelanggan
        $totalPelanggan = Pelanggan::count();
        
        // Total pemesanan
        $totalPemesanan = order::count();
        
        // Peminjam aktif (pemesanan dengan status sedang_dipinjam)
        $peminjamAktif = order::where('status_penyewaan', 'sedang_dipinjam')->count();
        
        // Total pengembalian
        $totalPengembalian = Pengembalian::count();
        
        // Total pendapatan (jumlah total_harga dari semua pemesanan yang disetujui)
        $totalPendapatan = Order::whereHas('verifikasiPembayaran', function($query) {
            $query->where('status_verifikasi', 'diterima');
        })->sum('total_harga');
        
        return view('pages.dashboard.index', compact(
            'totalProduk',
            'totalPelanggan',
            'totalPemesanan',
            'peminjamAktif',
            'totalPengembalian',
            'totalPendapatan'
        ));

        return view('pages.dashboard.index');
    }
}