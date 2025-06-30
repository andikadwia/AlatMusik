<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ulasan;
use App\Models\Product;
use App\Models\Pemesanan; // Tambahkan ini untuk validasi pemesanan

class UlasanController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pemesanan' => [
                'required',
                'exists:pemesanan,id',
                // Pastikan pemesanan milik user yang login
                function ($attribute, $value, $fail) {
                    if (!Pemesanan::where('id', $value)
                        ->where('id_pengguna', Auth::id())
                        ->exists()) {
                        $fail('Pemesanan tidak valid.');
                    }
                },
                // Pastikan produk ada di pemesanan
                function ($attribute, $value, $fail) use ($request) {
                    if (!Pemesanan::find($value)
                        ->items()
                        ->where('id_produk', $request->id_produk)
                        ->exists()) {
                        $fail('Produk tidak ditemukan dalam pemesanan.');
                    }
                }
            ],
            'id_produk' => 'required|exists:produk,id',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:500', // Batas karakter
        ]);

        // Cek apakah user sudah pernah memberikan ulasan untuk produk ini di pemesanan ini
        $existingReview = Ulasan::where([
            'id_pengguna' => Auth::id(),
            'id_pemesanan' => $validated['id_pemesanan'],
            'id_produk' => $validated['id_produk'],
        ])->first();

        $ulasan = Ulasan::updateOrCreate(
            [
                'id_pengguna' => Auth::id(),
                'id_pemesanan' => $validated['id_pemesanan'],
                'id_produk' => $validated['id_produk'],
            ],
            [
                'rating' => $validated['rating'],
                'komentar' => $validated['komentar'],
                'verified_purchase' => true, // Tambahkan field verifikasi
            ]
        );

        // Update rating produk (gunakan DB query untuk efisiensi)
        $this->updateProductRating($validated['id_produk']);

        return back()->with('success', 'Ulasan berhasil dikirim.');
    }

    protected function updateProductRating($productId)
    {
        Product::where('id', $productId)
            ->update([
                'rating_rata' => Ulasan::where('id_produk', $productId)->avg('rating'),
                'total_ulasan' => Ulasan::where('id_produk', $productId)->count(),
            ]);
    }
}