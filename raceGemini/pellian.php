<?php 
$question = isset($_POST['question']) ? $_POST['question'] : 'Pellian';
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
  
<title>Pellian</title>

<style>


</style>


</head>
<body>

    <div class  = "container-fluid">


    <div class = "row">
      <div class = "col-12 text-center">

    <h1>Find the numbers m and n</h1>
    <h3>m and n are whole numbers.</h3>
  
</div></div>


 <div class = "row">
      <div class = "col-12 text-center">

<p id = "pellian"></p>

</div></div>

<?php include "answerBootstrap2.html" ?>


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


<script type="text/javascript">
    

    function makePellian()

   {

n = [5,6,7,11,14,18,20,24,30,32];
l = n.length -1 ;
index  =  randomInteger(0,l);
var k = n[index];


var expr = '$ m^2' + ' - ' + k + 'n^2 = 1  $';
  $('#pellian').html(expr);
       MathJax.Hub.Queue(["Typeset", MathJax.Hub, "pellian" ]);
console.log(expr,n);

var expr = '$ m =   $';
  $('#equation1').html(expr);
       MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation1" ]);

var expr = '$ n =   $';
  $('#equation2').html(expr);
       MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation2" ]);

var y = 1;;
found = false;
let a =  [];
while (!found)
    {
       var  t = Math.sqrt(k*y*y + 1) ;
        if (Number.isInteger(t)) 
            {found = true;}
        else
            { y++; }
    }

x = Math.sqrt(t);
x = t;
console.log(t,x,y,expr);

// use a[1] and a[2] not a[0]
a = [0,x,y]


      return a;




    }
</script>

<script type="text/javascript">
  
    $(document).ready(function(){
   

// points = question.substr(-1);
// calculate points on exit
// $('#cancel').text("Exit");

answer = makePellian();
// console.log(answer);
checkAnswer(2)

  })


</script>


