<?php 
// Safely grab the POSTed JSON string of words
$postedWords = isset($_POST['theWords']) ? $_POST['theWords'] : '[]'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Play - The Word Game</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    
    <style>
        body { background-color: #e9ecef; }
        
/* Modern Scrabble-style Tiles (Optimized for jQuery UI) */
        #sortable { 
            list-style-type: none; margin: 0 auto; padding: 20px; 
            text-align: center; /* This centers the inline-block tiles */
            background: #dee2e6; border-radius: 15px; min-height: 120px;
        }
        #sortable li { 
            display: inline-block; /* The magic fix that replaces Flexbox! */
            vertical-align: top;
            margin: 5px; 
            width: 70px; height: 70px; font-size: 2.5rem; font-weight: bold;
            text-align: center; line-height: 70px; text-transform: uppercase;
            background-color: white; border: 2px solid #adb5bd; border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1); cursor: grab; color: #212529;
            transition: transform 0.1s; user-select: none;
        }
        #sortable li:active { 
            cursor: grabbing; 
            transform: scale(1.05); 
            z-index: 9999; 
            position: relative; 
        }
        
        /* The empty slot that appears when dragging */
        .sortable-placeholder {
            display: inline-block; /* Must match the li element */
            vertical-align: top;
            width: 70px; height: 70px; margin: 5px;
            background-color: #ced4da; border: 2px dashed #6c757d; border-radius: 10px;
            visibility: visible !important;
        }
        .score-box { background-color: #0d6efd; color: white; border-radius: 15px; padding: 15px 40px; font-size: 3rem; font-weight: bold; display: inline-block;}
        .level-btn { min-width: 100px; margin: 5px; font-weight: bold;}
        .solved-words { color: #198754; font-size: 1.2rem; font-family: monospace; font-weight: bold; }
    </style>
</head>
<body>

<div class="container text-center py-4">
    
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="indexWords.php" class="btn btn-outline-dark">&larr; Back</a>
        <h2 class="m-0 text-primary fw-bold">Unscramble the Word</h2>
        <div id="progress" class="text-muted fw-bold fs-5">0 / 0</div>
    </div>

    <div id="levelSelectArea" class="card shadow-sm border-0 mb-4 p-3">
        <h5 class="text-muted mb-3">Choose Your Difficulty</h5>
        <div>
            <button class="btn btn-success level-btn" data-level="1">Level 1</button>
            <button class="btn btn-warning level-btn text-dark" data-level="2">Level 2</button>
            <button class="btn btn-danger level-btn" data-level="3">Level 3</button>
        </div>
    </div>

    <div id="gameArea" style="display: none;">
        <div class="mb-4">
            <div class="score-box shadow" id="score">0</div>
        </div>

        <ul id="sortable" class="mb-4 shadow-sm"></ul>

        <div class="mb-4">
            <button id="checkBtn" class="btn btn-success btn-lg px-5 py-3 shadow fs-3 fw-bold rounded-pill">GO!</button>
            <p id="feedbackMessage" class="mt-3 fs-4 fw-bold"></p>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="text-muted">Words Solved:</h5>
                <div id="answers" class="solved-words mt-2"></div>
            </div>
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>

<script>
$(document).ready(function() {
    // 1. Initialize Global Variables
    const allWords = <?php echo $postedWords; ?>;
    let gameWords = [];
    let currentOriginalWord = "";
    let score = 0;
    let turnIndex = 0;
    let attemptsThisTurn = 0;

    // Initialize jQuery UI Sortable (Optimized for Touch & Flexbox)
    $("#sortable").sortable({
        tolerance: "pointer", // Drops exactly where the mouse/finger is
        revert: 150, // Snaps the tile satisfyingly into place
        placeholder: "sortable-placeholder", // Uses the CSS class we just made
        cursor: "grabbing",
        forcePlaceholderSize: true, // Fixes flex-wrap jumping issues
        zIndex: 9999
    }).disableSelection();

    // 2. Filter Words Based on Level
    $('.level-btn').click(function() {
        let level = $(this).data('level');
        let min = 3, max = 12;

        if (level === 1) { min = 3; max = 4; }
        else if (level === 2) { min = 5; max = 6; }
        else if (level === 3) { min = 7; max = 12; }

        gameWords = allWords.filter(w => w.length >= min && w.length <= max);
        
        if(gameWords.length === 0) {
            alert("No words available for this difficulty level.");
            return;
        }

        // Setup UI for Game
        $('#levelSelectArea').slideUp();
        $('#gameArea').fadeIn();
        
        score = 0;
        turnIndex = 0;
        $('#score').text(score);
        $('#answers').empty();
        
        loadNextWord();
    });

    // 3. Load the Next Word
    function loadNextWord() {
        if (turnIndex >= gameWords.length) {
            $('#sortable').empty();
            $('#checkBtn').hide();
            $('#feedbackMessage').removeClass().addClass('text-success mt-3 fs-4 fw-bold').text("🎉 Game Over! Final Score: " + score);
            return;
        }

        attemptsThisTurn = 0;
        currentOriginalWord = gameWords[turnIndex].toLowerCase();
        $('#progress').text((turnIndex + 1) + ' / ' + gameWords.length);
        $('#feedbackMessage').text("");
        $('#checkBtn').text("GO!").removeClass('btn-warning').addClass('btn-success');

        // Shuffle and Build Grid
        let shuffled = shuffleWord(currentOriginalWord);
        $('#sortable').empty();
        for (let i = 0; i < shuffled.length; i++) {
            $('#sortable').append(`<li class="ui-state-default">${shuffled[i]}</li>`);
        }
    }

    // 4. Proper Fisher-Yates Shuffle Algorithm
    function shuffleWord(word) {
        let arr = word.split('');
        for (let i = arr.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [arr[i], arr[j]] = [arr[j], arr[i]]; // Swap
        }
        let shuffled = arr.join('');
        // Prevent it from returning the word already solved
        if (shuffled === word && word.length > 1) return shuffleWord(word); 
        return shuffled;
    }

    // 5. Check Answer Logic
    $('#checkBtn').click(function() {
        attemptsThisTurn++;
        let userWord = "";
        
        // Read the current order of the tiles
        $('#sortable li').each(function() {
            userWord += $(this).text().toLowerCase();
        });

        if (userWord === currentOriginalWord) {
            // Correct
            $('#feedbackMessage').removeClass().addClass('text-success mt-3 fs-4 fw-bold').text("⭐ Correct!");
            
            // Calculate Points (Max 6, minus 1 for each extra attempt)
            let pointsEarned = Math.max(0, 6 - (attemptsThisTurn - 1));
            score += pointsEarned;
            $('#score').text(score);

            // Add to solved list
            $('#answers').append(` <span class="badge bg-light text-dark border me-1 mb-1 fs-6">${currentOriginalWord}</span> `);

            // Wait a second, then load next word
            setTimeout(function() {
                turnIndex++;
                loadNextWord();
            }, 1000);

        } else {
            // Incorrect
            $('#feedbackMessage').removeClass().addClass('text-danger mt-3 fs-4 fw-bold').text("Not quite. Try rearranging them!");
            $(this).text("TRY AGAIN").removeClass('btn-success').addClass('btn-warning');
        }
    });
});
</script>
</body>
</html>