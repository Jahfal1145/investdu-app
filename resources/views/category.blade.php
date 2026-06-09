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
        /* ===========================================================
           PREMIUM CATEGORY PAGE
           =========================================================== */
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; -webkit-font-smoothing: antialiased; }
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: #0F172A;
            background-image: radial-gradient(circle at top right, rgba(37, 99, 235, 0.08), transparent 40%),
                              radial-gradient(circle at bottom left, rgba(212, 175, 55, 0.05), transparent 40%);
            color: #F8FAFC;
            min-height: 100vh;
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* NAVBAR STYLES (FROM HOME) */
        .navbar {
            position: sticky; top: 0; z-index: 100;
            backdrop-filter: blur(20px) saturate(180%);
            background-color: rgba(15, 23, 42, 0.78);
            border-bottom: 1px solid rgba(71, 85, 105, 0.25);
            transition: all 0.35s ease;
        }
        .navbar.scrolled {
            background-color: rgba(15, 23, 42, 0.92);
            border-bottom-color: rgba(71, 85, 105, 0.45);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.25);
        }
        .navbar-inner {
            max-width: 1280px; margin: 0 auto;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 2rem; height: 68px;
        }
        .logo {
            display: flex; align-items: center; gap: 0.625rem;
            font-size: 1.375rem; font-weight: 800; letter-spacing: -0.03em;
            color: #F8FAFC; text-decoration: none; transition: opacity 0.3s ease;
        }
        .logo:hover { opacity: 0.85; }
        .logo-icon { width: 34px; height: 34px; border-radius: 10px; flex-shrink: 0; }
        .logo .gold { color: #D4AF37; }
        
        .nav-links { display: flex; align-items: center; gap: 0.25rem; }
        .nav-link-item { position: relative; }
        .nav-link-btn {
            display: inline-flex; align-items: center; gap: 0.375rem;
            padding: 0.5rem 1rem; border-radius: 0.625rem; border: none; background: transparent;
            color: #CBD5E1; font-size: 0.8125rem; font-weight: 600;
            letter-spacing: 0.04em; text-transform: uppercase; cursor: pointer; transition: all 0.3s ease;
        }
        .nav-link-btn:hover, .nav-link-btn.active { color: #F8FAFC; background-color: rgba(30, 41, 59, 0.5); }
        .nav-link-btn svg.chevron { width: 14px; height: 14px; transition: transform 0.3s ease; }
        .nav-link-btn.active svg.chevron { transform: rotate(180deg); }

        .dropdown-panel {
            position: absolute; top: calc(100% + 8px); left: 50%; transform: translateX(-50%) translateY(-6px);
            min-width: 240px; background-color: #1E293B; border: 1px solid rgba(71, 85, 105, 0.45);
            border-radius: 1rem; padding: 0.5rem; opacity: 0; visibility: hidden; pointer-events: none;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.45), 0 0 0 1px rgba(71, 85, 105, 0.1); z-index: 500;
        }
        .dropdown-panel.show { opacity: 1; visibility: visible; pointer-events: auto; transform: translateX(-50%) translateY(0); }
        .dd-item {
            display: flex; align-items: center; gap: 0.75rem; padding: 0.625rem 0.875rem;
            border-radius: 0.625rem; color: #CBD5E1; font-size: 0.875rem; font-weight: 500; transition: all 0.2s ease;
        }
        .dd-item:hover { background-color: rgba(37, 99, 235, 0.12); color: #F8FAFC; }
        .dd-item:hover svg { color: #3B82F6; }
        .dd-item svg { width: 18px; height: 18px; flex-shrink: 0; color: #64748B; transition: color 0.2s ease; }

        .nav-right { display: flex; align-items: center; gap: 0.375rem; }
        .nav-icon-btn {
            display: flex; align-items: center; justify-content: center; width: 40px; height: 40px;
            border-radius: 0.625rem; border: 1px solid transparent; background: transparent;
            color: #94A3B8; transition: all 0.3s ease;
        }
        .nav-icon-btn:hover { color: #F8FAFC; background-color: rgba(30, 41, 59, 0.6); border-color: rgba(71, 85, 105, 0.3); }
        .nav-icon-btn svg { width: 20px; height: 20px; }
        .btn-login {
            display: inline-flex; align-items: center; justify-content: center; padding: 0.5rem 1.375rem;
            border-radius: 0.75rem; background-color: #2563EB; color: #fff; font-size: 0.8125rem;
            font-weight: 700; letter-spacing: 0.02em; text-transform: uppercase; border: none;
            transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(37, 99, 235, 0.3);
        }
        .btn-login:hover { background-color: #3B82F6; box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4); transform: translateY(-1px); }

        .mobile-toggle {
            display: none; flex-direction: column; justify-content: space-between;
            width: 30px; height: 21px; background: transparent; border: none; cursor: pointer; z-index: 101;
        }
        .mobile-toggle span {
            width: 100%; height: 2px; background-color: #F8FAFC; border-radius: 2px; transition: all 0.3s ease;
        }
        .mobile-drawer {
            display: none; flex-direction: column; position: fixed; top: 68px; left: 0; right: 0;
            background-color: #1E293B; border-bottom: 1px solid rgba(71, 85, 105, 0.3); padding: 1.5rem;
            z-index: 90; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5); opacity: 0; transform: translateY(-10px);
            transition: all 0.3s ease;
        }
        .mobile-drawer.show { opacity: 1; transform: translateY(0); }
        .mobile-nav-link {
            display: flex; align-items: center; gap: 0.75rem; padding: 0.875rem 1rem; color: #CBD5E1;
            font-weight: 600; font-size: 0.9375rem; border-radius: 0.75rem; transition: background 0.2s;
        }
        .mobile-nav-link:hover { background-color: rgba(30, 41, 59, 0.8); color: #fff; }
        .mobile-divider { height: 1px; background-color: rgba(71, 85, 105, 0.3); margin: 0.5rem 0; }
        
        @media (max-width: 900px) {
            .nav-links, .btn-login { display: none; }
            .mobile-toggle { display: flex; }
            .nav-right { gap: 0.75rem; }
        }

        /* PAGE SHELL */
        .page-shell {
            max-width: 1024px;
            margin: 0 auto;
            padding: 3rem 2rem 5rem;
            position: relative;
        }
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #94A3B8;
            font-weight: 600;
            font-size: 0.9375rem;
            margin-bottom: 2rem;
            padding: 0.5rem 1rem;
            background: rgba(30, 41, 59, 0.5);
            border: 1px solid rgba(71, 85, 105, 0.3);
            border-radius: 0.75rem;
            transition: all 0.3s ease;
        }
        .back-link:hover {
            color: #F8FAFC;
            background: rgba(37, 99, 235, 0.15);
            border-color: rgba(37, 99, 235, 0.4);
            transform: translateX(-4px);
        }

        /* PREMIUM CATEGORY CARD */
        .category-card {
            background: rgba(30, 41, 59, 0.65);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(148, 163, 184, 0.15);
            border-radius: 1.5rem;
            padding: 3rem;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.4), inset 0 1px 0 rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
            animation: slideUpFade 0.6s ease forwards;
        }
        .category-card::before {
            content: '';
            position: absolute; top: 0; left: 0; width: 100%; height: 4px;
            background: linear-gradient(90deg, #2563EB, #D4AF37, #10B981);
        }

        @keyframes slideUpFade {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .category-header {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-bottom: 2.5rem;
        }
        .category-badge {
            align-self: flex-start;
            padding: 0.5rem 1.25rem;
            border-radius: 999px;
            border: 1px solid rgba(212, 175, 55, 0.4);
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.15), rgba(212, 175, 55, 0.05));
            color: #D4AF37;
            font-weight: 800;
            font-size: 0.8125rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.15);
        }
        .category-title {
            font-size: clamp(2.5rem, 4vw, 3.5rem);
            font-weight: 900;
            margin: 0;
            line-height: 1.1;
            background: linear-gradient(135deg, #F8FAFC 30%, #94A3B8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.03em;
        }
        .category-description {
            color: #94A3B8;
            font-size: 1.125rem;
            max-width: 800px;
            margin: 0;
            line-height: 1.8;
        }

        /* META GRID */
        .category-meta {
            display: grid;
            gap: 1.25rem;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            margin-bottom: 2.5rem;
        }
        .meta-box {
            padding: 1.5rem;
            border-radius: 1.25rem;
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid rgba(71, 85, 105, 0.3);
            transition: all 0.3s ease;
        }
        .meta-box:hover {
            background: rgba(15, 23, 42, 0.8);
            border-color: rgba(148, 163, 184, 0.25);
            transform: translateY(-2px);
        }
        .meta-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.75rem;
            color: #64748B;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }
        .meta-label svg { width: 14px; height: 14px; }
        .meta-value {
            font-size: 1.125rem;
            font-weight: 600;
            color: #E2E8F0;
        }

        /* LEARN MORE SECTION */
        .learn-more {
            border-radius: 1.25rem;
            padding: 2rem;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.05), rgba(37, 99, 235, 0.02));
            border: 1px solid rgba(37, 99, 235, 0.15);
            position: relative;
            overflow: hidden;
            margin-bottom: 2.5rem;
        }
        .learn-more::after {
            content: '';
            position: absolute; right: -20px; bottom: -20px; width: 150px; height: 150px;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }
        .learn-more h2 {
            display: flex; align-items: center; gap: 0.75rem;
            margin: 0 0 1rem; font-size: 1.375rem; font-weight: 800; color: #F8FAFC;
        }
        .learn-more p {
            margin: 0; color: #CBD5E1; line-height: 1.8; font-size: 1rem; max-width: 90%;
        }

        /* CALL TO ACTION */
        .start-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            padding: 1.125rem 2.5rem;
            border-radius: 1rem;
            border: none;
            background: linear-gradient(135deg, #2563EB, #1D4ED8);
            color: #fff;
            font-size: 1.125rem;
            font-weight: 800;
            letter-spacing: 0.02em;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.4);
        }
        .start-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(37, 99, 235, 0.5);
            background: linear-gradient(135deg, #3B82F6, #2563EB);
        }
        .start-button svg { width: 22px; height: 22px; transition: transform 0.3s; }
        .start-button:hover svg { transform: translateX(5px); }

        /* MODALS */
        .modal-overlay, .loading-overlay {
            position: fixed; inset: 0; background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);
            display: flex; align-items: center; justify-content: center;
            padding: 1.5rem; z-index: 1000; opacity: 0; visibility: hidden; transition: all 0.3s ease;
        }
        .modal-overlay.show, .loading-overlay.show { opacity: 1; visibility: visible; }
        
        .modal-content, .loading-card {
            width: min(100%, 540px);
            background: #1E293B; border: 1px solid rgba(148, 163, 184, 0.2);
            border-radius: 1.5rem; padding: 2.5rem; box-shadow: 0 32px 90px rgba(0, 0, 0, 0.5);
            transform: scale(0.95); transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
        }
        .modal-overlay.show .modal-content, .loading-overlay.show .loading-card { transform: scale(1); }
        
        .modal-close {
            position: absolute; top: 1.25rem; right: 1.25rem; width: 2.5rem; height: 2.5rem;
            border: none; border-radius: 999px; background: rgba(148, 163, 184, 0.1); color: #94A3B8;
            font-size: 1.2rem; cursor: pointer; transition: all 0.2s;
            display: flex; align-items: center; justify-content: center;
        }
        .modal-close:hover { background: rgba(239, 68, 68, 0.15); color: #EF4444; transform: rotate(90deg); }
        
        .modal-content h2, .loading-card h2 { margin: 0; font-size: 1.75rem; font-weight: 800; color: #F8FAFC; }
        .modal-content p, .loading-card p { color: #94A3B8; line-height: 1.7; margin-top: 0.75rem; font-size: 0.9375rem; }
        
        .modal-actions {
            display: grid; gap: 1rem; margin-top: 2rem; grid-template-columns: repeat(2, minmax(0, 1fr));
        }
        .game-btn {
            display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 0.5rem;
            padding: 1.5rem 1rem; border-radius: 1rem; border: 1px solid transparent;
            font-weight: 700; color: #fff; cursor: pointer; transition: all 0.3s ease; font-size: 1.125rem;
        }
        .game-btn:hover { transform: translateY(-4px); }
        .game-btn span.icon { font-size: 2rem; }
        .game-btn.trivia {
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.2), rgba(37, 99, 235, 0.05));
            border-color: rgba(37, 99, 235, 0.4); color: #60A5FA;
        }
        .game-btn.trivia:hover { background: #2563EB; color: #fff; box-shadow: 0 10px 25px rgba(37, 99, 235, 0.4); }
        .game-btn.yesno {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(16, 185, 129, 0.05));
            border-color: rgba(16, 185, 129, 0.4); color: #34D399;
        }
        .game-btn.yesno:hover { background: #10B981; color: #fff; box-shadow: 0 10px 25px rgba(16, 185, 129, 0.4); }

        .progress-bar {
            height: 0.75rem; background: rgba(15, 23, 42, 0.5); border-radius: 999px; overflow: hidden; margin: 1.5rem 0;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.2);
        }
        .progress-bar-fill {
            height: 100%; width: 0%; background: linear-gradient(90deg, #38BDF8, #6366F1);
            transition: width 0.25s ease; border-radius: 999px;
        }
        .countdown-text { margin: 0; color: #94A3B8; font-size: 1rem; font-weight: 500; text-align: center; }
        .countdown-text strong { color: #F8FAFC; font-size: 1.25rem; }

        @media (max-width: 640px) {
            .page-shell { padding: 2rem 1.25rem; }
            .category-card { padding: 2rem 1.5rem; }
            .category-title { font-size: 2rem; }
            .modal-actions { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    
    {{-- ============================================================
         NAVBAR
         ============================================================ --}}
    <nav class="navbar" id="navbar">
        <div class="navbar-inner">
            <a href="/" class="logo">
                <svg class="logo-icon" viewBox="0 0 34 34" fill="none">
                    <rect width="34" height="34" rx="9" fill="#2563EB"/>
                    <path d="M9 24L14 12L18 19L23 10L25 15" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <circle cx="25" cy="15" r="2.2" fill="#D4AF37"/>
                </svg>
                INVEST<span class="gold">DU</span>
            </a>

            {{-- Center Nav --}}
            <div class="nav-links" id="navLinks">
                <div class="nav-link-item">
                    <button class="nav-link-btn" data-dropdown="belajar-dropdown" aria-expanded="false">
                        Belajar
                        <svg class="chevron" viewBox="0 0 16 16" fill="none"><path d="M4 6L8 10L12 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>
                    <div class="dropdown-panel" id="belajar-dropdown">
                        <a href="/categories/tabungan-berjangka" class="dd-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="3"/><path d="M3 10h18"/><circle cx="16" cy="15" r="1.5"/></svg>
                            Tabungan Berjangka
                        </a>
                        <a href="/categories/saham" class="dd-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3,18 8,12 13,15 21,6"/><polyline points="17,6 21,6 21,10"/></svg>
                            Saham
                        </a>
                        <a href="/categories/reksa-dana" class="dd-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 3v9l6 3"/></svg>
                            Reksa Dana
                        </a>
                        <a href="/categories/obligasi" class="dd-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 3v18"/><path d="M6 3h12c0 0 3 0 3 3s-3 3-3 3H6"/><path d="M6 9h10c0 0 3 0 3 3s-3 3-3 3H6"/></svg>
                            Obligasi
                        </a>
                        <a href="/categories/properti" class="dd-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12l9-8 9 8"/><path d="M5 12v8h14v-8"/><rect x="9" y="14" width="6" height="6"/></svg>
                            Properti
                        </a>
                        <a href="/categories/emas" class="dd-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17l3-10h4l3 10H7z"/><path d="M9 17l2-5h2l2 5"/></svg>
                            Emas
                        </a>
                    </div>
                </div>

                <div class="nav-link-item">
                    <button class="nav-link-btn" data-dropdown="komunitas-dropdown" aria-expanded="false">
                        Komunitas
                        <svg class="chevron" viewBox="0 0 16 16" fill="none"><path d="M4 6L8 10L12 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>
                    <div class="dropdown-panel" id="komunitas-dropdown">
                        <a href="/forum-diskusi" class="dd-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            Forum Diskusi
                        </a>
                    </div>
                </div>
            </div>

            {{-- Right --}}
            <div class="nav-right">
                @auth
                    @if(Auth::user()->is_admin)
                        <a href="/admin" class="btn-login" style="background-color: #10B981;">Admin Panel</a>
                    @else
                        <a href="/dashboard" class="btn-login" style="background-color: #10B981;">Dashboard</a>
                    @endif
                @else
                    <a href="/login" class="btn-login">Login</a>
                @endauth

                <button class="mobile-toggle" id="mobileToggle" aria-label="Menu">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </div>
    </nav>

    {{-- Mobile Drawer --}}
    <div class="mobile-drawer" id="mobileDrawer">
        <a href="/categories/tabungan-berjangka" class="mobile-nav-link"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="20" height="20"><rect x="3" y="5" width="18" height="14" rx="3"/><path d="M3 10h18"/></svg> Tabungan Berjangka</a>
        <a href="/categories/saham" class="mobile-nav-link"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="20" height="20"><polyline points="3,18 8,12 13,15 21,6"/><polyline points="17,6 21,6 21,10"/></svg> Saham</a>
        <a href="/categories/reksa-dana" class="mobile-nav-link"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="20" height="20"><circle cx="12" cy="12" r="9"/><path d="M12 3v9l6 3"/></svg> Reksa Dana</a>
        <a href="/categories/obligasi" class="mobile-nav-link"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="20" height="20"><path d="M6 3v18"/><path d="M6 3h12c0 0 3 0 3 3s-3 3-3 3H6"/><path d="M6 9h10c0 0 3 0 3 3s-3 3-3 3H6"/></svg> Obligasi</a>
        <a href="/categories/properti" class="mobile-nav-link"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="20" height="20"><path d="M3 12l9-8 9 8"/><path d="M5 12v8h14v-8"/></svg> Properti</a>
        <a href="/categories/emas" class="mobile-nav-link"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="20" height="20"><path d="M7 17l3-10h4l3 10H7z"/></svg> Emas</a>
        <div class="mobile-divider"></div>
        <a href="/forum-diskusi" class="mobile-nav-link"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="20" height="20"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg> Komunitas</a>
        <div class="mobile-divider"></div>
        @auth
            @if(Auth::user()->is_admin)
                <a href="/admin" class="mobile-nav-link" style="color: #10B981; font-weight: 600;">Admin Panel</a>
            @else
                <a href="/dashboard" class="mobile-nav-link" style="color: #10B981; font-weight: 600;">Dashboard</a>
            @endif
        @else
            <a href="/login" class="mobile-nav-link" style="color: #3B82F6; font-weight: 600;">Login</a>
        @endauth
    </div>


    {{-- ============================================================
         MAIN CONTENT
         ============================================================ --}}
    <main class="page-shell">
        <a href="{{ url('/') }}" class="back-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16"><path d="M19 12H5"/><path d="M12 19l-7-7 7-7"/></svg>
            Kembali ke Beranda
        </a>

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
                    <div class="meta-label">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                        URL Slug
                    </div>
                    <div class="meta-value">{{ $category->slug }}</div>
                </div>
                <div class="meta-box">
                    <div class="meta-label">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        Icon Kategori
                    </div>
                    <div class="meta-value">{{ $category->icon }}</div>
                </div>
            </div>

            <section class="learn-more">
                <h2>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="24" height="24"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                    Apa yang bisa dipelajari?
                </h2>
                <p>Di halaman ini Anda dapat mengeksplorasi wawasan dasar dan memahami prinsip-prinsip penting dalam instrumen investasi <strong>{{ $category->name }}</strong>. Didesain secara interaktif agar proses belajar menjadi lebih menyenangkan dan mudah diingat.</p>
            </section>

            <button id="start-learning-btn" class="start-button" type="button">
                Mulai Bermain Game
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5l7 7-7 7"/></svg>
            </button>
        </article>
    </main>

    {{-- ============================================================
         MODALS & OVERLAYS
         ============================================================ --}}
    <div id="game-select-modal" class="modal-overlay" aria-hidden="true">
        <div class="modal-content">
            <button id="close-game-select" class="modal-close" type="button" aria-label="Tutup">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20"><path d="M18 6L6 18"/><path d="M6 6l12 12"/></svg>
            </button>
            <h2>Pilih Mode Bermain</h2>
            <p>Uji pengetahuanmu tentang <strong>{{ $category->name }}</strong> dengan mode permainan interaktif yang kami sediakan.</p>
            
            <div class="modal-actions">
                <button type="button" class="game-btn trivia" onclick="selectGame('trivia')">
                    <span class="icon">📝</span>
                    Quiz Trivia
                </button>
                <button type="button" class="game-btn yesno" onclick="selectGame('yes-or-no')">
                    <span class="icon">⚖️</span>
                    Benar / Salah
                </button>
            </div>
        </div>
    </div>

    <div id="game-loading-overlay" class="loading-overlay" aria-hidden="true">
        <div class="loading-card">
            <h2>Menyiapkan Arena...</h2>
            <p id="loading-message">Mohon tunggu sebentar, kami sedang menyusun tantangan terbaik untuk Anda.</p>
            <div class="progress-bar">
                <div id="loading-bar-fill" class="progress-bar-fill"></div>
            </div>
            <p class="countdown-text">Game akan dimulai dalam <strong id="countdown-timer">3</strong></p>
        </div>
    </div>

    {{-- ============================================================
         JAVASCRIPT
         ============================================================ --}}
    <script>
        // --- NAVBAR & DROPDOWN LOGIC ---
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 40);
        }, { passive: true });

        const dropdownBtns = document.querySelectorAll('[data-dropdown]');
        let activeDropdown = null;

        dropdownBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                
                const targetId = btn.getAttribute('data-dropdown');
                const panel = document.getElementById(targetId);

                if (activeDropdown && activeDropdown !== panel) {
                    activeDropdown.classList.remove('show');
                    const oldBtn = activeDropdown.parentElement.querySelector('[data-dropdown]');
                    oldBtn?.classList.remove('active');
                    oldBtn?.setAttribute('aria-expanded', 'false');
                }

                const isOpen = panel.classList.toggle('show');
                btn.classList.toggle('active', isOpen);
                btn.setAttribute('aria-expanded', isOpen);
                activeDropdown = isOpen ? panel : null;
            });
        });

        document.addEventListener('click', (e) => {
            if (activeDropdown && !activeDropdown.contains(e.target)) {
                activeDropdown.classList.remove('show');
                const btn = activeDropdown.parentElement.querySelector('[data-dropdown]');
                btn?.classList.remove('active');
                btn?.setAttribute('aria-expanded', 'false');
                activeDropdown = null;
            }
        });

        const mobileToggle = document.getElementById('mobileToggle');
        const mobileDrawer = document.getElementById('mobileDrawer');
        mobileToggle?.addEventListener('click', () => {
            const isOpen = mobileDrawer.classList.toggle('show');
            // Animate hamburger to X
            const spans = mobileToggle.querySelectorAll('span');
            if (isOpen) {
                spans[0].style.transform = 'rotate(45deg) translate(5px, 5px)';
                spans[1].style.opacity = '0';
                spans[2].style.transform = 'rotate(-45deg) translate(7px, -8px)';
            } else {
                spans[0].style.transform = 'none';
                spans[1].style.opacity = '1';
                spans[2].style.transform = 'none';
            }
        });


        // --- GAME MODAL LOGIC ---
        const startLearningBtn = document.getElementById('start-learning-btn');
        const gameSelectModal = document.getElementById('game-select-modal');
        const closeGameSelect = document.getElementById('close-game-select');
        const gameLoadingOverlay = document.getElementById('game-loading-overlay');
        const loadingMessage = document.getElementById('loading-message');
        const loadingBarFill = document.getElementById('loading-bar-fill');
        const countdownTimer = document.getElementById('countdown-timer');
        let countdownInterval;

        startLearningBtn.addEventListener('click', () => {
            gameSelectModal.classList.add('show');
            gameSelectModal.setAttribute('aria-hidden', 'false');
        });

        closeGameSelect.addEventListener('click', () => {
            gameSelectModal.classList.remove('show');
            gameSelectModal.setAttribute('aria-hidden', 'true');
        });

        window.addEventListener('click', (event) => {
            if (event.target === gameSelectModal) {
                gameSelectModal.classList.remove('show');
                gameSelectModal.setAttribute('aria-hidden', 'true');
            }
        });

        window.selectGame = function(game) {
            const label = game === 'trivia' ? 'Quiz Trivia' : 'Benar / Salah';
            gameSelectModal.classList.remove('show');
            gameSelectModal.setAttribute('aria-hidden', 'true');
            
            loadingMessage.innerText = `Memuat arena ${label}...`;
            loadingBarFill.style.width = '0%';
            countdownTimer.innerText = '3';
            
            gameLoadingOverlay.classList.add('show');
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
                    if (game === 'trivia') {
                        window.location.href = `/belajar/{{ $category->slug }}/quiz`; 
                    } else {
                        window.location.href = `/yes-or-no/{{ $category->slug }}`;
                    }
                }
            }, 1000);
        }
    </script>
</body>
</html>
