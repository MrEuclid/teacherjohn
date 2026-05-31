<?php
if (isset($_GET['level'])) {
    $level = intval($_GET['level']); 
} else {
    $level = 6 ;
}
echo $level ;
?>

<script type="text/javascript">
    if (typeof window.numbers === 'undefined') {
        window.numbers = [];
        window.score = 0;
        window.maxScore = 0;
        window.maxima = [0, 15, 50, 111, 185, 274, 385]; 
    }

    // FIX: Using window.currentLevel prevents the "already declared" crash on Retry!
    window.currentLevel = <?php echo $level; ?>;

    window.numbers = [];
    window.score = 0;
    window.maxScore = window.maxima[window.currentLevel / 6];

    (function initializeBoard() {
        let board = document.getElementById('numberBalls');
        board.innerHTML = ''; 
        
        let scoreDisplay = document.getElementById('total');
        if (scoreDisplay) {
            scoreDisplay.innerText = window.score + ' / ' + window.maxScore;
        }

        for (let i = 1; i <= window.currentLevel; i++) {
            let btn = createButton(i);
            board.appendChild(btn);
            window.numbers[i] = i; 
        }
    })();

    function createButton(nButton) {
        let btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'num'; 
        btn.id = 'btn-' + nButton;
        btn.value = nButton;
        btn.textContent = nButton;
        
        btn.addEventListener('click', handleNumberClick);
        return btn;
    }

    function checkFactors(n) {
        let numberFactors = 0;
        for (let m = 1; m < n; m++) {
            if (window.numbers[m] !== 0 && n % window.numbers[m] === 0) {
                numberFactors++;
            }
        }
        return numberFactors;
    }

    function isAlive() {
        let totalAlive = 0;
        for(let i = 1; i <= window.currentLevel; i++) { 
            if (window.numbers[i] !== 0 && checkFactors(window.numbers[i]) !== 0) {
                totalAlive++; 
            }
        }
        return totalAlive;
    }

    function handleNumberClick(e) {
        let btn = e.target;
        let index = parseInt(btn.value);
        let numFactors = checkFactors(index);
        
        if (numFactors > 0) {
            let choicesSpan = document.getElementById('myChoices');
            choicesSpan.innerText = choicesSpan.innerText + " " + index + " * ";
            
            window.score = window.score + index;
            document.getElementById('total').innerText = window.score + ' / ' + window.maxScore;
            
            btn.style.backgroundColor = "#ffc107"; 
            btn.style.color = "#000";
            btn.disabled = true;
            window.numbers[index] = 0; 
            
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
            alert('Cannot use this number. It has no factors left.');
            btn.style.backgroundColor = "#198754"; 
            btn.style.color = "#fff";
            btn.disabled = true;
            window.numbers[index] = 0;
        }
        
        // Auto-Endgame Logic
        let living = isAlive();
        let statusSpan = document.getElementById('gameStatus');
        
        if (living > 0) {
            statusSpan.innerText = 'Playing';
            statusSpan.className = "";
        } else {
            for (let i = 1; i <= window.currentLevel; i++) {
                if (window.numbers[i] !== 0) {
                    let leftoverBtn = document.getElementById('btn-' + i);
                    if (leftoverBtn) {
                        leftoverBtn.style.backgroundColor = "#198754"; // Green out
                        leftoverBtn.style.color = "#fff";
                        leftoverBtn.disabled = true;
                    }
                    window.numbers[i] = 0; 
                }
            }

            if (window.score === window.maxScore) {
                statusSpan.innerText = 'Winner! ⭐';
                statusSpan.className = "text-success fw-bold"; 
            } else {
                statusSpan.innerText = 'Game Over!';
                statusSpan.className = "text-danger fw-bold";
            }
        }
    }
</script>