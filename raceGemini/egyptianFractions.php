<?php 
 $question = isset($_POST['question']) ? $_POST['question'] : '3 fractions';
// Harder egyptian fractions
?>

<!DOCTYPE html>
<title>Egyptian Fractions - medium</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">

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

 


    <meta charset="utf-8">
    

<style type="text/css">


    p {text-align: left;
margin-left: 10% ;
margin-right: 10% ;
font-family: sans-serif;
font-size: 12pt ;
font-style: normal;
font-weight:normal;}

#stars {
    font-size: 36pt; color:blue ;
}

.c {text-align: center;
margin-right: auto;
margin-left: auto;
margin: 0 ;}



button.fraction {padding: 2px ; width: 120px ;
height: 60px;
 margin-bottom: 5px ;
  margin-top: 2px;vertical-align: top;
  font-size: 16pt ; 
  font-weight: bolder;
 }

.red  {
   color:white ;
  background-color: red ;}

 .orange  {
   color:white ;
  background-color: orange ;} 


 .green  {
   color:white ;
  background-color: green ;}

  .blue  {
   color:white ;
  background-color: blue  ;}

  .big {width:600px ; height: 60px;
 margin-bottom: 5px ;
  margin-top: 2px;vertical-align: top;
  font-size: 16pt ; 
  font-weight: bolder;
  background-color: black ;
  color: white ;}

.num {padding: 2px ; width: 60px ;
height: 60px;
 margin-bottom: 5px ;
  margin-top: 2px;vertical-align: top;
  font-size: 12pt ; 
  font-weight: bolder;
 }


#stars {font-size: 28pt ;}



</style>

 </head>


 <body> 

 


<div class = "container-fluid">
<div class = "row">
  <div class = "col-sm-12 c">
  	<h1>

    You need <strong>3</strong> fractions to solve the puzzle

    </h1>
    <h2>$  \frac{59}{70} = \frac{1}{2} + \frac{1}{5} + \frac{1}{7} $ </h2>
  </div></div>

<div class = "row">
  <div class = "col-sm-12 c">

  	<button id = "clear" class="btn btn-danger bigWriting">Clear</button>

  </div></div>

<div class = "row">
   <div class = "col-sm-12 c">
    <h3>Fraction equation</h3>
<br>
    <button id = "bigFraction" class = "big"></button>
 <br><br>   
     <h2 class = "c" id = "sum"></h2>
      <br><br>
    <p id = "myAnswer" class = "c"></p>
    
</div></div>

  <div class = "row">
   <div class = "col-sm-12 c">

<div id = "buttonDisplay">

    
</div>

   </div></div>

 <div class = "row">
   <div class = "col-sm-12 c">

<div id = "stars">

</div></div>   


  
</div>   <!-- container -->

</body>
</html>


<script type="text/javascript">
  
function gcd(a, b) {
    if (b) {
        return gcd(b, a % b);
    } else {
        return Math.abs(a);
    }
}

</script>

<script type="text/javascript">
  
  function addFractions(a,b,c,d,e,f)

  {
   var num = f * a * d + f * b * c + e * b * d;
   var den = b*d*f ;
   var factor = gcd(num,den) ;
   num = num / factor ;
   den = den / factor ;
   var f = [] ;
   f[0] = num ;
   f[1] = den ;
  // alert('f = ' +  num + ' ' + den + ' ' + f[0] + ' ' + f[1]) ;
   return f ; 
  }
</script>
 
<script type="text/javascript">

// make fractions

function createButton(nButton) {


// alert('Making button with ' + nButton) ;

if (nButton % 1 == 0) {myColor = 1 ;}
if (nButton % 2 == 0) {myColor = 2 ;}
if (nButton % 3 == 0) {myColor = 3 ;}
if (nButton % 5 == 0) {myColor = 5 ;}

var clr = colours[myColor] ;

    var term = '$ \\frac{ ' + 1 + '} {' + nButton + '} $' ;
    var $btn = $('<button  />', {
      type: 'button',
      text: term,
      class: 'fraction',
      id: 'btn-'+nButton,
      css: {"background-color":clr,"color":"white" , 
      "font-size":"16pt","font-weight":"bold" }

           });
     
        return $btn;
  }


