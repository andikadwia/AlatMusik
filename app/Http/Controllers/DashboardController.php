<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlatMusik;
use App\Models\User;

class DashboardController extends Controller  // Pastikan extend Controller
{
    // Pindahkan middleware ke constructor
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');  // Pastikan middleware 'admin' sudah terdaftar
    }

    public function index()
    {
        return view('pages.dashboard.index');
    }
}