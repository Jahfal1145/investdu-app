<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yes or No? — Investdu</title>
    <meta name="description" content="Permainan Yes or No? Investdu">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background: linear-gradient(135deg, #0F172A 0%, #111827 100%);
            color: #F8FAFC;
        }
        .page-shell {
            max-width: 900px;
            margin: 0 auto;
            padding: 3rem 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #60A5FA;
            font-weight: 700;
            text-decoration: none;
        }
        .btn-back:hover {
            color: #93C5FD;
        }
        .card {
            background: rgba(15, 23, 42, 0.92);
            border: 1px solid rgba(148, 163, 184, 0.15);
            border-radius: 1.75rem;
            padding: 2rem;
            box-shadow: 0 28px 80px rgba(0, 0, 0, 0.3);
        }
        .card h1 {
            margin: 0;
            font-size: clamp(2rem, 2.5vw, 3rem);
        }
        .card p {
            color: #CBD5E1;
            line-height: 1.8;
            margin-top: 1rem;
        }
        .question-box {
            background: rgba(31, 41, 55, 0.95);
            border: 1px solid rgba(148, 163, 184, 0.12);
            border-radius: 1.5rem;
            padding: 1.75rem;
            min-height: 140px;
        }
        .question-box h2 {
            margin: 0;
            font-size: 1.25rem;
            color: #F8FAFC;
        }
        .question-text {
            margin-top: 1rem;
            color: #CAD1E5;
            font-size: 1.05rem;
            line-height: 1.8;
        }
        .answers {
            display: grid;
            gap: 1rem;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            margin-top: 1.5rem;
        }
        .answer-btn {
            padding: 1.25rem 1rem;
            border-radius: 1.25rem;
            border: 1px solid rgba(148, 163, 184, 0.18);
            background: rgba(30, 41, 59, 0.95);
            color: #F8FAFC;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.2s ease, background-color 0.2s ease;
        }
        .answer-btn:hover {
            transform: translateY(-2px);
            background: rgba(59, 130, 246, 0.14);
        }
        .answer-btn.correct { background: #065f46; border-color: #10b981; }
        .answer-btn.wrong { background: #7f1d1d; border-color: #f43f5e; }
        .status-bar {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            margin-top: 1rem;
            flex-wrap: wrap;
        }
        .status-chip {
            padding: 0.75rem 1rem;
            border-radius: 999px;
            background: rgba(148, 163, 184, 0.12);
            color: #E2E8F0;
            font-weight: 700;
            font-size: 0.95rem;
        }
        .explanation {
            margin-top: 1.5rem;
            padding: 1.25rem 1.5rem;
            border-radius: 1.5rem;
            background: rgba(14, 165, 233, 0.08);
            border: 1px solid rgba(56, 189, 248, 0.16);
            color: #cfe8ff;
            display: none;
        }
        .explanation.visible {
            display: block;
        }
        .next-btn {
            margin-top: 1.75rem;
            align-self: flex-end;
            padding: 1rem 1.5rem;
            border-radius: 1rem;
            border: none;
            background: #3B82F6;
            color: #fff;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }
        .next-btn:hover {
            background: #60A5FA;
        }
        .loading-card {
            background: rgba(15, 23, 42, 0.92);
            border: 1px solid rgba(148, 163, 184, 0.15);
            border-radius: 1.5rem;
            padding: 2rem;
            box-shadow: 0 32px 90px rgba(0, 0, 0, 0.3);
            text-align: center;
        }
        .loading-bar {
            width: 100%;
            height: 0.85rem;
            margin: 1.5rem 0;
            background: rgba(148, 163, 184, 0.15);
            border-radius: 999px;
            overflow: hidden;
        }
        .loading-bar-fill {
            width: 0;
            height: 100%;
            background: linear-gradient(90deg, #38bdf8, #6366f1);
            transition: width 0.3s ease;
        }
    </style>
</head>
<body>
    <main class="page-shell">
        <div class="header">
            <a href="{{ url('/') }}" class="btn-back">← Kembali ke Beranda</a>
            <div class="status-chip">Mode: Yes or No?</div>
        </div>

        <section class="card" id="game-card">
            <div class="question-box">
                <h2 id="question-title">Memuat game...</h2>
                <p class="question-text" id="question-text">Silakan tunggu sebentar saat data game dimuat dari server.</p>
            </div>

            <div class="status-bar" id="status-bar" style="display:none;">
                <div class="status-chip">Skor: <span id="score-value">0</span></div>
                <div class="status-chip">Soal ke: <span id="question-index">0</span>/<span id="question-total">0</span></div>
            </div>

            <div class="answers" id="answers-container" style="display:none;">
                <button id="btn-yes" class="answer-btn">Yes</button>
                <button id="btn-no" class="answer-btn">No</button>
            </div>

            <div class="explanation" id="explanation-panel">
                <strong>Penjelasan:</strong>
                <p id="explanation-text">-</p>
            </div>

            <button id="next-button" class="next-btn" style="display:none;">Soal berikutnya</button>
        </section>

        <section class="loading-card" id="loading-card">
            <h1>Menyiapkan permainan</h1>
            <p>Data akan dimuat dari REST API. Tunggu beberapa saat sebelum permainan dimulai.</p>
            <div class="loading-bar">
                <div id="game-loading-fill" class="loading-bar-fill"></div>
            </div>
            <p id="countdown-text">Dimulai dalam <strong id="countdown-number">3</strong> detik...</p>
        </section>
    </main>

    <script>
        const questionTitle = document.getElementById('question-title');
        const questionText = document.getElementById('question-text');
        const answerYes = document.getElementById('btn-yes');
        const answerNo = document.getElementById('btn-no');
        const answersContainer = document.getElementById('answers-container');
        const statusBar = document.getElementById('status-bar');
        const scoreValue = document.getElementById('score-value');
        const questionIndex = document.getElementById('question-index');
        const questionTotal = document.getElementById('question-total');
        const explanationPanel = document.getElementById('explanation-panel');
        const explanationText = document.getElementById('explanation-text');
        const nextButton = document.getElementById('next-button');
        const loadingCard = document.getElementById('loading-card');
        const loadingFill = document.getElementById('game-loading-fill');
        const countdownNumber = document.getElementById('countdown-number');

        let questions = [];
        let currentQuestion = 0;
        let score = 0;
        let hasAnswered = false;

        const startCountdown = () => {
            let timeLeft = 3;
            countdownNumber.textContent = timeLeft;
            loadingFill.style.width = '0%';

            const interval = setInterval(() => {
                timeLeft -= 1;
                countdownNumber.textContent = timeLeft;
                loadingFill.style.width = `${((3 - timeLeft) / 3) * 100}%`;

                if (timeLeft <= 0) {
                    clearInterval(interval);
                    loadingFill.style.width = '100%';
                    fetchQuestions();
                }
            }, 1000);
        };

        const fetchQuestions = () => {
            fetch('/api/yes-or-no/questions')
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success' && data.data.length > 0) {
                        questions = data.data;
                        currentQuestion = 0;
                        score = 0;
                        updateStatus();
                        showQuestion();
                        loadingCard.style.display = 'none';
                        answersContainer.style.display = 'grid';
                        statusBar.style.display = 'flex';
                    } else {
                        questionTitle.textContent = 'Data belum tersedia';
                        questionText.textContent = 'Coba lagi nanti setelah seeder dijalankan atau API diperbarui.';
                    }
                })
                .catch(() => {
                    questionTitle.textContent = 'Gagal memuat data';
                    questionText.textContent = 'Pastikan API server berjalan dan coba muat ulang halaman.';
                });
        };

        const updateStatus = () => {
            scoreValue.textContent = score;
            questionIndex.textContent = currentQuestion + 1;
            questionTotal.textContent = questions.length;
        };

        const showQuestion = () => {
            hasAnswered = false;
            explanationPanel.classList.remove('visible');
            nextButton.style.display = 'none';
            resetButtons();
            const question = questions[currentQuestion];
            questionTitle.textContent = `Pertanyaan ${currentQuestion + 1}`;
            questionText.textContent = question.question;
            updateStatus();
        };

        const resetButtons = () => {
            [answerYes, answerNo].forEach(button => {
                button.classList.remove('correct', 'wrong');
                button.disabled = false;
            });
        };

        const answerQuestion = (answer) => {
            if (hasAnswered) return;
            hasAnswered = true;

            const question = questions[currentQuestion];
            const correctAnswer = question.correct_answer;
            const correctButton = correctAnswer === 'yes' ? answerYes : answerNo;
            const wrongButton = correctAnswer === 'yes' ? answerNo : answerYes;

            correctButton.classList.add('correct');
            wrongButton.classList.add('wrong');
            wrongButton.disabled = true;
            answerYes.disabled = true;
            answerNo.disabled = true;

            if (answer === correctAnswer) {
                score += 10;
            }

            explanationText.textContent = question.explanation || 'Tidak ada penjelasan tersedia.';
            explanationPanel.classList.add('visible');
            nextButton.style.display = 'inline-flex';
            updateStatus();
        };

        answerYes.addEventListener('click', () => answerQuestion('yes'));
        answerNo.addEventListener('click', () => answerQuestion('no'));
        nextButton.addEventListener('click', () => {
            if (currentQuestion < questions.length - 1) {
                currentQuestion += 1;
                showQuestion();
            } else {
                questionTitle.textContent = 'Permainan selesai!';
                questionText.textContent = `Skor kamu: ${score}. Terima kasih telah bermain.`;
                answersContainer.style.display = 'none';
                nextButton.style.display = 'none';
                explanationPanel.classList.remove('visible');
            }
        });

        document.addEventListener('DOMContentLoaded', startCountdown);
    </script>
</body>
</html>
