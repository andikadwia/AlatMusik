<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\Otp;
use Carbon\Carbon;

class OTPController extends Controller
{
    // Konfigurasi dasar
    protected $maxAttempts = 3;      
    protected $decayMinutes = 5;     
    protected $deviceToken = "4VomUsrKuVu9S4E65NY9";
    protected $otpExpiry = 300;      

    /**
     * Menampilkan form verifikasi OTP
     */
    public function showVerifyForm(Request $request)
    {
        // Cek jika tidak ada nomor di session, redirect ke form lupa password
        if (!$request->session()->has('password_reset_phone')) {
            return redirect()->route('password.request');
        }

        $phone = $request->session()->get('password_reset_phone');
        
        return view('auth.verify-otp', [
            'resend_time' => 60,
            'phone' => $phone,
            'masked_phone' => $this->maskPhoneNumber($phone)
        ]);
    }

    /**
     * Membuat dan mengirim OTP ke nomor handphone
     */
    public function requestOtp(Request $request)
    {
        // Validasi input
        $request->validate([
            'nomorhandphone' => 'required|regex:/^08[0-9]{8,11}$/'
        ]);

        $phone = $request->nomorhandphone;
        
        // Cek apakah nomor terdaftar
        if (!User::where('telepon', $phone)->exists()) {
            return back()->withErrors(['nomorhandphone' => 'Nomor tidak terdaftar']);
        }

        try {
            // Generate OTP baru
            $otp = $this->generateOtp();
            $waktu = time();
            
            // Hapus OTP lama jika ada
            Otp::where('nomor', $phone)->delete();
            
            // Simpan OTP baru
            Otp::create([
                'nomor' => $phone,
                'otp' => $otp,
                'waktu' => $waktu,
                'device_token' => $this->deviceToken
            ]);

            $request->session()->put('otp_code', $otp);
            $request->session()->put('otp_time', $waktu);
            
            // Kirim OTP via WhatsApp
            $response = $this->sendOTP($phone, $otp);
            
            if (!$response->successful()) {
                Log::error("Gagal mengirim OTP", $response->json());
                return back()->withErrors(['otp' => 'Gagal mengirim OTP']);
            }
            
            // Simpan nomor di session dan redirect ke verifikasi
            $request->session()->put('password_reset_phone', $phone);
            return redirect()->route('otp.verify')->with('status', 'OTP berhasil dikirim!');
            
        } catch (\Exception $e) {
            Log::error("Error mengirim OTP: " . $e->getMessage());
            return back()->withErrors(['otp' => 'Terjadi kesalahan sistem']);
        }
    }

    /**
     * Memverifikasi OTP yang dimasukkan user
     */
    public function verify(Request $request)
    {
        $request->validate([
            'kodeotp' => 'required|numeric|digits:6',
            'telepon' => 'required'
        ]);

        $phone = $request->telepon;
        
        // Debugging - log input
        Log::info('OTP Verification Attempt:', ['phone' => $phone, 'ip' => $request->ip()]);

        // Cek rate limiting
        if (RateLimiter::tooManyAttempts('otp-verify:'.$phone, $this->maxAttempts)) {
            $seconds = RateLimiter::availableIn('otp-verify:'.$phone);
            return back()->withErrors([
                'kodeotp' => "Terlalu banyak percobaan. Silakan coba lagi dalam {$seconds} detik."
            ]);
        }

        // Cek OTP
        $otpRecord = Otp::where('nomor', $phone)
                    ->where('otp', $request->kodeotp)
                    ->first();

        if (!$otpRecord) {
            RateLimiter::hit('otp-verify:'.$phone, $this->decayMinutes * 60);
            return back()->withErrors(['kodeotp' => 'Kode OTP tidak valid']);
        }

        if ((time() - $otpRecord->waktu) > $this->otpExpiry) {
            return back()->withErrors(['kodeotp' => 'Kode OTP telah kadaluarsa']);
        }

        // Dapatkan user
        $user = User::where('telepon', $phone)->first();
        if (!$user) {
            return back()->withErrors(['telepon' => 'User tidak ditemukan']);
        }

        // Set session
        session([
            'otp_verified' => true,
            'reset_user_id' => $user->id,
            'reset_phone' => $phone
        ]);

        // Debugging - log success
        Log::info('OTP Verified Successfully', ['user_id' => $user->id]);

        // Redirect ke reset password
        return redirect()->route('password.reset')->with('success', 'Verifikasi berhasil!');
    }

    // Mengirim ulang OTP
    public function resend(Request $request)
    {
        $request->validate(['telepon' => 'required']);
        $phone = $request->telepon;
        
        try {
            $otp = $this->generateOtp();
            
            // Update OTP di database
            Otp::updateOrCreate(
                ['nomor' => $phone],
                ['otp' => $otp, 'waktu' => time(), 'device_token' => $this->deviceToken]
            );
            
            // Kirim OTP
            $response = $this->sendOTP($phone, $otp);
            
            if (!$response->successful()) {
                throw new \Exception("Gagal mengirim OTP: " . $response->body());
            }
            
            return back()->with('status', 'OTP berhasil dikirim ulang!');
            
        } catch (\Exception $e) {
            Log::error("Error resend OTP: " . $e->getMessage());
            return back()->withErrors(['otp' => 'Gagal mengirim ulang OTP']);
        }
    }

    /*********************
     * FUNGSI BANTU PRIVATE
     *********************/
    
    // Mengirim OTP via API Fonnte
    private function sendOTP($phone, $otp)
    {
        return Http::timeout(15)
            ->withHeaders(['Authorization' => $this->deviceToken])
            ->post('https://api.fonnte.com/send', [
                'target' => $this->formatPhoneNumber($phone),
                'message' => "Kode OTP Anda: $otp - Jangan berikan kode ini ke siapapun"
            ]);
    }
    
    /* Membersihkan data OTP setelah digunakan */
    private function clearOtp($phone)
    {
        RateLimiter::clear('otp-verify:'.$phone);
        Otp::where('nomor', $phone)->delete();
    }
    
    /**
     * Generate 6 digit OTP
     */
    private function generateOtp()
    {
        return rand(100000, 999999);
    }
    
    /**
     * Format nomor untuk API Fonnte (62xxx)
     */
    private function formatPhoneNumber($phone)
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        if (str_starts_with($phone, '62')) return $phone;
        if (str_starts_with($phone, '0')) return '62' . substr($phone, 1);
        
        throw new \Exception("Format nomor tidak valid: " . $phone);
    }
    
    /**
     * Masking nomor untuk tampilan (0812****123)
     */
    private function maskPhoneNumber($phone)
    {
        return substr($phone, 0, 4) . '****' . substr($phone, -3);
    }
}