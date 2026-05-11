<?php 
$question = isset($_POST['question']) ? $_POST['question'] : 'E2 equations';

?>

<!DOCTYPE html>
<html lang="en">

  <head>
 
 
  <meta charset="UTF-8">
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

    <div class  = "container-fluid">

 
    <div class  = "container-fluid">


    <div class = "row">
      <div class = "col-12 text-center">

    <h1>Find the numbers x and y</h1>
    <h3>x and y are whole numbers.</h3>
  
</div></div>


 <div class = "row">
      <div class = "col- 12 text-center">

<p id = "equations"></p>

</div></div>


 <div class = "row">
      <div class = "col-12 text-center">

        <label>x  = </label><input id = "solution1">    
        <button id = "check1" >Check</button>
</div></div>
       
     
 <div class = "row">
      <div class = "col-12 text-center">  
        <label>y  = </label><input id = "solution2">
         <button id = "check2" >Check</button>

</div></div>



</div>

</body>
</html>

<script type="text/javascript">
    

      function randomInteger(min, max) { // min and max included 
  return Math.floor(Math.random() * (max - min + 1) + min);
}
</script>


<script type="text/javascript">
    

    function makeEquation_1()

   {

// 4x^2 + 1 = N
// x > 6 and x < 20
 let x = randomInteger(6,20);
  
let N  = 4*x*x - 1 
var expr = '$ 4x^2 + 1  = ' +  N +  ' x = $';

  $('#equations').html(expr);
       MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation1" ]);
console.log(expr,x,y,z1,z2);



answer = x;
console.log(answer);
      return answer;
    }
</script>

<script type="text/javascript">
  
    $(document).ready(function(){
     var points = 0;
    var answer = [];
    var correct = 0;
    question = '<?php echo $question; ?>' ;
// points = question.substr(-1);
// calculate points on exit
// $('#cancel').text("Exit");

a = [];

answer[0] = makeEquation_1();

checkAnswer(1)
// console.log(answer);
  })

// 1. Declare the answer array OUTSIDE the ready function so utilities.js can see it globally
var answer = [];
 var correct = 0;
 var points = 0;
$(document).ready(function(){
   
   
    var question = '<?php echo $question; ?>';

    // 2. Grab the generated x and y from your function
    var generatedValues = makeEquations();

    // 3. Manually map x to index 1, and y to index 2 so they match check1 and check2
    answer[1] = generatedValues[0]; // This is 'x'
    answer[2] = generatedValues[1]; // This is 'y'

    // Initialize the checkAnswer utility for 2 questions
    checkAnswer(2);
    
    console.log("Answers mapped for utilities.js: ", answer);
});
</script>

