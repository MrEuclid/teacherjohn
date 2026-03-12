<?php 
 $question = isset($_POST['question']) ? $_POST['question'] : 'Delta Challenge';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Progressive BODMAS Substitution</title>
  
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
    .variables-box { 
        background-color: #e9ecef; 
        border: 2px solid #0d6efd; 
        border-radius: 8px; 
        padding: 15px; 
        margin-bottom: 20px;
    }
    #equation-display { font-size: 2.2em; margin: 30px 0; min-height: 80px; }
    input {
      text-align: center; 
      background-color: lightgreen; 
      font-size: 1.5em; 
      font-weight: bold;
      width: 5em;
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 game-container">
        
        <h3 class="fw-bold text-success">Substitution Gauntlet</h3>
        
        <div class="variables-box shadow-sm">
            <h5 class="text-muted mb-3">Use these values to solve the equations:</h5>
            <div class="d-flex justify-content-evenly fs-3 fw-bold text-primary">
                <div><i style="font-family: serif; color: black;">a</i> = <span id="val-a"></span></div>
                <div><i style="font-family: serif; color: black;">b</i> = <span id="val-b"></span></div>
                <div><i style="font-family: serif; color: black;">c</i> = <span id="val-c"></span></div>
                <div><i style="font-family: serif; color: black;">d</i> = <span id="val-d"></span></div>
            </div>
        </div>

        <p class="text-muted fs-5" id="level-indicator">Level 1 of 4</p>

        <div id="equation-display"></div>

        <div id="play-area" class="row justify-content-center align-items-center mt-4">
          <div class="col-auto text-end"><label class="fs-3 fw-bold">Answer =</label></div>
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

    // Global variables for the math
    var a, b, c, d;

    // --- HELPER FUNCTIONS ---
    function randomInteger(min, max) { 
        return Math.floor(Math.random() * (max - min + 1) + min);
    }

    // --- MATH GENERATORS ---

    // Level 1: (a + b) - (c + d)
    function makeQuestion1() {
        let x = (a + b) - (c + d);
        let expr = '\\( (a + b) - (c + d) = \\)';
        return { equation: expr, solution: x };
    }

    // Level 2: (a - b) - (c - d)
    function makeQuestion2() {
        let x = (a - b) - (c - d);
        let expr = '\\( (a - b) - (c - d) = \\)';
        return { equation: expr, solution: x };
    }

    // Level 3: (a^2 - d^2) - (b^2 - c^2)
    function makeQuestion3() {
        let x = (a*a - d*d) - (b*b - c*c);
        let expr = '\\( (a^2 - d^2) - (b^2 - c^2) = \\)';
        return { equation: expr, solution: x };
    }

    // Level 4: (a - d)^3 + (b - c)^3
    function makeQuestion4() {
        let x = Math.pow((a - d), 3) + Math.pow((b - c), 3);
        let expr = '\\( (a - d)^3 + (b - c)^3 = \\)';
        return { equation: expr, solution: x };
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
        // 1. Generate the constants ONCE at the start of the game
        a = randomInteger(5, 20);
        b = randomInteger(5, 10);
        c = randomInteger(5, 20);
        d = randomInteger(5, 20);

        // 2. Display the constants in the banner
        $('#val-a').text(a);
        $('#val-b').text(b);
        $('#val-c').text(c);
        $('#val-d').text(d);

        // 3. Kick off the first question
        loadNextLevel();

        // 4. Handle clicks
        $('#check-btn').click(function() {
            // Some answers can be negative, so we parse as float
            let guess = parseFloat($('#user-answer').val());
            
            if (isNaN(guess)) {
                $('#feedback').html('<span class="text-danger">Please enter a number.</span>');
                return;
            }

            if (guess === currentSolution) {
                currentLevel++; // Advance level
                
                if (currentLevel < 4) {
                    $('#feedback').html('<span class="text-success">Correct! Loading next level...</span>');
                    setTimeout(loadNextLevel, 800); 
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