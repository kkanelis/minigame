@extends('layouts.app')

@section('content')
    <div style="background: #0a0a0a; min-height: 100vh; color: white; padding: 0;">
        <!-- Navigation -->
        <nav
            style="background: #000; padding: 20px 40px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #222;">
            <a href="/"
                style="font-size: 24px; font-weight: bold; letter-spacing: 3px; text-decoration: none; color: white;">MINIGAMES</a>
            <div style="display: flex; gap: 30px;">
                <a href="/game" style="color: white; text-decoration: none; font-size: 14px;">Typing Game</a>
                <a href="/memory" style="color: white; text-decoration: none; font-size: 14px;">Memory Game</a>
            </div>
        </nav>

        <!-- Main Content -->
        <div style="padding: 40px; max-width: 1200px; margin: 0 auto;">
            <h1 style="font-size: 48px; margin: 0 0 10px 0; font-weight: bold;">🏆 Leaderboard</h1>
            <p style="color: #999; margin: 0 0 40px 0; font-size: 14px;">Top players worldwide</p>

            <!-- Current Player Info -->
            <div
                style="background: #1a1a1a; border: 1px solid #0066cc; border-radius: 12px; padding: 20px; margin-bottom: 40px; display: flex; align-items: center; gap: 15px;">
                <div style="font-size: 28px;">👤</div>
                <div>
                    <p style="margin: 0; color: #999; font-size: 12px; text-transform: uppercase;">Current Player</p>
                    <p style="margin: 0; color: white; font-size: 20px; font-weight: bold;" id="currentPlayerName">
                        Loading...</p>
                </div>
            </div>

            <!-- Typing Game -->
            <div style="margin-bottom: 60px;">
                <h2 style="font-size: 32px; margin: 0 0 20px 0; font-weight: bold;">⌨️ Typing Game</h2>

                <div style="display: flex; gap: 10px; margin-bottom: 20px;">
                    <button class="typing-tab" data-difficulty="easy"
                        style="padding: 10px 20px; border: 1px solid #333; background: #0066cc; color: white; border-radius: 4px; cursor: pointer; font-weight: bold;">Easy</button>
                    <button class="typing-tab" data-difficulty="medium"
                        style="padding: 10px 20px; border: 1px solid #333; background: transparent; color: white; border-radius: 4px; cursor: pointer; font-weight: bold;">Medium</button>
                    <button class="typing-tab" data-difficulty="hard"
                        style="padding: 10px 20px; border: 1px solid #333; background: transparent; color: white; border-radius: 4px; cursor: pointer; font-weight: bold;">Hard</button>
                    <button class="typing-tab" data-difficulty="hardcore"
                        style="padding: 10px 20px; border: 1px solid #333; background: transparent; color: white; border-radius: 4px; cursor: pointer; font-weight: bold;">Hardcore</button>

                </div>

                <div style="background: #1a1a1a; border: 1px solid #333; border-radius: 12px; overflow: hidden;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="border-bottom: 1px solid #333; background: #0a0a0a;">
                                <th
                                    style="padding: 15px; text-align: left; font-size: 12px; color: #999; text-transform: uppercase;">
                                    Rank</th>
                                <th
                                    style="padding: 15px; text-align: left; font-size: 12px; color: #999; text-transform: uppercase;">
                                    Player</th>
                                <th
                                    style="padding: 15px; text-align: center; font-size: 12px; color: #999; text-transform: uppercase;">
                                    WPM</th>
                                <th
                                    style="padding: 15px; text-align: center; font-size: 12px; color: #999; text-transform: uppercase;">
                                    Accuracy</th>
                                <th
                                    style="padding: 15px; text-align: center; font-size: 12px; color: #999; text-transform: uppercase;">
                                    Time</th>
                            </tr>
                        </thead>
                        <tbody id="typing-easy-body">
                            <tr style="text-align: center; color: #666;">
                                <td colspan="5" style="padding: 40px;">Loading...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Memory Game -->
            <div>
                <h2 style="font-size: 32px; margin: 0 0 20px 0; font-weight: bold;">🃏 Memory Game</h2>

                <div style="display: flex; gap: 10px; margin-bottom: 20px;">
                    <button class="memory-tab" data-difficulty="easy"
                        style="padding: 10px 20px; border: 1px solid #333; background: #0066cc; color: white; border-radius: 4px; cursor: pointer; font-weight: bold;">Easy
                        (2x2)</button>
                    <button class="memory-tab" data-difficulty="medium"
                        style="padding: 10px 20px; border: 1px solid #333; background: transparent; color: white; border-radius: 4px; cursor: pointer; font-weight: bold;">Medium
                        (3x4)</button>
                    <button class="memory-tab" data-difficulty="hard"
                        style="padding: 10px 20px; border: 1px solid #333; background: transparent; color: white; border-radius: 4px; cursor: pointer; font-weight: bold;">Hard
                        (4x5)</button>
                    <button class="memory-tab" data-difficulty="extreme"
                        style="padding: 10px 20px; border: 1px solid #333; background: transparent; color: white; border-radius: 4px; cursor: pointer; font-weight: bold;">Extreme
                        (6x7)</button>
                </div>

                <div style="background: #1a1a1a; border: 1px solid #333; border-radius: 12px; overflow: hidden;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="border-bottom: 1px solid #333; background: #0a0a0a;">
                                <th
                                    style="padding: 15px; text-align: left; font-size: 12px; color: #999; text-transform: uppercase;">
                                    Rank</th>
                                <th
                                    style="padding: 15px; text-align: left; font-size: 12px; color: #999; text-transform: uppercase;">
                                    Player</th>
                                <th
                                    style="padding: 15px; text-align: center; font-size: 12px; color: #999; text-transform: uppercase;">
                                    Time (s)</th>
                                <th
                                    style="padding: 15px; text-align: center; font-size: 12px; color: #999; text-transform: uppercase;">
                                    Moves</th>
                            </tr>
                        </thead>
                        <tbody id="memory-easy-body">
                            <tr style="text-align: center; color: #666;">
                                <td colspan="4" style="padding: 40px;">Loading...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div
            style="border-top: 1px solid #222; padding: 30px 40px; text-align: center; color: #666; font-size: 12px; margin-top: 60px;">
            <p>© 2026 MiniGames. Play, Compete, Improve.</p>
        </div>
    </div>

    <script>
        let currentTypingDifficulty = 'easy';
        let currentMemoryDifficulty = 'easy';

        document.querySelectorAll('.typing-tab').forEach(btn => {
            btn.addEventListener('click', function () {
                document.querySelectorAll('.typing-tab').forEach(b => {
                    b.style.background = 'transparent';
                });
                this.style.background = '#0066cc';
                currentTypingDifficulty = this.dataset.difficulty;
                loadTypingLeaderboard(this.dataset.difficulty);
            });
        });

        document.querySelectorAll('.memory-tab').forEach(btn => {
            btn.addEventListener('click', function () {
                document.querySelectorAll('.memory-tab').forEach(b => {
                    b.style.background = 'transparent';
                });
                this.style.background = '#0066cc';
                currentMemoryDifficulty = this.dataset.difficulty;
                loadMemoryLeaderboard(this.dataset.difficulty);
            });
        });

        function loadTypingLeaderboard(difficulty) {
            const tbody = document.getElementById('typing-easy-body');

            fetch(`/api/leaderboard/typing/${difficulty}`)
                .then(r => {
                    if (!r.ok) throw new Error(`HTTP error! status: ${r.status}`);
                    return r.json();
                })
                .then(results => {
                    tbody.innerHTML = '';
                    if (!results || results.length === 0) {
                        tbody.innerHTML = '<tr style="text-align: center; color: #666;"><td colspan="5" style="padding: 40px;">No results yet</td></tr>';
                    } else {
                        results.forEach((result, idx) => {
                            const row = document.createElement('tr');
                            row.style.borderBottom = '1px solid #333';
                            row.innerHTML = `
                                <td style="padding: 15px; font-weight: bold; color: #0066cc;">#${idx + 1}</td>
                                <td style="padding: 15px;">${result.nickname}</td>
                                <td style="padding: 15px; text-align: center;">${result.words_per_minute}</td>
                                <td style="padding: 15px; text-align: center;">${result.accuracy}%</td>
                                <td style="padding: 15px; text-align: center;">${result.time_taken}s</td>
                            `;
                            tbody.appendChild(row);
                        });
                    }
                })
                .catch(err => {
                    console.error('Error loading leaderboard:', err);
                    tbody.innerHTML = '<tr style="text-align: center; color: #666;"><td colspan="5" style="padding: 40px;">Error loading results</td></tr>';
                });
        }

        function loadMemoryLeaderboard(difficulty) {
            const tbody = document.getElementById('memory-easy-body');

            fetch(`/api/leaderboard/memory/${difficulty}`)
                .then(r => {
                    if (!r.ok) throw new Error(`HTTP error! status: ${r.status}`);
                    return r.json();
                })
                .then(results => {
                    tbody.innerHTML = '';
                    if (!results || results.length === 0) {
                        tbody.innerHTML = '<tr style="text-align: center; color: #666;"><td colspan="4" style="padding: 40px;">No results yet</td></tr>';
                    } else {
                        results.forEach((result, idx) => {
                            const row = document.createElement('tr');
                            row.style.borderBottom = '1px solid #333';
                            row.innerHTML = `
                                <td style="padding: 15px; font-weight: bold; color: #0066cc;">#${idx + 1}</td>
                                <td style="padding: 15px;">${result.nickname}</td>
                                <td style="padding: 15px; text-align: center;">${result.time_taken}s</td>
                                <td style="padding: 15px; text-align: center;">${result.words_per_minute}</td>
                            `;
                            tbody.appendChild(row);
                        });
                    }
                })
                .catch(err => {
                    console.error('Error loading leaderboard:', err);
                    tbody.innerHTML = '<tr style="text-align: center; color: #666;"><td colspan="4" style="padding: 40px;">Error loading results</td></tr>';
                });
        }

        // Load initial data
        loadTypingLeaderboard('easy');
        loadMemoryLeaderboard('easy');

        // Display current player name
        const playerName = sessionStorage.getItem('playerName');
        const currentPlayerNameElement = document.getElementById('currentPlayerName');
        if (playerName) {
            currentPlayerNameElement.textContent = playerName;
        } else {
            currentPlayerNameElement.textContent = 'Unknown Player';
            currentPlayerNameElement.style.color = '#666';
        }
    </script>
@endsection