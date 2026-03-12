<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

// Fungsi Menampilkan Tabel & Fitur Search
    public function index(Request $request)
    {
        if (Auth::user()->is_admin == 0) return redirect('/dashboard');

        // Logika Pencarian (Search)
        $search = $request->input('search');
        if ($search) {
            // Cari berdasarkan username ATAU email
            $users = User::where('username', 'LIKE', "%{$search}%")
                         ->orWhere('email', 'LIKE', "%{$search}%")->get();
        } else {
            $users = User::all();
        }

        return view('admin', compact('users'));
    }

    // Fungsi Menampilkan Halaman Form Edit
    public function edit($id)
    {
        if (Auth::user()->is_admin == 0) return redirect('/dashboard');
        
        $user = User::findOrFail($id);
        return view('edit_user', compact('user'));
    }

    // Fungsi Menyimpan Perubahan Edit
    public function update(Request $request, $id)
    {
        if (Auth::user()->is_admin == 0) return redirect('/dashboard');
        
        $user = User::findOrFail($id);

        // Validasi input
        $request->validate([
            // unique:users,username,'.$user->id -> Boleh pakai nama sendiri, ga boleh pakai punya orang lain
            'username' => 'required|string|max:50|alpha_dash|unique:users,username,'.$user->id,
            'email' => 'required|email|unique:users,email,'.$user->id,
            'is_admin' => 'required|boolean',
        ]);

        // Update data dasar
        $user->username = $request->username;
        $user->email = $request->email;
        $user->is_admin = $request->is_admin;

        // Update password HANYA JIKA diisi (kalau dikosongkan, password lama tetap aman)
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect('/admin/users')->with('success', 'Data user ' . $user->username . ' berhasil diperbarui!');
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