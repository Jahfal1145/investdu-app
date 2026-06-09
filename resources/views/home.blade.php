<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Investdu — Platform Belajar Investasi Terpercaya</title>
    <meta name="description" content="Investdu adalah platform edukasi investasi bahasa Indonesia untuk pemula hingga investor berpengalaman. Pelajari saham, reksa dana, obligasi, properti, emas, dan tabungan berjangka.">
    <meta name="keywords" content="belajar investasi, edukasi investasi, saham, reksa dana, obligasi, properti, emas, tabungan berjangka">

    {{-- Google Fonts: Inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css'])

    <style>
        /* ===========================================================
           INVESTDU — PREMIUM FINTECH LANDING PAGE
           Adapted from SantriKoding layout with Investdu palette
           =========================================================== */

        /* --- Reset & Base --- */
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        html {
            scroll-behavior: smooth;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: #0F172A;
            color: #F8FAFC;
            overflow-x: hidden;
            line-height: 1.6;
        }

        ::selection {
            background-color: rgba(37, 99, 235, 0.35);
            color: #F8FAFC;
        }

        a { text-decoration: none; color: inherit; }
        button { font-family: inherit; cursor: pointer; }

        /* ===========================================================
           NAVBAR — Glassmorphism sticky
           =========================================================== */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
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
            max-width: 1280px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            height: 68px;
        }

        /* Logo */
        .logo {
            display: flex;
            align-items: center;
            gap: 0.625rem;
            font-size: 1.375rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            color: #F8FAFC;
            text-decoration: none;
            transition: opacity 0.3s ease;
        }

        .logo:hover { opacity: 0.85; }

        .logo-icon {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .logo .gold { color: #D4AF37; }

        /* Nav Center Links */
        .nav-links {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .nav-link-item {
            position: relative;
        }

        .nav-link-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.5rem 1rem;
            border-radius: 0.625rem;
            border: none;
            background: transparent;
            color: #CBD5E1;
            font-size: 0.8125rem;
            font-weight: 600;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .nav-link-btn:hover,
        .nav-link-btn.active {
            color: #F8FAFC;
            background-color: rgba(30, 41, 59, 0.5);
        }

        .nav-link-btn svg.chevron {
            width: 14px;
            height: 14px;
            transition: transform 0.3s ease;
        }

        .nav-link-btn.active svg.chevron {
            transform: rotate(180deg);
        }

        /* Dropdown Panel */
        .dropdown-panel {
            position: absolute;
            top: calc(100% + 8px);
            left: 50%;
            transform: translateX(-50%) translateY(-6px);
            min-width: 240px;
            background-color: #1E293B;
            border: 1px solid rgba(71, 85, 105, 0.45);
            border-radius: 1rem;
            padding: 0.5rem;
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.45), 0 0 0 1px rgba(71, 85, 105, 0.1);
            z-index: 500;
        }

        .dropdown-panel.show {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
            transform: translateX(-50%) translateY(0);
        }

        .dd-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.625rem 0.875rem;
            border-radius: 0.625rem;
            color: #CBD5E1;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .dd-item:hover {
            background-color: rgba(37, 99, 235, 0.12);
            color: #F8FAFC;
        }

        .dd-item:hover svg { color: #3B82F6; }

        .dd-item svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            color: #64748B;
            transition: color 0.2s ease;
        }

        /* Nav Right */
        .nav-right {
            display: flex;
            align-items: center;
            gap: 0.375rem;
        }

        .nav-icon-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 0.625rem;
            border: 1px solid transparent;
            background: transparent;
            color: #94A3B8;
            transition: all 0.3s ease;
        }

        .nav-icon-btn:hover {
            color: #F8FAFC;
            background-color: rgba(30, 41, 59, 0.6);
            border-color: rgba(71, 85, 105, 0.3);
        }

        .nav-icon-btn svg { width: 20px; height: 20px; }

        .btn-login {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1.375rem;
            border-radius: 0.75rem;
            background-color: #2563EB;
            color: #fff;
            font-size: 0.8125rem;
            font-weight: 700;
            letter-spacing: 0.02em;
            text-transform: uppercase;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.3);
        }

        .btn-login:hover {
            background-color: #3B82F6;
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
            transform: translateY(-1px);
        }

        /* Mobile Toggle */
        .mobile-toggle {
            display: none;
            flex-direction: column;
            gap: 5px;
            padding: 8px;
            border: none;
            background: transparent;
            cursor: pointer;
        }

        .mobile-toggle span {
            display: block;
            width: 22px;
            height: 2px;
            background-color: #CBD5E1;
            border-radius: 2px;
            transition: all 0.3s ease;
            transform-origin: center;
        }

        .mobile-toggle.open span:nth-child(1) { transform: rotate(45deg) translate(5px, 5px); }
        .mobile-toggle.open span:nth-child(2) { opacity: 0; transform: scaleX(0); }
        .mobile-toggle.open span:nth-child(3) { transform: rotate(-45deg) translate(5px, -5px); }

        /* Mobile Drawer */
        .mobile-drawer {
            display: none;
            position: fixed;
            inset: 0;
            top: 68px;
            z-index: 90;
            background-color: rgba(15, 23, 42, 0.98);
            backdrop-filter: blur(20px);
            padding: 1.5rem;
            overflow-y: auto;
            transform: translateY(-10px);
            opacity: 0;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .mobile-drawer.open {
            display: flex;
            flex-direction: column;
            gap: 0.375rem;
            transform: translateY(0);
            opacity: 1;
        }

        .mobile-nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1rem;
            border-radius: 0.75rem;
            color: #CBD5E1;
            font-size: 0.9375rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .mobile-nav-link:hover {
            background-color: rgba(30, 41, 59, 0.6);
            color: #F8FAFC;
        }

        .mobile-nav-link svg {
            width: 20px;
            height: 20px;
            color: #64748B;
        }

        .mobile-divider {
            height: 1px;
            background: rgba(71, 85, 105, 0.3);
            margin: 0.75rem 0;
        }

        /* ===========================================================
           HERO SECTION — SantriKoding-style split layout
           =========================================================== */
        .hero {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #0F172A 0%, #131C31 40%, #162036 100%);
        }

        .hero-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: 4.5rem 2rem 5rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
            min-height: calc(100vh - 68px);
        }

        /* Left Content */
        .hero-left {
            position: relative;
            z-index: 2;
        }

        .hero-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.4375rem 1rem;
            border-radius: 9999px;
            background-color: rgba(37, 99, 235, 0.08);
            border: 1px solid rgba(37, 99, 235, 0.18);
            color: #60A5FA;
            font-size: 0.8125rem;
            font-weight: 500;
            margin-bottom: 1.75rem;
            opacity: 0;
            transform: translateY(16px);
            animation: revealUp 0.6s ease forwards 0.1s;
        }

        .hero-pill .dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background-color: #10B981;
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4);
            animation: pulseDot 2s ease-in-out infinite;
        }

        @keyframes pulseDot {
            0%, 100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4); }
            50% { box-shadow: 0 0 0 8px rgba(16, 185, 129, 0); }
        }

        .hero-title {
            font-size: clamp(2.5rem, 5.5vw, 4rem);
            font-weight: 900;
            line-height: 1.05;
            letter-spacing: -0.04em;
            color: #F8FAFC;
            margin-bottom: 1.25rem;
            opacity: 0;
            transform: translateY(20px);
            animation: revealUp 0.7s ease forwards 0.2s;
        }

        .hero-title .gold { color: #D4AF37; }

        .hero-desc {
            font-size: 1.0625rem;
            line-height: 1.7;
            color: #94A3B8;
            max-width: 480px;
            margin-bottom: 2rem;
            opacity: 0;
            transform: translateY(20px);
            animation: revealUp 0.7s ease forwards 0.35s;
        }

        /* Category Chips */
        .hero-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1.75rem;
            opacity: 0;
            transform: translateY(20px);
            animation: revealUp 0.7s ease forwards 0.45s;
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

        /* Search Bar */
        .hero-search {
            display: flex;
            align-items: center;
            gap: 0;
            max-width: 480px;
            opacity: 0;
            transform: translateY(20px);
            animation: revealUp 0.7s ease forwards 0.55s;
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

        /* Right — Floating Icons */
        .hero-right {
            position: relative;
            height: 100%;
            min-height: 420px;
        }

        .floating-icon {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 1rem;
            background-color: rgba(30, 41, 59, 0.6);
            border: 1px solid rgba(71, 85, 105, 0.25);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(8px);
            cursor: default;
            opacity: 1;
        }

        .floating-icon:hover {
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3);
            border-color: rgba(212, 175, 55, 0.4);
        }

        .floating-icon svg {
            transition: transform 0.4s ease;
        }

        .floating-icon:hover svg {
            transform: rotate(-8deg) scale(1.1);
        }

        /* Icon positions & sizes — scattered like SantriKoding */
        .fi-1 { width: 64px; height: 64px; top: 5%; left: 15%; animation: idleFloat 7s ease-in-out infinite; }
        .fi-2 { width: 56px; height: 56px; top: 10%; right: 20%; animation: idleFloat 5.5s ease-in-out -1s infinite; }
        .fi-3 { width: 72px; height: 72px; top: 30%; left: 5%; animation: idleFloat 8s ease-in-out -2s infinite; }
        .fi-4 { width: 60px; height: 60px; top: 25%; right: 5%; animation: idleFloat 6s ease-in-out -3s infinite; }
        .fi-5 { width: 68px; height: 68px; top: 55%; left: 25%; animation: idleFloat 7.5s ease-in-out -1.5s infinite; }
        .fi-6 { width: 58px; height: 58px; top: 50%; right: 15%; animation: idleFloat 5s ease-in-out -4s infinite; }
        .fi-7 { width: 52px; height: 52px; top: 75%; left: 10%; animation: idleFloat 6.5s ease-in-out -2.5s infinite; }
        .fi-8 { width: 62px; height: 62px; top: 72%; right: 25%; animation: idleFloat 8.5s ease-in-out -0.5s infinite; }

        @keyframes idleFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-14px); }
        }

        /* Hero ambient gradient blobs */
        .hero-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(90px);
            pointer-events: none;
            z-index: 0;
        }

        .blob-1 {
            width: 400px; height: 400px;
            background: rgba(37, 99, 235, 0.08);
            top: -10%; right: 10%;
            animation: blobPulse 10s ease-in-out infinite;
        }

        .blob-2 {
            width: 300px; height: 300px;
            background: rgba(212, 175, 55, 0.06);
            bottom: -5%; left: 20%;
            animation: blobPulse 12s ease-in-out infinite 3s;
        }

        @keyframes blobPulse {
            0%, 100% { transform: scale(1); opacity: 0.6; }
            50% { transform: scale(1.2); opacity: 1; }
        }

        /* ===========================================================
           LEARNING CATEGORIES SECTION
           =========================================================== */
        .categories-section {
            position: relative;
            z-index: 1;
            background-color: #0F172A;
            padding: 4rem 0 5rem;
        }

        .categories-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: -0.025em;
            color: #F8FAFC;
        }

        .section-subtitle {
            font-size: 0.875rem;
            color: #64748B;
            font-weight: 500;
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 320px));
            justify-content: center;
            gap: 2rem;
        }

        /* Category Card */
        .cat-card {
            background-color: #1E293B;
            border: 1px solid rgba(71, 85, 105, 0.28);
            border-radius: 1rem;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            gap: 0.875rem;
            cursor: pointer;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            aspect-ratio: 3 / 4;
            /* Scroll reveal */
            opacity: 0;
            transform: translateY(30px);
        }

        .cat-card.revealed {
            opacity: 1;
            transform: translateY(0);
        }

        .cat-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.03) 0%, transparent 50%);
            opacity: 0;
            transition: opacity 0.35s ease;
            pointer-events: none;
        }

        .cat-card:hover {
            transform: translateY(-8px);
            border-color: rgba(212, 175, 55, 0.55);
            box-shadow: 0 10px 30px rgba(212, 175, 55, 0.06), 0 4px 15px rgba(0, 0, 0, 0.25);
        }

        .cat-card:hover::before { opacity: 1; }

        .card-icon {
            width: 52px;
            height: 52px;
            border-radius: 0.875rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.35s ease;
        }

        .cat-card:hover .card-icon { transform: scale(1.08); }

        .card-icon svg { width: 26px; height: 26px; }

        .card-body h3 {
            font-size: 1.0625rem;
            font-weight: 700;
            color: #F8FAFC;
            letter-spacing: -0.01em;
            margin-bottom: 0.375rem;
        }

        .card-body p {
            font-size: 0.8125rem;
            line-height: 1.6;
            color: #94A3B8;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .card-action {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            font-size: 0.8125rem;
            font-weight: 600;
            color: #3B82F6;
            margin-top: auto;
            padding-top: 0.25rem;
            transition: all 0.3s ease;
        }

        .card-action svg {
            width: 14px;
            height: 14px;
            transition: transform 0.3s ease;
        }

        .cat-card:hover .card-action { color: #60A5FA; }
        .cat-card:hover .card-action svg { transform: translateX(5px); }



        /* ===========================================================
           CTA SECTION
           =========================================================== */
        .cta-section {
            padding: 5rem 0;
            text-align: center;
        }

        .cta-inner {
            max-width: 640px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .cta-title {
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            color: #F8FAFC;
            margin-bottom: 1rem;
            line-height: 1.15;
        }

        .cta-title .gold { color: #D4AF37; }

        .cta-desc {
            font-size: 1rem;
            color: #94A3B8;
            margin-bottom: 2rem;
            line-height: 1.7;
        }

        .cta-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.875rem 2rem;
            border-radius: 0.875rem;
            background-color: #2563EB;
            color: #fff;
            font-size: 1rem;
            font-weight: 700;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.35);
        }

        .cta-btn:hover {
            background-color: #3B82F6;
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(37, 99, 235, 0.4);
        }

        .cta-btn svg { width: 18px; height: 18px; }

        /* ===========================================================
           FOOTER
           =========================================================== */
        .footer {
            border-top: 1px solid rgba(71, 85, 105, 0.2);
            background-color: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(8px);
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

        /* ===========================================================
           ANIMATIONS
           =========================================================== */
        @keyframes revealUp {
            to { opacity: 1; transform: translateY(0); }
        }

        /* ===========================================================
           RESPONSIVE
           =========================================================== */
        @media (max-width: 1024px) {
            .hero-inner {
                grid-template-columns: 1fr;
                gap: 2rem;
                padding: 3rem 1.5rem 3rem;
                min-height: auto;
            }

            .hero-right { display: none; }

            .categories-grid { grid-template-columns: repeat(2, 1fr); }
            .stats-row { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 768px) {
            .nav-links { display: none; }
            .mobile-toggle { display: flex; }

            .navbar-inner { padding: 0 1.25rem; }

            .hero-inner { padding: 2.5rem 1.25rem 2.5rem; }

            .hero-title { font-size: clamp(2rem, 8vw, 3rem); }
            .hero-desc { font-size: 0.9375rem; }

            .hero-search { max-width: 100%; }

            .categories-inner { padding: 0 1.25rem; }
            .categories-grid { grid-template-columns: 1fr; }
            .stats-row { grid-template-columns: 1fr 1fr; }

            .cta-title { font-size: 1.625rem; }

            .footer-inner {
                flex-direction: column;
                gap: 0.75rem;
                text-align: center;
            }
        }
        /* ===== FAQ SECTION ===== */
        .faq-section {
            padding: 5rem 2rem;
            max-width: 800px;
            margin: 0 auto;
        }

        .faq-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .faq-title {
            font-size: clamp(2rem, 3vw, 2.5rem);
            font-weight: 800;
            color: #F8FAFC;
            letter-spacing: -0.02em;
            margin-bottom: 1rem;
        }

        .faq-desc {
            color: #94A3B8;
            font-size: 1.125rem;
        }

        .faq-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .faq-item {
            background: rgba(30, 41, 59, 0.4);
            border: 1px solid rgba(71, 85, 105, 0.4);
            border-radius: 1rem;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .faq-item.active {
            background: rgba(30, 41, 59, 0.8);
            border-color: rgba(37, 99, 235, 0.5);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .faq-question {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.5rem;
            background: none;
            border: none;
            color: #F8FAFC;
            font-size: 1.125rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            text-align: left;
            cursor: pointer;
            transition: color 0.2s;
        }

        .faq-question:hover {
            color: #60A5FA;
        }

        .faq-icon {
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            transition: transform 0.3s ease;
            flex-shrink: 0;
            margin-left: 1rem;
        }

        .faq-item.active .faq-icon {
            transform: rotate(180deg);
            background: rgba(37, 99, 235, 0.2);
            color: #60A5FA;
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .faq-answer-inner {
            padding: 0 1.5rem 1.5rem;
            color: #94A3B8;
            line-height: 1.6;
        }
    </style>
</head>
<body>

    {{-- ============================================================
         NAVBAR
         ============================================================ --}}
    <nav class="navbar" id="navbar">
        <div class="navbar-inner">
            {{-- Logo --}}
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
                {{-- Belajar Dropdown --}}
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

                {{-- Komunitas --}}
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

                        <a href="/blog" class="dd-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                            Blog & Artikel
                        </a>
                    </div>
                </div>


            </div>

            {{-- Right --}}
            <div class="nav-right">
                <button class="nav-icon-btn" id="searchToggle" aria-label="Search" title="Cari materi">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.35-4.35"/></svg>
                </button>

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
        <a href="#" class="mobile-nav-link"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="20" height="20"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg> Komunitas</a>

        <div class="mobile-divider"></div>
        @auth
            @if(Auth::user()->is_admin)
                <a href="/admin" class="mobile-nav-link" style="color: #10B981; font-weight: 600;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="20" height="20"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                    Admin Panel
                </a>
            @else
                <a href="/dashboard" class="mobile-nav-link" style="color: #10B981; font-weight: 600;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="20" height="20"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                    Dashboard
                </a>
            @endif
        @else
            <a href="/login" class="mobile-nav-link" style="color: #3B82F6; font-weight: 600;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="20" height="20"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                Login
            </a>
        @endauth
    </div>

    {{-- ============================================================
         HERO SECTION
         ============================================================ --}}
    <section class="hero" id="hero">
        {{-- Blobs --}}
        <div class="hero-blob blob-1" aria-hidden="true"></div>
        <div class="hero-blob blob-2" aria-hidden="true"></div>

        <div class="hero-inner">
            {{-- Left --}}
            <div class="hero-left">
                <div class="hero-pill">
                    <span class="dot"></span>
                    Platform Belajar Investasi Bahasa Indonesia
                </div>

                <h1 class="hero-title">
                    INVEST<span class="gold">DU</span>
                </h1>

                <p class="hero-desc">
                    Website belajar investasi bahasa Indonesia terlengkap dan mudah dipahami untuk pemula hingga mahir.
                </p>

                {{-- Category Chips --}}
                <div class="hero-chips" id="heroChips">
                </div>

                {{-- Search Bar --}}
                <form action="/search" method="GET" class="hero-search">
                    <input type="hidden" name="c" id="categoryFilterInput" value="all">
                    <input type="text" name="q" class="search-input" id="heroSearch" placeholder="Apa yang ingin Anda pelajari?" autocomplete="off" required>
                    <button type="submit" class="search-btn" id="searchBtn" aria-label="Cari">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.35-4.35"/></svg>
                    </button>
                </form>
            </div>

            {{-- Right — Floating Financial Icons --}}
            <div class="hero-right" id="heroRight" aria-hidden="true">
                {{-- Tabungan / Bank Card --}}
                <div class="floating-icon fi-1" title="Tabungan Berjangka">
                    <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="3"/><path d="M3 10h18"/><circle cx="16" cy="15" r="1.5"/></svg>
                </div>
                {{-- Saham / Chart --}}
                <div class="floating-icon fi-2" title="Saham">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#10B981" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3,18 8,12 13,15 21,6"/><polyline points="17,6 21,6 21,10"/></svg>
                </div>
                {{-- Reksa Dana / Pie --}}
                <div class="floating-icon fi-3" title="Reksa Dana">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#8B5CF6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 3v9l6 3"/><path d="M12 12L6 18"/></svg>
                </div>
                {{-- Obligasi --}}
                <div class="floating-icon fi-4" title="Obligasi">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#F59E0B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="4" width="16" height="16" rx="2"/><path d="M4 10h16"/><path d="M10 4v16"/></svg>
                </div>
                {{-- Properti / House --}}
                <div class="floating-icon fi-5" title="Properti">
                    <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#EC4899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12l9-8 9 8"/><path d="M5 12v8h14v-8"/><rect x="9" y="14" width="6" height="6"/></svg>
                </div>
                {{-- Emas / Gold Bar --}}
                <div class="floating-icon fi-6" title="Emas">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#D4AF37" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17l3-10h4l3 10H7z"/><path d="M9 17l2-5h2l2 5"/></svg>
                </div>
                {{-- Candlestick --}}
                <div class="floating-icon fi-7" title="Analisis Teknikal">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#60A5FA" stroke-width="1.5" stroke-linecap="round"><line x1="8" y1="6" x2="8" y2="18"/><rect x="6" y="9" width="4" height="6" fill="none"/><line x1="16" y1="4" x2="16" y2="20"/><rect x="14" y="8" width="4" height="8" fill="none"/></svg>
                </div>
                {{-- Diamond / Gem --}}
                <div class="floating-icon fi-8" title="Investasi Premium">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#A78BFA" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="12,2 22,10 12,22 2,10"/><polyline points="2,10 12,14 22,10"/><line x1="12" y1="2" x2="12" y2="14"/></svg>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================
         LEARNING CATEGORIES SECTION
         ============================================================ --}}
    <div class="categories-grid" id="categoriesGrid">
    @foreach($categories->take(3) as $category)
        <a href="{{ route('categories.show', $category->slug) }}" class="cat-card" data-cat="{{ $category->slug }}" id="card-{{ $category->slug }}">
            
            {{-- Header Kartu: Ikon & Badge dibuat sejajar biar tidak menambah tinggi kartu --}}
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div class="card-icon" style="background-color: rgba(37, 99, 235, 0.12);">
                    <svg viewBox="0 0 28 28" fill="none" stroke="#3B82F6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="6" width="22" height="16" rx="3"/>
                        <path d="M3 12h22"/><circle cx="19" cy="18" r="2"/><path d="M7 18h4"/>
                    </svg>
                </div>
                
                {{-- Badge dipindah ke kanan atas --}}
                @if($category->badge)
                    <span style="font-size: 11px; padding: 4px 10px; background: rgba(212, 175, 55, 0.1); border: 1px solid rgba(212, 175, 55, 0.3); border-radius: 99px; color: #D4AF37; font-weight: 600;">
                        {{ $category->badge }}
                    </span>
                @endif
            </div>
            
            {{-- Judul dan Deskripsi --}}
            <div class="card-body">
                <h3>{{ $category->name }}</h3>
                <p>{{ $category->description }}</p>
            </div>
            
            {{-- Tombol Aksi --}}
            <span class="card-action">
                Pelajari Selengkapnya
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 8H13M9 4L13 8L9 12"/>
                </svg>
            </span>
            
        </a>
    @endforeach
</div>


    {{-- ============================================================
         FAQ SECTION
         ============================================================ --}}
    <section class="faq-section" id="faq">
        <div class="faq-header">
            <h2 class="faq-title">Pertanyaan yang Sering Diajukan</h2>
            <p class="faq-desc">Temukan jawaban atas pertanyaan umum tentang Investdu.</p>
        </div>
        <div class="faq-list">
            <div class="faq-item">
                <button class="faq-question">
                    Apa itu Investdu?
                    <div class="faq-icon">
                        <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </div>
                </button>
                <div class="faq-answer">
                    <div class="faq-answer-inner">
                        Investdu adalah platform belajar investasi bahasa Indonesia terlengkap yang dirancang untuk membantu pemula hingga mahir dalam memahami pasar keuangan, saham, reksadana, dan instrumen investasi lainnya secara interaktif.
                    </div>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    Apakah materi di Investdu benar-benar gratis?
                    <div class="faq-icon">
                        <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </div>
                </button>
                <div class="faq-answer">
                    <div class="faq-answer-inner">
                        Ya! Kami berkomitmen untuk menyediakan edukasi finansial yang berkualitas tanpa biaya. Seluruh materi literasi, kuis interaktif, dan forum komunitas dapat Anda akses sepenuhnya secara gratis.
                    </div>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    Apakah saya perlu pengalaman sebelum belajar di sini?
                    <div class="faq-icon">
                        <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </div>
                </button>
                <div class="faq-answer">
                    <div class="faq-answer-inner">
                        Tidak sama sekali. Materi kami disusun secara terstruktur mulai dari tingkat dasar (pemula) hingga tingkat lanjutan (mahir). Anda bisa belajar dari nol sesuai dengan kecepatan pemahaman Anda sendiri.
                    </div>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    Bagaimana cara berinteraksi dengan pengguna lain?
                    <div class="faq-icon">
                        <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </div>
                </button>
                <div class="faq-answer">
                    <div class="faq-answer-inner">
                        Anda dapat bergabung dan berdiskusi di menu Komunitas -> Forum Diskusi setelah mendaftarkan akun. Di sana Anda bisa bertanya, berbagi wawasan, dan belajar bersama dengan sesama calon investor lainnya.
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================
         FOOTER
         ============================================================ --}}
    <footer class="footer">
        <div class="footer-inner">
            <div class="footer-brand">INVEST<span class="gold">DU</span></div>
            <p class="footer-copy">&copy; {{ date('Y') }} Investdu. All rights reserved.</p>
        </div>
    </footer>

    {{-- ============================================================
         JAVASCRIPT — Full Interactivity
         ============================================================ --}}
    <script>
    (function() {
        'use strict';

        // ==============================================
        // 1. NAVBAR SCROLL EFFECT
        // ==============================================
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 40);
        }, { passive: true });

        // ==============================================
        // 2. DROPDOWN MENUS (Multiple)
        // ==============================================
        const dropdownBtns = document.querySelectorAll('[data-dropdown]');
        let activeDropdown = null;

        dropdownBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                
                const targetId = btn.getAttribute('data-dropdown');
                const panel = document.getElementById(targetId);

                // Close any other open dropdown
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

        // Close dropdowns on outside click
        document.addEventListener('click', (e) => {
            if (activeDropdown) {
                // If the click is inside the active dropdown panel, do nothing (don't close it)
                if (activeDropdown.contains(e.target)) return;

                activeDropdown.classList.remove('show');
                const btn = activeDropdown.parentElement.querySelector('[data-dropdown]');
                btn?.classList.remove('active');
                btn?.setAttribute('aria-expanded', 'false');
                activeDropdown = null;
            }
        });

        // Close on Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && activeDropdown) {
                activeDropdown.classList.remove('show');
                const btn = activeDropdown.parentElement.querySelector('[data-dropdown]');
                btn?.classList.remove('active');
                btn?.setAttribute('aria-expanded', 'false');
                activeDropdown = null;
            }
        });

        // ==============================================
        // 3. MOBILE DRAWER
        // ==============================================
        const mobileToggle = document.getElementById('mobileToggle');
        const mobileDrawer = document.getElementById('mobileDrawer');

        mobileToggle?.addEventListener('click', () => {
            const isOpen = mobileToggle.classList.toggle('open');
            if (isOpen) {
                if (mobileDrawer) {
                    mobileDrawer.style.display = 'flex';
                    requestAnimationFrame(() => {
                        mobileDrawer.classList.add('open');
                    });
                }
                document.body.style.overflow = 'hidden';
            } else {
                if (mobileDrawer) {
                    mobileDrawer.classList.remove('open');
                    setTimeout(() => { mobileDrawer.style.display = 'none'; }, 350);
                }
                document.body.style.overflow = '';
            }
        });

        // ==============================================
        // 4. CATEGORY CHIP FILTERING
        // ==============================================
        const chips = document.querySelectorAll('.hero-chips .chip');
        const catCards = document.querySelectorAll('.cat-card');

        chips.forEach(chip => {
            chip.addEventListener('click', () => {
                // Toggle active state
                chips.forEach(c => c.classList.remove('active'));
                chip.classList.add('active');

                const category = chip.dataset.category;

                catCards.forEach(card => {
                    if (category === 'all' || card.dataset.cat === category) {
                        card.style.display = '';
                        card.style.opacity = '0';
                        card.style.transform = 'translateY(20px)';
                        requestAnimationFrame(() => {
                            card.style.transition = 'all 0.4s ease';
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0)';
                        });
                    } else {
                        card.style.transition = 'all 0.3s ease';
                        card.style.opacity = '0';
                        card.style.transform = 'translateY(10px)';
                        setTimeout(() => { card.style.display = 'none'; }, 300);
                    }
                });
            });
        });

        // ==============================================
        // 5. SEARCH INPUT INTERACTION
        // ==============================================
        const searchInput = document.getElementById('heroSearch');
        const searchBtn = document.getElementById('searchBtn');

        // Glow effect on focus
        searchInput?.addEventListener('focus', () => {
            if (searchInput.parentElement) {
                searchInput.parentElement.style.transform = 'scale(1.015)';
                searchInput.parentElement.style.transition = 'transform 0.3s ease';
            }
        });

        searchInput?.addEventListener('blur', () => {
            if (searchInput.parentElement) {
                searchInput.parentElement.style.transform = 'scale(1)';
            }
        });

        // Filter cards via search
        function performSearch() {
            const query = searchInput.value.trim().toLowerCase();
            if (!query) {
                // Reset — show all
                chips.forEach(c => c.classList.remove('active'));
                if(chips.length > 0) chips[0].classList.add('active');
                catCards.forEach(card => {
                    card.style.display = '';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                });
                return;
            }

            // Deactivate chips
            chips.forEach(c => c.classList.remove('active'));

            catCards.forEach(card => {
                const title = card.querySelector('h3').textContent.toLowerCase();
                const desc = card.querySelector('p').textContent.toLowerCase();
                const match = title.includes(query) || desc.includes(query);

                if (match) {
                    card.style.display = '';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                } else {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(10px)';
                    setTimeout(() => { card.style.display = 'none'; }, 250);
                }
            });
        }

        searchBtn?.addEventListener('click', (e) => {
            e.preventDefault();
            performSearch();
        });
        searchInput?.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                performSearch();
            }
        });

        // Live search on typing (debounced)
        let searchTimer;
        searchInput?.addEventListener('input', () => {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(performSearch, 300);
        });

        // ==============================================
        // 6. FLOATING ICONS — PARALLAX ON MOUSE MOVE
        // ==============================================
        const heroRight = document.getElementById('heroRight');
        const floatingIcons = document.querySelectorAll('.floating-icon');

        // Parallax on mousemove (desktop only)
        if (heroRight && window.innerWidth > 1024) {
            const hero = document.getElementById('hero');

            hero.addEventListener('mousemove', (e) => {
                const rect = hero.getBoundingClientRect();
                const x = (e.clientX - rect.left) / rect.width - 0.5;
                const y = (e.clientY - rect.top) / rect.height - 0.5;

                floatingIcons.forEach((icon, i) => {
                    const depth = 1 + (i % 3) * 0.6;
                    const moveX = x * 20 * depth;
                    const moveY = y * 15 * depth;
                    // Pause CSS animation, apply parallax transform
                    icon.style.animationPlayState = 'paused';
                    icon.style.transform = `translate(${moveX}px, ${moveY}px)`;
                    icon.style.transition = 'transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
                });
            });

            hero.addEventListener('mouseleave', () => {
                floatingIcons.forEach(icon => {
                    icon.style.transform = '';
                    icon.style.animationPlayState = 'running';
                    icon.style.transition = 'transform 0.8s ease';
                });
            });
        }

        // ==============================================
        // 7. SCROLL REVEAL — Cards
        // ==============================================
        const revealElements = document.querySelectorAll('.cat-card');

        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const siblings = Array.from(entry.target.parentElement.children);
                    const index = siblings.indexOf(entry.target);
                    setTimeout(() => {
                        entry.target.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
                        entry.target.classList.add('revealed');
                    }, index * 100);
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });

        revealElements.forEach(el => revealObserver.observe(el));



        // ==============================================
        // 10. NAVBAR SEARCH TOGGLE (focus search)
        // ==============================================
        const navSearchToggle = document.getElementById('searchToggle');
        navSearchToggle?.addEventListener('click', () => {
            const heroSearch = document.getElementById('heroSearch');
            if (heroSearch) {
                heroSearch.scrollIntoView({ behavior: 'smooth', block: 'center' });
                setTimeout(() => heroSearch.focus(), 500);
            }
        });

    })();
    </script>

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
        // FAQ Accordion
        document.querySelectorAll('.faq-question').forEach(button => {
            button.addEventListener('click', () => {
                const item = button.closest('.faq-item');
                const answer = item.querySelector('.faq-answer');
                
                // Close other open faqs
                document.querySelectorAll('.faq-item.active').forEach(activeItem => {
                    if (activeItem !== item) {
                        activeItem.classList.remove('active');
                        activeItem.querySelector('.faq-answer').style.maxHeight = null;
                    }
                });

                item.classList.toggle('active');
                
                if (item.classList.contains('active')) {
                    answer.style.maxHeight = answer.scrollHeight + "px";
                } else {
                    answer.style.maxHeight = null;
                }
            });
        });
    </script>
</body>
</html>