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
                    <span class="badge">3 kontak</span>
                </div>
                <div class="contact-list" id="contactList"></div>
                <div class="add-friend">
                    <button class="add-button" id="openFriendModal">Tambahkan Teman</button>
                </div>
            </section>
            <section class="panel chat-shell">
                <div class="chat-header">
                    <div class="title-block">
                        <h2 id="chatTitle">General</h2>
                        <p id="chatSubtitle">Semua orang ada di grup ini.</p>
                    </div>
                    <div id="chatStatus" class="badge" style="background: rgba(56,189,248,.12); border-color: rgba(56,189,248,.2); color: #7dd3fc;">Online</div>
                </div>
                <div class="message-area" id="messageArea"></div>
                <div class="composer">
                    <form id="messageForm">
                        <textarea id="messageInput" placeholder="Ketik pesan..." required></textarea>
                        <div class="composer-row">
                            <button type="submit">Kirim Pesan</button>
                            <span id="sendHint" style="color:#94a3b8; font-size:.78rem;">Pesan akan muncul setelah 5 detik.</span>
                        </div>
                    </form>
                </div>
            </section>
        </main>
    </div>

    <div class="modal-backdrop" id="friendModal">
        <div class="modal-panel">
            <div style="display:flex; align-items:center; justify-content:space-between; gap:.75rem; margin-bottom:1rem;">
                <div>
                    <h3>Tambahkan Teman</h3>
                    <p style="color:#94a3b8; font-size:.85rem;">Cari investor baru dan tambahkan ke daftar.</p>
                </div>
                <button class="close-btn" id="closeFriendModal">Tutup</button>
            </div>
            <div class="modal-row">
                <input type="text" id="friendSearch" placeholder="Cari nama..." />
            </div>
            <div class="friend-suggestions" id="friendSuggestions"></div>
            <div class="modal-footer">
                <button class="close-btn" id="closeFriendModal2">Batal</button>
            </div>
        </div>
    </div>

    <script>
        const contacts = [
            { id: 'general', name: 'General', type: 'group', subtitle: 'Semua orang ada di sini', certified: false, messages: [
                { id: 1, sender: 'Admin', text: 'Halo semua, selamat berdiskusi! Silakan tambahkan teman dan mulai percakapan.', time: '09:00', type: 'incoming' },
            ] },
            { id: 'admin', name: 'Admin', type: 'person', subtitle: 'Certified account', certified: true, messages: [
                { id: 1, sender: 'Admin', text: 'Hai, saya Admin. Silakan tanya apa saja tentang investasi.', time: '09:05', type: 'incoming' },
            ] }
        ];

        const suggestedFriends = [
            { id: 'tia', name: 'Tia Investor', subtitle: 'Online' },
            { id: 'budi', name: 'Budi Cuan', subtitle: 'Online' },
            { id: 'ratna', name: 'Ratna Saham', subtitle: 'Offline' }
        ];

        let activeContactId = 'general';
        let canSend = true;
        let sendCooldownTimer = null;

        const contactList = document.getElementById('contactList');
        const messageArea = document.getElementById('messageArea');
        const chatTitle = document.getElementById('chatTitle');
        const chatSubtitle = document.getElementById('chatSubtitle');
        const messageForm = document.getElementById('messageForm');
        const messageInput = document.getElementById('messageInput');
        const sendHint = document.getElementById('sendHint');
        const sendButton = messageForm.querySelector('button');
        const openFriendModal = document.getElementById('openFriendModal');
        const friendModal = document.getElementById('friendModal');
        const closeFriendModal = document.getElementById('closeFriendModal');
        const closeFriendModal2 = document.getElementById('closeFriendModal2');
        const friendSearch = document.getElementById('friendSearch');
        const friendSuggestions = document.getElementById('friendSuggestions');

        function renderContacts() {
            contactList.innerHTML = '';
            contacts.forEach(contact => {
                const card = document.createElement('div');
                card.className = 'contact-card' + (contact.id === activeContactId ? ' active' : '');
                card.innerHTML = `
                    <div class="title">${contact.name} ${contact.certified ? '<span class="badge">Certified</span>' : ''}</div>
                    <div class="meta">
                        <span>${contact.subtitle}</span>
                        <span>${contact.messages.length} pesan</span>
                    </div>
                `;
                card.onclick = () => { activeContactId = contact.id; renderChat(); renderContacts(); };
                contactList.appendChild(card);
            });
        }

        function renderChat() {
            const contact = contacts.find(c => c.id === activeContactId);
            if (!contact) return;
            chatTitle.textContent = contact.name;
            chatSubtitle.textContent = contact.type === 'group' ? contact.subtitle : 'Chat pribadi dengan Admin';
            messageArea.innerHTML = '';
            contact.messages.forEach(message => {
                const msg = document.createElement('div');
                msg.className = 'message ' + (message.type === 'outgoing' ? 'outgoing' : 'incoming');
                msg.innerHTML = `
                    <div class="bubble">${message.text}</div>
                    <div class="info">${message.sender} · ${message.time}</div>
                `;
                messageArea.appendChild(msg);
            });
            messageArea.scrollTop = messageArea.scrollHeight;
        }

        function openModal() { friendModal.classList.add('open'); friendSearch.value = ''; renderFriendSuggestions(); }
        function closeModal() { friendModal.classList.remove('open'); }

        function renderFriendSuggestions() {
            const search = friendSearch.value.toLowerCase();
            friendSuggestions.innerHTML = '';
            suggestedFriends.filter(friend => friend.name.toLowerCase().includes(search)).forEach(friend => {
                const item = document.createElement('div');
                item.className = 'friend-item';
                item.innerHTML = `
                    <div class="friend-meta">
                        <strong>${friend.name}</strong>
                        <span>${friend.subtitle}</span>
                    </div>
                    <button type="button">Tambah</button>
                `;
                item.querySelector('button').onclick = () => addFriend(friend);
                friendSuggestions.appendChild(item);
            });
        }

        function addFriend(friend) {
            if (contacts.some(c => c.id === friend.id)) return;
            contacts.push({ id: friend.id, name: friend.name, type: 'person', subtitle: friend.subtitle, certified: false, messages: [{ id: 1, sender: friend.name, text: 'Halo! Senang bergabung di forum diskusi.', time: '09:10', type: 'incoming' }] });
            renderContacts();
            closeModal();
        }

        messageForm.addEventListener('submit', event => {
            event.preventDefault();
            if (!canSend) return;
            const text = messageInput.value.trim();
            if (!text) return;
            const contact = contacts.find(c => c.id === activeContactId);
            if (!contact) return;
            const now = new Date();
            const formattedTime = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            contact.messages.push({ id: Date.now(), sender: '{{ Auth::user()->username }}', text, time: formattedTime, type: 'outgoing' });
            renderChat();
            messageInput.value = '';
            startSendCooldown(5);
        });

        messageInput.addEventListener('keydown', event => {
            if (event.key === 'Enter' && !event.shiftKey) {
                event.preventDefault();
                messageForm.requestSubmit();
            }
        });

        function startSendCooldown(seconds) {
            canSend = false;
            let remaining = seconds;
            updateSendHint(remaining);
            sendButton.disabled = true;
            if (sendCooldownTimer) clearInterval(sendCooldownTimer);
            sendCooldownTimer = setInterval(() => {
                remaining -= 1;
                if (remaining <= 0) {
                    clearInterval(sendCooldownTimer);
                    canSend = true;
                    sendButton.disabled = false;
                    updateSendHint();
                    return;
                }
                updateSendHint(remaining);
            }, 1000);
        }

        function updateSendHint(remaining) {
            if (remaining) {
                sendHint.textContent = `Tunggu ${remaining} detik sebelum kirim lagi.`;
            } else {
                sendHint.textContent = 'Tekan Enter untuk kirim, Shift+Enter untuk baris baru.';
            }
        }

        openFriendModal.addEventListener('click', openModal);
        closeFriendModal.addEventListener('click', closeModal);
        closeFriendModal2.addEventListener('click', closeModal);
        friendSearch.addEventListener('input', renderFriendSuggestions);

        renderContacts();
        renderChat();
        renderFriendSuggestions();
    </script>
</body>
</html>
