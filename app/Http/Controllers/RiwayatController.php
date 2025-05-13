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
                'rent_date' => '15 Jan 2023',
                'return_date' => '20 Jan 2023',
                'duration' => '5 hari',
                'status' => 'Selesai',
                'total_price' => 'Rp 1.000.000',
                'payment_method' => 'Transfer Bank',
                'order_time' => '14 Jan 2023 10:30'
            ],
            [
                'id' => 2,
                'instrument_name' => 'Gitar Elektrik',
                'image' => 'gitar.jpg',
                'rent_date' => '1 Feb 2023',
                'return_date' => '5 Feb 2023',
                'duration' => '4 hari',
                'status' => 'Menunggu Pembayaran',
                'total_price' => 'Rp 800.000',
                'payment_method' => 'Pembayaran Langsung',
                'order_time' => '30 Jan 2023 14:15'
            ]
        ];
    }
}