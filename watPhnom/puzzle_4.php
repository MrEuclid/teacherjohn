<?php 
 $question = isset($_POST['question']) ? $_POST['question'] : 'Puzzle 4';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Race to Wat Phnom - Puzzle 4</title>
  
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
          
          <h2 id="location-4" class="fw-bold text-primary"></h2>
          <p id="description-4" class="text-muted fs-5"></p>
          <h4 id="question-4" class="fw-bold text-dark mt-4"></h4>
          
          <div class="mt-3 mb-4">
          
          </div>

         <div id="answer-4" class="d-flex justify-content-center align-items-center gap-3 mb-4">
    <label id="label-4a" style="font-size: 2em; font-weight: bold; color: #0d6efd;">x</label>
  <input id="input-4a" type="number" class="form-control" style="width: 100px; height: 60px; font-size: 1.8em; text-align: center; background-color: lightgreen; border: 2px solid #198754; border-radius: 10px; color: #000;">
  
   <label id="label-4b" style="font-size: 2em; font-weight: bold; color: #0d6efd;">y</label> 
  
  <input id="input-4b" type="number" class="form-control" style="width: 100px; height: 60px; font-size: 1.8em; text-align: center; background-color: lightgreen; border: 2px solid #198754; border-radius: 10px; color: #000;">
  
  <input id="hidden4X" type="hidden">
  <input id="hidden4Y" type="hidden">

  <button id="check-btn" class="btn btn-primary btn-lg px-4 fw-bold shadow-sm" style="height: 60px;">Check Answer</button>

</div>

<div id="comment-4" class="mt-4 fs-4 fw-bold"></div>
          
       

      </div>
    </div>
  </div> 
  
  <script type="text/javascript">
  $(document).ready(function(){  

      // 1. GUARANTEED HTML LOADING 
      // We do this first so a math error doesn't break the UI


  var y = getRandomInt(20,30);
  var x = getRandomInt(30,40);
  z = x*x - y*y ;
//  makeFactors(z) ;

  $('#hidden4X').val(x) ;
  $('#hidden4Y').val(y) ;



// alert(z + ' ' + x + ' * ' + y) ;
  $('#label-4a').show() ;
  $('#label-4a').text( 'x = ') ;
  $('#label-4b').show() ;
  $('#label-4b').text('y = ') ;
  $('#input-4a').show() ;
  $('#input-4b').show() ;

  // $('#answer-4').show() ;
  
  var solved = false ;
  var question = 'Find  x and y so that ' + '$x^2 - y^2$'+ ' =  ' + z 
  + '<br>' + '$(x + y) $ ' + ' and '+ '$(x-y) $' + ' are factors of ' + z + '<br>' ;

  var photo = "images/sisowatQuay.jpg" ;
  $("#picture").attr("src",photo);  
  var location = "Sisowat Quay" ;
  var description = "A place where where people go to relax. Enjoy the beautiful river and have a meal at one of the many places to eat from roadside stalls to restaurant. Finish the day with a sunset cruise on the river."  ;  
  var title = "Question 4" ;
 
   var solved = false ;
  var question = 'Find  x and y so that ' + '$x^2 - y^2$'+ ' =  ' + z 
  + '<br>' + '$(x + y) $ ' + ' and '+ '$(x-y) $' + ' are factors of ' + z + ' and x > y';

  var photo = "images/sisowatQuay.jpg" ;
  $("#picture").attr("src",photo);  
  var location = "Sisowat Quay" ;
  var description = "A place where where people go to relax. Enjoy the beautiful river and have a meal at one of the many places to eat from roadside stalls to restaurant. Finish the day with a sunset cruise on the river."  ;  
  var title = "Question 4" ;
 
  $('#location-4').text(location).show() ;
  $('#description-4').text(description).show() ;
  $('#title-4').text(title).show() ;
  $('#question-4').html(question).show() ;

   MathJax.Hub.Queue(["Typeset", MathJax.Hub, "question-4"]);

})
     
 

      // 2. MATH INITIALIZATION
      // Safeguard for the primes array
     
    

      // 3. THE BUTTON CLICK EVENT
      $('#check-btn').click(function() {
          var answerX = parseInt($('#input-4a').val());
          var answerY = parseInt($('#input-4b').val());

          if (isNaN(answerX) || isNaN(answerY)) {
              $('#comment-4').html('<span class="text-danger">Please enter a number in both boxes!</span>');
              return;
          }

         
          
          var solution = answerX * answerX - answerY*answerY;
       //   console.log(answerX,answerY,solution,z);
          // Check if their product equals the target AND both are prime
          if (solution === z && (answerX >= answerY))  {
              
              $('#comment-4').html('<span class="text-success fs-3">⭐ Correct! ' +  ' ⭐</span>');
              
              if (typeof solved !== 'undefined') {
                  solved[4] = 1;
              }
              
            
              
              if (typeof displayUnsolved === "function") {
                  displayUnsolved();
              }
              
              // Lock inputs and hide button on win
              $('#input-4a, #input-4b').prop('disabled', true).css({"background-color": "lightgreen", "color": "black"});
              $(this).hide();
              
              // Competition Dashboard Trigger
              if (typeof processWin === "function") {
                  processWin('Puzzle 4');
              }
              
          } else { 
              $('#comment-4').html('<span class="text-danger">That equals ' + solution + '. Keep trying!</span>');
              $('#input-4a, #input-2b').animate({marginLeft: '-10px'}, 100).animate({marginLeft: '10px'}, 100).animate({marginLeft: '0'}, 100);
          }
      });

  
  </script>
</body>
</html>