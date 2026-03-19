<?php 
 $question = isset($_POST['question']) ? $_POST['question'] : 'Puzzle 8';
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-9">
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
      <div class="col-12 col-md-9 col-lg-6" style="text-align: center; margin-top: 20px;">
        
          <img id="picture" src="" alt="Location Image" style="max-width: 100%; max-height: 250px; border-radius: 12px; margin-bottom: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); display: none;">
          
        
     
      <h2 class = "c" id = "location-9"></h2>
      <p class = "c" id = "description-9"></p>
      <h3 class = "c" id = "title-9"></h3>
      <br>
      <p class = "c" id = "question-9"></p>
      <br>
      <div id = "answer-9" class = "c">
        <label id = "label-9a"></label>
        <input id = "input-9a" type = "text" class = "data">
       <label id = label-9b ></label>  
         <input id = "input-9b" type = "text" class = "data">

          <label id = label-9c ></label>  
         <input id = "input-9c" type = "text" class = "data">
         <input id = "hiddenAnswerA" type = "hidden"> 
         <input id = "hiddenAnswerB" type = "hidden"> 
        <input id = "hiddenAnswerC" type = "hidden"> 
    
     

 
      <p class = "c" id = "feedback-9"></p>
          </div>

          <div id="comment-9" class="mt-4 fs-4 fw-bold"></div>
          
      

      </div>
    </div>
  </div> 


<script type="text/javascript">
  $(document).ready(function() {

// question 9
     
 
var answerA =  parseInt($('#input-9a').val()) ;
var answerB =  parseInt($('#input-9b').val()) ;
var answerC =  parseInt($('#input-9c').val()) ;

pA = isPrime(answerA) ;
pB = isPrime(answerB) ;
pC = isPrime(answerC) ;
// alert(pA + pB) ;
if ( pA == false | pB == false | pC == false) {alert('You must use prime numbers!') ;}


var solutionA = $('#hiddenAnswerA').val() ;
var solutionB = $('#hiddenAnswerB').val() ;
var solutionC = $('#hiddenAnswerC').val() ;

var a = answerA ;
var b = answerB ;
var c = answerC ;

 myDenominator = a*b*c ;
 myNumerator = parseInt(a*b + a*c + b*c) ;

var myFraction = '$ \\frac{' + myNumerator + '}{' + myDenominator + '} $' ;


$('#comment-9').html(myFraction);

// numbera,B,C are the encoded numbers based on the letters
 MathJax.Hub.Queue(["Typeset", MathJax.Hub, "feedback-9"]);

$('#hiddenAnswerA').val(a) ;
$('#hiddenAnswerB').val(b) ;
$('#hiddenAnswerC').val(c) ;

console.log(9,a,b,c);

// alert(m + ' ' + n1 + ' * ' + n2) ;
  
  $('#label-9a').text(' a = ').show() ;
  $('#label-9b').text(' b = ').show() ;
  $('#label-9c').text(' c = ').show() ;

  $('#answer-9').show() ;
  
  var solved = false ;
  var question = 'Find a, b and c.    ' + '<br>'
  + '$ \\frac{1}{a} + \\frac{1}{b} + \\frac{1}{c}  = $' + 
 '$ \\frac{' + myNumerator + '}{' + myDenominator + '}$' + 
  '<br> a,b and c are all prime numbers.';

  var photo = "images/nationalMuseum.jpg" ;
  $("#picture").attr("src",photo);  
  var location = "The National Museum" ;
  var description = 'If you want to learn about the history of Cambodia, this is the place to go!'  ;  
  var title = "Question 9" ;
 
  $('#location-9').text(location).show() ;
  $('#description-9').text(description).show() ;
  $('#title-9').text(title).show() ;
  $('#question-9').html(question).show() ;

  MathJax.Hub.Queue(["Typeset", MathJax.Hub, "question-9"]);


    // 3. Interaction Logic
      $('#check-btn').off('click').on('click', function() {
          const guessA = parseInt($('#input-9a').val());
          const guessB = parseInt($('#input-9b').val());
          const guessC = parseInt($('#input-9c').val());


          if (isNaN(guessA) || isNaN(guessB) || isNaN(guessC) )             
          {  $('#comment-9').html('<span class="text-danger">Please enter a valid number!</span>');
              return;
          }

          if (guessA === a && guessB === b && guessB === c) {
              // SUCCESS
              $('#comment-9').html('<span class="text-success fs-3">⭐ Correct! ⭐</span>');
              
              if (typeof solved !== 'undefined') {
                  solved[9] = 1;
              }
              
              // Add thumbnail
              if ($('#visited').length) {
                  $('#visited').append('<img src="' + photo + '" style="width: 100px; border-radius: 8px; margin-top: 15px; border: 2px solid #198754; margin-right: 5px;" title="' + location + '">');
              }
              
              if (typeof displayUnsolved === "function") {
                  displayUnsolved();
              }
              
              // Lock inputs
              $('id^=[input-9]').prop('disabled', true).css({"background-color": "lightgreen", "color": "black"});
              $(this).hide(); // Hide the check button
              
              var questionID = '<?php echo $question; ?>';
              if (typeof processWin === "function") {
                  processWin(questionID);
              }
              
         } else {
            // Calculate what their guess actually equals
            const userResult = Math.pow(2, guessN) - 1;

            // FAILURE - Show their calculated value
            $('#comment-9').html(`<span class="text-danger">Incorrect!  Keep trying!</span>`);
            
            // Tell MathJax to render the new math equation in the comment box
            MathJax.Hub.Queue(["Typeset", MathJax.Hub, "comment-6"]);

            // Wiggle animation
            $('id^=[input-9]').animate({marginLeft: '-10px'}, 100).animate({marginLeft: '10px'}, 100).animate({marginLeft: '0'}, 100);
        }
      });
  })

</script>

</body>
</html>