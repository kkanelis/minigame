@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 bg-gradient">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Game Header -->
            <div class="card mb-4 shadow-lg border-0">
                <div class="card-body p-4">
                    <h1 class="text-center mb-3 text-primary">⌨️ Rakstīšanas ātruma spēle</h1>
                    
                    <!-- Difficulty Selection -->
                    <div class="row mb-4">
                        <div class="col-md-6 mx-auto">
                            <label class="form-label fw-bold">Izvēlieties grūtības līmeni:</label>
                            <select id="difficultySelect" class="form-select form-select-lg mb-3">
                                <option value="easy">Viegli (~50 vārdi)</option>
                                <option value="medium" selected>Vidēji (~100 vārdi)</option>
                                <option value="hard">Grūti (~150 vārdi)</option>
                                <option value="hardcore">Ultragausi (~300 vārdi)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Nickname Input -->
                    <div class="row mb-4">
                        <div class="col-md-6 mx-auto">
                            <label class="form-label fw-bold">Jūsu iesauka:</label>
                            <input type="text" id="nicknameInput" class="form-control form-control-lg" placeholder="Ievadiet savu iesauku" maxlength="50">
                        </div>
                    </div>

                    <!-- Stats Display -->
                    <div class="row text-center mb-4">
                        <div class="col-md-3">
                            <div class="stat-box">
                                <h5>⏱️ Laiks</h5>
                                <h2 id="timerDisplay" class="text-primary">00:00</h2>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-box">
                                <h5>⚡ Vārdi/min</h5>
                                <h2 id="wpmDisplay" class="text-success">0</h2>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-box">
                                <h5>🎯 Precizitāte</h5>
                                <h2 id="accuracyDisplay" class="text-info">0%</h2>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-box">
                                <h5>📊 Progresa</h5>
                                <h2 id="progressDisplay" class="text-warning">0%</h2>
                            </div>
                        </div>
                    </div>

                    <!-- Start Button -->
                    <div class="text-center mb-4">
                        <button id="startBtn" class="btn btn-lg btn-success me-2">
                            <i class="fas fa-play"></i> Sākt spēli
                        </button>
                        <button id="resetBtn" class="btn btn-lg btn-warning" disabled>
                            <i class="fas fa-redo"></i> Atiestatīt
                        </button>
                    </div>
                </div>
            </div>

            <!-- Game Area -->
            <div class="card mb-4 shadow-lg border-0">
                <div class="card-body p-4">
                    <!-- Original Text Display -->
                    <div class="bg-light p-4 rounded mb-4" id="textDisplay">
                        <p id="originalText" class="fs-5 lh-lg mb-0" style="min-height: 100px;">
                            Nospiediet "Sākt spēli" lai sāktu...
                        </p>
                    </div>

                    <!-- Input Area -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">Rakstiet šeit:</label>
                        <textarea id="gameInput" class="form-control" rows="4" placeholder="Sāciet rakstīt šeit..." disabled></textarea>
                    </div>

                    <!-- Word Progress Display -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">Vārdu progress:</label>
                        <div id="wordProgress" class="word-progress p-3 bg-light rounded" style="min-height: 50px;">
                            <span class="text-muted">Vēl nav rakstīti vārdi</span>
                        </div>
                    </div>

                    <!-- Result Modal -->
                    <div id="resultModal" class="modal fade" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-success text-white">
                                    <h5 class="modal-title">🎉 Spēle pabeigta!</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center mb-4">
                                        <h3 class="text-primary">Apsveicam!</h3>
                                    </div>
                                    <div class="result-stats">
                                        <p class="fs-5"><strong>Iesauka:</strong> <span id="resultNickname"></span></p>
                                        <p class="fs-5"><strong>Grūtības līmenis:</strong> <span id="resultDifficulty" class="badge bg-primary"></span></p>
                                        <p class="fs-5"><strong>Laiks:</strong> <span id="resultTime"></span></p>
                                        <p class="fs-5"><strong>Vārdi minūtē:</strong> <span id="resultWPM" class="badge bg-success fs-6"></span></p>
                                        <p class="fs-5"><strong>Precizitāte:</strong> <span id="resultAccuracy" class="badge bg-info fs-6"></span></p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="location.reload()">
                                        Spēlēt vēlreiz
                                    </button>
                                    <button type="button" class="btn btn-secondary" onclick="window.location.href='/leaderboard'">
                                        Skatīt tabulu
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="text-center mb-4">
                <a href="/" class="btn btn-outline-secondary btn-lg me-2">
                    <i class="fas fa-home"></i> Sākumlapa
                </a>
                <a href="/leaderboard" class="btn btn-outline-primary btn-lg">
                    <i class="fas fa-trophy"></i> Skatīt tabulu
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
    }

    .stat-box {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin-bottom: 10px;
    }

    .stat-box h5 {
        color: #666;
        font-size: 14px;
        margin-bottom: 10px;
        font-weight: 600;
    }

    .word-progress {
        font-size: 16px;
        line-height: 1.8;
        word-wrap: break-word;
    }

    .word-progress .correct {
        color: #28a745;
        background-color: #d4edda;
        padding: 2px 4px;
        border-radius: 3px;
        font-weight: 500;
    }

    .word-progress .incorrect {
        color: #dc3545;
        background-color: #f8d7da;
        padding: 2px 4px;
        border-radius: 3px;
        font-weight: 500;
    }

    .word-progress .pending {
        color: #666;
        padding: 2px 4px;
    }

    #originalText .highlight {
        background-color: #fff3cd;
        padding: 2px 4px;
        border-radius: 3px;
    }

    #gameInput:disabled {
        background-color: #f8f9fa;
        cursor: not-allowed;
    }

    #gameInput {
        font-family: 'Courier New', monospace;
        font-size: 16px;
    }

    .result-stats {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
    }

    .result-stats p {
        margin-bottom: 12px;
        padding: 10px;
        background: white;
        border-radius: 5px;
        border-left: 4px solid #667eea;
    }
