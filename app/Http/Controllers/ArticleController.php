<?php

namespace App\Http\Controllers;

use App\Models\InvestmentCategory;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * Tampilkan daftar artikel dalam satu kategori.
     */
    public function index(\Illuminate\Http\Request $request, $slug)
    {
        $category = InvestmentCategory::where('slug', $slug)->firstOrFail();
        $query = $request->input('q');

        $articlesQuery = Article::where('category_id', $category->id)
            ->where('is_published', true);

        if (!empty($query)) {
            $articlesQuery->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('excerpt', 'like', "%{$query}%")
                  ->orWhere('body', 'like', "%{$query}%");
            });
        }

        $articles = $articlesQuery->latest()->get();

        return view('articles_list', compact('category', 'articles', 'query'));
    }

    /**
     * Tampilkan detail satu artikel.
     */
    public function show($slug, $articleSlug)
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
    public function search(\Illuminate\Http\Request $request)
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
                      ->orWhere('body', 'like', "%{$query}%")
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
}
