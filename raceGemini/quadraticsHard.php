<?php 
$question = $_POST['question'];
?>

<!DOCTYPE html>
<html lang="en">

  <head>
 
 
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../bootstrap-5.0.2-dist/css/bootstrap.min.css">
  <script src="../javaScript/jQuery/jquery-3.3.1.min.js"></script>
  <script src="../bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>

   <script src="https://cdnjs.com/libraries/mathjs"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/7.5.1/math.min.js"></script>

    
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

  <script type="text/javascript" src="../javaScript/mathJax/MathJax-2.7.7/MathJax.js"></script>

<link rel="stylesheet" href="../css/templeStyles.css">
<link rel="stylesheet" href="../css/newTempleStyles.css">
   <link rel="stylesheet" href="race2024.css">

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
  
  <script type="text/javascript" src="../MathJax-2.7.5/MathJax.js"></script>
  <link rel="stylesheet" href="race2024.css">

<script src="javascript/utilities.js"></script>


<title>Quadratic equations</title>

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
      <div class = "col-sm-12 c">


    <h4 id = "equation"></h4>
  
 
 <h2>Solve f(x) = 0, that is, find x so that f(x) = 0</h2>
 <h3>There will be two answers for each equation. Answers to 2dp</h3>
</div></div>


 <div class = "row justify-content-center">
      <div class = "col-3">
    <div id = "ex1"></div>
    </div>
    
    <div class = "col-3">   
<label id = "equation1"></label>
</div>

    <div class = "col-2">   
<input id = "solution1a">
</div>

   <div class = "col-2">   
 <input id = "solution1b">
</div>

 <div class = "col-2"> 
<button id = "check1">Check 1</button>
</div>
</div>



 <div class = "row justify-content-center">
      <div class = "col-3">
    <div id = "ex2"></div>
    </div>
    
    <div class = "col-3">   
<label id = "equation2"></label>
</div>

    <div class = "col-2">   
<input id = "solution2a">
</div>

   <div class = "col-2">   
 <input id = "solution2b">
</div>

 <div class = "col-2"> 
<button id = "check2">Check 2</button>
</div>
</div>




 <div class = "row justify-content-center">
      <div class = "col-3">
    <div id = "ex3"></div>
    </div>
    
    <div class = "col-3">   
<label id = "equation3"></label>
</div>

    <div class = "col-2">   
<input id = "solution3a">
</div>

   <div class = "col-2">   
 <input id = "solution3b">
</div>

 <div class = "col-2"> 
<button id = "check3">Check 3</button>
</div>
</div>

<div class = "row">
</div></div>


 <div class = "row justify-content-center">
      <div class = "col-3">
    <div id = "ex4"></div>
    </div>
    
    <div class = "col-3">   
<label id = "equation4"></label>
</div>

    <div class = "col-2">   
<input id = "solution4a">
</div>

   <div class = "col-2">   
 <input id = "solution4b">
</div>

 <div class = "col-2"> 
<button id = "check4">Check 4</button>
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
        return [x1,x2];
        
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
        return [x1,x2];
        
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
        return [x1,x2];
        
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
        return [-x1,-x2];
        
    }


    
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

console.log(answer);

  })


</script>








<script>
      $(document).ready(function(){
    $('[id^=check]').on('click', function()


    {
        var clicked = this.id;
        var qNumber = clicked.slice(-1);
      //  alert("Checking " + qNumber);

         var guess1 = $('#solution' + qNumber + 'a').val() ;
         var guess2 = $('#solution' + qNumber + 'b').val() ;
            guess1 = parseFloat(guess1);
            guess2 = parseFloat(guess2);
         var sum = +answer[qNumber][0] + answer[qNumber][1];
         var prod = answer[qNumber][0] *answer[qNumber][1] ;
         console.log(sum,prod,guess1,guess2);
        if (+guess1 + guess2 == sum & guess1*guess2 == prod)
        {
           // alert("Correct");
    $('#solution' + qNumber + 'a').prop('disabled',true).css({"background-color":"lightgreen","color":"black"});
    $('#solution' + qNumber + 'b').prop('disabled',true).css({"background-color":"lightgreen","color":"black"});
            $('#' + clicked).hide() ;
            
            points = parseInt(points +2);
            console.log("points", points,clicked,qNumber);
            if (points == 8)

            {

            //    alert("You have solved " + points/3 + " equations!");
alert("Processing win " + questionID + " with " + points + " pts");
processWin(questionID);
    console.log("processing ",questionID);

            }
        }

        else

        {
            alert("keep trying")
        }
})
})

</script>



