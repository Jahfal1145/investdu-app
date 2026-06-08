<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian: "{{ $query }}" — Investdu</title>
    
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

        .logo-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
        }

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

        /* ===== HERO HEADER ===== */
        .page-hero {
            position: relative;
            padding: 4rem 2rem 3rem;
            background: linear-gradient(135deg, #0F172A 0%, #131C31 40%, #162036 100%);
            overflow: hidden;
        }

        .page-hero::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(37, 99, 235, 0.3), rgba(212, 175, 55, 0.3), transparent);
        }

        .hero-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(90px);
            pointer-events: none;
        }

        .hero-blob-1 {
            width: 350px; height: 350px;
            background: rgba(37, 99, 235, 0.08);
            top: -20%; right: 5%;
        }

        .hero-content {
            max-width: 1280px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .hero-breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8125rem;
            color: #64748B;
            margin-bottom: 1.5rem;
        }

        .hero-breadcrumb a {
            color: #60A5FA;
            transition: color 0.2s;
        }

        .hero-breadcrumb a:hover { color: #93C5FD; }
        .hero-breadcrumb svg { width: 14px; height: 14px; }

        .hero-title {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 900;
            letter-spacing: -0.04em;
            line-height: 1.1;
            margin-bottom: 0.75rem;
        }

        .hero-desc {
            font-size: 1.0625rem;
            color: #94A3B8;
            max-width: 640px;
            line-height: 1.7;
        }

        /* Category Chips */
        .hero-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 1.5rem;
        }

        .chip {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.5rem 0.9375rem;
            border-radius: 9999px;
            border: 1px solid rgba(71, 85, 105, 0.35);
            background-color: rgba(30, 41, 59, 0.45);
            color: #94A3B8;
            font-size: 0.8125rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            user-select: none;
        }

        .chip svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
            transition: color 0.3s ease;
        }

        .chip:hover,
        .chip.active {
            border-color: rgba(37, 99, 235, 0.5);
            color: #F8FAFC;
            background-color: rgba(37, 99, 235, 0.12);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.15);
        }

        .chip.active {
            border-color: #2563EB;
            background-color: rgba(37, 99, 235, 0.18);
        }

        .chip:hover svg,
        .chip.active svg { color: #60A5FA; }

        /* ===== SEARCH BAR ===== */
        .hero-search {
            display: flex;
            align-items: center;
            gap: 0;
            max-width: 480px;
            margin-top: 2rem;
        }

        .search-input {
            flex: 1;
            padding: 0.8125rem 1.125rem;
            border: 1px solid rgba(71, 85, 105, 0.40);
            border-right: none;
            border-radius: 0.75rem 0 0 0.75rem;
            background-color: rgba(30, 41, 59, 0.5);
            color: #F8FAFC;
            font-size: 0.9375rem;
            font-family: 'Inter', sans-serif;
            outline: none;
            transition: all 0.3s ease;
        }

        .search-input::placeholder { color: #64748B; }

        .search-input:focus {
            border-color: #2563EB;
            background-color: rgba(30, 41, 59, 0.75);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        .search-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 52px;
            height: 48px;
            border: none;
            border-radius: 0 0.75rem 0.75rem 0;
            background-color: #2563EB;
            color: #fff;
            cursor: pointer;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .search-btn:hover {
            background-color: #3B82F6;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.4);
        }

        .search-btn svg { width: 20px; height: 20px; }

        /* ===== ARTICLES GRID ===== */
        .articles-section {
            max-width: 1280px;
            margin: 0 auto;
            padding: 3rem 2rem 5rem;
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.375rem;
            font-weight: 700;
            letter-spacing: -0.02em;
        }

        .article-count {
            font-size: 0.8125rem;
            color: #64748B;
            font-weight: 500;
        }

        .articles-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }

        .article-card {
            background: #1E293B;
            border: 1px solid rgba(71, 85, 105, 0.28);
            border-radius: 1rem;
            overflow: hidden;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
        }

        .article-card:hover {
            transform: translateY(-6px);
            border-color: rgba(37, 99, 235, 0.5);
            box-shadow: 0 12px 40px rgba(37, 99, 235, 0.08), 0 4px 15px rgba(0, 0, 0, 0.25);
        }

        .article-thumb {
            width: 100%;
            aspect-ratio: 16 / 9;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.15), rgba(212, 175, 55, 0.1));
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        .article-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .article-category-tag {
            position: absolute;
            top: 0.75rem;
            left: 0.75rem;
            padding: 0.25rem 0.625rem;
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(4px);
            border: 1px solid rgba(71, 85, 105, 0.4);
            border-radius: 9999px;
            font-size: 0.6875rem;
            font-weight: 600;
            color: #F8FAFC;
        }

        .article-thumb-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            color: #475569;
        }

        .article-thumb-placeholder svg { width: 36px; height: 36px; }
        .article-thumb-placeholder span { font-size: 0.75rem; font-weight: 500; }

        .article-card-body {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .article-card-date {
            font-size: 0.75rem;
            color: #64748B;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .article-card-title {
            font-size: 1.0625rem;
            font-weight: 700;
            color: #F8FAFC;
            letter-spacing: -0.01em;
            margin-bottom: 0.5rem;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .article-card-excerpt {
            font-size: 0.8125rem;
            color: #94A3B8;
            line-height: 1.6;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 1rem;
        }

        .article-card-action {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            font-size: 0.8125rem;
            font-weight: 600;
            color: #3B82F6;
            margin-top: auto;
            transition: all 0.3s ease;
        }

        .article-card-action svg {
            width: 14px; height: 14px;
            transition: transform 0.3s ease;
        }

        .article-card:hover .article-card-action { color: #60A5FA; }
        .article-card:hover .article-card-action svg { transform: translateX(4px); }

        /* ===== EMPTY STATE ===== */
        .empty-state {
            text-align: center;
            padding: 5rem 2rem;
            background: #1E293B;
            border-radius: 1rem;
            border: 1px dashed rgba(71, 85, 105, 0.4);
        }

        .empty-icon {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            opacity: 0.5;
        }

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
            margin: 0 auto;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .btn-empty {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: #2563EB;
            color: #fff;
            border-radius: 0.75rem;
            font-size: 0.875rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-empty:hover {
            background: #3B82F6;
            transform: translateY(-2px);
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

        .footer-brand {
            font-size: 1rem;
            font-weight: 700;
            color: #475569;
        }

        .footer-brand .gold { color: #D4AF37; }

        .footer-copy {
            font-size: 0.8125rem;
            color: #475569;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1024px) {
            .articles-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 768px) {
            .navbar-inner { padding: 0 1.25rem; }
            .page-hero { padding: 3rem 1.25rem 2rem; }
            .articles-section { padding: 2rem 1.25rem 4rem; }
            .articles-grid { grid-template-columns: 1fr; }
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

    {{-- HERO HEADER --}}
    <section class="page-hero">
        <div class="hero-blob hero-blob-1" aria-hidden="true"></div>

        <div class="hero-content">
            <div class="hero-breadcrumb">
                <a href="/">Beranda</a>
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 4l4 4-4 4"/></svg>
                <span style="color: #F8FAFC;">Pencarian</span>
            </div>

            <h1 class="hero-title">Hasil Pencarian</h1>
            @if($query)
                <p class="hero-desc">Menampilkan hasil pencarian pintar untuk kata kunci: <strong style="color: #fff;">"{{ $query }}"</strong></p>
            @else
                <p class="hero-desc">Silakan masukkan kata kunci untuk mencari artikel, panduan, dan materi edukasi lainnya.</p>
            @endif

            @php
                $selectedCategories = isset($c) && $c !== 'all' ? explode(',', $c) : [];
                $isAllActive = count($selectedCategories) === 0 ? 'active' : '';
            @endphp
            <div class="hero-chips" id="heroChips">
                <button type="button" class="chip {{ $isAllActive }}" data-category="all">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                    Semua
                </button>
                <button type="button" class="chip {{ in_array('tabungan-berjangka', $selectedCategories) ? 'active' : '' }}" data-category="tabungan-berjangka">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="5" width="18" height="14" rx="3"/><path d="M3 10h18"/></svg>
                    Tabungan Berjangka
                </button>
                <button type="button" class="chip {{ in_array('saham', $selectedCategories) ? 'active' : '' }}" data-category="saham">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="3,18 8,12 13,15 21,6"/><polyline points="17,6 21,6 21,10"/></svg>
                    Saham
                </button>
                <button type="button" class="chip {{ in_array('reksa-dana', $selectedCategories) ? 'active' : '' }}" data-category="reksa-dana">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="9"/><path d="M12 3v9l6 3"/></svg>
                    Reksa Dana
                </button>
                <button type="button" class="chip {{ in_array('obligasi', $selectedCategories) ? 'active' : '' }}" data-category="obligasi">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 3v18"/><path d="M6 3h12c0 0 3 0 3 3s-3 3-3 3H6"/><path d="M6 9h10c0 0 3 0 3 3s-3 3-3 3H6"/></svg>
                    Obligasi
                </button>
                <button type="button" class="chip {{ in_array('properti', $selectedCategories) ? 'active' : '' }}" data-category="properti">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 12l9-8 9 8"/><path d="M5 12v8h14v-8"/></svg>
                    Properti
                </button>
                <button type="button" class="chip {{ in_array('emas', $selectedCategories) ? 'active' : '' }}" data-category="emas">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M7 17l3-10h4l3 10H7z"/><path d="M9 17l2-5h2l2 5"/></svg>
                    Emas
                </button>
            </div>

            <form action="/search" method="GET" class="hero-search">
                <input type="hidden" name="c" id="categoryFilterInput" value="{{ $c ?? 'all' }}">
                <input type="text" name="q" value="{{ $query }}" class="search-input" placeholder="Cari investasi, saham, strategi..." autocomplete="off" required>
                <button type="submit" class="search-btn" aria-label="Cari">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.35-4.35"/></svg>
                </button>
            </form>
        </div>
    </section>

    {{-- ARTICLES LIST --}}
    <section class="articles-section">
        <div class="section-header">
            <h2 class="section-title">Artikel Ditemukan</h2>
            <span class="article-count">{{ $articles->count() }} hasil</span>
        </div>

        @if($articles->count() > 0)
            <div class="articles-grid">
                @foreach($articles as $article)
                    <a href="{{ route('articles.show', [$article->category->slug, $article->slug]) }}" class="article-card">
                        <div class="article-thumb">
                            <span class="article-category-tag">{{ $article->category->name }}</span>
                            @if($article->thumbnail)
                                <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}">
                            @else
                                <div class="article-thumb-placeholder">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="3"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
                                    <span>{{ $article->category->name }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="article-card-body">
                            <div class="article-card-date">{{ $article->created_at->translatedFormat('d F Y') }}</div>
                            <h3 class="article-card-title">{{ $article->title }}</h3>
                            <p class="article-card-excerpt">{{ $article->excerpt ?? Str::limit(strip_tags($article->body), 120) }}</p>
                            <span class="article-card-action">
                                Baca Artikel
                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 8H13M9 4L13 8L9 12"/></svg>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon">🔍</div>
                <h3 class="empty-title">Tidak ada hasil yang cocok</h3>
                <p class="empty-desc">Maaf, kami tidak dapat menemukan artikel yang cocok dengan kata kunci <strong>"{{ $query }}"</strong>. Coba gunakan kata kunci lain atau periksa ejaan Anda.</p>
                <a href="/" class="btn-empty">
                    Kembali ke Beranda
                </a>
            </div>
        @endif
    </section>

    {{-- FOOTER --}}
    <footer class="footer">
        <div class="footer-inner">
            <span class="footer-brand">INVEST<span class="gold">DU</span></span>
            <span class="footer-copy">&copy; {{ date('Y') }} Investdu. All rights reserved.</span>
        </div>
    </footer>

    {{-- Multi-select Categories JS --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const chips = document.querySelectorAll('.hero-chips .chip');
            const hiddenInput = document.getElementById('categoryFilterInput');

            chips.forEach(chip => {
                chip.addEventListener('click', () => {
                    const category = chip.getAttribute('data-category');

                    if (category === 'all') {
                        // Jika 'Semua' diklik, matikan yang lain
                        chips.forEach(c => c.classList.remove('active'));
                        chip.classList.add('active');
                    } else {
                        // Matikan 'Semua' jika sebelumnya aktif
                        const allChip = document.querySelector('.hero-chips .chip[data-category="all"]');
                        if (allChip) allChip.classList.remove('active');

                        // Toggle status aktif chip ini
                        chip.classList.toggle('active');

                        // Jika tidak ada yang aktif satupun, aktifkan 'Semua' kembali
                        const anyActive = document.querySelectorAll('.hero-chips .chip.active:not([data-category="all"])');
                        if (anyActive.length === 0 && allChip) {
                            allChip.classList.add('active');
                        }
                    }

                    // Update hidden input
                    updateHiddenInput();
                });
            });

            function updateHiddenInput() {
                const activeChips = document.querySelectorAll('.hero-chips .chip.active');
                let selected = [];
                
                activeChips.forEach(c => {
                    const cat = c.getAttribute('data-category');
                    if (cat !== 'all') {
                        selected.push(cat);
                    }
                });

                if (selected.length === 0) {
                    hiddenInput.value = 'all';
                } else {
                    hiddenInput.value = selected.join(',');
                }
            }
        });
    </script>
</body>
</html>
