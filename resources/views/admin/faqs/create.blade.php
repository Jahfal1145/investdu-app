@extends('layouts.admin')

@section('content')
<div class="p-6 text-white min-h-screen">
    <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-blue-400">Tambah FAQ Baru</h2>
            <p class="text-sm text-slate-400">Isi pertanyaan dan jawaban yang ingin ditampilkan di halaman publik.</p>
        </div>
        <a href="/admin/faqs" class="inline-flex items-center justify-center bg-slate-700 hover:bg-slate-600 text-white px-4 py-2 rounded-lg font-semibold transition">
            ← Kembali
        </a>
    </div>

    <form action="/admin/faqs" method="POST" class="bg-slate-800 border border-slate-700 rounded-xl p-6 space-y-5">
        @csrf

        <div>
            <label for="question" class="block text-sm font-medium text-slate-300 mb-2">Pertanyaan</label>
            <input type="text" id="question" name="question" value="{{ old('question') }}" required class="w-full rounded-lg border border-slate-600 bg-slate-900 px-4 py-3 text-white focus:border-blue-500 focus:outline-none">
            @error('question')
                <p class="mt-2 text-sm text-rose-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="answer" class="block text-sm font-medium text-slate-300 mb-2">Jawaban</label>
            <textarea id="answer" name="answer" rows="6" required class="w-full rounded-lg border border-slate-600 bg-slate-900 px-4 py-3 text-white focus:border-blue-500 focus:outline-none">{{ old('answer') }}</textarea>
            @error('answer')
                <p class="mt-2 text-sm text-rose-400">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end gap-3">
            <a href="/admin/faqs" class="px-4 py-2 rounded-lg bg-slate-700 hover:bg-slate-600 text-white transition">Batal</a>
            <button type="submit" class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-500 text-white transition">Simpan FAQ</button>
        </div>
    </form>
</div>
@endsection
