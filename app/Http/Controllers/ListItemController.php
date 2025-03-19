<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListItemController extends Controller
{
    public function tampilkan()
    {
        return view('listitem'); // Pastikan ada file register.blade.php di folder views
    }
}
