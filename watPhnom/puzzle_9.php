<?php 
 $question = isset($_POST['question']) ? $_POST['question'] : 'Puzzle 9';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Race to Wat Phnom - Puzzle 9</title>
  
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
  
  <script src="wat.js"></script>  
</head>

<body>

  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12 col-md-9 col-lg-6" style="text-align: center; margin-top: 20px;">
        
          <img id="picture" src="" alt="Location Image" style="max-width: 100%; max-height: 250px; border-radius: 12px; margin-bottom: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); display: none;">
          
          <h2 class="fw-bold text-primary" id="location-9"></h2>
          <p class="text-muted fs-5" id="description-9"></p>
          <h3 class="fw-bold text-dark mt-4" id="title-9"></h3>
          
          <div class="mt-4 mb-3">
             <div id="question-9" style="font-size: 1.5em; background: #f8f9fa; border: 3px dashed #ced4da; border-radius: 12px; padding: 20px;"></div>
          </div>
          
          <div id="answer-9" class="d-flex justify-content-center align-items-center gap-3 mt-4 mb-4 flex-wrap">
              <label id="label-9a" class="fs-2 fw-bold">a =</label>
              <input id="input-9a" type="text" class="form-control fw-bold" style="width: 80px; height: 60px; font-size: 1.8em; text-align: center; border: 2px solid #ced4da; border-radius: 10px;">
             
              <label id="label-9b" class="fs-2 fw-bold">b =</label>  
              <input id="input-9b" type="text" class="form-control fw-bold" style="width: 80px; height: 60px; font-size: 1.8em; text-align: center; border: 2px solid #ced4da; border-radius: 10px;">

              <label id="label-9c" class="fs-2 fw-bold">c =</label>  
              <input id="input-9c" type="text" class="form-control fw-bold" style="width: 80px; height: 60px; font-size: 1.8em; text-align: center; border: 2px solid #ced4da; border-radius: 10px;">
              
              <button id="check-btn" class="btn btn-primary btn-lg px-4 fw-bold shadow-sm" style="height: 60px; margin-left: 10px;">Check</button>
          </div>

          <div id="comment-9" class="mt-4 fs-4 fw-bold"></div>
          <div id="visited" class="mt-4"></div>

      </div>
    </div>
  </div> 

<script type="text/javascript">
  $(document).ready(function() {

      // 1. Setup the Puzzle Data
      window.solved = window.solved || []; 
      
      // Pick 3 random distinct primes for a, b, and c
      const primesPool = [2, 3, 5, 7, 11, 13, 17];
      let shuffled = primesPool.sort(() => 0.5 - Math.random());
      const a = shuffled[0];
      const b = shuffled[1];
      const c = shuffled[2];
      
      // Store correct answers in an array so order doesn't matter when they guess
      const targetPrimes = [a, b, c].sort((x, y) => x - y);

      const myDenominator = a * b * c;
      const myNumerator = (a * b) + (a * c) + (b * c);

      // 2. Build the UI
      const photo = "images/nationalMuseum.jpg";
      const location = "The National Museum";
      const description = 'If you want to learn about the history of Cambodia, this is the place to go!';  
      const title = "Question 9";
     
      $("#picture").attr("src", photo).show();  
      $('#location-9').text(location);
      $('#description-9').text(description);
      $('#title-9').text(title).hide(); 
      
      const questionHtml = `Find a, b and c. <br><br>
      $ \\frac{1}{a} + \\frac{1}{b} + \\frac{1}{c}  = \\frac{${myNumerator}}{${myDenominator}} $<br><br>
      a, b and c are all prime numbers.`;
      
      $('#question-9').html(questionHtml);

      // Render MathJax
      MathJax.Hub.Queue(["Typeset", MathJax.Hub, "question-9"]);

      // 3. Interaction Logic (Read inputs ONLY when clicked!)
      $('#check-btn').off('click').on('click', function() {
          const guessA = parseInt($('#input-9a').val());
          const guessB = parseInt($('#input-9b').val());
          const guessC = parseInt($('#input-9c').val());

          if (isNaN(guessA) || isNaN(guessB) || isNaN(guessC)) {  
              $('#comment-9').html('<span class="text-danger">Please enter a valid number in all boxes!</span>');
              return;
          }

          // Sort user guesses so it doesn't matter which box they put which prime in
          let userGuesses = [guessA, guessB, guessC].sort((x, y) => x - y);

          // Check if their guesses match the target primes
          if (userGuesses[0] === targetPrimes[0] && 
              userGuesses[1] === targetPrimes[1] && 
              userGuesses[2] === targetPrimes[2]) {
              
              // SUCCESS
              $('#comment-9').html('<span class="text-success fs-3">⭐ Correct! ⭐</span>');
              
              if (typeof window.solved !== 'undefined') {
                  window.solved[9] = 1;
              }
              
              // Add thumbnail
              if ($('#visited').length) {
                  $('#visited').append('<img src="' + photo + '" style="width: 100px; border-radius: 8px; margin-top: 15px; border: 2px solid #198754; margin-right: 5px;" title="' + location + '">');
              }
              
              if (typeof displayUnsolved === "function") {
                  displayUnsolved();
              }
              
              // Lock inputs (Fixed the selector syntax)
              $('[id^="input-9"]').prop('disabled', true).css({"background-color": "lightgreen", "color": "black"});
              $(this).hide(); 
              
              var questionID = '<?php echo $question; ?>';
              if (typeof processWin === "function") {
                  processWin(questionID);
              }
              
         } else {
            // FAILURE
            $('#comment-9').html(`<span class="text-danger">Incorrect! Keep trying!</span>`);

            // Wiggle animation (Fixed the selector syntax)
            $('[id^="input-9"]').animate({marginLeft: '-10px'}, 100).animate({marginLeft: '10px'}, 100).animate({marginLeft: '0'}, 100);
        }
      });
  });
</script>

</body>
</html>