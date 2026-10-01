<!DOCTYPE html>
<html lang="en">

<!-- selectors for key variables 

equationQuestion
equationAnswer
lowX
lowY
a
b
c

answer-a
answer-b
answer-c

-->
<head>
  <meta charset="utf-8">
  <title>Graphing game</title>

    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/mathjs@6.6.4/dist/math.min.js"></script>

  <script src="https://cdn.plot.ly/plotly-1.35.2.min.js"></script>

  <script type="text/javascript" async
  src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.7/MathJax.js?config=TeX-MML-AM_CHTML">
</script>

 <script type="text/x-mathjax-config">
  MathJax.Hub.Config({
    extensions: ["tex2jax.js"],
    jax: ["input/TeX","output/HTML-CSS"],
    tex2jax: {inlineMath: [["$","$"],["\\(","\\)"]]}
  });
</script>   

 <script type="text/javascript">
  MathJax.Hub.Queue(["Typeset",MathJax.Hub]);
</script>

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
<a href = "../indexNewMaths.php">  <button id = "exit">Home</button></a>
 
 <? include "includes/graphMenu.html" ; ?>

<h3 class = "c" id = "score"></h3>
<input id ="total" type = "text" hidden="true">

 <div class="row">
  <div class="col-12 c">
<div id= "nextHome">

<button id = "home">Home</button> &nbsp &nbsp
<button id = "nextQuestion">Next question</button>

  </div> <!-- next home -->

</div></div>



</div> <!-- answer space -->

 <div class="row">
  <div class="col-12 c">

<?php include "includes/table.html" ; ?>

</div></div>

<div id = "answerSpace">

<div class="row">
        <div class="col-12 c">

<!-- stores equation - question -->
<input type="text" id="equationQuestion" value="x" class = "equationStyle"  hidden = "true">


<!-- stores upper and lower x values -->
<input type = "text" id = "lowX" class = "limitStyle"  hidden = "true">
<input type = "text" id = highX class = "limitStyle"  hidden = "true">

  <!-- store a,b,c  for ax+by = c and ax^2 +bx + c -->

 <input type = "text" id = "a" hidden = "true" class = "coefficientStyle"> 
 <input type = "text" id = "b" hidden = "true" class = "coefficientStyle"> 
 <input type = "text" id = "c" hidden = "true" class = "coefficientStyle"> 

<!-- stores answers for y = mx +c -  level 1 -->
   <div id = "inputAnswer-1" class = "c"> 
    Write the equation of the line 
    <br>
    for example <strong>y = 3x-2</strong> or <strong>y = -x+1</strong>
    <br>
<label><strong>The equation of the blue line is</strong></label>
<input id = "equationAnswer" type = "text"  class = "answerStyle" > 
<input id = "equationAnswer-1" type = "text"  class = "answerStyle" value = "y="> 
<input id = "theAnswer" readonly="true">&nbsp; &nbsp; <button id = "checked1">Check</button>


</div> <!-- input answer 1 -->


   <div id = "inputAnswer-2" class = "c"> 
      Write the equation of the line 
      <br>
      for example <strong>3x-2y = 5 </strong> or <strong>-x+y = 2</strong>
      <br>
  <label>The equation of the blue line is</label>
  
  <input id = "answer-a" type = "text" class = "coefficientStyle" hidden="true">
  <input id = "answer-b" type= "text" class = "coefficientStyle" hidden = "true">
  <input id = "answer-c" type = "text"class = "coefficientStyle" hidden="true">


<input id = "line-equation" type = "text" hidden = "true"> <!-- ax+by=c eqtn1 -->
 <input id = "line-equationPlot" type = "text" hidden="true"> <!-- y = -ax/b+b/c eqtn2-->
 <input id = "line-answer" type = "text" class = "answerStyle"> <!-- ax+by=c inputfrom eqtn3 -->
  <input id = "line-answerPlot" type = "text" hidden = "true"> <!-- y = -ax/b+b/c eqtn2-->

  &nbsp; &nbsp; <button id = "checked2">Check</button>

