<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Admin Panel') — investdu</title>

    {{-- Google Fonts: Press Start 2P (pixel) + Space Mono --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">

    {{-- Vite compiled assets (Tailwind CSS + JS) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ===== BASE RESET ===== */
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Space Mono', monospace;
            background-color: #0a0e1a;
            color: #c9d1d9;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .font-pixel { font-family: 'Press Start 2P', monospace; }
        .font-mono  { font-family: 'Space Mono', monospace; }

        /* ===== LAYOUT GRID ===== */
        .admin-layout {
            display: flex;
            min-height: 100vh;
        }

        /* ===== SIDEBAR ===== */
        .admin-sidebar {
            width: 260px;
            min-height: 100vh;
            background-color: #060a14;
            border-right: 3px solid #1a1f2e;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 50;
            transition: transform 0.3s ease;
        }

        .sidebar-header {
            padding: 1.5rem 1.25rem;
            border-bottom: 3px solid #1a1f2e;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .sidebar-logo-icon {
            display: inline-block;
            font-size: 1.2rem;
            animation: bounce-coin 2s ease-in-out infinite;
        }

        @keyframes bounce-coin {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-3px); }
        }

        .sidebar-logo-text {
            font-family: 'Press Start 2P', monospace;
            font-size: 0.75rem;
            color: #FFD000;
            text-shadow: 2px 2px 0px #b38f00;
            letter-spacing: 1px;
        }

        .sidebar-logo-badge {
            font-family: 'Press Start 2P', monospace;
            font-size: 0.4rem;
            color: #0a0e1a;
            background-color: #f85149;
            padding: 3px 6px;
            border: 2px solid #0a0e1a;
            margin-left: 4px;
            letter-spacing: 1px;
        }

        .sidebar-nav {
            flex: 1;
            padding: 1rem 0;
            overflow-y: auto;
        }

        .nav-section-label {
            font-family: 'Press Start 2P', monospace;
            font-size: 0.4rem;
            color: #484f58;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 0.75rem 1.25rem 0.5rem;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.7rem 1.25rem;
            font-family: 'Space Mono', monospace;
            font-size: 0.8rem;
            font-weight: 700;
            color: #6e7681;
            text-decoration: none;
            transition: all 0.15s ease;
            border-left: 3px solid transparent;
            position: relative;
        }

        .nav-item:hover {
            color: #c9d1d9;
            background-color: rgba(255, 255, 255, 0.03);
            border-left-color: #2d333b;
        }

        .nav-item.active {
            color: #FFD000;
            background-color: rgba(255, 208, 0, 0.05);
            border-left-color: #FFD000;
        }

        .nav-item-icon {
            width: 20px;
            text-align: center;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .nav-item-badge {
            margin-left: auto;
            font-family: 'Press Start 2P', monospace;
            font-size: 0.35rem;
            color: #0a0e1a;
            background-color: #FFD000;
            padding: 2px 5px;
            border: 1px solid #0a0e1a;
        }

        /* Sidebar user info */
        .sidebar-footer {
            padding: 1rem 1.25rem;
            border-top: 3px solid #1a1f2e;
        }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
        }

        .sidebar-user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 4px;
            border: 2px solid #FFD000;
            background-color: #1a1f2e;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
        }

        .sidebar-user-info {
            flex: 1;
            min-width: 0;
        }

        .sidebar-user-name {
            font-family: 'Space Mono', monospace;
            font-size: 0.75rem;
            font-weight: 700;
            color: #c9d1d9;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar-user-role {
            font-family: 'Press Start 2P', monospace;
            font-size: 0.35rem;
            color: #FFD000;
            letter-spacing: 1px;
        }

        .btn-logout {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
            font-family: 'Space Mono', monospace;
            font-size: 0.75rem;
            font-weight: 700;
            color: #f85149;
            background-color: rgba(248, 81, 73, 0.08);
            border: 2px solid #3d1a1a;
            padding: 0.5rem;
            cursor: pointer;
            transition: all 0.15s ease;
        }

        .btn-logout:hover {
            background-color: rgba(248, 81, 73, 0.15);
            border-color: #f85149;
        }

        /* ===== MAIN CONTENT AREA ===== */
        .admin-main {
            flex: 1;
            margin-left: 260px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Top bar */
        .admin-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem 1.5rem;
            background-color: #0d1120;
            border-bottom: 3px solid #1a1f2e;
            position: sticky;
            top: 0;
            z-index: 40;
        }

        .topbar-breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-family: 'Space Mono', monospace;
            font-size: 0.75rem;
            color: #484f58;
        }

        .topbar-breadcrumb span {
            color: #c9d1d9;
            font-weight: 700;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .topbar-time {
            font-family: 'Space Mono', monospace;
            font-size: 0.7rem;
            color: #484f58;
            padding: 0.3rem 0.75rem;
            background-color: rgba(255, 255, 255, 0.03);
            border: 1px solid #1a1f2e;
        }

        .topbar-status {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-family: 'Press Start 2P', monospace;
            font-size: 0.4rem;
            color: #3fb950;
            letter-spacing: 1px;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            background-color: #3fb950;
            animation: pulse-dot 2s ease-in-out infinite;
        }

        @keyframes pulse-dot {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.4; }
        }

        /* Content wrapper */
        .admin-content {
            flex: 1;
            padding: 1.5rem;
        }

        /* ===== MOBILE TOGGLE ===== */
        .mobile-sidebar-btn {
            display: none;
            background: none;
            border: 2px solid #1a1f2e;
            padding: 0.4rem 0.6rem;
            cursor: pointer;
            font-size: 1.2rem;
            line-height: 1;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 45;
        }

        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #0a0e1a; }
        ::-webkit-scrollbar-thumb { background: #1a1f2e; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #2d333b; }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }

            .admin-sidebar.open {
                transform: translateX(0);
            }

            .sidebar-overlay.open {
                display: block;
            }

            .admin-main {
                margin-left: 0;
            }

            .mobile-sidebar-btn {
                display: block;
            }
        }
    </style>
