<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // --- TAMBAHKAN LOGIKA INI ---
            // Cek apakah user yang baru login ini adalah admin (nilai is_admin = 1)
            if (Auth::user()->is_admin == 1) {
                return redirect()->intended('/admin'); // Lempar ke halaman admin
            }

            // Jika bukan admin (user biasa), lempar ke dashboard
            return redirect()->intended('/dashboard'); 
        }

        return back()->withErrors([
            'email' => 'Email atau password kamu salah.',
        ]);
    }

    // Memproses data pendaftaran akun baru
    public function register(Request $request)
    {
        // 1. Validasi data yang diisi user
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // unique:users memastikan email belum dipakai
            'password' => 'required|min:6|confirmed', // confirmed wajibkan input "Konfirmasi Password"
        ], [
            // Pesan error custom (opsional biar lebih bahasa Indonesia)
            'email.unique' => 'Email ini sudah terdaftar!',
            'password.confirmed' => 'Konfirmasi password tidak cocok!',
            'password.min' => 'Password minimal 6 karakter!'
        ]);

        // 2. Simpan user baru ke database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Password wajib di-hash (dienkripsi)
        ]);

        // 3. Arahkan kembali ke halaman login bawa pesan sukses
        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

// Memproses proses logout
    public function logout(Request $request)
    {
        Auth::logout(); // Menghapus sesi login user

        $request->session()->invalidate(); // Menghapus data session
        $request->session()->regenerateToken(); // Mengamankan token CSRF

        return redirect('/login')->with('success', 'Kamu berhasil logout!');
    }
}

