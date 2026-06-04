<?php 
$question = isset($_POST['question']) ? $_POST['question'] : 'Cubic MaxMin';
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


<script src="javascript/utilities.js"></script>

   <link rel="stylesheet" href="raceGeminiStyles.css">

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

<title>Functions</title>

<style>

</style>


</head>
<body>

    <div class  = "container-fluid">


    <div class = "row">
      <div class = "col-sm-12 c">


    <h4 id = "equation"></h4>
  
 
 <h3>Solve f(x) = 0, that is, find x so that f(x) = 0</h3>
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

<div class = "row">
      <div class = "col-sm-12 c">
  $ x_{1} < x_{2} < x_{3} $
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
<script>

function multiplyAndSimplify(expr1, expr2) {
  // Split expressions into terms (assuming no parenthesis within terms)
  const terms1 = expr1.split(/[-+]/);
  const terms2 = expr2.split(/[-+]/);

  let result = "";
  
  // Loop through each term in the first expression
  for (const term1 of terms1) {
    // Loop through each term in the second expression
    for (const term2 of terms2) {
      const product = multiplyTerms(term1, term2);
      result += (result === "" ? "" : "+") + product;
    }
  }

  return simplifyExpression(result);
}

function multiplyTerms(term1, term2) {
  // Check if either term is a number
  if (!isNaN(term1)) {
    return term1 * term2;
  } else if (!isNaN(term2)) {
    return multiplyTerms(term2, term1); // Swap order for easier handling
  }

  // Extract coefficient and variable from term (assuming format "coefficient*variable")
  const coefficient1 = parseFloat(term1.match(/^[^-]*(-?\d*)/)[1]);
  const variable1 = term1.replace(/^[^-]*(-?\d*)/, "");
  const coefficient2 = parseFloat(term2.match(/^[^-]*(-?\d*)/)[1]);
  const variable2 = term2.replace(/^[^-]*(-?\d*)/, "");

  // Combine like terms
  return (coefficient1 * coefficient2) + (variable1 === variable2 ? variable1 : variable1 + variable2);
}

function simplifyExpression(expr) {
  // Combine like terms (basic implementation)
  const terms = expr.split(/[-+]/);
  const coefficientMap = {};
  let result = "";

  for (const term of terms) {
    const variable = term.replace(/^[^-]*(-?\d*)/, "");
    const coefficient = parseFloat(term.match(/^[^-]*(-?\d*)/)[1]);

    if (coefficientMap[variable]) {
      coefficientMap[variable] += coefficient;
    } else {
      coefficientMap[variable] = coefficient;
    }
  }

  for (const variable in coefficientMap) {
    const coefficient = coefficientMap[variable];
    if (coefficient !== 0) {
      result += (result === "" ? "" : "+") + (coefficient === 1 ? variable : (coefficient === -1 ? "-" + variable : coefficient + variable));
    }
  }

  return result.replace(/^\+/, ""); // Remove leading "+" sign if present
}

// Example usage
const expr1 = "2x-3";
const expr2 = "x+4";
const result = multiplyAndSimplify(expr1, expr2);
console.log(result); // Output: 2x^2 + 5x - 12

const expr3 = "x^2-5x+6";
const expr4 = "2x+3";
const result2 = multiplyAndSimplify(expr3, expr4);
console.log(result2); // Output: 2x^3 - x^2 - 3x + 18


    function makeCubic()

   
    {
// factorise a cubic 
var a = 0 ; 
var b = 0 ; 
var c = 0 ;
var roots = [];
var quadratic = 0;
var linear = 0 ;
while (a == b | a== c | b ==c | a*b*c == 0 | quadratic == 0 | linear == 0)
{
    a = randomInteger(1,5);
    b = randomInteger(1,5);
    c = randomInteger(1,5);
    quadratic = parseInt(a - b + c);
    linear = parseInt(-a*b + a*c - b*c);
}

// ((x+a)(x−b)(x+c)) = x^3 + (a-b+c)x^2 + (-ab + ac -bc)x -abc

var constant  = -a*b*c;

if (quadratic < 0) 
    {qterm = quadratic;}
else
     {qterm = '+' + quadratic;}

 if (quadratic == 1) {qterm = "+";}

 if (linear < 0) 
    {lterm =  linear;}
else
     {lterm = '+' + linear;}
 if (linear == 1) {lterm= "+";}

 if (constant > 0)
 {cterm = '+' + constant;}
 else
 {cterm = constant;}

console.log(qterm,lterm,constant);
var expr = "$ f(x) = x^3 " + qterm + "x^2" + lterm + "x" + cterm + "$" ;
var answer = parseInt(-a + b - c);
  $('#equation').html(expr);
       MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation3" ]);
console.log(expr);
r= [-a,b,-c];
roots = r.sort(function(a, b){return a - b});

console.log(r,roots);

      return roots;




    }
</script>


<script type="text/javascript">
    

      function randomInteger(min, max) { // min and max included 
  return Math.floor(Math.random() * (max - min + 1) + min);
}
</script>


<script type="text/javascript">
    
    function makeQuestion1()


    {
       
       var expr = "$ x_{1} = $";
  
        $('#equation1').html(expr);
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation1" ]);

        var x1 = roots[0];
        console.log(expr,x1);
        return x1;
        
    }
</script>

<script type="text/javascript">
    
    function makeQuestion2()


    {
    
      var expr = "$ x_{2} = $";
  
  $('#equation2').html(expr);
  MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation2" ]);

  var x2= roots[1];
  console.log(expr,x2);
  return x2;



    }
</script>


<script type="text/javascript">
    
    function makeQuestion3()


    {
      var expr = "$ x_{3} = $";
  
  $('#equation3').html(expr);
  MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation3" ]);

  var x3 = roots[2];
  console.log(expr,x3);
  return x3;

    }
</script>




<script type="text/javascript">
  
    $(document).ready(function(){
   
    question = '<?php echo $question; ?>' ;
// points = question.substr(-1);
// calculate points on exit
// $('#cancel').text("Exit");
roots = [];
answer = [] ;
roots = makeCubic();
answer[1] = makeQuestion1() ;
answer[2] = makeQuestion2() ;
answer[3] = makeQuestion3() ;
//answer[4] = makeQuestion4() ;

checkAnswer(3);
console.log(answer);
console.log(roots);
  })


</script>


