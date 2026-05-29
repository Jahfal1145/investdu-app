<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Investdu - Start Your Investment Adventure</title>
    <meta name="description" content="Investdu adalah platform edukasi investasi yang paling seru dan ramah pemula. Mulai petualangan investasimu sekarang!">

    {{-- Google Fonts: Press Start 2P (pixel) + Space Mono --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css'])

    <style>
        /* ===== BASE RESET ===== */
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Space Mono', monospace;
            background-color: #0d1117;
            color: #ffffff;
            overflow-x: hidden;
        }

        /* ===== PIXEL FONT UTILITY ===== */
        .font-pixel {
            font-family: 'Press Start 2P', monospace;
        }

        .font-mono {
            font-family: 'Space Mono', monospace;
        }

        /* ===== NAVBAR ===== */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: rgba(13, 17, 23, 0.95);
            backdrop-filter: blur(10px);
            padding: 0 2rem;
            height: 60px;
            border-bottom: 2px solid #1e2530;
        }

        .navbar-logo {
            font-family: 'Press Start 2P', monospace;
            font-size: 1.1rem;
            color: #FFD000;
            text-decoration: none;
            letter-spacing: 2px;
            text-shadow: 2px 2px 0px #b38f00;
            transition: all 0.2s;
        }

        .navbar-logo:hover {
            text-shadow: 2px 2px 0px #b38f00, 0 0 20px rgba(255, 208, 0, 0.4);
        }

        .navbar-logo .logo-icon {
            display: inline-block;
            margin-right: 6px;
            animation: bounce-coin 2s ease-in-out infinite;
        }

        @keyframes bounce-coin {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-3px); }
        }

        .nav-links {
            display: flex;
            gap: 0.5rem;
            align-items: center;
            list-style: none;
        }

        .nav-links a {
            font-family: 'Space Mono', monospace;
            font-size: 0.85rem;
            font-weight: 700;
            color: #8b949e;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            transition: all 0.2s;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .nav-links a:hover {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.06);
        }

        .nav-links a.active {
            color: #FFD000;
        }

        .btn-signup-nav {
            font-family: 'Space Mono', monospace;
            font-size: 0.8rem;
            font-weight: 700;
            color: #0d1117;
            background-color: #FFD000;
            border: 3px solid #0d1117;
            padding: 0.45rem 1.2rem;
            border-radius: 6px;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.15s;
            box-shadow: 0 3px 0 #b38f00;
        }

        .btn-signup-nav:hover {
            transform: translateY(1px);
            box-shadow: 0 2px 0 #b38f00;
            background-color: #ffe04a;
        }

        .btn-signup-nav:active {
            transform: translateY(3px);
            box-shadow: 0 0px 0 #b38f00;
        }

        /* ===== HERO SECTION ===== */
        .hero-section {
            position: relative;
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            padding-top: 60px;
        }

        /* Pixel art background */
        .hero-bg {
            position: absolute;
            inset: 0;
            background-image: url('/assets/images/pixel-bg.png');
            background-size: cover;
            background-position: center bottom;
            background-repeat: no-repeat;
            image-rendering: pixelated;
            z-index: 0;
        }

        /* Subtle animated overlay for depth */
        .hero-bg::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(
                180deg,
                rgba(13, 17, 23, 0.15) 0%,
                rgba(13, 17, 23, 0.0) 30%,
                rgba(13, 17, 23, 0.0) 70%,
                rgba(13, 17, 23, 0.5) 100%
            );
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 10;
            text-align: center;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.5rem;
        }

        /* ===== SUBTITLE (START YOUR) ===== */
        .hero-subtitle-top {
            font-family: 'Press Start 2P', monospace;
            font-size: 1rem;
            letter-spacing: 8px;
            text-transform: uppercase;
            color: #ffffff;
            text-shadow:
                2px 2px 0px #000000,
                -1px -1px 0px #000000,
                1px -1px 0px #000000,
                -1px 1px 0px #000000;
            opacity: 0;
            animation: fadeSlideDown 0.8s ease-out 0.3s forwards;
        }

        /* ===== MAIN TITLE (INVESTMENT ADVENTURE) ===== */
        .hero-title {
            font-family: 'Press Start 2P', monospace;
            font-size: clamp(2rem, 6vw, 4.5rem);
            line-height: 1.3;
            text-transform: uppercase;
            /* Retro yellow-orange gradient fill */
            background: linear-gradient(
                180deg,
                #fff8e1 0%,
                #FFD54F 20%,
                #FFB300 50%,
                #F57C00 80%,
                #E65100 100%
            );
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            /* 3D text shadow effect using pseudo-elements */
            filter: drop-shadow(3px 3px 0px #000000)
                    drop-shadow(4px 4px 0px rgba(0, 0, 0, 0.6))
                    drop-shadow(0px 0px 10px rgba(255, 180, 0, 0.3));
            opacity: 0;
            animation: fadeScaleIn 1s ease-out 0.6s forwards;
        }

        /* ===== HERO DESCRIPTION ===== */
        .hero-description {
            font-family: 'Space Mono', monospace;
            font-size: 1rem;
            color: #e0e0e0;
            max-width: 550px;
            line-height: 1.7;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.8);
            opacity: 0;
            animation: fadeSlideUp 0.8s ease-out 1s forwards;
        }

        .hero-description .sparkle {
            display: inline-block;
            animation: twinkle 1.5s ease-in-out infinite alternate;
        }

        .hero-description .sparkle:nth-child(2) {
            animation-delay: 0.5s;
        }

        @keyframes twinkle {
            0% { opacity: 0.5; transform: scale(0.9); }
            100% { opacity: 1; transform: scale(1.1); }
        }

        /* ===== CTA BUTTON ===== */
        .btn-cta {
            display: inline-block;
            font-family: 'Press Start 2P', monospace;
            font-size: 0.95rem;
            color: #0d1117;
            background-color: #FFD000;
            border: 4px solid #0d1117;
            padding: 1rem 2.5rem;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 2px;
            cursor: pointer;
            transition: all 0.1s ease;
            box-shadow:
                0 6px 0 #0d1117,
                0 8px 15px rgba(0, 0, 0, 0.3);
            position: relative;
            opacity: 0;
            animation: fadeSlideUp 0.8s ease-out 1.2s forwards;
        }

        .btn-cta:hover {
            background-color: #ffe04a;
            transform: translateY(2px);
            box-shadow:
                0 4px 0 #0d1117,
                0 6px 10px rgba(0, 0, 0, 0.3);
        }

        .btn-cta:active {
            transform: translateY(6px);
            box-shadow:
                0 0px 0 #0d1117,
                0 2px 5px rgba(0, 0, 0, 0.3);
        }

        /* ===== MASCOT ===== */
        .hero-mascot {
            position: absolute;
            bottom: 5%;
            left: 5%;
            z-index: 15;
            width: clamp(100px, 15vw, 200px);
            image-rendering: pixelated;
            filter: drop-shadow(3px 3px 6px rgba(0, 0, 0, 0.5));
            animation: mascot-idle 3s ease-in-out infinite;
            opacity: 0;
            animation: mascot-appear 0.8s ease-out 1.5s forwards, mascot-idle 3s ease-in-out 2.3s infinite;
        }

        @keyframes mascot-idle {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        @keyframes mascot-appear {
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        /* ===== FLOATING PIXEL PARTICLES ===== */
        .pixel-particles {
            position: absolute;
            inset: 0;
            z-index: 5;
            pointer-events: none;
            overflow: hidden;
        }

        .pixel-particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background-color: rgba(255, 208, 0, 0.6);
            animation: float-particle linear infinite;
        }

        .pixel-particle:nth-child(1) { left: 10%; top: 80%; animation-duration: 8s; animation-delay: 0s; background-color: rgba(255, 208, 0, 0.5); }
        .pixel-particle:nth-child(2) { left: 25%; top: 75%; animation-duration: 10s; animation-delay: 1s; background-color: rgba(255, 255, 255, 0.4); width: 3px; height: 3px; }
        .pixel-particle:nth-child(3) { left: 45%; top: 85%; animation-duration: 7s; animation-delay: 2s; background-color: rgba(255, 180, 0, 0.5); }
        .pixel-particle:nth-child(4) { left: 60%; top: 70%; animation-duration: 12s; animation-delay: 0.5s; background-color: rgba(255, 255, 255, 0.3); width: 5px; height: 5px; }
        .pixel-particle:nth-child(5) { left: 80%; top: 82%; animation-duration: 9s; animation-delay: 3s; background-color: rgba(255, 208, 0, 0.4); }
        .pixel-particle:nth-child(6) { left: 90%; top: 68%; animation-duration: 11s; animation-delay: 1.5s; background-color: rgba(255, 255, 255, 0.35); width: 3px; height: 3px; }
        .pixel-particle:nth-child(7) { left: 35%; top: 90%; animation-duration: 6s; animation-delay: 4s; background-color: rgba(255, 180, 0, 0.45); }
        .pixel-particle:nth-child(8) { left: 70%; top: 78%; animation-duration: 8.5s; animation-delay: 2.5s; background-color: rgba(255, 208, 0, 0.55); width: 4px; height: 4px; }

        @keyframes float-particle {
            0% { transform: translateY(0) scale(1); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-100vh) scale(0.5); opacity: 0; }
        }

        /* ===== ANIMATIONS ===== */
        @keyframes fadeSlideDown {
            0% { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeScaleIn {
            0% { opacity: 0; transform: scale(0.8); }
            100% { opacity: 1; transform: scale(1); }
        }

        @keyframes fadeSlideUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        /* ===== MOBILE HAMBURGER ===== */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0.5rem;
            z-index: 110;
        }

        .mobile-menu-btn span {
            display: block;
            width: 24px;
            height: 3px;
            background-color: #FFD000;
            margin: 4px 0;
            border-radius: 2px;
            transition: all 0.3s;
        }

        .mobile-menu-btn.active span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .mobile-menu-btn.active span:nth-child(2) {
            opacity: 0;
        }

        .mobile-menu-btn.active span:nth-child(3) {
            transform: rotate(-45deg) translate(5px, -5px);
        }

        .mobile-nav-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background-color: rgba(13, 17, 23, 0.97);
            z-index: 99;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 2rem;
        }

        .mobile-nav-overlay.active {
            display: flex;
        }

        .mobile-nav-overlay a {
            font-family: 'Press Start 2P', monospace;
            font-size: 0.9rem;
            color: #8b949e;
            text-decoration: none;
            letter-spacing: 3px;
            text-transform: uppercase;
            transition: color 0.2s;
        }

        .mobile-nav-overlay a:hover {
            color: #FFD000;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .btn-signup-nav-wrapper {
                display: none;
            }

            .mobile-menu-btn {
                display: block;
            }

            .hero-subtitle-top {
                font-size: 0.65rem;
                letter-spacing: 4px;
            }

            .hero-title {
                font-size: clamp(1.4rem, 8vw, 2.5rem);
            }

            .hero-description {
                font-size: 0.85rem;
                padding: 0 1rem;
            }

            .btn-cta {
                font-size: 0.75rem;
                padding: 0.8rem 1.8rem;
            }

            .hero-mascot {
                width: 80px;
                bottom: 3%;
                left: 3%;
            }
        }

        @media (max-width: 480px) {
            .navbar {
                padding: 0 1rem;
            }

            .navbar-logo {
                font-size: 0.85rem;
            }

            .hero-subtitle-top {
                font-size: 0.55rem;
                letter-spacing: 3px;
            }

            .hero-title {
                font-size: clamp(1.2rem, 7vw, 2rem);
            }
        }

        /* ===== MODAL STYLES (preserved from original) ===== */
        .modal-overlay {
            display: none;
            position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%;
            background-color: rgba(0,0,0,0.7);
            align-items: center; justify-content: center;
            backdrop-filter: blur(3px);
        }
        .modal-content {
            background-color: #1a1e23; color: white; padding: 30px; border-radius: 12px; width: 400px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.5); border: 1px solid #343a40;
            position: relative; animation: zoomIn 0.3s;
        }
        .modal-close {
            position: absolute; right: 15px; top: 10px; color: #aaa;
            font-size: 24px; cursor: pointer; background: none; border: none;
        }
        .modal-close:hover { color: #dc3545; }

        .form-group { margin-bottom: 15px; text-align: left; }
        .form-label { display: block; margin-bottom: 5px; font-weight: bold; font-size: 14px; color: #adb5bd; }
        .form-input {
            width: 100%; padding: 10px; box-sizing: border-box;
            background-color: #2b3035; border: 1px solid #495057; color: white; border-radius: 6px;
            outline: none;
        }
        .form-input:focus { border-color: #FFD000; }

        @keyframes zoomIn { from {transform: scale(0.9); opacity: 0;} to {transform: scale(1); opacity: 1;} }

        /* ===== AUTH DASHBOARD AREA ===== */
        .auth-dashboard {
            padding: 40px;
            background-color: #0d1117;
            min-height: calc(100vh - 60px);
            margin-top: 60px;
        }

        .auth-dashboard h2 {
            font-family: 'Press Start 2P', monospace;
            font-size: 1rem;
            color: #FFD000;
            margin-bottom: 1.5rem;
        }

        .dashboard-card {
            background-color: #161b22;
            padding: 24px;
            border-radius: 12px;
            border: 1px solid #1e2530;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .dashboard-card h3 {
            font-family: 'Space Mono', monospace;
            font-weight: 700;
            color: #ffffff;
            margin-top: 0;
            margin-bottom: 0.5rem;
        }

        .dashboard-card p {
            color: #8b949e;
        }

        /* ===== SCROLLBAR STYLING ===== */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #0d1117;
        }

        ::-webkit-scrollbar-thumb {
            background: #1e2530;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #2d3540;
        }
    </style>
</head>
<body>

    {{-- ===== NAVBAR ===== --}}
    <nav class="navbar" id="mainNavbar">
        <a href="/" class="navbar-logo">
            <span class="logo-icon">💰</span>INVESTDU
        </a>

        {{-- Desktop Nav Links --}}
        <ul class="nav-links">
            @auth
                <li><a href="/leaderboard">🏆 Leaderboard</a></li>
                <li><a href="/berita">📰 Berita</a></li>
                <li><a href="/bursa">📈 Bursa</a></li>
                <li><a href="/portofolio">💼 Portofolio</a></li>

                <li>
                    <div style="position: relative; display: inline-block; cursor: pointer;" onclick="toggleDropdown(event)">
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover; border: 2px solid #495057;">
                            <span style="color: white; font-size: 12px;">▾</span>
                        </div>
                        <div id="profilMenu" style="display: none; position: absolute; right: 0; background-color: #161b22; min-width: 200px; box-shadow: 0 8px 24px rgba(0,0,0,0.4); border-radius: 10px; margin-top: 12px; overflow: hidden; z-index: 100; border: 1px solid #1e2530;">
                            <div style="padding: 15px; background-color: #1e2530; border-bottom: 1px solid #2d3540; color: white; font-size: 13px; font-family: 'Space Mono', monospace;">Hi, <b>{{ Auth::user()->username }}</b></div>
                            @if(Auth::user()->is_admin)
                                <a href="/admin" style="color: #0d1117; padding: 12px 16px; text-decoration: none; display: block; border-bottom: 1px solid #1e2530; background-color: #FFD000; font-weight: bold; font-family: 'Space Mono', monospace;">👑 Panel Admin</a>
                            @endif
                            <a href="#" onclick="openModal('profileModal')" style="color: white; padding: 12px 16px; text-decoration: none; display: block; border-bottom: 1px solid #1e2530; font-family: 'Space Mono', monospace; transition: background 0.2s;" onmouseover="this.style.backgroundColor='#1e2530'" onmouseout="this.style.backgroundColor='transparent'">👤 Profil Saya</a>
                            <a href="#" onclick="openModal('settingModal')" style="color: white; padding: 12px 16px; text-decoration: none; display: block; border-bottom: 1px solid #1e2530; font-family: 'Space Mono', monospace; transition: background 0.2s;" onmouseover="this.style.backgroundColor='#1e2530'" onmouseout="this.style.backgroundColor='transparent'">⚙️ Pengaturan</a>
                            <form action="/logout" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" style="width: 100%; text-align: left; background: none; border: none; color: #f85149; padding: 12px 16px; font-weight: bold; cursor: pointer; font-family: 'Space Mono', monospace; transition: background 0.2s;" onmouseover="this.style.backgroundColor='#1e2530'" onmouseout="this.style.backgroundColor='transparent'">🚪 Logout</button>
                            </form>
                        </div>
                    </div>
                </li>
            @endauth

            @guest
                <li><a href="#features" class="active">Learn</a></li>
                <li><a href="/game">Game</a></li>
                <li><a href="/leaderboard">Leaderboard</a></li>
                <li><a href="#market">Market Status</a></li>
            @endguest
        </ul>

        {{-- Signup / Login Buttons (Guest only) --}}
        @guest
            <div class="btn-signup-nav-wrapper">
                <a href="/register" class="btn-signup-nav">Sign up</a>
            </div>
        @endguest

        {{-- Mobile Hamburger --}}
        <button class="mobile-menu-btn" id="mobileMenuBtn" onclick="toggleMobileMenu()">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </nav>

    {{-- Mobile Nav Overlay --}}
    <div class="mobile-nav-overlay" id="mobileNavOverlay">
        @guest
            <a href="#features" onclick="closeMobileMenu()">Learn</a>
            <a href="/game" onclick="closeMobileMenu()">Game</a>
            <a href="/leaderboard" onclick="closeMobileMenu()">Leaderboard</a>
            <a href="#market" onclick="closeMobileMenu()">Market Status</a>
            <a href="/login" onclick="closeMobileMenu()" style="color: #ffffff;">Login</a>
            <a href="/register" onclick="closeMobileMenu()" style="color: #FFD000;">Sign Up</a>
        @endguest
        @auth
            <a href="/leaderboard" onclick="closeMobileMenu()">🏆 Leaderboard</a>
            <a href="/berita" onclick="closeMobileMenu()">📰 Berita</a>
            <a href="/bursa" onclick="closeMobileMenu()">📈 Bursa</a>
            <a href="/portofolio" onclick="closeMobileMenu()">💼 Portofolio</a>
        @endauth
    </div>

    {{-- ===== FLASH MESSAGES ===== --}}
    @if(session('success'))
        <div style="background-color: #1a3a2a; color: #3fb950; padding: 15px; text-align: center; font-weight: bold; margin-top: 60px; font-family: 'Space Mono', monospace; border-bottom: 2px solid #238636;">✅ {{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div style="background-color: #3a1a1a; color: #f85149; padding: 15px; text-align: center; font-weight: bold; margin-top: 60px; font-family: 'Space Mono', monospace; border-bottom: 2px solid #da3633;">❌ Gagal memperbarui: {{ $errors->first() }}</div>
    @endif

    {{-- ===== HERO SECTION (GUEST ONLY) ===== --}}
    @guest
    <section class="hero-section" id="heroSection">
        {{-- Pixel art background --}}
        <div class="hero-bg"></div>

        {{-- Floating pixel particles --}}
        <div class="pixel-particles">
            <div class="pixel-particle"></div>
            <div class="pixel-particle"></div>
            <div class="pixel-particle"></div>
            <div class="pixel-particle"></div>
            <div class="pixel-particle"></div>
            <div class="pixel-particle"></div>
            <div class="pixel-particle"></div>
            <div class="pixel-particle"></div>
        </div>

        {{-- Hero content --}}
        <div class="hero-content">
            <p class="hero-subtitle-top">Start Your</p>
            <h1 class="hero-title">Investment<br>Adventure</h1>
            <p class="hero-description">
                The most fun and beginner-friendly way to learn investing.
                <span class="sparkle">✦</span>
                <span class="sparkle">✧</span>
            </p>
            <a href="/register" class="btn-cta" id="ctaGetStarted">Get started</a>
        </div>


    </section>
    @endguest

    {{-- ===== AUTH DASHBOARD (LOGGED IN USERS) ===== --}}
    @auth
    <div class="auth-dashboard">
        <h2>Selamat datang kembali, {{ Auth::user()->username }}! 👋</h2>
        <div class="dashboard-card">
            <h3>📰 Berita Pasar Terkini</h3>
            <p>(Area ini nanti akan diisi oleh NewsAPI...)</p>
        </div>
    </div>
    @endauth

    {{-- ===== MODALS (AUTH ONLY) ===== --}}
    @auth
        {{-- Profile Modal --}}
        <div id="profileModal" class="modal-overlay" onclick="attemptCloseOverlay(event, 'profileModal')">
            <div class="modal-content" onclick="event.stopPropagation()" style="text-align: center;">
                <button class="modal-close" onclick="attemptCloseModal('profileModal')">&times;</button>

                <form id="profileForm" action="/user/profile/update" method="POST" onsubmit="isDirty = false;">
                    @csrf
                    @method('PUT')

                    <div style="margin-bottom: 25px; position: relative; display: inline-block;">
                        <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 3px solid #FFD000;">
                        <label style="position: absolute; bottom: 0; right: 0; background-color: #343a40; border: 2px solid #1a1e23; border-radius: 50%; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: 0.2s;">
                            <span style="font-size: 16px;">📷</span>
                            <input type="file" style="display: none;" onchange="alert('Sabar gem! Fitur Upload Foto beneran akan kita coding di tahap selanjutnya ya! 😁')">
                        </label>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Username:</label>
                        <input type="text" name="username" value="{{ Auth::user()->username }}" class="form-input" required oninput="markDirty()">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email:</label>
                        <input type="email" value="{{ Auth::user()->email }}" class="form-input" readonly style="background-color: #343a40; color: #888; cursor: not-allowed;">
                    </div>

                    <div class="form-group" style="margin-bottom: 30px;">
                        <label class="form-label">Password Baru:</label>
                        <input type="password" name="password" placeholder="Kosongkan jika tidak ingin diubah" class="form-input" oninput="markDirty()">
                    </div>

                    <button type="submit" style="width: 100%; background-color: #FFD000; color: #0d1117; border: none; padding: 12px; border-radius: 6px; font-weight: bold; font-size: 16px; cursor: pointer; font-family: 'Space Mono', monospace; transition: background 0.2s;" onmouseover="this.style.backgroundColor='#ffe04a'" onmouseout="this.style.backgroundColor='#FFD000'">Simpan</button>
                </form>
            </div>
        </div>

        {{-- Settings Modal --}}
        <div id="settingModal" class="modal-overlay" onclick="attemptCloseOverlay(event, 'settingModal')">
            <div class="modal-content" onclick="event.stopPropagation()">
                <button class="modal-close" onclick="attemptCloseModal('settingModal')">&times;</button>
                <h3 style="margin-top: 0; text-align: center; color: #FFD000; font-family: 'Press Start 2P', monospace; font-size: 0.9rem;">⚙️ Pengaturan</h3>
                <p style="color: #adb5bd; text-align: center; font-family: 'Space Mono', monospace; margin-top: 1rem;">Fitur Pengaturan sedang dalam pengembangan...</p>
                <div style="text-align: center; margin-top: 20px;">
                    <button type="button" onclick="attemptCloseModal('settingModal')" style="background-color: #1e2530; color: white; border: 2px solid #2d3540; padding: 10px 18px; border-radius: 6px; cursor: pointer; font-family: 'Space Mono', monospace; font-weight: bold; transition: background 0.2s;" onmouseover="this.style.backgroundColor='#2d3540'" onmouseout="this.style.backgroundColor='#1e2530'">Tutup</button>
                </div>
            </div>
        </div>

        {{-- Warning Modal (unsaved changes) --}}
        <div id="warningModal" class="modal-overlay" style="z-index: 1001;">
            <div class="modal-content" style="width: 360px; text-align: center; padding: 24px;">
                <h3 style="margin-top: 0; color: #FFD000; font-family: 'Press Start 2P', monospace; font-size: 0.75rem;">⚠️ Tunggu Dulu!</h3>
                <p style="color: white; margin-top: 1rem; font-family: 'Space Mono', monospace;">Perubahan belum disimpan. Yakin mau keluar?</p>
                <div style="display: flex; gap: 10px; justify-content: center; margin-top: 25px;">
                    <button onclick="closeWarningModal()" style="background-color: #1e2530; color: white; border: 2px solid #2d3540; padding: 10px 20px; border-radius: 6px; cursor: pointer; font-weight: bold; font-family: 'Space Mono', monospace;">Kembali</button>
                    <button onclick="discardChanges()" style="background-color: #da3633; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; font-weight: bold; font-family: 'Space Mono', monospace;">Batal</button>
                </div>
            </div>
        </div>
    @endauth

    {{-- ===== JAVASCRIPT ===== --}}
    <script>
        let isDirty = false;

        function markDirty() {
            isDirty = true;
        }

        // === Dropdown Menu ===
        function toggleDropdown(event) {
            event.stopPropagation();
            var menu = document.getElementById("profilMenu");
            menu.style.display = (menu.style.display === "block") ? "none" : "block";
        }

        // === Modal Controls ===
        function openModal(modalId) {
            var menu = document.getElementById("profilMenu");
            if(menu) menu.style.display = "none";
            document.getElementById(modalId).style.display = "flex";
            isDirty = false;
        }

        function attemptCloseModal(modalId) {
            if (modalId === 'profileModal' && isDirty) {
                document.getElementById('warningModal').style.display = 'flex';
            } else {
                document.getElementById(modalId).style.display = "none";
            }
        }

        function attemptCloseOverlay(event, modalId) {
            if (event.target === document.getElementById(modalId)) {
                attemptCloseModal(modalId);
            }
        }

        function closeWarningModal() {
            document.getElementById('warningModal').style.display = 'none';
        }

        function discardChanges() {
            isDirty = false;
            document.getElementById('profileForm').reset();
            document.getElementById('warningModal').style.display = 'none';
            document.getElementById('profileModal').style.display = 'none';
        }

        // === Mobile Menu ===
        function toggleMobileMenu() {
            const btn = document.getElementById('mobileMenuBtn');
            const overlay = document.getElementById('mobileNavOverlay');
            btn.classList.toggle('active');
            overlay.classList.toggle('active');
            document.body.style.overflow = overlay.classList.contains('active') ? 'hidden' : '';
        }

        function closeMobileMenu() {
            const btn = document.getElementById('mobileMenuBtn');
            const overlay = document.getElementById('mobileNavOverlay');
            btn.classList.remove('active');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        // === Close dropdown on outside click ===
        window.onclick = function() {
            var menu = document.getElementById("profilMenu");
            if (menu && menu.style.display === "block") {
                menu.style.display = "none";
            }
        }

        // === Parallax effect on hero (subtle) ===
        window.addEventListener('mousemove', function(e) {
            const hero = document.querySelector('.hero-bg');
            if (!hero) return;
            const x = (e.clientX / window.innerWidth - 0.5) * 10;
            const y = (e.clientY / window.innerHeight - 0.5) * 5;
            hero.style.transform = `translate(${x}px, ${y}px) scale(1.05)`;
        });
    </script>
</body>
</html>