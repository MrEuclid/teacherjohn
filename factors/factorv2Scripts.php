<?php
if (isset($_GET['level'])) {
    $level = intval($_GET['level']); // Ensure it's a clean integer
} else {
    $level = 6 ;
}
// Output for HTML continuity
echo $level ;
?>

<script type="text/javascript">
    // Define global game variables safely
    if (typeof window.numbers === 'undefined') {
        window.numbers = [];
        window.score = 0;
        window.maxScore = 0;
        // The maximum possible scores for levels: 6, 12, 18, 24, 30, 36
        window.maxima = [0, 15, 55, 120, 210, 325, 465]; 
    }

    // Grab the exact level directly from PHP to prevent DOM parsing errors
    let currentLevel = <?php echo $level; ?>;

    // Reset state for new game
    window.numbers = [];
    window.score = 0;
    
    // Mathematically assign the max score based on the level index
    window.maxScore = window.maxima[currentLevel / 6];

    // Immediately generate the board when the script loads
    (function initializeBoard() {
        let board = document.getElementById('numberBalls');
        board.innerHTML = ''; // clear existing numbers
        
        // Update UI to show the target score (e.g., 0 / 15)
        let scoreDisplay = document.getElementById('total');
        if (scoreDisplay) {
            scoreDisplay.innerText = window.score + ' / ' + window.maxScore;
        }

        for (let i = 1; i <= currentLevel; i++) {
            let btn = createButton(i);
            board.appendChild(btn);
            window.numbers[i] = i; // Array tracks alive/dead numbers
        }
    })();

    // Function to create standard buttons
    function createButton(nButton) {
        let btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'num'; // Relies on the CSS in the main file
        btn.id = 'btn-' + nButton;
        btn.value = nButton;
        btn.textContent = nButton;
        
        // Attach click listener in Vanilla JS
        btn.addEventListener('click', handleNumberClick);
        
        return btn;
    }

    // Function to check how many factors a number currently has left
    function checkFactors(n) {
        let numberFactors = 0;
        for (let m = 1; m < n; m++) {
            // Check if 'm' is still alive (!= 0) and is a factor of 'n'
            if (window.numbers[m] !== 0 && n % window.numbers[m] === 0) {
                numberFactors++;
            }
        }
        return numberFactors;
    }

    // Function to check if the game has any valid moves left on the board
    function isAlive() {
        let totalAlive = 0;
        for(let i = 1; i <= currentLevel; i++) { 
            if (window.numbers[i] !== 0 && checkFactors(window.numbers[i]) !== 0) {
                totalAlive++; 
            }
        }
        return totalAlive;
    }

    // Handle what happens when a number ball is clicked
    function handleNumberClick(e) {
        let btn = e.target;
        let index = parseInt(btn.value);
        let numFactors = checkFactors(index);
        
        if (numFactors > 0) {
            // It has factors! Add to choices
            let choicesSpan = document.getElementById('myChoices');
            choicesSpan.innerText = choicesSpan.innerText + " " + index + " * ";
            
            // Add to score and update visual display
            window.score = window.score + index;
            document.getElementById('total').innerText = window.score + ' / ' + window.maxScore;
            
            // Style the chosen button (Yellow)
            btn.style.backgroundColor = "#ffc107"; 
            btn.style.color = "#000";
            btn.disabled = true;
            window.numbers[index] = 0; // kill it in the array
            
            // Style and kill its factors (Red)
            for (let j = 1; j < index; j++) {
                if (index % j === 0 && window.numbers[j] !== 0) {
                    let factorBtn = document.getElementById('btn-' + j);
                    if (factorBtn) {
                        factorBtn.style.backgroundColor = "#dc3545"; 
                        factorBtn.style.color = "#fff";
                        factorBtn.disabled = true;
                    }
                    window.numbers[j] = 0; 
                }
            }
        } else {
            // Clicked a number with no factors
            alert('Cannot use this number. It has no factors left.');
            // Style as dead (Green)
            btn.style.backgroundColor = "#198754"; 
            btn.style.color = "#fff";
            btn.disabled = true;
            window.numbers[index] = 0;
        }
        
        // Update the UI Game Status
        let living = isAlive();
        let statusSpan = document.getElementById('gameStatus');
        
        if (living > 0) {
            statusSpan.innerText = 'Playing';
            statusSpan.className = "";
        } else if (living === 0 && window.score === window.maxScore) {
            // Trigger the winning star!
            statusSpan.innerText = 'Winner! ⭐';
            statusSpan.className = "text-success fw-bold"; 
        } else if (living === 0) {
            statusSpan.innerText = 'Game Over!';
            statusSpan.className = "text-danger fw-bold";
        }
    }
</script>