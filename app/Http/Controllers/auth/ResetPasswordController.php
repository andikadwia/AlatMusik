<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use App\Models\User;

class ResetPasswordController extends Controller
{
    protected $maxAttempts = 5;
    protected $decayMinutes = 15;

    /**
     * Tampilkan form reset password.
     */
    public function showResetForm(Request $request)
    {
        if (!session('otp_verified') || !session('reset_user_id') || !session('reset_phone')) {
            return redirect()->route('password.request')->withErrors(['reset' => 'Akses tidak sah atau OTP belum diverifikasi.']);
        }

        Log::debug('Session data:', [
            'otp_verified' => session('otp_verified'),
            'reset_user_id' => session('reset_user_id'),
            'reset_phone' => session('reset_phone'),
        ]);

        return view('auth.reset-password')->with([
            'phone' => session('reset_phone') // untuk ditampilkan di UI, jika perlu
        ]);
    }

    /**
     * Simpan password baru.
     */
    public function reset(Request $request)
    {
        if (!session('otp_verified') || !session('reset_user_id') || !session('reset_phone')) {
            return redirect()->route('password.request')->withErrors(['reset' => 'Sesi verifikasi tidak ditemukan.']);
        }

        $request->validate([
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
            ]
        ], [
            'password.regex' => 'Password harus mengandung setidaknya 1 huruf besar, 1 huruf kecil, 1 angka, dan 1 karakter spesial.'
        ]);

        $throttleKey = 'reset-password:'.$request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, $this->maxAttempts)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            Log::warning("Rate limiter hit for IP {$request->ip()}");
            return back()->withErrors([
                'password' => "Terlalu banyak percobaan. Silakan coba lagi dalam {$seconds} detik."
            ]);
        }


        try {
            // Ambil user berdasarkan ID dan kolom telepon
            $user = User::where('id', session('reset_user_id'))
                        ->where('telepon', session('reset_phone'))
                        ->firstOrFail();

            $user->update([
                'password' => Hash::make($request->password),
                'remember_token' => Str::random(60)
            ]);

            event(new PasswordReset($user));

            Log::info("Password reset berhasil untuk user ID: {$user->id}");

            // Hapus semua session terkait OTP
            $request->session()->forget([
                'otp_verified',
                'reset_user_id',
                'reset_phone',
                'password_reset_phone'
            ]);

            RateLimiter::clear($throttleKey);

            return redirect()->route('login')->with('status', 'Password berhasil direset. Silakan login dengan password baru.');

        } catch (\Exception $e) {
            Log::error("Gagal reset password", [
                'user_id' => session('reset_user_id'),
                'error' => $e->getMessage()
            ]);

            return back()->withErrors(['error' => 'Terjadi kesalahan saat mereset password. Silakan coba lagi.']);
        }
    }
}
