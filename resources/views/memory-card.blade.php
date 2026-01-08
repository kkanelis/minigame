@extends('layouts.app')

@section('title', 'Atmiņas kāršu spēle')

@section('content')
    <div style="background: #0a0a0a; min-height: 100vh; color: white; padding: 0;">
        <!-- Navigation -->
        <nav
            style="background: #000; padding: 20px 40px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #222;">
            <a href="/"
                style="font-size: 24px; font-weight: bold; letter-spacing: 3px; text-decoration: none; color: white;">MINIGAMES</a>
            <div style="display: flex; gap: 30px;">
                <a href="/game" style="color: white; text-decoration: none; font-size: 14px;">Typing Game</a>
                <a href="/leaderboard" style="color: white; text-decoration: none; font-size: 14px;">Leaderboard</a>
            </div>
        </nav>

        <!-- Main Content -->
        <div style="padding: 40px; max-width: 800px; margin: 0 auto;">
            <h1 style="font-size: 48px; margin: 0 0 10px 0; font-weight: bold;">🃏 Memory Game</h1>
            <p style="color: #999; margin: 0 0 40px 0; font-size: 14px;">Match pairs and climb the leaderboard</p>

            <!-- Setup Section -->
            <div
                style="background: #1a1a1a; border: 1px solid #333; padding: 30px; border-radius: 12px; margin-bottom: 30px;">
                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 30px;">
                    <!-- Difficulty -->
                    <div>
                        <label
                            style="display: block; margin-bottom: 15px; font-weight: bold; font-size: 14px; color: #999; text-transform: uppercase;">Difficulty</label>
                        <div style="display: flex; flex-direction: column; gap: 10px;">
                            <button class="difficulty-btn" data-difficulty="easy" data-cols="2" data-rows="2"
                                style="padding: 12px; border: 2px solid #333; border-radius: 4px; cursor: pointer; background: transparent; color: white; font-weight: bold; transition: all 0.3s;">
                                Easy (2x2)
                            </button>
                            <button class="difficulty-btn" data-difficulty="medium" data-cols="3" data-rows="4"
                                style="padding: 12px; border: 2px solid #333; border-radius: 4px; cursor: pointer; background: transparent; color: white; font-weight: bold; transition: all 0.3s;">
                                Medium (3x4)
                            </button>
                            <button class="difficulty-btn" data-difficulty="hard" data-cols="4" data-rows="5"
                                style="padding: 12px; border: 2px solid #333; border-radius: 4px; cursor: pointer; background: transparent; color: white; font-weight: bold; transition: all 0.3s;">
                                Hard (4x5)
                            </button>
                            <button class="difficulty-btn" data-difficulty="extreme" data-cols="6" data-rows="7"
                                style="padding: 12px; border: 2px solid #333; border-radius: 4px; cursor: pointer; background: transparent; color: white; font-weight: bold; transition: all 0.3s;">
                                EXTREME 😡 (6x7)
                            </button>
                        </div>
                    </div>

                    <!-- Start Button -->
                    <div style="display: flex; align-items: flex-end;">
                        <button id="startBtn"
                            style="width: 100%; padding: 12px; background: white; color: #000; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; font-size: 16px;">Start
                            Game</button>
                    </div>
                </div>
            </div>

            <!-- Stats Section -->
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px;">
                <div
                    style="background: #1a1a1a; border: 1px solid #333; padding: 20px; border-radius: 12px; text-align: center;">
                    <p style="margin: 0 0 10px 0; font-size: 12px; color: #999; text-transform: uppercase;">Time</p>
                    <p id="timer" style="margin: 0; font-size: 32px; font-weight: bold;">0:00</p>
                </div>
                <div
                    style="background: #1a1a1a; border: 1px solid #333; padding: 20px; border-radius: 12px; text-align: center;">
                    <p style="margin: 0 0 10px 0; font-size: 12px; color: #999; text-transform: uppercase;">Moves</p>
                    <p id="moves" style="margin: 0; font-size: 32px; font-weight: bold;">0</p>
                </div>
                <div
                    style="background: #1a1a1a; border: 1px solid #333; padding: 20px; border-radius: 12px; text-align: center;">
                    <p style="margin: 0 0 10px 0; font-size: 12px; color: #999; text-transform: uppercase;">Remaining</p>
                    <p id="pairsLeft" style="margin: 0; font-size: 32px; font-weight: bold;">0</p>
                </div>
                <div
                    style="background: #1a1a1a; border: 1px solid #333; padding: 20px; border-radius: 12px; text-align: center;">
                    <p style="margin: 0 0 10px 0; font-size: 12px; color: #999; text-transform: uppercase;">Player</p>
                    <p id="playerDisplay" style="margin: 0; font-size: 24px; font-weight: bold; color: #0066cc;">-</p>
                </div>
            </div>

            <!-- Game Board -->
            <div
                style="background: #1a1a1a; border: 1px solid #333; padding: 100px; border-radius: 12px; text-align: center;">
                <div id="gameBoard" style="display: grid; gap: 15px; margin: 0 auto;">
                    <!-- Cards will be generated here -->
                </div>
            </div>

            <!-- Game Over Modal -->
            <div id="gameOverModal"
                style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.8); align-items: center; justify-content: center; z-index: 1000;">
                <div
                    style="background: #1a1a1a; border: 1px solid #333; padding: 40px; border-radius: 12px; text-align: center; max-width: 400px;">
                    <h2 style="font-size: 32px; margin: 0 0 20px 0;">🎉 Game Over!</h2>
                    <div style="margin: 20px 0;">
                        <p style="color: #999; margin: 10px 0;">Time</p>
                        <p id="finalTime" style="margin: 10px 0; font-size: 24px; font-weight: bold;">0:00</p>
                    </div>
                    <div style="margin: 20px 0;">
                        <p style="color: #999; margin: 10px 0;">Total Moves</p>
                        <p id="finalMoves" style="margin: 10px 0; font-size: 24px; font-weight: bold;">0</p>
                    </div>
                    <button onclick="location.reload()"
                        style="width: 100%; padding: 12px; background: white; color: #000; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; font-size: 16px; margin-top: 20px;">Play
                        Again</button>
                    <a href="/"
                        style="display: block; padding: 12px; color: #0066cc; text-decoration: none; margin-top: 10px; font-weight: bold;">Back
                        Home</a>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div
            style="border-top: 1px solid #222; padding: 30px 40px; text-align: center; color: #666; font-size: 12px; margin-top: 60px;">
            <p>© 2026 MiniGames. Play, Compete, Improve.</p>
        </div>
    </div>

    <style>
        * {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        .difficulty-btn.active {
            background: #0066cc !important;
            border-color: #0066cc !important;
        }

        .card {
            width: 100%;
            aspect-ratio: 1;
            background: #2a2a2a;
            border: 2px solid #444;
            border-radius: 8px;
            cursor: pointer;
            font-size: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            user-select: none;
        }

        .card:hover:not(.flipped):not(.matched) {
            background: #333;
            border-color: #555;
            transform: scale(1.05);
        }

        .card.flipped {
            background: #0066cc;
            border-color: #0088ff;
        }

        .card.matched {
            background: #00aa00;
            border-color: #00ff00;
            opacity: 0.7;
            cursor: default;
        }
    </style>

    <script>
        const emojis = ['🐶', '🐱', '🦊', '🐼', '🐵', '🦁', '🐸', '🐨', '🐰', '🦋', '🐻', '🦝', '🐲', '🦑', '🦕', '🐙', '🦖', '🐝', '🦗', '🐛', '🦂', '🐞', '🐝'];

        let cols = 2, rows = 2;
        let deck = [];
        let firstCard = null, secondCard = null;
        let lockBoard = false;
        let matchedPairs = 0;
        let moves = 0;
        let timerInterval = null;
        let elapsedSeconds = 0;
        let gameStarted = false;
        let gameActive = false;
        let playerName = '';

        function buildDeck() {
            const totalCards = cols * rows;
            const pairsNeeded = totalCards / 2;
            deck = [];
            for (let i = 0; i < pairsNeeded; i++) {
                deck.push(emojis[i]);
                deck.push(emojis[i]);
            }
            shuffle();
        }

        function shuffle() {
            for (let i = deck.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [deck[i], deck[j]] = [deck[j], deck[i]];
            }
        }

        function renderBoard() {
            const board = document.getElementById('gameBoard');
            board.innerHTML = '';
            board.style.gridTemplateColumns = `repeat(${cols}, 1fr)`;

            deck.forEach((emoji, idx) => {
                const btn = document.createElement('button');
                btn.className = 'card';
                btn.dataset.emoji = emoji;
                btn.dataset.index = idx;
                btn.textContent = '';
                btn.addEventListener('click', onCardClick);
                board.appendChild(btn);
            });

            document.getElementById('pairsLeft').textContent = deck.length / 2;
        }

        function onCardClick(e) {
            if (lockBoard || !gameActive) return;
            const el = e.currentTarget;

            if (el.classList.contains('matched') || el === firstCard) return;

            el.textContent = el.dataset.emoji;
            el.classList.add('flipped');

            if (!firstCard) {
                firstCard = el;
                return;
            }

            secondCard = el;
            moves++;
            document.getElementById('moves').textContent = moves;
            lockBoard = true;

            if (firstCard.dataset.emoji === secondCard.dataset.emoji) {
                firstCard.classList.add('matched');
                secondCard.classList.add('matched');
                matchedPairs++;
                document.getElementById('pairsLeft').textContent = (deck.length / 2) - matchedPairs;

                if (matchedPairs === deck.length / 2) {
                    endGame();
                }

                firstCard = null;
                secondCard = null;
                lockBoard = false;
            } else {
                setTimeout(() => {
                    firstCard.textContent = '';
                    firstCard.classList.remove('flipped');
                    secondCard.textContent = '';
                    secondCard.classList.remove('flipped');

                    firstCard = null;
                    secondCard = null;
                    lockBoard = false;
                }, 600);
            }
        }

        function startTimer() {
            timerInterval = setInterval(() => {
                elapsedSeconds++;
                const mins = Math.floor(elapsedSeconds / 60);
                const secs = elapsedSeconds % 60;
                document.getElementById('timer').textContent = `${mins}:${secs.toString().padStart(2, '0')}`;
            }, 1000);
        }

        function endGame() {
            gameActive = false;
            clearInterval(timerInterval);

            document.getElementById('finalTime').textContent = document.getElementById('timer').textContent;
            document.getElementById('finalMoves').textContent = moves;

            setTimeout(() => {
                document.getElementById('gameOverModal').style.display = 'flex';
            }, 500);

            // Save result
            let difficultyName = 'easy';
            if (cols === 3 && rows === 4) difficultyName = 'medium';
            if (cols === 4 && rows === 5) difficultyName = 'hard';
            if (cols === 6 && rows === 7) difficultyName = 'extreme';

            fetch('/api/memory-result', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({
                    nickname: playerName,
                    difficulty: `memory_${difficultyName}`,
                    time_taken: elapsedSeconds,
                    words_per_minute: moves,
                    accuracy: 100
                })
            });
        }

        document.querySelectorAll('.difficulty-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                document.querySelectorAll('.difficulty-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                cols = parseInt(this.dataset.cols);
                rows = parseInt(this.dataset.rows);
            });
        });

        document.getElementById('startBtn').addEventListener('click', () => {
            playerName = sessionStorage.getItem('playerName') || 'Anonymous';
            document.getElementById('playerDisplay').textContent = playerName;

            if (!gameStarted) {
                gameStarted = true;
                gameActive = true;
                buildDeck();
                renderBoard();
                startTimer();
                document.getElementById('startBtn').style.opacity = '0.5';
                document.getElementById('startBtn').disabled = true;
            }
        });

        // Select first difficulty by default
        document.querySelector('.difficulty-btn').classList.add('active');
    </script>
@endsection