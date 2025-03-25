<?php

use Illuminate\Support\Facades\Route;
Use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ListItemController;

Route::get('/register', [RegisterController::class, 'tampilkan']);
Route::get('/login', [LoginController::class, 'tampilkan']);
Route::get('/dashboard', [DashboardController::class, 'tampilkan']);
Route::get('/listitem', [ListItemController::class, 'tampilkan']);

Route::get('/', [HomeController::class, 'index']);
Route::get('/contact', [HomeController::class, 'contact']);

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/registrasi', function () {
    return view('registrasi');
})->name('register');