</style>

<script>
    let gameActive = false;
    let timerInterval = null;
    let gameStartTime = null;
    let originalText = '';
    let typedText = '';
    let currentDifficulty = 'medium';
    let resultModal = null;

    const startBtn = document.getElementById('startBtn');
    const resetBtn = document.getElementById('resetBtn');
    const gameInput = document.getElementById('gameInput');
    const timerDisplay = document.getElementById('timerDisplay');
    const wpmDisplay = document.getElementById('wpmDisplay');
    const accuracyDisplay = document.getElementById('accuracyDisplay');
    const progressDisplay = document.getElementById('progressDisplay');
    const nicknameInput = document.getElementById('nicknameInput');
    const difficultySelect = document.getElementById('difficultySelect');
    const originalTextDisplay = document.getElementById('originalText');
    const wordProgressDisplay = document.getElementById('wordProgress');

    // Initialize Bootstrap Modal when document is ready
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof bootstrap !== 'undefined') {
            resultModal = new bootstrap.Modal(document.getElementById('resultModal'));
        }
    });

    // Start Game
    startBtn.addEventListener('click', async () => {
        if (!nicknameInput.value.trim()) {
            alert('Lūdzu, ievadiet savu iesauku');
            return;
        }

        currentDifficulty = difficultySelect.value;
        
        try {
            const response = await fetch(`/api/game/text?difficulty=${currentDifficulty}`);
            const data = await response.json();
            originalText = data.text;

            gameActive = true;
            typedText = '';
            gameStartTime = Date.now();

            // Update UI
            startBtn.disabled = true;
            resetBtn.disabled = false;
            gameInput.disabled = false;
            gameInput.focus();
            difficultySelect.disabled = true;
            nicknameInput.disabled = true;

            originalTextDisplay.innerHTML = originalText;
            gameInput.value = '';
            wordProgressDisplay.innerHTML = '';

            // Start timer
            updateTimer();
            timerInterval = setInterval(updateTimer, 100);

        } catch (error) {
            console.error('Error loading game text:', error);
            alert('Kļūda ielādējot spēli. Lūdzu, mēģiniet vēlreiz.');
        }
    });

    // Reset Game
    resetBtn.addEventListener('click', () => {
        resetGame();
    });

    // Game Input Handler
    gameInput.addEventListener('input', (e) => {
        typedText = e.target.value;
        updateProgress();
        updateWordProgress();

        // Check if game is complete
        if (typedText === originalText) {
            endGame();
        }
    });

    function updateTimer() {
        if (gameActive && gameStartTime) {
            const elapsed = Math.floor((Date.now() - gameStartTime) / 1000);
            const minutes = Math.floor(elapsed / 60);
            const seconds = elapsed % 60;
            timerDisplay.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

            // Update WPM and Accuracy
            if (typedText.length > 0) {
                const wpm = Math.round((typedText.split(' ').length / elapsed) * 60);
                wpmDisplay.textContent = Math.max(0, wpm);

                const accuracy = calculateAccuracy();
                accuracyDisplay.textContent = accuracy + '%';
            }
        }
    }

    function updateProgress() {
        if (originalText.length === 0) return;
        const progress = Math.round((typedText.length / originalText.length) * 100);
        progressDisplay.textContent = Math.min(100, progress) + '%';
    }

    function updateWordProgress() {
        const originalWords = originalText.split(' ');
        const typedWords = typedText.split(' ');
        let html = '';

        originalWords.forEach((word, index) => {
            const typedWord = typedWords[index] || '';
            
            if (index < typedWords.length - 1 || (typedText[typedText.lastIndexOf(' ') + 1] === undefined)) {
                // Word is complete (we've moved to next word)
                if (typedWord === word) {
                    html += `<span class="correct">${word}</span> `;
                } else if (typedWord === '') {
                    html += `<span class="pending">${word}</span> `;
                } else {
                    html += `<span class="incorrect">${typedWord}</span> `;
                }
            } else {
                // Current word being typed
                html += `<span class="pending">${word}</span> `;
            }
        });

        wordProgressDisplay.innerHTML = html || '<span class="text-muted">Start typing...</span>';
    }

    function calculateAccuracy() {
        let correct = 0;
        const minLength = Math.min(typedText.length, originalText.length);

        for (let i = 0; i < minLength; i++) {
            if (typedText[i] === originalText[i]) {
                correct++;
            }
        }

        if (typedText.length === 0) return 0;
        return Math.round((correct / typedText.length) * 100);
    }

    async function endGame() {
        gameActive = false;
        clearInterval(timerInterval);

        const elapsedSeconds = Math.floor((Date.now() - gameStartTime) / 1000);
        const elapsedMinutes = elapsedSeconds / 60;
        const wpm = Math.round((typedText.split(' ').length / elapsedMinutes));
        const accuracy = calculateAccuracy();

        // Translate difficulty to Latvian
        const difficultyMap = {
            'easy': 'Viegli',
            'medium': 'Vidēji',
            'hard': 'Grūti',
            'hardcore': 'Ultragausi'
        };

        // Show result modal
        document.getElementById('resultNickname').textContent = nicknameInput.value;
        document.getElementById('resultDifficulty').textContent = difficultyMap[currentDifficulty] || currentDifficulty.toUpperCase();
        document.getElementById('resultTime').textContent = formatTime(elapsedSeconds);
        document.getElementById('resultWPM').textContent = Math.max(0, wpm);
        document.getElementById('resultAccuracy').textContent = accuracy + '%';

        // Save result to database
        try {
            const response = await fetch('/api/game/save-result', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    nickname: nicknameInput.value,
                    difficulty: currentDifficulty,
                    time_taken: elapsedSeconds,
                    words_per_minute: Math.max(0, wpm),
                    accuracy: accuracy
                })
            });

            if (!response.ok) {
                console.error('Failed to save result');
            }
        } catch (error) {
            console.error('Error saving result:', error);
        }

        // Show modal if Bootstrap is loaded
        if (resultModal) {
            resultModal.show();
        }
    }

    function resetGame() {
        gameActive = false;
        clearInterval(timerInterval);

        typedText = '';
        gameStartTime = null;
        originalText = '';

        startBtn.disabled = false;
        resetBtn.disabled = true;
        gameInput.disabled = true;
        difficultySelect.disabled = false;
        nicknameInput.disabled = false;

        timerDisplay.textContent = '00:00';
        wpmDisplay.textContent = '0';
        accuracyDisplay.textContent = '0%';
        progressDisplay.textContent = '0%';
        gameInput.value = '';
        originalTextDisplay.textContent = 'Click "Start Game" to begin...';
        wordProgressDisplay.innerHTML = '<span class="text-muted">No words typed yet</span>';
    }

    function formatTime(seconds) {
        const mins = Math.floor(seconds / 60);
        const secs = seconds % 60;
        return `${String(mins).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
    }
</script>
@endsection
