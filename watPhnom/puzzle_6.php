<?php 
 $question = isset($_POST['question']) ? $_POST['question'] : 'Puzzle 6';
?>

<?php
include "../connectTeacherJohn.php" ;
$query = "select UPPER(word) from spellingWords where level >= 6 AND LENGTH(word) = 6 ORDER BY RAND() LIMIT 1" ;
$result = mysqli_query($dbServer,$query) ;
$data = mysqli_fetch_array($result) ;
$word = $data[0] ;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Race to Wat Phnom - Puzzle 6</title>
  
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
  <script src="wat.js"></script>  
</head>
<body>

  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-6" style="text-align: center; margin-top: 20px;">
        
          <img id="picture" src="" alt="Location Image" style="max-width: 100%; max-height: 250px; border-radius: 12px; margin-bottom: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); display: none;">
          
          <h2 id="location-6" class="fw-bold text-primary"></h2>
          <p id="description-6" class="text-muted fs-5"></p>
          <h5 id="title-6" class="fw-bold text-dark mt-4"></h5>
          
          <div class="mt-4 mb-3">
            <div id="question-6" style="font-size: 1.5em; background: #f8f9fa; border: 3px dashed #ced4da; border-radius: 12px; padding: 20px;"></div>
          </div>

          <div id="answer-6" class="d-flex justify-content-center align-items-center gap-3 mt-4 mb-4">
            <label id="label-6a" class="fs-2 fw-bold"></label>
            <input id="input-6a" type="text" class="form-control fw-bold" style="width: 150px; height: 60px; font-size: 1.8em; text-align: center; background-color: lightgreen; border: 2px solid #198754; border-radius: 10px; color: #000;" placeholder="n = ?">
            <input id="hiddenN" type="hidden"> 
            <button id="check-btn" class="btn btn-primary btn-lg px-4 fw-bold shadow-sm" style="height: 60px;">Check Answer</button>
          </div>

          <div id="comment-6" class="mt-4 fs-4 fw-bold"></div>
          
          <div id="visited" class="mt-4"></div>

      </div>
    </div>
  </div> 

<script type="text/javascript">
  $(document).ready(function() {
      setupPuzzle6();
  });

  function setupPuzzle6() {
      // 1. Initialize State and Data
      window.solved = window.solved || []; 
      
      let n = getRandomInt(12, 20);
      
      // Ensure n is odd
      if (n % 2 === 0) { n = n + 1; }

      const m = Math.pow(2, n) - 1;
      $('#hiddenN').val(n);

      const location = "Central Market";
      const description = "The Central Market (Phsar Thmei) is a very beautiful building and there you will find many different shops. It is very popular with tourists and locals.";
      const title = "Question 6";
      const photo = "images/phsar_thmei.jpg";

      // 2. Build the UI
      $('#location-6').text(location);
      $("#picture").attr("src", photo).show();
      $('#description-6').text(description);
      $('#title-6').text(title).hide(); // Hidden to match puzzle 5 cleanliness, but available if needed
      
      const questionHtml = `Find the value of n that makes this equation true: <br><br>
                            $2^n - 1 = ${m.toLocaleString()}$ <br><br>
                            where $n$ is an odd number.`;
      
      $('#question-6').html(questionHtml);
      
      // Trigger MathJax to render the LaTeX content
      MathJax.Hub.Queue(["Typeset", MathJax.Hub, "question-6"]);

      // 3. Interaction Logic
      $('#check-btn').off('click').on('click', function() {
          const guessN = parseInt($('#input-6a').val());
          
          if (isNaN(guessN)) {
              $('#comment-6').html('<span class="text-danger">Please enter a valid number!</span>');
              return;
          }

          if (guessN === n) {
              // SUCCESS
              $('#comment-6').html('<span class="text-success fs-3">⭐ Correct! The exponent is ' + n + ' ⭐</span>');
              
              if (typeof solved !== 'undefined') {
                  solved[6] = 1;
              }
              
              // Add thumbnail
              if ($('#visited').length) {
                  $('#visited').append('<img src="' + photo + '" style="width: 100px; border-radius: 8px; margin-top: 15px; border: 2px solid #198754; margin-right: 5px;" title="' + location + '">');
              }
              
              if (typeof displayUnsolved === "function") {
                  displayUnsolved();
              }
              
              // Lock inputs
              $('#input-6a').prop('disabled', true).css({"background-color": "lightgreen", "color": "black"});
              $(this).hide(); // Hide the check button
              
              var questionID = '<?php echo $question; ?>';
              if (typeof processWin === "function") {
                  processWin(questionID);
              }
              
         } else {
            // Calculate what their guess actually equals
            const userResult = Math.pow(2, guessN) - 1;

            // FAILURE - Show their calculated value
            $('#comment-6').html(`<span class="text-danger">Incorrect! $2^{${guessN}} - 1 = ${userResult.toLocaleString()}$. Keep trying!</span>`);
            
            // Tell MathJax to render the new math equation in the comment box
            MathJax.Hub.Queue(["Typeset", MathJax.Hub, "comment-6"]);

            // Wiggle animation
            $('#input-6a').animate({marginLeft: '-10px'}, 100).animate({marginLeft: '10px'}, 100).animate({marginLeft: '0'}, 100);
        }
      });
  }
</script>
</body>
</html>