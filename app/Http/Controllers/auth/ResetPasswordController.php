<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;

class ResetPasswordController extends Controller
{
    protected $maxAttempts = 5; // Max attempts for password reset
    protected $decayMinutes = 15; // Lockout time after max attempts

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.reset-password')->with([
            'token' => $token,
            'phone' => $request->phone,
            'otp' => $request->otp // Tambahkan ini jika menggunakan OTP
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'phone' => 'required',
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
            ],
        ], [
            'password.regex' => 'Password harus mengandung setidaknya 1 huruf besar, 1 huruf kecil, 1 angka, dan 1 karakter spesial.'
        ]);

        // Rate limiting
        $throttleKey = 'reset-password:'.$request->ip();
        if (RateLimiter::tooManyAttempts($throttleKey, $this->maxAttempts)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->withErrors([
                'phone' => "Terlalu banyak percobaan. Silakan coba lagi dalam {$seconds} detik."
            ]);
        }

        // Cari user dan validasi OTP
        $user = User::where('phone_number', $this->formatPhoneNumber($request->phone))
            ->where('reset_password_otp', $request->token)
            ->where('reset_password_otp_expires_at', '>', Carbon::now())
            ->first();

        if (!$user) {
            RateLimiter::hit($throttleKey, $this->decayMinutes * 60);
            Log::warning('Reset password attempt failed', [
                'phone' => $request->phone,
                'ip' => $request->ip()
            ]);
            return back()->withErrors(['phone' => 'OTP tidak valid atau telah kadaluarsa.']);
        }

        // Update password dan reset OTP
        try {
            $user->update([
                'password' => Hash::make($request->password),
                'reset_password_otp' => null,
                'reset_password_otp_expires_at' => null,
                'remember_token' => Str::random(60)
            ]);

            event(new PasswordReset($user));

            // Log successful reset
            Log::info("Password reset successful for user: {$user->id}");

            // Clear rate limiter
            RateLimiter::clear($throttleKey);

            return redirect()->route('login')
                ->with('status', 'Password Anda telah berhasil direset! Silakan login dengan password baru Anda.');

        } catch (\Exception $e) {
            Log::error("Password reset failed for user: {$user->id}", [
                'error' => $e->getMessage()
            ]);
            return back()->withErrors(['error' => 'Terjadi kesalahan saat mereset password. Silakan coba lagi.']);
        }
    }

    protected function formatPhoneNumber($phone)
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        if (str_starts_with($phone, '62')) {
            return '0' . substr($phone, 2);
        }
        
        if (str_starts_with($phone, '0') && strlen($phone) >= 10 && strlen($phone) <= 13) {
            return $phone;
        }
        
        throw new \Exception("Format nomor tidak valid: " . $phone);
    }
}