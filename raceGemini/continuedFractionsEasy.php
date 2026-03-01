<?php 
 
$question = isset($_POST['question']) ? $_POST['question'] : 'Continued fractions';

?>

<!DOCTYPE html>
<html lang="en">

  <head>
 
 
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"></script>
    
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
  
  <script type="text/javascript" src="../MathJax-2.7.5/MathJax.js"></script>

<title>Continued fractions</title>

<style>

#code {font-size: 2em ; color:red;}

#eqtn, #eqtn2, #equation {
        font-size: 2em;
        font-weight: bold;
        color: blue;
        text-align: center;
        }

input {
        text-align: center; 
       
        font-size: 1.2em; 
        font-weight: bold;
        margin-right: 2em;
        width: 4em;
        }

#equation {color:green ;}

label {font-size: 1.2em; font-weight: bold; margin-right: 2em;}
</style>


</head>
<body>

    <div class  = "container-fluid">

    <div class = "row">
      <div class = "col-sm-12 c">

    <h1>Continued Fractions</h1>
 
  
</div></div>


 <div class = "row">
      <div class = "col- c">


<p id = "eqtn2">
    $  2 +  \frac{1}{2 + \frac{1}{2+1}} $   
    $ = 2 + \frac{1}{2 + \frac{1}{3}} $
     $  = 2 + \frac{1}{\frac{7}{3}} $
     $ = 2 + \frac{3}{7} $
     $ = \frac{17}{7} $
  
</p>

</div></div>



 <div class = "row justify-content-center">
      <div class = "col-">
    <p id = "equation"></p>
    </div></div>
    

 <div class = "row justify-content-center">
      <div class = "col- ">


        <label>a = </label><input id = "solution1"> <button id = "check1" >Check a</button>
         <label>b = </label><input id = "solution2">
         <button id = "check2" >Check b</button>

</div></div>


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
    
    function convergent(n)

    {
        let terms = []; 
        // step 1 n = 2 ;
        den = +n + 1 ;   d = 3
        // step 2 = n + 1/d 
        num = n*den  + 1 ; // 2x3 + 1 = 7
        console.log(num,den);
        // step 3 invert 
        t = num;   // t = 7
        num = den;  // num = 3 
        den = t; // den = 7
        // now n + num/den
        t = +n*den + num;
        num = t; 
     terms[0] = [num,den];
return terms[0];

    }
</script>


<script>

    function makeQuestion()

    {

 
let n = randomInteger(3,10);
let numerator = 1;
let denominator = 1;


 
let expr =  '$' +   n + ' + \\frac{1}{' + n + ' + \\frac{1}{' + n + ' + 1}}  = \\frac{a}{b} $';

        $('#equation').html(expr);
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation" ]);

// do this for each levelof the continued fractions, adding n to the fraction and then inverting



// alert(sum[0] + "  3 " + sum[1]);
// level 1
answer = convergent(n) ; 
// alert(sum[0] + " 2 " + sum[1]);

// level 1 


// alert("answer = " + answer[0] + "  " + answer[1]);

        return answer;

    }
</script>




<script type="text/javascript">
  
    $(document).ready(function(){
   
 let ans = [];
ans = makeQuestion();
ans.unshift(0);
console.log("ans",ans);
answer[1] = ans[1];
answer[2] = ans[2];
console.log("answer ",answer);
checkAnswer(2);
})

</script>
