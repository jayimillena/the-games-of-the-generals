import Alpine from 'alpinejs';
import '../css/app.css';

window.Alpine = Alpine;
Alpine.start();

const gameConfig = window.gameConfig || {};
const { gameId, userId, playerNum, csrfToken } = gameConfig;

const rows = 8;
const cols = 9;

// Generate local default positions during SETUP mode
function getDefaultPieces(player) {
    const pPrefix = `P${player}`;
    const ranks = [
        '5SG', '4SG', '3SG', '2SG', '1SG', 'Col', 'LC', 'Maj', 'Cap',
        '1Li', '2Li', 'Sgt', 'Prv1', 'Prv2', 'Prv3', 'Prv4', 'Prv5', 'Prv6',
        'Spy1', 'Spy2', 'Flg'
    ];

    let pieces = [];
    let startRow = (player === 1) ? 5 : 0; // Player 1 starts at bottom, Player 2 at top

    let currentX = startRow;
    let currentY = 0;

    ranks.forEach(rank => {
        pieces.push({
            x: currentX,
            y: currentY,
            player: player,
            rank: `${pPrefix}${rank}`
        });

        currentY++;
        if (currentY >= cols) {
            currentY = 0;
            currentX++;
        }
    });

    return pieces;
}

function initializeGrid() {
    const gameBoard = document.getElementById('gameBoard');
    if (!gameBoard) return;

    gameBoard.innerHTML = '';
    for (let i = 0; i < rows; i++) {
        for (let j = 0; j < cols; j++) {
            const cell = document.createElement('div');
            cell.classList.add('cell');
            cell.setAttribute('data-x', i);
            cell.setAttribute('data-y', j);
            gameBoard.appendChild(cell);
        }
    }
}

function renderBoard(boardState) {
    document.querySelectorAll('.cell').forEach(cell => cell.innerHTML = '');

    if (!boardState) return;

    boardState.forEach(piece => {
        const cell = document.querySelector(`[data-x="${piece.x}"][data-y="${piece.y}"]`);
        if (cell) {
            const pieceElement = document.createElement('div');
            pieceElement.classList.add('piece', `player${piece.player}`);
            
            const pieceImg = `/images/pieces/${piece.rank}.png`;
            pieceElement.style.backgroundImage = `url(${pieceImg})`;
            cell.appendChild(pieceElement);
        }
    });
}

document.addEventListener('DOMContentLoaded', () => {
    if (!gameId) return;

    // Build the grid cells instantly on load
    initializeGrid();

    const fetchState = async () => {
        try {
            const response = await fetch(`/game/${gameId}/state`);
            const data = await response.json();

            // If game is in SETUP phase and board is empty, show default placement
            if (!data.board_state || data.board_state.length === 0) {
                renderBoard(getDefaultPieces(playerNum));
            } else {
                renderBoard(data.board_state);
            }

            const statusMsg = document.getElementById('statusMessage');
            if (statusMsg) {
                if (data.status === 'WAITING') {
                    statusMsg.textContent = 'Waiting for Player 2 to join...';
                } else if (data.status === 'SETUP') {
                    statusMsg.textContent = 'Position your forces, then click Deploy!';
                } else if (data.current_turn === userId) {
                    statusMsg.textContent = 'Your Turn! Select a piece to move.';
                } else {
                    statusMsg.textContent = "Opponent's Turn. Waiting...";
                }
            }
        } catch (err) {
            console.error("Board sync failed:", err);
        }
    };

    fetchState();
    setInterval(fetchState, 2000);
});