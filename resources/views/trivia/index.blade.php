<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InvestEdu - Trivia Cuan</title>
    <!-- Kita pakai Tailwind CSS via CDN biar styling-nya instan rapi dan modern -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-slate-900 text-white min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-2xl bg-slate-800 rounded-2xl shadow-xl border border-slate-700 p-6">
        <!-- Header Game -->
        <div class="flex justify-between items-center border-b border-slate-700 pb-4 mb-6">
            <h1 class="text-xl font-bold text-cyan-400">🧠 Trivia Cuan</h1>
            <div class="bg-slate-700 px-3 py-1 rounded-full text-sm font-semibold text-slate-300">
                Soal: <span id="current-question-index">1</span>/<span id="total-questions-count">0</span>
            </div>
        </div>

        <!-- Area Loading -->
        <div id="loading-screen" class="text-center py-10">
            <p class="text-slate-400 animate-pulse">Mengambil soal dari REST API...</p>
        </div>

        <!-- Konten Game -->
        <div id="game-screen" class="hidden">
            <!-- Box Pertanyaan -->
            <div class="bg-slate-800 p-4 mb-6 text-lg font-medium leading-relaxed" id="question-text">
                Sedang memuat pertanyaan...
            </div>

            <!-- Opsi Jawaban (4 Tombol) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <button onclick="checkAnswer('A')" id="btn-A" class="w-full text-left bg-slate-700 hover:bg-slate-600 border border-slate-600 rounded-xl p-4 transition font-medium focus:outline-none">
                    <span class="text-cyan-400 font-bold mr-2">A.</span> <span id="text-A">Opsi A</span>
                </button>
                <button onclick="checkAnswer('B')" id="btn-B" class="w-full text-left bg-slate-700 hover:bg-slate-600 border border-slate-600 rounded-xl p-4 transition font-medium focus:outline-none">
                    <span class="text-cyan-400 font-bold mr-2">B.</span> <span id="text-B">Opsi B</span>
                </button>
                <button onclick="checkAnswer('C')" id="btn-C" class="w-full text-left bg-slate-700 hover:bg-slate-600 border border-slate-600 rounded-xl p-4 transition font-medium focus:outline-none">
                    <span class="text-cyan-400 font-bold mr-2">C.</span> <span id="text-C">Opsi C</span>
                </button>
                <button onclick="checkAnswer('D')" id="btn-D" class="w-full text-left bg-slate-700 hover:bg-slate-600 border border-slate-600 rounded-xl p-4 transition font-medium focus:outline-none">
                    <span class="text-cyan-400 font-bold mr-2">D.</span> <span id="text-D">Opsi D</span>
                </button>
            </div>

            <!-- Box Pembahasan / Penjelasan (Awalnya tersembunyi) -->
            <div id="explanation-box" class="hidden bg-cyan-950/40 border border-cyan-800/60 rounded-xl p-4 mb-6">
                <h4 class="text-cyan-400 font-bold text-sm mb-1">💡 PEMBAHASAN:</h4>
                <p id="explanation-text" class="text-sm text-slate-300 leading-relaxed"></p>
            </div>

            <!-- Tombol Lanjut -->
            <div class="flex justify-end">
                <button id="next-btn" onclick="nextQuestion()" class="hidden bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-bold px-6 py-2.5 rounded-xl transition cursor-pointer">
                    Soal Berikutnya →
                </button>
            </div>
        </div>

        <!-- Layar Skor Akhir -->
        <div id="score-screen" class="hidden text-center py-10">
            <h2 class="text-3xl font-extrabold text-cyan-400 mb-2">Game Selesai!</h2>
            <p class="text-slate-400 mb-6">Kerja bagus, investasi ilmu adalah aset terbaik!</p>
            <div class="inline-block bg-slate-700/50 border border-slate-600 px-8 py-4 rounded-2xl mb-8">
                <span class="block text-sm text-slate-400 uppercase tracking-wider font-semibold">Total Skor Anda</span>
                <span id="final-score" class="text-5xl font-black text-emerald-400">0</span>
            </div>
            <div>
                <a href="/trivia" class="bg-slate-700 hover:bg-slate-600 border border-slate-600 text-white font-bold px-6 py-3 rounded-xl transition inline-block">
                    Main Lagi
                </a>
            </div>
        </div>
    </div>

    <!-- LOGIKA JAVASCRIPT KONSUMSI REST API -->
    <script>
        let questionsList = [];
        let currentIndex = 0;
        let score = 0;
        let hasAnswered = false;

        // 1. Ambil Data dari REST API Laravel saat Halaman Terbuka
        document.addEventListener("DOMContentLoaded", () => {
            fetch('/api/trivia/questions')
                .then(response => response.json())
                .then(res => {
                    if(res.status === 'success' && res.data.length > 0) {
                        questionsList = res.data;
                        document.getElementById('total-questions-count').innerText = questionsList.length;
                        document.getElementById('loading-screen').classList.add('hidden');
                        document.getElementById('game-screen').classList.remove('hidden');
                        showQuestion();
                    } else {
                        document.getElementById('loading-screen').innerHTML = `<p class="text-rose-400 font-medium">Belum ada soal kuis di database.</p>`;
                    }
                })
                .catch(err => {
                    console.error(err);
                    document.getElementById('loading-screen').innerHTML = `<p class="text-rose-400 font-medium">Gagal memuat API data.</p>`;
                });
        });

        // 2. Tampilkan Pertanyaan Aktif
        function showQuestion() {
            hasAnswered = false;
            let q = questionsList[currentIndex];
            
            document.getElementById('current-question-index').innerText = currentIndex + 1;
            document.getElementById('question-text').innerText = q.question;
            document.getElementById('text-A').innerText = q.option_a;
            document.getElementById('text-B').innerText = q.option_b;
            document.getElementById('text-C').innerText = q.option_c;
            document.getElementById('text-D').innerText = q.option_d;

            // Reset warna tombol ke semula
            ['A', 'B', 'C', 'D'].forEach(opt => {
                let btn = document.getElementById(`btn-${opt}`);
                btn.className = "w-full text-left bg-slate-700 hover:bg-slate-600 border border-slate-600 rounded-xl p-4 transition font-medium focus:outline-none cursor-pointer";
            });

            document.getElementById('explanation-box').classList.add('hidden');
            document.getElementById('next-btn').classList.add('hidden');
        }

        // 3. Validasi Jawaban User
        function checkAnswer(userChoice) {
            if (hasAnswered) return; // Mencegah klik tombol ganda
            hasAnswered = true;

            let q = questionsList[currentIndex];
            let correct = q.correct_answer;

            // Warnai tombol pilihan user & kunci jawaban asli
            if (userChoice === correct) {
                document.getElementById(`btn-${userChoice}`).classList.add('!bg-emerald-900/80', '!border-emerald-500');
                score += 10; // Tambah poin jika benar
            } else {
                document.getElementById(`btn-${userChoice}`).classList.add('!bg-rose-900/80', '!border-rose-500');
                document.getElementById(`btn-${correct}`).classList.add('!bg-emerald-900/80', '!border-emerald-500');
            }

            // Tampilkan kotak penjelasan edukasi
            document.getElementById('explanation-text').innerText = q.explanation ? q.explanation : "Tidak ada pembahasan khusus.";
            document.getElementById('explanation-box').classList.remove('hidden');
            document.getElementById('next-btn').classList.remove('hidden');
        }

        // 4. Navigasi Soal / Selesai
        function nextQuestion() {
            if (currentIndex < questionsList.length - 1) {
                currentIndex++;
                showQuestion();
            } else {
                // Tampilkan layar skor akhir
                document.getElementById('game-screen').classList.add('hidden');
                document.getElementById('score-screen').classList.remove('hidden');
                document.getElementById('final-score').innerText = score;
            }
        }
    </script>
</body>
</html>