<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — Investdu</title>
    <meta name="description" content="Dashboard belajar investasi Investdu. Pantau progress, lanjutkan modul, dan raih achievement.">

    {{-- Google Fonts: Inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ===========================================================
           INVESTDU DASHBOARD — PREMIUM EDTECH DESIGN
           Inspired by Duolingo · Notion · Bibit · Ruangguru · Linear
           =========================================================== */

        /* --- Design Tokens (Dark Navy — matched to home.blade.php) --- */
        :root {
            --primary: #2563EB;
            --primary-light: #3B82F6;
            --primary-bg: rgba(37, 99, 235, 0.12);
            --accent: #D4AF37;
            --accent-bg: rgba(212, 175, 55, 0.12);
            --success: #10B981;
            --warning: #F59E0B;
            --danger: #EF4444;
            --info: #60A5FA;
            --bg: #0F172A;
            --surface: #1E293B;
            --text: #F8FAFC;
            --text-secondary: #CBD5E1;
            --text-muted: #64748B;
            --border: rgba(71, 85, 105, 0.35);
            --border-light: rgba(71, 85, 105, 0.18);
            --shadow-sm: 0 1px 2px rgba(0,0,0,0.2);
            --shadow: 0 1px 3px rgba(0,0,0,0.3), 0 1px 2px rgba(0,0,0,0.2);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.3), 0 2px 4px -2px rgba(0,0,0,0.2);
            --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.3), 0 4px 6px -4px rgba(0,0,0,0.2);
            --radius: 20px;
            --radius-md: 16px;
            --radius-sm: 12px;
            --radius-xs: 8px;
            --sidebar-w: 272px;
            --topbar-h: 0px;
        }

        /* --- Reset & Base --- */
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        html {
            scroll-behavior: smooth;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: var(--bg);
            color: var(--text);
            line-height: 1.6;
            overflow-x: hidden;
        }

        ::selection {
            background-color: rgba(37, 99, 235, 0.35);
            color: var(--text);
        }

        a { text-decoration: none; color: inherit; }
        button { font-family: inherit; cursor: pointer; border: none; background: none; }
        img { max-width: 100%; display: block; }

        /* ===========================================================
           SIDEBAR
           =========================================================== */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-w);
            height: 100vh;
            background: var(--surface);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            z-index: 50;
            overflow-y: auto;
            overflow-x: hidden;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar::-webkit-scrollbar { width: 4px; }
        .sidebar::-webkit-scrollbar-track { background: transparent; }
        .sidebar::-webkit-scrollbar-thumb { background: var(--border); border-radius: 4px; }

        /* Sidebar Logo */
        .sb-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 24px 24px 20px;
            font-size: 1.25rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            color: var(--text);
            text-decoration: none;
            flex-shrink: 0;
        }

        .sb-logo-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            flex-shrink: 0;
        }

        .sb-logo .accent { color: #3B82F6; }

        /* Sidebar Navigation */
        .sb-section {
            padding: 0 16px;
            margin-bottom: 8px;
        }

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
            padding: 10px 12px;
            border-radius: var(--radius-xs);
            color: var(--text-secondary);
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s ease;
            cursor: pointer;
            width: 100%;
            text-align: left;
            position: relative;
        }

        .sb-nav-item:hover {
            background-color: var(--border-light);
            color: var(--text);
        }

        .sb-nav-item.active {
            background-color: var(--primary-bg);
            color: var(--primary-light);
            font-weight: 600;
        }

        .sb-nav-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 20px;
            background: var(--primary);
            border-radius: 0 3px 3px 0;
        }

        .sb-nav-item svg {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
            opacity: 0.7;
        }

        .sb-nav-item.active svg { opacity: 1; }

        .sb-nav-item .badge-count {
            margin-left: auto;
            background: var(--danger);
            color: #fff;
            font-size: 0.6875rem;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 10px;
            line-height: 1.2;
        }

        .sb-nav-item .module-emoji {
            font-size: 1.125rem;
            width: 20px;
            text-align: center;
            flex-shrink: 0;
        }

        /* Sidebar Spacer & Bottom */
        .sb-spacer { flex: 1; }

        .sb-bottom {
            padding: 16px;
            flex-shrink: 0;
        }

        .sb-cta-card {
            background: linear-gradient(135deg, #2563EB 0%, #3B82F6 100%);
            border-radius: var(--radius-sm);
            padding: 20px;
            color: #fff;
            margin-bottom: 12px;
        }

        .sb-cta-card h4 {
            font-size: 0.8125rem;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .sb-cta-card p {
            font-size: 0.75rem;
            opacity: 0.85;
            line-height: 1.5;
            margin-bottom: 12px;
        }

        .sb-cta-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            background: rgba(255,255,255,0.2);
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: var(--radius-xs);
            color: #fff;
            font-size: 0.75rem;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .sb-cta-btn:hover {
            background: rgba(255,255,255,0.3);
        }

        .sb-cta-btn svg { width: 14px; height: 14px; }

        /* Sidebar User */
        .sb-user {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            border-radius: var(--radius-sm);
            border: 1px solid var(--border);
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
        }

        .sb-user:hover {
            background: var(--border-light);
        }

        .sb-user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, #2563EB 0%, #3B82F6 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8125rem;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
            text-transform: uppercase;
        }

        .sb-user-info {
            flex: 1;
            min-width: 0;
        }

        .sb-user-name {
            font-size: 0.8125rem;
            font-weight: 600;
            color: var(--text);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sb-user-email {
            font-size: 0.6875rem;
            color: var(--text-muted);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sb-user-chevron {
            width: 16px;
            height: 16px;
            color: var(--text-muted);
            flex-shrink: 0;
            transition: transform 0.2s ease;
        }

        /* User Dropdown */
        .sb-user-dropdown {
            position: absolute;
            bottom: calc(100% + 8px);
            left: 0;
            right: 0;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 6px;
            box-shadow: var(--shadow-lg);
            opacity: 0;
            visibility: hidden;
            transform: translateY(4px);
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 60;
        }

        .sb-user-dropdown.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .sb-ud-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            border-radius: var(--radius-xs);
            color: var(--text-secondary);
            font-size: 0.8125rem;
            font-weight: 500;
            transition: all 0.15s ease;
            width: 100%;
            cursor: pointer;
        }

        .sb-ud-item:hover {
            background: var(--border-light);
            color: var(--text);
        }

        .sb-ud-item svg { width: 16px; height: 16px; flex-shrink: 0; }

        .sb-ud-item.danger { color: #F87171; }
        .sb-ud-item.danger:hover { background: rgba(239, 68, 68, 0.1); }

        .sb-ud-divider {
            height: 1px;
            background: var(--border);
            margin: 4px 0;
        }

        /* Sidebar Overlay (mobile) */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.3);
            z-index: 40;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .sidebar-overlay.show {
            display: block;
            opacity: 1;
        }

        /* ===========================================================
           MAIN CONTENT AREA
           =========================================================== */
        .main {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Top Bar (mobile) */
        .topbar {
            display: none;
            position: sticky;
            top: 0;
            z-index: 30;
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 0 20px;
            height: 60px;
            align-items: center;
            justify-content: space-between;
        }

        .topbar-hamburger {
            display: flex;
            flex-direction: column;
            gap: 5px;
            padding: 6px;
        }

        .topbar-hamburger span {
            display: block;
            width: 20px;
            height: 2px;
            background: var(--text);
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .topbar-logo {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 1.125rem;
            font-weight: 800;
            color: var(--text);
        }

        .topbar-logo .accent { color: #3B82F6; }
        .topbar-logo svg { width: 28px; height: 28px; }

        .topbar-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, #2563EB, #3B82F6);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 700;
            color: #fff;
            text-transform: uppercase;
        }

        /* Content wrapper */
        .content {
            flex: 1;
            padding: 32px 40px;
            max-width: 1120px;
            width: 100%;
        }

        /* ===========================================================
           HERO WELCOME SECTION
           =========================================================== */
        .hero-welcome {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 24px;
            margin-bottom: 32px;
        }

        .hero-left {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .hero-greeting {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--text);
            letter-spacing: -0.03em;
            margin-bottom: 4px;
            line-height: 1.3;
        }

        .hero-subtitle {
            font-size: 1rem;
            color: var(--text-muted);
            margin-bottom: 24px;
            line-height: 1.6;
        }

        /* XP & Streak Row */
        .hero-stats-row {
            display: flex;
            align-items: center;
            gap: 24px;
            margin-bottom: 24px;
        }

        .hero-stat {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .hero-stat-icon {
            width: 44px;
            height: 44px;
            border-radius: var(--radius-xs);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .hero-stat-icon.xp {
            background: rgba(37, 99, 235, 0.15);
        }

        .hero-stat-icon.streak {
            background: var(--accent-bg);
        }

        .hero-stat-icon.level {
            background: rgba(139, 92, 246, 0.15);
        }

        .hero-stat-text .stat-value {
            font-size: 1.125rem;
            font-weight: 800;
            color: var(--text);
            line-height: 1.2;
        }

        .hero-stat-text .stat-label {
            font-size: 0.75rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .hero-continue-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 28px;
            background: #2563EB;
            color: #fff;
            font-size: 0.9375rem;
            font-weight: 700;
            border-radius: var(--radius-sm);
            transition: all 0.25s ease;
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.3);
            align-self: flex-start;
        }

        .hero-continue-btn:hover {
            background: #3B82F6;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.35);
        }

        .hero-continue-btn svg { width: 18px; height: 18px; }

        /* Goal Card */
        .goal-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 28px;
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
        }

        .goal-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #2563EB, #D4AF37);
        }

        .goal-card-label {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.6875rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--primary);
            background: var(--primary-bg);
            padding: 4px 10px;
            border-radius: 6px;
            margin-bottom: 16px;
        }

        .goal-card h3 {
            font-size: 1.0625rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 6px;
            letter-spacing: -0.01em;
        }

        .goal-card-target {
            font-size: 0.8125rem;
            color: var(--text-muted);
            margin-bottom: 20px;
        }

        .goal-progress-wrap {
            margin-bottom: 16px;
        }

        .goal-progress-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .goal-progress-header span {
            font-size: 0.8125rem;
            font-weight: 600;
        }

        .goal-progress-header .pct {
            color: #60A5FA;
        }

        .goal-progress-bar {
            width: 100%;
            height: 10px;
            background: var(--border-light);
            border-radius: 5px;
            overflow: hidden;
        }

        .goal-progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #2563EB, #3B82F6);
            border-radius: 5px;
            transition: width 1.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .goal-meta {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .goal-meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.8125rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .goal-meta-item svg { width: 16px; height: 16px; color: var(--text-muted); }

        /* ===========================================================
           KEY METRICS
           =========================================================== */
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 32px;
        }

        .metric-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 24px;
            box-shadow: var(--shadow-sm);
            transition: all 0.25s ease;
        }

        .metric-card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .metric-icon {
            width: 48px;
            height: 48px;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            font-size: 1.375rem;
        }

        .metric-icon.green { background: rgba(16, 185, 129, 0.15); }
        .metric-icon.blue { background: rgba(59, 130, 246, 0.15); }
        .metric-icon.amber { background: rgba(212, 175, 55, 0.15); }
        .metric-icon.purple { background: rgba(139, 92, 246, 0.15); }

        .metric-value {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--text);
            letter-spacing: -0.03em;
            line-height: 1;
            margin-bottom: 4px;
        }

        .metric-label {
            font-size: 0.8125rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* ===========================================================
           SECTION HEADERS
           =========================================================== */
        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text);
            letter-spacing: -0.02em;
        }

        .section-link {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 0.8125rem;
            font-weight: 600;
            color: var(--primary);
            transition: all 0.2s ease;
        }

        .section-link:hover { color: var(--primary-light); }
        .section-link svg { width: 16px; height: 16px; transition: transform 0.2s ease; }
        .section-link:hover svg { transform: translateX(3px); }

        /* ===========================================================
           CONTINUE LEARNING — Horizontal Cards
           =========================================================== */
        .continue-section { margin-bottom: 40px; }

        .continue-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .continue-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 24px;
            display: flex;
            gap: 20px;
            transition: all 0.25s ease;
            box-shadow: var(--shadow-sm);
            position: relative;
            overflow: hidden;
        }

        .continue-card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-3px);
            border-color: rgba(37, 99, 235, 0.4);
        }

        .continue-card-icon {
            width: 72px;
            height: 72px;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            flex-shrink: 0;
        }

        .continue-card-body {
            flex: 1;
            min-width: 0;
        }

        .continue-card-body h3 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 6px;
            letter-spacing: -0.01em;
        }

        .continue-card-meta {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
        }

        .continue-card-meta span {
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .continue-card-meta svg { width: 14px; height: 14px; }

        .difficulty-pill {
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 0.6875rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .difficulty-pill.beginner { background: rgba(16, 185, 129, 0.15); color: #34D399; }
        .difficulty-pill.intermediate { background: rgba(245, 158, 11, 0.15); color: #FBBF24; }
        .difficulty-pill.advanced { background: rgba(239, 68, 68, 0.15); color: #F87171; }

        .continue-progress {
            margin-bottom: 14px;
        }

        .continue-progress-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 6px;
        }

        .continue-progress-header span {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-muted);
        }

        .continue-progress-header .pct {
            color: #60A5FA;
            font-weight: 700;
        }

        .progress-track {
            width: 100%;
            height: 6px;
            background: var(--border-light);
            border-radius: 3px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            border-radius: 3px;
            transition: width 1s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .fill-green { background: linear-gradient(90deg, #059669, #10B981); }
        .fill-blue { background: linear-gradient(90deg, #2563EB, #3B82F6); }
        .fill-amber { background: linear-gradient(90deg, #B8860B, #D4AF37); }
        .fill-purple { background: linear-gradient(90deg, #7C3AED, #A78BFA); }

        .continue-card-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 20px;
            background: #2563EB;
            color: #fff;
            font-size: 0.8125rem;
            font-weight: 600;
            border-radius: var(--radius-xs);
            transition: all 0.2s ease;
        }

        .continue-card-btn:hover {
            background: #3B82F6;
        }

        .continue-card-btn svg { width: 14px; height: 14px; }

        /* ===========================================================
           LEARNING PROGRESS
           =========================================================== */
        .progress-section { margin-bottom: 40px; }

        .progress-list {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .progress-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 20px 24px;
            border-bottom: 1px solid var(--border-light);
            transition: background 0.15s ease;
        }

        .progress-item:last-child { border-bottom: none; }
        .progress-item:hover { background: var(--border-light); }

        .progress-item-emoji {
            font-size: 1.5rem;
            width: 28px;
            text-align: center;
            flex-shrink: 0;
        }

        .progress-item-info {
            flex: 1;
            min-width: 0;
        }

        .progress-item-info h4 {
            font-size: 0.9375rem;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 2px;
        }

        .progress-item-info p {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .progress-item-bar {
            width: 200px;
            flex-shrink: 0;
        }

        .progress-item-bar-header {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 4px;
        }

        .progress-item-bar-header span {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--primary);
        }

        /* ===========================================================
           TWO-COLUMN: ACHIEVEMENTS + ROADMAP
           =========================================================== */
        .two-col {
            display: grid;
            grid-template-columns: 1fr;
            gap: 24px;
            margin-bottom: 40px;
        }

        /* Achievements */
        .achievements-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 28px;
            box-shadow: var(--shadow-sm);
        }

        .achievements-card .section-title { margin-bottom: 20px; }

        .badge-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 20px;
        }

        .badge-item {
            text-align: center;
            padding: 20px 12px;
            border-radius: var(--radius-sm);
            border: 1px solid var(--border);
            transition: all 0.25s ease;
            position: relative;
        }

        .badge-item:hover {
            border-color: rgba(212, 175, 55, 0.5);
            box-shadow: 0 4px 12px rgba(212, 175, 55, 0.1);
            transform: translateY(-2px);
        }

        .badge-item.locked {
            opacity: 0.5;
            filter: grayscale(0.6);
        }

        .badge-item.locked::after {
            content: '🔒';
            position: absolute;
            top: 8px;
            right: 8px;
            font-size: 0.75rem;
        }

        .badge-emoji {
            font-size: 2.25rem;
            margin-bottom: 10px;
            display: block;
        }

        .badge-name {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text);
            line-height: 1.3;
        }

        .next-badge-banner {
            background: rgba(212, 175, 55, 0.08);
            border: 1px solid rgba(212, 175, 55, 0.25);
            border-radius: var(--radius-sm);
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .next-badge-banner .emoji { font-size: 1.5rem; }

        .next-badge-banner .text {
            font-size: 0.8125rem;
            color: #D4AF37;
            font-weight: 500;
        }

        .next-badge-banner .text strong {
            font-weight: 700;
            color: #F5D472;
        }

        /* Roadmap */
        .roadmap-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 28px;
            box-shadow: var(--shadow-sm);
        }

        .roadmap-card .section-title { margin-bottom: 24px; }

        .roadmap-steps {
            position: relative;
            padding-left: 32px;
        }

        .roadmap-steps::before {
            content: '';
            position: absolute;
            left: 11px;
            top: 8px;
            bottom: 8px;
            width: 2px;
            background: var(--border);
        }

        .roadmap-step {
            position: relative;
            padding-bottom: 28px;
        }

        .roadmap-step:last-child { padding-bottom: 0; }

        .roadmap-dot {
            position: absolute;
            left: -32px;
            top: 2px;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 700;
            z-index: 2;
        }

        .roadmap-dot.completed {
            background: var(--primary);
            color: #fff;
        }

        .roadmap-dot.current {
            background: var(--surface);
            border: 3px solid #2563EB;
            color: #60A5FA;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.2);
        }

        .roadmap-dot.locked {
            background: var(--border-light);
            border: 2px solid var(--border);
            color: var(--text-muted);
        }

        .roadmap-step h4 {
            font-size: 0.9375rem;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 2px;
        }

        .roadmap-step.is-locked h4 { color: var(--text-muted); }

        .roadmap-step p {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .roadmap-step .current-label {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 0.6875rem;
            font-weight: 700;
            color: #60A5FA;
            background: var(--primary-bg);
            padding: 2px 8px;
            border-radius: 4px;
            margin-top: 6px;
        }

        /* ===========================================================
           RECENT ACTIVITY — Timeline
           =========================================================== */
        .activity-section { margin-bottom: 40px; }

        .activity-timeline {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 28px;
            box-shadow: var(--shadow-sm);
        }

        .activity-item {
            display: flex;
            gap: 16px;
            padding-bottom: 24px;
            position: relative;
        }

        .activity-item:last-child { padding-bottom: 0; }

        .activity-dot-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex-shrink: 0;
        }

        .activity-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            flex-shrink: 0;
            margin-top: 4px;
        }

        .activity-dot.green { background: var(--success); }
        .activity-dot.blue { background: var(--info); }
        .activity-dot.amber { background: var(--accent); }
        .activity-dot.purple { background: #8B5CF6; }

        .activity-line {
            width: 2px;
            flex: 1;
            background: var(--border-light);
            margin-top: 6px;
        }

        .activity-item:last-child .activity-line { display: none; }

        .activity-content h4 {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 2px;
        }

        .activity-content p {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        /* ===========================================================
           BOTTOM ANALYTICS
           =========================================================== */
        .analytics-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 40px;
        }

        .analytics-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 24px;
            box-shadow: var(--shadow-sm);
            text-align: center;
            transition: all 0.25s ease;
        }

        .analytics-card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .analytics-card-icon {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 14px;
            font-size: 1.5rem;
        }

        .analytics-card .a-value {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--text);
            letter-spacing: -0.02em;
            margin-bottom: 2px;
        }

        .analytics-card .a-label {
            font-size: 0.8125rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* ===========================================================
           FOOTER
           =========================================================== */
        .dash-footer {
            padding: 24px 40px;
            border-top: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .dash-footer-brand {
            font-size: 0.875rem;
            font-weight: 700;
            color: var(--text-muted);
        }

        .dash-footer-brand .accent { color: var(--primary); }

        .dash-footer-copy {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        /* ===========================================================
           SCROLL REVEAL
           =========================================================== */
        .reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ===========================================================
           RESPONSIVE
           =========================================================== */
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main {
                margin-left: 0;
            }

            .topbar {
                display: flex;
            }

            .content {
                padding: 24px 20px;
            }

            .hero-welcome {
                grid-template-columns: 1fr;
            }

            .metrics-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .continue-grid {
                grid-template-columns: 1fr;
            }

            .two-col {
                grid-template-columns: 1fr;
            }

            .analytics-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .progress-item-bar {
                width: 140px;
            }

            .dash-footer {
                padding: 20px;
                flex-direction: column;
                gap: 8px;
                text-align: center;
            }
        }

        @media (max-width: 640px) {
            .hero-stats-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .metrics-grid {
                grid-template-columns: 1fr 1fr;
                gap: 12px;
            }

            .metric-card { padding: 16px; }
            .metric-value { font-size: 1.25rem; }

            .badge-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .analytics-grid {
                grid-template-columns: 1fr 1fr;
                gap: 12px;
            }

            .progress-item {
                flex-wrap: wrap;
                gap: 8px;
            }

            .progress-item-bar {
                width: 100%;
            }

            .hero-greeting { font-size: 1.375rem; }
        }
    </style>
</head>
<body>

    {{-- ============================================================
         SIDEBAR
         ============================================================ --}}
    <aside class="sidebar" id="sidebar">
        {{-- Logo --}}
        <a href="/" class="sb-logo">
            <svg class="sb-logo-icon" viewBox="0 0 36 36" fill="none">
                <rect width="36" height="36" rx="10" fill="#2563EB"/>
                <path d="M9 26L15 13L19 20L24 11L27 16" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                <circle cx="27" cy="16" r="2.2" fill="#D4AF37"/>
            </svg>
            INVEST<span class="accent">DU</span>
        </a>

        {{-- Dashboard Section --}}
        <div class="sb-section">
            <div class="sb-section-label">Dashboard</div>
            <a href="/dashboard" class="sb-nav-item active">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                Overview
            </a>
            <a href="#" class="sb-nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="22,12 18,12 15,21 9,3 6,12 2,12"/></svg>
                Learning Progress
            </a>
            <a href="#" class="sb-nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                Notifikasi
                <span class="badge-count">3</span>
            </a>
        </div>

        {{-- Learning Modules --}}
        <div class="sb-section">
            <div class="sb-section-label">Modul Belajar</div>
            <a href="#" class="sb-nav-item">
                <span class="module-emoji">📚</span>
                Dasar Investasi
            </a>
            <a href="#" class="sb-nav-item">
                <span class="module-emoji">📊</span>
                Reksa Dana
            </a>
            <a href="#" class="sb-nav-item">
                <span class="module-emoji">📈</span>
                Saham
            </a>
            <a href="#" class="sb-nav-item">
                <span class="module-emoji">📜</span>
                Obligasi
            </a>
            <a href="#" class="sb-nav-item">
                <span class="module-emoji">🪙</span>
                Emas
            </a>
            <a href="#" class="sb-nav-item">
                <span class="module-emoji">🏠</span>
                Properti
            </a>
            <a href="#" class="sb-nav-item">
                <span class="module-emoji">🏦</span>
                Tabungan Berjangka
            </a>
        </div>



        {{-- Spacer --}}
        <div class="sb-spacer"></div>

        {{-- Bottom CTAs --}}
        <div class="sb-bottom">
            <div class="sb-cta-card">
                <h4>🤝 Komunitas Investdu</h4>
                <p>Diskusi dan belajar bersama investor lain.</p>
                <a href="#" class="sb-cta-btn">
                    Gabung Sekarang
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 8h10M9 4l4 4-4 4"/></svg>
                </a>
            </div>

            {{-- User Profile --}}
            <div class="sb-user" id="sbUserBtn">
                <div class="sb-user-avatar">
                    {{ strtoupper(substr(Auth::user()->username ?? 'U', 0, 2)) }}
                </div>
                <div class="sb-user-info">
                    <div class="sb-user-name">{{ Auth::user()->username ?? 'User' }}</div>
                    <div class="sb-user-email">{{ Auth::user()->email }}</div>
                </div>
                <svg class="sb-user-chevron" viewBox="0 0 16 16" fill="none"><path d="M4 10L8 6L12 10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>

                {{-- User dropdown --}}
                <div class="sb-user-dropdown" id="sbUserDropdown">
                    <a href="#" class="sb-ud-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        Edit Profil
                    </a>
                    <a href="#" class="sb-ud-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                        Pengaturan
                    </a>
                    @if(Auth::user()->is_admin == 1)
                    <a href="/admin" class="sb-ud-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
                        Admin Panel
                    </a>
                    @endif
                    <div class="sb-ud-divider"></div>
                    <form action="/logout" method="POST" style="margin:0;">
                        @csrf
                        <button type="submit" class="sb-ud-item danger">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </aside>

    {{-- Sidebar Overlay (mobile) --}}
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    {{-- ============================================================
         MAIN CONTENT
         ============================================================ --}}
    <div class="main">

        {{-- Mobile Top Bar --}}
        <header class="topbar" id="topbar">
            <button class="topbar-hamburger" id="hamburgerBtn" aria-label="Open menu">
                <span></span><span></span><span></span>
            </button>
            <a href="/" class="topbar-logo">
                <svg viewBox="0 0 36 36" fill="none"><rect width="36" height="36" rx="10" fill="#2563EB"/><path d="M9 26L15 13L19 20L24 11L27 16" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/><circle cx="27" cy="16" r="2.2" fill="#D4AF37"/></svg>
                INVEST<span class="accent">DU</span>
            </a>
            <div class="topbar-avatar">
                {{ strtoupper(substr(Auth::user()->username ?? 'U', 0, 2)) }}
            </div>
        </header>

        <div class="content">

            {{-- ====== HERO WELCOME ====== --}}
            <section class="hero-welcome reveal">
                <div class="hero-left">
                    <h1 class="hero-greeting">Halo, {{ Auth::user()->username ?? 'Investor' }} 👋</h1>
                    <p class="hero-subtitle">Lanjutkan perjalanan investasi Anda hari ini. Konsistensi adalah kunci kesuksesan.</p>

                    <div class="hero-stats-row">
                        <div class="hero-stat">
                            <div class="hero-stat-icon xp">⚡</div>
                            <div class="hero-stat-text">
                                <div class="stat-value">1,250</div>
                                <div class="stat-label">Total XP</div>
                            </div>
                        </div>
                        <div class="hero-stat">
                            <div class="hero-stat-icon streak">🔥</div>
                            <div class="hero-stat-text">
                                <div class="stat-value">7 Hari</div>
                                <div class="stat-label">Streak Belajar</div>
                            </div>
                        </div>
                        <div class="hero-stat">
                            <div class="hero-stat-icon level">🎯</div>
                            <div class="hero-stat-text">
                                <div class="stat-value">Level 3</div>
                                <div class="stat-label">Investor Muda</div>
                            </div>
                        </div>
                    </div>

                    <a href="#continue-section" class="hero-continue-btn">
                        Lanjutkan Belajar
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5l7 7-7 7"/></svg>
                    </a>
                </div>

                <div class="goal-card">
                    <div class="goal-card-label">🎯 Target Mingguan</div>
                    <h3>Menyelesaikan Dasar Investasi</h3>
                    <p class="goal-card-target">Selesaikan 3 modul lagi untuk mendapat sertifikat.</p>
                    <div class="goal-progress-wrap">
                        <div class="goal-progress-header">
                            <span>Progress</span>
                            <span class="pct">75%</span>
                        </div>
                        <div class="goal-progress-bar">
                            <div class="goal-progress-fill" style="width: 75%;"></div>
                        </div>
                    </div>
                    <div class="goal-meta">
                        <div class="goal-meta-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                            5 Hari tersisa
                        </div>
                        <div class="goal-meta-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                            3 Modul lagi
                        </div>
                    </div>
                </div>
            </section>

            {{-- ====== KEY METRICS ====== --}}
            <section class="metrics-grid reveal">
                <div class="metric-card">
                    <div class="metric-icon green">📖</div>
                    <div class="metric-value">24</div>
                    <div class="metric-label">Materi Dipelajari</div>
                </div>
                <div class="metric-card">
                    <div class="metric-icon blue">✅</div>
                    <div class="metric-value">8</div>
                    <div class="metric-label">Modul Selesai</div>
                </div>
                <div class="metric-card">
                    <div class="metric-icon amber">🔥</div>
                    <div class="metric-value">7</div>
                    <div class="metric-label">Streak Belajar</div>
                </div>

            </section>

            {{-- ====== CONTINUE LEARNING ====== --}}
            <section class="continue-section reveal" id="continue-section">
                <div class="section-header">
                    <h2 class="section-title">Lanjutkan Belajar</h2>
                    <a href="#" class="section-link">
                        Lihat Semua
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 8h10M9 4l4 4-4 4"/></svg>
                    </a>
                </div>
                <div class="continue-grid">
                    {{-- Card 1 --}}
                    <div class="continue-card">
                        <div class="continue-card-icon" style="background: rgba(59, 130, 246, 0.15);">📊</div>
                        <div class="continue-card-body">
                            <h3>Reksa Dana untuk Pemula</h3>
                            <div class="continue-card-meta">
                                <span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                                    15 menit tersisa
                                </span>
                                <span class="difficulty-pill beginner">Beginner</span>
                            </div>
                            <div class="continue-progress">
                                <div class="continue-progress-header">
                                    <span>Progress</span>
                                    <span class="pct">60%</span>
                                </div>
                                <div class="progress-track">
                                    <div class="progress-fill fill-blue" style="width: 60%;"></div>
                                </div>
                            </div>
                            <a href="#" class="continue-card-btn">
                                Lanjutkan
                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 8h10M9 4l4 4-4 4"/></svg>
                            </a>
                        </div>
                    </div>

                    {{-- Card 2 --}}
                    <div class="continue-card">
                        <div class="continue-card-icon" style="background: rgba(16, 185, 129, 0.15);">📈</div>
                        <div class="continue-card-body">
                            <h3>Portofolio Saham Blue-Chip</h3>
                            <div class="continue-card-meta">
                                <span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                                    45 menit tersisa
                                </span>
                                <span class="difficulty-pill intermediate">Intermediate</span>
                            </div>
                            <div class="continue-progress">
                                <div class="continue-progress-header">
                                    <span>Progress</span>
                                    <span class="pct">35%</span>
                                </div>
                                <div class="progress-track">
                                    <div class="progress-fill fill-green" style="width: 35%;"></div>
                                </div>
                            </div>
                            <a href="#" class="continue-card-btn">
                                Lanjutkan
                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 8h10M9 4l4 4-4 4"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            {{-- ====== LEARNING PROGRESS ====== --}}
            <section class="progress-section reveal">
                <div class="section-header">
                    <h2 class="section-title">Progress Belajar</h2>
                </div>
                <div class="progress-list">
                    <div class="progress-item">
                        <span class="progress-item-emoji">📚</span>
                        <div class="progress-item-info">
                            <h4>Dasar Investasi</h4>
                            <p>Bab 6 dari 8 — Diversifikasi Portofolio</p>
                        </div>
                        <div class="progress-item-bar">
                            <div class="progress-item-bar-header"><span>75%</span></div>
                            <div class="progress-track"><div class="progress-fill fill-green" style="width:75%;"></div></div>
                        </div>
                    </div>
                    <div class="progress-item">
                        <span class="progress-item-emoji">📊</span>
                        <div class="progress-item-info">
                            <h4>Reksa Dana</h4>
                            <p>Bab 4 dari 7 — NAB & Strategi DCA</p>
                        </div>
                        <div class="progress-item-bar">
                            <div class="progress-item-bar-header"><span>60%</span></div>
                            <div class="progress-track"><div class="progress-fill fill-blue" style="width:60%;"></div></div>
                        </div>
                    </div>
                    <div class="progress-item">
                        <span class="progress-item-emoji">📈</span>
                        <div class="progress-item-info">
                            <h4>Saham</h4>
                            <p>Bab 3 dari 12 — Analisis Fundamental</p>
                        </div>
                        <div class="progress-item-bar">
                            <div class="progress-item-bar-header"><span>35%</span></div>
                            <div class="progress-track"><div class="progress-fill fill-green" style="width:35%;"></div></div>
                        </div>
                    </div>
                    <div class="progress-item">
                        <span class="progress-item-emoji">🪙</span>
                        <div class="progress-item-info">
                            <h4>Emas</h4>
                            <p>Bab 2 dari 5 — Harga Emas & Inflasi</p>
                        </div>
                        <div class="progress-item-bar">
                            <div class="progress-item-bar-header"><span>40%</span></div>
                            <div class="progress-track"><div class="progress-fill fill-amber" style="width:40%;"></div></div>
                        </div>
                    </div>
                    <div class="progress-item">
                        <span class="progress-item-emoji">📜</span>
                        <div class="progress-item-info">
                            <h4>Obligasi</h4>
                            <p>Belum dimulai</p>
                        </div>
                        <div class="progress-item-bar">
                            <div class="progress-item-bar-header"><span>0%</span></div>
                            <div class="progress-track"><div class="progress-fill fill-purple" style="width:0%;"></div></div>
                        </div>
                    </div>
                    <div class="progress-item">
                        <span class="progress-item-emoji">🏠</span>
                        <div class="progress-item-info">
                            <h4>Properti</h4>
                            <p>Belum dimulai</p>
                        </div>
                        <div class="progress-item-bar">
                            <div class="progress-item-bar-header"><span>0%</span></div>
                            <div class="progress-track"><div class="progress-fill fill-green" style="width:0%;"></div></div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- ====== TWO-COL: ACHIEVEMENTS + ROADMAP ====== --}}
            <div class="two-col reveal">


                {{-- Roadmap --}}
                <div class="roadmap-card">
                    <h2 class="section-title">🗺️ Investment Journey</h2>
                    <div class="roadmap-steps">
                        <div class="roadmap-step">
                            <div class="roadmap-dot completed">✓</div>
                            <h4>Financial Literacy</h4>
                            <p>Mengenal dasar keuangan & budgeting</p>
                        </div>
                        <div class="roadmap-step">
                            <div class="roadmap-dot completed">✓</div>
                            <h4>Investment Fundamentals</h4>
                            <p>Memahami instrumen investasi</p>
                        </div>
                        <div class="roadmap-step">
                            <div class="roadmap-dot current">3</div>
                            <h4>Portfolio Building</h4>
                            <p>Membangun portofolio pertama Anda</p>
                            <span class="current-label">📍 Posisi Anda saat ini</span>
                        </div>
                        <div class="roadmap-step is-locked">
                            <div class="roadmap-dot locked">4</div>
                            <h4>Advanced Investor</h4>
                            <p>Strategi lanjutan & analisis teknikal</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ====== RECENT ACTIVITY ====== --}}
            <section class="activity-section reveal">
                <div class="section-header">
                    <h2 class="section-title">Aktivitas Terakhir</h2>
                </div>
                <div class="activity-timeline">
                    <div class="activity-item">
                        <div class="activity-dot-wrap">
                            <div class="activity-dot green"></div>
                            <div class="activity-line"></div>
                        </div>
                        <div class="activity-content">
                            <h4>✅ Menyelesaikan Modul Dasar Investasi Bab 5</h4>
                            <p>Hari ini, 14:30</p>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot-wrap">
                            <div class="activity-dot blue"></div>
                            <div class="activity-line"></div>
                        </div>
                        <div class="activity-content">
                            <h4>📝 Lulus Quiz Reksa Dana — Skor 85%</h4>
                            <p>Kemarin, 10:15</p>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot-wrap">
                            <div class="activity-dot amber"></div>
                            <div class="activity-line"></div>
                        </div>
                        <div class="activity-content">
                            <h4>🏅 Mendapatkan Badge "Investor Pemula"</h4>
                            <p>2 hari lalu</p>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot-wrap">
                            <div class="activity-dot purple"></div>
                            <div class="activity-line"></div>
                        </div>
                        <div class="activity-content">
                            <h4>🎮 Bermain Game Edukasi — Skor 920</h4>
                            <p>3 hari lalu</p>
                        </div>
                    </div>
                </div>
            </section>

            {{-- ====== BOTTOM ANALYTICS ====== --}}
            <section class="analytics-grid reveal">
                <div class="analytics-card">
                    <div class="analytics-card-icon" style="background: rgba(16, 185, 129, 0.15);">⏱️</div>
                    <div class="a-value">12.5</div>
                    <div class="a-label">Total Jam Belajar</div>
                </div>
                <div class="analytics-card">
                    <div class="analytics-card-icon" style="background: rgba(59, 130, 246, 0.15);">📝</div>
                    <div class="a-value">18</div>
                    <div class="a-label">Quiz Diselesaikan</div>
                </div>
                <div class="analytics-card">
                    <div class="analytics-card-icon" style="background: var(--accent-bg);">📊</div>
                    <div class="a-value">82%</div>
                    <div class="a-label">Nilai Rata-Rata</div>
                </div>

            </section>

        </div>

        {{-- ====== FOOTER ====== --}}
        <footer class="dash-footer">
            <div class="dash-footer-brand">INVEST<span class="accent">DU</span></div>
            <p class="dash-footer-copy">&copy; {{ date('Y') }} Investdu. All rights reserved.</p>
        </footer>

    </div>

    {{-- ============================================================
         JAVASCRIPT
         ============================================================ --}}
    <script>
    (function() {
        'use strict';

        // ==============================================
        // 1. SIDEBAR TOGGLE (Mobile)
        // ==============================================
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const hamburger = document.getElementById('hamburgerBtn');

        function openSidebar() {
            sidebar.classList.add('open');
            overlay.classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {
            sidebar.classList.remove('open');
            overlay.classList.remove('show');
            document.body.style.overflow = '';
        }

        if (hamburger) {
            hamburger.addEventListener('click', openSidebar);
        }

        if (overlay) {
            overlay.addEventListener('click', closeSidebar);
        }

        // Close sidebar on Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeSidebar();
        });

        // ==============================================
        // 2. USER DROPDOWN (Sidebar bottom)
        // ==============================================
        const userBtn = document.getElementById('sbUserBtn');
        const userDrop = document.getElementById('sbUserDropdown');

        if (userBtn && userDrop) {
            userBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                userDrop.classList.toggle('show');
            });

            document.addEventListener('click', () => {
                userDrop.classList.remove('show');
            });

            userDrop.addEventListener('click', (e) => e.stopPropagation());
        }

        // ==============================================
        // 3. SCROLL REVEAL
        // ==============================================
        const revealElements = document.querySelectorAll('.reveal');

        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.add('visible');
                    }, i * 100);
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.08, rootMargin: '0px 0px -30px 0px' });

        revealElements.forEach(el => revealObserver.observe(el));

        // ==============================================
        // 4. ACTIVE NAV ITEM HIGHLIGHT
        // ==============================================
        const navItems = document.querySelectorAll('.sb-nav-item');
        navItems.forEach(item => {
            item.addEventListener('click', function() {
                navItems.forEach(n => n.classList.remove('active'));
                this.classList.add('active');
            });
        });

    })();
    </script>

</body>
</html>