</script>

<script type="text/javascript">

  
   $(document).ready(function(){

cnt = 0 ;
denoma = [] ;
denomb = [] ;
numerator = 1 ;
denominator = 1 ;
colours = [] ;
myAttempt = '' ; // shows addends on each turn 

score = 0 ; // score per round 
total = 10 ; // accumulated score  count down -1 for every incorrect guess

// colour by multiples - prime = 1

colours[1] = 'blue' ;
colours[2] = 'red' ;
colours[3] = 'green' ;
colours[5] = 'orange' ;

sumNumerator = 0 ;
sumDenominator = 1 ; // cumulative sum of guesses

$('#score').text(score) ;



screenWidth = 600 ; // based on base 60 to maximise number of divisors
limit = 10 ; // maximum denominator ;

$('buttonDisplay').show() ;
$('#bigFraction').show() ;
$('[id^=btn-]').show() ;
$('#clear').show() ;

shapes = [] ;
shapes[1] = "&#10004;"  ; // tick
shapes[2] = "&#9733;"  ; // star
shapes[3] = "&#10084;"  ; // heart 
shapes[4] = "&#9889;"  ; // lightning

clicks = 0 ; // track clicks on each attempt 
clicksMedium = 0 ;
clicksMax = 3 ;

   cntMoves = 0 ;
 

 for (i = 2 ; i <= 20; i++)  
{$("#buttonDisplay").append(createButton(i)); 

cnt = cnt + 1

    if ((cnt % 10) == 0)
      { // ('Line break needed') ;
        $('#buttonDisplay').append('<br>') ; }

}  
$('[id^=btn-]').hide() ;
$('#buttonDisplay').hide() ;
MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation"]);

   })

  </script>




<script type="text/javascript">
  function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

</script>

<script type="text/javascript">
  $(document).ready(function(){

question = '<?php echo $question; ?>' ;
points = question.substr(-1);
points = parseInt(points);
// alert(question + ' ' +points);
$('#buttonDisplay').show() ;
$('#myAnswer').text('') ;

clicksMedium = 0 ;
myAttempt = '' ;

sumNumerator = 0 ;
sumDenominator = 1 ;
total= 10 ;
score =  score ;


$('#score').text(score) ;
$('[id^=btn-]').show() ;

$('#sum').hide() ;

// alert('New game clicked limit = ' + limit) ;
  var d1 =  getRandomInt(2,limit) ;
  var equal = 1 ;

  while (equal == 1)
  {
  var d2 = getRandomInt(2,limit)  ;
  var d3 = getRandomInt(2,limit) ;
  // alert('Numerator = ' + numerator + ' Denominator ' + denominator) ;

  if (d1 != d2 & d1 != d3 & d2 != d3) {equal = 0;}
  }   

  var f = [] ;
  f = addFractions(1,d1,1,d2,1,d3) ;
  numerator = f[0];
  denominator = f[1] ;
console.log(d1,d2,d3) ;
// alert('denom ' + d1 + ' ' + d2 + ' ' + d3) ;
var term = '$ \\frac{ ' + numerator + '} {' + denominator + '} $' ;
$('#lhs').html(term) ;  

$('#bigFraction').html(term) ;
MathJax.Hub.Queue(["Typeset", MathJax.Hub, "bigFraction"]);
MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation"]);

$('#bigFraction').show() ;

})


</script>      


<script type="text/javascript">
  $(document).ready(function(){
     $('#clear').on('click', function(){

//alert('Clear') ;
total = total - 1 ;
clicksMedium = 0 ;
myAttempt = '' ;
if (total < 0) {total = 0;}

$('#buttonDisplay').show() ;
$('#myAnswer').text('') ;
$('[id^=btn-]').show() ;

sumNumerator = 0 ;
sumDenominator = 1 ;

$('#sum').hide() ;


var term = '$ \\frac{ ' + numerator + '} {' + denominator + '} $' ;




// $('#lhs').html(myAttempt) ;  

$('#bigFraction').html(term) ;
MathJax.Hub.Queue(["Typeset", MathJax.Hub, "bigFraction"]);
MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation"]);

$('#bigFraction').show() ;

})
})
</script>      



