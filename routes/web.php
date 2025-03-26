<?php

use Illuminate\Support\Facades\Route;
Use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ListItemController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\LandingpaController;
use App\Http\Controllers\LandingpageController;

Route::get('/register', [RegisterController::class, 'tampilkan']);
Route::get('/login', [LoginController::class, 'tampilkan']);
Route::get('/dashboard', [DashboardController::class, 'tampilkan']);
Route::get('/listitem', [ListItemController::class, 'tampilkan']);
Route::get('/landingpage', [LandingpageController::class, 'tampilkan']);
Route::get('/Kontak', [KontakController::class, 'tampilkan']);

Route::get('/', [HomeController::class, 'index']);
Route::get('/contact', [HomeController::class, 'contact']);

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/registrasi', function () {
    return view('registrasi');
})->name('register');

Route::get('/resteasy', function () {
    return view('resteasy');
})->name('resteasy');

Route::get('/edit', function () {
    return view('edit');
})->name('edit');

<<<<<<< HEAD
Route::get('/beranda', function () {
    return view('beranda');
})->name('beranda');

Route::get('/produk', function () {
    return view('produk');
})->name('produk');
=======
Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

Route::get('/landingpage', function () {
    return view('landingpage');
})->name('landingpage');
>>>>>>> 7125e3e341502983d93d59e1794628965ab2eafb
