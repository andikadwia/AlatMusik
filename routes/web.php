<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\OTPController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AlatMusikController;
use App\Http\Controllers\ProductdashController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReturnController;
use App\Http\Middleware\AdminMiddleware;    
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RiwayatController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth Routes
// Authentication Routes
Route::middleware('guest')->group(function () {
    // Login Routes
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    
    // Registration Routes
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
    
    // Password Reset Flow with WhatsApp OTP
    Route::get('lupa-sandi', [ForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('password.request');
    
    Route::post('lupa-sandi', [ForgotPasswordController::class, 'sendResetLinkPhone'])
        ->name('password.email');
    
    // OTP Verification Routes
    Route::get('verify-otp/{phone}', [ForgotPasswordController::class, 'showVerifyForm'])
        ->name('password.verify')
        ->middleware('throttle:3,1');
    
    Route::post('verify-otp/{phone}', [ForgotPasswordController::class, 'verifyOTP'])
        ->name('password.verify.submit')
        ->middleware('throttle:5,1');
        
    Route::post('resend-otp', [ForgotPasswordController::class, 'resendOTP'])
        ->name('password.resend')
        ->middleware('throttle:1,60');
    
    // Password Reset
    Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
        ->name('password.reset');
    
    Route::post('reset-password', [ResetPasswordController::class, 'reset'])
        ->name('password.update');
});

// Add OTP routes that might be used by authenticated users
Route::middleware('auth')->group(function () {
    Route::post('send-whatsapp-otp', [OTPController::class, 'sendOTP'])
        ->name('send.otp');
});
// Add authenticated routes for OTP verification if needed
Route::middleware('auth')->group(function () {
    Route::get('verify-otp', [OTPController::class, 'showVerifyForm'])
        ->name('otp.verify');
    
    Route::post('verify-otp', [OTPController::class, 'verify'])
        ->name('otp.verify.submit');
    
    Route::post('resend-otp', [OTPController::class, 'resend'])
        ->name('otp.resend');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

        // Profile routes
        Route::get('/profil', [ProfileController::class, 'index'])->name('profile');
        Route::put('/profil', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('/profil/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
        
        // Other authenticated routes
       
    
    Route::get('/profil', [ProfileController::class, 'index'])->name('profile');
    Route::get('/keranjang', [CartController::class, 'index'])->name('cart');
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat');


    
    // Protected OTP Routes
    Route::post('verify-otp', [OTPController::class, 'verify'])
        ->name('otp.verify');
});
Route::get('/test-fonnte', function() {
    $testPhone = '6285271901194'; // Ganti dengan nomor test
    $otp = rand(100000, 999999);
    
    try {
        $response = Http::withHeaders([
            'Authorization' => config('services.fonnte.token')
        ])->post('https://api.fonnte.com/send', [
            'target' => $testPhone,
            'message' => "Test OTP: $otp"
        ]);
        
        return [
            'status' => $response->status(),
            'response' => $response->body(),
            'success' => $response->successful()
        ];
    } catch (\Exception $e) {
        return ['error' => $e->getMessage()];
    }
});

// Admin Only Routes
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.dashboard.index');
    })->name('dashboard.index2');
    
    // Alat Musik
    Route::resource('alatmusik', AlatMusikController::class);

    Route::get('/dashboard/orders', [OrderController::class, 'index'])->name('dashboard.orders');
    Route::put('dashboard/orders/update-status/{id}', [OrderController::class, 'updateStatus'])->name('dashboard.peminjaman.update-status');
    
    // Orders
    Route::get('/dashboard/product', [ProductdashController::class, 'index'])->name('dashboard.produk.index');
    Route::get('/dashboard/product/create', [ProductdashController::class, 'create'])->name('dashboard.produk.create');
    Route::post('dashboard/product', [ProductdashController::class, 'store'])->name('dashboard.produk.store');
    Route::put('dashboard/product/{id}', [ProductdashController::class, 'update'])->name('dashboard.produk.update');
    Route::post('dashboard/product/{id}', [ProductdashController::class, 'destroy'])->name('dashboard.produk.destroy');;
    
    // Returns
    Route::get('dashboard/rental', [RentalController::class, 'index'])->name('dashboard.peminjaman.index');
    Route::post('dashboard/peminjaman/update-status', [RentalController::class, 'updateStatusRental'])->name('dashboard.peminjaman.update-status-rental');
    Route::post('dashboard/peminjaman/proses-pengembalian', [RentalController::class, 'prosesPengembalian'])->name('dashboard.peminjaman.proses-pengembalian');
    
    Route::get('/dashboard/return', [ReturnController::class, 'index'])->name('dashboard.return.index');
    Route::post('dashboard/return/proses', [ReturnController::class, 'prosesPengembalian'])->name('pengembalian.proses');
    Route::get('dashboard/return/{id}', [ReturnController::class, 'show'])->name('pengembalian.show');

    Route::get('dashboard/customer', [CustomerController::class, 'index'])->name('dashboard.pelanggan.index');
});

//produtcController
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');