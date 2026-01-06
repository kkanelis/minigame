@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 bg-gradient">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <!-- HEADER -->
            <div class="card mb-4 shadow-lg border-0">
                <div class="card-body p-4">
                    <h1 class="text-center mb-4 text-primary">
                        ⌨️ Rakstīšanas ātruma spēle
                    </h1>

                    <!-- Difficulty -->
                    <div class="row mb-3">
                        <div class="col-md-6 mx-auto">
                            <label class="form-label fw-bold">Grūtības līmenis</label>
                            <select id="difficultySelect" class="form-select form-select-lg">
                                <option value="easy">Viegli (~50 vārdi)</option>
                                <option value="medium" selected>Vidēji (~100 vārdi)</option>
                                <option value="hard">Grūti (~150 vārdi)</option>
                                <option value="hardcore">Ultragrūti (~300 vārdi)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Nickname -->
                    <div class="row mb-4">
                        <div class="col-md-6 mx-auto">
                            <label class="form-label fw-bold">Iesauka</label>
                            <input id="nicknameInput" class="form-control form-control-lg" maxlength="50"
                                   placeholder="Ievadiet savu iesauku">
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="row text-center">
                        <div class="col-md-3">
                            <div class="stat-box">
                                <h5>⏱️ Laiks</h5>
                                <h2 id="timerDisplay">00:00</h2>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-box">
                                <h5>⚡ Vārdi/min</h5>
                                <h2 id="wpmDisplay">0</h2>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-box">
                                <h5>🎯 Precizitāte</h5>
                                <h2 id="accuracyDisplay">0%</h2>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-box">
                                <h5>📊 Progress</h5>
                                <h2 id="progressDisplay">0%</h2>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="text-center mt-4">
                        <button id="startBtn" class="btn btn-success btn-lg me-2">
                            ▶ Sākt
                        </button>
                        <button id="resetBtn" class="btn btn-warning btn-lg" disabled>
                            🔄 Atiestatīt
                        </button>
                    </div>
                </div>
            </div>

            <!-- GAME AREA -->
            <div class="card shadow-lg border-0">
                <div class="card-body p-4">

                    <div class="bg-light rounded p-3 mb-4">
                        <p id="originalText" class="mb-0 fs-5">
                            Nospiediet "Sākt", lai sāktu spēli.
                        </p>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Rakstiet šeit</label>
                        <textarea id="gameInput" class="form-control" rows="4" disabled
                                  placeholder="Sāciet rakstīt..."></textarea>
                    </div>

                    <div>
                        <label class="form-label fw-bold">Vārdu progress</label>
                        <div id="wordProgress" class="word-progress bg-light rounded p-3">
                            <span class="text-muted">Vēl nav rakstīti vārdi</span>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- STYLES -->
<style>
.bg-gradient {
    background: #f4f6fb;
    min-height: 100vh;
}

.card {
    border-radius: 12px;
}

.shadow-lg {
    box-shadow: 0 8px 24px rgba(0,0,0,.08) !important;
}

.stat-box {
    background: #fff;
    border: 1px solid #e6e9f0;
    border-radius: 10px;
    padding: 16px;
}

.stat-box h5 {
    font-size: 14px;
    color: #666;
    margin-bottom: 6px;
}

.stat-box h2 {
    font-weight: 700;
    margin: 0;
}

#gameInput {
    font-family: monospace;
    font-size: 17px;
    line-height: 1.6;
}

.word-progress span {
    margin-right: 4px;
}

.correct {
    color: #198754;
    background: #d1e7dd;
    padding: 2px 4px;
    border-radius: 4px;
}

.incorrect {
    color: #dc3545;
    background: #f8d7da;
    padding: 2px 4px;
    border-radius: 4px;
}

.pending {
    color: #6c757d;
}
</style>

<!-- SCRIPT -->
<script>
let gameActive = false;
let startTime = null;
let timerInterval = null;
let originalText = '';
let typedText = '';

const startBtn = document.getElementById('startBtn');
const resetBtn = document.getElementById('resetBtn');
const gameInput = document.getElementById('gameInput');
const timerDisplay = document.getElementById('timerDisplay');
const wpmDisplay = document.getElementById('wpmDisplay');
const accuracyDisplay = document.getElementById('accuracyDisplay');
const progressDisplay = document.getElementById('progressDisplay');
const originalTextDisplay = document.getElementById('originalText');
const wordProgress = document.getElementById('wordProgress');
const nicknameInput = document.getElementById('nicknameInput');
const difficultySelect = document.getElementById('difficultySelect');

startBtn.onclick = async () => {
    if (!nicknameInput.value.trim()) {
        alert('Ievadiet iesauku!');
        return;
    }

    const res = await fetch(`/api/game/text?difficulty=${difficultySelect.value}`);
    const data = await res.json();
    originalText = data.text;

    gameActive = true;
    typedText = '';
    startTime = Date.now();

    startBtn.disabled = true;
    resetBtn.disabled = false;
    gameInput.disabled = false;
    difficultySelect.disabled = true;
    nicknameInput.disabled = true;

    originalTextDisplay.textContent = originalText;
    gameInput.value = '';
    gameInput.focus();

    timerInterval = setInterval(updateTimer, 100);
};

resetBtn.onclick = () => location.reload();

gameInput.addEventListener('input', e => {
    typedText = e.target.value;
    updateProgress();
    updateWordProgress();

    if (typedText === originalText) {
        clearInterval(timerInterval);
        alert('🎉 Spēle pabeigta!');
    }
});

function updateTimer() {
    if (!gameActive) return;

    const elapsed = Math.floor((Date.now() - startTime) / 1000);
    const min = String(Math.floor(elapsed / 60)).padStart(2,'0');
    const sec = String(elapsed % 60).padStart(2,'0');
    timerDisplay.textContent = `${min}:${sec}`;

    if (elapsed > 0 && typedText.length > 0) {
        const words = typedText.trim().split(/\s+/).length;
        wpmDisplay.textContent = Math.round(words / elapsed * 60);
        accuracyDisplay.textContent = calculateAccuracy() + '%';
    }
}

function updateProgress() {
    progressDisplay.textContent =
        Math.min(100, Math.round(typedText.length / originalText.length * 100)) + '%';
}

function updateWordProgress() {
    const o = originalText.split(' ');
    const t = typedText.trim().split(' ');
    let html = '';

    o.forEach((word, i) => {
        if (i < t.length) {
            html += t[i] === word
                ? `<span class="correct">${word}</span>`
                : `<span class="incorrect">${word}</span>`;
        } else {
            html += `<span class="pending">${word}</span>`;
        }
    });

    wordProgress.innerHTML = html;
}

function calculateAccuracy() {
    let correct = 0;
    for (let i = 0; i < typedText.length; i++) {
        if (typedText[i] === originalText[i]) correct++;
    }
    return typedText.length
        ? Math.round(correct / typedText.length * 100)
        : 0;
}
</script>
@endsection
