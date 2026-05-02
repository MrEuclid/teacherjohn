<?php 
 $question = isset($_POST['question']) ? $_POST['question'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Progressive 4 Equations Middle</title>
  
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
        
        <h3 class="fw-bold text-success">Solve the Equations</h3>
        <p class="text-muted fs-5" id="level-indicator">Level 1 of 4</p>

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
        if (b) {
            return gcd(b, a % b);
        } else {
            return Math.abs(a);
        }
    }

    // --- MATH GENERATORS ---

    // Level 1: Pythagorean 
    function makeQuestion1() {
        var a = 0;
        while (a % 2 == 0) {
            a = randomInteger(7,20);
        }
        var c = parseInt(a*a + 1)/2;
        var b = Math.sqrt(c*c - a*a);

        // Format: \sqrt{a^2 + b^2} = 
        var expr = '\\( \\sqrt{' + a + '^2 + ' + b + '^2} \\)';
        return { equation: expr, solution: c };
    }

    // Level 2: Rational Equation
    function makeQuestion2() {
        var b = randomInteger(7,30);
        var m = 1;
        var a = b + m;

        var diff = parseInt(a-b);
        var product = a*b;
        var x = product / diff;

        // Format: 1/a + 1/x = 1/b
        var expr = '\\( \\frac{1}{' + a + '} + \\frac{1}{x} = \\frac{1}{' + b + '} \\)';
        return { equation: expr, solution: x };
    }

    // Level 3: Ratio and Sum
    function makeQuestion3() {
        var a = 8;
        var b = 8;

        // get a/b as a reduced fraction
        while (a == b) {
            a = randomInteger(10,25);
            b = randomInteger(5,20);
            var g = gcd(a,b);
            a = a / g;
            b = b / g;
        }
          
        var sum = parseInt(a + b);
        var m = randomInteger(7,20);
        var z = m * sum; // z is a multiple of a + b
        var x = m * a; 
     
        // Format: x/y = a/b and x + y = z
        var expr = '\\( \\frac{x}{y} = \\frac{' + a + '}{' + b + '} \\) &nbsp;&nbsp; and &nbsp;&nbsp; \\( x + y = ' + z + ' \\)';
        return { equation: expr, solution: x };
    }

    // Level 4: Triangular Numbers
    function makeQuestion4() {
       var n = randomInteger(19,45);
       var s = +(n/2)*(n+1);

       // Format: (x/2)(x + 1) = s
       var expr = '\\( \\frac{x}{2} (x + 1) = ' + s + ' \\) &nbsp;&nbsp; and x > 0 ';
       return { equation: expr, solution: n };
    }


    // --- GAME LOGIC ---
    function loadNextLevel() {
        let qData;
        if (currentLevel === 0) qData = makeQuestion1();
        else if (currentLevel === 1) qData = makeQuestion2();
        else if (currentLevel === 2) qData = makeQuestion3();
        else if (currentLevel === 3) qData = makeQuestion4();

        currentSolution = qData.solution;
        
        $('#level-indicator').text(`Level ${currentLevel + 1} of 4`);
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
            // Using parseFloat in case any answers require decimals
            let guess = parseFloat($('#user-answer').val());
            
            if (isNaN(guess)) {
                $('#feedback').html('<span class="text-danger">Please enter a number.</span>');
                return;
            }

            if (guess === currentSolution) {
                currentLevel++; // Advance level
                
                if (currentLevel < 4) {
                    $('#feedback').html('<span class="text-success">Correct! Loading next level...</span>');
                    setTimeout(loadNextLevel, 800); // Brief pause so they see they got it right
                } else {
                    // Won all 4 levels
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