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
            'denda' => 'required|numeric|min:0',
            'catatan' => 'nullable|string|max:255'
        ]);

        DB::beginTransaction();

        try {
            // Update status pemesanan terlebih dahulu
            $pemesanan = Pemesanan::findOrFail($request->id_pemesanan);
            $pemesanan->status_penyewaan = 'sudah_dikembalikan';
            $pemesanan->diperbarui_pada = now();
            $pemesanan->save();

            // Buat record pengembalian
            $pengembalian = new Pengembalian([
                'id_pemesanan' => $request->id_pemesanan,
                'tanggal_pengembalian' => now(),
                'kondisi' => $request->kondisi,
                'catatan' => $request->catatan,
                'denda' => $request->denda,
                'dibuat_pada' => now()
            ]);
            $pengembalian->save();

            // Kembalikan stok jika kondisi baik
            if (in_array($request->kondisi, ['sangat_baik', 'baik'])) {
                $items = ItemPemesanan::where('id_pemesanan', $request->id_pemesanan)->get();
                foreach ($items as $item) {
                    DB::table('produk')
                        ->where('id', $item->id_produk)
                        ->increment('stok', $item->jumlah);
                }
            }

            DB::commit();

            return redirect()
                ->route('dashboard.return.index')
                ->with('success', 'Pengembalian berhasil diproses! Status penyewaan telah diupdate.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', 'Gagal memproses pengembalian: '.$e->getMessage());
        }
    }
}