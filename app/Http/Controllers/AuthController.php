<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman form login
    public function showLogin()
    {
        return view('login');
    }

    // Memproses data yang dikirim dari form
    public function authenticate(Request $request)
    {
        // 1. Validasi inputan
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Cek apakah email & password cocok dengan di database
        if (Auth::attempt($credentials)) {
            // Jika sukses, buat session dan arahkan ke dashboard
            $request->session()->regenerate();
            return redirect()->intended('/dashboard'); 
        }

        // 3. Jika gagal, kembalikan ke halaman login bawa pesan error
        return back()->withErrors([
            'email' => 'Email atau password kamu salah.',
        ]);
    }
}