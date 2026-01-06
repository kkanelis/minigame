document.addEventListener('DOMContentLoaded', () => {
    const EMOJIS = ['🐶', '🐱', '🦊', '🐼', '🐵', '🦁', '🐸', '🐨'];
    const board = document.getElementById('board');
    const startBtn = document.getElementById('startBtn');
    const restartBtn = document.getElementById('restartBtn');
    const timerEl = document.getElementById('timer');
    const movesEl = document.getElementById('moves');
    const pairsLeftEl = document.getElementById('pairsLeft');
    const messageEl = document.getElementById('message');

    let deck = [];
    let firstCard = null;
    let secondCard = null;
    let lockBoard = false;
    let matchedPairs = 0;
    let moves = 0;
    let elapsed = 0;
    let interval = null;

    function buildDeck() {
        deck = EMOJIS.concat(EMOJIS).map((val, i) => ({ id: i, value: val, matched: false }));
        shuffle(deck);
    }

    function shuffle(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
    }

    function renderBoard() {
        board.innerHTML = '';
        deck.forEach((card, idx) => {
            const el = document.createElement('button');
            el.className = 'card bg-slate-700 rounded-lg flex items-center justify-center transition-all transform hover:scale-105';
            el.style.aspectRatio = '1 / 1';
            el.style.fontSize = '50px';
            el.style.lineHeight = '1';
            el.dataset.index = idx;
            el.innerHTML = '<span class="front opacity-0" style="display:flex;align-items:center;justify-content:center">' + card.value + '</span>' + '<span class="back" style="display:flex;align-items:center;justify-content:center;font-size:50px">?</span>';
            el.addEventListener('click', onCardClick);
            board.appendChild(el);
        });
    }

    function onCardClick(e) {
        if (lockBoard) return;
        const el = e.currentTarget;
        const idx = Number(el.dataset.index);
        const card = deck[idx];
        if (card.matched) return;
        if (el === firstCard) return;

        flip(el);

        if (!firstCard) {
            firstCard = el;
            return;
        }

        secondCard = el;
        moves++;
        movesEl.textContent = moves;

        const firstIdx = Number(firstCard.dataset.index);
        const secondIdx = Number(secondCard.dataset.index);

        if (deck[firstIdx].value === deck[secondIdx].value) {
            // match
            deck[firstIdx].matched = true;
            deck[secondIdx].matched = true;
            matchedPairs++;
            pairsLeftEl.textContent = EMOJIS.length - matchedPairs;
            resetTurn(true);
            if (matchedPairs === EMOJIS.length) endGame();
        } else {
            lockBoard = true;
            setTimeout(() => {
                unflip(firstCard);
                unflip(secondCard);
                resetTurn(false);
            }, 700);
        }
    }

    function flip(el) {
        el.classList.add('bg-blue-600');
        const front = el.querySelector('.front');
        const back = el.querySelector('.back');
        front.classList.remove('opacity-0');
        back.style.visibility = 'hidden';
    }

    function unflip(el) {
        el.classList.remove('bg-blue-600');
        const front = el.querySelector('.front');
        const back = el.querySelector('.back');
        front.classList.add('opacity-0');
        back.style.visibility = 'visible';
    }

    function resetTurn(matched) {
        firstCard = null;
        secondCard = null;
        lockBoard = false;
    }

    function startTimer() {
        clearInterval(interval);
        elapsed = 0;
        timerEl.textContent = '0s';
        interval = setInterval(() => {
            elapsed++;
            timerEl.textContent = elapsed + 's';
        }, 1000);
    }

    function stopTimer() {
        clearInterval(interval);
    }

    function startGame() {
        buildDeck();
        renderBoard();
        matchedPairs = 0;
        moves = 0;
        movesEl.textContent = '0';
        pairsLeftEl.textContent = EMOJIS.length;
        messageEl.textContent = '';
        startTimer();
    }

    function endGame() {
        stopTimer();
        messageEl.innerHTML = `<div class="text-green-300 text-xl">Apsveicu! Atradi visus pārus: <strong>${moves}</strong> gājienos, <strong>${elapsed}s</strong>.</div>`;
    }

    function resetGame() {
        stopTimer();
        buildDeck();
        renderBoard();
        matchedPairs = 0;
        moves = 0;
        elapsed = 0;
        movesEl.textContent = '0';
        timerEl.textContent = '0s';
        pairsLeftEl.textContent = EMOJIS.length;
        messageEl.textContent = '';
    }

    startBtn.addEventListener('click', startGame);
    restartBtn.addEventListener('click', resetGame);

    // initialize board on load
    buildDeck();
    renderBoard();
    pairsLeftEl.textContent = EMOJIS.length;
});
