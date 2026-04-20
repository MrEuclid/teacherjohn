<?php
session_start();

// Ensure the participant is registered/logged in via the dashboard session
// Uncomment the redirect in your live environment
if (!isset($_SESSION['team_name']) && !isset($_SESSION['user_id'])) {
    // header("Location: index.php");
    // exit();
}

$team_identifier = isset($_SESSION['team_name']) ? $_SESSION['team_name'] : 'Guest Team';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Number Detective</title>
    <style>
        :root {
            --primary: #2C3E50;
            --accent: #3498DB;
            --bg: #ECF0F1;
            --text: #333;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg);
            color: var(--text);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            max-width: 500px;
            width: 100%;
        }
        h2 {
            color: var(--primary);
            text-align: center;
            margin-top: 0;
        }
        .clue-box {
            background: #F8F9F9;
            border-left: 4px solid var(--accent);
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        ul {
            list-style-type: square;
            padding-left: 20px;
            margin: 0;
        }
        li {
            margin-bottom: 10px;
            font-size: 1.1em;
            line-height: 1.4;
        }
        .input-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        input[type="number"] {
            flex: 1;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1.1em;
        }
        button {
            background-color: var(--accent);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.1em;
            transition: background 0.3s;
        }
        button:hover {
            background-color: #2980B9;
        }
        #feedback {
            text-align: center;
            margin-top: 15px;
            font-weight: bold;
            height: 20px;
            color: #E74C3C;
        }

        /* Modal Styles matching the tournament layout */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.6);
            backdrop-filter: blur(3px);
        }
        .modal-content {
            background-color: white;
            margin: 15% auto;
            padding: 30px;
            border-radius: 8px;
            width: 80%;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        }
        .modal-content h3 {
            color: #27AE60;
            margin-top: 0;
        }
        .modal-content button {
            background-color: #27AE60;
            margin-top: 15px;
            width: 100%;
        }
        .modal-content button:hover {
            background-color: #219653;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Number Detective</h2>
        <p>Analyze the properties below to deduce the dynamically generated mystery number.</p>
        
        <div class="clue-box">
            <ul id="clue-list">
                </ul>
        </div>

        <div class="input-group">
            <input type="number" id="player-guess" placeholder="Enter your deduction..." onkeypress="handleEnter(event)">
            <button onclick="checkGuess()">Verify</button>
        </div>
        <div id="feedback"></div>
    </div>

    <div id="winModal" class="modal">
        <div class="modal-content">
            <h3>Well done, solved!</h3>
            <p>You have successfully deduced the mystery number. The puzzle lock has been cleared.</p>
            
            <form id="victoryForm" action="dashboard.php" method="POST">
                <input type="hidden" name="puzzle_id" value="number_detective">
                <input type="hidden" name="team_id" value="<?php echo htmlspecialchars($team_identifier); ?>">
                <input type="hidden" name="status" value="completed">
                <button type="submit">Return to Map</button>
            </form>
        </div>
    </div>

    <script>
        // --- Dynamic Game Engine ---
        let targetNumber = 0;

        function initGame() {
            // Generate a challenging number between 20 and 200
            targetNumber = Math.floor(Math.random() * 181) + 20;
            const clues = generateClues(targetNumber);
            
            const clueList = document.getElementById('clue-list');
            clues.forEach(clue => {
                const li = document.createElement('li');
                li.textContent = clue;
                clueList.appendChild(li);
            });
        }

        function isPrime(num) {
            for(let i = 2, s = Math.sqrt(num); i <= s; i++) {
                if(num % i === 0) return false;
            }
            return num > 1;
        }

        function getFactors(num) {
            let factors = [];
            for (let i = 2; i <= num / 2; i++) {
                if (num % i === 0) factors.push(i);
            }
            return factors;
        }

        function generateClues(num) {
            let clues = [];
            
            // 1. Parity
            clues.push(`The number is ${num % 2 === 0 ? 'even' : 'odd'}.`);
            
            // 2. Sum of digits
            const sumDigits = num.toString().split('').reduce((a, b) => parseInt(a) + parseInt(b), 0);
            clues.push(`The sum of its digits equals ${sumDigits}.`);
            
            // 3. Prime or Multiple
            if (isPrime(num)) {
                clues.push(`It is a prime number.`);
            } else {
                const factors = getFactors(num);
                // Pick a random factor to use as a clue
                const randomFactor = factors[Math.floor(Math.random() * factors.length)];
                clues.push(`It is a multiple of ${randomFactor}.`);
            }

            // 4. Bounding Range (Narrowed down for a fair challenge)
            const lowerBound = num - Math.floor(Math.random() * 8) - 1;
            const upperBound = num + Math.floor(Math.random() * 12) + 1;
            clues.push(`It is strictly between ${lowerBound} and ${upperBound}.`);

            // Shuffle clues so they don't always appear in the same order
            return clues.sort(() => Math.random() - 0.5);
        }

        // --- Interaction & Tournament Logic ---
        function checkGuess() {
            const guessInput = document.getElementById('player-guess');
            const feedback = document.getElementById('feedback');
            const guess = parseInt(guessInput.value);

            if (isNaN(guess)) {
                feedback.textContent = "Please enter a valid number.";
                return;
            }

            if (guess === targetNumber) {
                feedback.style.color = "#27AE60";
                feedback.textContent = "Correct!";
                showWinModal();
            } else {
                feedback.style.color = "#E74C3C";
                feedback.textContent = "Incorrect deduction. Try again.";
                guessInput.value = '';
                guessInput.focus();
            }
        }

        function handleEnter(event) {
            if (event.key === 'Enter') {
                checkGuess();
            }
        }

        function showWinModal() {
            document.getElementById('winModal').style.display = 'block';
        }

        // Initialize the dynamic engine on page load
        window.onload = initGame;
    </script>
</body>
</html>