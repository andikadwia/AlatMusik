<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Coba login dengan username atau email
        if (Auth::attempt([
            'username' => $credentials['username'], 
            'password' => $credentials['password']
        ]) || Auth::attempt([
            'email' => $credentials['username'],
            'password' => $credentials['password']
        ])) {
            $request->session()->regenerate();
            
            // Jika Anda tidak memerlukan OTP, hapus baris berikut
            // $otpService->generateAndSendOTP($user->id, $user->telepon);
            // return redirect()->route('otp.verify');
            
            // Langsung redirect ke beranda/halaman utama
            //return redirect()->intended('/');
            
            // Atau jika ingin tetap menggunakan redirectBasedOnRole tapi ke halaman utama
            return $this->redirectBasedOnRole(auth()->user());
        }

        return back()->withErrors([
            'username' => 'Username/Email atau password salah.',
        ])->onlyInput('username');
    }

    protected function redirectBasedOnRole(User $user)
    {
        // Modifikasi untuk semua role mengarah ke beranda
        //return redirect()->intended('/');
        
        // Atau jika Anda ingin admin tetap ke dashboard admin
        if ($user->role === 'admin') {
            return redirect('/dashboard');
        }
        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}