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
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tournament: 4 Colour Map</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        canvas {
            border: 4px solid #334155;
            border-radius: 12px;
            cursor: pointer;
            background-color: #f8fafc;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            max-width: 100%;
            height: auto;
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
            <h1 class="text-5xl font-black text-indigo-600 mb-2 tracking-tight">Puzzle 3: The 4-Colour Map</h1>
            <p class="text-slate-500 font-bold text-lg max-w-2xl mx-auto">
                Click the regions below to cycle through 4 different colours.<br>
                <span class="text-rose-500 font-black uppercase tracking-wide text-sm">Rule:</span> No two touching regions can share the same colour!
            </p>
        </header>

        <div class="flex flex-col items-center justify-center space-y-6">
            <div>
                <canvas id="canvas" width="400" height="400"></canvas>
            </div>
            
            <div id="feedback" class="h-8 flex items-center justify-center">
                <span class="text-indigo-600 font-bold text-xl">Fill all regions to win.</span>
            </div>
            
            <button id="resetBtn" class="bg-rose-500 hover:bg-rose-600 text-white px-8 py-3 rounded-xl font-black uppercase tracking-wider transition-all hover:scale-105 active:scale-95 shadow-lg shadow-rose-200">
                Restart Map
            </button>
        </div>
    </div>

    <div id="winModal" class="fixed inset-0 bg-indigo-900/80 backdrop-blur-sm hidden flex items-center justify-center p-4 z-[100]">
        <div class="bg-white rounded-[3rem] p-10 max-w-sm w-full text-center shadow-2xl border-[12px] border-green-400">
            <div class="text-6xl mb-4">🏆</div>
            <h2 class="text-4xl font-black text-slate-800 mb-2">MASTERFUL!</h2>
            <p class="text-slate-500 mb-8 font-bold leading-tight">You solved the map without any conflicts. Puzzle 4 is unlocked!</p>
            
            <form action="dashboard.php" method="POST">
                <input type="hidden" name="puzzle_solved" value="3">
                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-black py-5 rounded-2xl transition-all shadow-xl shadow-green-200 uppercase tracking-widest">
                    Continue to Map
                </button>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        // The 4 colours (plus the default uncoloured white state)
        const colors = ['white', '#f43f5e', '#10b981', '#3b82f6', '#f59e0b']; // Slate, Rose, Emerald, Blue, Amber
        
        let regions = [];

        function initRegions() {
            // This map features a K4 graph core.
            // This mathematically GUARANTEES that exactly 4 colours are required to solve it.
            regions = [
                // Inner Core (K4 Graph)
                { id: 0, path: new Path2D('M 200 140 L 140 220 L 260 220 Z'), color: 'white', neighbours: [1, 2, 3] },
                { id: 1, path: new Path2D('M 200 140 L 200 50 L 80 260 L 140 220 Z'), color: 'white', neighbours: [0, 2, 3, 4] },
                { id: 2, path: new Path2D('M 200 140 L 260 220 L 320 260 L 200 50 Z'), color: 'white', neighbours: [0, 1, 3, 5] },
                { id: 3, path: new Path2D('M 140 220 L 80 260 L 200 310 L 320 260 L 260 220 Z'), color: 'white', neighbours: [0, 1, 2, 6, 7] },
                
                // Outer Shell
                { id: 4, path: new Path2D('M 200 50 L 200 10 L 20 150 L 80 260 Z'), color: 'white', neighbours: [1, 5, 6] },
                { id: 5, path: new Path2D('M 200 50 L 320 260 L 380 150 L 200 10 Z'), color: 'white', neighbours: [2, 4, 7] },
                { id: 6, path: new Path2D('M 80 260 L 20 150 L 100 380 L 200 380 L 200 310 Z'), color: 'white', neighbours: [3, 4, 7] },
                { id: 7, path: new Path2D('M 200 310 L 200 380 L 300 380 L 380 150 L 320 260 Z'), color: 'white', neighbours: [3, 5, 6] }
            ];
        }

        const canvas = document.getElementById('canvas');
        const ctx = canvas.getContext('2d');
        const feedbackDiv = document.getElementById('feedback');

        function drawMap() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.lineWidth = 5;
            ctx.strokeStyle = '#334155'; // Slate-700
            ctx.lineJoin = 'round';

            regions.forEach(r => {
                ctx.fillStyle = r.color;
                ctx.fill(r.path);
                ctx.stroke(r.path);
            });
        }

        function checkWinCondition() {
            let filledCount = 0;
            let conflictCount = 0;

            for (let i = 0; i < regions.length; i++) {
                if (regions[i].color !== 'white') {
                    filledCount++;
                }

                // Check against neighbours for rule violations
                for (let j = 0; j < regions[i].neighbours.length; j++) {
                    let nIdx = regions[i].neighbours[j];
                    if (regions[i].color !== 'white' && regions[i].color === regions[nIdx].color) {
                        conflictCount++;
                    }
                }
            }

            if (conflictCount > 0) {
                feedbackDiv.innerHTML = '<span class="text-rose-500 font-bold text-xl">Careful! Touching regions share a colour.</span>';
            } else if (filledCount < regions.length) {
                feedbackDiv.innerHTML = '<span class="text-indigo-600 font-bold text-xl">Looking good! Keep going...</span>';
            } else {
                // Map is full and has 0 conflicts!
                feedbackDiv.innerHTML = '<span class="text-green-500 font-black text-2xl tracking-wide">⭐ Map Solved! ⭐</span>';
                
                // Disable further clicking
                canvas.style.pointerEvents = 'none'; 
                
                // Trigger the Tournament Victory Modal
                setTimeout(() => {
                    document.getElementById('winModal').classList.remove('hidden');
                }, 400);
            }
        }

        // Handle clicks to cycle colours
        canvas.addEventListener('mousedown', function(event) {
            const rect = canvas.getBoundingClientRect();
            const scaleX = canvas.width / rect.width;
            const scaleY = canvas.height / rect.height;
            
            const x = (event.clientX - rect.left) * scaleX;
            const y = (event.clientY - rect.top) * scaleY;

            for (let i = 0; i < regions.length; i++) {
                if (ctx.isPointInPath(regions[i].path, x, y)) {
                    let currentColorIndex = colors.indexOf(regions[i].color);
                    let nextColorIndex = (currentColorIndex + 1) % colors.length;
                    
                    regions[i].color = colors[nextColorIndex];
                    drawMap();
                    checkWinCondition();
                    break; // Stop checking paths once we found the clicked one
                }
            }
        });

        // Reset Map logic
        document.getElementById('resetBtn').addEventListener('click', function() {
            initRegions();
            drawMap();
            canvas.style.pointerEvents = 'auto';
            feedbackDiv.innerHTML = '<span class="text-indigo-600 font-bold text-xl">Fill all regions to win.</span>';
        });

        // Kickoff
        document.addEventListener('DOMContentLoaded', function() {
            initRegions();
            drawMap();
        });
    </script>
</body>
</html>