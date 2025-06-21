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
use App\Http\Controllers\PaymentController;

Route::get('/', [HomeController::class, 'index'])->name('home');

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
    
    // OTP Routes - Hanya untuk guest (belum login)
    Route::post('/request-otp', [OTPController::class, 'requestOtp'])->name('otp.request');
    Route::get('/verify-otp', [OTPController::class, 'showVerifyForm'])->name('otp.verify');
    Route::post('/verify-otp', [OTPController::class, 'verify'])->name('otp.verify.submit');
    Route::post('/resend-otp', [OTPController::class, 'resend'])->name('otp.resend');
    
    // Password Reset
    Route::get('reset-passwords/', [ResetPasswordController::class, 'showResetForm'])
        ->name('password.reset');
    
    Route::post('reset-password', [ResetPasswordController::class, 'reset'])
        ->name('password.update');
});

// OTP Routes untuk user yang sudah login (jika diperlukan)
Route::middleware('auth')->group(function () {
    Route::post('send-whatsapp-otp', [OTPController::class, 'sendOTP'])
        ->name('send.otp');
    
    // Jika perlu verifikasi OTP tambahan setelah login
    Route::get('verify-auth-otp', [OTPController::class, 'showAuthVerifyForm'])
        ->name('otp.auth.verify');
    
    Route::post('verify-auth-otp', [OTPController::class, 'verifyAuthOtp'])
        ->name('otp.auth.verify.submit');
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
    Route::get('payment', [PaymentController::class, 'index'])->name('payment');
});


// Admin Only Routes
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Alat Musik
    Route::resource('alatmusik', AlatMusikController::class);

    Route::get('/dashboard/orders', [OrderController::class, 'index'])->name('dashboard.orders');
    Route::put('dashboard/orders/update-status/{id}', [OrderController::class, 'updateStatus'])->name('dashboard.peminjaman.update-status');
    
    // Orders
    Route::get('/dashboard/product', [ProductdashController::class, 'index'])->name('dashboard.produk.index');
    Route::get('/dashboard/product/create', [ProductdashController::class, 'create'])->name('dashboard.produk.create');
    Route::post('dashboard/product', [ProductdashController::class, 'store'])->name('dashboard.produk.store');
    Route::put('dashboard/product/{id}', [ProductdashController::class, 'update'])->name('dashboard.produk.update');
    Route::delete('dashboard/product/{id}', [ProductdashController::class, 'destroy'])->name('dashboard.produk.destroy');;
    
    // Returns
    Route::get('dashboard/rental', [RentalController::class, 'index'])->name('dashboard.peminjaman.index');
    Route::post('dashboard/peminjaman/update-status', [RentalController::class, 'updateStatusRental'])->name('dashboard.peminjaman.update-status-rental');
    Route::post('dashboard/peminjaman/proses-pengembalian', [RentalController::class, 'prosesPengembalian'])->name('dashboard.peminjaman.proses-pengembalian');
    
    Route::get('/dashboard/return', [ReturnController::class, 'index'])->name('dashboard.return.index');
    Route::post('dashboard/return/proses', [ReturnController::class, 'prosesPengembalian'])->name('pengembalian.proses');
    Route::get('dashboard/return/{id}', [ReturnController::class, 'show'])->name('pengembalian.show');

    Route::get('dashboard/customer', [CustomerController::class, 'index'])->name('dashboard.pelanggan.index');

    Route::get('/dashboard/produk', [ProductdashController::class, 'index'])->name('dashboard.produk.index.search');
});

//produtcController
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/load-more', [HomeController::class, 'loadMore']);