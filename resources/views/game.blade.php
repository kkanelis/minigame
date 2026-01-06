@extends('layouts.app')

@section('title', 'Typing Game')

@section('content')
<div style="background: #0a0a0a; min-height: 100vh; color: white; padding: 0;">
    <!-- Navigation -->
    <nav style="background: #000; padding: 20px 40px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #222;">
        <a href="/" style="font-size: 24px; font-weight: bold; letter-spacing: 3px; text-decoration: none; color: white;">MINIGAMES</a>
        <div style="display: flex; gap: 30px;">
            <a href="/memory" style="color: white; text-decoration: none; font-size: 14px;">Memory Game</a>
            <a href="/leaderboard" style="color: white; text-decoration: none; font-size: 14px;">Leaderboard</a>
        </div>
    </nav>

    <!-- Main Content -->
    <div style="padding: 40px; max-width: 1200px; margin: 0 auto;">
        <h1 style="font-size: 48px; margin: 0 0 10px 0; font-weight: bold;">⌨️ Typing Game</h1>
        <p style="color: #999; margin: 0 0 40px 0; font-size: 14px;">Test your typing speed and accuracy</p>

        <div style="display: grid; grid-template-columns: 300px 1fr; gap: 40px;">
            <!-- Left Sidebar -->
            <div>
                <!-- Settings -->
                <div style="background: #1a1a1a; border: 1px solid #333; padding: 20px; border-radius: 12px; margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 15px; font-weight: bold; font-size: 14px; color: #999; text-transform: uppercase;">Difficulty</label>
                    <select id="difficulty" style="width: 100%; padding: 10px; background: #0a0a0a; color: white; border: 1px solid #333; border-radius: 4px; margin-bottom: 20px;">
                        <option value="easy">Easy</option>
                        <option value="medium">Medium</option>
                        <option value="hard">Hard</option>
                        <option value="hardcore">Hardcore</option>
                    </select>

                    <label style="display: block; margin-bottom: 10px; font-weight: bold; font-size: 14px; color: #999; text-transform: uppercase;">Player Name</label>
                    <input id="playerName" type="text" maxlength="30" style="width: 100%; padding: 10px; background: #0a0a0a; color: white; border: 1px solid #333; border-radius: 4px;" placeholder="Enter name">
                </div>

                <!-- Stats -->
                <div style="background: #1a1a1a; border: 1px solid #333; padding: 20px; border-radius: 12px;">
                    <div style="margin-bottom: 20px; text-align: center;">
                        <p style="margin: 0 0 10px 0; font-size: 12px; color: #999; text-transform: uppercase;">WPM</p>
                        <p id="wpm" style="margin: 0; font-size: 32px; font-weight: bold;">0</p>
                    </div>
                    <div style="margin-bottom: 20px; text-align: center;">
                        <p style="margin: 0 0 10px 0; font-size: 12px; color: #999; text-transform: uppercase;">Accuracy</p>
                        <p id="accuracy" style="margin: 0; font-size: 28px; font-weight: bold;">100%</p>
                    </div>
                    <div style="text-align: center;">
                        <p style="margin: 0 0 10px 0; font-size: 12px; color: #999; text-transform: uppercase;">Time</p>
                        <p id="timer" style="margin: 0; font-size: 28px; font-weight: bold;">0:00</p>
                    </div>
                </div>
            </div>

            <!-- Main Game Area -->
            <div>
                <!-- Target Text -->
                <div style="background: #1a1a1a; border: 1px solid #333; padding: 30px; border-radius: 12px; margin-bottom: 10px;">
                    <p id="targetText" style="margin: 0; font-size: 20px; line-height: 1.8; color: #999;"></p>
                </div>

                <!-- Progress Display -->
                <div style="background: #1a1a1a; border: 1px solid #333; padding: 20px; border-radius: 12px; margin-bottom: 20px;">
                    <div style="display: flex; flex-wrap: wrap; gap: 6px;" id="progressDisplay"></div>
                </div>

                <!-- Input Area -->
                <div style="background: #1a1a1a; border: 1px solid #333; padding: 20px; border-radius: 12px;">
                    <textarea id="gameInput" style="width: 100%; height: 120px; background: #0a0a0a; color: white; border: 1px solid #444; border-radius: 4px; padding: 15px; font-size: 16px; font-family: monospace; resize: none;" placeholder="Start typing here..."></textarea>
                    <button onclick="resetGame()" style="width: 100%; padding: 12px; background: #666; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; margin-top: 10px;">Reset</button>
                </div>
            </div>
        </div>

        <!-- Game Over Modal -->
        <div id="gameOverModal" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.9); align-items: center; justify-content: center; z-index: 1000;">
            <div style="background: #1a1a1a; border: 1px solid #333; padding: 40px; border-radius: 12px; text-align: center; max-width: 500px;">
                <h2 style="font-size: 32px; margin: 0 0 20px 0;">🎉 Completed!</h2>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin: 30px 0;">
                    <div>
                        <p style="color: #999; margin: 10px 0; font-size: 14px; text-transform: uppercase;">WPM</p>
                        <p id="finalWpm" style="margin: 10px 0; font-size: 28px; font-weight: bold;">0</p>
                    </div>
                    <div>
                        <p style="color: #999; margin: 10px 0; font-size: 14px; text-transform: uppercase;">Accuracy</p>
                        <p id="finalAccuracy" style="margin: 10px 0; font-size: 28px; font-weight: bold;">100%</p>
                    </div>
                    <div>
                        <p style="color: #999; margin: 10px 0; font-size: 14px; text-transform: uppercase;">Time</p>
                        <p id="finalTime" style="margin: 10px 0; font-size: 28px; font-weight: bold;">0:00</p>
                    </div>
                    <div>
                        <p style="color: #999; margin: 10px 0; font-size: 14px; text-transform: uppercase;">Difficulty</p>
                        <p id="finalDifficulty" style="margin: 10px 0; font-size: 28px; font-weight: bold; text-transform: capitalize;">-</p>
                    </div>
                </div>
                <button onclick="resetGame()" style="width: 100%; padding: 12px; background: white; color: #000; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; margin-top: 20px;">Play Again</button>
                <a href="/" style="display: block; padding: 12px; color: #0066cc; text-decoration: none; margin-top: 10px; font-weight: bold;">Back Home</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div style="border-top: 1px solid #222; padding: 30px 40px; text-align: center; color: #666; font-size: 12px; margin-top: 60px;">
        <p>© 2026 MiniGames. Play, Compete, Improve.</p>
    </div>
