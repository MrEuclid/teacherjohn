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
    <title>Tournament: Chroma Grid</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        
        .grid-cell {
            aspect-ratio: 1;
            border-radius: 8px;
            transition: all 0.15s ease;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .clickable { cursor: pointer; }
        .clickable:hover { filter: brightness(0.9); transform: scale(0.95); }
        .clickable:active { transform: scale(0.9); }

        /* The locked diagonal cells should look embedded and solid */
        .locked { 
            cursor: not-allowed; 
            border: 3px solid rgba(0,0,0,0.3);
            box-shadow: inset 0 0 10px rgba(0,0,0,0.2);
        }

        /* Color palette mapping */
        .c-0 { background-color: #f8fafc; border: 2px dashed #cbd5e1; } /* Empty/White */
        .c-1 { background-color: #ef4444; border: 2px solid transparent; } /* Red */
        .c-2 { background-color: #3b82f6; border: 2px solid transparent; } /* Blue */
        .c-3 { background-color: #eab308; border: 2px solid transparent; } /* Yellow */
        .c-4 { background-color: #22c55e; border: 2px solid transparent; } /* Green */
        .c-5 { background-color: #a855f7; border: 2px solid transparent; } /* Purple */

        /* Highlight animation for errors */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        .error-shake { animation: shake 0.3s ease-in-out; }
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
            <h1 class="text-5xl font-black text-indigo-600 mb-2 tracking-tight">Puzzle 8: Chroma Grid</h1>
            <p class="text-slate-500 font-bold text-lg max-w-2xl mx-auto">
                Click the empty squares to cycle through the 5 colors.<br>
                <span class="text-rose-500 font-black uppercase tracking-wide text-sm">Rule:</span> Every row, column, AND the two main diagonals must contain one of every color!
            </p>
            <div class="mt-4 inline-block bg-emerald-100 text-emerald-800 font-bold px-4 py-2 rounded-lg shadow-sm border border-emerald-200">
                💡 Tip: The diagonals have been locked in for you to help you start!
            </div>
        </header>

        <div class="flex flex-col items-center justify-center space-y-6">
            
            <div id="feedback" class="h-8 font-bold text-xl text-indigo-600">
                Fill the board to check your answer!
            </div>

            <div class="bg-slate-800 p-3 rounded-2xl shadow-xl w-full max-w-[400px]">
                <div id="grid" class="grid grid-cols-5 gap-2 w-full">
                    </div>
            </div>
            
            <button onclick="resetBoard()" class="bg-rose-500 hover:bg-rose-600 text-white px-8 py-3 rounded-xl font-black uppercase tracking-wider transition-all hover:scale-105 active:scale-95 shadow-lg shadow-rose-200 mt-4">
                Clear Board
            </button>
        </div>
    </div>

    <div id="winModal" class="fixed inset-0 bg-indigo-900/80 backdrop-blur-sm hidden flex items-center justify-center p-4 z-[100]">
        <div class="bg-white rounded-[3rem] p-10 max-w-sm w-full text-center shadow-2xl border-[12px] border-green-400">
            <div class="text-6xl mb-4">🏆</div>
            <h2 class="text-4xl font-black text-slate-800 mb-2">SPECTRUM CLEAR!</h2>
            <p class="text-slate-500 mb-8 font-bold leading-tight">A flawless logic grid. Puzzle 8 is unlocked!</p>
            
            <form action="dashboard.php" method="POST">
                <input type="hidden" name="puzzle_solved" value="8">
                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-black py-5 rounded-2xl transition-all shadow-xl shadow-green-200 uppercase tracking-widest">
                    Continue to Map
                </button>
            </form>
        </div>
    </div>

    <script>
        // Mathematically validated Diagonal Latin Square solution
        // 1=Red, 2=Blue, 3=Yellow, 4=Green, 5=Purple
        const SOLUTION = [
            1, 2, 3, 4, 5,
            4, 5, 1, 2, 3,
            2, 3, 4, 5, 1,
            5, 1, 2, 3, 4,
            3, 4, 5, 1, 2
        ];

        // Indices of the two main diagonals (0 to 24)
        const LOCKED_INDICES = [0, 4, 6, 8, 12, 16, 18, 20, 24];
        
        let gridState = new Array(25).fill(0);
        let gameActive = true;

        function initGrid() {
            const gridEl = document.getElementById('grid');
            gridEl.innerHTML = '';
            
            for (let i = 0; i < 25; i++) {
                const cell = document.createElement('div');
                cell.id = `cell-${i}`;
                
                // If it's a diagonal square, lock it to the solution color
                if (LOCKED_INDICES.includes(i)) {
                    gridState[i] = SOLUTION[i];
                    cell.className = `grid-cell c-${SOLUTION[i]} locked`;
                } else {
                    gridState[i] = 0; // Empty
                    cell.className = `grid-cell c-0 clickable`;
                    cell.onclick = () => handleCellClick(i);
                }
                
                gridEl.appendChild(cell);
            }
        }

        function handleCellClick(index) {
            if (!gameActive || LOCKED_INDICES.includes(index)) return;

            // Cycle the color: 0 -> 1 -> 2 -> 3 -> 4 -> 5 -> 0
            gridState[index] = (gridState[index] + 1) % 6;
            
            // Update visual class
            const cell = document.getElementById(`cell-${index}`);
            cell.className = `grid-cell c-${gridState[index]} clickable`;
            
            document.getElementById('feedback').textContent = "Keep going...";
            document.getElementById('feedback').className = "h-8 font-bold text-xl text-indigo-600";

            checkBoard();
        }

        function resetBoard() {
            if (!gameActive) return;
            initGrid();
            document.getElementById('feedback').textContent = "Board cleared. Try again!";
            document.getElementById('feedback').className = "h-8 font-bold text-xl text-slate-500";
        }

        function checkBoard() {
            // Wait until board is full before validating
            if (gridState.includes(0)) return; 

            if (validateLogic()) {
                // Win!
                gameActive = false;
                document.getElementById('feedback').textContent = "Checking logic... PERFECT!";
                document.getElementById('feedback').className = "h-8 font-bold text-xl text-green-500";
                
                // Remove clickability
                document.querySelectorAll('.clickable').forEach(el => {
                    el.classList.remove('clickable');
                    el.style.cursor = 'default';
                });

                setTimeout(() => {
                    document.getElementById('winModal').classList.remove('hidden');
                }, 500);
            } else {
                // Error!
                document.getElementById('feedback').textContent = "Oops! There's a conflict in a row, column, or diagonal.";
                document.getElementById('feedback').className = "h-8 font-bold text-xl text-rose-500";
                
                const gridEl = document.getElementById('grid');
                gridEl.classList.remove('error-shake');
                void gridEl.offsetWidth; // Trigger reflow to restart animation
                gridEl.classList.add('error-shake');
            }
        }

        function validateLogic() {
            // Helper function to check if an array has 5 unique colors
            const isUnique = (arr) => new Set(arr).size === 5;

            // 1. Check Rows
            for (let r = 0; r < 5; r++) {
                let rowVals = [];
                for (let c = 0; c < 5; c++) rowVals.push(gridState[r * 5 + c]);
                if (!isUnique(rowVals)) return false;
            }

            // 2. Check Columns
            for (let c = 0; c < 5; c++) {
                let colVals = [];
                for (let r = 0; r < 5; r++) colVals.push(gridState[r * 5 + c]);
                if (!isUnique(colVals)) return false;
            }

            // 3. Check Diagonal 1 (Top-Left to Bottom-Right)
            let d1 = [];
            for (let i = 0; i < 5; i++) d1.push(gridState[i * 5 + i]);
            if (!isUnique(d1)) return false;

            // 4. Check Diagonal 2 (Top-Right to Bottom-Left)
            let d2 = [];
            for (let i = 0; i < 5; i++) d2.push(gridState[i * 5 + (4 - i)]);
            if (!isUnique(d2)) return false;

            // If we made it here, the grid is perfectly solved!
            return true;
        }

        // Boot the grid
        document.addEventListener('DOMContentLoaded', initGrid);
    </script>
</body>
</html>