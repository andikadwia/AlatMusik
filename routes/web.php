<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
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
    
    // Password Reset Routes
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ForgotPasswordController::class, 'reset'])->name('password.update');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');




    Route::get('/profil', [ProfileController::class, 'index'])->name('profile');
    Route::get('/keranjang', [CartController::class, 'index'])->name('cart');
    Route::get('/pesanan', [OrderController::class, 'index'])->name('orders');
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