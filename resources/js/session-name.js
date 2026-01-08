/**
 * Session Name Manager
 * Handles getting and storing player name for the session
 */

document.addEventListener('DOMContentLoaded', function () {
    // Check if name already exists in session
    let playerName = sessionStorage.getItem('playerName');

    if (!playerName) {
        // Prompt for name if not in session
        showNameModal();
    } else {
        // Update the display with existing name
        updateNameDisplay(playerName);
    }
});

function showNameModal() {
    // Create modal overlay
    const overlay = document.createElement('div');
    overlay.id = 'nameModalOverlay';
    overlay.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    `;

    // Create modal content
    const modal = document.createElement('div');
    modal.style.cssText = `
        background: #1a1a1a;
        border: 2px solid #0066cc;
        border-radius: 12px;
        padding: 40px;
        max-width: 400px;
        width: 90%;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.9);
    `;

    modal.innerHTML = `
        <h2 style="color: white; margin: 0 0 20px 0; font-size: 28px; font-weight: bold; text-align: center;">Welcome to MiniGames</h2>
        <p style="color: #999; margin: 0 0 30px 0; text-align: center; font-size: 14px;">Please enter your name to get started</p>
        <input 
            type="text" 
            id="playerNameInput" 
            placeholder="Enter your name" 
            style="
                width: 100%;
                padding: 12px;
                border: 1px solid #333;
                background: #0a0a0a;
                color: white;
                border-radius: 6px;
                font-size: 16px;
                margin-bottom: 20px;
                box-sizing: border-box;
            "
        >
        <button 
            id="nameSubmitBtn" 
            style="
                width: 100%;
                padding: 12px;
                background: #0066cc;
                color: white;
                border: none;
                border-radius: 6px;
                font-size: 16px;
                font-weight: bold;
                cursor: pointer;
                transition: background 0.3s;
            "
        >Start Playing</button>
    `;

    overlay.appendChild(modal);
    document.body.appendChild(overlay);

    // Handle submit
    const input = document.getElementById('playerNameInput');
    const button = document.getElementById('nameSubmitBtn');

    function submitName() {
        const name = input.value.trim();
        if (name) {
            sessionStorage.setItem('playerName', name);
            updateNameDisplay(name);
            overlay.remove();
        } else {
            input.focus();
        }
    }

    button.addEventListener('click', submitName);
    input.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            submitName();
        }
    });

    // Focus input on load
    input.focus();
}

function updateNameDisplay(name) {
    // Update or create name display element
    let nameDisplay = document.getElementById('sessionPlayerName');

    if (!nameDisplay) {
        nameDisplay = document.createElement('div');
        nameDisplay.id = 'sessionPlayerName';
        nameDisplay.style.cssText = `
            position: fixed;
            top: 80px;
            right: 20px;
            background: #0066cc;
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
            z-index: 1000;
        `;
        document.body.appendChild(nameDisplay);
    }

    nameDisplay.textContent = `👤 ${name}`;
}

// Allow clearing name for testing/new session
window.clearSessionName = function () {
    sessionStorage.removeItem('playerName');
    const nameDisplay = document.getElementById('sessionPlayerName');
    if (nameDisplay) nameDisplay.remove();
    location.reload();
};
