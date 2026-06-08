<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forum Diskusi | InvestDU</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <style>
        body { margin: 0; font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif; background: #08101e; color: #e2e8f0; }
        * { box-sizing: border-box; }
        .page-shell { min-height: 100vh; display: grid; grid-template-rows: auto 1fr; }
        .topbar { display: flex; justify-content: space-between; align-items: center; gap: 1rem; padding: 1.25rem 1.5rem; border-bottom: 1px solid rgba(148,163,184,.12); background: #06101a; }
        .topbar h1 { margin: 0; font-size: 1rem; letter-spacing: .15em; text-transform: uppercase; color: #7dd3fc; }
        .topbar .actions { display: flex; gap: .75rem; align-items: center; }
        .topbar a, .topbar button { border: 1px solid rgba(148,163,184,.18); background: rgba(255,255,255,.03); color: #e2e8f0; padding: .65rem .95rem; border-radius: 999px; text-decoration: none; cursor: pointer; font-size: .8rem; }
        .topbar a:hover, .topbar button:hover { background: rgba(255,255,255,.08); }
        .forum-grid { display: grid; grid-template-columns: 280px 1fr; gap: 1rem; padding: 1.5rem; }
        .panel { background: #09121f; border: 1px solid rgba(148,163,184,.08); border-radius: 18px; overflow: hidden; display: flex; flex-direction: column; }
        .panel-header { padding: 1rem 1.25rem; border-bottom: 1px solid rgba(148,163,184,.08); display: flex; align-items: center; justify-content: space-between; gap: .75rem; }
        .panel-header h2 { margin: 0; font-size: .85rem; letter-spacing: .12em; text-transform: uppercase; color: #cbd5e1; }
        .panel-header p { margin: 0; font-size: .72rem; color: #94a3b8; }
        .contact-list { flex: 1; overflow-y: auto; padding: .75rem; display: grid; gap: .65rem; }
        .contact-card { background: rgba(255,255,255,.03); border: 1px solid rgba(148,163,184,.08); border-radius: 16px; padding: .85rem; cursor: pointer; transition: transform .15s ease, border-color .15s ease; }
        .contact-card.active { border-color: #60a5fa; background: rgba(56,189,248,.08); }
        .contact-card:hover { transform: translateY(-1px); }
        .contact-card .title { font-size: .88rem; margin: 0 0 .3rem; color: #f8fafc; }
        .contact-card .meta { display: flex; align-items: center; justify-content: space-between; gap: .4rem; font-size: .72rem; color: #94a3b8; }
        .contact-card .meta span { display: inline-flex; align-items: center; gap: .35rem; }
        .contact-card .badge { color: #7dd3fc; font-size: .7rem; padding: .2rem .45rem; border: 1px solid rgba(125,211,252,.2); border-radius: 999px; }
        .add-friend { margin: 1rem 1rem 1.15rem; }
        .add-button { width: 100%; display: inline-flex; justify-content: center; align-items: center; gap: .5rem; border-radius: 999px; border: 1px solid rgba(148,163,184,.18); padding: .85rem; background: rgba(56,189,248,.08); color: #7dd3fc; font-weight: 700; cursor: pointer; }
        .add-button:hover { background: rgba(56,189,248,.12); }
        .chat-shell { display: flex; flex-direction: column; height: calc(100vh - 138px); }
        .chat-header { padding: 1.25rem 1.5rem; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid rgba(148,163,184,.08); }
        .chat-header .title-block { display: grid; gap: .25rem; }
        .chat-header h2 { margin: 0; font-size: 1rem; color: #f8fafc; letter-spacing: .08em; }
        .chat-header p { margin: 0; color: #94a3b8; font-size: .78rem; }
        .message-area { flex: 1; overflow-y: auto; padding: 1rem 1.5rem; display: grid; gap: .75rem; }
        .message { max-width: 72%; display: grid; gap: .35rem; }
        .message.admin, .message.outgoing { justify-self: end; text-align: right; }
        .message .bubble { padding: .85rem 1rem; border-radius: 18px; line-height: 1.5; }
        .message.incoming .bubble { background: rgba(255,255,255,.05); color: #e2e8f0; border-top-left-radius: 4px; }
        .message.outgoing .bubble, .message.admin .bubble { background: #0f172a; color: #f8fafc; border-top-right-radius: 4px; }
        .message .info { font-size: .7rem; color: #94a3b8; }
        .message-status { font-size: .72rem; color: #60a5fa; margin-top: .2rem; }
        .composer { padding: 1rem 1.5rem; border-top: 1px solid rgba(148,163,184,.08); background: #06101a; }
        .composer form { display: grid; gap: .75rem; }
        .composer textarea { width: 100%; min-height: 90px; border-radius: 16px; border: 1px solid rgba(148,163,184,.18); background: rgba(255,255,255,.03); color: #e2e8f0; padding: 1rem; resize: vertical; font-family: inherit; font-size: .95rem; }
        .composer .composer-row { display: flex; gap: .75rem; flex-wrap: wrap; align-items: center; }
        .composer button { border: none; border-radius: 999px; padding: .9rem 1.2rem; background: #38bdf8; color: #0f172a; font-weight: 700; cursor: pointer; transition: background .2s ease; }
        .composer button:hover { background: #0ea5e9; }
        .composer button:disabled { opacity: .5; cursor: not-allowed; }
        .modal-backdrop { position: fixed; inset: 0; background: rgba(0,0,0,.7); display: none; align-items: center; justify-content: center; padding: 1rem; z-index: 30; }
        .modal-backdrop.open { display: flex; }
        .modal-panel { width: min(540px,100%); background: #09121f; border: 1px solid rgba(148,163,184,.12); border-radius: 22px; padding: 1.25rem; }
        .modal-panel h3 { margin: 0 0 1rem; font-size: 1rem; color: #f8fafc; }
        .modal-panel .modal-row { display: flex; gap: .75rem; flex-wrap: wrap; margin-bottom: 1rem; }
        .modal-panel input { flex: 1; min-width: 0; border: 1px solid rgba(148,163,184,.18); border-radius: 14px; padding: .85rem 1rem; background: rgba(255,255,255,.03); color: #e2e8f0; }
        .modal-panel .close-btn { border: 1px solid rgba(148,163,184,.18); background: rgba(255,255,255,.03); color: #e2e8f0; padding: .75rem 1rem; border-radius: 999px; cursor: pointer; }
        .friend-suggestions { display: grid; gap: .85rem; max-height: 280px; overflow-y: auto; }
        .friend-item { display: flex; justify-content: space-between; align-items: center; gap: .75rem; padding: .95rem 1rem; border: 1px solid rgba(148,163,184,.18); border-radius: 16px; background: rgba(255,255,255,.03); }
        .friend-item .friend-meta { display: grid; gap: .2rem; }
        .friend-item .friend-meta span { font-size: .8rem; color: #94a3b8; }
        .friend-item button { border: none; border-radius: 999px; padding: .6rem .9rem; background: #10b981; color: #fff; cursor: pointer; }
        .friend-item button:hover { background: #059669; }
        .modal-footer { display: flex; justify-content: flex-end; gap: .75rem; margin-top: 1rem; }
        .hidden { display: none !important; }
        @media (max-width: 960px) { .forum-grid { grid-template-columns: 1fr; height: auto; } .chat-shell { height: auto; } }
    </style>
</head>
<body>
    <div class="page-shell">
        <header class="topbar">
            <div>
                <h1>Forum Diskusi</h1>
                <p style="color:#94a3b8; font-size:.82rem;">Bicara dengan Admin dan komunitas di ruang diskusi.</p>
            </div>
            <div class="actions">
                <a href="/dashboard">Dashboard</a>
                <form action="/logout" method="POST" style="margin:0; display:inline-block;">
                    @csrf
                    <button type="submit">Keluar</button>
                </form>
            </div>
        </header>
        <main class="forum-grid">
            <section class="panel">
                <div class="panel-header">
                    <div>
                        <h2>Kontak</h2>
                        <p>Admin dan grup umum</p>
                    </div>
                    <span class="badge">{{ count($rooms) }} kontak</span>
                </div>
                <div class="contact-list">
                    @php $activeRoom = collect($rooms)->firstWhere('id', $activeRoomId); @endphp
                    @foreach ($rooms as $room)
                        <a href="/forum-diskusi?room_id={{ $room['id'] }}" class="contact-card{{ $room['id'] === $activeRoomId ? ' active' : '' }}">
                            <div class="title">{{ $room['name'] }}</div>
                            <div class="meta">
                                <span>{{ $room['subtitle'] }}</span>
                                <span class="badge">{{ $room['messages'] ?? 0 }} pesan</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
            <section class="panel chat-shell">
                <div class="chat-header">
                    <div class="title-block">
                        <h2>{{ $activeRoom['name'] ?? 'General' }}</h2>
                        <p>{{ $activeRoom['subtitle'] ?? 'Semua orang ada di grup ini.' }}</p>
                    </div>
                    <div class="badge" style="background: rgba(56,189,248,.12); border-color: rgba(56,189,248,.2); color: #7dd3fc;">Online</div>
                </div>
                <div class="message-area">
                    @forelse ($messages as $message)
                        @php $isOutgoing = $message->user_id === auth()->id(); @endphp
                        <div class="message {{ $isOutgoing ? 'outgoing' : 'incoming' }}">
                            <div class="bubble">{{ $message->body }}</div>
                            <div class="info">{{ $message->user?->username ?? 'User' }} · {{ $message->created_at->format('H:i') }}</div>
                        </div>
                    @empty
                        <div class="message incoming">
                            <div class="bubble">Belum ada pesan di ruang ini. Jadilah yang pertama memulai percakapan!</div>
                        </div>
                    @endforelse
                </div>
                <div class="composer">
                    <form action="/forum-diskusi" method="POST">
                        @csrf
                        <input type="hidden" name="chat_room_id" value="{{ $activeRoomId }}">
                        <textarea name="message" placeholder="Ketik pesan..." required></textarea>
                        <div class="composer-row">
                            <button type="submit">Kirim Pesan</button>
                            <span style="color:#94a3b8; font-size:.78rem;">Tekan Enter untuk kirim, Shift+Enter untuk baris baru.</span>
                        </div>
                    </form>
                </div>
            </section>
        </main>
    </div>

    <script>
        const textarea = document.querySelector('textarea[name="message"]');
        const form = textarea.closest('form');

        textarea.addEventListener('keydown', function (event) {
            if (event.key === 'Enter' && !event.shiftKey) {
                event.preventDefault();
                form.submit();
            }
        });
    </script>
</body>
</html>
