<?php
// Secure the page - ensure they have registered a team
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
    <title>Tournament: Power Surge</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        
        /* 7-Segment Display Container */
        .display-container {
            position: relative;
            width: 180px;
            height: 270px;
            margin: 0 auto;
            background-color: #0f172a; /* Slate 900 */
            border-radius: 16px;
            padding: 20px;
            box-shadow: inset 0 0 20px rgba(0,0,0,0.8), 0 10px 25px rgba(0,0,0,0.2);
            border: 4px solid #334155;
        }

        /* Segment Shapes using Hexagonal CSS Polygons */
        .seg-h { 
            height: 24px; width: 100px; position: absolute; cursor: pointer; transition: all 0.2s; 
            clip-path: polygon(12px 0, 88px 0, 100px 12px, 88px 24px, 12px 24px, 0 12px); 
        }
        .seg-v { 
            width: 24px; height: 100px; position: absolute; cursor: pointer; transition: all 0.2s; 
            clip-path: polygon(12px 0, 24px 12px, 24px 88px, 12px 100px, 0 88px, 0 12px); 
        }

        /* Precise Segment Positioning */
        #btn0 { top: 20px; left: 40px; } /* Top */
        #btn1 { top: 46px; left: 142px; } /* Top Right */
        #btn2 { top: 150px; left: 142px; } /* Bottom Right */
        #btn3 { top: 252px; left: 40px; } /* Bottom */
        #btn4 { top: 150px; left: 14px; } /* Bottom Left */
        #btn5 { top: 46px; left: 14px; } /* Top Left */
        #btn6 { top: 136px; left: 40px; } /* Middle */
        
        /* On/Off States */
        .on { 
            background-color: #22c55e; /* Bright Green */
            box-shadow: 0 0 15px #22c55e, inset 0 0 5px rgba(255,255,255,0.5); 
            z-index: 10;
        }
        .on:hover { background-color: #4ade80; }
        
        .off { 
            background-color: #1e293b; /* Dimmed Slate */
            opacity: 0.5;
        }
        .off:hover { opacity: 0.8; background-color: #334155; }
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
            <h1 class="text-5xl font-black text-indigo-600 mb-2 tracking-tight">Puzzle 6: Power Surge</h1>
            <p class="text-slate-500 font-bold text-lg max-w-2xl mx-auto">
                Restore full power to the LED panel.<br>
                <span class="text-rose-500 font-black uppercase tracking-wide text-sm">Rule:</span> Clicking a segment toggles its power, but it also toggles its connected neighbors! Turn ALL segments GREEN to win.
            </p>
        </header>

        <div class="flex flex-col items-center justify-center space-y-8">
            
            <div class="bg-indigo-100 px-6 py-2 rounded-xl text-indigo-800 font-bold text-xl shadow-inner">
                Moves: <span id="moveCount" class="text-indigo-600 font-black">0</span>
            </div>

            <div class="display-container" id="hardware">
                <div id="btn0" class="seg-h off" onclick="handleSegmentClick(0)"></div>
                <div id="btn1" class="seg-v off" onclick="handleSegmentClick(1)"></div>
                <div id="btn2" class="seg-v off" onclick="handleSegmentClick(2)"></div>
                <div id="btn3" class="seg-h off" onclick="handleSegmentClick(3)"></div>
                <div id="btn4" class="seg-v off" onclick="handleSegmentClick(4)"></div>
                <div id="btn5" class="seg-v off" onclick="handleSegmentClick(5)"></div>
                <div id="btn6" class="seg-h off" onclick="handleSegmentClick(6)"></div>
            </div>
            
            <button onclick="initGame()" class="bg-rose-500 hover:bg-rose-600 text-white px-8 py-3 rounded-xl font-black uppercase tracking-wider transition-all hover:scale-105 active:scale-95 shadow-lg shadow-rose-200">
                Scramble / Restart
            </button>
        </div>
    </div>

    <div id="winModal" class="fixed inset-0 bg-indigo-900/80 backdrop-blur-sm hidden flex items-center justify-center p-4 z-[100]">
        <div class="bg-white rounded-[3rem] p-10 max-w-sm w-full text-center shadow-2xl border-[12px] border-green-400">
            <div class="text-6xl mb-4">🏆</div>
            <h2 class="text-4xl font-black text-slate-800 mb-2">POWER ON!</h2>
            <p class="text-slate-500 mb-8 font-bold leading-tight">You successfully restored the circuit. Puzzle 7 is unlocked!</p>
            
            <form action="dashboard.php" method="POST">
                <input type="hidden" name="puzzle_solved" value="6">
                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-black py-5 rounded-2xl transition-all shadow-xl shadow-green-200 uppercase tracking-widest">
                    Continue to Map
                </button>
            </form>
        </div>
    </div>

    <script>
        // The hardware connections (matches original logic, minus the decimal point)
        const connections = [
            [1, 5, 6],          // 0 (Top)
            [0, 2, 6],          // 1 (Top Right)
            [1, 3, 6],          // 2 (Bottom Right)
            [2, 4, 6],          // 3 (Bottom)
            [3, 5, 6],          // 4 (Bottom Left)
            [0, 4, 6],          // 5 (Top Left)
            [0, 1, 2, 3, 4, 5]  // 6 (Middle)
        ];

        let states = Array(7).fill(1); // 1 = ON, 0 = OFF
        let moveCount = 0;
        let gameActive = true;

        function initGame() {
            gameActive = true;
            moveCount = 0;
            document.getElementById('moveCount').textContent = moveCount;
            
            // Step 1: Start with all lights ON (the win condition)
            states = Array(7).fill(1);
            
            // Step 2: Simulate 4 random clicks to scramble it (Level 2 logic)
            let scrambleClicks = 0;
            while(scrambleClicks < 4) {
                 let r = Math.floor(Math.random() * 7);
                 toggleSegment(r, false); // false = don't count as a user move
                 scrambleClicks++;
            }
            
            // Step 3: Safety check - if the 4 random clicks accidentally solved it, scramble again!
            if (checkWinCondition()) {
                 initGame(); 
                 return;
            }
            
            renderVisuals();
        }

        function handleSegmentClick(index) {
            if (!gameActive) return;
            toggleSegment(index, true); // true = this is a user move
        }

        function toggleSegment(index, isUserMove) {
            // Toggle the clicked segment
            states[index] = states[index] === 1 ? 0 : 1;
            
            // Toggle all connected neighbors
            connections[index].forEach(neighbor => {
                states[neighbor] = states[neighbor] === 1 ? 0 : 1;
            });
            
            if (isUserMove) {
                moveCount++;
                document.getElementById('moveCount').textContent = moveCount;
                renderVisuals();
                
                // Check if they won!
                if (checkWinCondition()) {
                    gameActive = false;
                    setTimeout(() => {
                        document.getElementById('winModal').classList.remove('hidden');
                    }, 400);
                }
            }
        }

        function checkWinCondition() {
            // The user wins when every state in the array is 1 (ON)
            return states.every(s => s === 1);
        }

        function renderVisuals() {
            for (let i = 0; i < 7; i++) {
                const el = document.getElementById(`btn${i}`);
                if (states[i] === 1) {
                    el.classList.remove('off');
                    el.classList.add('on');
                } else {
                    el.classList.remove('on');
                    el.classList.add('off');
                }
            }
        }

        // Boot the game when the page loads
        document.addEventListener('DOMContentLoaded', initGame);
    </script>
</body>
</html>