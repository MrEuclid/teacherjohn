<?php 
$question = isset($_POST['question']) ? $_POST['question'] : 'quadratics G10';
?>

<!DOCTYPE html>
<html lang="en">

  <head>
 
 
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.com/libraries/mathjs"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/7.5.1/math.min.js"></script>

 <link rel="stylesheet" href="raceGeminiStyles.css">

<script src="javascript/utilities.js"></script>
    
    
  <script type="text/x-mathjax-config">
    MathJax.Hub.Config({
      extensions: ["tex2jax.js"],
      jax: ["input/TeX","output/HTML-CSS"],
      tex2jax: {inlineMath: [["$","$"],["\\(","\\)"]]}
    });
  </script>   
  
 

 
  
<link rel="stylesheet" href="raceGeminiStyles.css">


<title>Quadratic equations hard</title>

<style>
    label {font-weight: bold; color:black;}
input {
        text-align: center; 
        background-color: lightgreen; 
        font-size: 1.2em; 
        font-weight: bold;
        margin-right: 2em;
        width: 5em;
        }

[id^=solution]  {text-align: center;margin-bottom:1em;}
[id^=check] {margin-bottom:1em;}
[id^=equation] {margin-bottom:1em; font-weight: bold; font-size: 1.2m; color:green;}
</style>


</head>
<body>

    <div class  = "container-fluid">


    <div class = "row">
      <div class = "col-12 text-center">


    <h4 id = "equation"></h4>
  
 
 <h2>Solve f(x) = 0, that is, find x so that f(x) = 0</h2>
 <h3>Find the biggest answer for each equation. Answers to 2dp</h3>
</div></div>

<div class="row align-items-center mb-4">
    <div class="col-8">   
        <label id="equation1" class="fw-bold fs-5"></label>
    </div>
    <div class="col-2">   
        <input id="solution1" class="form-control" placeholder="Answer">
    </div>
    <div class="col-2"> 
        <button id="check1" class="btn btn-outline-primary w-100 fw-bold">Check 1</button>
    </div>
</div>

<div class="row align-items-center mb-4">
    <div class="col-8">   
        <label id="equation2" class="fw-bold fs-5"></label>
    </div>
    <div class="col-2">   
        <input id="solution2" class="form-control" placeholder="Answer">
    </div>
    <div class="col-2"> 
        <button id="check2" class="btn btn-outline-primary w-100 fw-bold">Check 2</button>
    </div>
</div>

<div class="row align-items-center mb-4">
    <div class="col-8 text-left">   
        <label id="equation3" class="fw-bold fs-5"></label>
    </div>
    <div class="col-2">   
        <input id="solution3" class="form-control" placeholder="Answer">
    </div>
    <div class="col-2"> 
        <button id="check3" class="btn btn-outline-primary w-100 fw-bold">Check 3</button>
    </div>
</div>

<div class="row align-items-center mb-4">
    <div class="col-8">   
        <label id="equation4" class="fw-bold fs-5"></label>
    </div>
    <div class="col-2">   
        <input id="solution4" class="form-control" placeholder="Answer">
    </div>
    <div class="col-2"> 
        <button id="check4" class="btn btn-outline-primary w-100 fw-bold">Check 4</button>
    </div>
</div>

<!--
 <div class = "row justify-content-evenly">
      <div class = "col-3">
    <div id = "ex4"></div>
    </div>
    
 <div class = "col-3"> 
<label id = "equation4"></label>
</div>

<div class = "col-3">   
<input id = "solution4">
</div>

 <div class = "col-3"> 
<button id = "check4">Check 4</button>
</div>
</div>

-->



</div>

</body>
</html>


<script type="text/javascript">
    
    function makeQuestion1()


    {
// coeffX > 0
     let a = 0;
     let b = 0;

     while ( gcd(a,b) != 1 | a == b)
     {
        b = randomInteger(1,5);
        a = randomInteger(6,11);
        console.log(a,b);
     }
n = randomInteger(2,7);
 n = 2;
     // (2x + a)(x+b) = 0;
     //= 2x^2 + (a+b)/2x - ab/2 
     coeffX = parseInt(a + n*b);
     last = a*b ;

   expr = '$' + n + 'x^2 + ' + coeffX +'x' + ' + ' +last + ' = 0 $'; 

    $('#equation1').html(expr);
    MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation1" ]);

        x1 = -a/2;
        x1 = round2DP(x1);
        x2 = -b;
        const largest = Math.max(x1, x2);
        return largest;
        
    }
</script>