<script type="text/javascript">
  $(document).ready(function(){
      $('[id^=btn-]').on("click", function(event) {

$('#sum').show() ;
$('#clear').show() ;
clicksMedium = clicksMedium + 1 ;
var txt = $(this).attr('id'); 
 //   index = parseInt(index) ;
// alert($(this).index());

var n  = txt.substring(4, txt.length);
   
if (n % 1 == 0) {myColor = 1 ;}
if (n % 2 == 0) {myColor = 2 ;}
if (n % 3 == 0) {myColor = 3 ;}
if (n % 5 == 0) {myColor = 5 ;}

var clr = colours[myColor] ;   

// alert(' Button clicked text = ' + n + ' Num ' + numerator + ' Denom ' + denominator) ;

var length = 600 * denominator / (n * numerator) ;  // sets length of clicked button when it goes to myAnswer

// make button to append to p#myAnswer

  var term = '$ \\frac{ ' + 1 + '} {' + n + '} $' ;
    var btnClicked = $('<button  />', {
      type: 'button',
      text: term,
      class: 'fraction',
      id: 'clicked-'+n,
      css: {"background-color":clr,"color":"white" , "width":length ,
      "font-size":"16pt","font-weight":"bold" } 

      });

var frac = [] ;
frac = addFractions(sumNumerator,sumDenominator,1,n,0,1) ;   
sumNumerator = frac[0] ;
sumDenominator = frac[1] ;


var sumFrac  = '$ \\frac{ ' + sumNumerator + '} {' + sumDenominator + '} $' ;

if (clicksMedium == 1)
{myAttempt = myAttempt  + ' ' + term  ; 
$('#sum').html(myAttempt + ' = ' + sumFrac) ;}


if (clicksMedium == 2)
{myAttempt = myAttempt  + ' + ' + term   ; 
$('#sum').html(myAttempt + ' = ' + sumFrac) ;}

if (clicksMedium == 3)
{myAttempt = myAttempt  + ' + ' + term  ; 
$('#sum').html(myAttempt + ' = ' + sumFrac) ;
$('[id^=btn-]').hide() ;}



// $('#temp').html(myAttempt) ;
 MathJax.Hub.Queue(["Typeset", MathJax.Hub, "temp"]);
// $('#sum').html(myAttempt + sumFrac) ;
MathJax.Hub.Queue(["Typeset", MathJax.Hub, "sum"]);

$('#myAnswer').append(btnClicked) ;
$('#btn-'+n).hide() ;
MathJax.Hub.Queue(["Typeset", MathJax.Hub, "myAnswer"]);

// check answer ;

var correct = (numerator == sumNumerator & denominator == sumDenominator ) ;
if (correct)
{
  $('#clear').hide() ;
  
     // 1. UPDATE THIS WINDOW'S UI (Just like checkAnswer does)
            $('#feedback').removeClass('text-danger text-warning').addClass('text-success').html('✅ CORRECT! The door is open!');
            $('.door-btn').prop('disabled', true);
            $('#btnDoorCheck').prop('disabled', true).removeClass('btn-primary').addClass('btn-success').text('✓');
            $('#currentGuess').css({'background-color': '#c8e6c9', 'border-color': '#198754', 'color': 'black'});
            
            // 2. SIMULATE checkAnswer() SENDING SUCCESS TO THE DASHBOARD
            setTimeout(function() {
                if (typeof window.parent.handleCorrectAnswer === 'function') {
                    window.parent.handleCorrectAnswer(); // The standard utilities.js signal
                } else if (typeof window.parent.questionSolved === 'function') {
                    window.parent.questionSolved(); // The fallback custom signal
                } else {
                    console.log("Success! (Not running in dashboard iframe)");
                }
            }, 1000);

  

}

if (clicksMedium >= 3 & !correct)
   {
  //  alert('Not correct - clear and try again') ; 
$('#clear').show() ;
}


      })
   })

 </script>