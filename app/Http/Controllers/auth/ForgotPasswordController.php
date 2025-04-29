<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use App\Services\OTPService;

class ForgotPasswordController extends Controller
{
    protected $otpService;

    public function __construct(OTPService $otpService)
    {
        $this->otpService = $otpService;
    }

    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'Telepon' => 'required|string'
        ]);

        // Cari user berdasarkan nomor handphone
        $user = User::where('Telepon', $request->telepon)->first();

        if (!$user) {
            return back()->withErrors([
                'Telepon' => 'Nomor handphone tidak terdaftar.'
            ]);
        }

        // Generate dan kirim OTP
        $otp = $this->otpService->generateAndSendOTP($user->id, $user->phone);

        // Simpan data reset password
        Cache::put('password_reset_'.$user->id, [
            'user_id' => $user->id,
            'Telepon' => $user->telepon,
            'otp' => $otp
        ], now()->addMinutes(30));

        return redirect()->route('password.reset')->with([
            'status' => 'Kode OTP telah dikirim ke WhatsApp Anda',
            'Telepon' => $request->nomorhandphone
        ]);
    }
}