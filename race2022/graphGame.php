<!DOCTYPE html>
<html lang="en">

<head>

  <title>Graphing game</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../javaScript/bootStrap/bootstrap-3.3.7-dist/css/bootstrap.min.css">
  <script src="../javaScript/jQuery/jquery-3.3.1.min.js"></script>
  <script src="../javaScript/bootStrap/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
  <script src= "../javaScript/plotly/math.min.js"></script>
  <script src="../javaScript/plotly/plotly-latest.min.js"></script>

<script type="text/x-mathjax-config">
  MathJax.Hub.Config({
    extensions: ["tex2jax.js"],
    jax: ["input/TeX","output/HTML-CSS"],
    tex2jax: {inlineMath: [["$","$"],["\\(","\\)"]]}
  });
</script>
<script type="text/javascript" src="../MathJax-2.7.5/MathJax.js"></script>

    <link rel = "stylesheet" href  = "css/pioStudentsStyles.css">
    <link rel = "stylesheet" href  = "css/graphGameStyles.css">

<script src = "javaScript/functionRandomNumbers.js" type="text/javascript"></script>
<script src = "javaScript/setup.js" type="text/javascript"></script>
<script src = "javaScript/functionDrawGraph.js" type="text/javascript"></script>
<script src = "javaScript/functionMakeExpressionMXC.js" type="text/javascript"></script>
<script src = "javaScript/functionGCD.js" type="text/javascript"></script>


</head>
<body>


<div class="container">
 
 <div class="row">
  <div class="col-12 c">
    <h2>Parabola Equation</h2>
  </div></div>

<?php include "includes/table.html" ; ?>

</div></div>



<div class="row">
        <div class="col-12 c">

<!-- stores equation - question -->
<input type="text" id="equationQuestion" value="x" class = "equationStyle"  >


<!-- stores upper and lower x values -->
<input type = "text" id = "lowX" class = "limitStyle"  value="-5">
<input type = "text" id = highX class = "limitStyle"  value="5">

  <!-- store a,b,c  for ax+by = c and ax^2 +bx + c -->

 <input type = "text" id = "a"  class = "coefficientStyle" value = "2"> 
 <input type = "text" id = "b"  class = "coefficientStyle" value = "4"> 
 <input type = "text" id = "c"  class = "coefficientStyle" value = "-3"> 

<!-- stores answers for y = mx +c -  level 1 -->

</div> <!-- input answer 2 -->

  <div id = "inputAnswer-3" class = "c"> 
    Write the equation of the parabola 
    <br>
    for example <strong>y = 2x^2 + 5x + 3</strong>
    <br>


<label><strong>The equation of the blue parabola is</strong></label>
<input id = "equationAnswer3" type = "text"  class = "answerStyle" > 
<input id = "equationAnswer-3" type = "text"  class = "answerStyle" value = "y="> 
<input id = "theAnswer3" readonly="true" >&nbsp; &nbsp; 

<button id = "checked3">Check</button>


</div> <!-- input answer 3 -->


<div id="plot"></div>


</div> <!-- container -->

</body>
</html>



<script type="text/javascript">
  
  function cleanInput(eqtn)

  {

    eqtn = eqtn.replace(/ +/g, ""); // no spaces
    eqtn = eqtn.replace('X','x') ; // lower case x
    eqtn = eqtn.replace('Y','y') ; // lower case y

   return eqtn ;
  }

</script>

<script type="text/javascript">
  
function getABC(eqtn)

{
// returns a,b and c from the input answer 
// gets rid of spaces


var coefficients = [] ;
 // alert('Getting dashed ' + 'eqtn = ' + eqtn ) ;

// parse ax+by=c to get a,b,c
// need to find first position  for x,y,=

var posX, posY, posEqual , first, part,i, lenEquation;
var symbol = [] ;

posX = eqtn.indexOf('x'); 
posY = eqtn.indexOf('y'); 
posEqual = eqtn.indexOf('='); 
lenEquation = eqtn.length ;

//alert(eqtn + ' x ' + posX + ' y ' + posY + ' =  ' + posEqual + ' l ' + lenEquation)

part = '' ;
i = 0 ;
while ( i < posX)
{part = part + eqtn.substring(i,i+1) ;
//  alert(' a loop ' + i + ' first ' + part);
i=i+1 ;
}

// alert(' a loop ' + part);

if (part == '') {a = 1 ;} 
if (part == '-') {a = -1 ;} 
if (part != '' & part != '-') {a = parseInt(part);}

// alert('a = ' + a + ' part = ' + part);

coefficients[0] = a ;

part = '' ;
i = posX + 1  ;
while (i < posY)
{part = part + eqtn.substring(i,i+1) ;
i=i+1 ;
}

// alert(' b loop ' + ' part = ' + part);

if (part == '+') {b = 1 ;} 
if (part == '-') {b = -1 ;} 
if (part != '' & part != '-' & part != '+') {b = parseInt(part);}

coefficients[1] = b ;

// alert('b = ' + b );

c = eqtn.substring(posEqual+1,lenEquation);
c = parseInt(c) ;
coefficients[2] = c ;

// alert('c = ' + c + ' part = ' + part);


// alert('coeff= ' + coefficients) ;

return coefficients ;


}



</script>



<script type="text/javascript">
  function regexQuadratic(expr)
  {

var regex = /(y=)-?[2-9]?x\^2[+|-][2-9]?[0-9]?x[+|-]?[0-9]?[0-9]?/;
// alert('expression = ' + expr + ' ' + regex.test(expr));

var match = regex.test(expr);

if (!match) {alert('The equation must be like ax^2+bx+c');}


   return match ; 
  }
</script>

<script type="text/javascript">
  
function makeQuadratic(lowX,highX)

