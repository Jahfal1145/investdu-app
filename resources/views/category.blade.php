<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $category->name }} — Investdu</title>
    <meta name="description" content="Detail materi {{ $category->name }} di Investdu">
    <meta name="keywords" content="Investdu, {{ $category->name }}, investasi, edukasi">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])

    <style>
        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: #0F172A;
            color: #F8FAFC;
        }
        .page-shell {
            max-width: 980px;
            margin: 0 auto;
            padding: 3rem 1.5rem 4rem;
        }
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #60A5FA;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }
        .back-link:hover {
            color: #93C5FD;
        }
        .category-card {
            background-color: #1E293B;
            border: 1px solid rgba(71, 85, 105, 0.35);
            border-radius: 1.5rem;
            padding: 2rem;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.24);
        }
        .category-header {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-bottom: 2rem;
        }
        .category-badge {
            align-self: flex-start;
            padding: 0.55rem 1rem;
            border-radius: 999px;
            border: 1px solid rgba(212, 175, 55, 0.35);
            background-color: rgba(212, 175, 55, 0.1);
            color: #D4AF37;
            font-weight: 700;
            font-size: 0.9rem;
        }
        .category-title {
            font-size: clamp(2rem, 2.5vw, 3rem);
            margin: 0;
            line-height: 1.05;
        }
        .category-description {
            color: #CAD1E5;
            max-width: 720px;
            margin: 0;
            line-height: 1.7;
        }
        .category-meta {
            display: grid;
            gap: 1rem;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        }
        .meta-box {
            padding: 1.25rem 1.35rem;
            border-radius: 1rem;
            background: rgba(15, 23, 42, 0.88);
            border: 1px solid rgba(148, 163, 184, 0.15);
        }
        .meta-label {
            display: block;
            margin-bottom: 0.55rem;
            color: #94A3B8;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
        }
        .meta-value {
            font-size: 1rem;
            line-height: 1.75;
            color: #F8FAFC;
        }
        .learn-more {
            margin-top: 2rem;
            border-radius: 1rem;
            padding: 1.5rem;
            background: rgba(37, 99, 235, 0.08);
            border: 1px solid rgba(37, 99, 235, 0.18);
        }
        .learn-more h2 {
            margin: 0 0 0.75rem;
            font-size: 1.2rem;
        }
        .learn-more p {
            margin: 0;
            color: #CBD5E1;
            line-height: 1.7;
        }
        .start-button {
            margin-top: 2rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 1rem 1.5rem;
            border-radius: 1rem;
            border: none;
            background: #3B82F6;
            color: #fff;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.2s ease, background-color 0.2s ease;
        }
        .start-button:hover {
            background: #60A5FA;
            transform: translateY(-1px);
        }
        .modal-overlay,
        .loading-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.94);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            z-index: 50;
        }
        .modal-overlay.hidden,
        .loading-overlay.hidden {
            display: none;
        }
        .modal-content,
        .loading-card {
            width: min(100%, 540px);
            background: #111827;
            border: 1px solid rgba(148, 163, 184, 0.15);
            border-radius: 1.5rem;
            padding: 2rem;
            box-shadow: 0 32px 90px rgba(0, 0, 0, 0.35);
        }
        .modal-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            width: 2.5rem;
            height: 2.5rem;
            border: none;
            border-radius: 999px;
            background: rgba(148, 163, 184, 0.15);
            color: #E2E8F0;
            font-size: 1.1rem;
            cursor: pointer;
        }
        .modal-inner {
            position: relative;
        }
        .modal-content h2,
        .loading-card h2 {
            margin: 0;
            font-size: 1.7rem;
            color: #F8FAFC;
        }
        .modal-content p,
        .loading-card p {
            color: #CAD1E5;
            line-height: 1.8;
            margin-top: 0.75rem;
        }
        .modal-actions {
            display: grid;
            gap: 1rem;
            margin-top: 1.75rem;
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
        .game-btn {
            padding: 1rem 1.25rem;
            border-radius: 1rem;
            border: none;
            font-weight: 700;
            color: #fff;
            cursor: pointer;
            transition: transform 0.2s ease, opacity 0.2s ease;
        }
        .game-btn:hover {
            transform: translateY(-2px);
        }
        .game-btn.trivia {
            background: #2563EB;
        }
        .game-btn.yesno {
            background: #10B981;
        }
        .progress-bar {
            height: 0.85rem;
            background: rgba(148, 163, 184, 0.15);
            border-radius: 999px;
            overflow: hidden;
            margin: 1.5rem 0;
        }
        .progress-bar-fill {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, #38BDF8, #6366F1);
            transition: width 0.25s ease;
        }
        .countdown-text {
            margin: 0;
            color: #CBD5E1;
            font-size: 0.98rem;
        }
    </style>
</head>
<body>
    <main class="page-shell">
        <a href="{{ url('/') }}" class="back-link">← Kembali ke Beranda</a>

        <article class="category-card">
            @if($category->badge)
                <span class="category-badge">{{ $category->badge }}</span>
            @endif

            <header class="category-header">
                <h1 class="category-title">{{ $category->name }}</h1>
                <p class="category-description">{{ $category->description }}</p>
            </header>

            <div class="category-meta">
                <div class="meta-box">
                    <span class="meta-label">Slug</span>
                    <span class="meta-value">{{ $category->slug }}</span>
                </div>
                <div class="meta-box">
                    <span class="meta-label">Icon name</span>
                    <span class="meta-value">{{ $category->icon }}</span>
                </div>
            </div>

            <section class="learn-more">
                <h2>Apa yang bisa dipelajari?</h2>
                <p>Di halaman ini kamu bisa membaca informasi dasar dan memahami prinsip penting dari kategori investasi <strong>{{ $category->name }}</strong>. Nanti bisa ditambahkan modul, artikel, atau quiz spesifik untuk setiap kategori.</p>
            </section>

            <button id="start-learning-btn" class="start-button" type="button">Belajar Sekarang!</button>
        </article>
    </main>

    <div id="game-select-modal" class="modal-overlay hidden" aria-hidden="true">
        <div class="modal-content modal-inner">
            <button id="close-game-select" class="modal-close" type="button" aria-label="Tutup">×</button>
            <h2>Pilih permainan</h2>
            <p>Pilih jenis permainan yang kamu ingin coba untuk kategori <strong>{{ $category->name }}</strong>.</p>
            <div class="modal-actions">
                <button type="button" class="game-btn trivia" onclick="selectGame('trivia')">Trivia</button>
                <button type="button" class="game-btn yesno" onclick="selectGame('yes-or-no')">Yes, or No?</button>
            </div>
        </div>
    </div>

    <div id="game-loading-overlay" class="loading-overlay hidden" aria-hidden="true">
        <div class="loading-card">
            <h2>Menyiapkan game...</h2>
            <p id="loading-message">Tunggu sebentar, permainan akan dimulai segera.</p>
            <div class="progress-bar">
                <div id="loading-bar-fill" class="progress-bar-fill"></div>
            </div>
            <p class="countdown-text">Dimulai dalam <strong id="countdown-timer">3</strong> detik</p>
        </div>
    </div>

    <script>
        const startLearningBtn = document.getElementById('start-learning-btn');
        const gameSelectModal = document.getElementById('game-select-modal');
        const closeGameSelect = document.getElementById('close-game-select');
        const gameLoadingOverlay = document.getElementById('game-loading-overlay');
        const loadingMessage = document.getElementById('loading-message');
        const loadingBarFill = document.getElementById('loading-bar-fill');
        const countdownTimer = document.getElementById('countdown-timer');
        let countdownInterval;

        startLearningBtn.addEventListener('click', () => {
            gameSelectModal.classList.remove('hidden');
            gameSelectModal.setAttribute('aria-hidden', 'false');
        });

        closeGameSelect.addEventListener('click', () => {
            gameSelectModal.classList.add('hidden');
            gameSelectModal.setAttribute('aria-hidden', 'true');
        });

        window.addEventListener('click', (event) => {
            if (event.target === gameSelectModal) {
                gameSelectModal.classList.add('hidden');
                gameSelectModal.setAttribute('aria-hidden', 'true');
            }
        });

        function selectGame(game) {
            const label = game === 'trivia' ? 'Trivia' : 'Yes, or No?';
            gameSelectModal.classList.add('hidden');
            gameSelectModal.setAttribute('aria-hidden', 'true');
            loadingMessage.innerText = `Memuat ${label}...`;
            loadingBarFill.style.width = '0%';
            countdownTimer.innerText = '3';
            gameLoadingOverlay.classList.remove('hidden');
            gameLoadingOverlay.setAttribute('aria-hidden', 'false');

            let timeLeft = 3;
            let progress = 0;

            clearInterval(countdownInterval);
            countdownInterval = setInterval(() => {
                timeLeft -= 1;
                progress += 34;
                if (progress > 100) progress = 100;
                loadingBarFill.style.width = `${progress}%`;
                countdownTimer.innerText = timeLeft > 0 ? timeLeft : 0;

                if (timeLeft <= 0) {
                    clearInterval(countdownInterval);
                    window.location.href = game === 'trivia' ? '/trivia' : '/yes-or-no';
                }
            }, 1000);
        }
    </script>
</body>
</html>
