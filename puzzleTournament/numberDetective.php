<?php
// Secure the page - ensure they have registered a team
session_save_path(__DIR__ . '/sessions');
session_start();

if (!isset($_SESSION['team_name'])) {
    header("Location: index.php");
    exit();
}

// Set this to whatever map node this puzzle corresponds to!
$puzzle_id = 4;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tournament: Number Detective</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;600&display=swap');
        
        body {
            font-family: 'Fredoka', sans-serif;
        }

        .clue-card-anim {
            animation: popIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
            opacity: 0;
            transform: scale(0.8);
        }

        @keyframes popIn {
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .shake {
            animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both;
        }

        @keyframes shake {
            10%, 90% { transform: translate3d(-1px, 0, 0); }
            20%, 80% { transform: translate3d(2px, 0, 0); }
            30%, 50%, 70% { transform: translate3d(-4px, 0, 0); }
            40%, 60% { transform: translate3d(4px, 0, 0); }
        }
    </style>
</head>
<body class="bg-indigo-50 min-h-screen flex flex-col items-center py-8 px-4 text-slate-800">

    <div class="w-full max-w-2xl flex justify-between items-center mb-8 bg-white p-4 rounded-2xl shadow-sm border-b-4 border-indigo-100">
        <div>
            <h1 class="text-2xl font-bold text-indigo-600"><i class="fas fa-search mr-2"></i>Number Detective</h1>
            <p class="text-slate-500 text-sm">Read the clues and find the mystery number!</p>
        </div>
        <div class="flex items-center px-4 py-2">
            <span class="text-xl font-bold text-slate-400">Puzzle <?php echo $puzzle_id; ?></span>
        </div>
    </div>

    <div class="w-full max-w-2xl">
        
        <div id="cluesContainer" class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
            </div>

        <div class="bg-white p-6 rounded-2xl shadow-lg border-b-4 border-indigo-100 text-center">
            <p class="mb-4 text-lg font-medium text-slate-600">What is the mystery number?</p>
            
            <div class="flex justify-center gap-3 max-w-md mx-auto relative mb-4">
                <input type="number" id="guessInput" placeholder="?" 
                    class="w-32 text-center text-3xl font-bold py-3 px-4 rounded-xl border-2 border-slate-200 focus:border-indigo-500 focus:outline-none transition-colors"
                    min="1" max="1000">
            </div>

            <div class="flex justify-center gap-3 max-w-md mx-auto relative">
                <a href="dashboard.php" class="bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold py-3 px-6 rounded-xl transition-transform active:scale-95 border-b-4 border-slate-300 active:border-b-0 active:mt-1">
                    Cancel
                </a>
                <button id="submitBtn" onclick="checkAnswer()" 
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl transition-transform active:scale-95 shadow-md border-b-4 border-indigo-800 active:border-b-0 active:mt-1">
                    Check
                </button>
            </div>

            <div id="messageArea" class="mt-4 min-h-[3rem] font-bold text-lg"></div>

        </div>
    </div>

    <div id="winModal" class="hidden fixed inset-0 bg-slate-900/80 backdrop-blur-sm flex items-center justify-center z-50">
        <div class="bg-white p-8 rounded-3xl shadow-2xl text-center max-w-sm mx-4 transform transition-all">
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-check text-4xl text-green-500"></i>
            </div>
            <h2 class="text-3xl font-black text-slate-800 mb-2">Case Closed!</h2>
            <p class="text-slate-500 font-medium mb-8">You successfully identified the mystery number.</p>
            
            <form method="POST" action="dashboard.php">
                <input type="hidden" name="puzzle_solved" value="<?php echo $puzzle_id; ?>">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 px-8 rounded-xl w-full transition-transform active:scale-95 shadow-lg border-b-4 border-indigo-800 active:border-b-0 active:translate-y-1">
                    Return to Map
                </button>
            </form>
        </div>
    </div>

    <script>
        // ==========================================
        // 🛠️ PUZZLE SETTINGS (Change these for each file!)
        // ==========================================
        
        var currentTarget = 42; 
        
        var clues = [
            "The number is even.",
            "The number is a multiple of 7.",
            "The sum of its digits is 6.",
            "It is less than 50."
        ];

        // ==========================================

        let isGameActive = true;

        // Audio effects
        const playSound = (type) => {
            const ctx = new (window.AudioContext || window.webkitAudioContext)();
            const osc = ctx.createOscillator();
            const gain = ctx.createGain();
            osc.connect(gain);
            gain.connect(ctx.destination);
            
            if (type === 'correct') {
                osc.type = 'sine';
                osc.frequency.setValueAtTime(500, ctx.currentTime);
                osc.frequency.exponentialRampToValueAtTime(1000, ctx.currentTime + 0.1);
                gain.gain.setValueAtTime(0.1, ctx.currentTime);
                gain.gain.exponentialRampToValueAtTime(0.01, ctx.currentTime + 0.3);
                osc.start();
                osc.stop(ctx.currentTime + 0.3);
            } else {
                osc.type = 'sawtooth';
                osc.frequency.setValueAtTime(200, ctx.currentTime);
                osc.frequency.linearRampToValueAtTime(100, ctx.currentTime + 0.2);
                gain.gain.setValueAtTime(0.1, ctx.currentTime);
                gain.gain.linearRampToValueAtTime(0.01, ctx.currentTime + 0.2);
                osc.start();
                osc.stop(ctx.currentTime + 0.2);
            }
        };

        function initGame() {
            const container = document.getElementById('cluesContainer');
            container.innerHTML = '';
            
            const colors = ['bg-blue-100 border-blue-200 text-blue-800', 
                            'bg-green-100 border-green-200 text-green-800', 
                            'bg-purple-100 border-purple-200 text-purple-800', 
                            'bg-orange-100 border-orange-200 text-orange-800',
                            'bg-pink-100 border-pink-200 text-pink-800'];

            clues.forEach((clue, index) => {
                const div = document.createElement('div');
                const colorClass = colors[index % colors.length]; 
                
                div.className = `${colorClass} p-6 rounded-xl border-2 shadow-sm flex items-center justify-center text-center font-medium text-lg clue-card-anim`;
                div.style.animationDelay = `${index * 100}ms`;
                div.innerHTML = clue;
                container.appendChild(div);
            });
            
            document.getElementById('guessInput').focus();
        }

        function checkAnswer() {
            if (!isGameActive) return;

            const input = document.getElementById('guessInput');
            const guess = parseInt(input.value);
            const msgArea = document.getElementById('messageArea');

            if (isNaN(guess)) {
                msgArea.innerHTML = `<span class="text-slate-400">Please enter a number!</span>`;
                return;
            }

            if (guess === currentTarget) {
                // Success!
                isGameActive = false;
                input.disabled = true;
                playSound('correct');
                
                // Show the modal to return to the dashboard
                document.getElementById('winModal').classList.remove('hidden');
                
            } else {
                // Incorrect
                msgArea.innerHTML = `<span class="text-red-500"><i class="fas fa-times-circle"></i> Not ${guess}. Try again!</span>`;
                input.parentElement.classList.add('shake');
                setTimeout(() => input.parentElement.classList.remove('shake'), 500);
                input.value = '';
                input.focus();
                playSound('wrong');
            }
        }

        document.getElementById('guessInput').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') checkAnswer();
        });

        window.onload = initGame;
    </script>
</body>
</html>