<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\InvestmentCategory;
use App\Models\TriviaQuestion;
use App\Models\YesOrNoQuestion;
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

        // Statistik untuk dashboard
        $totalUsers = User::count();
        $recentUsers = User::latest()->take(10)->get();

        return view('admin_dashboard', compact('totalUsers', 'recentUsers'));
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

        return view('admin_users', compact('users'));
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

    // 4. Halaman Kelola Literasi
    public function literasiIndex()
    {
        if (Auth::user()->is_admin == 0) {
            return redirect('/dashboard');
        }

        $categories = InvestmentCategory::with(['triviaQuestions', 'yesOrNoQuestions'])->get();
        return view('admin_literasi', compact('categories'));
    }

    public function literasiEdit($id)
    {
        if (Auth::user()->is_admin == 0) {
            return redirect('/dashboard');
        }

        $category = InvestmentCategory::findOrFail($id);
        return view('edit_literasi', compact('category'));
    }

    public function forumDiskusi()
    {
        if (Auth::user()->is_admin == 0) {
            return redirect('/dashboard');
        }

        return view('admin.forum_diskusi');
    }

    public function literasiUpdate(Request $request, $id)
    {
        if (Auth::user()->is_admin == 0) {
            return redirect('/dashboard');
        }

        $category = InvestmentCategory::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:80',
            'description' => 'required|string|max:500',
            'badge' => 'nullable|string|max:50',
            'icon' => 'nullable|string|max:50',
        ]);

        $category->name = $request->name;
        $category->description = $request->description;
        $category->badge = $request->badge;
        $category->icon = $request->icon;
        $category->save();

        return redirect('/admin/literasi')->with('success', 'Kategori literasi berhasil diperbarui!');
    }

    public function monitorGame()
    {
        if (Auth::user()->is_admin == 0) {
            return redirect('/dashboard');
        }

        $categories = InvestmentCategory::with(['triviaQuestions', 'yesOrNoQuestions'])->get();
        return view('admin_monitor_game', compact('categories'));
    }

    public function storeCategoryTrivia(Request $request, $categoryId)
    {
        if (Auth::user()->is_admin == 0) {
            return redirect('/dashboard');
        }

        $category = InvestmentCategory::findOrFail($categoryId);
        $request->validate([
            'question' => 'required|string|max:500',
            'option_a' => 'required|string|max:255',
            'option_b' => 'required|string|max:255',
            'option_c' => 'required|string|max:255',
            'option_d' => 'required|string|max:255',
            'correct_answer' => 'required|in:A,B,C,D',
            'explanation' => 'nullable|string|max:1000',
        ]);

        TriviaQuestion::create(array_merge($request->only([
            'question', 'option_a', 'option_b', 'option_c', 'option_d', 'correct_answer', 'explanation'
        ]), ['category_id' => $category->id]));

        return redirect()->back()->with('success', 'Pertanyaan trivia berhasil ditambahkan untuk kategori ' . $category->name . '.');
    }

    public function updateCategoryTrivia(Request $request, $categoryId, $id)
    {
        if (Auth::user()->is_admin == 0) {
            return redirect('/dashboard');
        }

        $category = InvestmentCategory::findOrFail($categoryId);
        $question = TriviaQuestion::findOrFail($id);
        $request->validate([
            'question' => 'required|string|max:500',
            'option_a' => 'required|string|max:255',
            'option_b' => 'required|string|max:255',
            'option_c' => 'required|string|max:255',
            'option_d' => 'required|string|max:255',
            'correct_answer' => 'required|in:A,B,C,D',
            'explanation' => 'nullable|string|max:1000',
        ]);

        if ($question->category_id !== $category->id) {
            return redirect()->back()->with('error', 'Pertanyaan tidak ditemukan untuk kategori ini.');
        }

        $question->update($request->only([
            'question', 'option_a', 'option_b', 'option_c', 'option_d', 'correct_answer', 'explanation'
        ]));

        return redirect()->back()->with('success', 'Pertanyaan trivia berhasil diperbarui untuk kategori ' . $category->name . '.');
    }

    public function deleteCategoryTrivia($categoryId, $id)
    {
        if (Auth::user()->is_admin == 0) {
            return redirect('/dashboard');
        }

        $category = InvestmentCategory::findOrFail($categoryId);
        $question = TriviaQuestion::findOrFail($id);

        if ($question->category_id !== $category->id) {
            return redirect()->back()->with('error', 'Pertanyaan tidak ditemukan untuk kategori ini.');
        }

        $question->delete();
        return redirect()->back()->with('success', 'Pertanyaan trivia berhasil dihapus dari kategori ' . $category->name . '.');
    }

    public function storeCategoryYesOrNo(Request $request, $categoryId)
    {
        if (Auth::user()->is_admin == 0) {
            return redirect('/dashboard');
        }

        $category = InvestmentCategory::findOrFail($categoryId);
        $request->validate([
            'question' => 'required|string|max:500',
            'correct_answer' => 'required|in:Yes,No',
            'explanation' => 'nullable|string|max:1000',
        ]);

        YesOrNoQuestion::create(array_merge($request->only(['question', 'correct_answer', 'explanation']), ['category_id' => $category->id]));

        return redirect()->back()->with('success', 'Pertanyaan yes or no berhasil ditambahkan untuk kategori ' . $category->name . '.');
    }

    public function updateCategoryYesOrNo(Request $request, $categoryId, $id)
    {
        if (Auth::user()->is_admin == 0) {
            return redirect('/dashboard');
        }

        $category = InvestmentCategory::findOrFail($categoryId);
        $question = YesOrNoQuestion::findOrFail($id);
        $request->validate([
            'question' => 'required|string|max:500',
            'correct_answer' => 'required|in:Yes,No',
            'explanation' => 'nullable|string|max:1000',
        ]);

        if ($question->category_id !== $category->id) {
            return redirect()->back()->with('error', 'Pertanyaan tidak ditemukan untuk kategori ini.');
        }

        $question->update($request->only(['question', 'correct_answer', 'explanation']));

        return redirect()->back()->with('success', 'Pertanyaan yes or no berhasil diperbarui untuk kategori ' . $category->name . '.');
    }

    public function deleteCategoryYesOrNo($categoryId, $id)
    {
        if (Auth::user()->is_admin == 0) {
            return redirect('/dashboard');
        }

        $category = InvestmentCategory::findOrFail($categoryId);
        $question = YesOrNoQuestion::findOrFail($id);

        if ($question->category_id !== $category->id) {
            return redirect()->back()->with('error', 'Pertanyaan tidak ditemukan untuk kategori ini.');
        }

        $question->delete();
        return redirect()->back()->with('success', 'Pertanyaan yes or no berhasil dihapus dari kategori ' . $category->name . '.');
    }
}
