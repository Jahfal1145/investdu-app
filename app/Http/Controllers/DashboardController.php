<?php

namespace App\Http\Controllers;

use App\Models\InvestmentCategory;
use App\Models\UserScore;
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

            $gameScores = $user->scores()
                ->with('category')
                ->where('category_id', $activeCategory->id)
                ->orderBy('created_at', 'desc')
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

            $gameScores = $user->scores()
                ->with('category')
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get();
        }

        return view('dashboard', compact(
            'user',
            'categories',
            'activeCategory',
            'activeSlug',
            'readArticles',
            'bookmarkedArticles',
            'gameScores'
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

    public function saveScore(Request $request)
    {
        $request->validate([
            'game_type' => 'required|string|in:trivia,yes_or_no',
            'category_id' => 'nullable|exists:investment_categories,id',
            'score' => 'required|integer',
            'correct_answers' => 'required|integer',
            'total_questions' => 'required|integer',
        ]);

        $user = Auth::user();

        UserScore::create([
            'user_id' => $user->id,
            'game_type' => $request->game_type,
            'category_id' => $request->category_id,
            'score' => $request->score,
            'correct_answers' => $request->correct_answers,
            'total_questions' => $request->total_questions,
        ]);

        return response()->json(['status' => 'success']);
    }
}
