<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\InvestmentCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * ==========================================
     * AREA ADMIN (Manajemen CRUD)
     * ==========================================
     */
    private function ensureAdmin(): void
    {
        if (! Auth::check() || ! Auth::user()->is_admin) {
            abort(403);
        }
    }

    public function index()
    {
        $this->ensureAdmin();

        $articles = Article::orderByDesc('created_at')->get();

        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $this->ensureAdmin();

        // Pastikan Anda juga mengirim data kategori ke view create jika formnya butuh dropdown kategori
        // $categories = InvestmentCategory::all();
        // return view('admin.articles.create', compact('categories'));
        
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'image_url' => 'nullable|string|max:255',
            'is_published' => 'nullable|boolean',
            // Pastikan input category_id ditambahkan di form admin kamu
            // 'category_id' => 'required|exists:investment_categories,id', 
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_published'] = $request->boolean('is_published');
        $validated['published_at'] = $validated['is_published'] ? now() : null;

        Article::create($validated);

        return redirect('/admin/articles')->with('success', 'Artikel berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $this->ensureAdmin();

        $article = Article::findOrFail($id);

        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, string $id)
    {
        $this->ensureAdmin();

        $article = Article::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'image_url' => 'nullable|string|max:255',
            'is_published' => 'nullable|boolean',
            // 'category_id' => 'required|exists:investment_categories,id',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_published'] = $request->boolean('is_published');

        if ($validated['is_published'] && ! $article->is_published) {
            $validated['published_at'] = now();
        } elseif (! $validated['is_published']) {
            $validated['published_at'] = null;
        }

        $article->update($validated);

        return redirect('/admin/articles')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $this->ensureAdmin();

        Article::findOrFail($id)->delete();

        return redirect('/admin/articles')->with('success', 'Artikel berhasil dihapus!');
    }

    /**
     * ==========================================
     * AREA PUBLIK (Blog & Pencarian)
     * ==========================================
     */
    public function publicIndex()
    {
        $articles = Article::where('is_published', true)
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->get();

        return view('blog.index', compact('articles'));
    }

    public function publicShow(string $slug)
    {
        $article = Article::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('blog.show', compact('article'));
    }

    /**
     * Tampilkan daftar artikel dalam satu kategori spesifik.
     */
    public function categoryIndex(Request $request, $slug)
    {
        $category = InvestmentCategory::where('slug', $slug)->firstOrFail();
        $query = $request->input('q');

        $articlesQuery = Article::where('category_id', $category->id)
            ->where('is_published', true);

        if (!empty($query)) {
            $articlesQuery->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('excerpt', 'like', "%{$query}%")
                  ->orWhere('content', 'like', "%{$query}%"); // Disesuaikan dari 'body' menjadi 'content'
            });
        }

        $articles = $articlesQuery->latest()->get();

        return view('articles_list', compact('category', 'articles', 'query'));
    }

    /**
     * Tampilkan detail satu artikel berdasarkan kategori.
     */
    public function categoryShow($slug, $articleSlug)
    {
        $category = InvestmentCategory::where('slug', $slug)->firstOrFail();
        $article  = Article::where('category_id', $category->id)
            ->where('slug', $articleSlug)
            ->where('is_published', true)
            ->firstOrFail();

        // Track read history untuk user yang login
        if (\Illuminate\Support\Facades\Auth::check()) {
            $user = \Illuminate\Support\Facades\Auth::user();
            $user->readArticles()->syncWithoutDetaching([
                $article->id => ['read_at' => now()],
            ]);
        }

        // Cek apakah sudah di-bookmark
        $isBookmarked = false;
        if (\Illuminate\Support\Facades\Auth::check()) {
            $isBookmarked = \Illuminate\Support\Facades\Auth::user()
                ->bookmarkedArticles()
                ->where('article_id', $article->id)
                ->exists();
        }

        return view('article_detail', compact('category', 'article', 'isBookmarked'));
    }

    /**
     * Pencarian pintar artikel berdasarkan judul, excerpt, isi, dan info kategori.
     */
    public function search(Request $request)
    {
        $query = $request->input('q');
        $c = $request->input('c', 'all'); // parameter c untuk multi filter kategori (comma-separated slugs)

        if (empty($query)) {
            $articles = collect();
        } else {
            $articlesQuery = Article::with('category')
                ->where('is_published', true)
                ->where(function ($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                      ->orWhere('excerpt', 'like', "%{$query}%")
                      ->orWhere('content', 'like', "%{$query}%")
                      ->orWhereHas('category', function ($subQ) use ($query) {
                          $subQ->where('name', 'like', "%{$query}%")
                               ->orWhere('description', 'like', "%{$query}%");
                      });
                });

            if (!empty($c) && $c !== 'all') {
                $categorySlugs = explode(',', $c);
                $articlesQuery->whereHas('category', function ($q) use ($categorySlugs) {
                    $q->whereIn('slug', $categorySlugs);
                });
            }

            $articles = $articlesQuery->latest()->get();
        }

        return view('search_results', compact('articles', 'query', 'c'));
    }

    /**
     * ==========================================
     * AREA API (Mobile / React Frontend)
     * ==========================================
     */
    public function apiIndex()
    {
        $articles = Article::where('is_published', true)
            ->orderByDesc('published_at')
            ->get(['id', 'title', 'slug', 'excerpt', 'image_url', 'published_at']);

        return response()->json($articles);
    }

    public function apiShow(string $slug)
    {
        $article = Article::where('slug', $slug)
            ->where('is_published', true)
            ->first();

        if (! $article) {
            return response()->json(['message' => 'Artikel tidak ditemukan'], 404);
        }

        return response()->json($article);
    }
}