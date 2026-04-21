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
    <title>Tournament: Pentomino Fit</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        
        /* The Game Board Container - fixed relative box so 50px grid math works flawlessly */
        #game-container { 
            position: relative; 
            width: 100%; 
            max-width: 800px; 
            height: 450px; 
            background: #f8fafc; 
            border-radius: 1rem;
            box-shadow: inset 0 4px 6px rgba(0,0,0,0.05);
            border: 4px solid #cbd5e1;
            margin: 0 auto;
            overflow: hidden;
        }
        
        /* The Target Grid (5x4 = 250px x 200px) */
        #target-grid { 
            position: absolute; 
            top: 50px; 
            left: 50px; 
            width: 250px;
            height: 200px;
            border: 6px solid #10b981; 
            background-color: #f1f5f9;
            background-image: radial-gradient(#94a3b8 2px, transparent 2px);
            background-size: 50px 50px; 
            pointer-events: none;
            border-radius: 8px;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
        }

        /* Pentomino Pieces */
        .pentomino { 
            position: absolute; 
            display: grid; 
            grid-template-columns: repeat(5, 50px); 
            grid-template-rows: repeat(5, 50px); 
            z-index: 5; 
            transition: transform 0.15s ease-out;
        }
        .pentomino.active { 
            z-index: 1000 !important; 
            filter: drop-shadow(8px 8px 12px rgba(0,0,0,0.3)); 
        }
        .pentomino.active .block-visible { 
            border: 3px solid white; 
            box-shadow: 0 0 10px rgba(255,255,255,0.5) inset;
        }

        /* The 50x50 blocks that make up a piece */
        .block { width: 50px; height: 50px; box-sizing: border-box; }
        .block-visible { 
            border: 2px solid rgba(0,0,0,0.15); 
            border-radius: 6px; 
            pointer-events: auto; 
            cursor: grab; 
        }
        .block-visible:active { cursor: grabbing; }
        .block-hidden { visibility: hidden; pointer-events: none; }

        /* Specific Colors for Level 2 Pieces */
        .color-P { background: #ec4899; } /* Pink */
        .color-U { background: #facc15; } /* Yellow */
        .color-Y { background: #3b82f6; } /* Blue */
        .color-L { background: #10b981; } /* Emerald */
    </style>
</head>
<body class="bg-indigo-50 min-h-screen flex flex-col p-4 md:p-8">

    <div class="w-full max-w-4xl mx-auto mb-4">
        <a href="dashboard.php" class="bg-white text-slate-600 px-4 py-2 rounded-lg font-bold shadow-sm border border-slate-200 inline-block hover:bg-slate-50 transition-colors">
            ← Back to Dashboard
        </a>
    </div>

    <div class="max-w-4xl mx-auto w-full bg-white p-6 md:p-10 rounded-[2rem] shadow-2xl border-b-8 border-indigo-200 text-center">
        <header class="mb-6">
            <h1 class="text-5xl font-black text-indigo-600 mb-2 tracking-tight">Puzzle 7: Pentomino Fit</h1>
            <p class="text-slate-500 font-bold text-lg max-w-2xl mx-auto mb-2">
                Fit all 4 shapes perfectly into the green grid.
            </p>
            <div class="flex justify-center gap-4 text-sm font-bold text-indigo-800 bg-indigo-100 p-3 rounded-lg inline-block mx-auto shadow-inner">
                <span>🖱️ Drag to Move</span>
                <span>|</span>
                <span>◀ ▶ Arrows to Rotate</span>
                <span>|</span>
                <span>▲ ▼ Arrows to Flip</span>
            </div>
        </header>

        <div id="game-container">
            <div id="target-grid"></div>
        </div>
        
        <div class="mt-6">
            <button onclick="initGame()" class="bg-rose-500 hover:bg-rose-600 text-white px-8 py-3 rounded-xl font-black uppercase tracking-wider transition-all hover:scale-105 active:scale-95 shadow-lg shadow-rose-200">
                Reset Pieces
            </button>
        </div>
    </div>

    <div id="winModal" class="fixed inset-0 bg-indigo-900/80 backdrop-blur-sm hidden flex items-center justify-center p-4 z-[100]">
        <div class="bg-white rounded-[3rem] p-10 max-w-sm w-full text-center shadow-2xl border-[12px] border-green-400">
            <div class="text-6xl mb-4">🏆</div>
            <h2 class="text-4xl font-black text-slate-800 mb-2">PERFECT FIT!</h2>
            <p class="text-slate-500 mb-8 font-bold leading-tight">You mastered the spatial grid. Puzzle 7 is unlocked!</p>
            
            <form action="dashboard.php" method="POST">
                <input type="hidden" name="puzzle_solved" value="7">
                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-black py-5 rounded-2xl transition-all shadow-xl shadow-green-200 uppercase tracking-widest">
                    Continue to Map
                </button>
            </form>
        </div>
    </div>

    <script>
        // The definitions for the pieces
        const shapes = {
            P:[[1,1,0,0,0],[1,1,0,0,0],[1,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0]],
            L:[[1,0,0,0,0],[1,0,0,0,0],[1,0,0,0,0],[1,1,0,0,0],[0,0,0,0,0]],
            Y:[[0,1,0,0,0],[1,1,0,0,0],[0,1,0,0,0],[0,1,0,0,0],[0,0,0,0,0]],
            U:[[1,0,1,0,0],[1,1,1,0,0],[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0]]
        };

        // Level 2 Parameters: 5x4 Grid, using L, P, Y, U
        const levelConfig = { w: 5, h: 4, p: ['L', 'P', 'Y', 'U'] };
        let activeEl = null;

        // Handle Keyboard Rotation & Flipping
        window.addEventListener('keydown', (e) => {
            if (!activeEl) return;
            // Prevent default scrolling when using arrows
            if (["ArrowUp", "ArrowDown", "ArrowLeft", "ArrowRight"].includes(e.key)) {
                e.preventDefault(); 
            }

            if (e.key === "ArrowLeft") activeEl.dataset.r = (parseInt(activeEl.dataset.r) - 90) % 360;
            else if (e.key === "ArrowRight") activeEl.dataset.r = (parseInt(activeEl.dataset.r) + 90) % 360;
            else if (e.key === "ArrowUp" || e.key === "ArrowDown") activeEl.dataset.f *= -1;
            
            updateTransform(activeEl);
            checkWin(); 
        });

        function initGame() {
            const container = document.getElementById('game-container');
            document.querySelectorAll('.pentomino').forEach(p => p.remove());
            activeEl = null;
            
            // Set up pieces on the right side of the container
            let startX = 350; 
            let startY = 20;
            
            levelConfig.p.forEach(type => {
                createPiece(type, startX, startY);
                startX += 150; 
                if (startX > 600) { 
                    startX = 400; 
                    startY += 180; 
                }
            });
        }

        function createPiece(type, x, y) {
            const div = document.createElement('div');
            div.className = 'pentomino';
            div.style.left = x + 'px'; 
            div.style.top = y + 'px';
            div.dataset.r = 0; 
            div.dataset.f = 1;
            div.dataset.type = type;

            shapes[type].forEach(row => {
                row.forEach(cell => {
                    const b = document.createElement('div');
                    b.className = cell ? `block block-visible color-${type}` : 'block block-hidden';
                    div.appendChild(b);
                });
            });

            // Drag Logic
            div.onmousedown = (e) => {
                if (e.button !== 0) return; // Only left click
                
                if (activeEl) activeEl.classList.remove('active');
                activeEl = div; 
                activeEl.classList.add('active');
                
                // Get offset from piece corner to mouse pointer
                let sX = e.clientX - activeEl.offsetLeft;
                let sY = e.clientY - activeEl.offsetTop;
                
                const move = (mE) => { 
                    activeEl.style.left = (mE.clientX - sX) + 'px'; 
                    activeEl.style.top = (mE.clientY - sY) + 'px'; 
                };
                
                const up = () => {
                    let cL = parseInt(activeEl.style.left);
                    let cT = parseInt(activeEl.style.top);
                    
                    // Snap loosely to a 25px grid so it's easier to align
                    activeEl.style.left = (Math.round(cL / 25) * 25) + 'px';
                    activeEl.style.top = (Math.round(cT / 25) * 25) + 'px';
                    
                    window.removeEventListener('mousemove', move); 
                    window.removeEventListener('mouseup', up);
                    checkWin();
                };
                
                window.addEventListener('mousemove', move); 
                window.addEventListener('mouseup', up);
            };
            
            document.getElementById('game-container').appendChild(div);
        }

        function updateTransform(el) { 
            el.style.transform = `rotate(${el.dataset.r}deg) scaleX(${el.dataset.f})`; 
        }

        function checkWin() {
            const pieces = document.querySelectorAll('.pentomino');
            const gridRect = document.getElementById('target-grid').getBoundingClientRect();
            const occupied = new Set();

            pieces.forEach(p => {
                const blocks = p.querySelectorAll('.block-visible');
                blocks.forEach(b => {
                    const bRect = b.getBoundingClientRect();
                    
                    // Find the exact center point of the 50x50 block
                    const centerX = bRect.left + 25;
                    const centerY = bRect.top + 25;
                    
                    // Calculate position relative to the target grid
                    const relX = centerX - gridRect.left;
                    const relY = centerY - gridRect.top;
                    
                    // Determine which 50x50 grid cell this falls into
                    const gridX = Math.floor(relX / 50);
                    const gridY = Math.floor(relY / 50);

                    // If the center of the block is inside a valid grid cell, mark it occupied
                    if (gridX >= 0 && gridX < levelConfig.w && gridY >= 0 && gridY < levelConfig.h) {
                        occupied.add(`${gridX},${gridY}`);
                    }
                });
            });

            // 4 pieces * 5 blocks each = 20 unique squares required to win
            if (occupied.size === (levelConfig.p.length * 5)) {
                // Disable further dragging
                pieces.forEach(p => p.style.pointerEvents = 'none');
                
                setTimeout(() => {
                    document.getElementById('winModal').classList.remove('hidden');
                }, 400);
            }
        }

        // Boot the game
        document.addEventListener('DOMContentLoaded', initGame);
    </script>
</body>
</html>