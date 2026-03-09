<!DOCTYPE html>
<html lang="en" translate="no" class="notranslate">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Egyptian Fractions Mastery</title>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script type="text/x-mathjax-config">
        MathJax.Hub.Config({
            extensions: ["tex2jax.js"],
            jax: ["input/TeX","output/HTML-CSS"],
            tex2jax: {inlineMath: [["$","$"],["\\(","\\)"]]}
        });
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.7/MathJax.js?config=TeX-MML-AM_CHTML"></script>

    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, sans-serif; }
        
        .header-section { margin-top: 20px; margin-bottom: 20px; }
        .target-card { background: white; border-radius: 15px; border: 3px dashed #0d6efd; padding: 20px; }
        
        /* Modernized Fraction Buttons */
        .fraction-btn {
            border-radius: 12px;
            transition: transform 0.2s, opacity 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 5px;
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        .fraction-btn:hover:not(:disabled) {
            transform: scale(1.1);
            box-shadow: 0 6px 12px rgba(0,0,0,0.2);
            filter: brightness(1.1);
        }
        
        .star-container { min-height: 25px; font-size: 1.3rem; letter-spacing: 2px; }
        
        #targetDisplay, #attemptDisplay {
            min-height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .mathjax-lg .MathJax { font-size: 2.2rem !important; }
    </style>
</head>

<body>

<div class="p-3">
    <a href="/index.php" class="btn btn-outline-secondary fw-bold">
        ← Back to Home
    </a>
</div>

<div class="container pb-5">
    <div class="header-section text-center">
        <h1 class="display-6 fw-bold text-primary">Egyptian Fractions</h1>
        <h5 class="text-muted">Can you find the missing unit fractions to reach the target?</h5>
    </div>

    <div class="row justify-content-center text-center mb-4">
        <div class="col-lg-10 col-md-12 target-card shadow-sm">
            <h4 class="text-muted mb-3" id="levelInstructions">Select a difficulty to begin:</h4>
            
            <div class="d-flex justify-content-center gap-4 flex-wrap">
                <div class="text-center">
                    <button id="btnEasy" class="btn btn-success btn-lg fw-bold px-4">Easy (2)</button>
                    <div id="starsEasy" class="star-container mt-2 text-warning"></div>
                </div>
                <div class="text-center">
                    <button id="btnMedium" class="btn btn-warning btn-lg fw-bold px-4 text-dark">Medium (3)</button>
                    <div id="starsMedium" class="star-container mt-2 text-warning"></div>
                </div>
                <div class="text-center">
                    <button id="btnHard" class="btn btn-danger btn-lg fw-bold px-4">Hard (4)</button>
                    <div id="starsHard" class="star-container mt-2 text-warning"></div>
                </div>
            </div>

            <hr class="mt-4">

            <div id="gameArea" style="display:none;">
                <div class="row mt-4 align-items-center">
                    <div class="col-md-5 border-end">
                        <h4 class="text-secondary">Target Goal:</h4>
                        <div id="targetDisplay" class="mathjax-lg text-primary fw-bold display-4">?</div>
                    </div>
                    <div class="col-md-7">
                        <h4 class="text-secondary">Your Sum:</h4>
                        <div class="d-flex align-items-center justify-content-center">
                            <div id="attemptDisplay" class="mathjax-lg text-dark fw-bold display-4">?</div>
                            <div id="feedbackIcon" class="ms-3 display-5"></div>
                        </div>
                        <button id="btnClear" class="btn btn-sm btn-outline-danger mt-3 fw-bold">Clear Selection</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center text-center">
        <div class="col-md-10">
            <h5 class="text-muted mb-3">Choose different unit fractions:</h5>
            <div id="buttonDisplay" class="d-flex flex-wrap justify-content-center gap-2 pb-4">
                </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    const MAX_STARS = 6;
    let stars = { 'easy': 0, 'medium': 0, 'hard': 0 };
    let currentLevel = null;
    let clicksMax = 0;
    
    let targetNum = 0;
    let targetDen = 1;
    let currentAttemptFractions = [];
    
    // UI Connections
    $('#btnEasy').click(() => startLevel('easy'));
    $('#btnMedium').click(() => startLevel('medium'));
    $('#btnHard').click(() => startLevel('hard'));
    $('#btnClear').click(() => clearAttempt());

    // --- MATH ENGINE ---
    function gcd(a, b) {
        return b ? gcd(b, a % b) : Math.abs(a);
    }

    function simplifyFraction(num, den) {
        let factor = gcd(num, den);
        return [num / factor, den / factor];
    }

    function addFractions(fractionsArray) {
        let num = 0;
        let den = 1;
        for (let i = 0; i < fractionsArray.length; i++) {
            let d = fractionsArray[i];
            let newNum = num * d + den * 1;
            let newDen = den * d;
            let simplified = simplifyFraction(newNum, newDen);
            num = simplified[0];
            den = simplified[1];
        }
        return [num, den];
    }

    // --- GAME LOGIC ---
    function createButtons() {
        // Retaining your original color-coding array logic
        let colours = {1: '#0d6efd', 2: '#dc3545', 3: '#198754', 5: '#fd7e14'};
        
        for(let i=2; i<=20; i++) {
            let myColor = 1;
            if(i % 2 === 0) myColor = 2;
            if(i % 3 === 0) myColor = 3;
            if(i % 5 === 0) myColor = 5;
            let clr = colours[myColor];
            
            let term = '$ \\frac{1}{' + i + '} $';
            let btn = $('<button>', {
                class: 'btn fraction-btn',
                id: 'btn-' + i,
                html: term,
                css: { 'background-color': clr, 'color': 'white', 'width': '80px', 'height': '80px', 'font-size': '24px', 'font-weight': 'bold' }
            });
            
            btn.click(function() { handleFractionClick(i); });
            $('#buttonDisplay').append(btn);
        }
        
        // Render MathJax immediately after injecting buttons
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, "buttonDisplay"]);
    }

    function startLevel(level) {
        if (stars[level] >= MAX_STARS) return; // Locked out
        
        currentLevel = level;
        if (level === 'easy') clicksMax = 2;
        if (level === 'medium') clicksMax = 3;
        if (level === 'hard') clicksMax = 4;
        
        $('#levelInstructions').hide();
        $('#gameArea').fadeIn();
        
        clearAttempt();
        setTarget();
    }
