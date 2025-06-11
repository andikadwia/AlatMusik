<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    /**
     * Menampilkan halaman riwayat sewa (tampilan saja)
     */
    public function index()
    {
        // Data dummy untuk ditampilkan
        $user = Auth::user();
        
        return view('profile.riwayat', [
            'user' => $user,
            'rentals' => $this->dummyRentalData()
        ]);
    }

    /**
     * Data dummy riwayat sewa
     */
    private function dummyRentalData()
    {
        return [
            [
                'id' => 1,
                'instrument_name' => 'Gitar Akustik',
                'image' => 'gitar.jpg',
                'rent_date' => '13 mei 2025',
                'return_date' => '14 mei 2025',
                'duration' => '2 hari',
                'status' => 'Selesai',
                'total_price' => 'Rp 200.000',
                'payment_method' => 'Transfer Bank',
                'order_time' => '13 mei 2025 10:30'
            ],
            [
                'id' => 2,
                'instrument_name' => 'Gitar Elektrik',
                'image' => 'gitar.jpg',
                'rent_date' => '10 januari 2025',
                'return_date' => '12 Feb 2025',
                'duration' => '3 hari',
                'status' => 'Menunggu Pembayaran',
                'total_price' => 'Rp 300.000',
                'payment_method' => 'Pembayaran Langsung',
                'order_time' => '10 Jan 2025 14:15'
            ]
        ];
    }
}