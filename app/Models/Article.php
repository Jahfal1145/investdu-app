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
                  ->orWhere('content', 'like', "%{$query}%");
            });
        }

        $articles = $articlesQuery->latest()->get();

        return view('articles_list', compact('category', 'articles', 'query'));
    }

    public function categoryShow($slug, $articleSlug)
    {
        $category = InvestmentCategory::where('slug', $slug)->firstOrFail();
        $article  = Article::where('category_id', $category->id)
            ->where('slug', $articleSlug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('article_detail', compact('category', 'article'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        $c = $request->input('c', 'all'); 

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
    /**
     * User yang mem-bookmark artikel ini.
     */
    public function bookmarkers()
    {
        return $this->belongsToMany(User::class, 'article_user_bookmarks')
                    ->withTimestamps();
    }
}