</div> <!-- input answer 2 -->

  <div id = "inputAnswer-3" class = "c"> 
    Write the equation of the parabola 
    <br>
    for example <strong>y = x^2-x-6 </strong> or <strong>y = 2x^2 + 5x + 3</strong>
    <br>
<label><strong>The equation of the blue parabola is</strong></label>
<input id = "equationAnswer3" type = "text"  class = "answerStyle" hidden="true"> 
<input id = "equationAnswer-3" type = "text"  class = "answerStyle" value = "y="> 
<input id = "theAnswer3" readonly="true" >&nbsp; &nbsp; <button id = "checked3">Check</button>


</div> <!-- input answer 1 -->


<div id="plot"></div>

</div>. <!-- answer space -->

</div> <!-- container -->

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


  function trimPlusMinus(exp) 

  {

// removes 2 operands that are together and coefficients of 1 


exp = exp.replace(/ +/g, "");

exp = exp.replace(/-\+/g,'-');
exp = exp.replace(/\+-/g,'-');
exp = exp.replace(/--/g,'+');
exp = exp.replace(/-1x/g,'-x');
exp = exp.replace(/\+1x/g,'x');
exp = exp.replace(/1x/g,'x');
exp = exp.replace(/-1y/g,'-y');
exp = exp.replace(/\+1y/g,'+y');

return exp ;
  }
</script>

<script type="text/javascript">
  
  function regexYMXC(expr)
  {

var regex = /y=-?[2-9]?[0-9]*x[+|-]?[1-9]?[0-9]?$/ ;

// alert('expression = ' + expr + ' ' + regex.test(expr));

var match = regex.test(expr);

if (!match) {alert('The equation must be like y = mx+c');}

   return match ; 
  }
</script>



