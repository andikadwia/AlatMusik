<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_pemesanan' => 'required|exists:pemesanan,id',
            'id_produk' => 'required|exists:produk,id',
            'rating' => 'required|integer|between:1,5',
            'komentar' => 'required|string|max:500'
        ]);

        // Verifikasi pemesanan milik user yang login
        $pemesanan = Pemesanan::where('id', $request->id_pemesanan)
            ->where('id_pengguna', Auth::id())
            ->firstOrFail();

        // Cek apakah sudah ada ulasan
        if (Ulasan::where('id_pemesanan', $request->id_pemesanan)
            ->where('id_pengguna', Auth::id())
            ->exists()) {
            return back()->with('error', 'Anda sudah memberikan ulasan untuk pemesanan ini');
        }

        // Buat ulasan baru
        Ulasan::create([
            'id_pemesanan' => $request->id_pemesanan,
            'id_pengguna' => Auth::id(),
            'id_produk' => $request->id_produk,
            'rating' => $request->rating,
            'komentar' => $request->komentar
        ]);

        return back()->with('success', 'Ulasan berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'komentar' => 'required|string|max:500'
        ]);

        $ulasan = Ulasan::where('id', $id)
            ->where('id_pengguna', Auth::id())
            ->firstOrFail();

        // Cek apakah masih bisa diedit
        if (!$ulasan->bisa_edit) {
            return back()->with('error', 'Ulasan tidak dapat diubah lagi');
        }

        $ulasan->update([
            'rating' => $request->rating,
            'komentar' => $request->komentar,
            'bisa_edit' => $request->bisa_edit,
            'diedit_pada' => now()
        ]);

        return back()->with('success', 'Ulasan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $ulasan = Ulasan::where('id', $id)
            ->where('id_pengguna', Auth::id())
            ->firstOrFail();

        $ulasan->delete();

        return back()->with('success', 'Ulasan berhasil dihapus');
    }
}