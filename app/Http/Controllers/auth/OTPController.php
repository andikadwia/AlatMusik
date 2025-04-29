<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OTPController extends Controller
{
    public function showVerifyForm()
    {
        return view('auth.verify-otp');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'kodeotp' => 'required|numeric|digits:6'
        ]);

        $userId = Auth::id();
        $storedOtp = Cache::get('otp_'.$userId);

        if (!$storedOtp || $storedOtp != $request->kodeotp) {
            return back()->withErrors([
                'kodeotp' => 'Kode OTP tidak valid atau telah kadaluarsa'
            ]);
        }

        // OTP valid
        Cache::forget('otp_'.$userId);
        Cache::put('otp_verified_'.$userId, true, now()->addHours(2)); // Verifikasi berlaku 2 jam

        return redirect()->intended('/dashboard');
    }

    public function resend()
    {
        $userId = Auth::id();
        $newOtp = Str::random(6, '1234567890'); // Generate 6 digit angka
        
        Cache::put('otp_'.$userId, $newOtp, now()->addMinutes(10)); // OTP berlaku 10 menit
        
        // Di sini tambahkan logika pengiriman OTP via WhatsApp/Email/SMS
        // Contoh: Kirim $newOtp ke nomor handphone user
        
        return back()->with('status', 'Kode OTP baru telah dikirim');
    }
}