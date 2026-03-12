<?php 
 $question = isset($_POST['question']) ? $_POST['question'] : '';
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
    #equation-display { font-size: 2.5em; margin: 30px 0; min-height: 80px; }
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
        
        <h3 class="fw-bold text-primary">Linear Equations Gauntlet</h3>
        <p class="text-muted fs-5" id="level-indicator">Level 1 of 4</p>

        <div id="equation-display"></div>

        <div id="play-area" class="row justify-content-center align-items-center mt-4">
         <div class="col-auto text-end"><label class="fs-3 fw-bold"><i style="font-family: serif;">x</i> =</label></div>
          <div class="col-auto"><input type="number" id="user-answer" class="form-control"></div>
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

    // --- MATH GENERATORS ---
    function gcd(x, y) {
        x = Math.abs(x); y = Math.abs(y);
        while (y) { let t = y; y = x % y; x = t; }
        return x;
    }

    function gcd3(a, b, c) { return gcd(a, gcd(b, c)); }

    function getRandomCoefficient() {
        let val = 0;
        while (val >= -1 && val <= 1) { 
            val = Math.floor(Math.random() * 21) - 10; 
        }
        return val;
    }

    // Level 1: ax + b = c
    function generateLevel1() {
        let a, b, c, x; let valid = false;
        while (!valid) {
            a = getRandomCoefficient(); b = getRandomCoefficient(); c = getRandomCoefficient();
            if ((c - b) % a === 0 && c !== b && gcd3(a, b, c) === 1) {
                x = (c - b) / a; valid = true;
            }
        }
        let signB = b > 0 ? "+" : "-";
        return { equation: `\\( ${a}x ${signB} ${Math.abs(b)} = ${c} \\)`, solution: x };
    }

    // Level 2: a(x + b) + c = d
    function generateLevel2() {
        let a, b, c, d, x; let valid = false;
        while (!valid) {
            a = getRandomCoefficient(); b = getRandomCoefficient(); c = getRandomCoefficient(); d = getRandomCoefficient();
            if ((d - c) % a === 0) {
                x = ((d - c) / a) - b;
                if (x !== 0) valid = true;
            }
        }
        let signB = b > 0 ? "+" : "-"; let signC = c > 0 ? "+" : "-";
        return { equation: `\\( ${a}(x ${signB} ${Math.abs(b)}) ${signC} ${Math.abs(c)} = ${d} \\)`, solution: x };
    }

    // Level 3: x/a + b = c
    function generateLevel3() {
        let a, b, c, x; let valid = false;
        while (!valid) {
            a = getRandomCoefficient(); b = getRandomCoefficient(); c = getRandomCoefficient();
            if (c !== b) { x = a * (c - b); valid = true; }
        }
        let signB = b > 0 ? "+" : "-";
        let termX = a < 0 ? `-\\frac{x}{${Math.abs(a)}}` : `\\frac{x}{${a}}`;
        return { equation: `\\( ${termX} ${signB} ${Math.abs(b)} = ${c} \\)`, solution: x };
    }

    // Level 4: (x+a)/(x+c) = d
    function generateLevel4() {
        let a, c, d, x; let valid = false;
        while (!valid) {
            a = getRandomCoefficient(); c = getRandomCoefficient(); d = getRandomCoefficient();
            if ((d * c - a) % (1 - d) === 0) {
                x = (d * c - a) / (1 - d);
                if (x !== 0 && (x + c) !== 0) valid = true;
            }
        }
        let signA = a > 0 ? "+" : "-"; let signC = c > 0 ? "+" : "-";
        return { equation: `\\( \\frac{x ${signA} ${Math.abs(a)}}{x ${signC} ${Math.abs(c)}} = ${d} \\)`, solution: x };
    }

    // --- GAME LOGIC ---
    function loadNextLevel() {
        let qData;
        if (currentLevel === 0) qData = generateLevel1();
        else if (currentLevel === 1) qData = generateLevel2();
        else if (currentLevel === 2) qData = generateLevel3();
        else if (currentLevel === 3) qData = generateLevel4();

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
            let guess = parseInt($('#user-answer').val());
            
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
                    $('#equation-display').html('<span class="text-success fw-bold">⭐ All Levels Cleared! ⭐</span>');
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