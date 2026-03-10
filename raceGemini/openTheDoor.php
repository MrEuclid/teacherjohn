<!DOCTYPE html>
<html lang="en" translate="no" class="notranslate">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Open The Door</title>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <style>
        .door-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            max-width: 450px;
            margin: 0 auto;
            text-align: center;
        }

        .guess-display {
            font-size: 4.5rem;
            font-weight: 800;
            color: #0d6efd;
            background: #f8f9fa;
            border: 4px solid #e9ecef;
            border-radius: 15px;
            padding: 10px 0;
            margin: 20px 0;
            letter-spacing: 2px;
        }

        .door-btn {
            font-size: 1.5rem;
            font-weight: bold;
            width: 70px;
            height: 60px;
            margin: 5px;
            border-radius: 12px;
            transition: transform 0.1s;
        }
    </style>
</head>
<body>

<div class="door-card">
    <h3 class="text-secondary fw-bold">Open The Door!</h3>
    <p class="text-muted">Guess the secret code (between 10 and 100)</p>

    <div class="guess-display" id="currentGuess">50</div>

    <div class="d-flex justify-content-center flex-wrap gap-2">
        <button class="btn btn-danger door-btn shadow-sm" id="btnMinus10">-10</button>
        <button class="btn btn-outline-danger door-btn shadow-sm" id="btnMinus1">-1</button>
        <button class="btn btn-outline-success door-btn shadow-sm" id="btnPlus1">+1</button>
        <button class="btn btn-success door-btn shadow-sm" id="btnPlus10">+10</button>
    </div>

    <div class="mt-4">
        <button id="btnDoorCheck" class="btn btn-primary btn-lg w-100 fw-bold shadow">Check Code 🔓</button>
    </div>

    <div id="feedback" class="mt-3 fs-5 fw-bold text-center" style="min-height: 35px;"></div>
    
    <div class="mt-2 text-muted small">
        Tries: <span id="triesCount">0</span>/8
    </div>
</div>

<script>
$(document).ready(function() {
    
    let secretNumber = Math.floor(Math.random() * 91) + 10;
    let currentGuess = 50;
    let tries = 0;
    const MAX_TRIES = 8;

    function updateDisplay() {
        $('#currentGuess').text(currentGuess);
    }

    // Adjusting the guess
    $('#btnPlus10').click(function() { currentGuess = Math.min(100, currentGuess + 10); updateDisplay(); });
    $('#btnPlus1').click(function() { currentGuess = Math.min(100, currentGuess + 1); updateDisplay(); });
    $('#btnMinus10').click(function() { currentGuess = Math.max(10, currentGuess - 10); updateDisplay(); });
    $('#btnMinus1').click(function() { currentGuess = Math.max(10, currentGuess - 1); updateDisplay(); });

    // Custom Game Checking Logic
    $('#btnDoorCheck').click(function() {
        tries++;
        $('#triesCount').text(tries);

        if (currentGuess === secretNumber) {
            
            // 1. UPDATE THIS WINDOW'S UI (Just like checkAnswer does)
            $('#feedback').removeClass('text-danger text-warning').addClass('text-success').html('✅ CORRECT! The door is open!');
            $('.door-btn').prop('disabled', true);
            $('#btnDoorCheck').prop('disabled', true).removeClass('btn-primary').addClass('btn-success').text('✓');
            $('#currentGuess').css({'background-color': '#c8e6c9', 'border-color': '#198754', 'color': 'black'});
            
            // 2. SIMULATE checkAnswer() SENDING SUCCESS TO THE DASHBOARD
            setTimeout(function() {
                if (typeof window.parent.handleCorrectAnswer === 'function') {
                    window.parent.handleCorrectAnswer(); // The standard utilities.js signal
                } else if (typeof window.parent.questionSolved === 'function') {
                    window.parent.questionSolved(); // The fallback custom signal
                } else {
                    console.log("Success! (Not running in dashboard iframe)");
                }
            }, 1000);

        } else if (tries >= MAX_TRIES) {
            // GAME OVER - Too many tries
            $('#feedback').removeClass('text-warning').addClass('text-danger').html(`❌ Out of tries! The code was ${secretNumber}.`);
            $('.door-btn, #btnDoorCheck').prop('disabled', true);
            $('#currentGuess').css({'background-color': '#ffcdd2', 'border-color': '#dc3545', 'color': '#842029'});
            
            // Reset the game after 3 seconds
            setTimeout(function() {
                secretNumber = Math.floor(Math.random() * 91) + 10;
                currentGuess = 50;
                tries = 0;
                $('#triesCount').text(tries);
                $('#feedback').html('');
                $('#currentGuess').css({'background-color': '#f8f9fa', 'border-color': '#e9ecef', 'color': '#0d6efd'});
                $('.door-btn, #btnDoorCheck').prop('disabled', false).removeClass('btn-success').addClass('btn-primary').text('Check Code 🔓');
                updateDisplay();
            }, 3000);

        } else if (currentGuess > secretNumber) {
            $('#feedback').removeClass('text-success text-danger').addClass('text-warning text-dark').html('🔽 Too High!');
        } else {
            $('#feedback').removeClass('text-success text-danger').addClass('text-warning text-dark').html('🔼 Too Low!');
        }
    });
});
</script>

</body>
</html>