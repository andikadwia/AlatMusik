<?php

use Illuminate\Support\Facades\Route;
Use App\Http\Controllers\HomeController;

// Route::get('/', function () {
//    return view('welcome');
// });


Route::get('/', [HomeController::class, 'index']);
Route::get('/contact', [HomeController::class, 'contact']);