</div>

<script>
const texts = {
    easy: [
        "The quick brown fox jumps over the lazy dog",
        "Hello world, this is a typing test",
        "Practice makes perfect in all things"
    ],
    medium: [
        "The development of artificial intelligence has progressed rapidly in recent years with breakthrough innovations",
        "Web development requires both frontend and backend expertise to build complete applications",
        "Learning to type faster requires consistent practice and patience"
    ],
    hard: [
        "Sophisticated algorithms and complex data structures form the foundation of modern computer science and software engineering",
        "The intersection of technology and creativity has produced remarkable innovations that transform how we live and work",
        "Understanding distributed systems and cloud computing is essential for building scalable applications today"
    ],
    hardcore: [
        "Characteristically, contemporary technological paradigms necessitate multifaceted methodologies encompassing sophisticated cryptographic implementations and advanced algorithmic abstractions",
        "The phenomenological implications of quantum computational mechanisms represent unprecedented opportunities within machine learning architectures and artificial intelligence frameworks",
        "Implementing comprehensive cybersecurity infrastructures demands meticulous attention to cryptographic protocols, vulnerability assessment procedures, and comprehensive penetration testing methodologies"
    ]
};

let currentText = '';
let gameInput = document.getElementById('gameInput');
let targetText = document.getElementById('targetText');
let timerDisplay = document.getElementById('timer');
let wpmDisplay = document.getElementById('wpm');
let accuracyDisplay = document.getElementById('accuracy');
let progressDisplay = document.getElementById('progressDisplay');

let startTime = null;
let timerInterval = null;
let gameStarted = false;
let gameFinished = false;

function getRandomText(difficulty) {
    const textArray = texts[difficulty] || texts.easy;
    return textArray[Math.floor(Math.random() * textArray.length)];
}

function initGame() {
    const difficulty = document.getElementById('difficulty').value;
    currentText = getRandomText(difficulty);
    targetText.textContent = currentText;
    gameInput.focus();
    updateProgress();
}

