<?php 

 $question = isset($_POST['question']) ? $_POST['question'] : '';
// line intersecting a parabola at AB, find the length of AB
?>

<!DOCTYPE html>
<title>Egyptian Fractions - easy</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/11.8.0/math.min.js"></script>

  <script type="text/x-mathjax-config">
    MathJax.Hub.Config({
      extensions: ["tex2jax.js"],
      jax: ["input/TeX","output/HTML-CSS"],
      tex2jax: {inlineMath: [["$","$"],["\\(","\\)"]]}
    });
  </script>   
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.7/MathJax.js"></script>


  <script src="javascript/utilities.js"></script>

<style type="text/css">


    p {text-align: left;
margin-left: 10% ;
margin-right: 10% ;
font-family: sans-serif;
font-size: 12pt ;
font-style: normal;
font-weight:normal;}

/* Forces exactly 4 buttons per row */
.fraction-grid {
    display: grid !important;
    grid-template-columns: repeat(4, 1fr) !important; 
    gap: 10px !important;
    max-width: 450px !important;
    margin: 20px auto !important;
    padding: 0 !important;
}

/* Rounded Button Styling */
[id^="btn-"] {
    border-radius: 15px !important; 
    width: 100% !important; 
    height: 65px !important;
    margin: 0 !important; 
    box-sizing: border-box !important;
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

  .big {width:80% ; height: auto;
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


</style>

 </head>


 <body> 

 


<div class = "container-fluid">


<div class = "row">
  <div class = "col-sm-12 text-center">

  	<button id = "clear" class="btn btn-danger bigWriting">Clear</button>
   
  </div></div>

<div class = "row">
   <div class = "col- text-center">
    <h3>Fraction equation</h3>
<br>
    <button id = "bigFraction" class = "big"></button>
 <br><br>   
     <h2 class = "text-center" id = "sum"></h2>
      <br><br>
    <p id = "myAnswer" class = "text-center"></p>
    
</div></div>

  <div class = "row">
   <div class = "col- text-center">


    
<div id = "buttonDisplay">
<div class="fraction-grid">
    </div>

</div>

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
  
  function addFractions(a,b,c,d)

  {
   var num = a*d + b*c ;
   var den = b*d ;
   var factor = gcd(num,den) ;
   num = num / factor ;
   den = den / factor ;
   var f = [] ;
   f[0] = num ;
   f[1] = den ;
   
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

question = '<?php echo $question; ?>' ;
points = question.substr(-1);

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

$('buttonDisplay').hide() ;
$('#bigFraction').hide() ;
$('[id^=btn-]').hide() ;
$('#clear').hide() ;

shapes = [] ;
shapes[1] = "&#10004;"  ; // tick
shapes[2] = "&#9733;"  ; // star
shapes[3] = "&#10084;"  ; // heart 
shapes[4] = "&#9889;"  ; // lightning

clicks = 0 ; // track clicks on each attempt 
clicksEasy = 0 ;
clicksMax = 2 ;

   cntMoves = 1 ;
 
cnt = 0;
for (i = 2; i <= 19; i++) {
    // Append directly inside the grid container!
    $(".fraction-grid").append(createButton(i)); 
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


$('#buttonDisplay').show() ;
$('#myAnswer').text('') ;

clicksEasy = 0 ;
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
  d2 = getRandomInt(2,limit)  ;
  // alert('Numerator = ' + numerator + ' Denominator ' + denominator) ;

  if (d1 != d2) {equal = 0;}
  }   

  var f = [] ;
  f = addFractions(1,d1,1,d2) ;
  numerator = f[0];
  denominator = f[1] ;
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
clicksEasy = 0 ;
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
clicksEasy = clicksEasy + 1 ;
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
frac = addFractions(sumNumerator,sumDenominator,1,n) ;   
sumNumerator = frac[0] ;
sumDenominator = frac[1] ;


var sumFrac  = '$ \\frac{ ' + sumNumerator + '} {' + sumDenominator + '} $' ;

if (clicksEasy == 1)
{myAttempt = myAttempt  + ' ' + term  ; 
$('#sum').html(myAttempt + ' = ' + sumFrac) ;}


if (clicksEasy == 2)
{myAttempt = myAttempt  + ' + ' + term + ' = '  ; 
$('#sum').html(myAttempt + sumFrac) ;
$('[id^=btn-]').hide() ;}


// $('#temp').html(myAttempt) ;
 MathJax.Hub.Queue(["Typeset", MathJax.Hub, "temp"]);
// $('#sum').html(myAttempt + sumFrac) ;
MathJax.Hub.Queue(["Typeset", MathJax.Hub, "sum"]);

$('#myAnswer').append(btnClicked) ;
$('#btn-'+n).hide() ;
MathJax.Hub.Queue(["Typeset", MathJax.Hub, "myAnswer"]);

// check answer ;

var correct = (numerator == sumNumerator & denominator == sumDenominator) ;
if (correct && clicksEasy == 2)
{
    $('#clear').hide() ;

  alert("solved");
            
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

if (clicksEasy == 2 & !correct) {alert('Not correct - clear and try again'); 
$('#clear').show() ;
}


      })
   })

 </script>