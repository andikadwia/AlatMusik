<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ulasan;
use App\Models\Product;

class UlasanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_pemesanan' => 'required|exists:pemesanan,id',
            'id_produk' => 'required|exists:produk,id',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string',
        ]);

        $ulasan = Ulasan::updateOrCreate(
            [
                'id_pengguna' => Auth::id(),
                'id_pemesanan' => $request->id_pemesanan,
                'id_produk' => $request->id_produk,
            ],
            [
                'rating' => $request->rating,
                'komentar' => $request->komentar,
            ]
        );

        $produk = Product::find($request->id_produk);
        $produk->rating_rata = Ulasan::where('id_produk', $produk->id)->avg('rating');
        $produk->total_ulasan = Ulasan::where('id_produk', $produk->id)->count();
        $produk->save();

        return back()->with('success', 'Ulasan berhasil dikirim.');
    }
}