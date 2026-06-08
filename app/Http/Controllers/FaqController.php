<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FaqController extends Controller
{
    private function ensureAdmin(): void
    {
        if (! Auth::check() || ! Auth::user()->is_admin) {
            abort(403);
        }
    }

    public function publicIndex()
    {
        $faqs = Faq::orderBy('created_at', 'desc')->get();

        return view('faq.faq', compact('faqs'));
    }

    public function index()
    {
        $this->ensureAdmin();

        $faqs = Faq::orderBy('created_at', 'desc')->get();

        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        $this->ensureAdmin();

        return view('admin.faqs.create');
    }

    public function store(Request $request)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        Faq::create($validated);

        return redirect('/admin/faqs')->with('success', 'FAQ berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $this->ensureAdmin();

        $faq = Faq::findOrFail($id);

        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(Request $request, $id)
    {
        $this->ensureAdmin();

        $faq = Faq::findOrFail($id);

        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        $faq->update($validated);

        return redirect('/admin/faqs')->with('success', 'FAQ berhasil diupdate!');
    }

    public function destroy($id)
    {
        $this->ensureAdmin();

        Faq::findOrFail($id)->delete();

        return redirect('/admin/faqs')->with('success', 'FAQ berhasil dihapus!');
    }
}