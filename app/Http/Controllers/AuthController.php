<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan halaman form login
    public function showLogin()
    {
        return view('login');
    }

    // Menampilkan halaman form register
    public function showRegister()
    {
        return view('register');
    }

    // Memproses data yang dikirim dari form LOGIN
    public function authenticate(Request $request)
    {
        // 1. Validasi inputan dari form
        $request->validate([
            'login' => ['required'], 
            'password' => ['required'],
        ]);

        // 2. INI LOGIKA YANG SEMPAT HILANG: Cek apakah inputan berupa email atau username?
        $fieldType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // 3. Buat kunci login yang benar berdasarkan hasil cek di atas
        $credentials = [
            $fieldType => $request->login,
            'password' => $request->password
        ];

        // 4. Proses pencocokan ke database menggunakan kunci yang baru
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Cek apakah admin
            if (Auth::user()->is_admin == 1) {
                return redirect()->intended('/admin');
            }
            
            // Jika user biasa
            return redirect('/'); 
        }

        // Kalau gagal, kembalikan dengan pesan error
        return back()->withErrors([
            'login' => 'Username/Email atau password kamu salah.',
        ]);
    }
    // Memproses data pendaftaran akun baru
    public function register(Request $request)
    {
        // 1. Validasi data yang diisi user
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // unique:users memastikan email belum dipakai
            'password' => 'required|min:6|confirmed', // confirmed wajibkan input "Konfirmasi Password"
        ], [
            // Pesan error custom (opsional biar lebih bahasa Indonesia)
            'login.unique' => 'akun ini sudah terdaftar!',
            'password.confirmed' => 'Konfirmasi password tidak cocok!',
            'password.min' => 'Password minimal 6 karakter!'
        ]);

        // 2. Simpan user baru ke database
        User::create([
            'username' => $request->username,
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

// 1. Fungsi untuk melempar user ke halaman Login Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // 2. Fungsi untuk menerima data balikan dari Google
    public function handleGoogleCallback()
    {
        try {
            // Ambil data user dari Google
            $googleUser = Socialite::driver('google')->user();

            // Cek apakah email ini sudah pernah terdaftar di database kita?
            $user = User::where('email', $googleUser->email)->first();

            if ($user) {
                // Kalau sudah ada, langsung login-kan saja (dan update google_id-nya kalau kosong)
                $user->update(['google_id' => $googleUser->id]);
                Auth::login($user);
            } else {
                // Kalau belum ada, buatkan akun baru otomatis!
                // Kita ambil username dari bagian depan emailnya (misal: jahfal02@gmail.com jadi jahfal02)
                $baseUsername = explode('@', $googleUser->email)[0]; 

                $newUser = User::create([
                    'username' => $baseUsername,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => null, // Password kosong karena login via Google
                    'is_admin' => false
                ]);

                Auth::login($newUser);
            }

            return redirect('/');

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Google Auth Error: ' . $e->getMessage(), [
                'exception' => $e
            ]);
            // Kalau batal/error, kembalikan ke halaman login bawa pesan error
            return redirect('/login')->withErrors(['login' => 'Gagal login pakai Google: ' . $e->getMessage()]);
        }
    }
// Fungsi untuk user update profil (saat ini baru ganti username)
    // Fungsi untuk user update profil (Username & Password)
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // Validasi: username unik, password minimal 6 karakter (boleh kosong kalau ga mau ganti)
        $request->validate([
            'username' => 'required|string|max:50|alpha_dash|unique:users,username,'.$user->id,
            'password' => 'nullable|min:6', // Tambahan validasi password
        ]);

        // Simpan username
        $user->username = $request->username;

        // Kalau kotak password diisi, maka enkripsi (blender) dan simpan password barunya
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect('/')->with('success', 'Profil kamu berhasil diperbarui!');
    }
}

