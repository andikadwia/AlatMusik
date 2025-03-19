<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function tampilkan()
    {
        return view('register'); // Pastikan ada file register.blade.php di folder views
    }
}
