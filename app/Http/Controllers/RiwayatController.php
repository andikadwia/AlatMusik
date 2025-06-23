<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Models\Pemesanan;

class RiwayatController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pemesanans = Pemesanan::with(['items.produk'])
            ->where('id_pengguna', $user->id)
            ->orderBy('tanggal_pemesanan', 'desc')
            ->get();
        
        return view('profile.riwayat', [
            'user' => $user,
            'pemesanans' => $pemesanans
        ]);
    }

    public function invoice($id)
    {
        $pemesanan = Pemesanan::with(['items.produk', 'user'])->findOrFail($id);
        
        $pdf = Pdf::loadView('components.invoice', [
            'pemesanan' => $pemesanan
        ]);
        
        // Untuk tampilkan di browser:
        // return $pdf->stream('invoice.pdf');
        
        // Untuk download otomatis:
        return $pdf->download('invoice-'.$id.'.pdf');
    }
}