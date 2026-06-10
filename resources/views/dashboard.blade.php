<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — Investdu</title>
    <meta name="description" content="Dashboard belajar investasi Investdu. Pantau histori bacaan dan kelola bookmark artikel.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css'])

    <style>
        /* ===== TOKENS ===== */
        :root {
            --primary: #2563EB;
            --primary-light: #3B82F6;
            --primary-bg: rgba(37, 99, 235, 0.10);
            --accent: #D4AF37;
            --accent-bg: rgba(212, 175, 55, 0.10);
            --success: #10B981;
            --danger: #EF4444;
            --bg: #0F172A;
            --surface: #1E293B;
            --surface-hover: #253348;
            --text: #F8FAFC;
            --text-secondary: #CBD5E1;
            --text-muted: #64748B;
            --border: rgba(71, 85, 105, 0.35);
            --border-light: rgba(71, 85, 105, 0.18);
            --radius: 16px;
            --radius-sm: 12px;
            --radius-xs: 8px;
            --sidebar-w: 280px;
        }

        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; -webkit-font-smoothing: antialiased; }
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.6;
            overflow-x: hidden;
        }
        ::selection { background: rgba(37, 99, 235, 0.35); color: var(--text); }
        a { text-decoration: none; color: inherit; }
        button { font-family: inherit; cursor: pointer; border: none; background: none; }

        /* ===== LAYOUT ===== */
        .app-layout {
            min-height: 100vh;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-w);
            height: 100vh;
            background: var(--surface);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            z-index: 50;
            overflow-y: auto;
        }
        .sidebar::-webkit-scrollbar { width: 4px; }
        .sidebar::-webkit-scrollbar-track { background: transparent; }
        .sidebar::-webkit-scrollbar-thumb { background: var(--border); border-radius: 4px; }

        .sb-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 24px 20px 16px;
            font-size: 1.25rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            color: var(--text);
            flex-shrink: 0;
        }
        .sb-logo-icon { width: 34px; height: 34px; border-radius: 9px; flex-shrink: 0; }
        .sb-logo .gold { color: var(--accent); }

        .sb-section { padding: 0 12px; margin-bottom: 4px; }
        .sb-section-label {
            font-size: 0.6875rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--text-muted);
            padding: 16px 8px 8px;
        }

        .sb-nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: var(--radius-xs);
            color: var(--text-secondary);
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s ease;
            position: relative;
            width: 100%;
            text-align: left;
        }
        .sb-nav-item:hover { background: var(--border-light); color: var(--text); }
        .sb-nav-item.active {
            background: var(--primary-bg);
            color: var(--primary-light);
            font-weight: 600;
        }
        .sb-nav-item.active::before {
            content: '';
            position: absolute;
            left: 0; top: 50%;
            transform: translateY(-50%);
            width: 3px; height: 20px;
            background: var(--primary);
            border-radius: 0 3px 3px 0;
        }
        .sb-nav-item svg,
        .sb-nav-item .cat-icon { width: 20px; height: 20px; flex-shrink: 0; opacity: 0.7; }
        .sb-nav-item.active svg,
        .sb-nav-item.active .cat-icon { opacity: 1; }
        .sb-nav-item .cat-icon { font-size: 1.125rem; text-align: center; width: 20px; }

        .sb-badge {
            margin-left: auto;
            font-size: 0.625rem;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 9999px;
            background: var(--primary-bg);
            color: var(--primary-light);
            border: 1px solid rgba(37, 99, 235, 0.2);
        }

        .sb-spacer { flex: 1; }

        .sb-bottom { padding: 12px; flex-shrink: 0; }

        .sb-home-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 14px;
            border-radius: var(--radius-sm);
            background: linear-gradient(135deg, #2563EB, #1D4ED8);
            color: #fff;
            font-size: 0.8125rem;
            font-weight: 700;
            transition: all 0.25s ease;
            width: 100%;
            margin-bottom: 10px;
        }
        .sb-home-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
        }
        .sb-home-btn svg { width: 18px; height: 18px; }

        /* ===== MAIN ===== */
        .main {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ===== TOPBAR ===== */
        .topbar {
            position: sticky;
            top: 0; z-index: 30;
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid var(--border);
            padding: 0 32px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .topbar-title {
            font-size: 1.125rem;
            font-weight: 700;
            letter-spacing: -0.02em;
        }

        .topbar-right { display: flex; align-items: center; gap: 12px; }

        .topbar-profile-wrap { position: relative; }
        .topbar-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 12px 6px 6px;
            border-radius: 9999px;
            border: 1px solid var(--border);
            background: var(--surface);
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .topbar-profile:hover { background: var(--surface-hover); border-color: rgba(37, 99, 235, 0.3); }

        .avatar {
            width: 34px; height: 34px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8125rem;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
            text-transform: uppercase;
            overflow: hidden;
        }
        .avatar.gradient { background: linear-gradient(135deg, #2563EB, #3B82F6); }
        .avatar img { width: 100%; height: 100%; object-fit: cover; }

        .topbar-profile-name {
            font-size: 0.8125rem;
            font-weight: 600;
            color: var(--text);
            max-width: 120px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .topbar-profile-chevron { width: 16px; height: 16px; color: var(--text-muted); transition: transform 0.2s; }

        /* Dropdown */
        .profile-dropdown {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            min-width: 220px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 6px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.4);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-4px);
            transition: all 0.2s ease;
            z-index: 60;
        }
        .profile-dropdown.show { opacity: 1; visibility: visible; transform: translateY(0); }
        .dd-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: var(--radius-xs);
            font-size: 0.8125rem;
            font-weight: 500;
            color: var(--text-secondary);
            transition: all 0.15s ease;
            width: 100%;
            cursor: pointer;
        }
        .dd-item:hover { background: var(--border-light); color: var(--text); }
        .dd-item svg { width: 16px; height: 16px; flex-shrink: 0; }
        .dd-item.danger { color: #F87171; }
        .dd-item.danger:hover { background: rgba(239, 68, 68, 0.1); }
        .dd-divider { height: 1px; background: var(--border); margin: 4px 0; }

        /* ===== CONTENT ===== */
        .content { flex: 1; padding: 32px; max-width: 1000px; width: 100%; }

        /* ===== WELCOME CARD ===== */
        .welcome-card {
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.12), rgba(212, 175, 55, 0.08));
            border: 1px solid rgba(37, 99, 235, 0.2);
            border-radius: var(--radius);
            padding: 32px;
            margin-bottom: 32px;
            position: relative;
            overflow: hidden;
        }
        .welcome-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, #2563EB, #D4AF37);
        }
        .welcome-card h1 {
            font-size: 1.625rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            margin-bottom: 6px;
        }
        .welcome-card p { color: var(--text-muted); font-size: 0.9375rem; }

        /* ===== SECTION ===== */
        .section { margin-bottom: 36px; }
        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }
        .section-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.125rem;
            font-weight: 700;
            letter-spacing: -0.02em;
        }
        .section-title svg { width: 22px; height: 22px; color: var(--primary-light); }
        .section-count {
            font-size: 0.6875rem;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 9999px;
            background: var(--primary-bg);
            color: var(--primary-light);
            border: 1px solid rgba(37, 99, 235, 0.2);
        }

        /* ===== ARTICLE CARDS ===== */
        .article-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 16px;
        }

        .article-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 20px;
            transition: all 0.25s ease;
            display: flex;
            flex-direction: column;
            gap: 12px;
            position: relative;
        }
        .article-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.3);
            border-color: rgba(37, 99, 235, 0.35);
        }

        .article-card-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 0.6875rem;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 6px;
            background: var(--primary-bg);
            color: var(--primary-light);
            border: 1px solid rgba(37, 99, 235, 0.15);
            width: fit-content;
        }
        .article-card-badge svg { width: 12px; height: 12px; }

        .article-card h3 {
            font-size: 0.9375rem;
            font-weight: 700;
            color: var(--text);
            letter-spacing: -0.01em;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .article-card p {
            font-size: 0.8125rem;
            color: var(--text-muted);
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .article-card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: auto;
            padding-top: 12px;
            border-top: 1px solid var(--border-light);
        }
        .article-card-date {
            font-size: 0.75rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .article-card-date svg { width: 14px; height: 14px; }

        .btn-bookmark-sm {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 0.6875rem;
            font-weight: 600;
            transition: all 0.2s ease;
            border: 1px solid var(--border);
            color: var(--text-muted);
            background: transparent;
        }
        .btn-bookmark-sm:hover { border-color: var(--accent); color: var(--accent); }
        .btn-bookmark-sm.active { background: var(--accent-bg); border-color: var(--accent); color: var(--accent); }
        .btn-bookmark-sm svg { width: 13px; height: 13px; }

        .btn-read {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 0.6875rem;
            font-weight: 600;
            background: var(--primary-bg);
            color: var(--primary-light);
            border: 1px solid rgba(37, 99, 235, 0.2);
            transition: all 0.2s ease;
        }
        .btn-read:hover { background: rgba(37, 99, 235, 0.2); }
        .btn-read svg { width: 13px; height: 13px; }

        /* ===== EMPTY STATE ===== */
        .empty-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 48px 24px;
            text-align: center;
            background: var(--surface);
            border: 1px dashed var(--border);
            border-radius: var(--radius);
        }
        .empty-icon { font-size: 2.5rem; margin-bottom: 12px; opacity: 0.4; }
        .empty-text { font-size: 0.9375rem; color: var(--text-muted); max-width: 360px; }
        .empty-action {
            margin-top: 16px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 20px;
            background: var(--primary);
            color: #fff;
            border-radius: var(--radius-xs);
            font-size: 0.8125rem;
            font-weight: 700;
            transition: all 0.25s ease;
        }
        .empty-action:hover { background: var(--primary-light); transform: translateY(-2px); }
        .empty-action svg { width: 16px; height: 16px; }

        /* ===== EDIT PROFILE MODAL ===== */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        .modal-overlay.show { opacity: 1; visibility: visible; }

        .modal {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 32px;
            width: 90%;
            max-width: 480px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.5);
            transform: scale(0.95) translateY(10px);
            transition: transform 0.3s ease;
        }
        .modal-overlay.show .modal { transform: scale(1) translateY(0); }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }
        .modal-title { font-size: 1.125rem; font-weight: 700; letter-spacing: -0.02em; }
        .modal-close {
            width: 32px; height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            transition: all 0.2s ease;
        }
        .modal-close:hover { background: var(--border-light); color: var(--text); }
        .modal-close svg { width: 18px; height: 18px; }

        .form-group { margin-bottom: 20px; }
        .form-label {
            display: block;
            font-size: 0.8125rem;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 6px;
        }
        .form-input {
            width: 100%;
            padding: 12px 14px;
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid var(--border);
            border-radius: var(--radius-xs);
            color: var(--text);
            font-family: 'Inter', sans-serif;
            font-size: 0.875rem;
            outline: none;
            transition: all 0.2s ease;
        }
        .form-input:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12); }
        .form-input::placeholder { color: var(--text-muted); }
        .form-hint { font-size: 0.75rem; color: var(--text-muted); margin-top: 4px; }

        .avatar-upload {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .avatar-preview {
            width: 72px; height: 72px;
            border-radius: 50%;
            background: linear-gradient(135deg, #2563EB, #3B82F6);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
            text-transform: uppercase;
            overflow: hidden;
        }
        .avatar-preview img { width: 100%; height: 100%; object-fit: cover; }

        .avatar-upload-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            background: var(--border-light);
            border: 1px solid var(--border);
            border-radius: var(--radius-xs);
            color: var(--text-secondary);
            font-size: 0.8125rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .avatar-upload-btn:hover { background: rgba(37, 99, 235, 0.1); color: var(--primary-light); border-color: rgba(37, 99, 235, 0.3); }
        .avatar-upload-btn svg { width: 16px; height: 16px; }

        .modal-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 28px;
            padding-top: 20px;
            border-top: 1px solid var(--border-light);
        }
        .btn-cancel {
            padding: 10px 20px;
            border-radius: var(--radius-xs);
            font-size: 0.8125rem;
            font-weight: 600;
            color: var(--text-muted);
            border: 1px solid var(--border);
            background: transparent;
            transition: all 0.2s ease;
        }
        .btn-cancel:hover { color: var(--text); background: var(--border-light); }
        .btn-save {
            padding: 10px 24px;
            border-radius: var(--radius-xs);
            font-size: 0.8125rem;
            font-weight: 700;
            color: #fff;
            background: var(--primary);
            transition: all 0.2s ease;
        }
        .btn-save:hover { background: var(--primary-light); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3); }

        /* ===== ALERT ===== */
        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.25);
            color: #10B981;
            padding: 12px 16px;
            border-radius: var(--radius-xs);
            font-size: 0.8125rem;
            font-weight: 500;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .alert-success svg { width: 18px; height: 18px; flex-shrink: 0; }

        /* ===== MOBILE TOPBAR ===== */
        .mobile-topbar {
            display: none;
            position: sticky;
            top: 0; z-index: 30;
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 0 16px;
            height: 56px;
            align-items: center;
            justify-content: space-between;
        }
        .hamburger { display: flex; flex-direction: column; gap: 5px; padding: 6px; }
        .hamburger span { display: block; width: 20px; height: 2px; background: var(--text); border-radius: 2px; }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.3);
            z-index: 40;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .sidebar-overlay.show { display: block; opacity: 1; }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .app-layout { grid-template-columns: 1fr; }
            .sidebar { transform: translateX(-100%); transition: transform 0.3s ease; }
            .sidebar.open { transform: translateX(0); }
            .main { margin-left: 0; }
            .mobile-topbar { display: flex; }
            .topbar { display: none; }
            .content { padding: 20px 16px; }
            .article-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    @php
        $categoryIcons = [
            'piggy-bank' => '🏦',
            'trending-up' => '📈',
            'users' => '📊',
            'file-text' => '📃',
            'home' => '🏠',
            'award' => '🥇',
            'cpu' => '💎',
        ];
    @endphp
    {{-- SIDEBAR OVERLAY (MOBILE) --}}
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="app-layout">

        {{-- ===== SIDEBAR ===== --}}
        <aside class="sidebar" id="sidebar">
            <a href="/" class="sb-logo">
                <svg class="sb-logo-icon" viewBox="0 0 34 34" fill="none">
                    <rect width="34" height="34" rx="9" fill="#2563EB"/>
                    <path d="M9 24L14 12L18 19L23 10L25 15" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <circle cx="25" cy="15" r="2.2" fill="#D4AF37"/>
                </svg>
                INVEST<span class="gold" style="margin-left: 0;">DU</span>
            </a>

            <div class="sb-section">
                <div class="sb-section-label">Menu Utama</div>
                <a href="#artikel" class="sb-nav-item active" onclick="showTab('artikel', this, event)">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    Artikel
                </a>
                <a href="#game" class="sb-nav-item" onclick="showTab('game', this, event)">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="6" width="20" height="12" rx="2"/><path d="M6 12h4"/><path d="M8 10v4"/><circle cx="15" cy="13" r="1"/><circle cx="18" cy="11" r="1"/></svg>
                    Game
                </a>
                <a href="#option" class="sb-nav-item" onclick="showTab('option', this, event)">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                    Option
                </a>
            </div>

            <div class="sb-section">
                <button type="button" class="sb-nav-item" onclick="toggleCatDropdown()" style="justify-content: space-between; width: 100%;">
                    <div style="display:flex; align-items:center; gap:12px;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                        Kategori Investasi
                    </div>
                    <svg id="catChevron" style="width:16px;height:16px; transition: transform 0.3s ease; {{ $activeSlug ? 'transform: rotate(180deg);' : '' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="6 9 12 15 18 9"/></svg>
                </button>
                <div id="catDropdown" style="display: {{ $activeSlug ? 'block' : 'none' }}; margin-top: 4px; padding-left: 12px;">
                    @foreach($categories as $cat)
                        <a href="/dashboard?category={{ $cat->slug }}#artikel" class="sb-nav-item{{ $activeSlug === $cat->slug ? ' active' : '' }}" style="padding: 8px 12px; font-size: 0.8rem;">
                            <span class="cat-icon" style="font-size:1rem;">{{ $categoryIcons[$cat->icon] ?? '📁' }}</span>
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="sb-spacer"></div>

            <div class="sb-bottom">
                <a href="/" class="sb-home-btn">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                    Kembali ke Beranda
                </a>
            </div>
        </aside>

        {{-- ===== MAIN ===== --}}
        <div class="main">

            {{-- MOBILE TOPBAR --}}
            <div class="mobile-topbar">
                <button class="hamburger" onclick="toggleSidebar()">
                    <span></span><span></span><span></span>
                </button>
                <span style="font-weight:800;font-size:1.1rem;letter-spacing:-0.03em;">INVEST<span class="gold" style="color:#D4AF37; margin-left:0;">DU</span></span>
                <button onclick="toggleProfileDropdown()" style="padding:4px;">
                    <div class="avatar gradient" style="width:32px;height:32px;font-size:0.75rem;">
                        @if($user->profile_picture)
                            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="avatar">
                        @else
                            {{ strtoupper(substr($user->username, 0, 2)) }}
                        @endif
                    </div>
                </button>
            </div>

            {{-- DESKTOP TOPBAR --}}
            <header class="topbar">
                <h2 class="topbar-title">
                    @if($activeCategory)
                        {{ $activeCategory->name }}
                    @else
                        Dashboard
                    @endif
                </h2>

                <div class="topbar-right">
                    <div class="topbar-profile-wrap">
                        <button class="topbar-profile" id="profileBtn" onclick="toggleProfileDropdown()">
                            <div class="avatar gradient">
                                @if($user->profile_picture)
                                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="avatar">
                                @else
                                    {{ strtoupper(substr($user->username, 0, 2)) }}
                                @endif
                            </div>
                            <span class="topbar-profile-name">{{ $user->username }}</span>
                            <svg class="topbar-profile-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </button>

                        <div class="profile-dropdown" id="profileDropdown">
                            <a href="#option" class="dd-item" onclick="showTab('option', null, event); document.getElementById('profileDropdown').classList.remove('show')">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                Edit Profil
                            </a>
                            <div class="dd-divider"></div>
                            <form action="/logout" method="POST" style="margin:0;">
                                @csrf
                                <button type="submit" class="dd-item danger">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            {{-- CONTENT --}}
            <div class="content">

                @if(session('success'))
                    <div class="alert-success">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.25);color:#F87171;padding:12px 16px;border-radius:8px;font-size:0.8125rem;margin-bottom:20px;">
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif


                {{-- ==============================
                     ARTIKEL SECTION
                     ============================== --}}
                <section id="artikel" class="tab-section" style="padding-top: 20px; margin-bottom: 60px;">
                @if(!$activeCategory)
                    <div class="welcome-card">
                        <h1>👋 Halo, {{ $user->username }}!</h1>
                        <p>Selamat datang kembali di dashboard belajar investasi kamu.</p>
                    </div>

                    {{-- KATEGORI INVESTASI --}}
                    <div class="section">
                        <div class="section-header">
                            <h2 class="section-title">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                                Kategori Investasi
                            </h2>
                        </div>
                        <div class="article-grid">
                            @foreach($categories as $cat)
                                <a href="/dashboard?category={{ $cat->slug }}" class="article-card" style="text-align: center; align-items: center; justify-content: center; padding: 30px 20px;">
                                    <span style="font-size: 3rem; margin-bottom: 12px;">{{ $categoryIcons[$cat->icon] ?? '📁' }}</span>
                                    <h3 style="font-size: 1.25rem;">{{ $cat->name }}</h3>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- CATEGORY HEADER --}}
                @if($activeCategory)
                    <div class="welcome-card">
                        <h1>{{ $categoryIcons[$activeCategory->icon] ?? '📁' }} {{ $activeCategory->name }}</h1>
                        <p>{{ $activeCategory->description }}</p>
                    </div>
                @endif

                {{-- ARTIKEL TERAKHIR DIBACA --}}
                <div class="section">
                    <div class="section-header">
                        <h2 class="section-title">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            @if($activeCategory)
                                Artikel yang Sudah Dibaca
                            @else
                                Artikel Terakhir Dibaca
                            @endif
                        </h2>
                        <span class="section-count">{{ $readArticles->count() }} artikel</span>
                    </div>

                    @if($readArticles->count() > 0)
                        <div class="article-grid">
                            @foreach($readArticles as $article)
                                <div class="article-card">
                                    <span class="article-card-badge">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                                        {{ $article->category->name ?? ($activeCategory->name ?? '') }}
                                    </span>
                                    <h3>{{ $article->title }}</h3>
                                    <p>{{ $article->excerpt ?? Str::limit(strip_tags($article->body), 100) }}</p>
                                    <div class="article-card-footer">
                                        <span class="article-card-date">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                                            {{ $article->pivot->read_at ? \Carbon\Carbon::parse($article->pivot->read_at)->translatedFormat('d M Y') : $article->created_at->translatedFormat('d M Y') }}
                                        </span>
                                        <div style="display:flex;gap:6px;">
                                            <form action="/dashboard/bookmark/{{ $article->id }}" method="POST">
                                                @csrf
                                                @php $isBookmarked = $user->bookmarkedArticles()->where('article_id', $article->id)->exists(); @endphp
                                                <button type="submit" class="btn-bookmark-sm{{ $isBookmarked ? ' active' : '' }}" title="{{ $isBookmarked ? 'Hapus Bookmark' : 'Bookmark' }}">
                                                    <svg viewBox="0 0 24 24" fill="{{ $isBookmarked ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/></svg>
                                                </button>
                                            </form>
                                            <a href="/belajar/{{ $article->category->slug ?? ($activeCategory->slug ?? '#') }}/{{ $article->slug }}" class="btn-read">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <div class="empty-icon">📚</div>
                            <p class="empty-text">
                                @if($activeCategory)
                                    Belum ada artikel yang kamu baca di kategori ini.
                                @else
                                    Belum ada artikel yang kamu baca. Mulai jelajahi kategori investasi!
                                @endif
                            </p>
                            <a href="/" class="empty-action">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                                Jelajahi Artikel
                            </a>
                        </div>
                    @endif
                </div>

                {{-- BOOKMARK --}}
                <div class="section">
                    <div class="section-header">
                        <h2 class="section-title">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/></svg>
                            @if($activeCategory)
                                Bookmark di {{ $activeCategory->name }}
                            @else
                                Artikel Tersimpan
                            @endif
                        </h2>
                        <span class="section-count">{{ $bookmarkedArticles->count() }} artikel</span>
                    </div>

                    @if($bookmarkedArticles->count() > 0)
                        <div class="article-grid">
                            @foreach($bookmarkedArticles as $article)
                                <div class="article-card">
                                    <span class="article-card-badge">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/></svg>
                                        {{ $article->category->name ?? ($activeCategory->name ?? '') }}
                                    </span>
                                    <h3>{{ $article->title }}</h3>
                                    <p>{{ $article->excerpt ?? Str::limit(strip_tags($article->body), 100) }}</p>
                                    <div class="article-card-footer">
                                        <span class="article-card-date">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                                            {{ $article->created_at->translatedFormat('d M Y') }}
                                        </span>
                                        <div style="display:flex;gap:6px;">
                                            <form action="/dashboard/bookmark/{{ $article->id }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn-bookmark-sm active" title="Hapus Bookmark">
                                                    <svg viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/></svg>
                                                </button>
                                            </form>
                                            <a href="/belajar/{{ $article->category->slug ?? ($activeCategory->slug ?? '#') }}/{{ $article->slug }}" class="btn-read">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <div class="empty-icon">🔖</div>
                            <p class="empty-text">
                                @if($activeCategory)
                                    Belum ada bookmark di kategori ini.
                                @else
                                    Kamu belum menyimpan artikel apapun. Gunakan ikon bookmark saat membaca artikel!
                                @endif
                            </p>
                        </div>
                    @endif
                </div>
                </section>

                {{-- ==============================
                     GAME SECTION
                     ============================== --}}
                <section id="game" class="tab-section" style="padding-top: 40px; margin-bottom: 60px; display: none;">
                    <div class="section-header">
                        <h2 class="section-title">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="6" width="20" height="12" rx="2"/><path d="M6 12h4"/><path d="M8 10v4"/><circle cx="15" cy="13" r="1"/><circle cx="18" cy="11" r="1"/></svg>
                            @if($activeCategory)
                                Nilai & Histori Game {{ $activeCategory->name }}
                            @else
                                Nilai & Histori Game Terbaru
                            @endif
                        </h2>
                        <span class="section-count">{{ $gameScores->count() }} game dimainkan</span>
                    </div>

                    @if($gameScores->count() > 0)
                        <div class="article-grid">
                            @foreach($gameScores as $score)
                                <div class="article-card" style="padding: 20px; display: flex; flex-direction: column; gap: 12px; border: 1px solid var(--border); border-radius: var(--radius); background: var(--surface);">
                                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                                        <span class="article-card-badge" style="background: rgba(16, 185, 129, 0.1); color: #10B981; margin: 0;">
                                            @if($score->game_type === 'trivia')
                                                Kuis Trivia
                                            @else
                                                Benar / Salah
                                            @endif
                                        </span>
                                        <span style="font-size: 0.8rem; color: var(--text-light);">
                                            {{ $score->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                    <h3 style="margin: 0; font-size: 1.1rem; color: var(--text);">Kategori: {{ $score->category->name ?? 'Campuran' }}</h3>
                                    
                                    <div style="display: flex; align-items: center; justify-content: space-between; margin-top: auto; padding-top: 12px; border-top: 1px dashed var(--border);">
                                        <div style="display: flex; align-items: center; gap: 8px;">
                                            <span style="font-size: 1.5rem;">
                                                @php
                                                    $percentage = ($score->correct_answers / max(1, $score->total_questions)) * 100;
                                                @endphp
                                                {{ $percentage >= 80 ? '🏆' : ($percentage >= 60 ? '🌟' : ($percentage >= 40 ? '💪' : '📚')) }}
                                            </span>
                                            <div style="display: flex; flex-direction: column;">
                                                <span style="font-size: 0.8rem; color: var(--text-light);">Skor</span>
                                                <span style="font-weight: bold; color: var(--gold);">{{ $score->score }} PTS</span>
                                            </div>
                                        </div>
                                        <div style="text-align: right;">
                                            <span style="font-size: 0.8rem; color: var(--text-light);">Jawaban Benar</span>
                                            <div style="font-weight: 600; color: var(--text);">{{ $score->correct_answers }} / {{ $score->total_questions }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state" style="padding: 60px 24px;">
                            <div class="empty-icon">🎮</div>
                            <p class="empty-text">Kamu belum pernah memainkan game. Yuk, selesaikan game untuk mengumpulkan nilai pertamamu!</p>
                            <a href="/" class="empty-action" style="margin-top: 20px;">
                                Coba Main Game
                            </a>
                        </div>
                    @endif
                </section>

                {{-- ==============================
                     OPTION SECTION
                     ============================== --}}
                <section id="option" class="tab-section" style="padding-top: 40px; margin-bottom: 60px; display: none;">
                    <div class="section-header">
                        <h2 class="section-title">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                            Pengaturan Profil
                        </h2>
                    </div>

                    <div style="background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); padding: 32px; max-width: 600px;">
                        <form action="/user/profile/update" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="form-label">Foto Profil</label>
                                <div class="avatar-upload">
                                    <div class="avatar-preview" id="avatarPreviewOption">
                                        @if($user->profile_picture)
                                            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="avatar" style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            <span>{{ strtoupper(substr($user->username, 0, 2)) }}</span>
                                        @endif
                                    </div>
                                    <div>
                                        <label class="avatar-upload-btn" for="profilePicInputOption">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                                            Upload Foto
                                        </label>
                                        <input type="file" id="profilePicInputOption" name="profile_picture" accept="image/*" style="display:none;" onchange="previewAvatarOption(this)">
                                        <p class="form-hint">JPG, PNG, WebP. Maks. 2MB.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="editUsernameOption">Username</label>
                                <input type="text" class="form-input" id="editUsernameOption" name="username" value="{{ $user->username }}" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="editPasswordOption">Password Baru</label>
                                <input type="password" class="form-input" id="editPasswordOption" name="password" placeholder="Kosongkan jika tidak ingin ganti">
                                <p class="form-hint">Minimal 6 karakter. Kosongkan jika tidak ingin mengubah password.</p>
                            </div>

                            <div style="margin-top: 24px; padding-top: 20px; border-top: 1px solid var(--border-light); display: flex; justify-content: flex-end;">
                                <button type="submit" class="btn-save">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </section>

            </div>
        </div>
    </div>



    <script>
        // Profile dropdown
        function toggleProfileDropdown() {
            const dropdown = document.getElementById('profileDropdown');
            dropdown.classList.toggle('show');
        }

        // Close dropdown on outside click
        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('profileDropdown');
            const btn = document.getElementById('profileBtn');
            if (dropdown && btn && !btn.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.remove('show');
            }
        });

        // Tab navigation state
        function showTab(tabId, element, event) {
            if (event) {
                event.preventDefault();
                history.pushState(null, null, '#' + tabId);
            }

            // Hide all sections
            document.querySelectorAll('.tab-section').forEach(el => {
                el.style.display = 'none';
            });

            // Show target section
            const target = document.getElementById(tabId);
            if (target) {
                target.style.display = 'block';
            }

            // Update active state in sidebar menu
            document.querySelectorAll('.sb-nav-item').forEach(el => {
                if (el.getAttribute('href') && el.getAttribute('href').startsWith('#')) {
                    el.classList.remove('active');
                }
            });

            if (element) {
                element.classList.add('active');
            } else {
                // If called without element (e.g. from topbar), find the element manually
                const link = document.querySelector(`.sb-nav-item[href="#${tabId}"]`);
                if (link) link.classList.add('active');
            }
        }

        // Initialize tabs on page load based on URL hash
        document.addEventListener('DOMContentLoaded', function() {
            let hash = window.location.hash.substring(1);
            if (hash === 'game' || hash === 'option') {
                showTab(hash, null, null);
            } else {
                showTab('artikel', null, null);
            }
        });

        // Sidebar Category Dropdown
        function toggleCatDropdown() {
            const dropdown = document.getElementById('catDropdown');
            const chevron = document.getElementById('catChevron');
            if (dropdown.style.display === 'none' || dropdown.style.display === '') {
                dropdown.style.display = 'block';
                chevron.style.transform = 'rotate(180deg)';
            } else {
                dropdown.style.display = 'none';
                chevron.style.transform = 'rotate(0deg)';
            }
        }

        // Avatar preview
        function previewAvatarOption(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('avatarPreviewOption');
                    preview.innerHTML = '<img src="' + e.target.result + '" alt="avatar">';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Mobile sidebar toggle
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('open');
            overlay.classList.toggle('show');
        }

        document.getElementById('sidebarOverlay').addEventListener('click', function() {
            document.getElementById('sidebar').classList.remove('open');
            this.classList.remove('show');
        });
    </script>
</body>
</html>