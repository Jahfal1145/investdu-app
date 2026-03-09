<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // 1. Fungsi untuk Halaman Utama Admin (Hub / Dashboard Admin)
    public function dashboard()
    {
        // Cek keamanan: pastikan yang buka adalah admin
        if (Auth::user()->is_admin == 0) {
            return redirect('/dashboard');
        }
        return view('admin_dashboard');
    }

    // 2. Fungsi untuk menampilkan halaman tabel daftar user
    public function index()
    {
        // Cek keamanan
        if (Auth::user()->is_admin == 0) {
            return redirect('/dashboard')->withErrors(['akses' => 'Kamu tidak punya akses ke halaman Admin!']);
        }

        // Ambil semua data user, lalu kirim ke view 'admin'
        $users = User::all();
        return view('admin', compact('users'));
    }

    // 3. Fungsi untuk menghapus user
    public function destroy($id)
    {
        // Cek keamanan
        if (Auth::user()->is_admin == 0) {
            return redirect('/dashboard');
        }

        // Cari user berdasarkan ID, lalu hapus dari database
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'User berhasil dihapus!');
    }
}