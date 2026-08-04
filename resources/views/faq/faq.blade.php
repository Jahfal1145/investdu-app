<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanya Jawab (FAQ) - InvestEdu</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-slate-900 text-white min-h-screen">

    <nav class="border-b border-slate-800 bg-slate-900/50 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-4xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="/" class="text-blue-500 font-bold text-xl flex items-center gap-2">
                &larr; Kembali ke Beranda
            </a>
            <span class="text-slate-400 font-medium">Komunitas > Tanya Jawab</span>
        </div>
    </nav>

    <header class="max-w-3xl mx-auto px-6 pt-16 pb-10 text-center">
        <div class="inline-block p-3 bg-blue-600/20 rounded-2xl text-blue-500 mb-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <h1 class="text-3xl md:text-5xl font-extrabold text-white mb-4">Pusat Bantuan & <span class="text-blue-500">FAQ</span></h1>
        <p class="text-slate-400 text-lg">Punya pertanyaan seputar InvestEdu atau investasi? Temukan jawabannya di sini.</p>
    </header>

    <main class="max-w-3xl mx-auto px-6 pb-24">
        <div class="bg-slate-800 rounded-2xl border border-slate-700 overflow-hidden shadow-xl">
            @forelse($faqs as $faq)
                <div class="border-b border-slate-700 last:border-0">
                    <button onclick="toggleFaq({{ $faq->id }})" class="w-full text-left px-6 py-5 flex justify-between items-center hover:bg-slate-700/50 transition-colors focus:outline-none group">
                        <h3 class="font-semibold text-lg text-slate-200 group-hover:text-blue-400 transition-colors pr-4">
                            {{ $faq->question }}
                        </h3>
                        <div class="shrink-0 p-1 bg-slate-700 rounded-full text-slate-400 group-hover:text-blue-400 group-hover:bg-blue-600/20 transition-all duration-300">
                            <svg id="arrow-{{ $faq->id }}" class="w-5 h-5 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </button>

                    <div id="answer-{{ $faq->id }}" class="hidden px-6 pb-6 pt-2">
                        <div class="p-4 bg-slate-900/50 rounded-xl border border-slate-700/50 text-slate-300 leading-relaxed">
                            {{ $faq->answer }}
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center text-slate-400">
                    Belum ada FAQ yang tersedia saat ini.
                </div>
            @endforelse
        </div>
    </main>

    <script>
        function toggleFaq(id) {
            // Ambil elemen jawaban dan ikon panah berdasarkan ID
            const answerBox = document.getElementById('answer-' + id);
            const arrowIcon = document.getElementById('arrow-' + id);

            // Cek apakah jawabannya sedang tersembunyi
            const isHidden = answerBox.classList.contains('hidden');

            // Tutup SEMUA accordion lain yang sedang terbuka (Opsional, biar rapi)
            document.querySelectorAll('[id^="answer-"]').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('[id^="arrow-"]').forEach(el => el.classList.remove('rotate-180'));

            // Kalau tadi tersembunyi, sekarang buka yang diklik saja
            if (isHidden) {
                answerBox.classList.remove('hidden');
                arrowIcon.classList.add('rotate-180'); // Putar panah ke atas
            }
        }
    </script>
</body>
</html>