<div id="literasiPopupBackdrop" class="game-popup-backdrop hidden" onclick="closeLiterasiEditPopup(event)">
    <div class="game-popup-shell" role="dialog" aria-modal="true" aria-labelledby="literasiPopupTitle" onclick="event.stopPropagation()" style="max-width: 600px;">
        <div class="game-popup-header">
            <div>
                <div class="game-popup-title" id="literasiPopupTitle">Edit Literasi</div>
                <div class="game-popup-subtitle" id="literasiPopupSubtitle">Pilih kategori untuk diubah</div>
            </div>
            <button type="button" class="game-popup-close" onclick="closeLiterasiEditPopup(event)">✕</button>
        </div>

        <form id="literasiEditForm" method="POST" class="game-form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="_method" value="PUT" />
            
            <label>Judul Kategori</label>
            <input type="text" id="litName" name="name" required />
            
            <label>Deskripsi (Maks 500 karakter)</label>
            <textarea id="litDesc" name="description" rows="4" required></textarea>
            
            <div class="game-form-row">
                <div>
                    <label>Ikon (Emoji/Teks Pendek)</label>
                    <input type="text" id="litIcon" name="icon" placeholder="Misal: 📘" />
                </div>
                <div>
                    <label>Badge Kategori (Opsional)</label>
                    <input type="text" id="litBadge" name="badge" placeholder="Misal: POPULER" />
                </div>
            </div>
            
            <button type="submit" class="game-form-submit" style="margin-top: 1rem;">Simpan Perubahan</button>
        </form>
    </div>
</div>

<style>
    .hidden { display: none !important; }
    .game-popup-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.75);
        backdrop-filter: blur(10px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        z-index: 1200;
    }
    .game-popup-shell {
        width: 100%;
        overflow-y: auto;
        background: #08101e;
        border: 1px solid rgba(255,255,255,0.05);
        box-shadow: 0 24px 80px rgba(0,0,0,0.55);
        border-radius: 24px;
        padding: 1.5rem;
    }
    .game-popup-header {
        display: flex;
        justify-content: space-between;
        gap: 1rem;
        align-items: flex-start;
        margin-bottom: 1.5rem;
    }
    .game-popup-title {
        font-family: 'Press Start 2P', monospace;
        font-size: 1rem;
        color: #ffd166;
        margin-bottom: 0.35rem;
    }
    .game-popup-subtitle {
        font-family: 'Space Mono', monospace;
        font-size: 0.8rem;
        color: #c9d1d9;
        opacity: 0.86;
    }
    .game-popup-close {
        border: none;
        background: rgba(255,255,255,0.05);
        color: #f8fafc;
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 14px;
        font-size: 1.1rem;
        cursor: pointer;
    }
    .game-form {
        display: flex;
        flex-direction: column;
        gap: 0.85rem;
    }
    .game-form label {
        font-size: 0.75rem;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.12em;
    }
    .game-form input,
    .game-form textarea {
        width: 100%;
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 12px;
        color: #f8fafc;
        padding: 0.9rem 1rem;
        font-family: 'Space Mono', monospace;
        resize: vertical;
    }
    .game-form-submit {
        border: none;
        background: #2563eb;
        color: white;
        padding: 0.95rem 1rem;
        border-radius: 14px;
        cursor: pointer;
        font-family: 'Space Mono', monospace;
        font-weight: 700;
        margin-top: 0.5rem;
        transition: background-color 0.2s ease;
    }
    .game-form-submit:hover {
        background: #1d4ed8;
    }
    .game-form-row {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 0.75rem;
    }
</style>

<script>
    @php
        $litCategories = $categories->map(function($c) {
            return [
                'id' => $c->id,
                'name' => $c->name,
                'description' => $c->description,
                'icon' => $c->icon,
                'badge' => $c->badge
            ];
        })->toArray();
    @endphp
    const gameCategories = @json($litCategories);

    function openLiterasiEditPopup(categoryId) {
        const category = gameCategories.find(c => c.id === categoryId);
        if (!category) return;

        document.getElementById('literasiEditForm').action = `/admin/literasi/${category.id}/update`;
        document.getElementById('literasiPopupSubtitle').textContent = `Mengubah: ${category.name}`;
        document.getElementById('litName').value = category.name;
        document.getElementById('litDesc').value = category.description || '';
        document.getElementById('litIcon').value = category.icon || '';
        document.getElementById('litBadge').value = category.badge || '';

        document.getElementById('literasiPopupBackdrop').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeLiterasiEditPopup(event) {
        if (event.target.id === 'literasiPopupBackdrop' || event.target.classList.contains('game-popup-close')) {
            document.getElementById('literasiPopupBackdrop').classList.add('hidden');
            document.body.style.overflow = '';
        }
    }
</script>
