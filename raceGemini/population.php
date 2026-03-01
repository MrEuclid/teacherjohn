<?php 
$question = isset($_POST['question']) ? $_POST['question'] : 'Population';
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
  
   <script type="text/javascript">
    MathJax.Hub.Queue(["Typeset",MathJax.Hub]);
  </script>

  <script type="text/javascript" src="../javaScript/mathJax/MathJax-2.7.7/MathJax.js"></script>
<title>Population</title>

<style>

</style>


</head>
<body>

    <div class  = "container-fluid">

    <div class = "row">
   <div class = "col-12 c"> 
  

        <h2>How many fish?</h2>
    <h4 id = "equation"></h4>
  t is measured in months. e = 2.71828...
 

</div></div>


 <div class = "row justify-content-center">
      <div class = "col-3">
    <div id = "ex1"></div>
    </div>
    
    <div class = "col-3">   
<label id = "equation1"></label>
</div>

    <div class = "col-3">   
<input id = "solution1">
</div>

 <div class = "col-3"> 
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

<div class = "col-3">   
<input id = "solution2">
</div>

 <div class = "col-3 "> 
<button id = "check2">Check 2</button>
</div></div>



 <div class = "row justify-content-center">
      <div class = "col-3">
    <div id = "ex3"></div>
    </div>

 <div class = "col-3"> 
<label id = "equation3"></label>
</div>

<div class = "col-3">   
<input id = "solution3">
</div>

 <div class = "col-3"> 
<button id = "check3">Check 3</button>
</div></div>



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

<script>
// 1. GLOBAL VARIABLES (Must be defined cleanly)
var answer = [];
var correct = 0;
var points = 0;
// Global variables for canvas

</script>


<script type="text/javascript">
    

      function randomInteger(min, max) { // min and max included 
  return Math.floor(Math.random() * (max - min + 1) + min);
}
</script>

<script>
function makeEquation()
{
    parameters = [];
p0 = randomInteger(10,50);
r = randomInteger(1,5)/10;
    expr = "$P(t) = " + p0 + "e^" + "{" + r + "t} $";
  $('#equation').html(expr);
       MathJax.Hub.Queue(["Typeset", MathJax.Hub, "pellian" ]);
console.log(expr,p0,r);
parameters = [p0,r];
return parameters;
}
</script>


<script type="text/javascript">
    
    function makeQuestion1()


    {
       
       var expr = "What is the number of fish after 6 months?";
  
        $('#equation1').html(expr);
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation1" ]);
        e = Math.E;
        t = 6;
       x1 = p0*2.71828**(r*t);
       x1 = Math.floor(x1);
       console.log("x1",x1);
        return x1;
        
    }
</script>

<script type="text/javascript">
    
    function makeQuestion2()


    {
    
     var expr = "How many fish will there be after 1 year?";
  
        $('#equation2').html(expr);
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation1" ]);
        e = 2.71828;
        t = 12;
       x2 = p0*e**(r*t);
       x2 = Math.floor(x2);
       console.log("x2",x2);
        return x2;


    }
</script>


<script type="text/javascript">
    
    function makeQuestion3()


    {
        p = randomInteger(5,10)*100;
    var expr = "How many <strong>full</strong> months before there are  " + p + " fish in the lake?";
   expr += 'Use $ t = log(\\frac{' + p + '}{' + p0 + '} ) \\div '+ r + '$' ;
  
        $('#equation3').html(expr);
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation1" ]);
        e = 2.71828;
     
       x3 = (Math.log(p/p0))/r;
       x3 = parseInt(x3 + 1);
       console.log("x3",x3);
        return x3;

    }
</script>




<script type="text/javascript">
  
    $(document).ready(function(){
   
    question = '<?php echo $question; ?>' ;
// points = question.substr(-1);
// calculate points on exit
// $('#cancel').text("Exit");
$('#ans').val(0);
roots = [];
answer = [] ;
parameters = [];
p0 = randomInteger(10,50);
r = randomInteger(1,5)/10;
expr = "$P(t) = " + p0 + "e^" + "{" + r + "t} $";
$('#equation').html(expr);
       MathJax.Hub.Queue(["Typeset", MathJax.Hub, "pellian" ]);
console.log(expr,p0,r);
parameters = [p0,r];
//parameters = makeEquation();
p0 = parameters[0];
r = parameters[1];
console.log(parameters);
answer[1] = makeQuestion1() ;
answer[2] = makeQuestion2() ;
answer[3] = makeQuestion3() ;
//answer[4] = makeQuestion4() ;

checkAnswer(3);

console.log(answer);



</script>



