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
    <title>Tournament: Mini Sudoku</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        
        /* Specific Sudoku Grid Styling */
        .sudoku-container {
            display: grid;
            grid-template-columns: repeat(4, 70px);
            gap: 2px;
            background-color: #334155; /* Slate 700 */
            border: 6px solid #1e293b; /* Slate 800 */
            border-radius: 12px;
            padding: 4px;
            margin: 0 auto;
            width: max-content;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .sudoku-container input {
            width: 70px;
            height: 70px;
            text-align: center;
            font-size: 32px;
            font-weight: 800;
            border: none;
            outline: none;
            transition: all 0.2s;
            color: #3b82f6; /* Blue for user input */
        }

        /* Thicker borders to separate the 2x2 quadrants */
        .sudoku-container input:nth-child(2n) { border-right: 4px solid #1e293b; }
        .sudoku-container input:nth-child(4n) { border-right: none; }
        .sudoku-container input:nth-child(n+5):nth-child(-n+8) { border-bottom: 4px solid #1e293b; }

        .sudoku-container input:focus {
            background-color: #e0f2fe;
            transform: scale(1.05);
            z-index: 10;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(59, 130, 246, 0.5);
        }

        .sudoku-container input[readonly] {
            background-color: #f1f5f9;
            color: #334155; /* Slate for given numbers */
            cursor: not-allowed;
        }

        /* Feedback animations */
        .correct-cell { background-color: #dcfce7 !important; color: #16a34a !important; }
        .incorrect-cell { background-color: #fee2e2 !important; color: #dc2626 !important; animation: shake 0.3s; }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-4px); }
            75% { transform: translateX(4px); }
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
            <h1 class="text-5xl font-black text-indigo-600 mb-2 tracking-tight">Puzzle 4: Gridlock</h1>
            <p class="text-slate-500 font-bold text-lg max-w-2xl mx-auto">
                Fill the empty squares with numbers 1 to 4.<br>
                <span class="text-rose-500 font-black uppercase tracking-wide text-sm">Rule:</span> Every row, column, and 2x2 box must contain exactly one of each number!
            </p>
        </header>

        <div class="flex flex-col items-center justify-center space-y-8">
            
            <div id="message" class="h-8 flex items-center justify-center text-indigo-600 font-bold text-xl">
                Ready? Start typing!
            </div>

            <div class="sudoku-container" id="sudoku-grid">
                </div>
            
            <button id="restartBtn" class="bg-rose-500 hover:bg-rose-600 text-white px-8 py-3 rounded-xl font-black uppercase tracking-wider transition-all hover:scale-105 active:scale-95 shadow-lg shadow-rose-200">
                Stuck? Generate New Grid
            </button>
        </div>
    </div>

    <div id="winModal" class="fixed inset-0 bg-indigo-900/80 backdrop-blur-sm hidden flex items-center justify-center p-4 z-[100]">
        <div class="bg-white rounded-[3rem] p-10 max-w-sm w-full text-center shadow-2xl border-[12px] border-green-400">
            <div class="text-6xl mb-4">🏆</div>
            <h2 class="text-4xl font-black text-slate-800 mb-2">CRACKED IT!</h2>
            <p class="text-slate-500 mb-8 font-bold leading-tight">Your logic is flawless. Puzzle 5 is unlocked!</p>
            
            <form action="dashboard.php" method="POST">
                <input type="hidden" name="puzzle_solved" value="4">
                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-black py-5 rounded-2xl transition-all shadow-xl shadow-green-200 uppercase tracking-widest">
                    Continue to Map
                </button>
            </form>
        </div>
    </div>

    <script>
        let fullGrid = [];
        let puzzleGrid = [];
        const emptyCellsCount = 8; // Locked to Level 3 difficulty
        const gridSize = 4;

        function initializeGame() {
            generateGrid();
            createDOMGrid();
            document.getElementById('message').textContent = 'Ready? Start typing!';
            document.getElementById('message').className = 'h-8 flex items-center justify-center text-indigo-600 font-bold text-xl';
        }

        function createDOMGrid() {
            const container = document.getElementById('sudoku-grid');
            container.innerHTML = ''; 

            for (let r = 0; r < gridSize; r++) {
                for (let c = 0; c < gridSize; c++) {
                    const input = document.createElement('input');
                    input.type = 'text';
                    input.maxLength = 1;
                    input.dataset.row = r;
                    input.dataset.col = c;

                    if (puzzleGrid[r][c] !== 0) {
                        input.value = puzzleGrid[r][c];
                        input.readOnly = true;
                    } else {
                        input.value = '';
                        input.addEventListener('input', handleInput);
                    }
                    container.appendChild(input);
                }
            }
        }

        function handleInput(e) {
            const input = e.target;
            const val = input.value;
            
            // Only allow 1-4
            if (!/^[1-4]$/.test(val)) {
                input.value = '';
                input.classList.remove('incorrect-cell', 'correct-cell');
                document.getElementById('message').textContent = 'Keep going...';
                return;
            }

            const r = parseInt(input.dataset.row);
            const c = parseInt(input.dataset.col);

            // Immediate validation against the generated solution
            if (parseInt(val) === fullGrid[r][c]) {
                input.classList.remove('incorrect-cell');
                input.classList.add('correct-cell');
                document.getElementById('message').textContent = 'Good move!';
                document.getElementById('message').className = 'h-8 flex items-center justify-center text-green-500 font-bold text-xl';
            } else {
                input.classList.add('incorrect-cell');
                input.classList.remove('correct-cell');
                document.getElementById('message').textContent = 'Oops! That number causes a conflict.';
                document.getElementById('message').className = 'h-8 flex items-center justify-center text-rose-500 font-bold text-xl';
            }

            checkWin();
        }

        function checkWin() {
            const inputs = document.querySelectorAll('#sudoku-grid input');
            let isFull = true;
            let isCorrect = true;

            inputs.forEach(input => {
                if (input.value === '') {
                    isFull = false;
                } else {
                    const r = parseInt(input.dataset.row);
                    const c = parseInt(input.dataset.col);
                    if (parseInt(input.value) !== fullGrid[r][c]) {
                        isCorrect = false;
                    }
                }
            });

            if (isFull && isCorrect) {
                // Lock inputs
                inputs.forEach(input => input.readOnly = true);
                
                // Show victory modal
                setTimeout(() => {
                    document.getElementById('winModal').classList.remove('hidden');
                }, 400);
            }
        }

        // --- Core Sudoku Generation Logic (Unchanged) ---
        function generateGrid() {
            fullGrid = Array.from({ length: 4 }, () => Array(4).fill(0));
            solveGrid(fullGrid);
            puzzleGrid = JSON.parse(JSON.stringify(fullGrid));
            removeCells(puzzleGrid, emptyCellsCount);
        }

        function solveGrid(grid) {
            for (let r = 0; r < 4; r++) {
                for (let c = 0; c < 4; c++) {
                    if (grid[r][c] === 0) {
                        let nums = [1, 2, 3, 4].sort(() => Math.random() - 0.5);
                        for (let num of nums) {
                            if (isSafe(grid, r, c, num)) {
                                grid[r][c] = num;
                                if (solveGrid(grid)) return true;
                                grid[r][c] = 0;
                            }
                        }
                        return false;
                    }
                }
            }
            return true;
        }

        function removeCells(grid, count) {
            let removed = 0;
            let attempts = 0; 
            while (removed < count && attempts < 100) {
                let r = Math.floor(Math.random() * 4);
                let c = Math.floor(Math.random() * 4);
                if (grid[r][c] !== 0) {
                    let backup = grid[r][c];
                    grid[r][c] = 0;
                    
                    let tempGrid = JSON.parse(JSON.stringify(grid));
                    if (countSolutions(tempGrid) !== 1) {
                        grid[r][c] = backup; 
                    } else {
                        removed++;
                    }
                }
                attempts++;
            }
        }

        function countSolutions(grid) {
            let emptySpot = findEmptyCell(grid);
            if (!emptySpot) return 1; 
            let r = emptySpot[0]; let c = emptySpot[1];
            let solutionCount = 0;
            for (let num = 1; num <= 4; num++) {
                if (isSafe(grid, r, c, num)) {
                    grid[r][c] = num;                     
                    solutionCount += countSolutions(grid); 
                    grid[r][c] = 0;                       
                }
            }
            return solutionCount;
        }

        function findEmptyCell(grid) {
            for (let r = 0; r < 4; r++) {
                for (let c = 0; c < 4; c++) { if (grid[r][c] === 0) return [r, c]; }
            }
            return null; 
        }

        function isSafe(grid, row, col, num) {
            for (let i = 0; i < 4; i++) {
                if (grid[row][i] === num) return false;
                if (grid[i][col] === num) return false;
            }
            let startRow = Math.floor(row / 2) * 2;
            let startCol = Math.floor(col / 2) * 2;
            for (let r = startRow; r < startRow + 2; r++) {
                for (let c = startCol; c < startCol + 2; c++) {
                    if (grid[r][c] === num) return false;
                }
            }
            return true;
        }

        // Setup event listener for the restart button
        document.getElementById('restartBtn').addEventListener('click', initializeGame);

        // Start the game on load
        document.addEventListener('DOMContentLoaded', initializeGame);
    </script>
</body>
</html>