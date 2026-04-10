<?php 
 
$question = isset($_POST['question']) ? $_POST['question'] : 'Delta5 colour Challenge';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>5x5 Logic Grid</title>
    <style>
        :root {
            --empty: #ffffff;
            --red: #ff4d4d;
            --blue: #4d94ff;
            --yellow: #ffdb4d;
            --green: #4dff88;
            --purple: #d94dff;
        }
        body { font-family: sans-serif; display: flex; flex-direction: column; align-items: center; background: #f0f0f0; margin: 0; padding: 20px; box-sizing: border-box; }
        #app-container { width: 100%; max-width: 600px; display: flex; flex-direction: column; align-items: center; position: relative; }
        
        #grid { display: grid; grid-template-columns: repeat(5, 1fr); gap: 5px; margin-top: 20px; width: 100%; aspect-ratio: 1; position: relative; z-index: 10; }
        .cell { aspect-ratio: 1; border: 2px solid #ccc; background: var(--empty); cursor: pointer; border-radius: 4px; box-shadow: inset 0 1px 3px rgba(0,0,0,0.1); }
        .cell.active-diag { border-color: #333; } /* subtle diag border */
        
        #palette { display: flex; gap: 10px; margin-top: 20px; padding: 10px; background: white; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); z-index: 10; position: relative; width: 100%; box-sizing: border-box; justify-content: space-around; }
        .swatch { width: 40px; height: 40px; border-radius: 50%; cursor: pointer; border: 3px solid transparent; transition: transform 0.2s; }
        .swatch.selected { border-color: #333; transform: scale(1.15); }
        .swatch:hover { transform: scale(1.1); }

        #controls { margin-top: 20px; z-index: 10; position: relative; }
        button { padding: 10px 20px; font-size: 16px; border: none; border-radius: 4px; cursor: pointer; transition: background 0.3s; margin: 0 10px; }
        #checkBtn { background-color: #4CAF50; color: white; }
        #checkBtn:hover { background-color: #45a049; }
        #resetBtn { background-color: #f44336; color: white; }
        #resetBtn:hover { background-color: #e53935; }

        #status { margin-top: 15px; font-weight: bold; height: 25px; z-index: 10; position: relative; text-align: center; width: 100%; }
        
        /* Confetti Container */
        #confetti-wrapper {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
            z-index: 5;
        }

        .confetti-piece {
            position: absolute;
            width: 8px;
            height: 8px;
            border-radius: 1px;
            animation-duration: 3s;
            animation-timing-function: ease-out;
            animation-iteration-count: 1;
            opacity: 0;
            transform-origin: center center;
        }

        @keyframes confetti-fall {
            0% { transform: translateY(-50px) rotateZ(0deg); opacity: 1; }
            10% { transform: translateY(0px) rotateZ(45deg); opacity: 1; }
            100% { transform: translateY(110vh) rotateZ(360deg); opacity: 0; }
        }
        @keyframes confetti-burst {
            0% { transform: scale(0) rotateZ(0deg); opacity: 1; }
            100% { transform: scale(1) translate(0, 110vh) rotateZ(360deg); opacity: 0; }
        }

        /* Responsive grid sizes */
        @media (max-width: 500px) {
            #grid { grid-template-columns: repeat(5, calc(100% / 5.5)); gap: 2px; }
            .cell { width: 100%; }
            .swatch { width: 30px; height: 30px; }
        }
    </style>
</head>
<body>
    <div id="app-container">
        <h2>5x5 Color Logic Challenge</h2>
        <div id="status">Fill the grid: No duplicates in rows, columns, or main diagonals!</div>

        <div id="grid"></div>

        <div id="palette">
            <div class="swatch" style="background: var(--red);" onclick="selectColor('var(--red)', 1)"></div>
            <div class="swatch" style="background: var(--blue);" onclick="selectColor('var(--blue)', 2)"></div>
            <div class="swatch" style="background: var(--yellow);" onclick="selectColor('var(--yellow)', 3)"></div>
            <div class="swatch" style="background: var(--green);" onclick="selectColor('var(--green)', 4)"></div>
            <div class="swatch" style="background: var(--purple);" onclick="selectColor('var(--purple)', 5)"></div>
            <div class="swatch" style="background: var(--empty); border: 1px solid #ccc;" onclick="selectColor('var(--empty)', 0)"></div>
        </div>

        <div id="controls">
            <button id="checkBtn" onclick="checkLogic()">Check Solution</button>
            <button id="resetBtn" onclick="resetGrid()">Clear Grid</button>
        </div>

        <div id="confetti-wrapper"></div>
    </div>

    <script>
        let selectedColor = 'var(--empty)';
        let selectedValue = 0;
        const gridData = Array(5).fill().map(() => Array(5).fill(0));
        const confettiWrapper = document.getElementById('confetti-wrapper');
        const confettiCount = 150; // number of confetti pieces
        const confettiColors = ['#ff4d4d', '#4d94ff', '#ffdb4d', '#4dff88', '#d94dff'];

        // Create Grid
        const gridEl = document.getElementById('grid');
        for (let r = 0; r < 5; r++) {
            for (let c = 0; c < 5; c++) {
                const cell = document.createElement('div');
                cell.className = 'cell';
                if (r === c || r + c === 4) cell.classList.add('active-diag');
                cell.onclick = (event) => {
                    cell.style.background = selectedColor;
                    gridData[r][c] = selectedValue;
                    event.stopPropagation(); // prevent body click
                };
                gridEl.appendChild(cell);
            }
        }

        // Initialize empty swatch as selected
        document.querySelector('.swatch[onclick*="0"]').classList.add('selected');

        function selectColor(color, val) {
            selectedColor = color;
            selectedValue = val;
            document.querySelectorAll('.swatch').forEach(s => s.classList.remove('selected'));
            event.target.classList.add('selected');
        }

        function resetGrid() {
            gridData.forEach((row, r) => row.fill(0));
            document.querySelectorAll('.cell').forEach(cell => cell.style.background = 'var(--empty)');
            const status = document.getElementById('status');
            status.innerText = "Fill the grid: No duplicates in rows, columns, or main diagonals!";
            status.style.color = "inherit";
            confettiWrapper.innerHTML = ''; // Clear any remaining confetti
            // reset selected color/swatch (to empty)
            selectColor('var(--empty)', 0);
        }

        function checkLogic() {
            const status = document.getElementById('status');
            
            // Basic check for empty cells
            if (gridData.flat().includes(0)) {
                status.innerText = "Keep going! Some squares are still empty.";
                status.style.color = "orange";
                confettiWrapper.innerHTML = ''; // Ensure no confetti from partial/incorrect check
                return;
            }

            // Logic to check Rows, Cols, and Diagonals
            const isValid = (arr) => new Set(arr).size === 5;

            for (let i = 0; i < 5; i++) {
                const row = gridData[i];
                const col = gridData.map(r => r[i]);
                if (!isValid(row) || !isValid(col)) {
                    status.innerText = "Not quite! Check your rows and columns.";
                    status.style.color = "red";
                    confettiWrapper.innerHTML = ''; // Ensure no confetti
                    return;
                }
            }

            const diag1 = gridData.map((r, i) => r[i]);
            const diag2 = gridData.map((r, i) => r[4 - i]);
            if (!isValid(diag1) || !isValid(diag2)) {
                status.innerText = "Close! Check the diagonals.";
                status.style.color = "red";
                confettiWrapper.innerHTML = ''; // Ensure no confetti
                return;
            }

          // SUCCESS!
            status.innerText = "Well done, solved!";
            status.style.color = "green";
            triggerConfetti();
            
            // Wait 3 seconds (3000ms) for the confetti before telling the dashboard we won
            setTimeout(function() {
                if (typeof handleCorrectAnswer === "function") {
                    handleCorrectAnswer();
                }
            }, 3000);
        
        }

        function triggerConfetti() {
            confettiWrapper.innerHTML = ''; // Reset for potentially overlapping celebrations
            for (let i = 0; i < confettiCount; i++) {
                const piece = document.createElement('div');
                piece.className = 'confetti-piece';
                piece.style.backgroundColor = confettiColors[Math.floor(Math.random() * confettiColors.length)];
                
                // Random position above grid
                piece.style.left = Math.random() * 100 + '%';
                piece.style.top = Math.random() * -100 + 'px'; // Start above view

                // Random animation delay & duration variation
                const delay = Math.random() * 0.5 + 's';
                piece.style.animationDelay = delay;
                const fallDuration = (Math.random() * 1.5 + 1.5) + 's'; // 1.5s - 3s fall time

                // Apply dynamic animation based on position or generic fall
                // Randomize burst effect vs standard fall
                if (Math.random() < 0.3) {
                     piece.style.top = Math.random() * 20 + '%'; // Start closer conceptually burst
                     piece.style.animationName = 'confetti-burst';
                     piece.style.animationDuration = (Math.random() * 1 + 1) + 's'; // shorter burst time
                } else {
                    piece.style.animationName = 'confetti-fall';
                    piece.style.animationDuration = fallDuration;
                }

                confettiWrapper.appendChild(piece);
                
                // Ensure pieces are cleaned up after animation ends
                piece.addEventListener('animationend', () => piece.remove());
            }
        }
    </script>
</body>
</html>
