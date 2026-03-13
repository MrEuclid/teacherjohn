<?php 
 $question = isset($_POST['question']) ? $_POST['question'] : 'Two Squares';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Two Squares Challenge</title>
  
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
    
    /* Canvas Styling */
    canvas {
      border: 3px solid #dee2e6;
      border-radius: 8px;
      background-color: #f8f9fa;
      box-shadow: 0 4px 8px rgba(0,0,0,0.05);
      margin-bottom: 20px;
      max-width: 100%;
    }

    #equation-display { font-size: 2.2em; margin: 20px 0; min-height: 60px; }
    
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
        
        <h3 class="fw-bold text-primary">Two Squares Challenge</h3>
        <p class="text-muted fs-5">Use the diagram to solve the equations below.</p>

        <div class="row justify-content-center">
            <div class="col-12">
                <canvas id="myCanvas" width="600" height="300">
                    Your browser does not support the HTML canvas tag.
                </canvas>
            </div>
        </div>

        <div id="equation-display"></div>

        <div id="play-area" class="row justify-content-center align-items-center mt-3">
          <div class="col-auto text-end"><label class="fs-3 fw-bold"><i style="font-family: serif;">x</i> + <i style="font-family: serif;">y</i> =</label></div>
          <div class="col-auto"><input type="number" id="solution1" class="form-control"></div>
          <div class="col-auto"><button id="check1" class="btn btn-primary btn-lg">Check</button></div>
        </div>
        
        <div id="feedback" class="mt-4 fs-5 fw-bold"></div>

      </div>
    </div>
  </div>

  <script type="text/javascript">
    var questionID = '<?php echo $question; ?>';
    var answer = [];
    var ctx;

    // --- HELPER FUNCTIONS ---
    function randomInteger(min, max) { 
        return Math.floor(Math.random() * (max - min + 1) + min);
    }

    // --- CANVAS DRAWING FUNCTIONS ---
    function drawLine(ptx1, pty1, ptx2, pty2) {
        ctx.beginPath();
        ctx.moveTo(ptx1, pty1);
        ctx.lineTo(ptx2, pty2);
        ctx.lineWidth = 4;
        ctx.strokeStyle = '#343a40'; // Dark grey baseline
        ctx.stroke();
    }

    function drawSquare(ptx1, pty1, side, fillColor, strokeColor) {
        ctx.beginPath();
        ctx.rect(ptx1, pty1, side, side);
        ctx.fillStyle = fillColor;
        ctx.fill();
        ctx.lineWidth = 3;
        ctx.strokeStyle = strokeColor;
        ctx.stroke();
    }

    function labelSquareSides(ptx, pty, letter) {
        ctx.font = "italic bold 26px serif"; // Math-style font
        ctx.fillStyle = "#212529";
        ctx.textAlign = "center";
        ctx.textBaseline = "middle";
        ctx.fillText(letter, ptx, pty);
    }

    function renderDiagram() {
        var c = document.getElementById("myCanvas");
        ctx = c.getContext("2d");

        let xmax = 600;
        let ymax = 300;
        
        // Clear canvas just in case
        ctx.clearRect(0, 0, xmax, ymax);

        let startY = ymax - 40;  
        let endY = ymax - 40;
        
        // Draw Baseline
        drawLine(20, startY, xmax - 20, endY);
        
        let sideA = 80;
        let sideB = 140;

        // Position Square A
        let startAX = 150;
        let startAY = startY - sideA;  

        // Position Square B (Adjacent)
        let startBX = startAX + sideA;   
        let startBY = startY - sideB;  

        // Draw Squares (Adding nice translucent fill colors)
        drawSquare(startAX, startAY, sideA, "rgba(13, 110, 253, 0.15)", "#0d6efd"); // Blue tint
        drawSquare(startBX, startBY, sideB, "rgba(25, 135, 84, 0.15)", "#198754");  // Green tint

        // Label Square A (x)
        labelSquareSides(startAX + sideA / 2, startY + 20, "x");  // Bottom
        labelSquareSides(startAX - 20, startAY + sideA / 2, "x"); // Left Side

        // Label Square B (y)
        labelSquareSides(startBX + sideB / 2, startY + 20, "y");  // Bottom
        labelSquareSides(startBX + sideB + 20, startBY + sideB / 2, "y"); // Right Side
    }

    // --- MATH GENERATOR ---
    function makeQuestion1() {
        let x = 0;
        let y = 0;
        let min = 2;
        let max = 10;


        while (x === y) {
            x = randomInteger(min, max);
            y = randomInteger(min, max);
        }

        let n = x * x + y * y;
        let solution = x + y;
        
        // Format nicely using MathJax
        let term = '\\( x^2 + y^2 = ' + n + ' \\)';
        $('#equation-display').html(term);
        
        if (typeof MathJax !== 'undefined') {
            MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation-display"]);
        }

        return solution;
    }

    // --- GAME LOGIC ---
    $(document).ready(function() {
        correct = 0;
        // 1. Draw the geometric diagram
        renderDiagram();

        // 2. Generate question and store answer
        answer[1] = makeQuestion1();

        // 3. Handle 'Check' Button Click
        $('#check1').click(function() {
            let guess = parseInt($('#solution1').val());

            if (isNaN(guess)) {
                $('#feedback').html('<span class="text-danger">Please enter a number.</span>');
                return;
            }

            if (guess === answer[1]) {
                // Correct styling
                $('#solution1').prop('disabled', true).css({"background-color": "lightgreen", "color": "black"});
                $('#check1').hide();
                $('#feedback').html('<span class="text-success fw-bold fs-4">⭐ Correct! ⭐</span>');
                
                // Trigger dashboard logic
                if (typeof handleCorrectAnswer === "function") {
                    handleCorrectAnswer();
                } else if (typeof processWin === "function") {
                    processWin(questionID);
                } else {
                    // Fallback
                    setTimeout(function() { alert("Great job! You solved it."); }, 500);
                }
            } else {
                // Incorrect styling
                $('#feedback').html('<span class="text-danger">Not quite. Try again!</span>');
                $('#solution1').val('').focus();
            }
        });

        // 4. Allow pressing Enter to submit
        $('#solution1').keypress(function(e) {
            if(e.which == 13) { 
                $('#check1').click(); 
            }
        });
    });
  </script> 
</body>
</html>