<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Coba login dengan username atau email
        if (Auth::attempt([
            'username' => $credentials['username'], 
            'password' => $credentials['password']
        ]) || Auth::attempt([
            'email' => $credentials['username'],
            'password' => $credentials['password']
        ])) {
            $request->session()->regenerate();
            
            // Redirect dengan pesan sukses
            return $this->redirectBasedOnRole(auth()->user())
                ->with('success', 'Login berhasil! Selamat datang ' . auth()->user()->name);
        }

        // Redirect dengan pesan error
        return back()
            ->with('error', 'Username/Email atau password salah')
            ->onlyInput('username');
    }

    protected function redirectBasedOnRole(User $user)
    {
        if ($user->role === 'admin') {
            return redirect('/dashboard');
        }
        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Redirect dengan pesan sukses logout
        return redirect('/')
            ->with('success', 'Anda telah berhasil logout');
    }
}