<div id="gamePopupBackdrop" class="game-popup-backdrop hidden" onclick="closeGamePopup(event)">
    <div class="game-popup-shell" role="dialog" aria-modal="true" aria-labelledby="gamePopupTitle" onclick="event.stopPropagation()">
        <div class="game-popup-header">
            <div>
                <div class="game-popup-title" id="gamePopupTitle">Monitor Game</div>
                <div class="game-popup-subtitle">Kelola pertanyaan trivia dan yes or no per kategori.</div>
                <div class="game-popup-category" id="gamePopupCategoryName" style="margin-top:0.5rem;color:#94a3b8;font-family:'Space Mono', monospace;font-size:0.82rem;"></div>
            </div>
            <button type="button" class="game-popup-close" onclick="closeGamePopup(event)">✕</button>
        </div>

        <div class="game-popup-tabs">
            <button type="button" class="game-tab active" data-tab="trivia" onclick="switchGameTab('trivia')">Trivia</button>
            <button type="button" class="game-tab" data-tab="yesno" onclick="switchGameTab('yesno')">Yes or No</button>
        </div>

        <div class="game-popup-panel active" id="triviaPanel">
            <div class="game-popup-panel-title">Trivia Questions</div>
            <div class="game-popup-grid">
                <div class="game-card game-questions-list">
                    <div class="game-card-title">Daftar Trivia</div>
                    <div id="triviaQuestionList"></div>
                </div>

                <div class="game-card">
                    <div class="game-card-title">Tambah pertanyaan trivia</div>
                    <form id="triviaAddForm" method="POST" class="game-form">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <label>Pertanyaan</label>
                        <textarea name="question" rows="3" required></textarea>
                        <div class="game-form-row">
                            <div>
                                <label>Option A</label>
                                <input type="text" name="option_a" required />
                            </div>
                            <div>
                                <label>Option B</label>
                                <input type="text" name="option_b" required />
                            </div>
                        </div>
                        <div class="game-form-row">
                            <div>
                                <label>Option C</label>
                                <input type="text" name="option_c" required />
                            </div>
                            <div>
                                <label>Option D</label>
                                <input type="text" name="option_d" required />
                            </div>
                        </div>
                        <label>Jawaban Benar</label>
                        <select name="correct_answer" required>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                        <label>Penjelasan</label>
                        <textarea name="explanation" rows="2"></textarea>
                        <button type="submit" class="game-form-submit">Tambahkan Trivia</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="game-popup-panel" id="yesnoPanel">
            <div class="game-popup-panel-title">Yes or No Questions</div>
            <div class="game-popup-grid">
                <div class="game-card game-questions-list">
                    <div class="game-card-title">Daftar Yes or No</div>
                    <div id="yesnoQuestionList"></div>
                </div>

                <div class="game-card">
                    <div class="game-card-title">Tambah pertanyaan yes or no</div>
                    <form id="yesnoAddForm" method="POST" class="game-form">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <label>Pertanyaan</label>
                        <textarea name="question" rows="3" required></textarea>
                        <label>Jawaban Benar</label>
                        <select name="correct_answer" required>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                        <label>Penjelasan</label>
                        <textarea name="explanation" rows="2"></textarea>
                        <button type="submit" class="game-form-submit">Tambahkan Yes/No</button>
                    </form>
                </div>
            </div>
        </div>
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
        width: min(1200px, 100%);
        max-height: min(90vh, 1200px);
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
    .game-popup-tabs {
        display: flex;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
    }
    .game-tab {
        padding: 0.85rem 1.25rem;
        border-radius: 999px;
        border: 1px solid rgba(255,255,255,0.08);
        background: rgba(255,255,255,0.03);
        color: #c9d1d9;
        cursor: pointer;
        font-family: 'Space Mono', monospace;
        letter-spacing: 0.05em;
    }
    .game-tab.active {
        background: #1f2937;
        border-color: #60a5fa;
        color: #eff6ff;
    }
    .game-popup-panel {
        display: none;
    }
    .game-popup-panel.active {
        display: block;
    }
    .game-popup-panel-title {
        font-family: 'Press Start 2P', monospace;
        color: #7dd3fc;
        margin-bottom: 1rem;
        font-size: 0.95rem;
    }
    .game-popup-grid {
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        gap: 1rem;
    }
    .game-card {
        background: #0b1523;
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 18px;
        padding: 1rem;
        box-shadow: 0 12px 35px rgba(0,0,0,0.2);
    }
    .game-card-title {
        font-family: 'Space Mono', monospace;
        margin-bottom: 1rem;
        font-size: 0.85rem;
        color: #cbd5e1;
        letter-spacing: 0.08em;
        text-transform: uppercase;
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
    .game-form textarea,
    .game-form select {
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
    .game-questions-list {
        max-height: 68vh;
        overflow-y: auto;
    }
    .question-item {
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 14px;
        padding: 0.95rem;
        margin-bottom: 0.85rem;
        background: rgba(255,255,255,0.02);
    }
    .question-header {
        display: flex;
        justify-content: space-between;
        gap: 0.5rem;
        align-items: center;
        flex-wrap: wrap;
        margin-bottom: 0.65rem;
    }
    .question-meta {
        font-size: 0.72rem;
        color: #94a3b8;
        margin-bottom: 0.75rem;
    }
    .question-actions {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    .small-btn {
        border: none;
        background: rgba(96,165,250,0.16);
        color: #bfdbfe;
        padding: 0.55rem 0.75rem;
        border-radius: 999px;
        cursor: pointer;
        font-family: 'Space Mono', monospace;
        font-size: 0.72rem;
    }
    .small-btn.danger {
        background: rgba(248,113,113,0.18);
        color: #fecaca;
    }
    .inline-form { display: inline; }
    .empty-state {
        color: #94a3b8;
        font-size: 0.82rem;
        padding: 1rem;
        background: rgba(255,255,255,0.03);
        border-radius: 14px;
    }
    .question-edit {
        margin-top: 0.75rem;
        border-top: 1px solid rgba(255,255,255,0.08);
        padding-top: 0.75rem;
    }
    @media (max-width: 900px) {
        .game-popup-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<script>
    @php
        $gameCategories = $categories->map(function($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
                'triviaQuestions' => $category->triviaQuestions->map(function($question) {
                    return [
                        'id' => $question->id,
                        'question' => $question->question,
                        'option_a' => $question->option_a,
                        'option_b' => $question->option_b,
                        'option_c' => $question->option_c,
                        'option_d' => $question->option_d,
                        'correct_answer' => $question->correct_answer,
                        'explanation' => $question->explanation,
                    ];
                })->toArray(),
                'yesOrNoQuestions' => $category->yesOrNoQuestions->map(function($question) {
                    return [
                        'id' => $question->id,
                        'question' => $question->question,
                        'correct_answer' => $question->correct_answer,
                        'explanation' => $question->explanation,
                    ];
                })->toArray(),
            ];
        })->toArray();
    @endphp
    const gameCategories = @json($gameCategories);

    function openGamePopup(categoryId, tab = 'trivia') {
        const category = gameCategories.find(item => item.id === categoryId);
        if (!category) return;

        document.getElementById('gamePopupCategoryName').textContent = 'Kategori: ' + category.name;
        document.getElementById('triviaAddForm').action = `/admin/literasi/${category.id}/trivia`;
        document.getElementById('yesnoAddForm').action = `/admin/literasi/${category.id}/yes-or-no`;
        renderQuestionLists(category);
        document.getElementById('gamePopupBackdrop').classList.remove('hidden');
        switchGameTab(tab);
        document.body.style.overflow = 'hidden';
    }

    function closeGamePopup(event) {
        if (event.target.id === 'gamePopupBackdrop' || event.target.classList.contains('game-popup-close')) {
            document.getElementById('gamePopupBackdrop').classList.add('hidden');
            document.body.style.overflow = '';
        }
    }

    function switchGameTab(tabName) {
        document.querySelectorAll('.game-tab').forEach(button => {
            button.classList.toggle('active', button.dataset.tab === tabName);
        });
        document.querySelectorAll('.game-popup-panel').forEach(panel => {
            panel.classList.toggle('active', panel.id === tabName + 'Panel');
        });
    }

    function renderQuestionLists(category) {
        const triviaContainer = document.getElementById('triviaQuestionList');
        const yesnoContainer = document.getElementById('yesnoQuestionList');
        triviaContainer.innerHTML = '';
        yesnoContainer.innerHTML = '';

        if (category.triviaQuestions.length === 0) {
            triviaContainer.innerHTML = '<div class="empty-state">Belum ada pertanyaan trivia. Tambahkan di sebelah kiri.</div>';
        } else {
            category.triviaQuestions.forEach((question, index) => {
                triviaContainer.innerHTML += renderTriviaQuestionItem(category.id, question, index + 1);
            });
        }

        if (category.yesOrNoQuestions.length === 0) {
            yesnoContainer.innerHTML = '<div class="empty-state">Belum ada pertanyaan yes or no. Tambahkan di sebelah kiri.</div>';
        } else {
            category.yesOrNoQuestions.forEach((question, index) => {
                yesnoContainer.innerHTML += renderYesNoQuestionItem(category.id, question, index + 1);
            });
        }
    }

    function renderTriviaQuestionItem(categoryId, question, index) {
        return `
            <div class="question-item">
                <div class="question-header">
                    <div>#${index} - ${escapeHtml(question.question)}</div>
                    <div class="question-actions">
                        <button type="button" class="small-btn" onclick="toggleQuestionEdit('trivia-${question.id}')">Edit</button>
                        <form action="/admin/literasi/${categoryId}/trivia/${question.id}/delete" method="POST" class="inline-form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <button type="submit" class="small-btn danger">Hapus</button>
                        </form>
                    </div>
                </div>
                <div class="question-meta">Jawaban benar: ${question.correct_answer}</div>
                <div class="question-edit hidden" id="trivia-${question.id}">
                    <form action="/admin/literasi/${categoryId}/trivia/${question.id}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="_method" value="PUT" />
                        <label>Pertanyaan</label>
                        <textarea name="question" rows="2" required>${escapeHtml(question.question)}</textarea>
                        <div class="game-form-row">
                            <div>
                                <label>A</label>
                                <input type="text" name="option_a" value="${escapeHtml(question.option_a)}" required />
                            </div>
                            <div>
                                <label>B</label>
                                <input type="text" name="option_b" value="${escapeHtml(question.option_b)}" required />
                            </div>
                        </div>
                        <div class="game-form-row">
                            <div>
                                <label>C</label>
                                <input type="text" name="option_c" value="${escapeHtml(question.option_c)}" required />
                            </div>
                            <div>
                                <label>D</label>
                                <input type="text" name="option_d" value="${escapeHtml(question.option_d)}" required />
                            </div>
                        </div>
                        <label>Jawaban Benar</label>
                        <select name="correct_answer" required>
                            <option value="A" ${question.correct_answer === 'A' ? 'selected' : ''}>A</option>
                            <option value="B" ${question.correct_answer === 'B' ? 'selected' : ''}>B</option>
                            <option value="C" ${question.correct_answer === 'C' ? 'selected' : ''}>C</option>
                            <option value="D" ${question.correct_answer === 'D' ? 'selected' : ''}>D</option>
                        </select>
                        <label>Penjelasan</label>
                        <textarea name="explanation" rows="2">${escapeHtml(question.explanation || '')}</textarea>
                        <button type="submit" class="game-form-submit">Simpan perubahan</button>
                    </form>
                </div>
            </div>
        `;
    }

    function renderYesNoQuestionItem(categoryId, question, index) {
        return `
            <div class="question-item">
                <div class="question-header">
                    <div>#${index} - ${escapeHtml(question.question)}</div>
                    <div class="question-actions">
                        <button type="button" class="small-btn" onclick="toggleQuestionEdit('yesno-${question.id}')">Edit</button>
                        <form action="/admin/literasi/${categoryId}/yes-or-no/${question.id}/delete" method="POST" class="inline-form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <button type="submit" class="small-btn danger">Hapus</button>
                        </form>
                    </div>
                </div>
                <div class="question-meta">Jawaban benar: ${question.correct_answer}</div>
                <div class="question-edit hidden" id="yesno-${question.id}">
                    <form action="/admin/literasi/${categoryId}/yes-or-no/${question.id}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="_method" value="PUT" />
                        <label>Pertanyaan</label>
                        <textarea name="question" rows="2" required>${escapeHtml(question.question)}</textarea>
                        <label>Jawaban Benar</label>
                        <select name="correct_answer" required>
                            <option value="Yes" ${question.correct_answer === 'Yes' ? 'selected' : ''}>Yes</option>
                            <option value="No" ${question.correct_answer === 'No' ? 'selected' : ''}>No</option>
                        </select>
                        <label>Penjelasan</label>
                        <textarea name="explanation" rows="2">${escapeHtml(question.explanation || '')}</textarea>
                        <button type="submit" class="game-form-submit">Simpan perubahan</button>
                    </form>
                </div>
            </div>
        `;
    }

    function escapeHtml(text) {
        return String(text)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    function toggleQuestionEdit(id) {
        const element = document.getElementById(id);
        if (!element) return;
        element.classList.toggle('hidden');
        element.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }
</script>