</head>
<body>

    {{-- ===== SIDEBAR ===== --}}
    <aside class="admin-sidebar" id="adminSidebar">

        {{-- Logo --}}
        <div class="sidebar-header">
            <a href="/" class="sidebar-logo">
                <span class="sidebar-logo-icon">💰</span>
                <span class="sidebar-logo-text">INVESTDU</span>
                <span class="sidebar-logo-badge">ADMIN</span>
            </a>
        </div>

        {{-- Navigation --}}
        <nav class="sidebar-nav">
            <div class="nav-section-label">── MAIN MENU ──</div>

            <a href="/admin" class="nav-item {{ request()->is('admin') && !request()->is('admin/*') ? 'active' : '' }}" id="navDashboard">
                <span class="nav-item-icon">🖥️</span>
                Dashboard
            </a>

            <a href="/admin/literasi" class="nav-item {{ request()->is('admin/literasi*') ? 'active' : '' }}" id="navLiterasi">
                <span class="nav-item-icon">📚</span>
                Kelola Literasi
            </a>

            <a href="/admin/articles" class="nav-item {{ request()->is('admin/articles*') ? 'active' : '' }}" id="navArticles">
                <span class="nav-item-icon">📝</span>
                Kelola Artikel
            </a>

            <a href="/admin/monitor-game" class="nav-item {{ request()->is('admin/monitor-game*') ? 'active' : '' }}" id="navGame">
                <span class="nav-item-icon">🎮</span>
                Monitor Game
            </a>

            <a href="/admin/forum-diskusi" class="nav-item {{ request()->is('admin/forum-diskusi*') ? 'active' : '' }}" id="navForum">
                <span class="nav-item-icon">💬</span>
                Forum Diskusi
            </a>

            <div class="nav-section-label" style="margin-top: 0.5rem;">── SYSTEM ──</div>



            <a href="/admin/users" class="nav-item {{ request()->is('admin/users*') ? 'active' : '' }}" id="navUsers">
                <span class="nav-item-icon">👥</span>
                Kelola User
            </a>
        </nav>

        {{-- Sidebar Footer (User Info + Logout) --}}
        <div class="sidebar-footer">
            <div class="sidebar-user">
                <div class="sidebar-user-avatar">👑</div>
                <div class="sidebar-user-info">
                    <div class="sidebar-user-name">{{ Auth::user()->username }}</div>
                    <div class="sidebar-user-role">GAME MASTER</div>
                </div>
            </div>
            <form action="/logout" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-logout" id="btnLogout">
                    🚪 <span>LOG OUT</span>
                </button>
            </form>
        </div>
    </aside>

    {{-- Mobile sidebar overlay --}}
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    {{-- ===== MAIN CONTENT ===== --}}
    <main class="admin-main">

        {{-- Topbar --}}
        <header class="admin-topbar">
            <div style="display: flex; align-items: center; gap: 0.75rem;">
                <button class="mobile-sidebar-btn" onclick="toggleSidebar()" id="btnMobileSidebar">☰</button>
                <div class="topbar-breadcrumb">
                    admin / <span>@yield('page-title', 'dashboard')</span>
                </div>
            </div>

            <div class="topbar-right">
                <div class="topbar-time" id="topbarClock">--:--:--</div>
                <div class="topbar-status">
                    <span class="status-dot"></span>
                    SYSTEM ONLINE
                </div>
            </div>
        </header>

        {{-- Page Content --}}
        <div class="admin-content">
            @yield('content')
        </div>

    </main>

    {{-- ===== JAVASCRIPT ===== --}}
    <script>
        // Live clock
        function updateClock() {
            const now = new Date();
            const h = String(now.getHours()).padStart(2, '0');
            const m = String(now.getMinutes()).padStart(2, '0');
            const s = String(now.getSeconds()).padStart(2, '0');
            document.getElementById('topbarClock').textContent = h + ':' + m + ':' + s;
        }
        updateClock();
        setInterval(updateClock, 1000);

        // Mobile sidebar toggle
        function toggleSidebar() {
            document.getElementById('adminSidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('open');
        }
    </script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
</body>
</html>
