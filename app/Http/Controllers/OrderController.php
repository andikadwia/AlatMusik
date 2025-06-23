<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\VerifikasiPembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $pemesanan = DB::table('pemesanan as p')
            ->join('pengguna as u', 'p.id_pengguna', '=', 'u.id')
            ->leftJoin('verifikasi_pembayaran as vp', 'p.id', '=', 'vp.id_pemesanan')
            ->select('p.*', 'u.username as nama_pelanggan', 'u.telepon', 'vp.status_verifikasi')
            ->orderByDesc('p.tanggal_pemesanan')
            ->get();

        foreach ($pemesanan as $p) {
            $p->detail = DB::table('item_pemesanan as ip')
                ->join('produk as pr', 'ip.id_produk', '=', 'pr.id')
                ->select('ip.*', 'pr.nama as nama_produk', 'pr.path_gambar')
                ->where('ip.id_pemesanan', $p->id)
                ->get();
            
            // Tambahkan verifikasi pembayaran ke object
            $p->verifikasiPembayaran = DB::table('verifikasi_pembayaran')
                ->where('id_pemesanan', $p->id)
                ->first();
        }

        return view('pages.dashboard.order.index', compact('pemesanan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_verifikasi' => 'required|in:menunggu,diterima,ditolak'
        ]);

        // Update status verifikasi pembayaran
        DB::table('verifikasi_pembayaran')
            ->where('id_pemesanan', $id)
            ->update(['status_verifikasi' => $request->status_verifikasi]);

        return back()->with('success', 'Status verifikasi berhasil diperbarui');
    }
}