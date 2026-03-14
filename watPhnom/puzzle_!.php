<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Puzzle 1</title>
  
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

 <script src = "wat.js"></script>  

<title>Race v2</title>



  <div class = "row">
    <div class = "col-sm-12">


       <div id = "puzzle-1">
      <h2 class = "c" id = "location-1"></h2>
      <p class = "c" id = "description-1"></p>
      <h3 class = "c" id = "title-1"></h3>
      <br>
      <p class = "c" id = "question-1"></p>
      <br>
      <div id = "answer-1" class = "c">
        <label id = "label-1a"></label>
        <input id = "input-1a" type = "text" class = "data">
       <label id = label-1b > &nbsp &nbsp + &nbsp &nbsp </label>  
         <input id = "input-1b" type = "text" class = "data">
         <label id = "comment-1" class = "comments"></label>
        <label class = "c" id = "feedback-1"></label>
      
     </div>


<script type="text/javascript">
  
   $(document).ready(function(){  

$('#green').load("greenLightab.php");
$('#playArea').hide();
$('#green').show();
$('#place10').attr('disabled',true).css({"background-color":"red"}) ;
$('[id^=input-1]').on('change',function(e){
 $('[id^=place]').hide() ;
//  $('[id^=place]').show() ;

$('#primeNumbers').show() ;
$('#primes').show() ;
$('#puzzle-1').show() ;
var answerA =  parseInt($('#input-1a').val()) ;
var answerB =  parseInt($('#input-1b').val()) ;
pA = isPrime(answerA) ;
pB = isPrime(answerB) ;

if (isNaN(answerA)){answerA = 0 ;}
if (isNaN(answerB)){answerB = 0 ;}

solution = answerA + answerB ;

$('#comment-1').text(solution) ;

// alert(pA + pB) ;
if (( pA == false | pB == false) & (answerA > 1  & answerB > 1)) {alert('You can only use prime numbers!') ;}


// $('#feedback-1').text('Your answer is ' + solution) ;
var x = parseInt($('#label-1a').text()) ;
if (x == solution & isPrime(answerA) & isPrime(answerB)  & (answerA > 0 & answerB > 0))
{
$('#comment-1').text(solution) ;
 solved[1] = 1 ;
 $('#escapeKey').text('2') ;
  $('#primeNumbers').hide() ;
 alert('Solved puzzle 1 ' + x + ' = ' + answerA + ' + ' + answerB + '  ' + solved) ; 
 $('#restart').hide() ;
 $('#escapeKey').show() ;
 displayUnsolved() ;
 $('#visited').append('<img class = "thumb c" src = "images/temple.png">')} 
 else { 
 alert('Keep trying!') ;
  };
// alert('Not yet! ' + solution) ;

 // else {alert('Not solved yet ')}
});

})
</script>