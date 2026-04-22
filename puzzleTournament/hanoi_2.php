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
    <title>Tournament: Tower of Hanoi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .tower-rod { width: 14px; height: 220px; background-color: #cbd5e1; border-radius: 7px 7px 0 0; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); z-index: 1; }
        .disk { height: 32px; border-radius: 12px; transition: all 0.2s ease-out; cursor: pointer; border: 2px solid rgba(0,0,0,0.15); z-index: 10; }
        .disk.selected { transform: translateY(-25px); box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2), 0 0 20px #fbbf24; border: 3px solid #fbbf24; }
        .tower-base { height: 12px; background-color: #334155; border-radius: 6px; z-index: 5; }
    </style>
</head>
<body class="bg-indigo-50 min-h-screen font-sans p-4">
<div class="p-3">
    <a href="dashboard.php" class="bg-white text-slate-600 px-4 py-2 rounded-lg font-bold shadow-sm border border-slate-200">
        ← Back to Dashboard
    </a>
</div>
    <div class="max-w-4xl mx-auto bg-white rounded-[2rem] shadow-2xl p-6 md:p-10 border-b-8 border-indigo-200">
        <div class="text-center mb-8">
            <h1 class="text-5xl font-black text-indigo-600 mb-2 tracking-tight">Puzzle 9: Tower of Hanoi</h1>
            <p class="text-slate-500 font-bold text-lg">Move the stack to the end in exactly 15 moves to pass!</p>
        </div>

        <div class="flex flex-wrap justify-center gap-6 mb-10 bg-indigo-100/50 p-6 rounded-3xl border-2 border-indigo-100">
            <div class="flex items-center gap-8">
                <div class="bg-white px-6 py-2 rounded-2xl shadow-sm border-2 border-white text-center">
                    <span class="text-slate-400 font-bold text-xs uppercase block">Moves</span>
                    <span id="moveCount" class="text-indigo-600 text-3xl font-black">0</span>
                    <span class="text-slate-400 font-bold text-xs uppercase block">/ 15 Max</span>
                </div>
                <button onclick="resetGame()" class="bg-rose-500 hover:bg-rose-600 text-white px-8 py-4 rounded-2xl font-black uppercase tracking-wider transition-all hover:scale-105 active:scale-95 shadow-lg shadow-rose-200">
                    Restart
                </button>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-6 h-[320px] mb-6 relative px-4">
            <div id="tower0" class="tower h-full relative flex flex-col-reverse items-center cursor-pointer" onclick="handleTowerClick(0)">
                <div class="tower-rod"></div><div class="tower-base w-full absolute bottom-0"></div>
            </div>
            <div id="tower1" class="tower h-full relative flex flex-col-reverse items-center cursor-pointer" onclick="handleTowerClick(1)">
                <div class="tower-rod"></div><div class="tower-base w-full absolute bottom-0"></div>
            </div>
            <div id="tower2" class="tower h-full relative flex flex-col-reverse items-center cursor-pointer" onclick="handleTowerClick(2)">
                <div class="tower-rod"></div><div class="tower-base w-full absolute bottom-0"></div>
            </div>
        </div>
    </div>

    <div id="winModal" class="fixed inset-0 bg-indigo-900/80 backdrop-blur-sm hidden flex items-center justify-center p-4 z-[100]">
        <div class="bg-white rounded-[3rem] p-10 max-w-sm w-full text-center shadow-2xl border-[12px] border-green-400">
            <div class="text-6xl mb-4">🏆</div>
            <h2 class="text-4xl font-black text-slate-800 mb-2">PERFECT!</h2>
            <p class="text-slate-500 mb-8 font-bold leading-tight">You solved it in exactly 15 moves. You have finished the contest!</p>
            
            <form action="dashboard.php" method="POST">
                <input type="hidden" name="puzzle_solved" value="9">
                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-black py-5 rounded-2xl transition-all shadow-xl shadow-green-200 uppercase tracking-widest">
                    You have finished the journey!
                </button>
            </form>
        </div>
    </div>

    <script>
        let towers = [[], [], []];
        let selectedTower = null;
        let moveCount = 0;
        const DISK_COUNT = 4; 
        const MIN_MOVES = 15;
        const colors = ['#f43f5e', '#3b82f6', '#10b981'];

        function resetGame() {
            towers = [[], [], []];
            moveCount = 0;
            selectedTower = null;
            document.getElementById('moveCount').textContent = "0";
            document.getElementById('moveCount').classList.remove('text-rose-500');

            for (let i = DISK_COUNT; i > 0; i--) {
                towers[0].push(i);
            }
            render();
        }

        function render() {
            towers.forEach((disks, towerIdx) => {
                const towerElement = document.getElementById(`tower${towerIdx}`);
                const existingDisks = towerElement.querySelectorAll('.disk');
                existingDisks.forEach(d => d.remove());

                disks.forEach((diskSize, index) => {
                    const diskDiv = document.createElement('div');
                    diskDiv.className = `disk mb-1`;
                    const widthPercent = 35 + (diskSize * 15); // Adjusted width for 3 disks
                    diskDiv.style.width = `${widthPercent}%`;
                    diskDiv.style.backgroundColor = colors[diskSize - 1];
                    
                    if (selectedTower === towerIdx && index === disks.length - 1) {
                        diskDiv.classList.add('selected');
                    }
                    towerElement.appendChild(diskDiv);
                });
            });
        }

        function handleTowerClick(towerIdx) {
            if (selectedTower === null) {
                if (towers[towerIdx].length > 0) {
                    selectedTower = towerIdx;
                }
            } else {
                if (selectedTower === towerIdx) {
                    selectedTower = null; 
                } else {
                    const movingDisk = towers[selectedTower][towers[selectedTower].length - 1];
                    const targetTowerTop = towers[towerIdx][towers[towerIdx].length - 1];

                    if (!targetTowerTop || movingDisk < targetTowerTop) {
                        towers[towerIdx].push(towers[selectedTower].pop());
                        moveCount++;
                        document.getElementById('moveCount').textContent = moveCount;
                        selectedTower = null;
                        checkWin();
                    } else {
                        // Error visual
                        const rod = document.getElementById(`tower${towerIdx}`).querySelector('.tower-rod');
                        rod.style.backgroundColor = '#f87171'; 
                        setTimeout(() => rod.style.backgroundColor = '#cbd5e1', 400);
                        selectedTower = null;
                    }
                }
            }
            render();
        }

        function checkWin() {
            if (towers[2].length === DISK_COUNT) {
                setTimeout(() => {
                    if (moveCount === MIN_MOVES) {
                        // Perfect win!
                        document.getElementById('winModal').classList.remove('hidden');
                    } else {
                        // Solved, but too many moves
                        alert("You moved all the disks, but it took you " + moveCount + " moves! You MUST complete it in exactly 15 moves. Try again!");
                        resetGame();
                    }
                }, 300);
            } else if (moveCount >= MIN_MOVES && towers[2].length !== DISK_COUNT) {
                // Change counter to red to warn them they've hit the limit without solving it
                document.getElementById('moveCount').classList.add('text-rose-500');
            }
        }

        resetGame();
    </script>
</body>
</html>