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
        const colors = ['white', '#f4