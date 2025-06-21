<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Pengembalian;
use App\Models\ItemPemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReturnController extends Controller
{
    public function index()
    {
        $returns = Pengembalian::with([
            'pemesanan.user', 
            'pemesanan.items.produk'
        ])
        ->orderBy('tanggal_pengembalian', 'desc')
        ->get()
        ->map(function ($return) {
            // Prioritize user name from users table, fallback to pengguna
            if ($return->pemesanan->user) {
                $return->nama_pelanggan = $return->pemesanan->user->name;
                $return->tanggal_pemesanan = $return->pemesanan->tanggal_pemesanan;
            } else {
                $return->nama_pelanggan = 'Pelanggan Tidak Diketahui';
            }
            return $return;
        });

        return view('pages.dashboard.return.index', compact('returns'));
    }

    public function processReturn(Request $request)
    {
        $request->validate([
            'id_pemesanan' => 'required|exists:pemesanan,id',
            'kondisi' => 'required|in:sangat_baik,baik,rusak,hilang',
            'denda' => 'nullable|numeric|min:0',
            'catatan' => 'nullable|string'
        ]);

        try {
            DB::transaction(function () use ($request) {
                // Create return record
                $return = Pengembalian::create([
                    'id_pemesanan' => $request->id_pemesanan,
                    'tanggal_pengembalian' => now(), 
                    'kondisi' => $request->kondisi,
                    'catatan' => $request->catatan,
                    'denda' => $request->denda,
                    'dibuat_pada' => now()
                ]);

                // Update rental status
                $rental = Pemesanan::findOrFail($request->id_pemesanan);
                $rental->update(['status_penyewaan' => 'sudah_dikembalikan']);

                // Restore stock if condition is good
                if (in_array($request->kondisi, ['sangat_baik', 'baik'])) {
                    foreach ($rental->items as $item) {
                        $item->produk->increment('stok', $item->jumlah);
                    }
                }
            });

            return redirect()->route('dashboard.return.index')->with('success', 'Pengembalian berhasil dicatat!');
        }  catch (\Exception $e) {
        DB::rollBack();
        return back()->withInput()
               ->with('error', 'Gagal memproses pengembalian: ' . $e->getMessage());
        }
    }
}