function setTarget() {
        let chosen = [];
        let pool = [];
        
        // Determine the "friendly" number pool based on difficulty
        if (currentLevel === 'easy') {
            pool = [2, 3, 4, 5, 6, 8, 10, 12]; // Avoids awkward primes
        } else if (currentLevel === 'medium') {
            pool = [2, 3, 4, 5, 6, 8, 9, 10, 12, 14, 15, 16, 20]; // Introduces mild challenge
        } else {
            // Hard mode: All numbers from 2 to 20
            pool = [2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20]; 
        }

        // Generate random, distinct unit fractions from the approved pool
        while(true) {
            chosen = [];
            while(chosen.length < clicksMax) {
                // Select randomly from the specific pool, not just 2-20
                let r = pool[Math.floor(Math.random() * pool.length)];
                
                if (!chosen.includes(r)) chosen.push(r);
            }
            
            let sum = addFractions(chosen);
            
            // Ensure the targets aren't wildly massive
            if (sum[0] / sum[1] <= 1.5) { 
                targetNum = sum[0];
                targetDen = sum[1];
                break;
            }
        }
        
        // Display the target on screen
        $('#targetDisplay').html('$' + '\\frac{' + targetNum + '}{' + targetDen + '}' + '$');
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, "targetDisplay"]);
    }
    function handleFractionClick(d) {
        if (!currentLevel) return;
        if (currentAttemptFractions.includes(d)) return; // Prevents clicking same button twice
        
        currentAttemptFractions.push(d);
        $('#btn-' + d).prop('disabled', true).css('opacity', '0.4'); // Visual feedback
        
        updateAttemptDisplay();
        
        if (currentAttemptFractions.length === clicksMax) {
            checkAnswer();
        }
    }

    function clearAttempt() {
        currentAttemptFractions = [];
        $('.fraction-btn').prop('disabled', false).css('opacity', '1');
        $('#feedbackIcon').html('');
        updateAttemptDisplay();
    }

    function updateAttemptDisplay() {
        if (currentAttemptFractions.length === 0) {
            $('#attemptDisplay').html('?');
            return;
        }
        
        // Dynamically build the MathJax equation
        let str = currentAttemptFractions.map(d => '\\frac{1}{' + d + '}').join(' + ');
        $('#attemptDisplay').html('$' + str + '$');
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, "attemptDisplay"]);
    }

    function renderStars() {
        $('#starsEasy').text('⭐'.repeat(stars['easy']));
        $('#starsMedium').text('⭐'.repeat(stars['medium']));
        $('#starsHard').text('⭐'.repeat(stars['hard']));
    }

    function lockLevel(level) {
        if (level === 'easy') { $('#btnEasy').prop('disabled', true).removeClass('btn-success').addClass('btn-secondary'); }
        if (level === 'medium') { $('#btnMedium').prop('disabled', true).removeClass('btn-warning').addClass('btn-secondary'); }
        if (level === 'hard') { $('#btnHard').prop('disabled', true).removeClass('btn-danger').addClass('btn-secondary'); }
        
        $('#gameArea').hide();
        currentLevel = null;
        
        if (stars['easy'] === MAX_STARS && stars['medium'] === MAX_STARS && stars['hard'] === MAX_STARS) {
            $('#levelInstructions').html('<span class="text-success fw-bold fs-3">🏆 AMAZING! YOU BEAT THE ENTIRE GAME! 🏆</span>').show();
        } else {
            $('#levelInstructions').html('<span class="text-success fw-bold">Level Complete! Choose a harder difficulty.</span>').show();
        }
    }

    function checkAnswer() {
        let sum = addFractions(currentAttemptFractions);
        let isCorrect = (sum[0] === targetNum && sum[1] === targetDen);
        
        // Stop user from clicking more while checking
        $('.fraction-btn').prop('disabled', true);
        
        if (isCorrect) {
            $('#feedbackIcon').html('✅');
            stars[currentLevel]++;
            renderStars();
            
            if (stars[currentLevel] >= MAX_STARS) {
                setTimeout(() => lockLevel(currentLevel), 1500);
            } else {
                setTimeout(() => startLevel(currentLevel), 1500);
            }
        } else {
            $('#feedbackIcon').html('❌');
            setTimeout(() => {
                clearAttempt(); // Incorrect! Clear and let them try the same target again
            }, 1500);
        }
    }

    // Start by painting the UI
    createButtons();
});
</script>
</body>
</html>