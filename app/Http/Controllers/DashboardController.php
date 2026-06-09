<?php

namespace App\Http\Controllers;

use App\Models\InvestmentCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $categories = InvestmentCategory::all();
        $activeSlug = $request->query('category');

        $activeCategory = null;
        $readArticles = collect();
        $bookmarkedArticles = collect();

        if ($activeSlug) {
            $activeCategory = InvestmentCategory::where('slug', $activeSlug)->first();
        }

        if ($activeCategory) {
            // Artikel yang dibaca di kategori ini
            $readArticles = $user->readArticles()
                ->where('category_id', $activeCategory->id)
                ->get();

            // Artikel yang di-bookmark di kategori ini
            $bookmarkedArticles = $user->bookmarkedArticles()
                ->where('category_id', $activeCategory->id)
                ->get();
        } else {
            // Halaman utama: tampilkan semua artikel terakhir dibaca
            $readArticles = $user->readArticles()
                ->with('category')
                ->take(10)
                ->get();

            $bookmarkedArticles = $user->bookmarkedArticles()
                ->with('category')
                ->take(10)
                ->get();
        }

        return view('dashboard', compact(
            'user',
            'categories',
            'activeCategory',
            'activeSlug',
            'readArticles',
            'bookmarkedArticles'
        ));
    }

    public function toggleBookmark(Request $request, $articleId)
    {
        $user = Auth::user();

        if ($user->bookmarkedArticles()->where('article_id', $articleId)->exists()) {
            $user->bookmarkedArticles()->detach($articleId);
            $message = 'Bookmark dihapus.';
        } else {
            $user->bookmarkedArticles()->attach($articleId);
            $message = 'Artikel di-bookmark!';
        }

        return redirect()->back()->with('success', $message);
    }
}
