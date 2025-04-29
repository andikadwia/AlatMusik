<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
            'telepon' => 'required|string|max:15|unique:users,Telepon',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'alamat' => 'required|string|max:255',
        ], [
            'telepon.unique' => 'Nomor handphone sudah terdaftar',
            'username.unique' => 'Username sudah digunakan',
            'email.unique' => 'Email sudah terdaftar',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = User::create([
            'name' => $request->username,
            'email' => $request->email,
            'username' => $request->username,
            'Telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'password' => Hash::make($request->password),
            'role' => User::ROLE_USER, 
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}