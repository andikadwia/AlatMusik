<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request)
    {
        return view('auth.reset-password', [
            'phone' => $request->session()->get('phone')
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'otp' => 'required|numeric|digits:6',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Cari user
        $user = User::where('phone', $request->phone)->first();

        if (!$user) {
            return back()->withErrors([
                'phone' => 'Nomor handphone tidak valid.'
            ]);
        }

        // Verifikasi OTP
        $resetData = Cache::get('password_reset_'.$user->id);

        if (!$resetData || $resetData['otp'] != $request->otp) {
            return back()->withErrors([
                'otp' => 'Kode OTP tidak valid atau telah kadaluarsa.'
            ]);
        }

        // Update password
        $user->password = Hash::make($request->password);
        $user->save();

        // Hapus data reset dari cache
        Cache::forget('password_reset_'.$user->id);

        return redirect()->route('login')->with('status', 'Password berhasil direset! Silakan login dengan password baru.');
    }
}