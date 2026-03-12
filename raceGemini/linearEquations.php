<?php 
 $question = isset($_POST['question']) ? $_POST['question'] : 'Delta Challenge';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Progressive Linear Equations</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"></script>

  <script type="text/x-mathjax-config">
    MathJax.Hub.Config({
      extensions: ["tex2jax.js"],
      jax: ["input/TeX","output/HTML-CSS"],
      tex2jax: {inlineMath: [["$","$"],["\\(","\\)"]]}
    });
  </script>   
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.7/MathJax.js"></script>
  <script src="javascript/utilities.js"></script>

  <style>
    .game-container { text-align: center; margin-top: 20px; }
    #equation-display { font-size: 2.2em; margin: 30px 0; min-height: 80px; }
    input {
      text-align: center; 
      background-color: lightgreen; 
      font-size: 1.5em; 
      font-weight: bold;
      width: 4em;
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 game-container">
        
        <h3 class="fw-bold text-primary">Find <i style="font-family: serif;">x</i></h3>
        <p class="text-muted fs-5" id="level-indicator">Level 1 of 3</p>

        <div id="equation-display"></div>

        <div id="play-area" class="row justify-content-center align-items-center mt-4">
          <div class="col-auto text-end"><label class="fs-3 fw-bold"><i style="font-family: serif;">x</i> =</label></div>
          <div class="col-auto"><input type="number" id="user-answer" class="form-control" step="any"></div>
          <div class="col-auto"><button id="check-btn" class="btn btn-primary btn-lg">Check</button></div>
        </div>
        
        <div id="feedback" class="mt-4 fs-5 fw-bold"></div>

      </div>
    </div>
  </div>

  <script type="text/javascript">
    var questionID = '<?php echo $question; ?>';
    var currentLevel = 0;
    var currentSolution = null;

    // --- HELPER FUNCTIONS ---
    function randomInteger(min, max) { 
        return Math.floor(Math.random() * (max - min + 1) + min);
    }

    function gcd(a, b) {
        a = Math.abs(a);
        b = Math.abs(b);
        if (b) {
            return gcd(b, a % b);
        } else {
            return Math.abs(a);
        }
    }

    // --- MATH GENERATORS ---

    // Level 1: ax + c = bx + d
    function makeQuestion1() {
        let a, b, c, d, x;
        let valid = false;

        while (!valid) {
            a = randomInteger(1, 100);
            b = randomInteger(1, 100);
            c = randomInteger(1, 100);
            d = randomInteger(1, 100);

            if (a !== b) {
                let p = (d - c) / (a - b);
                // Condition: x is an integer, and the layout looks balanced
                if (Number.isInteger(p) && (a + 10 > b) && (c + 10 > 10)) {
                    x = p;
                    valid = true;
                }
            }
        }

        let expr = '\\( ' + a + 'x + ' + c + ' = ' + b + 'x + ' + d + ' \\)';
        return { equation: expr, solution: x };
    }

    // Level 2: 1/x + a/b = c/d
    function makeQuestion2() {
        let a, b, c, d, x;
        let valid = false;

        while (!valid) {
            a = randomInteger(1, 20);
            b = randomInteger(1, 20);
            c = randomInteger(1, 20);
            d = randomInteger(1, 20);

            let num = b * d;
            let den = (b * c) - (a * d);

            if (den !== 0) {
                let p = num / den;
                // Condition: x is integer, fractions are proper (a<b, c<d), and numerator/denominator are coprime
                if (Number.isInteger(p) && a < b && c < d && gcd(num, den) === 1) {
                    x = p;
                    valid = true;
                }
            }
        }

        let expr = '\\( \\frac{1}{x} + \\frac{' + a + '}{' + b + '} = \\frac{' + c + '}{' + d + '} \\)';
        return { equation: expr, solution: x };
    }

    // Level 3: x(x+1) = m
    function makeQuestion3() {
        let x = randomInteger(5, 15);
        let m = x * (x + 1);

        // Added (x > 0) so the student knows to ignore the negative root!
        let expr = '\\( x(x+1) = ' + m + ' \\) &nbsp;&nbsp; \\text{(where } x > 0 \\text{)}';
        return { equation: expr, solution: x };
    }

    // --- GAME LOGIC ---
    function loadNextLevel() {
        let qData;
        if (currentLevel === 0) qData = makeQuestion1();
        else if (currentLevel === 1) qData = makeQuestion2();
        else if (currentLevel === 2) qData = makeQuestion3();

        currentSolution = qData.solution;
        
        $('#level-indicator').text(`Level ${currentLevel + 1} of 3`);
        $('#equation-display').html(qData.equation);
        $('#user-answer').val('').focus();
        $('#feedback').text('');

        // Instruct MathJax to re-render the new equation beautifully
        if (typeof MathJax !== 'undefined') {
            MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation-display"]);
        }
    }

    $(document).ready(function() {
        // Kick off the first question
        loadNextLevel();

        $('#check-btn').click(function() {
            // Using parseFloat in case answers require decimals
            let guess = parseFloat($('#user-answer').val());
            
            if (isNaN(guess)) {
                $('#feedback').html('<span class="text-danger">Please enter a number.</span>');
                return;
            }

            if (guess === currentSolution) {
                currentLevel++; // Advance level
                
                if (currentLevel < 3) { // 3 levels for this gauntlet
                    $('#feedback').html('<span class="text-success">Correct! Loading next level...</span>');
                    setTimeout(loadNextLevel, 800); 
                } else {
                    // Won all levels
                    $('#level-indicator').text("Gauntlet Complete!");
                    $('#equation-display').html('<span class="text-success fw-bold">⭐ All Equations Solved! ⭐</span>');
                    $('#play-area').hide();
                    $('#feedback').text("");
                    
                    if (typeof handleCorrectAnswer === "function") {
                        handleCorrectAnswer();
                    } else if (typeof processWin === "function") {
                        processWin(questionID);
                    } else {
                        alert("Great job! You answered all questions correctly.");
                    }
                }
            } else {
                $('#feedback').html('<span class="text-danger">Not quite. Try again!</span>');
                $('#user-answer').val('').focus();
            }
        });

        // Allow pressing Enter to check answer
        $('#user-answer').keypress(function(e) {
            if(e.which == 13) { 
                $('#check-btn').click(); 
            }
        });
    });
  </script>
</body>
</html>