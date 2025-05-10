<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user admin, jika tidak redirect ke halaman lain
        if (!auth()->user() || auth()->user()->role !== 'admin') {
            return redirect('/login');
        }

        return $next($request);
    }
}
