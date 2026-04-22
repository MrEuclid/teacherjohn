<?php
// Secure the page - ensure they have registered a team
session_save_path(__DIR__ . '/sessions');
session_start();

if (!isset($_SESSION['team_name'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tournament: Lights On</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        
        .light-btn {
            aspect-ratio: 1;
            border-radius: 12px;
            transition: all 0.2s ease-in-out;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .light-btn:active {
            transform: scale(0.90);
        }

        /* The ON state with a bright neon glow */
        .is-on {
            background-color: #facc15; /* Yellow 400 */
            box-shadow: 0 0 20px rgba(250, 204, 21, 0.6), inset 0 0 10px rgba(255, 255, 255, 0.8);
            border-color: #fef08a;
        }

        /* The OFF state - dark and recessed */
        .is-off {
            background-color: #334155; /* Slate 700 */
            box-shadow: inset 0 4px 6px rgba(0, 0, 0, 0.3);
            border-color: #1e293b;
        }
        .is-off:hover {
            background-color: #475569;
        }
    </style>
</head>
<body class="bg-indigo-50 min-h-screen flex flex-col p-4 md:p-8">

    <div class="w-full max-w-4xl mx-auto mb-4">
        <a href="dashboard.php" class="bg-white text-slate-600 px-4 py-2 rounded-lg font-bold shadow-sm border border-slate-200 inline-block hover:bg-slate-50 transition-colors">
            ← Back to Dashboard
        </a>
    </div>

    <div class="max-w-4xl mx-auto w-full bg-white p-6 md:p-10 rounded-[2rem] shadow-2xl border-b-8 border-indigo-200 text-center">
        <header class="mb-8">
            <h1 class="text-5xl font-black text-indigo-600 mb-2 tracking-tight">Puzzle 4: System Reboot</h1>
            <p class="text-slate-500 font-bold text-lg max-w-2xl mx-auto">
                Restore power to the grid.<br>
                <span class="text-rose-500 font-black uppercase tracking-wide text-sm">Rule:</span> Clicking a tile flips its power AND the power of the tiles directly above, below, left, and right. Turn <span class="text-yellow-500 font-black">ALL LIGHTS ON</span> to win!
            </p>
        </header>

        <div class="flex flex-col items-center justify-center space-y-8">
            
            <div class="bg-indigo-100 px-6 py-2 rounded-xl text-indigo-800 font-bold text-xl shadow-inner">
                Moves: <span id="moveCount" class="text-indigo-600 font-black">0</span>
            </div>

            <div class="bg-slate-900 p-4 rounded-3xl shadow-2xl border-4 border-slate-700 w-full max-w-[350px]">
                <div id="grid-container" class="grid grid-cols-4 gap-3 w-full">
                    </div>
            </div>
            
            <button onclick="initGame()" class="bg-rose-500 hover:bg-rose-600 text-white px-8 py-3 rounded-xl font-black uppercase tracking-wider transition-all hover:scale-105 active:scale-95 shadow-lg shadow-rose-200">
                Restart Puzzle
            </button>
        </div>
    </div>

    <div id="winModal" class="fixed inset-0 bg-indigo-900/80 backdrop-blur-sm hidden flex items-center justify-center p-4 z-[100]">
        <div class="bg-white rounded-[3rem] p-10 max-w-sm w-full text-center shadow-2xl border-[12px] border-green-400">
            <div class="text-6xl mb-4">🏆</div>
            <h2 class="text-4xl font-black text-slate-800 mb-2">FULLY LIT!</h2>
            <p class="text-slate-500 mb-8 font-bold leading-tight">You cracked the sequence. Puzzle 5 is unlocked!</p>
            
            <form action="dashboard.php" method="POST">
                <input type="hidden" name="puzzle_solved" value="4">
                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-black py-5 rounded-2xl transition-all shadow-xl shadow-green-200 uppercase tracking-widest">
                    Continue to Map
                </button>
            </form>
        </div>
    </div>

    <script>
        // Changed grid size to 4x4
        const GRID_SIZE = 4;
        let grid = [];
        let moveCount = 0;
        let gameActive = true;

        // Directions: [Self, Up, Down, Left, Right]
        const directions = [ [0,0], [-1,0], [1,0], [0,-1], [0,1] ];

        function buildGridUI() {
            const container = document.getElementById('grid-container');
            container.innerHTML = '';
            
            for (let r = 0; r < GRID_SIZE; r++) {
                for (let c = 0; c < GRID_SIZE; c++) {
                    const btn = document.createElement('div');
                    btn.id = `cell-${r}-${c}`;
                    btn.className = 'light-btn is-off';
                    btn.onclick = () => handlePlayerClick(r, c);
                    container.appendChild(btn);
                }
            }
        }

        function initGame() {
            gameActive = true;
            moveCount = 0;
            document.getElementById('moveCount').textContent = moveCount;
            
            // Start the grid completely OFF (0 = OFF, 1 = ON)
            grid = Array.from({length: GRID_SIZE}, () => Array(GRID_SIZE).fill(0));
            
            updateVisuals();
        }

        function handlePlayerClick(r, c) {
            if (!gameActive) return;
            
            toggleLights(r, c);
            
            moveCount++;
            document.getElementById('moveCount').textContent = moveCount;
            updateVisuals();
            
            if (checkWin()) {
                gameActive = false;
                setTimeout(() => {
                    document.getElementById('winModal').classList.remove('hidden');
                }, 400);
            }
        }

        function toggleLights(row, col) {
            directions.forEach(dir => {
                let newRow = row + dir[0];
                let newCol = col + dir[1];
                
                // If it is inside the bounds of the grid
                if (newRow >= 0 && newRow < GRID_SIZE && newCol >= 0 && newCol < GRID_SIZE) {
                    grid[newRow][newCol] = grid[newRow][newCol] === 1 ? 0 : 1;
                }
            });
        }

        function updateVisuals() {
            for (let r = 0; r < GRID_SIZE; r++) {
                for (let c = 0; c < GRID_SIZE; c++) {
                    const el = document.getElementById(`cell-${r}-${c}`);
                    if (grid[r][c] === 1) {
                        el.classList.add('is-on');
                        el.classList.remove('is-off');
                    } else {
                        el.classList.add('is-off');
                        el.classList.remove('is-on');
                    }
                }
            }
        }

        function checkWin() {
            // Checks if EVERY single cell in the grid equals 1 (ON)
            for (let r = 0; r < GRID_SIZE; r++) {
                for (let c = 0; c < GRID_SIZE; c++) {
                    if (grid[r][c] === 0) return false;
                }
            }
            return true;
        }

        // Boot the game when the page loads
        document.addEventListener('DOMContentLoaded', () => {
            buildGridUI();
            initGame();
        });
    </script>
</body>
</html>