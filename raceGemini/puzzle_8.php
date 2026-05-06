<?php 
 $question = isset($_POST['question']) ? $_POST['question'] : '8';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cubic Equations Puzzle</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script type="text/x-mathjax-config">
    MathJax.Hub.Config({
      extensions: ["tex2jax.js"],
      jax: ["input/TeX","output/HTML-CSS"],
      tex2jax: {inlineMath: [["$","$"],["\\(","\\)"]]}
    });
  </script>   
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.7/MathJax.js"></script>
</head>

<body>
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12 col-md-10 col-lg-8" style="text-align: center; margin-top: 20px;">
          
          <h3 class="fw-bold text-primary">Solve the Equations</h3>
          <p class="text-muted fs-5">Find the sum of the hidden variables.</p>
          
          <div class="mt-4 mb-3">
            <div id="question-8" style="font-size: 1.5em; background: #f8f9fa; border: 3px dashed #ced4da; border-radius: 12px; padding: 20px;"></div>
          </div>

          <div id="answer-8" class="d-flex justify-content-center align-items-center gap-3 mt-4 mb-4">
            <label id="label-8a" class="fs-2 fw-bold">m + n = </label>
            <input id="input-8a" type="text" class="form-control fw-bold" style="width: 150px; height: 60px; font-size: 1.8em; text-align: center; background-color: lightyellow; border: 2px solid #198754; border-radius: 10px; color: #000;" placeholder="?">
            
            <button id="check-btn" class="btn btn-primary btn-lg px-5 fw-bold shadow-sm">Check</button>
          </div>

          <div id="comment-8" class="mt-4 fs-4 fw-bold"></div>
      </div>
    </div>
  </div> 

<script type="text/javascript">
  $(document).ready(function() {

      // Utility function to replace wat.js dependency
      function getRandomInt(min, max) {
          return Math.floor(Math.random() * (max - min + 1) + min);
      }

      // 1. Generate the random variables
      var m = getRandomInt(11, 20);
      var n = getRandomInt(3, 10);
      
      var x = (m * m * m) + (n * n * n);
      var y = (m * m * m) - (n * n * n);

      console.log("Answers:", m, n, "Total:", m + n);

      // 2. Build the question string
      var question = 'Find $m$ and $n$ using the equations:<br><br>' +
                     '$m^3 + n^3 = ' + x + '$<br>' +
                     '$m^3 - n^3 = ' + y + '$';

      $('#question-8').html(question);
       
      // Queue MathJax safely
      if (typeof MathJax !== 'undefined' && MathJax.Hub) {
          MathJax.Hub.Queue(["Typeset", MathJax.Hub, "question-8"]);
      }

      // 3. Interaction & Dashboard Logic
      $('#check-btn').off('click').on('click', function() {
          const guessN = parseInt($('#input-8a').val().trim());
          
          if (isNaN(guessN)) {
              $('#comment-8').html('<span class="text-danger">Please enter a valid number!</span>');
              return;
          }

          if (guessN === (m + n)) {
              // SUCCESS
              $('#comment-8').html('<span class="text-success fs-3">⭐ Well done, solved! ⭐</span>');
              
              // Lock inputs and turn green
              $('#input-8a').prop('disabled', true).css({"background-color": "lightgreen", "color": "black"});
              $(this).hide(); 
              
              // Trigger the Maths Competition Dashboard 
              if (typeof handleCorrectAnswer === "function") {
                  handleCorrectAnswer();
              } else {
                  setTimeout(() => alert("Well done, solved!"), 500);
              }
              
          } else {
              // FAILURE 
              $('#comment-8').html('<span class="text-danger">Incorrect! Keep trying!</span>');
              
              // Wiggle animation
              $('#input-8a').animate({marginLeft: '-10px'}, 100).animate({marginLeft: '10px'}, 100).animate({marginLeft: '0'}, 100);
          }
      });
  });
</script>
</body>
</html>