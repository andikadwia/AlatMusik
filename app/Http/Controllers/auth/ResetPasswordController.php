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
            return redirect()->route('password.request')
                   ->with('error', 'Akses tidak sah atau OTP belum diverifikasi.');
        }

        Log::info('Menampilkan form reset password untuk user ID: '.session('reset_user_id'));

        return view('auth.reset-password')->with([
            'phone' => session('reset_phone'),
            'status' => session('status')
        ]);
    }

    /**
     * Simpan password baru.
     */
    public function reset(Request $request)
    {
        if (!session('otp_verified')) {
            Log::warning('Percobaan reset password tanpa verifikasi OTP');
            return redirect()->route('password.request')
                   ->with('error', 'Sesi verifikasi tidak valid. Silakan mulai ulang proses reset password.');
        }

        // Validasi input
        $request->validate([
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'max:20',
                'regex:/^[a-zA-Z0-9]+$/',
                function ($attribute, $value, $fail) {
                    if (preg_match('/\s/', $value)) {
                        $fail('Password tidak boleh mengandung spasi.');
                    }
                }
            ]
        ], [
            'password.required' => 'Password wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.max' => 'Password maksimal 20 karakter.',
            'password.regex' => 'Password hanya boleh mengandung huruf dan angka.',
        ]);

        $throttleKey = 'reset-password:'.$request->ip().':'.session('reset_user_id');

        if (RateLimiter::tooManyAttempts($throttleKey, $this->maxAttempts)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            Log::warning("Rate limit exceeded for user ID: ".session('reset_user_id')." from IP: ".$request->ip());
            return back()->with('error', "Terlalu banyak percobaan. Silakan coba lagi dalam ".ceil($seconds/60)." menit.");
        }

        RateLimiter::hit($throttleKey);

        try {
            $user = User::where('id', session('reset_user_id'))
                      ->where('telepon', session('reset_phone'))
                      ->firstOrFail();

            // Cek jika password baru sama dengan yang lama
            if (Hash::check($request->password, $user->password)) {
                Log::notice("User mencoba menggunakan password yang sama", ['user_id' => $user->id]);
                return back()->with('warning', 'Password baru tidak boleh sama dengan password lama.');
            }

            $user->update([
                'password' => Hash::make($request->password),
                'remember_token' => Str::random(60)
            ]);

            event(new PasswordReset($user));

            // Audit log
            Log::info("Password berhasil direset", [
                'user_id' => $user->id,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);

            // Bersihkan session
            $this->clearResetSession($request);

            RateLimiter::clear($throttleKey);

            return redirect()->route('login')
                   ->with('success', 'Password berhasil direset! Silakan login dengan password baru Anda.');

        } catch (\Exception $e) {
            Log::error("Gagal reset password: ".$e->getMessage(), [
                'user_id' => session('reset_user_id'),
                'exception' => $e
            ]);

            return back()->with('error', 'Terjadi kesalahan sistem. Silakan coba lagi.');
        }
    }

    /**
     * Bersihkan session reset password
     */
    protected function clearResetSession($request)
    {
        $request->session()->forget([
            'otp_verified',
            'reset_user_id',
            'reset_phone',
            'password_reset_phone'
        ]);
    }
}