<script type="text/javascript">
  
  function regexAXBYC(expr)
  {

var regex = /-?[2-9]?[0-9]?x[+|-]?[1-9]?[0-9]?y=[+|-]?\d/;
// alert('expression = ' + expr + ' ' + regex.test(expr));

var match = regex.test(expr);

if (!match) {alert('The equation must be like ax+by=c');}


   return match ; 
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
  

function makeABC(x1,x2,y1,y2) 
{
var numerator = (y2-y1);
var denominator = (x2-x1) ;

// alert('Looking for factor ' + numerator + ' ' + denominator) ;
factor = gcd(numerator,denominator);
// alert('HCF = ' + factor) ;

numerator = numerator / factor ;
denominator = denominator / factor ;

if (denominator > 0 & numerator > 0) {var a = numerator ; var b = denominator ;}  // both positive
if (denominator > 0 & numerator < 0) {var a = numerator ; var b = denominator ;}  // numerator negative
if (denominator < 0 & numerator > 0) {var a = -(numerator) ; var b = -(denominator) ;}  // denominator negative then make denom + and num -
if (denominator < 0 & numerator < 0) {var a = -(numerator) ; var b = -(denominator) ;}  // both negative , make both positive

var a = -numerator ;
var b = denominator ;
var c = y2*denominator - x1*numerator ;

var abFactor = gcd(a,b);
var acFactor = gcd(a,c);
var bcFactor = gcd(b,c);

if (abFactor == acFactor & abFactor == bcFactor & abFactor != 1)
  {
    a = a / abFactor; 
    b = b / abFactor;
    c = c / abFactor; 
 }

$('#a').val(a);
$('#b').val(b);
$('#c').val(c);

 
 var coeff = [];
 coeff[0] = a ;
 coeff[1] = b ;
 coeff[2] = c ;

// alert('abc ' + a + ' ' + b + ' ' + c );

return coeff ;
}
</script>


  
<script type="text/javascript">
  
  function makeExpressionAXBYC(lowX,highX)

  {

// generate coordinare (x1,y1) and (x2,y2)
// coordinates are different 
// x2- x1 <> 0
// (y2 - y1) / (x2-x1) is reduced so  tha tthere is no common factor

var expr = [] ;
var found = false ;

while (found == false) 
{
var x1 = randomInteger(lowX,highX);
var y1 = randomInteger(lowX,highX);

var x2 = randomInteger(lowX,highX);
var y2 = randomInteger(lowX,highX);

// avoid 0 and 3 - 3 makes it impossible todetermne m and c accurately because it is a recurring decimal 

if (x1 != x2 & y1 != y2 & 
  Math.abs(x2-x1) != 3 & 
  Math.abs(x2-x1) != 7 & 
  Math.abs(x2-x1) != 9 &
  Math.abs(y2-y1) != 3 & 
  Math.abs(y2-y1) != 7 & 
  Math.abs(y2-y1) != 9 
  )  
  {found = true ;  } else {found = false ; }

// alert(x1+ ' ' + y1 + ' ' + x2 + ' ' + y2 + ' ' + found);
}  // while

var abc = [] ;
abc = makeABC(x1,x2,y1,y2) ;

a = abc[0] ;
b = abc[1] ;
c = abc[2] ;

exp1 = a + 'x' + '+' + b + 'y' + '=' + c ;
exp2 = '-' + a +'x' + '/' + b + '+' + c + '/' + b ; // 

expr[1] =  trimPlusMinus(exp1); 
expr[2] =  trimPlusMinus(exp2) ;

// alert('Function expr = ' + expr) ;

    return expr ;
  }
  
</script>

<script type="text/javascript">


  $(document).ready(function(){

    $('[id^=l-]').on('click', function()
  {
// alert('clicked') ;

      $('#levels').hide() ;
      $('#nextHome').hide(); 
      $('#answerSpace').show() ;
      $('#theAnswer').hide() ;
      $('#score').show() ;
      $('#equationAnswer').show() ;
      $('#checked').show();
      $('#plot').show() ;
      $('#table').show() ;
      $('#equationAnswer').hide() ;
      $('#equationAnswer-1').show() ;
    

$('#equationQuestion').val('') ;
$('#equationAnswer').val('') ;


$('#equationAnswer-3').val('') ;

      var yMax = 40 ;
      var minX = parseInt($('#lowX').val()) ;
      var maxX = parseInt($('#highX').val()) ;
      var idDifficulty = this.id;
      $('#total').val(0);
      difficulty = idDifficulty.substring(2, 3); 
  //    alert('Difficulty = ' + difficulty) ;
      
      difficulty = parseInt(difficulty) ;


      if (difficulty == 1 )
      { 
        $('#inputAnswer-3').hide() ;
        $('#inputAnswer-2').hide() ;
        $('#inputAnswer-1').show() ;


        var exp = makeExpressionMXC(minX,maxX) ;

        var eqtn1 = exp ;
        var eqtn2 = '' ;
        $('#equationQuestion').val(eqtn1) ;
        $('#equationAnswer').val(eqtn2) ;
   
      $('#equationAnswer').css({"color":"blue"});

 // alert('Equations at start  = level ' + difficulty +  ' + 1 = ' + eqtn1 + '  +  2= ' + eqtn2) ;

drawGraph(eqtn1,eqtn2) ;

      }

   if (difficulty == 2 )
      { 
        $('#inputAnswer-1').hide() ;
        $('#inputAnswer-2').show() ;
        $('#inputAnswer-3').hide() ;
        $('[id^=line-]').show() ;

var expr = [] ;
var expr = makeExpressionAXBYC(minX, maxX) ;
// alert('Made level 2 ' + minX + ' ' + maxX + ' 1 ' + expr[1] + ' 2 ' + expr[2]);
$('#line-equation').val(expr[1]);
$('#line-equationPlot').val(expr[2]);

expr1 = expr[1] ;
expr2 = expr[2] ;

// alert('Initial expressions = ' + expr) ;

  $('#equationQuestion').val(expr2) ; // plottable question
  eqtn1 = $('#equationQuestion').val() ;
  $('#equationAnswer').val('') ;
  eqtn2 = $('#equationAnswer').val() ;
// drawGraph(eqtn1,eqtn2);

drawGraph(eqtn1,eqtn2);  // need to come from equation and equationAnswer

}



      if (difficulty == 3 )
      { 
        
        $('#inputAnswer-3').show() 
        $('#inputAnswer-2').hide() ;
        $('#inputAnswer-1').hide() ;
        $('#equationQuestion').hide() ;

        var exp = makeQuadratic(minX,maxX) ;
        var correctFormat = regexQuadratic(exp[3]);

     //   alert('exp = ' + exp[3]);

        var eqtn1 = exp[3] ;
        var eqtn2 = 'y=x^2' ;

        $('#equationQuestion').val(eqtn1) ;
        $('#equationAnswer').val(eqtn2) ; // needs to be this for graphing
        $('#equationAnswer-3').val(eqtn2) ; 
        $('#theAnswer3').val(eqtn1); 
        $('#theAnswer3').hide() ;
      $('#equationAnswer-3').css({"color":"blue"});

 // alert('Equations at start  = level ' + difficulty +  ' + 1 = ' + eqtn1 + '  +  2= ' + eqtn2) ;
var l = eqtn2.length;
var trimmedEqtn2 = eqtn2.substring(2,l) ;
drawGraph(eqtn1,trimmedEqtn2) ;

      }

      }) ;

  })

</script>


<script type="text/javascript">

  $(document).ready(function(){

    $('[id^=checked]').on('click', function()
  {
alert('Showing your answer ') ;

$('#levels').hide() ;

// alert('Difficulty = ' + difficulty) ;

if (difficulty == 1)
{


$('#equationAnswer-1').show() ;
$('#equationAnswer').hide() ;


var myAnswer = $('#equationAnswer-1').val() ;  // temp hold for 'y=''
$('#equationAnswer').val(myAnswer) ;
var newAnswer = $('#equationAnswer').val();
 var answered = 'y = ' + '$  ' + myAnswer + ' $' ;
$('#displayAnswer').html(answered)  ;

// alert('my answer = ' + myAnswer + ' equationAnswer = ' + newAnswer );

 MathJax.Hub.Queue(["Typeset", MathJax.Hub, "displayAnswer"]);

var eqtn1 = $('#equationQuestion').val() ;
var eqtn2 = $('#equationAnswer').val() ;

eqtn1 = eqtn1.replace(/ +/g, "");

// alert('regex y=mx +c is ' + test) ;
eqtn2 = eqtn2.replace(/ +/g, "");
var correctFormat = regexYMXC(eqtn2) ;
var l = eqtn2.length ;
var trimmedEqtn2 = eqtn2.substring(2,l) ;

// alert('Equations = ' + eqtn1 + ' ' + eqtn2 + ' triimed ' + trimmedEqtn2) ;
if (correctFormat)
{drawGraph(eqtn1,trimmedEqtn2) ;}


if (eqtn1 == trimmedEqtn2 & correctFormat) {alert('Correct!');
      $('#levels').hide() ;
      $('#nextHome').show(); 
      $('#answerSpace').show() ;
      $('#equationAnswer').css({"color":"blue"});
      $('#theAnswer').val(eqtn2) ;
      $('#theAnswer').show();
    //  $('#table').hide() ;
      $('#plot').show() ;
      $('#score').append('*') ;
      $('#score').show() ;
      var total = parseInt($('#total').val()) ;
      total =total + 1 ;
      alert('Total = ' + total)
      $('#total').val(total);
      $('#checked1').hide();
      $('#inputAnswer').hide() ;


$('#equationAnswer').val('');
$('#equationAnswer-1').hide() ;
drawGraph('','') ;

}

else {$('#equationAnswer').css({"color":"black"}); 
alert('Keep trying!');
}
}

if (difficulty == 2)

{

$('#equationAnswer-1').show() ;
$('#equationAnswer').hide() ;

eqtn1 = $('#equationQuestion').val() ;
eqtn2 = $('#line-equationPlot').val() ;
eqtn3 = $('#line-answer').val() ;

// alert('Equation 1 ' + eqtn1 + ' Equation 2 ' + eqtn2 + ' Equation 3 ' + eqtn3)

var correctFormat = regexAXBYC(eqtn3) ;

var coeffDashed = [];
coeffDashed = getABC(eqtn3);
// alert('Dashed coeff = ' + coeffDashed) ;

var aDashed =coeffDashed[0] ;
var bDashed = coeffDashed[1] ;
var cDashed = coeffDashed[2] ;


var a = $('#a').val() ;
var b = $('#b').val() ;
var c = $('#c').val() ;

// alert('Equation coefficients = ' + ' a ' + a + ' b ' + b + ' c ' + c);

// make equation 4 - plot of supplied answer
// plot eqtn2 and eqtn 4

var eqtn4 = '-' + aDashed +'x' + '/' + bDashed + '+' + cDashed + '/' + bDashed ;

// alert('The plottable answer is ' + eqtn4);

$('#line-answerPlot').val(eqtn4) ;
eqtn4 = trimPlusMinus(eqtn4) ;

$('#equationAnswer').val(eqtn4);

  eqtn1 = $('#equationQuestion').val() ;
  eqtn2 = $('#equationAnswer').val() ;
// drawGraph(eqtn1,eqtn2);

if (correctFormat)
{drawGraph(eqtn1,eqtn2); } // need to come from equation and equationAnswer

// alert(aDashed + ' ' + bDashed + ' ' + cDashed + ' ' + a + ' ' + b + ' ' + c);


if ( (a == aDashed & b == bDashed & c == cDashed) | (a == -aDashed & b == -bDashed & c == -cDashed)) 
  {
      alert('Correct!');
      $('#levels').hide() ;
      $('#nextHome').show(); 
      $('#answerSpace').show() ;
      $('#equationAnswer').css({"color":"blue"});
      $('#theAnswer').val(eqtn2) ;
      $('#theAnswer').show();
    //  $('#table').hide() ;
      $('#plot').show() ;
      $('#score').append('*') ;
      $('#score').show() ;
     var total = parseInt($('#total').val()) ;
      total =total + 1 ;
      $('#total').val(total);
      $('#checked2').hide();
      $('#inputAnswer').hide() ;

$('#equationAnswer').val('');

$('#equationAnswer-1').hide() ;
drawGraph('','') ;

} else {alert('Keep trying!');}


}

if (difficulty == 3)
{


$('#equationQuestion').hide() ;
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
      $('#levels').hide() ;
      $('#nextHome').show(); 
      $('#answerSpace').show() ;
      $('#equationAnswer').css({"color":"blue"});
      $('#theAnswer').val(eqtn2) ;
      $('#theAnswer').show();
    //  $('#table').hide() ;
      $('#plot').show() ;
      $('#score').append('*') ;
      $('#score').show() ;
     var total = parseInt($('#total').val()) ;
      total =total + 1 ;
      $('#total').val(total);
      $('#checked3').hide();
      $('#inputAnswer').hide() ;


$('#equationAnswer').val('');
$('#equationAnswer-1').hide() ;
drawGraph('','') ;

}

else {$('#equationAnswer').css({"color":"black"}); 
alert('Keep trying!');}
}

      }) ;

  })


