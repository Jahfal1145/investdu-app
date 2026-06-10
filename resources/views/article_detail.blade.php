<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }} — Investdu</title>
    <meta name="description" content="{{ $article->excerpt ?? Str::limit(strip_tags($article->body), 160) }}">

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

        /* ===== ARTICLE HEADER ===== */
        .article-header {
            position: relative;
            padding: 5rem 0 4rem;
            background: linear-gradient(135deg, #0F172A 0%, #131C31 40%, #162036 100%);
            background-size: cover;
            background-position: center;
            overflow: hidden;
            border-bottom: 1px solid rgba(71, 85, 105, 0.2);
        }

        .article-header-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.92) 0%, rgba(19, 28, 49, 0.85) 50%, rgba(22, 32, 54, 0.95) 100%);
            z-index: 1;
        }

        .header-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(90px);
            pointer-events: none;
            z-index: 1;
        }

        .header-blob-1 {
            width: 300px; height: 300px;
            background: rgba(37, 99, 235, 0.08);
            top: -10%; right: 10%;
        }

        .header-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem;
            position: relative;
            z-index: 2;
        }

        .header-content {
            max-width: 820px;
        }

        .header-breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8125rem;
            color: #94A3B8;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .header-breadcrumb a {
            color: #60A5FA;
            transition: color 0.2s;
        }

        .header-breadcrumb a:hover { color: #93C5FD; }
        .header-breadcrumb svg { width: 14px; height: 14px; flex-shrink: 0; }

        .header-category-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.375rem 0.875rem;
            border-radius: 9999px;
            background: rgba(37, 99, 235, 0.15);
            border: 1px solid rgba(37, 99, 235, 0.3);
            color: #60A5FA;
            font-size: 0.75rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .article-title {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 900;
            letter-spacing: -0.04em;
            line-height: 1.15;
            margin-bottom: 1.25rem;
            color: #F8FAFC;
        }

        .article-meta {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            font-size: 0.875rem;
            color: #94A3B8;
            flex-wrap: wrap;
        }

        .article-meta-item {
            display: flex;
            align-items: center;
            gap: 0.375rem;
        }

        .article-meta-item svg { width: 16px; height: 16px; }

        /* ===== MAIN LAYOUT CONTAINER ===== */
        .article-main-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            flex-direction: column;
        }

        /* ===== ARTICLE BODY ===== */
        .article-body-wrap {
            max-width: 820px;
            padding: 3rem 0 4rem;
        }

        .article-body {
            font-size: 1.0625rem;
            line-height: 1.85;
            color: #CBD5E1;
        }

        .article-body h2 {
            font-size: 1.5rem;
            font-weight: 800;
            color: #F8FAFC;
            margin-top: 2.5rem;
            margin-bottom: 1rem;
            letter-spacing: -0.02em;
        }

        .article-body h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #F8FAFC;
            margin-top: 2rem;
            margin-bottom: 0.75rem;
        }

        .article-body p {
            margin-bottom: 1.25rem;
        }

        .article-body ul, .article-body ol {
            margin-bottom: 1.25rem;
            padding-left: 1.5rem;
        }

        .article-body li {
            margin-bottom: 0.5rem;
        }

        .article-body strong {
            color: #F8FAFC;
            font-weight: 600;
        }

        .article-body blockquote {
            border-left: 4px solid #2563EB;
            padding: 1rem 1.5rem;
            margin: 1.5rem 0;
            background: rgba(37, 99, 235, 0.06);
            border-radius: 0 0.75rem 0.75rem 0;
            color: #94A3B8;
            font-style: italic;
        }

        .article-body code {
            background: rgba(37, 99, 235, 0.1);
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
            font-size: 0.9em;
            color: #60A5FA;
        }

        .article-body img {
            width: 100%;
            border-radius: 0.75rem;
            margin: 1.5rem 0;
            border: 1px solid rgba(71, 85, 105, 0.2);
        }

        /* ===== BACK CTA ===== */
        .article-cta {
            max-width: 820px;
            padding: 0 0 5rem;
        }

        .cta-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.5rem 2rem;
            background: #1E293B;
            border: 1px solid rgba(71, 85, 105, 0.28);
            border-radius: 1rem;
            transition: all 0.3s ease;
        }

        .cta-card:hover {
            border-color: rgba(37, 99, 235, 0.4);
            box-shadow: 0 8px 30px rgba(37, 99, 235, 0.08);
        }

        .cta-card-text h3 {
            font-size: 1.125rem;
            font-weight: 700;
            color: #F8FAFC;
            margin-bottom: 0.25rem;
        }

        .cta-card-text p {
            font-size: 0.875rem;
            color: #94A3B8;
        }

        .cta-card-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: #2563EB;
            color: #fff;
            border-radius: 0.75rem;
            font-size: 0.875rem;
            font-weight: 700;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .cta-card-btn:hover {
            background: #3B82F6;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.35);
        }

        .cta-card-btn svg { width: 16px; height: 16px; }

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
        @media (max-width: 768px) {
            .navbar-inner { padding: 0 1.25rem; }
            .article-header { padding: 3rem 0 2.5rem; }
            .header-container { padding: 0 1.25rem; }
            .article-main-container { padding: 0 1.25rem; }
            .article-body-wrap { padding: 2rem 0 3rem; }
            .article-cta { padding: 0 0 4rem; }

            .cta-card {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

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

    {{-- ARTICLE HEADER (Banner Image) --}}
    <header class="article-header" @if($article->thumbnail) style="background-image: url('{{ asset('storage/' . $article->thumbnail) }}');" @endif>
        <div class="article-header-overlay"></div>
        <div class="header-blob header-blob-1" aria-hidden="true"></div>

        <div class="header-container">
            <div class="header-content">
                <div class="header-breadcrumb">
                    <a href="/">Beranda</a>
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 4l4 4-4 4"/></svg>
                    <a href="{{ route('articles.index', $category->slug) }}">{{ $category->name }}</a>
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 4l4 4-4 4"/></svg>
                    <span style="color: #CBD5E1;">Artikel</span>
                </div>

                <div class="header-category-badge">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" style="width:14px;height:14px;"><circle cx="8" cy="8" r="6"/><path d="M8 5v3l2 1"/></svg>
                    {{ $category->name }}
                </div>

                <h1 class="article-title">{{ $article->title }}</h1>

                <div class="article-meta">
                    <span class="article-meta-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                        {{ $article->created_at->translatedFormat('d F Y') }}
                    </span>
                    <span class="article-meta-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                        {{ ceil(str_word_count(strip_tags($article->body)) / 200) }} menit baca
                    </span>
                </div>

                @auth
                    <div style="margin-top: 16px;">
                        <form action="/dashboard/bookmark/{{ $article->id }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" style="
                                display: inline-flex;
                                align-items: center;
                                gap: 8px;
                                padding: 10px 20px;
                                border-radius: 10px;
                                font-family: 'Inter', sans-serif;
                                font-size: 0.8125rem;
                                font-weight: 700;
                                cursor: pointer;
                                transition: all 0.25s ease;
                                border: 1px solid {{ isset($isBookmarked) && $isBookmarked ? 'rgba(212,175,55,0.4)' : 'rgba(71,85,105,0.35)' }};
                                background: {{ isset($isBookmarked) && $isBookmarked ? 'rgba(212,175,55,0.12)' : 'rgba(30,41,59,0.5)' }};
                                color: {{ isset($isBookmarked) && $isBookmarked ? '#D4AF37' : '#CBD5E1' }};
                            ">
                                <svg viewBox="0 0 24 24" fill="{{ isset($isBookmarked) && $isBookmarked ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2" style="width:16px;height:16px;"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/></svg>
                                {{ isset($isBookmarked) && $isBookmarked ? 'Tersimpan' : 'Simpan Artikel' }}
                            </button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>
    </header>

    {{-- MAIN LAYOUT --}}
    <div class="article-main-container">
        
        {{-- ARTICLE BODY --}}
        <div class="article-body-wrap">
            <div class="article-body">
                {!! $article->body !!}
            </div>
        </div>

        {{-- CTA BACK --}}
        <div class="article-cta">
            <a href="{{ route('articles.index', $category->slug) }}" class="cta-card">
                <div class="cta-card-text">
                    <h3>Baca Artikel Lainnya</h3>
                    <p>Jelajahi lebih banyak artikel tentang {{ $category->name }}</p>
                </div>
                <span class="cta-card-btn">
                    Lihat Semua
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 8H13M9 4L13 8L9 12"/></svg>
                </span>
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

</body>
</html>
