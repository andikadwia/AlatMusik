<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ForgotPasswordController extends Controller
{
    /**
     * Show the password reset request form.
     */
    public function showLinkRequestForm()
    {
        return view('auth.lupa-sandi');
    }

    /**
     * Handle password reset request via phone number.
     */
    public function sendResetLinkPhone(Request $request)
    {
        // Validate phone number
        $validator = Validator::make($request->all(), [
            'nomorhandphone' => 'required|numeric|digits_between:10,15'
        ], [
            'nomorhandphone.required' => 'Nomor handphone wajib diisi.',
            'nomorhandphone.numeric' => 'Nomor handphone harus berupa angka.',
            'nomorhandphone.digits_between' => 'Nomor handphone harus antara 10-15 digit.'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Find user by phone number
        $user = User::where('telepon', $request->nomorhandphone)->first();

        if (!$user) {
            return back()->withErrors(['nomorhandphone' => 'Nomor handphone tidak terdaftar.']);
        }

        // Generate OTP (6 digits)
        $otp = rand(100000, 999999);
        $user->update([
            'reset_password_otp' => $otp,
            'reset_password_otp_expires_at' => now()->addMinutes(30),
            'reset_password_token' => Str::random(60)
        ]);

        // Send OTP to WhatsApp
        $this->sendWhatsAppOTP($user->telepon, $otp);

        // Redirect to OTP verification page
        return redirect()->route('password.verify', ['phone' => $user->telepon])
            ->with('status', 'Kode OTP telah dikirim ke WhatsApp Anda.');
    }

    /**
     * Show OTP verification form.
     */
    public function showVerifyForm($phone)
    {
        return view('auth.verify-otp', [
            'phone' => $phone,
            'resend_time' => 60 // seconds for resend OTP
        ]);
    }

    /**
     * Verify the OTP.
     */
    public function verifyOTP(Request $request, $phone)
    {
        $request->validate([
            'otp' => 'required|numeric|digits:6'
        ], [
            'otp.required' => 'Kode OTP wajib diisi.',
            'otp.numeric' => 'Kode OTP harus berupa angka.',
            'otp.digits' => 'Kode OTP harus 6 digit.'
        ]);

        $user = User::where('telepon', $phone)
            ->where('reset_password_otp', $request->otp)
            ->where('reset_password_otp_expires_at', '>', now())
            ->first();

        if (!$user) {
            return back()->withErrors(['otp' => 'Kode OTP tidak valid atau telah kadaluarsa.']);
        }

        // Redirect to password reset form with token
        return redirect()->route('password.reset', [
            'token' => $user->reset_password_token,
            'phone' => $phone
        ]);
    }

    /**
     * Resend OTP.
     */
    public function resendOTP(Request $request)
    {
        $request->validate(['phone' => 'required']);

        $user = User::where('telepon', $request->phone)->firstOrFail();

        // Generate new OTP
        $otp = rand(100000, 999999);
        $user->update([
            'reset_password_otp' => $otp,
            'reset_password_otp_expires_at' => now()->addMinutes(30)
        ]);

        $this->sendWhatsAppOTP($user->telepon, $otp);

        return response()->json([
            'message' => 'OTP telah dikirim ulang',
            'resend_time' => 60
        ]);
    }

    /**
     * Send OTP via WhatsApp.
     */
    protected function sendWhatsAppOTP($telepon, $otp)
    {
        try {
            // Format phone number for WhatsApp (add country code)
            $formattedPhone = '62' . ltrim($telepon, '0');
            
            // Here you would implement your actual WhatsApp API integration
            // For example, using Twilio:
            /*
            $twilio = new \Twilio\Rest\Client(
                config('services.twilio.sid'),
                config('services.twilio.token')
            );
            
            $twilio->messages->create(
                "whatsapp:+{$formattedPhone}",
                [
                    'from' => "whatsapp:+" . config('services.twilio.whatsapp_from'),
                    'body' => "Kode OTP reset password Anda: $otp. Berlaku 30 menit."
                ]
            );
            */
            
            // For development, log the OTP instead
            Log::info("WhatsApp OTP for {$formattedPhone}: {$otp}");
            
            return true;
        } catch (\Exception $e) {
            Log::error("Failed to send WhatsApp OTP: " . $e->getMessage());
            return false;
        }
    }
}