<?php 
 $question = isset($_POST['question']) ? $_POST['question'] : 'Puzzle 3';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Race to Wat Phnom - Puzzle 3</title>
  
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
        
          <img id="picture" src="" alt="Location" style="max-width: 100%; max-height: 250px; border-radius: 12px; margin-bottom: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
          
          <h2 id="location-3" class="fw-bold text-primary"></h2>
          <p id="description-3" class="text-muted fs-5"></p>
          <h4 id="question-3" class="fw-bold text-dark mt-4"></h4>
          
          <div class="mt-3 mb-4">
            <label id="label-3a" style="font-size: 2.5em; font-weight: bold; color: #0d6efd;"></label>
          </div>

          <div id="answer-3" class="d-flex justify-content-center align-items-center mb-4">
            <input id="input-3a" type="number" class="form-control" style="width: 120px; height: 60px; font-size: 1.8em; text-align: center; background-color: lightgreen; border: 2px solid #198754; border-radius: 10px;" placeholder="Answer">
            
            <input id="hidden3Val" type="hidden">
          </div>

          <button id="check-btn" class="btn btn-primary btn-lg px-5 fw-bold shadow-sm">Check Answer</button>

          <div id="comment-3" class="mt-4 fs-4 fw-bold"></div>
          
          <div id="visited" class="mt-4"></div>

      </div>
    </div>
  </div> 
  
  <script type="text/javascript">
  $(document).ready(function(){  

      // 1. HTML SETUP

      var solved = false ;


  var photo = "images/aeonMall.jpg" ;
  $("#picture").attr("src",photo);  
  var location = "Aeon Mall" ;
  var description = "The newest and biggest shopping mall in Cambodia.  It is very popular and it is always full of shoppers.It has many shops and the things they sell are of good quality but they are expensive."  ; 

  var title = "Question 3" ;
 
     
      $("#picture").attr("src", photo);  
      $('#location-3').text(location);
      $('#description-3').text(description);
    

      // 2. MATH INITIALIZATION
      // Generate a random 'x' value between 2 and 12
      var randomX = Math.floor(Math.random() * 11) + 2;
      var y = (4 * randomX * randomX) + 1;
      var question = 'Find the value of x where ' + '$4x^2 + 1 =  $' + y ;
      var solution = randomX;
      $('#hidden3Val').val(solution);
      $('#label-3a').html(" x = " );
  $('#question-3').html(question) ;
  MathJax.Hub.Queue(["Typeset", MathJax.Hub, "question-3"]);
  console.log(question);
      // Re-typeset the dynamic MathJax
      if (typeof MathJax !== 'undefined') {
          MathJax.Hub.Queue(["Typeset", MathJax.Hub, "label-3a"]);
      }

      // 3. EVENT LISTENER
      $('#check-btn').click(function() {
          var userGuess = parseInt($('#input-3a').val());
          var correctAns = solution;

          if (isNaN(userGuess)) {
              $('#comment-3').html('<span class="text-danger">Please enter a number!</span>');
              return;
          }

          if (userGuess === solution) {
              // SUCCESS
              $('#comment-3').html('<span class="text-success fs-3">⭐ Correct! ⭐</span>');
              
              if (typeof solved !== 'undefined') {
                  solved[3] = 1; // Updated to puzzle 3
              }
              
              // Appends the specific image for this puzzle
              $('#visited').append('<img src="' + photo + '" style="width: 100px; border-radius: 8px; margin-top: 15px; border: 2px solid #198754;">');
              
              if (typeof displayUnsolved === "function") {
                  displayUnsolved();
              }
              
              $('#input-3a').prop('disabled', true).css({"background-color": "lightgreen", "color": "black"});
              $(this).hide();
              
              if (typeof processWin === "function") {
                  processWin(questionID); // Dynamically sends the correct ID
              }
              
          } else { 
              // FAILURE
              $('#comment-3').html('<span class="text-danger">Incorrect. Keep trying!</span>');
              $('#input-3a').animate({marginLeft: '-10px'}, 100).animate({marginLeft: '10px'}, 100).animate({marginLeft: '0'}, 100);
          }
      });

  });
  </script>
</body>
</html>