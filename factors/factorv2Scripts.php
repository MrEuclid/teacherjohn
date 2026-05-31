<?php
if (isset($_GET['level'])) {
    $level = $_GET['level'] ;
} else {
    $level = 6 ;
}
// Output the level so the frontend can read it into the #howMany div
echo $level ;
?>

<script type="text/javascript">
    // Define global game variables if they don't exist
    if (typeof numbers === 'undefined') {
        window.numbers = [];
        window.score = 0;
        window.maxScore = 0;
        window.maxima = [0, 15, 55, 120, 210, 325, 465]; 
    }

    // Reset state for new game
    window.numbers = [];
    window.score = 0;

    // Immediately generate the board when the script loads
    (function initializeBoard() {
        let lim = parseInt(document.getElementById('howMany').innerText);
        let board = document.getElementById('numberBalls');
        board.innerHTML = ''; // clear existing numbers
        
        window.maxScore = window.maxima[lim / 6];
        
        if (document.getElementById('maxPossible')) {
            document.getElementById('maxPossible').innerText = ' / ' + window.maxScore;
        }

        for (let i = 1; i <= lim; i++) {
            let btn = createButton(i);
            board.appendChild(btn);
            window.numbers[i] = i;
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
            if (window.numbers[m] !== 0 && n % window.numbers[m] === 0) {
                numberFactors++;
            }
        }
        return numberFactors;
    }

    // Function to check if the game has any valid moves left
    function isAlive() {
        let totalAlive = 0;
        let lim = parseInt(document.getElementById('howMany').innerText);
        for(let i = 1; i <= lim; i++) { 
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
            
            // Add to score
            window.score = window.score + index;
            document.getElementById('total').innerText = window.score;
            
            // Style the chosen button (Yellow)
            btn.style.backgroundColor = "#ffc107"; 
            btn.style.color = "#000";
            btn.disabled = true;
            window.numbers[index] = 0; // kill it
            
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
            statusSpan.innerText = 'Winner! 🏆';
            statusSpan.className = "text-success fw-bold"; // Bootstrap classes
        } else if (living === 0) {
            statusSpan.innerText = 'Game Over!';
            statusSpan.className = "text-danger fw-bold";
        }
    }
</script>