{
  var coefficients = [] ;
  var a,b,c ;
  var found = false;
  var score = parseInt($('#total').val()) ;
// alert('Quadratic function ' + lowX + ' ' + highX);
  a = 0 ;
  var turningPointY = 20;
  var zenithNadir = 12 ;
  var determinant = 1.1 ;
  var aLimit = parseInt(score/5 + 1) ;

  while (
    a == 0 | 
    Math.abs(a) > aLimit | 
    (b == 0 & c >= 0) | 
    Math.abs(turningPointX) > zenithNadir |
    !Number.isInteger(determinant) |
    c == 0 |
    b == 0
    )
  {
  if (score < 5) {a = randomInteger(1,1)} else {a = randomInteger(-aLimit,aLimit)};
  b = randomInteger(lowX,highX);
  c = randomInteger(lowX,highX);
  determinant = Math.sqrt(b*b-4*a*c);

  // check that min/max is not too large abs value less than 12
  
  var turningPointX = -b/(2*a);
  var turningPointY = a*turningPointX*turningPointX+b*turningPointX + c ;


  
  }

if (a < 1) {a = -1 ;} else {a = 1 ;}

  a1 = a ;
  b1 = b + a*c ;
  c1 = b*c ;

  var eqtn = 'y='+a1 + 'x^2' + '+' + b + 'x' + '+' + c ;

  coefficients[0] = a1 ;
  coefficients[1] = b1 ;
  coefficients[2] = c1 ;
  coefficients[3] = trimPlusMinus(eqtn) ;
  
//  alert('quadratic = ' + coefficients) ;

  return coefficients ;
}

</script>

<script type="text/javascript">


  $(document).ready(function(){



      $('#levels').show() ;
      $('#nextHome').show(); 
      $('#answerSpace').show() ;
      $('#theAnswer').show() ;
      $('#score').show() ;
      $('#equationAnswer').show() ;
      $('#checked').show();
      $('#plot').show() ;
      $('#table').show() ;
      $('#equationAnswer').show() ;
      $('#equationAnswer-1').show() ;
    

$('#equationQuestion').val('') ;
$('#equationAnswer').val('') ;


$('#equationAnswer-3').val('') ;

      var yMax = 40 ;
      var minX = parseInt($('#lowX').val()) ;
      var maxX = parseInt($('#highX').val()) ;
     
      
      difficulty = 3;

alert(' Values = Xmin ' + minX + ' Xmax ' + maxX + '  ' + ' yMax' + yMax + ' diff ' + difficulty);
        
        $('#inputAnswer-3').show() 
        $('#inputAnswer-2').show() ;
        $('#inputAnswer-1').show() ;
        $('#equationQuestion').show() ;

        var exp = makeQuadratic(minX,maxX) ;

        alert(' quadratic expression = ' + exp) ;
        var correctFormat = regexQuadratic(exp[3]);

     //   alert('exp = ' + exp[3]);

        var eqtn1 = exp[3] ;
        var eqtn2 = 'y=x^2' ;

        $('#equationQuestion').val(eqtn1) ;
        $('#equationAnswer').val(eqtn2) ; // needs to be this for graphing
        $('#equationAnswer-3').val(eqtn2) ; 
        $('#theAnswer3').val(eqtn1); 
        $('#theAnswer3').show() ;
      $('#equationAnswer-3').css({"color":"blue"});

 // alert('Equations at start  = level ' + difficulty +  ' + 1 = ' + eqtn1 + '  +  2= ' + eqtn2) ;
var l = eqtn2.length;
var trimmedEqtn2 = eqtn2.substring(2,l) ;
// drawGraph(eqtn1,trimmedEqtn2) ;

     

      }) 

  

</script>


<script type="text/javascript">

  $(document).ready(function(){

    $('[id^=checked').on('click', function()
  {
alert('Showing your answer ') ;

// $('#levels').show() ;

// alert('Difficulty = ' + difficulty) ;



if (difficulty == 3)
{


$('#equationQuestion').show() ;
$('#equationAnswer-3').show() ;


// MathJax.Hub.Queue(["Typeset", MathJax.Hub, "displayAnswer"]);

var eqtn1 = $('#equationQuestion').val() ;
var eqtn2 = $('#equationAnswer-3').val() ;

eqtn2 = eqtn2.replace(/ +/g, "");
$('#equationAnswer').val(eqtn2);
eqtn1 = eqtn1.replace(/ +/g, "");

// alert('regex y=mx +c is ' + test) ;

// var correctFormat = regexQuadratic(eqtn2) ;
var l = eqtn2.length ;
var trimmedEqtn2 = eqtn2.substring(2,l) ; // remove y=

// alert('Equations = ' + eqtn1 + ' ' + eqtn2 + ' trimmed ' + trimmedEqtn2 + ' formatting ' + correctFormat) ;

drawGraph(eqtn1,trimmedEqtn2) ;


if (eqtn1 == eqtn2) {alert('Correct!');
      $('#levels').show() ;
      $('#nextHome').show(); 
      $('#answerSpace').show() ;
      $('#equationAnswer').css({"color":"blue"});
      $('#theAnswer').val(eqtn2) ;
      $('#theAnswer').show();
    //  $('#table').show() ;
      $('#plot').show() ;
      $('#score').append('*') ;
      $('#score').show() ;
     var total = parseInt($('#total').val()) ;
      total =total + 1 ;
      $('#total').val(total);
      $('#checked3').show();
      $('#inputAnswer').show() ;


$('#equationAnswer').val('');
$('#equationAnswer-1').show() ;
drawGraph('','') ;

}

else {$('#equationAnswer').css({"color":"black"}); 
alert('Keep trying!');}
}

      }) ;

  })


</script>
-->
