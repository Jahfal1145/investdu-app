<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz {{ $category->name }} — Investdu</title>
    <meta name="description" content="Uji pengetahuan investasi Anda tentang {{ $category->name }} dengan quiz interaktif di Investdu.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])

    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        html {
            scroll-behavior: smooth;
            -webkit-font-smoothing: antialiased;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: #0F172A;
            color: #F8FAFC;
            line-height: 1.6;
            overflow-x: hidden;
            min-height: 100vh;
        }

        ::selection {
            background-color: rgba(37, 99, 235, 0.35);
            color: #F8FAFC;
        }

        a { text-decoration: none; color: inherit; }

        /* ===== NAVBAR ===== */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(20px) saturate(180%);
            background-color: rgba(15, 23, 42, 0.85);
            border-bottom: 1px solid rgba(71, 85, 105, 0.25);
        }

        .navbar-inner {
            max-width: 1280px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            height: 64px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.625rem;
            font-size: 1.25rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            color: #F8FAFC;
        }

        .logo-icon { width: 32px; height: 32px; border-radius: 8px; }
        .logo .gold { color: #D4AF37; }

        .nav-right-actions {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-back {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 0.625rem;
            background: rgba(30, 41, 59, 0.5);
            border: 1px solid rgba(71, 85, 105, 0.3);
            color: #CBD5E1;
            font-size: 0.8125rem;
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
        }

        .nav-back:hover {
            color: #F8FAFC;
            background: rgba(37, 99, 235, 0.12);
            border-color: rgba(37, 99, 235, 0.4);
        }

        .nav-back svg { width: 16px; height: 16px; }

        /* ===== QUIZ CONTAINER ===== */
        .quiz-wrapper {
            max-width: 720px;
            margin: 0 auto;
            padding: 2.5rem 2rem 5rem;
        }

        /* ===== HEADER ===== */
        .quiz-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
        }

        .quiz-header-left {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .quiz-icon {
            width: 48px;
            height: 48px;
            border-radius: 0.75rem;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.2), rgba(212, 175, 55, 0.15));
            border: 1px solid rgba(37, 99, 235, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.375rem;
        }

        .quiz-title {
            font-size: 1.25rem;
            font-weight: 800;
            letter-spacing: -0.02em;
        }

        .quiz-subtitle {
            font-size: 0.8125rem;
            color: #64748B;
            font-weight: 500;
        }

        .quiz-score-badge {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 700;
            color: #10B981;
        }

        /* ===== PROGRESS BAR ===== */
        .progress-container {
            margin-bottom: 2rem;
        }

        .progress-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            font-size: 0.8125rem;
            color: #64748B;
            font-weight: 500;
        }

        .progress-bar-bg {
            width: 100%;
            height: 8px;
            background: rgba(30, 41, 59, 0.8);
            border-radius: 9999px;
            overflow: hidden;
        }

        .progress-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, #2563EB, #60A5FA);
            border-radius: 9999px;
            transition: width 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ===== QUESTION CARD ===== */
        .question-card {
            background: #1E293B;
            border: 1px solid rgba(71, 85, 105, 0.3);
            border-radius: 1.25rem;
            padding: 2rem;
            margin-bottom: 1.5rem;
            position: relative;
            overflow: hidden;
        }

        .question-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #2563EB, #D4AF37);
        }

        .question-type-tag {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.3125rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.6875rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 1rem;
        }

        .tag-trivia {
            background: rgba(37, 99, 235, 0.15);
            border: 1px solid rgba(37, 99, 235, 0.35);
            color: #60A5FA;
        }

        .tag-yesno {
            background: rgba(212, 175, 55, 0.12);
            border: 1px solid rgba(212, 175, 55, 0.35);
            color: #D4AF37;
        }

        .question-text {
            font-size: 1.125rem;
            font-weight: 600;
            line-height: 1.6;
            color: #F8FAFC;
            margin-bottom: 1.5rem;
        }

        /* ===== OPTION BUTTONS ===== */
        .options-grid {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .option-btn {
            display: flex;
            align-items: center;
            gap: 0.875rem;
            width: 100%;
            padding: 1rem 1.25rem;
            background: rgba(15, 23, 42, 0.6);
            border: 1.5px solid rgba(71, 85, 105, 0.35);
            border-radius: 0.875rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: left;
            color: #CBD5E1;
            font-family: 'Inter', sans-serif;
            font-size: 0.9375rem;
            font-weight: 500;
            outline: none;
        }

        .option-btn:hover:not(:disabled) {
            border-color: rgba(37, 99, 235, 0.5);
            background: rgba(37, 99, 235, 0.06);
            color: #F8FAFC;
            transform: translateX(4px);
        }

        .option-btn:disabled {
            cursor: default;
        }

        .option-letter {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: rgba(71, 85, 105, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.8125rem;
            color: #94A3B8;
            flex-shrink: 0;
            transition: all 0.3s ease;
        }

        .option-btn:hover:not(:disabled) .option-letter {
            background: rgba(37, 99, 235, 0.2);
            color: #60A5FA;
        }

        .option-btn.correct {
            border-color: #10B981 !important;
            background: rgba(16, 185, 129, 0.1) !important;
            color: #F8FAFC !important;
        }

        .option-btn.correct .option-letter {
            background: rgba(16, 185, 129, 0.3) !important;
            color: #10B981 !important;
        }

        .option-btn.wrong {
            border-color: #EF4444 !important;
            background: rgba(239, 68, 68, 0.1) !important;
            color: #F8FAFC !important;
        }

        .option-btn.wrong .option-letter {
            background: rgba(239, 68, 68, 0.3) !important;
            color: #EF4444 !important;
        }

        /* ===== YES / NO BUTTONS ===== */
        .yesno-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .yesno-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.625rem;
            padding: 1.125rem 1.5rem;
            border-radius: 0.875rem;
            border: 1.5px solid rgba(71, 85, 105, 0.35);
            background: rgba(15, 23, 42, 0.6);
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            color: #CBD5E1;
            outline: none;
        }

        .yesno-btn:hover:not(:disabled) {
            transform: translateY(-3px);
        }

        .yesno-btn:disabled { cursor: default; }

        .yesno-btn.btn-yes:hover:not(:disabled) {
            border-color: rgba(16, 185, 129, 0.5);
            background: rgba(16, 185, 129, 0.08);
            color: #10B981;
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.15);
        }

        .yesno-btn.btn-no:hover:not(:disabled) {
            border-color: rgba(239, 68, 68, 0.5);
            background: rgba(239, 68, 68, 0.08);
            color: #EF4444;
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.15);
        }

        .yesno-btn.correct {
            border-color: #10B981 !important;
            background: rgba(16, 185, 129, 0.12) !important;
            color: #10B981 !important;
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.15) !important;
        }

        .yesno-btn.wrong {
            border-color: #EF4444 !important;
            background: rgba(239, 68, 68, 0.12) !important;
            color: #EF4444 !important;
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.15) !important;
        }

        .yesno-icon { font-size: 1.25rem; }

        /* ===== EXPLANATION BOX ===== */
        .explanation-box {
            padding: 1.25rem 1.5rem;
            background: rgba(37, 99, 235, 0.06);
            border: 1px solid rgba(37, 99, 235, 0.2);
            border-radius: 0.875rem;
            margin-bottom: 1.5rem;
            display: none;
        }

        .explanation-box.show { display: block; animation: fadeIn 0.4s ease; }

        .explanation-label {
            display: flex;
            align-items: center;
            gap: 0.375rem;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #60A5FA;
            margin-bottom: 0.5rem;
        }

        .explanation-text {
            font-size: 0.875rem;
            color: #94A3B8;
            line-height: 1.7;
        }

        /* ===== NEXT BUTTON ===== */
        .next-btn {
            display: none;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
            padding: 1rem;
            background: #2563EB;
            border: none;
            border-radius: 0.875rem;
            color: #fff;
            font-family: 'Inter', sans-serif;
            font-size: 0.9375rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .next-btn.show { display: flex; animation: fadeIn 0.3s ease; }

        .next-btn:hover {
            background: #3B82F6;
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.35);
            transform: translateY(-2px);
        }

        .next-btn svg { width: 18px; height: 18px; }

        /* ===== LOADING ===== */
        .loading-screen {
            text-align: center;
            padding: 5rem 2rem;
        }

        .loading-spinner {
            width: 48px;
            height: 48px;
            border: 3px solid rgba(71, 85, 105, 0.3);
            border-top-color: #2563EB;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            margin: 0 auto 1.5rem;
        }

        .loading-text {
            color: #64748B;
            font-size: 0.9375rem;
        }

        /* ===== SCORE SCREEN ===== */
        .score-screen {
            display: none;
            text-align: center;
            padding: 3rem 2rem;
        }

        .score-screen.show { display: block; animation: fadeIn 0.5s ease; }

        .score-emoji { font-size: 4rem; margin-bottom: 1.5rem; }

        .score-title {
            font-size: 2rem;
            font-weight: 900;
            letter-spacing: -0.04em;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, #60A5FA, #D4AF37);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .score-subtitle {
            font-size: 1rem;
            color: #94A3B8;
            margin-bottom: 2rem;
        }

        .score-box {
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            padding: 1.5rem 3rem;
            background: rgba(30, 41, 59, 0.6);
            border: 1px solid rgba(71, 85, 105, 0.3);
            border-radius: 1rem;
            margin-bottom: 2rem;
        }

        .score-label {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #64748B;
            margin-bottom: 0.25rem;
        }

        .score-value {
            font-size: 3.5rem;
            font-weight: 900;
            letter-spacing: -0.04em;
            color: #10B981;
        }

        .score-detail {
            font-size: 0.875rem;
            color: #64748B;
            margin-top: 0.25rem;
        }

        .score-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.8125rem 1.5rem;
            border-radius: 0.75rem;
            font-size: 0.875rem;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
        }

        .btn-primary {
            background: #2563EB;
            color: #fff;
        }

        .btn-primary:hover {
            background: #3B82F6;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.3);
        }

        .btn-secondary {
            background: rgba(30, 41, 59, 0.5);
            border: 1px solid rgba(71, 85, 105, 0.3);
            color: #CBD5E1;
        }

        .btn-secondary:hover {
            background: rgba(37, 99, 235, 0.12);
            border-color: rgba(37, 99, 235, 0.4);
            color: #F8FAFC;
            transform: translateY(-2px);
        }

        /* ===== EMPTY STATE ===== */
        .empty-state {
            text-align: center;
            padding: 5rem 2rem;
            display: none;
        }

        .empty-state.show { display: block; }

        .empty-icon { font-size: 4rem; margin-bottom: 1.5rem; opacity: 0.5; }

        .empty-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #CBD5E1;
            margin-bottom: 0.5rem;
        }

        .empty-desc {
            font-size: 0.9375rem;
            color: #64748B;
            max-width: 400px;
            margin: 0 auto 2rem;
            line-height: 1.6;
        }

        /* ===== FOOTER ===== */
        .footer {
            border-top: 1px solid rgba(71, 85, 105, 0.2);
            background: rgba(15, 23, 42, 0.6);
        }

        .footer-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: 1.75rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .footer-brand { font-size: 1rem; font-weight: 700; color: #475569; }
        .footer-brand .gold { color: #D4AF37; }
        .footer-copy { font-size: 0.8125rem; color: #475569; }

        /* ===== ANIMATIONS ===== */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .navbar-inner { padding: 0 1.25rem; }
            .quiz-wrapper { padding: 1.5rem 1.25rem 4rem; }
            .quiz-header { flex-direction: column; align-items: flex-start; gap: 1rem; }
            .question-card { padding: 1.5rem; }
            .yesno-grid { grid-template-columns: 1fr; }
            .score-actions { flex-direction: column; }
            .btn-action { width: 100%; justify-content: center; }
            .footer-inner {
                flex-direction: column;
                gap: 0.75rem;
                text-align: center;
            }
        }
    </style>
</head>
<body>

    {{-- NAVBAR --}}
    <nav class="navbar">
        <div class="navbar-inner">
            <a href="/" class="logo">
                <svg class="logo-icon" viewBox="0 0 34 34" fill="none">
                    <rect width="34" height="34" rx="9" fill="#2563EB"/>
                    <path d="M9 24L14 12L18 19L23 10L25 15" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <circle cx="25" cy="15" r="2.2" fill="#D4AF37"/>
                </svg>
                INVEST<span class="gold">DU</span>
            </a>
            <div class="nav-right-actions">
                <button onclick="history.back()" class="nav-back">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M10 12L6 8L10 4"/></svg>
                    Kembali
                </button>
                <a href="/" class="nav-back">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 8l6-5 6 5"/><path d="M4 8v5.5h3V11h2v2.5h3V8"/></svg>
                    Beranda
                </a>
            </div>
        </div>
    </nav>

    {{-- QUIZ AREA --}}
    <div class="quiz-wrapper">

        {{-- HEADER --}}
        <div class="quiz-header">
            <div class="quiz-header-left">
                <div class="quiz-icon">🧠</div>
                <div>
                    <div class="quiz-title">Quiz {{ $category->name }}</div>
                    <div class="quiz-subtitle">Uji pengetahuan investasi Anda</div>
                </div>
            </div>
            <div class="quiz-score-badge" id="scoreBadge">
                ⭐ Skor: <span id="liveScore">0</span>
            </div>
        </div>

        {{-- PROGRESS BAR --}}
        <div class="progress-container" id="progressContainer">
            <div class="progress-info">
                <span>Soal <span id="currentNum">1</span> dari <span id="totalNum">0</span></span>
                <span id="progressPercent">0%</span>
            </div>
            <div class="progress-bar-bg">
                <div class="progress-bar-fill" id="progressFill" style="width: 0%"></div>
            </div>
        </div>

        {{-- LOADING --}}
        <div class="loading-screen" id="loadingScreen">
            <div class="loading-spinner"></div>
            <p class="loading-text">Memuat soal quiz {{ $category->name }}...</p>
        </div>

        {{-- QUESTION CARD --}}
        <div id="gameScreen" style="display: none;">
            <div class="question-card">
                <div class="question-type-tag tag-trivia" id="questionTag">
                    <span>📝</span> PILIHAN GANDA
                </div>
                <h2 class="question-text" id="questionText">Memuat pertanyaan...</h2>

                {{-- Trivia Options --}}
                <div class="options-grid" id="triviaOptions">
                    <button class="option-btn" onclick="selectAnswer('A')" id="optA">
                        <span class="option-letter">A</span>
                        <span id="textA">Opsi A</span>
                    </button>
                    <button class="option-btn" onclick="selectAnswer('B')" id="optB">
                        <span class="option-letter">B</span>
                        <span id="textB">Opsi B</span>
                    </button>
                    <button class="option-btn" onclick="selectAnswer('C')" id="optC">
                        <span class="option-letter">C</span>
                        <span id="textC">Opsi C</span>
                    </button>
                    <button class="option-btn" onclick="selectAnswer('D')" id="optD">
                        <span class="option-letter">D</span>
                        <span id="textD">Opsi D</span>
                    </button>
                </div>

                {{-- Yes/No Options --}}
                <div class="yesno-grid" id="yesnoOptions" style="display: none;">
                    <button class="yesno-btn btn-yes" onclick="selectAnswer('yes')">
                        <span class="yesno-icon">✅</span> Benar
                    </button>
                    <button class="yesno-btn btn-no" onclick="selectAnswer('no')">
                        <span class="yesno-icon">❌</span> Salah
                    </button>
                </div>
            </div>

            {{-- Explanation --}}
            <div class="explanation-box" id="explanationBox">
                <div class="explanation-label">💡 Pembahasan</div>
                <p class="explanation-text" id="explanationText"></p>
            </div>

            {{-- Next Button --}}
            <button class="next-btn" id="nextBtn" onclick="nextQuestion()">
                Soal Berikutnya
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 8H13M9 4L13 8L9 12"/></svg>
            </button>
        </div>

        {{-- SCORE SCREEN --}}
        <div class="score-screen" id="scoreScreen">
            <div class="score-emoji" id="scoreEmoji">🏆</div>
            <h2 class="score-title">Quiz Selesai!</h2>
            <p class="score-subtitle">Kerja bagus! Investasi ilmu adalah aset terbaik.</p>
            <div class="score-box">
                <span class="score-label">Total Skor Anda</span>
                <span class="score-value" id="finalScore">0</span>
                <span class="score-detail"><span id="correctCount">0</span> dari <span id="totalCount">0</span> soal benar</span>
            </div>
            <div class="score-actions">
                <button class="btn-action btn-primary" onclick="location.reload()" style="grid-column: 1 / -1;">
                    🔄 Main Lagi
                </button>
            </div>
        </div>

        {{-- EMPTY STATE --}}
        <div class="empty-state" id="emptyState">
            <div class="empty-icon">📭</div>
            <h3 class="empty-title">Belum Ada Soal</h3>
            <p class="empty-desc">Soal quiz untuk kategori {{ $category->name }} belum tersedia. Nantikan update terbaru!</p>
            <a href="{{ route('categories.show', $category->slug) }}" class="btn-action btn-secondary">
                Kembali ke Menu Game
            </a>
        </div>

    </div>

    {{-- FOOTER --}}
    <footer class="footer">
        <div class="footer-inner">
            <span class="footer-brand">INVEST<span class="gold">DU</span></span>
            <span class="footer-copy">&copy; {{ date('Y') }} Investdu. All rights reserved.</span>
        </div>
    </footer>

    <script>
        const CATEGORY_ID = {{ $category->id }};
        let allQuestions = [];
        let currentIndex = 0;
        let score = 0;
        let correctAnswers = 0;
        let hasAnswered = false;

        document.addEventListener('DOMContentLoaded', async () => {
            try {
                // Fetch ONLY trivia questions
                const triviaRes = await fetch(`/api/trivia/questions?category_id=${CATEGORY_ID}`).then(r => r.json());

                let questions = [];

                if (triviaRes.status === 'success' && triviaRes.data.length > 0) {
                    triviaRes.data.forEach(q => {
                        q._type = 'trivia';
                        questions.push(q);
                    });
                }

                if (questions.length === 0) {
                    document.getElementById('loadingScreen').style.display = 'none';
                    document.getElementById('progressContainer').style.display = 'none';
                    document.getElementById('scoreBadge').style.display = 'none';
                    document.getElementById('emptyState').classList.add('show');
                    return;
                }

                // Shuffle all questions together
                allQuestions = questions.sort(() => Math.random() - 0.5);

                document.getElementById('totalNum').textContent = allQuestions.length;
                document.getElementById('loadingScreen').style.display = 'none';
                document.getElementById('gameScreen').style.display = 'block';

                showQuestion();
            } catch (err) {
                console.error(err);
                document.getElementById('loadingScreen').innerHTML =
                    '<p style="color: #EF4444; font-weight: 600;">Gagal memuat soal quiz. Silakan muat ulang halaman.</p>';
            }
        });

        function showQuestion() {
            hasAnswered = false;
            const q = allQuestions[currentIndex];

            // Update progress
            document.getElementById('currentNum').textContent = currentIndex + 1;
            const percent = Math.round(((currentIndex) / allQuestions.length) * 100);
            document.getElementById('progressPercent').textContent = percent + '%';
            document.getElementById('progressFill').style.width = percent + '%';

            // Set question text
            document.getElementById('questionText').textContent = q.question;

            // Hide explanation & next button
            document.getElementById('explanationBox').classList.remove('show');
            document.getElementById('nextBtn').classList.remove('show');

            if (q._type === 'trivia') {
                // Show trivia options
                document.getElementById('triviaOptions').style.display = 'flex';
                document.getElementById('yesnoOptions').style.display = 'none';
                document.getElementById('questionTag').className = 'question-type-tag tag-trivia';
                document.getElementById('questionTag').innerHTML = '<span>📝</span> PILIHAN GANDA';

                document.getElementById('textA').textContent = q.option_a;
                document.getElementById('textB').textContent = q.option_b;
                document.getElementById('textC').textContent = q.option_c;
                document.getElementById('textD').textContent = q.option_d;

                // Reset buttons
                ['A', 'B', 'C', 'D'].forEach(letter => {
                    const btn = document.getElementById('opt' + letter);
                    btn.className = 'option-btn';
                    btn.disabled = false;
                });
            } else {
                // Show yes/no options
                document.getElementById('triviaOptions').style.display = 'none';
                document.getElementById('yesnoOptions').style.display = 'grid';
                document.getElementById('questionTag').className = 'question-type-tag tag-yesno';
                document.getElementById('questionTag').innerHTML = '<span>⚡</span> BENAR / SALAH';

                // Reset buttons
                document.querySelectorAll('.yesno-btn').forEach(btn => {
                    btn.className = btn.classList.contains('btn-yes') ? 'yesno-btn btn-yes' : 'yesno-btn btn-no';
                    btn.disabled = false;
                });
            }
        }

        function selectAnswer(choice) {
            if (hasAnswered) return;
            hasAnswered = true;

            const q = allQuestions[currentIndex];
            const isCorrect = choice.toUpperCase() === q.correct_answer.toUpperCase();

            if (isCorrect) {
                score += 10;
                correctAnswers++;
                document.getElementById('liveScore').textContent = score;
            }

            if (q._type === 'trivia') {
                // Mark correct & wrong
                const correctLetter = q.correct_answer.toUpperCase();
                document.getElementById('opt' + correctLetter).classList.add('correct');

                if (!isCorrect) {
                    document.getElementById('opt' + choice.toUpperCase()).classList.add('wrong');
                }

                // Disable all
                ['A', 'B', 'C', 'D'].forEach(l => {
                    document.getElementById('opt' + l).disabled = true;
                });
            } else {
                // Yes/No
                const correctVal = q.correct_answer.toLowerCase();
                const btns = document.querySelectorAll('.yesno-btn');

                btns.forEach(btn => {
                    btn.disabled = true;
                    const isYesBtn = btn.classList.contains('btn-yes');
                    const btnVal = isYesBtn ? 'yes' : 'no';

                    if (btnVal === correctVal) {
                        btn.classList.add('correct');
                    } else if (btnVal === choice.toLowerCase() && !isCorrect) {
                        btn.classList.add('wrong');
                    }
                });
            }

            // Show explanation
            const explanation = q.explanation || 'Tidak ada pembahasan tambahan.';
            document.getElementById('explanationText').textContent = explanation;
            document.getElementById('explanationBox').classList.add('show');

            // Show next button
            document.getElementById('nextBtn').classList.add('show');

            // Update button text for last question
            if (currentIndex === allQuestions.length - 1) {
                document.getElementById('nextBtn').innerHTML = 'Lihat Hasil <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 8H13M9 4L13 8L9 12"/></svg>';
            }
        }

        function nextQuestion() {
            if (currentIndex < allQuestions.length - 1) {
                currentIndex++;
                showQuestion();
            } else {
                // Show score screen
                document.getElementById('gameScreen').style.display = 'none';
                document.getElementById('progressContainer').style.display = 'none';
                document.getElementById('scoreScreen').classList.add('show');
                document.getElementById('finalScore').textContent = score;
                document.getElementById('correctCount').textContent = correctAnswers;
                document.getElementById('totalCount').textContent = allQuestions.length;

                // Progress bar to 100%
                document.getElementById('progressPercent').textContent = '100%';
                document.getElementById('progressFill').style.width = '100%';

                // Set emoji based on score percentage
                const percentage = (correctAnswers / allQuestions.length) * 100;
                const emoji = document.getElementById('scoreEmoji');
                if (percentage >= 80) {
                    emoji.textContent = '🏆';
                } else if (percentage >= 60) {
                    emoji.textContent = '🌟';
                } else if (percentage >= 40) {
                    emoji.textContent = '💪';
                } else {
                    emoji.textContent = '📚';
                }

                // POST score to backend
                fetch('/user/score/save', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        game_type: 'trivia',
                        category_id: {{ $category->id }},
                        score: score,
                        correct_answers: correctAnswers,
                        total_questions: allQuestions.length
                    })
                }).catch(err => console.error('Error saving score:', err));
            }
        }
    </script>

</body>
</html>
