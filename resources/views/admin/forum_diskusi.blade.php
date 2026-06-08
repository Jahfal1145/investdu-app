@extends('layouts.admin')

@section('title', 'Forum Diskusi')
@section('page-title', 'forum diskusi')

@section('content')

<style>
    .forum-page {
        display: grid;
        grid-template-columns: 300px 1fr;
        gap: 1rem;
    }
    .forum-panel {
        background: #0b1320;
        border: 1px solid rgba(255,255,255,.06);
        border-radius: 20px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }
    .forum-panel-header {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid rgba(255,255,255,.05);
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: .75rem;
    }
    .forum-panel-header h2 {
        margin: 0;
        font-family: 'Press Start 2P', monospace;
        font-size: .85rem;
        letter-spacing: .12em;
        color: #7dd3fc;
        text-transform: uppercase;
    }
    .forum-panel-header p {
        margin: 0;
        color: #94a3b8;
        font-size: .75rem;
    }
    .participant-list,
    .chat-messages {
        padding: 1rem;
        overflow-y: auto;
    }
    .participant-card,
    .message-item {
        background: rgba(255,255,255,.03);
        border: 1px solid rgba(255,255,255,.06);
        border-radius: 16px;
        padding: .85rem .95rem;
        margin-bottom: .75rem;
    }
    .participant-card { display: flex; justify-content: space-between; align-items: center; gap: .75rem; }
    .participant-meta { display: grid; gap: .25rem; }
    .participant-meta strong { color: #f8fafc; font-size: .92rem; }
    .badge { display: inline-flex; align-items: center; gap: .35rem; padding: .25rem .6rem; border-radius: 999px; font-size: .7rem; text-transform: uppercase; letter-spacing: .08em; }
    .badge.active { background: rgba(56,189,248,.12); color: #7dd3fc; border: 1px solid rgba(56,189,248,.2); }
    .badge.suspended { background: rgba(248,113,113,.12); color: #fecaca; border: 1px solid rgba(248,113,113,.2); }
    .participant-actions button,
    .message-actions button {
        border: none;
        background: rgba(255,255,255,.05);
        color: #cbd5e1;
        padding: .55rem .85rem;
        border-radius: 999px;
        cursor: pointer;
        font-size: .75rem;
    }
    .participant-actions button:hover,
    .message-actions button:hover { background: rgba(255,255,255,.1); }
    .message-item { position: relative; }
    .message-header { display: flex; justify-content: space-between; gap: .75rem; align-items: center; margin-bottom: .55rem; }
    .message-sender { font-weight: 700; color: #f8fafc; font-size: .85rem; }
    .message-time { color: #94a3b8; font-size: .72rem; }
    .message-text { color: #cbd5e1; font-size: .9rem; line-height: 1.6; }
    .message-actions { margin-top: .75rem; display: flex; gap: .5rem; flex-wrap: wrap; }
    .admin-chat-footer { padding: 1rem 1.25rem; border-top: 1px solid rgba(255,255,255,.05); background: #08101c; }
    .admin-chat-footer form { display: flex; gap: .75rem; align-items: center; }
    .admin-chat-footer input { flex: 1; border-radius: 14px; border: 1px solid rgba(255,255,255,.08); background: rgba(255,255,255,.03); color: #f8fafc; padding: .85rem 1rem; }
    .admin-chat-footer button { border: none; border-radius: 999px; padding: .9rem 1.2rem; background: #38bdf8; color: #0f172a; cursor: pointer; }
    .chat-header { display: flex; justify-content: space-between; align-items: center; gap: .75rem; }
    .chat-header h2 { margin: 0; font-family: 'Press Start 2P', monospace; color: #7dd3fc; font-size: .95rem; text-transform: uppercase; letter-spacing: .12em; }
    .chat-header small { color: #94a3b8; }
    @media (max-width: 1024px) { .forum-page { grid-template-columns: 1fr; } .participant-list, .chat-messages { max-height: 48vh; } }
</style>

<div class="forum-page">
    <div class="forum-panel">
        <div class="forum-panel-header">
            <div>
                <h2>General Chat</h2>
                <p>Semua percakapan grup tersedia di sini.</p>
            </div>
            <span class="badge active">Aktif</span>
        </div>
        <div class="participant-list" id="participantList"></div>
    </div>

    <div class="forum-panel">
        <div class="forum-panel-header chat-header">
            <div>
                <h2>Admin View</h2>
                <small>Hapus pesan dan suspend peserta.</small>
            </div>
            <span class="badge active">General</span>
        </div>
        <div class="chat-messages" id="chatMessages"></div>
        <div class="admin-chat-footer">
            <form id="adminReplyForm">
                <input type="text" id="adminReplyInput" placeholder="Tulis pesan admin..." />
                <button type="submit">Kirim</button>
            </form>
        </div>
    </div>
</div>

<script>
    const participants = [
        { id: 'user_a', name: 'Rina', role: 'Member', suspended: false },
        { id: 'user_b', name: 'Andi', role: 'Member', suspended: false },
        { id: 'user_c', name: 'Joko', role: 'Member', suspended: false }
    ];

    const chatMessages = [
        { id: 1, sender: 'Rina', text: 'Halo semua, ada yang bisa bantu soal saham hari ini?', time: '09:12' },
        { id: 2, sender: 'Admin', text: 'Silakan tanya, saya siap membantu.', time: '09:14' },
        { id: 3, sender: 'Andi', text: 'Apakah reksa dana aman untuk pemula?', time: '09:16' }
    ];

    const participantList = document.getElementById('participantList');
    const chatMessagesEl = document.getElementById('chatMessages');
    const adminReplyForm = document.getElementById('adminReplyForm');
    const adminReplyInput = document.getElementById('adminReplyInput');

    function renderParticipants() {
        participantList.innerHTML = '';
        participants.forEach(person => {
            const card = document.createElement('div');
            card.className = 'participant-card';
            card.innerHTML = `
                <div class="participant-meta">
                    <strong>${person.name}</strong>
                    <span>${person.role}</span>
                </div>
                <div class="participant-actions">
                    <span class="badge ${person.suspended ? 'suspended' : 'active'}">${person.suspended ? 'Suspended' : 'Active'}</span>
                    <button type="button" onclick="toggleSuspend('${person.id}')">${person.suspended ? 'Buka suspend' : 'Suspend'}</button>
                </div>
            `;
            participantList.appendChild(card);
        });
    }

    function renderChatMessages() {
        chatMessagesEl.innerHTML = '';
        if (chatMessages.length === 0) {
            chatMessagesEl.innerHTML = '<p style="color:#94a3b8;">Belum ada percakapan di general chat.</p>';
            return;
        }
        chatMessages.forEach(message => {
            const item = document.createElement('div');
            item.className = 'message-item';
            item.innerHTML = `
                <div class="message-header">
                    <div class="message-sender">${message.sender}</div>
                    <div class="message-time">${message.time}</div>
                </div>
                <div class="message-text">${escapeHtml(message.text)}</div>
                <div class="message-actions">
                    <button type="button" onclick="deleteMessage(${message.id})">Hapus</button>
                </div>
            `;
            chatMessagesEl.appendChild(item);
        });
    }

    function deleteMessage(id) {
        const index = chatMessages.findIndex(msg => msg.id === id);
        if (index !== -1) {
            chatMessages.splice(index, 1);
            renderChatMessages();
        }
    }

    function toggleSuspend(id) {
        const user = participants.find(person => person.id === id);
        if (!user) return;
        user.suspended = !user.suspended;
        renderParticipants();
    }

    adminReplyForm.addEventListener('submit', event => {
        event.preventDefault();
        const text = adminReplyInput.value.trim();
        if (!text) return;
        const now = new Date();
        const time = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        chatMessages.push({ id: Date.now(), sender: 'Admin', text, time });
        adminReplyInput.value = '';
        renderChatMessages();
    });

    function escapeHtml(text) {
        return String(text)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    renderParticipants();
    renderChatMessages();
</script>

@endsection
