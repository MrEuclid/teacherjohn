<?php 
 $question = isset($_POST['question']) ? $_POST['question'] : 'Four 4s Hard';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Four 4s Challenge - Grade 9</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"></script>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/11.8.0/math.min.js"></script>
  <script src="javascript/utilities.js"></script>

  <style>
    .game-container { text-align: center; margin-top: 20px; }
    
    #target-box {
        background-color: #dc3545; /* Red theme for hard mode */
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
        width: 55px;
        height: 55px;
        font-size: 1.8em;
        font-weight: bold;
        margin: 4px;
        border-radius: 50%;
        background-color: #198754;
        color: white;
        border: none;
        box-shadow: 0 4px 6px rgba(0,0,0,0.15);
    }
    .op-btn.bracket { background-color: #212529; }
    .op-btn.advanced { background-color: #6f42c1; } /* Purple for advanced math */
    .op-btn:active { transform: scale(0.95); }
  </style>
</head>

<body>
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 game-container">
        
        <h3 class="fw-bold text-danger mb-3">The Four 4s: Grade 9</h3>
        <p class="text-muted fs-5">Use exactly four 4s to make the target number.</p>
        
        <div id="target-box">1</div>

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
            <br>
            <button class="op-btn advanced mt-2" data-val="sqrt(">√</button>
            <button class="op-btn advanced mt-2" data-val="!">!</button>
            <button class="op-btn advanced mt-2" data-val="^">^</button>
            <button class="op-btn advanced mt-2" data-val=".">.</button>
        </div>

        <div>
            <button id="clear-btn" class="btn btn-warning btn-lg fw-bold px-4 text-dark">Clear</button>
            <button id="check-btn" class="btn btn-danger btn-lg fw-bold px-4 ms-2">Check</button>
        </div>
        
        <div id="feedback" class="mt-4 fs-4 fw-bold"></div>

      </div>
    </div>
  </div>
<script type="text/javascript">
    var questionID = '<?php echo $question; ?>';
    
    var maxTarget = 20;
    // Pick a random number between 1 and maxTarget
    var currentTarget = Math.floor(Math.random() * maxTarget) + 1; 
    var exprStr = "";

    function initLevel() {
        $('#target-box').text(currentTarget);
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
            exprStr += "4";
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
                // Parse the string dynamically (MathJS handles ! and sqrt perfectly natively)
                let result = math.evaluate(exprStr);
                
                if (result === currentTarget) {
                    $('#feedback').html('<span class="text-success fs-3">⭐ well done, solved ⭐</span>');
                    $('.num-btn, .op-btn').prop('disabled', true);
                    
                    if (typeof handleCorrectAnswer === "function") {
                        handleCorrectAnswer();
                    } else if (typeof processWin === "function") {
                        processWin(questionID);
                    } else {
                        setTimeout(() => alert("well done, solved"), 500);
                    }
                } else {
                    // Precision fix (math.evaluate('.4') might return floating point inaccuracies occasionally)
                    let cleanResult = Math.round(result * 100000) / 100000;
                    $('#feedback').html('<span class="text-danger">That equals ' + cleanResult + '. Try again!</span>');
                }
            } catch (e) {
                $('#feedback').html('<span class="text-danger">Invalid math expression. Did you close your brackets?</span>');
            }
        });
    });
  </script>
</body>
</html>