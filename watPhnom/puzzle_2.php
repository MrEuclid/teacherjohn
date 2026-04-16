<?php 
 $question = isset($_POST['question']) ? $_POST['question'] : '2';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Race to Wat Phnom - Puzzle 2</title>
  
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
  
  <script src="/raceGemini/javascript/utilities.js"></script>
  <script src="wat.js"></script>  
</head>
<body>

  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-6" style="text-align: center; margin-top: 20px;">
        
          <img id="picture" src="" alt="Location" style="max-width: 100%; max-height: 250px; border-radius: 12px; margin-bottom: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
          
          <h2 id="location-2" class="fw-bold text-primary"></h2>
          <p id="description-2" class="text-muted fs-5"></p>
          <h4 id="question-2" class="fw-bold text-dark mt-4"></h4>
          
          <div class="mt-3 mb-4">
            <label id="label-2a" style="font-size: 3em; font-weight: bold; color: #0d6efd;"></label>
          </div>

          <div id="answer-2" class="d-flex justify-content-center align-items-center mb-4">
            <input id="input-2a" type="number" class="form-control" style="width: 100px; height: 60px; font-size: 1.8em; text-align: center; background-color: lightgreen; border: 2px solid #198754; border-radius: 10px;">
            <label id="label-2b" style="font-size: 2.5em; font-weight: bold; margin: 0 15px;">×</label>  
            <input id="input-2b" type="number" class="form-control" style="width: 100px; height: 60px; font-size: 1.8em; text-align: center; background-color: lightgreen; border: 2px solid #198754; border-radius: 10px;">
            
            <input id="hidden2X" type="hidden">
            <input id="hidden2Y" type="hidden">
          </div>

          <button id="check-btn" class="btn btn-primary btn-lg px-5 fw-bold shadow-sm">Check Answer</button>

          <div id="comment-2" class="mt-4 fs-4 fw-bold"></div>
          
          <div id="visited" class="mt-4"></div>

      </div>
    </div>
  </div> 
  <script type="text/javascript">
  // FIX 1: Define the questionID variable dynamically from PHP!
  var questionID = '<?php echo $question; ?>';

  $(document).ready(function(){  

      // 1. GUARANTEED HTML LOADING 
      // We do this first so a math error doesn't break the UI
      var photo = "images/russianMarket.jpg";
      var locationName = "The Russian Market";
      var description = "A place where people go shopping. It is popular with tourists. It is called the Russian Market because in the 1980s it is where Russian tourists went shopping. The Khmer name is Psar Tuol Tompong.";  
      var questionText = "Find two prime numbers that multiply together to equal the target below:";
     
      $("#picture").attr("src", photo);  
      $('#location-2').text(locationName);
      $('#description-2').text(description);
      $('#question-2').text(questionText);

      // 2. MATH INITIALIZATION
      // Safeguard for the primes array
      if (typeof makePrimes === "function") {
          try { makePrimes(100); } catch(e) { console.log("makePrimes bypassed."); }
      }

      var prime1 = false;
      var n1 = 0;
      while (prime1 == false) {
          n1 = getRandomInt(30, 50);
          prime1 = isPrime(n1);
      }

      var prime2 = false;
      var n2 = 0;
      while (prime2 == false) {
          n2 = getRandomInt(n1 + 1, 75);
          prime2 = isPrime(n2);
      }

      var m = n1 * n2;
      
      $('#hidden2X').val(n1);
      $('#hidden2Y').val(n2);
      $('#label-2a').text(m + ' = ');

      // 3. THE BUTTON CLICK EVENT
      $('#check-btn').click(function() {
          var answerX = parseInt($('#input-2a').val());
          var answerY = parseInt($('#input-2b').val());

          if (isNaN(answerX) || isNaN(answerY)) {
              $('#comment-2').html('<span class="text-danger">Please enter a number in both boxes!</span>');
              return;
          }

          var pX = isPrime(answerX);
          var pY = isPrime(answerY);

          if (!pX || !pY) {
              $('#comment-2').html('<span class="text-danger">Both numbers must be prime numbers!</span>');
              return;
          }
          
          var solution = answerX * answerY;

          // FIX 2 & 3: Cleaned up the if/else logic and changed IDs to '2'
          if (solution === m) {
              // Success Measure
              $('#comment-2').html('<span class="text-success fs-3">⭐ Correct! ' + m + ' = ' + answerX + ' × ' + answerY + ' ⭐<br><small class="text-muted">Redirecting to dashboard...</small></span>');
              
              $('#input-2a, #input-2b').prop('disabled', true).css({"background-color": "lightgreen", "color": "black"});
              $(this).hide(); // Hide check button
              
              // FORCE the browser to send the DYNAMIC win signal after a 2-second delay
              setTimeout(function() {
                  window.location.href = "dashboard.php?win=" + questionID;
              }, 2000);

          } else { 
              // Failure Measure
              $('#comment-2').html('<span class="text-danger">That equals ' + solution + '. Keep trying!</span>');
              
              // Shake effect on wrong answer
              $('#input-2a, #input-2b').animate({marginLeft: '-10px'}, 100).animate({marginLeft: '10px'}, 100).animate({marginLeft: '0'}, 100);
          }
      });

  });
  </script>
</body>
</html>