function startTimer() {
    startTime = Date.now();
    timerInterval = setInterval(updateTimer, 100);
}

function updateTimer() {
    const elapsed = (Date.now() - startTime) / 1000;
    const mins = Math.floor(elapsed / 60);
    const secs = Math.floor(elapsed % 60);
    timerDisplay.textContent = `${mins}:${secs.toString().padStart(2, '0')}`;
    updateStats();
}

function updateStats() {
    if (!gameStarted || !startTime) return;
    
    const elapsed = (Date.now() - startTime) / 1000;
    const typed = gameInput.value;
    
    let correct = 0;
    for (let i = 0; i < typed.length && i < currentText.length; i++) {
        if (typed[i] === currentText[i]) correct++;
    }
    
    const wpm = Math.round((correct / 5) / (elapsed / 60)) || 0;
    const accuracy = typed.length > 0 ? Math.round((correct / typed.length) * 100) : 100;
    
    wpmDisplay.textContent = wpm;
    accuracyDisplay.textContent = accuracy + '%';
}

function updateProgress() {
    const typed = gameInput.value;
    progressDisplay.innerHTML = '';
    
    for (let i = 0; i < currentText.length; i++) {
        const span = document.createElement('span');
        const char = currentText[i];
        const typedChar = typed[i];
        
        if (i < typed.length) {
            if (typedChar === char) {
                span.textContent = char;
                span.style.color = '#00aa00';
                span.style.backgroundColor = 'transparent';
            } else {
                span.textContent = char;
                span.style.color = '#ff6600';
                span.style.backgroundColor = '#330000';
            }
        } else if (i === typed.length) {
            span.textContent = char;
            span.style.color = '#0066cc';
            span.style.backgroundColor = 'transparent';
        } else {
            span.textContent = char;
            span.style.color = '#666';
            span.style.backgroundColor = 'transparent';
        }
        
        span.style.display = 'inline-block';
        progressDisplay.appendChild(span);
    }
}

function endGame() {
    gameFinished = true;
    gameStarted = false;
    clearInterval(timerInterval);
    gameInput.disabled = true;
    
    const elapsed = (Date.now() - startTime) / 1000;
    const typed = gameInput.value;
    let correct = 0;
    
    for (let i = 0; i < typed.length && i < currentText.length; i++) {
        if (typed[i] === currentText[i]) correct++;
    }
    
    const wpm = Math.round((correct / 5) / (elapsed / 60)) || 0;
    const accuracy = Math.round((correct / currentText.length) * 100);
    const mins = Math.floor(elapsed / 60);
    const secs = Math.floor(elapsed % 60);
    
    document.getElementById('finalWpm').textContent = wpm;
    document.getElementById('finalAccuracy').textContent = accuracy + '%';
    document.getElementById('finalTime').textContent = `${mins}:${secs.toString().padStart(2, '0')}`;
    document.getElementById('finalDifficulty').textContent = document.getElementById('difficulty').value;
    
    document.getElementById('gameOverModal').style.display = 'flex';
    
    // Save result
    fetch('/api/game-result', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
        },
        body: JSON.stringify({
            nickname: document.getElementById('playerName').value || 'Anonymous',
            difficulty: document.getElementById('difficulty').value,
            time_taken: Math.floor(elapsed),
            words_per_minute: wpm,
            accuracy: accuracy
        })
    });
}

function resetGame() {
    gameStarted = false;
    gameFinished = false;
    startTime = null;
    clearInterval(timerInterval);
    
    gameInput.value = '';
    gameInput.disabled = false;
    timerDisplay.textContent = '0:00';
    wpmDisplay.textContent = '0';
    accuracyDisplay.textContent = '100%';
    document.getElementById('gameOverModal').style.display = 'none';
    
    initGame();
    gameInput.focus();
}

gameInput.addEventListener('input', (e) => {
    if (!gameStarted && gameInput.value.length > 0) {
        gameStarted = true;
        startTimer();
    }
    
    if (gameStarted) {
        updateProgress();
        if (gameInput.value === currentText) {
            endGame();
        }
    }
});

document.getElementById('difficulty').addEventListener('change', () => {
    if (!gameStarted && !gameFinished) {
        initGame();
    }
});

// Initialize on load
initGame();
</script>
@endsection