</script>

<script type="text/javascript">

  $(document).ready(function(){

    $('#nextQuestion').on('click', function()
  {

alert('new question - level  ' + difficulty) ;


      $('#levels').hide() ;
      $('#nextHome').hide(); 
      $('#answerSpace').show() ;
      $('#theAnswer').hide() ;
      $('#score').show() ;
      $('#equationAnswer').show() ;
     
      $('#plot').show() ;
      $('#table').show() ;
      $('#equationAnswer').hide() ;
      $('#equationAnswer-1').show() ;
      $('#line-answer').val('');
    

$('#equationQuestion').val('') ;
$('#equationAnswer').val('') ;

 yMax = 40 ;
      var minX = parseInt($('#lowX').val()) ;
      var maxX = parseInt($('#highX').val()) ;

      if (difficulty == 1)
        {
 $('#checked1').show();
      $('#equationAnswer').val('');
      $('#equationAnswer-1').val('y=') ;
      //$('#equationAnswer').show('');
          eqtn1 = makeExpressionMXC(minX,maxX) ;
          $('#equationQuestion').val(eqtn1);
          eqtn2 = $('#equationAnswer').val() ;


        eqtn1 = eqtn1.replace(/ +/g, "");
        eqtn2 = eqtn2.replace(/ +/g, "");

    //   alert('Equations = ' + eqtn1 + ' ' + eqtn2) ;
        drawGraph(eqtn1,eqtn2) ;
     
        }


      
    
   if (difficulty == 2 )
      { 
        $('#inputAnswer-1').hide() ;
        $('#inputAnswer-2').show() ;
        $('[id^=line-]').show() ;
         $('#checked2').show();

var expr = [] ;
var expr = makeExpressionAXBYC(minX, maxX) ;
// alert('Made level 2 ' + minX + ' ' + maxX + ' 1 ' + expr[1] + ' 2 ' + expr[2]);
$('#line-equation').val(expr[1]);
$('#line-equationPlot').val(expr[2]);

expr1 = expr[1] ;
expr2 = expr[2] ;

// alert('Initial expressions = ' + expr) ;

  $('#equationQuestion').val(expr2) ; // plottable question
  eqtn1 = $('#equationQuestion').val() ;
  $('#equationAnswer').val('') ;
  eqtn2 = $('#equationAnswer').val() ;
// drawGraph(eqtn1,eqtn2);

drawGraph(eqtn1,eqtn2);  // need to come from equation and equationAnswer

}


      if (difficulty == 3 )
      { 
        
        $('#inputAnswer-3').show() 
        $('#inputAnswer-2').hide() ;
        $('#inputAnswer-1').hide() ;
         $('#checked3').show();


        var exp = makeQuadratic(minX,maxX) ;
        var correctFormat = regexQuadratic(exp[3]);

     //   alert('exp = ' + exp[3]);

        var eqtn1 = exp[3] ;
        var eqtn2 = 'y=x^2' ;

        $('#equationQuestion').val(eqtn1) ;
        $('#equationAnswer').val(eqtn2) ; // needs to be this for graphing
        $('#equationAnswer-3').val(eqtn2) ; 
        $('#theAnswer3').val(eqtn1); 
        $('#theAnswer3').hide() ;
      $('#equationAnswer-3').css({"color":"blue"});

 // alert('Equations at start  = level ' + difficulty +  ' + 1 = ' + eqtn1 + '  +  2= ' + eqtn2) ;
var l = eqtn2.length;
var trimmedEqtn2 = eqtn2.substring(2,l) ;
drawGraph(eqtn1,trimmedEqtn2) ;

      }

  })
  
}) ;



</script>

<script type="text/javascript">
  $(document).ready(function(){

    $('#home').on('click', function()
  {

  $('#levels').show() ;
      $('#nextHome').hide(); 
      $('#answerSpace').hide() ;
      $('#table').hide() ;
      $('#score').text('') ;

      }) ;

  })
</script>


</body>
</html>
