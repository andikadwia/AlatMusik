<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UlasanDisplayController extends Controller
{
    public function index()
    {
        // Ambil ulasan beserta relasi pengguna
        $ulasan = Ulasan::with('pengguna')
            ->latest('dibuat_pada')
            ->get();

        // Bentuk ulang untuk komponen <x-ulasan-card>
        $reviews = $ulasan->map(function ($u) {
            return [
                'name' => $u->pengguna->name ?? 'Anonim',
                'image' => $u->pengguna->foto_profil
                    ? asset($u->pengguna->foto_profil)
                    : asset('images/gitar.jpg'),
                'rating' => $u->rating,
                'content' => $u->komentar,
            ];
        });

        return view('ulasan.index', compact('reviews'));
    }
}
