<?php 
 $question = isset($_POST['question']) ? $_POST['question'] : 'Four 4s Multi-Level';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Four 4s Challenge - Multi-Level</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"></script>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/11.8.0/math.min.js"></script>
  <script src="/raceGemini/javascript/utilities.js"></script>

  <style>
    .game-container { text-align: center; margin-top: 20px; }
    
    #target-box {
        background-color: #fd7e14;
        color: white;
        font-size: 3em;
        font-weight: bold;
        padding: 15px 40px;
        border-radius: 12px;
        display: inline-block;
        margin-bottom: 20px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    #expr-display {
        font-size: 2.5em;
        font-weight: bold;
        text-align: center;
        border: 3px dashed #adb5bd;
        border-radius: 12px;
        background-color: #f8f9fa;
        min-height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        letter-spacing: 2px;
    }

    .num-btn {
        width: 80px;
        height: 80px;
        font-size: 2.5em;
        font-weight: bold;
        margin: 10px;
        border-radius: 12px;
        background-color: #0d6efd;
        color: white;
        border: none;
        box-shadow: 0 4px 6px rgba(0,0,0,0.15);
        transition: transform 0.1s;
    }
    .num-btn:active:not(:disabled) { transform: scale(0.95); }
    .num-btn:disabled { background-color: #6c757d; opacity: 0.3; cursor: not-allowed; }

    .op-btn {
        width: 60px;
        height: 60px;
        font-size: 2em;
        font-weight: bold;
        margin: 5px;
        border-radius: 50%;
        background-color: #198754;
        color: white;
        border: none;
        box-shadow: 0 4px 6px rgba(0,0,0,0.15);
    }
    .op-btn.bracket { background-color: #212529; }
    .op-btn.advanced { background-color: #6f42c1; } /* Purple for advanced math */
    .op-btn:active { transform: scale(0.95); }

    /* Custom Level Badge Styling */
    .level-badge {
        width: 140px;
        padding: 10px;
        border-radius: 8px;
        font-weight: bold;
        transition: all 0.3s;
    }
    .level-active { background-color: #0d6efd; color: white; box-shadow: 0 4px 6px rgba(0,0,0,0.15); border: 2px solid #0a58ca; }
    .level-locked { background-color: #e9ecef; color: #6c757d; border: 2px solid #ced4da; }
    .level-greyed { background-color: #6c757d; color: #f8f9fa; opacity: 0.6; border: 2px solid #495057; } 
  </style>
</head>

<body>
    <div class="p-3">
    <a href="/index.php" class="btn btn-outline-secondary fw-bold shadow-sm">
        ← Back to Home
    </a>
</div>
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 game-container">
        
        <h3 class="fw-bold text-primary mb-3">The Four 4s: Multi-Level Mastery</h3>
        <p class="text-muted fs-5">Use exactly four 4s to make the target number. Earn 4 stars to advance levels!</p>
        
        <div class="d-flex justify-content-center flex-wrap mb-4 gap-2">
            <div id="lvl-1" class="level-badge level-active">Level 1<br><span id="stars-1"></span></div>
            <div id="lvl-2" class="level-badge level-locked">Level 2<br><span id="stars-2"><small>Locked</small></span></div>
            <div id="lvl-3" class="level-badge level-locked">Level 3<br><span id="stars-3"><small>Locked</small></span></div>
            <div id="lvl-4" class="level-badge level-locked">Level 4<br><span id="stars-4"><small>Locked</small></span></div>
        </div>

        <div id="target-box">0</div>

        <div id="expr-display"></div>

        <div class="mb-3">
            <button class="num-btn">4</button>
            <button class="num-btn">4</button>
            <button class="num-btn">4</button>
            <button class="num-btn">4</button>
        </div>

        <div class="mb-4">
            <button class="op-btn" data-val="+">+</button>
            <button class="op-btn" data-val="-">-</button>
            <button class="op-btn" data-val="*">×</button>
            <button class="op-btn" data-val="/">÷</button>
            <button class="op-btn bracket" data-val="(">(</button>
            <button class="op-btn bracket" data-val=")">)</button>
            
            <div id="advanced-ops" style="margin-top: 10px;">
                <button class="op-btn advanced" data-val="sqrt(">√</button>
                <button class="op-btn advanced" data-val="!">!</button>
                <button class="op-btn advanced" data-val="^">^</button>
                <button class="op-btn advanced" data-val=".">.</button>
            </div>
        </div>

        <div>
            <button id="clear-btn" class="btn btn-warning btn-lg fw-bold px-4 text-dark">Clear</button>
            <button id="check-btn" class="btn btn-success btn-lg fw-bold px-4 ms-2">Check</button>
        </div>
        
        <div id="feedback" class="mt-4 fs-4 fw-bold"></div>

      </div>
    </div>
  </div>

  <script type="text/javascript">
    var questionID = '<?php echo $question; ?>';
    
    // Level Configuration Variables
    var currentLevel = 1;
    var successesInLevel = 0;
    var maxSuccessesPerLevel = 4;
    var currentTarget = 0;
    var exprStr = "";

    // Define the ranges for each level
    function getLevelRange(lvl) {
        if (lvl === 1) return {min: 1, max: 10};
        if (lvl === 2) return {min: 11, max: 30};
        if (lvl === 3) return {min: 31, max: 50};
        if (lvl === 4) return {min: 51, max: 100};
        return {min: 1, max: 10}; // Fallback
    }

    // Generate a random target based on the current level's range
    function generateTarget() {
        var range = getLevelRange(currentLevel);
        var newTarget = Math.floor(Math.random() * (range.max - range.min + 1)) + range.min;
        
        // Prevent the exact same number from appearing twice in a row
        if (newTarget === currentTarget && (range.max - range.min > 0)) {
            return generateTarget(); 
        }
        return newTarget;
    }
    
    // Generate the star string using explicit CSS colors to avoid outline-star rendering bugs
    function getStarsHTML(earned) {
        let starsHTML = "";
        for(let i = 0; i < maxSuccessesPerLevel; i++) {
            if(i < earned) {
                // Bright gold, solid star
                starsHTML += '<span style="color: #ffc107; text-shadow: 1px 1px 2px rgba(0,0,0,0.3); letter-spacing: 3px;">★</span>';
            } else {
                // Dim grey, solid star
                starsHTML += '<span style="color: #dee2e6; letter-spacing: 3px;">★</span>';
            }
        }
        return '<span class="fs-5">' + starsHTML + '</span>';
    }

    // Visually update the UI badges to track progress
    function updateLevelUI() {
        for (let i = 1; i <= 4; i++) {
            let badge = $('#lvl-' + i);
            let starsSpan = $('#stars-' + i);
            badge.removeClass('level-active level-locked level-greyed');
            
            if (i < currentLevel) {
                // Completed Levels
                badge.addClass('level-greyed');
                starsSpan.html(getStarsHTML(4));
            } else if (i === currentLevel) {
                // Active Level 
                badge.addClass('level-active');
                starsSpan.html(getStarsHTML(successesInLevel));
            } else {
                // Locked Future Levels
                badge.addClass('level-locked');
                starsSpan.html('<small>Locked</small>');
            }
        }
    }

    function initLevel() {
        currentTarget = generateTarget();
        $('#target-box').text(currentTarget);
        updateLevelUI();
        clearExpr();
    }

    function clearExpr() {
        exprStr = "";
        $('#expr-display').text('');
        $('.num-btn').prop('disabled', false);
    }

    function updateDisplay() {
        // Formats the math syntax into user-friendly symbols on screen
        let displayStr = exprStr.replace(/\*/g, '×').replace(/\//g, '÷').replace(/sqrt\(/g, '√(');
        $('#expr-display').text(displayStr);
    }

    $(document).ready(function() {
        initLevel();

        $('.num-btn').click(function() {
            exprStr += "4"; // Appends another 4. Clicking twice creates "44" natively!
            updateDisplay();
            $(this).prop('disabled', true);
        });

        $('.op-btn').click(function() {
            exprStr += $(this).data('val');
            updateDisplay();
        });

        $('#clear-btn').click(function() {
            clearExpr();
            $('#feedback').text('');
        });

        $('#check-btn').click(function() {
            if ($('.num-btn:disabled').length !== 4) {
                $('#feedback').html('<span class="text-danger">You must use exactly four 4s!</span>');
                return;
            }
            try {
                // Parse the string dynamically
                let result = math.evaluate(exprStr);
                
                // We add a tiny rounding fix just in case division/roots cause floating point issues
                let cleanResult = Math.round(result * 100000) / 100000;
                
                if (cleanResult === currentTarget) {
                    successesInLevel++; // Earn a star!
                    updateLevelUI(); // Instantly visually reward the star
                    
                    if (successesInLevel >= maxSuccessesPerLevel) {
                        currentLevel++;
                        successesInLevel = 0;
                        
                        if (currentLevel > 4) {
                            // WIN CONDITION: All levels beaten!
                            updateLevelUI(); 
                            $('#feedback').html('<span class="text-success fs-3">⭐ Champion! All Levels Conquered! ⭐</span>');
                            $('.num-btn, .op-btn').prop('disabled', true);
                            $('#clear-btn, #check-btn').prop('disabled', true);
                            
                            // Trigger your dashboard callbacks
                            if (typeof handleCorrectAnswer === "function") {
                                handleCorrectAnswer();
                            } else if (typeof processWin === "function") {
                                processWin(questionID);
                            } else {
                                setTimeout(() => alert("Well done, you've solved all levels!"), 500);
                            }
                        } else {
                            // Proceeding to the NEXT level
                            $('#feedback').html('<span class="text-success fs-4">Level Up! Moving to Level ' + currentLevel + '...</span>');
                            setTimeout(function() {
                                $('#feedback').text('');
                                initLevel();
                            }, 2000);
                        }
                    } else {
                        // Success on a standard target (but haven't finished the level yet)
                        $('#feedback').html('<span class="text-success fs-4">Correct! You earned a star! Loading next target...</span>');
                        setTimeout(function() {
                            $('#feedback').text('');
                            initLevel();
                        }, 1200);
                    }
                } else {
                    // Let them know what it actually calculated to
                    $('#feedback').html('<span class="text-danger">That equals ' + cleanResult + '. Try again!</span>');
                }
            } catch (e) {
                $('#feedback').html('<span class="text-danger">Invalid math expression. Check your brackets!</span>');
            }
        });
    });
  </script> 
</body>
</html>