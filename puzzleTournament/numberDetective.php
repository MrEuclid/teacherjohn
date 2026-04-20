<?php 
 // Use the dynamic question ID, default to 3 (or whatever number this puzzle is!)
 $question = isset($_POST['question']) ? $_POST['question'] : 4;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Race to Wat Phnom - Number Detective</title>
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
            <span class="text-xl font-bold text-slate-400">Puzzle <?php echo htmlspecialchars($question); ?></span>
        </div>
    </div>

    <div class="w-full max-w-2xl">
        
        <div id="cluesContainer" class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-sm border-2 border-slate-100 h-32 flex items-center justify-center text-slate-400 animate-pulse">
                Generating clues...
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-lg border-b-4 border-indigo-100 text-center">
            <p class="mb-4 text-lg font-medium text-slate-600">What is the mystery number?</p>
            
            <div class="flex justify-center gap-3 max-w-md mx-auto relative mb-4">
                <input type="number" id="guessInput" placeholder="?" 
                    class="w-32 text-center text-3xl font-bold py-3 px-4 rounded-xl border-2 border-slate-200 focus:border-indigo-500 focus:outline-none transition-colors"
                    min="1" max="100">
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

    <script>
        // Dynamically pull the puzzle number from PHP!
        var questionID = '<?php echo $question; ?>';

        // --- Game Logic Engine (Ported from Python) ---
        class NumberLogic {
            constructor() {
                this.min = 1;
                this.max = 100;
                this.primes = this._generatePrimes(this.max);
                this.fibonacci = new Set([1, 2, 3, 5, 8, 13, 21, 34, 55, 89]);
                this.squares = new Set();
                this.cubes = new Set();
                
                for(let i=1; i*i <= this.max; i++) this.squares.add(i*i);
                for(let i=1; i*i*i <= this.max; i++) this.cubes.add(i*i*i);
            }

            _generatePrimes(n) {
                const primes = new Set();
                const sieve = new Array(n + 1).fill(true);
                for (let p = 2; p * p <= n; p++) {
                    if (sieve[p]) {
                        for (let i = p * p; i <= n; i += p) sieve[i] = false;
                    }
                }
                for (let p = 2; p <= n; p++) if (sieve[p]) primes.add(p);
                return primes;
            }

            getFacts(n) {
                const facts = [];
                const digits = n.toString().split('').map(Number);
                const digitSum = digits.reduce((a, b) => a + b, 0);

                // Parity
                if (n % 2 === 0) facts.push("The number is even.");
                else facts.push("The number is odd.");

                // Multiples
                for (let i = 3; i <= 12; i++) {
                    if (n % i === 0) facts.push(`The number is a multiple of ${i}.`);
                }

                // Factors
                let factors = 0;
                for(let i=1; i<=n; i++) if(n%i===0) factors++;
                if(factors > 2 && factors < 10) facts.push(`The number has exactly ${factors} factors.`);

                // Sets
                if (this.primes.has(n)) facts.push("The number is a Prime number.");
                else facts.push("The number is a Composite number.");
                if (this.squares.has(n)) facts.push("The number is a Perfect Square.");
                if (this.cubes.has(n)) facts.push("The number is a Perfect Cube.");
                if (this.fibonacci.has(n)) facts.push("The number is in the Fibonacci sequence.");

                // Digits
                if (n < 10) facts.push("The number has 1 digit.");
                else {
                    facts.push("The number has 2 digits.");
                    if (digits[0] === digits[1]) facts.push("The digits are the same (Palindrome).");
                    if (digits[1] > digits[0]) facts.push("The second digit is larger than the first.");
                    if (digits[0] > digits[1]) facts.push("The first digit is larger than the second.");
                }
                
                facts.push(`The sum of the digits is ${digitSum}.`);

                // Ranges
                if (n < 50) facts.push("The number is less than 50.");
                else facts.push("The number is greater than or equal to 50.");

                return facts;
            }

            // Bruteforce check to see if 'clues' uniquely identify 'target'
            isUnique(clues, target) {
                let matches = 0;
                for (let i = 1; i <= 100; i++) {
                    const factsForI = new Set(this.getFacts(i));
                    const allCluesMatch = clues.every(c => factsForI.has(c));
                    
                    if (allCluesMatch) {
                        matches++;
                        if (matches > 1 || i !== target) return false;
                    }
                }
                return matches === 1;
            }

            generatePuzzle() {
                let attempts = 0;
                while (attempts < 200) {
                    const target = Math.floor(Math.random() * 100) + 1;
                    const possibleFacts = this.getFacts(target);
                    
                    if (possibleFacts.length < 4) continue;

                    // Try to find a unique combo for this number
                    for (let k = 0; k < 20; k++) {
                        const shuffled = possibleFacts.sort(() => 0.5 - Math.random());
                        const selected = shuffled.slice(0, 4);
                        if (this.isUnique(selected, target)) {
                            return { target, clues: selected };
                        }
                    }
                    attempts++;
                }
                // Fallback safe puzzle if random generation fails heavily
                return { 
                    target: 10, 
                    clues: ["The number is even.", "The number is a multiple of 5.", "The number is less than 20.", "The number has 2 digits."] 
                };
            }
        }

        // --- UI Controller ---
        const gameEngine = new NumberLogic();
        let currentTarget = 0;
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

        function newGame() {
            const puzzle = gameEngine.generatePuzzle();
            currentTarget = puzzle.target;
            isGameActive = true;

            // Reset UI
            document.getElementById('guessInput').value = '';
            document.getElementById('guessInput').disabled = false;
            document.getElementById('guessInput').focus();
            document.getElementById('submitBtn').classList.remove('hidden');
            document.getElementById('messageArea').innerHTML = '';
            
            // Render Clues
            const container = document.getElementById('cluesContainer');
            container.innerHTML = '';
            
            const colors = ['bg-blue-100 border-blue-200 text-blue-800', 
                            'bg-green-100 border-green-200 text-green-800', 
                            'bg-purple-100 border-purple-200 text-purple-800', 
                            'bg-orange-100 border-orange-200 text-orange-800'];

            puzzle.clues.forEach((clue, index) => {
                const div = document.createElement('div');
                div.className = `${colors[index]} p-6 rounded-xl border-2 shadow-sm flex items-center justify-center text-center font-medium text-lg clue-card-anim`;
                div.style.animationDelay = `${index * 100}ms`;
                div.innerHTML = clue;
                container.appendChild(div);
            });
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
                
                // Visuals
                msgArea.innerHTML = `<span class="text-green-500"><i class="fas fa-check-circle"></i> ⭐ Correct! It was ${currentTarget}. ⭐<br><small class="text-slate-500 font-normal">Redirecting to dashboard...</small></span>`;
                input.disabled = true;
                document.getElementById('submitBtn').classList.add('hidden');
                
                playSound('correct');
                
                // FORCE the browser to send the DYNAMIC win signal after a 2-second delay
                setTimeout(function() {
                    window.location.href = "dashboard.php?win=" + questionID;
                }, 2000);
                
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

        // Handle Enter Key
        document.getElementById('guessInput').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') checkAnswer();
        });

        // Start first game
        newGame();

    </script>
</body>
</html>