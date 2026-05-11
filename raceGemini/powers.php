<?php 
$question = isset($_POST['question']) ? $_POST['question'] : 'Exponenti equations';

?>

<!DOCTYPE html>
<html lang="en">

  <head>
 
 
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"></script>
<link rel = "stylesheet" href="raceGeminiStyles.css">
  <script type="text/x-mathjax-config">
    MathJax.Hub.Config({
      extensions: ["tex2jax.js"],
      jax: ["input/TeX","output/HTML-CSS"],
      tex2jax: {inlineMath: [["$","$"],["\\(","\\)"]]}
    });
  </script>   
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.7/MathJax.js"></script>
  <script src="javascript/utilities.js"></script>

<title>Find x,y</title>

<style>

input {
    text-align: center; 
    background-color: lightyellow; 
    color: black; 
    font-size: 1.2em;
    font-weight: bold;
    height:40px;
    margin:5px;
    width:5em; }
label {font-weight: bolder; font-size: 2em; margin: 1em;}
</style>


</head>
<body>
<div class="container-fluid comp-play-area py-4">
    <div class="row mb-5">
        <div class="col-12 text-center comp-header">
            <h1 class="comp-title">Find x and y</h1>
            <h2 class="comp-subtitle">Generic Equations</h2>
        </div>
    </div>

    <div class="row justify-content-center">
        
        <div class="col-12 col-md-5 mb-4">
            <div id="ex1" class="question-card shadow-sm">
                <span class="question-badge">Q1</span>
                
                <label id="equation1" class="math-equation d-block"></label>
                
                <div class="input-group mt-3">
                    <input type="text" id="solution1" class="form-control solution-input" placeholder="Your answer...">
                    <button id="check1" class="btn btn-comp-check">Check 1</button>
                </div>
            </div>
        </div>
 <div class="row justify-content-center">
        <div class="col-12 col-md-5 mb-4">
            <div id="ex2" class="question-card shadow-sm">
                <span class="question-badge">Q2</span>
                
                <label id="equation2" class="math-equation d-block"></label>
                
                <div class="input-group mt-3">
                    <input type="text" id="solution2" class="form-control solution-input" placeholder="Your answer...">
                    <button id="check2" class="btn btn-comp-check">Check 2</button>
                </div>
            </div>
        </div>
</div>
    </div>
</div>
</body>
</html>

<script type="text/javascript">
    

      function randomInteger(min, max) { // min and max included 
  return Math.floor(Math.random() * (max - min + 1) + min);
}
</script>


<script type="text/javascript">
    

    function makeEquation_2()

   {

// 42^x - 1  = N
// x > 4 and x < 10
 let x = randomInteger(4,10);
  
let N  = 2**x - 1
var expr = '$ 2^y -1   = ' +  N +  '$';

  $('#equation2').html(expr);
       MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation2" ]);


      return x;
    }


    function makeEquation_1()

   {

// 4x^2 + 1 = N
// x > 6 and x < 20

 let x = randomInteger(6,20);
  
let N  = +(4*x*x + 1) ;
var expr = '$ 4x^2 + 1  = ' +  N +  '$';

  $('#equation1').html(expr);
       MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation1" ]);



      return x;
    }


</script>

<script type="text/javascript">
  
    $(document).ready(function(){
      points = 0;
     answer = [];
     correct = 0;
    question = '<?php echo $question; ?>' ;

answer  = [];
answer[1] = makeEquation_1();
answer[2] = makeEquation_2();

checkAnswer(2);
 console.log(answer);
  })
</script>
