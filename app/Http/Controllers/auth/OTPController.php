<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Carbon\Carbon;

class OTPController extends Controller
{
    protected $maxAttempts = 3; // Max OTP attempts
    protected $decayMinutes = 5; // Lockout time after max attempts

    public function showVerifyForm()
    {
        return view('auth.verify-otp', [
            'resend_time' => 60,
            'phone' => Auth::user()->phone_number
        ]);
    }

    public function verify(Request $request)
    {
        // Rate limiting
        if (RateLimiter::tooManyAttempts('otp-verify:'.Auth::id(), $this->maxAttempts)) {
            $seconds = RateLimiter::availableIn('otp-verify:'.Auth::id());
            return back()->withErrors([
                'kodeotp' => "Terlalu banyak percobaan. Silakan coba lagi dalam {$seconds} detik."
            ]);
        }

        $request->validate([
            'kodeotp' => 'required|numeric|digits:6'
        ]);

        $user = Auth::user();

        // Verifikasi OTP dari database
        if (!$user->reset_password_otp || 
            $user->reset_password_otp != $request->kodeotp ||
            Carbon::now()->gt($user->reset_password_otp_expires_at)) {
            
            RateLimiter::hit('otp-verify:'.Auth::id(), $this->decayMinutes * 60);
            
            return back()->withErrors([
                'kodeotp' => 'Kode OTP tidak valid atau telah kadaluarsa'
            ]);
        }

        // OTP valid
        RateLimiter::clear('otp-verify:'.Auth::id());
        
        // Reset OTP fields
        $user->update([
            'reset_password_otp' => null,
            'reset_password_otp_expires_at' => null
        ]);

        Log::info("User {$user->id} successfully verified OTP");

        return redirect()->intended('/dashboard');
    }

    public function resend()
    {
        $user = Auth::user();
        
        try {
            $formattedPhone = $this->formatPhoneNumber($user->phone_number);
            Log::info("Mengirim OTP ke nomor: " . $formattedPhone);
            
            $otp = $this->generateOtp();
            $expiresAt = Carbon::now()->addMinutes(10);
            
            // Simpan OTP ke database
            $user->update([
                'reset_password_otp' => $otp,
                'reset_password_otp_expires_at' => $expiresAt
            ]);
            
            // Kirim via Fonnte
            $response = Http::timeout(15)
                ->withHeaders(['Authorization' => config('services.fonnte.token')])
                ->post('https://api.fonnte.com/send', [
                    'target' => $formattedPhone,
                    'message' => "Kode OTP Anda: $otp - Jangan berikan kode ini ke siapapun"
                ]);
            
            if (!$response->successful()) {
                Log::error("Gagal mengirim OTP", $response->json());
                return back()->withErrors(['otp' => 'Gagal mengirim OTP']);
            }
            
            return back()->with('status', 'OTP berhasil dikirim!');
            
        } catch (\Exception $e) {
            Log::error("Exception saat mengirim OTP: " . $e->getMessage());
            return back()->withErrors(['otp' => 'Terjadi kesalahan sistem']);
        }
    }

    protected function generateOtp()
    {
        return rand(100000, 999999);
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
        
        if (strlen($phone) >= 9 && strlen($phone) <= 12) {
            return '0' . $phone;
        }
        
        throw new \Exception("Format nomor tidak valid: " . $phone);
    }
}