<script type="text/javascript">
    
    function makeQuestion2()


   
    {
        let term = 'x';
// coeffX > 0
     let a = 0;
     let b = 0;

     while ( gcd(a,b) != 1 | a == n*b)
     {
        b = randomInteger(4,1);
        a = randomInteger(6,11);
        console.log(a,b);
     }
n = randomInteger(2,7);
// n = 2;
     // (nx + a)(x-b) = 0;
     //= nx^2 + (a-nb)x - ab 
     coeffX = -parseInt(a+n*b);  
     last = a*b ;
     if (coeffX == 1){term = ' +x';}
      if (coeffX == -1){term = '-x';}
       if (coeffX > 1){term = coeffX + 'x';}
       if (coeffX < -1){term = coeffX + 'x';}
if (coeffX > 1)
   {expr = '$' + n + 'x^2 + ' + term; }
else
  {expr = '$' + n + 'x^2' + term; }

   expr = expr  + ' + ' + last + ' = 0 $'; 



    $('#equation2').html(expr);
    MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation2" ]);
        x1 = a/n;
        x1 = round2DP(x1);
        x2 = b;
                const largest = Math.max(x1, x2);
        return largest;

        
    }

    
</script>


<script type="text/javascript">
    
    function makeQuestion3()


   
    {
        let term = 'x';
// coeffX > 0
     let a = 0;
     let b = 0;

     while ( gcd(a,b) != 1 | a == b)
     {
        b = randomInteger(1,4);
        a = randomInteger(6,11);
        console.log(a,b);
     }
n = randomInteger(2,7);
// n = 2;
     // (nx - a)(x+b) = 0;
     //= nx^2 + (-a+nb)x - ab 
     coeffX = -parseInt(-a+n*b);  
     console.log(n,a,b,a+b*n);
     last = -a*b ;
     if (coeffX == 1){term = 'x';}
      if (coeffX == -1){term = '-x';}
    if (Math.abs(coeffX) > 1){term = coeffX + 'x';}
if (coeffX > 0)
   {expr = '$' + n + 'x^2 + ' + term; }
else
  {expr = '$' + n + 'x^2' + term; }

if (last > 0)
   {expr = expr  + ' + ' + last + ' = 0 $'; }
else
  {expr = expr + ' ' + last + ' = 0 $'; }



    $('#equation3').html(expr);
    MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation3" ]);
        x1 = -a/n;
        x1 = round2DP(x1);
        x2 = b;
        const largest = Math.max(x1, x2);
        return largest;
        
    }

</script>



<script type="text/javascript">
    
    function makeQuestion4()


    {
        let term = 'x';
// coeffX > 0
     let a = 0;
     let b = 0;

     while ( gcd(a,b) != 1 | a == b)
     {
        b = randomInteger(1,3);
        a = randomInteger(2,5);
        console.log(a,b);
     }
p = randomInteger(1,4);
q = randomInteger(2,3);
console.log(p,q,a,b,a*q+b*p);
     // (px + a)(qx+b) = 0;
     //= pqx^2 +x(aq + bp) + ab
     coeffX = parseInt(a*q + b*p);  
     last = a*b ;
     if (coeffX == 1){term = 'x';}
      if (coeffX == -1){term = '-x';}
      if (Math.abs(coeffX) > 1){term = coeffX + 'x';}
if (coeffX > 0)
   {expr = '$' + p*q + 'x^2 + ' + term; }
else
  {expr = '$' + p*q + 'x^2' + term; }

if (last > 0)
   {expr = expr  + ' + ' + last + ' = 0 $'; }
else
  {expr = expr + ' ' + last + ' = 0 $'; }



    $('#equation4').html(expr);
    MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation4" ]);
        x1 = a/p;
        x1 = round2DP(x1);
        x2 = b/q;
        x2 = round2DP(x2);
        const largest = Math.max(x1, x2);
        return largest;
        
    }


    
</script>

<script>
// 1. GLOBAL VARIABLES (Must be defined cleanly)
var answer = [];
var correct = 0;
var points = 0;
// Global variables for canvas

</script>

<script type="text/javascript">
  
    $(document).ready(function(){
   
    question = '<?php echo $question; ?>' ;
// points = question.substr(-1);
// calculate points on exit
// $('#cancel').text("Exit");
answer = [];
answer[1] = makeQuestion1() ;
answer[2] = makeQuestion2() ;
answer[3] = makeQuestion3() ;
answer[4] = makeQuestion4() ;


// alert(answer);
correct = 0 ; // number correct;
points = 0 ;
checkAnswer(4)
console.log(answer);

  })


</script>



