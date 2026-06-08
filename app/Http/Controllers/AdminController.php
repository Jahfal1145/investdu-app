<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\InvestmentCategory;
use App\Models\TriviaQuestion;
use App\Models\YesOrNoQuestion;
use App\Models\ChatRoom;
use App\Models\Message;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

        return view('admin.admin_dashboard', compact('totalUsers', 'recentUsers'));
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

        return view('admin.admin_users', compact('users'));
    }

    // Fungsi Menampilkan Halaman Form Edit
    public function edit($id)
    {
        if (Auth::user()->is_admin == 0) return redirect('/dashboard');
        
        $user = User::findOrFail($id);
        return view('admin.edit_user', compact('user'));
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
        return view('admin.admin_literasi', compact('categories'));
    }

    public function literasiEdit($id)
    {
        if (Auth::user()->is_admin == 0) {
            return redirect('/dashboard');
        }

        $category = InvestmentCategory::findOrFail($id);
        return view('admin.edit_literasi', compact('category'));
    }

    public function forumDiskusi(Request $request)
    {
        if (Auth::user()->is_admin == 0) {
            return redirect('/dashboard');
        }

        $generalRoom = ChatRoom::firstOrCreate(
            ['name' => 'General Chat'],
            ['type' => 'group']
        );

        $roomId = $request->query('room_id');
        $room = $generalRoom;

        if ($roomId && $roomId != $generalRoom->id) {
            $candidate = ChatRoom::find($roomId);
            if ($candidate && ($candidate->type !== 'private' || $candidate->participants()->where('user_id', Auth::id())->exists())) {
                $room = $candidate;
            }
        }

        if ($room->type === 'private' && ! $room->participants()->where('user_id', Auth::id())->exists()) {
            $room = $generalRoom;
        }

        $onlineUserIds = DB::table('sessions')
            ->whereNotNull('user_id')
            ->where('last_activity', '>=', now()->subMinutes(5)->timestamp)
            ->pluck('user_id')
            ->unique()
            ->toArray();

        if ($room->type === 'private') {
            $participants = $room->participants()->select('users.id', 'users.username', 'users.is_admin')->get();
        } else {
            $participants = User::select('id', 'username', 'is_admin')->get();
        }

        $participants = $participants
            ->map(function ($user) use ($onlineUserIds) {
                $user->online = in_array($user->id, $onlineUserIds, true);
                return $user;
            })
            ->sort(function ($a, $b) {
                if ($a->online === $b->online) {
                    return strcasecmp($a->username, $b->username);
                }
                return $a->online ? -1 : 1;
            })
            ->values();

        $messages = Message::with('user')
            ->where('chat_room_id', $room->id)
            ->orderBy('created_at')
            ->get();

        $roomName = $room->type === 'private' ? 'Private Chat' : 'General Chat';
        $roomSubtitle = $room->type === 'private'
            ? 'Chat pribadi dengan ' . $participants->where('id', '!=', Auth::id())->first()?->username
            : 'Semua peserta dapat melihat pesan ini';

        return view('admin.forum_diskusi', compact('participants', 'messages', 'room', 'roomName', 'roomSubtitle'));
    }

    public function chatUser($id)
    {
        if (Auth::user()->is_admin == 0) {
            return redirect('/dashboard');
        }

        $user = User::findOrFail($id);
        $admin = Auth::user();
        $room = ChatRoom::privateRoom($user->id, $admin->id);

        return redirect('/admin/forum-diskusi?room_id=' . $room->id);
    }

    public function storeForumMessage(Request $request)
    {
        if (Auth::user()->is_admin == 0) {
            return redirect('/dashboard');
        }

        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $room = ChatRoom::firstOrCreate(
            ['name' => 'General Chat'],
            ['type' => 'group']
        );

        Message::create([
            'chat_room_id' => $room->id,
            'user_id' => Auth::id(),
            'body' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Pesan berhasil dikirim.');
    }

    public function deleteForumMessage(Message $message)
    {
        if (Auth::user()->is_admin == 0) {
            return redirect('/dashboard');
        }

        $message->delete();

        return redirect()->back()->with('success', 'Pesan berhasil dihapus.');
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
        return view('admin.admin_monitor_game', compact('categories'));
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

    // ==========================================
    // KELOLA ARTIKEL
    // ==========================================

    public function articlesIndex()
    {
        if (Auth::user()->is_admin == 0) {
            return redirect('/dashboard');
        }

        $categories = InvestmentCategory::with(['articles' => function ($q) {
            $q->latest();
        }])->get();

        return view('admin.admin_articles', compact('categories'));
    }

    public function articleCreate($categoryId)
    {
        if (Auth::user()->is_admin == 0) {
            return redirect('/dashboard');
        }

        $category = InvestmentCategory::findOrFail($categoryId);
        return view('admin.admin_article_form', compact('category'));
    }

    public function articleStore(Request $request, $categoryId)
    {
        if (Auth::user()->is_admin == 0) {
            return redirect('/dashboard');
        }

        $category = InvestmentCategory::findOrFail($categoryId);

        $request->validate([
            'title'        => 'required|string|max:255',
            'excerpt'      => 'nullable|string|max:500',
            'body'         => 'required|string',
            'thumbnail'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_published' => 'nullable|boolean',
        ]);

        $slug = Str::slug($request->title);

        // Pastikan slug unik dalam kategori
        $originalSlug = $slug;
        $counter = 1;
        while (Article::where('category_id', $category->id)->where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('articles', 'public');
        }

        Article::create([
            'category_id'  => $category->id,
            'title'        => $request->title,
            'slug'         => $slug,
            'excerpt'      => $request->excerpt,
            'body'         => $request->body,
            'thumbnail'    => $thumbnailPath,
            'is_published' => $request->has('is_published') ? true : false,
        ]);

        return redirect('/admin/articles')->with('success', 'Artikel berhasil ditambahkan ke kategori ' . $category->name . '!');
    }

    public function articleEdit($id)
    {
        if (Auth::user()->is_admin == 0) {
            return redirect('/dashboard');
        }

        $article = Article::with('category')->findOrFail($id);
        $category = $article->category;

        return view('admin.admin_article_form', compact('article', 'category'));
    }

    public function articleUpdate(Request $request, $id)
    {
        if (Auth::user()->is_admin == 0) {
            return redirect('/dashboard');
        }

        $article = Article::findOrFail($id);

        $request->validate([
            'title'        => 'required|string|max:255',
            'excerpt'      => 'nullable|string|max:500',
            'body'         => 'required|string',
            'thumbnail'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_published' => 'nullable|boolean',
        ]);

        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $counter = 1;
        while (Article::where('category_id', $article->category_id)->where('slug', $slug)->where('id', '!=', $article->id)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        if ($request->hasFile('thumbnail')) {
            $article->thumbnail = $request->file('thumbnail')->store('articles', 'public');
        }

        $article->title        = $request->title;
        $article->slug         = $slug;
        $article->excerpt      = $request->excerpt;
        $article->body         = $request->body;
        $article->is_published = $request->has('is_published') ? true : false;
        $article->save();

        return redirect('/admin/articles')->with('success', 'Artikel "' . $article->title . '" berhasil diperbarui!');
    }

    public function articleDelete($id)
    {
        if (Auth::user()->is_admin == 0) {
            return redirect('/dashboard');
        }

        $article = Article::findOrFail($id);
        $title = $article->title;
        $article->delete();

        return redirect('/admin/articles')->with('success', 'Artikel "' . $title . '" berhasil dihapus!');
    }
}
