@extends('layouts.admin') {{-- Sesuaikan dengan layout admin utama yang kamu pakai --}}

@section('content')
<div class="p-6 text-white bg-slate-900 min-h-screen">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-blue-400">Manajemen FAQ</h2>
        <a href="/admin/faqs/create" class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-lg font-semibold transition">
            + Tambah FAQ Baru
        </a>
    </div>

    {{-- Pesan Sukses --}}
    @if(session('success'))
        <div class="bg-emerald-500/20 border border-emerald-500 text-emerald-400 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabel CRUD --}}
    <div class="bg-slate-800 rounded-xl overflow-hidden border border-slate-700">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-700/50 text-slate-300 border-b border-slate-700">
                    <th class="p-4 font-semibold">No</th>
                    <th class="p-4 font-semibold">Pertanyaan</th>
                    <th class="p-4 font-semibold">Jawaban</th>
                    <th class="p-4 font-semibold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-700">
                @foreach($faqs as $index => $faq)
                <tr class="hover:bg-slate-700/20 transition-colors">
                    <td class="p-4 text-slate-400">{{ $index + 1 }}</td>
                    <td class="p-4 font-medium text-slate-200">{{ $faq->question }}</td>
                    <td class="p-4 text-slate-400 text-sm">
                        {{ Str::limit($faq->answer, 50) }} {{-- Dibatasi 50 huruf biar tabel nggak kepanjangan --}}
                    </td>
                    <td class="p-4 flex justify-center gap-2">
                        <a href="/admin/faqs/{{ $faq->id }}/edit" class="bg-amber-500/20 text-amber-400 hover:bg-amber-500 hover:text-white px-3 py-1.5 rounded-lg text-sm transition">
                            Edit
                        </a>
                        <form action="/admin/faqs/{{ $faq->id }}/delete" method="POST" onsubmit="return confirm('Yakin ingin menghapus FAQ ini?');">
                            @csrf
                            <button type="submit" class="bg-rose-500/20 text-rose-400 hover:bg-rose-500 hover:text-white px-3 py-1.5 rounded-lg text-sm transition">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if($faqs->isEmpty())
            <div class="p-8 text-center text-slate-500">
                Belum ada data FAQ. Silakan tambah baru!
            </div>
        @endif
    </div>
</div>
@endsection