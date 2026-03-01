<?php 
$question = isset($_POST['question']) ? $_POST['question'] : 'Knapsack hard';
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

<link rel="stylesheet" href="race2024.css">
<script src="javascript/utilities.js">

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

<title>Knapsack easy</title>

<style>

input {
    text-align: center; 
    background-color: lightyellow; 
    color: black; 
    font-size: 1.2em;
    font-weight: bold;
    height:2em;
    margin:1em;
    width:4em; }
label {font-weight: bolder; font-size: 2em; margin: 1em;}

#equations {
            text-align: center;
            font-size: 1.6em;
            font-weight: bold;
}

h2 : {text-align: center; color:blue;}
h4 : {text-align: green;}
</style>


</head>
<body>

    <div class  = "container-fluid">

        <div class = "row">
            <div class = "col-sm-12 c">
                <p id = "stars"></p>
                </div></div>

   <div class = "row">
      <div class = "col-12 c">
 <h2>Use these numbers to answer the question.</h2>

</div></div>

    <div class = "row">
      <div class = "col-12 c">
 <h4 id = "possibles"></h4>
</div></div>


 <div class = "row">
      <div class = "col- c">

<p id = "equations"></p>

</div></div>


 <div class = "row">
      <div class = "col- 12 c">

        <label>a + b + c +d = </label><input id = "solution1">
        
        <button id = "check1" >Check</button>

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
    

    function makeQuestion()

 
// x + y = N

    {
        let a = numbers[0];
        let b = numbers[1];
        let c = numbers[2];
        let d = numbers[3]
        n = parseInt(a*b + c*d);
        let question  = 'Find a + b + c + d  x y = ' + n + " and "  + "x < y" ; 
     //   $('#ex1').text(question);
      
       
        var expr = '$ ab + cd  ' + ' = ' + n + '$'  ;
        $('#equations').html(expr);
         MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equations" ]);
        answer = n
        console.log("q1",a,b,c,d,n,answer,expr);
        return n ;
    }


</script>

<script type="text/javascript">
  

$(document).ready(function(){   
// problem 
p = [];
numbers = [];
max = 29 ;
numbers = makePrimes(max);
numbersOriginal = numbers.slice();
shuffle(numbers);
// alert(numbers);
$('#possibles').text('(');

let l = numbers.length;

for (let i = 0; i < l -1  ; i++)
{
    $('#possibles').append(numbersOriginal[i] + ",");
}
$('#possibles').append(numbersOriginal[l-1] + ")");
p = makeQuestion();
alert(p);
answer = [];
answer[1] = p;
checkAnswer(1);
console.log(answer);
}) 
</script>

