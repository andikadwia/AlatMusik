<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function tampilkan()
    {
        return view('login'); // Pastikan ada file register.blade.php di folder views
    }
}
