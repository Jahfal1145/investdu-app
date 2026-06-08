<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Diskusi — Investdu</title>
    <meta name="description" content="Diskusikan topik investasi bersama komunitas Investdu.">

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

        .logo-icon { width: 32px; height: 32px; border-radius: 8px; }
        .logo .gold { color: #D4AF37; }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .nav-link {
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

        .nav-link:hover {
            color: #F8FAFC;
            background: rgba(37, 99, 235, 0.12);
            border-color: rgba(37, 99, 235, 0.4);
        }

        .nav-link svg { width: 16px; height: 16px; }

        .btn-logout {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.5rem 1rem;
            border-radius: 0.625rem;
            background: rgba(239, 68, 68, 0.08);
            border: 1px solid rgba(239, 68, 68, 0.25);
            color: #F87171;
            font-size: 0.8125rem;
            font-weight: 600;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            background: rgba(239, 68, 68, 0.15);
            border-color: rgba(239, 68, 68, 0.4);
        }

        /* ===== HERO ===== */
        .page-hero {
            position: relative;
            padding: 3rem 2rem 2rem;
            background: linear-gradient(135deg, #0F172A 0%, #131C31 40%, #162036 100%);
            overflow: hidden;
        }

        .page-hero::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
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
            width: 300px; height: 300px;
            background: rgba(37, 99, 235, 0.07);
            top: -30%; right: 10%;
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
            margin-bottom: 1.25rem;
        }

        .hero-breadcrumb a { color: #60A5FA; transition: color 0.2s; }
        .hero-breadcrumb a:hover { color: #93C5FD; }
        .hero-breadcrumb svg { width: 14px; height: 14px; }

        .hero-title {
            font-size: clamp(1.5rem, 3vw, 2rem);
            font-weight: 900;
            letter-spacing: -0.04em;
            line-height: 1.1;
            margin-bottom: 0.5rem;
        }

        .hero-desc {
            font-size: 0.9375rem;
            color: #94A3B8;
            max-width: 600px;
        }

        /* ===== FORUM LAYOUT ===== */
        .forum-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 1.5rem 2rem 4rem;
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 1.5rem;
            min-height: calc(100vh - 280px);
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            background: #1E293B;
            border: 1px solid rgba(71, 85, 105, 0.28);
            border-radius: 1rem;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            height: fit-content;
            position: sticky;
            top: 80px;
        }

        .sidebar-header {
            padding: 1.25rem 1.25rem 1rem;
            border-bottom: 1px solid rgba(71, 85, 105, 0.2);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .sidebar-title {
            font-size: 0.8125rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #94A3B8;
        }

        .sidebar-badge {
            font-size: 0.6875rem;
            font-weight: 600;
            padding: 0.25rem 0.625rem;
            border-radius: 9999px;
            background: rgba(37, 99, 235, 0.12);
            border: 1px solid rgba(37, 99, 235, 0.25);
            color: #60A5FA;
        }

        .room-list {
            padding: 0.75rem;
            display: flex;
            flex-direction: column;
            gap: 0.375rem;
        }

        .room-card {
            display: block;
            padding: 0.875rem 1rem;
            border-radius: 0.75rem;
            border: 1px solid transparent;
            background: transparent;
            transition: all 0.25s ease;
        }

        .room-card:hover {
            background: rgba(30, 41, 59, 0.6);
            border-color: rgba(71, 85, 105, 0.25);
        }

        .room-card.active {
            background: rgba(37, 99, 235, 0.08);
            border-color: rgba(37, 99, 235, 0.3);
        }

        .room-name {
            font-size: 0.875rem;
            font-weight: 600;
            color: #F8FAFC;
            margin-bottom: 0.25rem;
        }

        .room-card.active .room-name { color: #60A5FA; }

        .room-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.75rem;
            color: #64748B;
        }

        .room-msg-count {
            font-size: 0.6875rem;
            font-weight: 600;
            padding: 0.125rem 0.5rem;
            border-radius: 9999px;
            background: rgba(71, 85, 105, 0.25);
            color: #94A3B8;
        }

        .room-card.active .room-msg-count {
            background: rgba(37, 99, 235, 0.15);
            color: #60A5FA;
        }

        /* ===== CHAT PANEL ===== */
        .chat-panel {
            background: #1E293B;
            border: 1px solid rgba(71, 85, 105, 0.28);
            border-radius: 1rem;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            height: calc(100vh - 280px);
            min-height: 500px;
        }

        .chat-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid rgba(71, 85, 105, 0.2);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .chat-room-info h2 {
            font-size: 1rem;
            font-weight: 700;
            color: #F8FAFC;
            letter-spacing: -0.01em;
        }

        .chat-room-info p {
            font-size: 0.8125rem;
            color: #64748B;
            margin-top: 0.125rem;
        }

        .online-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.3125rem 0.75rem;
            border-radius: 9999px;
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.25);
            font-size: 0.75rem;
            font-weight: 600;
            color: #10B981;
        }

        .online-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: #10B981;
            animation: pulse 2s ease infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.4; }
        }

        /* ===== MESSAGES ===== */
        .message-area {
            flex: 1;
            overflow-y: auto;
            padding: 1.25rem 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .message-area::-webkit-scrollbar { width: 6px; }
        .message-area::-webkit-scrollbar-track { background: transparent; }
        .message-area::-webkit-scrollbar-thumb {
            background: rgba(71, 85, 105, 0.3);
            border-radius: 3px;
        }

        .message {
            max-width: 72%;
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .message.outgoing {
            align-self: flex-end;
            align-items: flex-end;
        }

        .message.incoming {
            align-self: flex-start;
            align-items: flex-start;
        }

        .bubble {
            padding: 0.875rem 1.125rem;
            border-radius: 1rem;
            font-size: 0.9375rem;
            line-height: 1.6;
            word-wrap: break-word;
        }

        .message.incoming .bubble {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(71, 85, 105, 0.2);
            color: #E2E8F0;
            border-bottom-left-radius: 4px;
        }

        .message.outgoing .bubble {
            background: linear-gradient(135deg, #2563EB, #1D4ED8);
            color: #fff;
            border-bottom-right-radius: 4px;
        }

        .message-info {
            font-size: 0.6875rem;
            color: #64748B;
            font-weight: 500;
            padding: 0 0.25rem;
        }

        .empty-chat {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex: 1;
            padding: 3rem;
            text-align: center;
        }

        .empty-chat-icon { font-size: 3rem; margin-bottom: 1rem; opacity: 0.4; }
        .empty-chat-text {
            font-size: 0.9375rem;
            color: #64748B;
            max-width: 300px;
        }

        /* ===== COMPOSER ===== */
        .composer {
            padding: 1rem 1.5rem 1.25rem;
            border-top: 1px solid rgba(71, 85, 105, 0.2);
            background: rgba(15, 23, 42, 0.3);
        }

        .composer form { display: flex; flex-direction: column; gap: 0.75rem; }

        .composer textarea {
            width: 100%;
            min-height: 72px;
            max-height: 200px;
            padding: 0.875rem 1.125rem;
            border: 1px solid rgba(71, 85, 105, 0.35);
            border-radius: 0.875rem;
            background: rgba(15, 23, 42, 0.5);
            color: #F8FAFC;
            font-family: 'Inter', sans-serif;
            font-size: 0.9375rem;
            resize: vertical;
            outline: none;
            transition: all 0.3s ease;
        }

        .composer textarea::placeholder { color: #64748B; }

        .composer textarea:focus {
            border-color: #2563EB;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        .composer-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
        }

        .composer-hint {
            font-size: 0.75rem;
            color: #475569;
        }

        .btn-send {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6875rem 1.5rem;
            background: #2563EB;
            border: none;
            border-radius: 0.75rem;
            color: #fff;
            font-family: 'Inter', sans-serif;
            font-size: 0.8125rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-send:hover {
            background: #3B82F6;
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
        }

        .btn-send svg { width: 16px; height: 16px; }

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

        /* ===== RESPONSIVE ===== */
        @media (max-width: 960px) {
            .forum-container {
                grid-template-columns: 1fr;
                padding: 1rem 1.25rem 3rem;
            }
            .sidebar {
                position: static;
            }
            .chat-panel {
                height: auto;
                min-height: 400px;
            }
            .message-area {
                max-height: 350px;
            }
        }

        @media (max-width: 768px) {
            .navbar-inner { padding: 0 1.25rem; }
            .page-hero { padding: 2rem 1.25rem 1.5rem; }
            .nav-actions .nav-link span { display: none; }
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
            <div class="nav-actions">
                <button onclick="history.back()" class="nav-link">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M10 12L6 8L10 4"/></svg>
                    <span>Kembali</span>
                </button>
                <a href="/" class="nav-link">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 8l6-5 6 5"/><path d="M4 8v5.5h3V11h2v2.5h3V8"/></svg>
                    <span>Beranda</span>
                </a>
            </div>
        </div>
    </nav>

    {{-- HERO --}}
    <section class="page-hero">
        <div class="hero-blob hero-blob-1" aria-hidden="true"></div>
        <div class="hero-content">
            <div class="hero-breadcrumb">
                <a href="/">Beranda</a>
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 4l4 4-4 4"/></svg>
                <span style="color: #F8FAFC;">Forum Diskusi</span>
            </div>
            <h1 class="hero-title">💬 Forum Diskusi</h1>
            <p class="hero-desc">Diskusikan topik investasi bersama admin dan komunitas Investdu.</p>
        </div>
    </section>

    {{-- FORUM LAYOUT --}}
    <div class="forum-container">

        {{-- SIDEBAR --}}
        <aside class="sidebar">
            <div class="sidebar-header">
                <span class="sidebar-title">Ruang Diskusi</span>
                <span class="sidebar-badge">{{ count($rooms) }} ruang</span>
            </div>
            <div class="room-list">
                @php $activeRoom = collect($rooms)->firstWhere('id', $activeRoomId); @endphp
                @foreach ($rooms as $room)
                    <a href="/forum-diskusi?room_id={{ $room['id'] }}" class="room-card{{ $room['id'] === $activeRoomId ? ' active' : '' }}">
                        <div class="room-name">{{ $room['name'] }}</div>
                        <div class="room-meta">
                            <span>{{ $room['subtitle'] }}</span>
                            <span class="room-msg-count">{{ $room['messages'] ?? 0 }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </aside>

        {{-- CHAT PANEL --}}
        <section class="chat-panel">
            <div class="chat-header">
                <div class="chat-room-info">
                    <h2>{{ $activeRoom['name'] ?? 'General' }}</h2>
                    <p>{{ $activeRoom['subtitle'] ?? 'Semua orang ada di grup ini.' }}</p>
                </div>
                <div class="online-badge">
                    <span class="online-dot"></span>
                    Online
                </div>
            </div>

            <div class="message-area" id="messageArea">
                @forelse ($messages as $message)
                    @php $isOutgoing = $message->user_id === auth()->id(); @endphp
                    <div class="message {{ $isOutgoing ? 'outgoing' : 'incoming' }}">
                        <div class="bubble">{{ $message->body }}</div>
                        <div class="message-info">{{ $message->user?->username ?? 'User' }} · {{ $message->created_at->format('H:i') }}</div>
                    </div>
                @empty
                    <div class="empty-chat">
                        <div class="empty-chat-icon">💬</div>
                        <p class="empty-chat-text">Belum ada pesan di ruang ini. Jadilah yang pertama memulai percakapan!</p>
                    </div>
                @endforelse
            </div>

            <div class="composer">
                <form action="/forum-diskusi" method="POST">
                    @csrf
                    <input type="hidden" name="chat_room_id" value="{{ $activeRoomId }}">
                    <textarea name="message" placeholder="Ketik pesan Anda..." required></textarea>
                    <div class="composer-row">
                        <span class="composer-hint">Tekan Enter untuk kirim, Shift+Enter untuk baris baru.</span>
                        <button type="submit" class="btn-send">
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="14" y1="2" x2="7" y2="9"/><polygon points="14 2 9 14 7 9 2 7 14 2"/></svg>
                            Kirim
                        </button>
                    </div>
                </form>
            </div>
        </section>

    </div>

    {{-- FOOTER --}}
    <footer class="footer">
        <div class="footer-inner">
            <span class="footer-brand">INVEST<span class="gold">DU</span></span>
            <span class="footer-copy">&copy; {{ date('Y') }} Investdu. All rights reserved.</span>
        </div>
    </footer>

    <script>
        // Auto scroll to bottom of messages
        const messageArea = document.getElementById('messageArea');
        if (messageArea) {
            messageArea.scrollTop = messageArea.scrollHeight;
        }

        // Enter to send
        const textarea = document.querySelector('textarea[name="message"]');
        const form = textarea.closest('form');

        textarea.addEventListener('keydown', function (event) {
            if (event.key === 'Enter' && !event.shiftKey) {
                event.preventDefault();
                if (textarea.value.trim()) {
                    form.submit();
                }
            }
        });
    </script>

</body>
</html>
