<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $pemesanan = DB::table('pemesanan as p')
            ->join('users as u', 'p.id_pengguna', '=', 'u.id')
            ->select('p.*', 'u.username as nama_pelanggan', 'u.telepon')
            ->orderByDesc('p.tanggal_pemesanan')
            ->get();

        foreach ($pemesanan as $p) {
            $p->detail = DB::table('item_pemesanan as ip')
                ->join('produk as pr', 'ip.id_produk', '=', 'pr.id')
                ->select('ip.*', 'pr.nama as nama_produk', 'pr.path_gambar')
                ->where('ip.id_pemesanan', $p->id)
                ->get();
        }
        return view('pages.dashboard.order.index', compact('pemesanan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,disetujui,ditolak'
        ]);

        $pemesanan = Order::findOrFail($id);
        $pemesanan->status = $request->status;
        $pemesanan->save();

        return back()->with('success', 'Status pemesanan berhasil diperbarui');
    }
}
