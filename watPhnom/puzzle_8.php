<?php 
 $question = isset($_POST['question']) ? $_POST['question'] : 'Puzzle 8';
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Race to Wat Phnom - Puzzle 8</title>
  
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
      <div class="col-12 col-md-8 col-lg-6" style="text-align: center; margin-top: 20px;">
        
          <img id="picture" src="" alt="Location Image" style="max-width: 100%; max-height: 250px; border-radius: 12px; margin-bottom: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); display: none;">
          
          <h2 id="location-8" class="fw-bold text-primary"></h2>
          <p id="description-8" class="text-muted fs-5"></p>
          <h5 id="title-6" class="fw-bold text-dark mt-4"></h5>
          
          <div class="mt-4 mb-3">
            <div id="question-8" style="font-size: 1.5em; background: #f8f9fa; border: 3px dashed #ced4da; border-radius: 12px; padding: 20px;"></div>
          </div>

          <div id="answer-8" class="d-flex justify-content-center align-items-center gap-3 mt-4 mb-4">
            <label id="label-8a" class="fs-2 fw-bold"></label>
            <input id="input-8a" type="text" class="form-control fw-bold" style="width: 150px; height: 60px; font-size: 1.8em; text-align: center; background-color: lightgreen; border: 2px solid #198754; border-radius: 10px; color: #000;" placeholder="?">
            <input id="hiddenN" type="hidden"> 
            <button id="check-btn" class="btn btn-primary btn-lg px-4 fw-bold shadow-sm" style="height: 60px;">Check Answer</button>
          </div>

          <div id="comment-8" class="mt-4 fs-4 fw-bold"></div>
          
      

      </div>
    </div>
  </div> 


<script type="text/javascript">
  $(document).ready(function() {

// 3 equations
     

 
  $('#puzzle-8').show() ;
  $('#question-8').show() ;
  $('#answer-8').show() ;
  $('#feedback-8').show() ;
   $('#comment-8').show() ;
 
var m = getRandomInt(11,20) ;
var n = getRandomInt(3,10) ;
m = parseInt(m) ;
n = parseInt(n) ;
  //  makeCubes()  ;
   $('[id^=words]').show() ;
   $('#cubeNumbers').show() ;
   $('#cubes').show() ;
 //  $('[id^=puzzle]').show() ;
  // $('[id^=answer]').show() ;
// $('[id^=place]').hide() ;
// alert('Place = ' +place) ;

$('#hiddenAnswerX').val(m) ;
$('#hiddenAnswerY').val(n) ;
x = m*m*m + n*n*n ;
y = m*m*m - n*n*n ;

console.log(8,m,n, parseInt(m+n));
// alert(m + ' ' + n1 + ' * ' + n2) ;
  
  $('#label-8a').text(' m  +  n = ').show() ;
  $('#label-8b').text('?').show() ;

  $('#answer-8').show() ;
  
  var solved = false ;
  var question = 'Find m and n using the equations  ' + '<br>'
  + '$m^3 + n^3 = $' + x + '<br>'
  + '$m^3 - n^3 = $' + y ;

  var photo = "images/royalPalace.jpg" ;
  $("#picture").attr("src",photo).show();  
  var location = "The Royal Palace" ;
  var description = 'It is the most famous place in Phnom Penh and it is where the King of Cambodia lives. The Royal Palace is open to visitors on most days of the year.'  ;  
  var title = "Question 8" ;
 
  $('#location-8').text(location).show() ;
  $('#description-8').text(description).show() ;
  $('#title-8').text(title).show() ;
  $('#question-8').html(question).show() ;

  MathJax.Hub.Queue(["Typeset", MathJax.Hub, "question-8"]);
    // 3. Interaction Logic
      $('#check-btn').off('click').on('click', function() {
          const guessN = parseInt($('#input-8a').val());
          
          if (isNaN(guessN)) {
              $('#comment-8').html('<span class="text-danger">Please enter a valid number!</span>');
              return;
          }

          if (guessN === (m + n)) {
              // SUCCESS
              $('#comment-8').html('<span class="text-success fs-3">⭐ Correct! ⭐</span>');
              
              if (typeof solved !== 'undefined') {
                  solved[8] = 1;
              }
              
              // Add thumbnail
              if ($('#visited').length) {
                  $('#visited').append('<img src="' + photo + '" style="width: 100px; border-radius: 8px; margin-top: 15px; border: 2px solid #198754; margin-right: 5px;" title="' + location + '">');
              }
              
              if (typeof displayUnsolved === "function") {
                  displayUnsolved();
              }
              
              // Lock inputs
              $('#input-8a').prop('disabled', true).css({"background-color": "lightgreen", "color": "black"});
              $(this).hide(); // Hide the check button
              
              var questionID = '<?php echo $question; ?>';
              if (typeof processWin === "function") {
                  processWin(questionID);
              }
              
         } else {
            // Calculate what their guess actually equals
            const userResult = Math.pow(2, guessN) - 1;

            // FAILURE - Show their calculated value
            $('#comment-8').html(`<span class="text-danger">Incorrect!  Keep trying!</span>`);
            
            // Tell MathJax to render the new math equation in the comment box
            MathJax.Hub.Queue(["Typeset", MathJax.Hub, "comment-6"]);

            // Wiggle animation
            $('#input-8a').animate({marginLeft: '-10px'}, 100).animate({marginLeft: '10px'}, 100).animate({marginLeft: '0'}, 100);
        }
      });
  })

</script>

</body>
</html>