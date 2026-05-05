<?php 
$question = isset($_POST['question']) ? $_POST['question'] : 'Newtons law of cooling';
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
<
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.7/MathJax.js?config=TeX-MML-AM_CHTML"></script> <link rel="stylesheet" href="raceGeminiStyles.css">

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
 
<title>Newton</title>

<style>

</style>


</head>
<body>

    <div class  = "container-fluid">

        <div class = "row">
            <div class = "col-sm-12 c">
                <p id = "stars"></p>
                </div></div>

    <div class = "row">
      <div class = "col-sm-12 c">

    <h1>Newton&#39s Law of Cooling</h1>

<h3>
    $ T = 50e^{-kt} $
</h3>
<p>Use this formula to answer the questions about the temperature of a cup of hot coffee left to cool in a room.</p>
 

  
</div></div>


 <div class = "row">
      <div class = "col- c">
    <div id = "ex1">
<label id = "equation1"></label>
<input id = "solution1">
<button id = "check1">Check 1</button>
</div>
</div></div>



 <div class = "row">
      <div class = "col- c">
    <div id = "ex2">
<label id = "equation2"></label>
<input id = "solution2">
<button id = "check2">Check 2</button>
</div>
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
  function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

</script>

<script type="text/javascript">
    
    function gcd(a, b) {
   
   a = Math.abs(a) ;
   b = Math.abs(b) ;


    if (a == 0)
        return b;

    if (b == 0)
       return a ;  

    while (b != 0) 
    {
        if (a > b)
            a = a - b;
        else
            b = b - a;
    }

    return a;
}

</script>

<script type="text/javascript">
    

      function randomInteger(min, max) { // min and max included 
  return Math.floor(Math.random() * (max - min + 1) + min);
}
</script>

<script type="text/javascript">
    function round4DP(n)
{
roundedNum = (Math.round( n * 10000 ) / 10000);

return roundedNum;

}
</script>


<script type="text/javascript">
    
    function shuffle(array) {
  let currentIndex = array.length;

  // While there remain elements to shuffle...
  while (currentIndex != 0) {

    // Pick a remaining element...
    let randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex--;

    // And swap it with the current element.
    [array[currentIndex], array[randomIndex]] = [
      array[randomIndex], array[currentIndex]];
  }
}

</script>

<script type="text/javascript">
    
    function makeQuestion1(t,T)


    {
       
        let formula = '$ T = 50e^{-kt} $' ;
        expr = '<b>Question 1</b><br>The temperature of the coffee after ' + t + ' seconds is ' +T + '<sup>o</sup>C. Use the formula to find the value of k to 4 dp.';
        $('#equation1').html(expr);
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation1" ]);


        k = Math.log(T/50)/t
console.log("k=",k);
        k  = round4DP(k);
   console.log("k=",k);     
        return k ;
    }
</script>

<script type="text/javascript">
    
    function makeQuestion2(t,T)


    {

       let extra = getRandomInt(600,1000);
        let time = t + extra ;
        expr = 'Use the value of k from question 1 to calculate the temperature after ' + time + ' seconds' ;
        $('#equation2').html(expr);
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation2" ]);

        return time; ;

    }
</script>



<script type="text/javascript">
  
    $(document).ready(function(){
   
  
// points = question.substr(-1);
// calculate points on exit
// $('#cancel').text("Exit");


t = getRandomInt(100,300);
T = getRandomInt(60,80);

answer[1] = makeQuestion1(t,T) ;
answer[2] = makeQuestion2(t,T) ;



 // console.log(answer);

checkAnswer(2);

  })


</script>




