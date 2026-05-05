<?php 
$question = isset($_POST['question']) ? $_POST['question'] : 'Fibonacci';
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


<title>Fibonacci sequence</title>

<style>







h1 {
font-weight: bolder; 
   font-size: 24pt; 
   
   color:green;
}

h2 {
font-weight: bolder; 
   font-size: 20pt; 
   
   color:blue;

}

h3 {
font-weight: bolder; 
   font-size: 16pt; 
   
   color:green;
}

h4 {
font-weight: bold; 
   font-size: 14pt; 
   
   color:orange;
}



p {
font-weight: bold;
font-style: italic;
font-size: medium;
}


#message {font-size: 10pt ; font-style: italic;color: black ; text-align: justify;}

#answer {
            text-align: center;
            background-color: lightblue;
            font-size: 1.2em;
            font-weight: bolder;
}


h4 {
            text-align: center;
            
            font-size: 1.2em;
            font-weight: bold;
            color: black;
}

input {
    display: inline-block; 
    background-color: lightyellow; 
    text-align: center; 
    font-size: 1.2em; 
    font-weight: bolder;
    margin: 10px;
    width: 4em;
    height: 3em;


}

[id^=equation] {
    font-weight: bolder;
    color: black;
    font-size: 1.2em;
}


</style>


</head>
<body>

    <div class  = "container-fluid">


    <div class = "row">
      <div class = "col-12 text-center">

    <h1>Fibonacci Numbers</h1>

    <h2 id = "data">1,1,2,3,5,8,13,21,...</h2>
    <h3>T(n) = T(n-1) + T(n-2) and S(n)  =  T(n+2) - 1 </h3>
<!--
    <h4>There are 3 marks for each question.</h4>
    <h4>You must answer all the questions!</h4>

  -->  
  
</div></div>
<div class="row mb-4">
    
    <!-- Question 1 -->
    <div class="col-12 col-md-6 text-center mb-4">
        <div id="ex1">
            <label id="equation1"></label>
            <input id="solution1">
            <button id="check1">Check 1</button>
        </div>
    </div>

    <!-- Question 2 -->
    <div class="col-12 col-md-6 text-center mb-4">
        <div id="ex2">
            <label id="equation2"></label>
            <input id="solution2">
            <button id="check2">Check 2</button>
        </div>
    </div>

    <!-- Question 3 -->
    <div class="col-12 col-md-6 text-center mb-4">
        <div id="ex3">
            <label id="equation3"></label>
            <input id="solution3">
            <button id="check3">Check 3</button>
        </div>
    </div>

    <!-- Question 4 -->
    <div class="col-12 col-md-6 text-center mb-4">
        <div id="ex4">
            <label id="equation4"></label>
            <input id="solution4">
            <button id="check4">Check 4</button>
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
  
function gcd(a, b) {
    if (b) {
        return gcd(b, a % b);
    } else {
        return Math.abs(a);
    }
}

</script>

<script type="text/javascript">
  
function fibonacci(n) {
    
    console.log("n =",n);
    fib = [];
    fib[1] = 1;
    fib[2] = 1;
console.log(fib);
    for (let i = 3 ; i <= n ; i++)
    {
        fib[i] = fib[i-1] + fib[i-2];
        console.log(n,i,fib[i],fib);
    }
    return fib[n]
}

</script>



<script type="text/javascript">
    
    function makeQuestion1()


    {

    
    // find T(n)


    let n = randomInteger(8,16);

    //  var expr = '$ \\sum_{i=1}^' + n + ' (' + a + '\\times' + r + '^i)$' + ' = ';
     // var expr = '$ \\sum_{i=1}^n a_i$';

    var expr = "T(" + n +") = ";


      $('#equation1').html(expr);
       MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation1" ]);

       ans = fibonacci(n);
     console.log("Make question1 " +  ans);

      return ans;

    }
</script>

<script type="text/javascript">
    
    function makeQuestion2()


    {
     
// find S(n)


    let n = randomInteger(8,16);

    //  var expr = '$ \\sum_{i=1}^' + n + ' (' + a + '\\times' + r + '^i)$' + ' = ';
     // var expr = '$ \\sum_{i=1}^n a_i$';

    var expr = "T(n) = " + fibonacci(n) + ", n= ";


      $('#equation2').html(expr);
       MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation2" ]);

       ans = n;
     console.log("Make question2 " +  ans);

      return ans;


    }
</script>


<script type="text/javascript">
    
    function makeQuestion3()


    {

  let n = randomInteger(8,16);

  let sn = fibonacci(n+2) -1 ;

    //  var expr = '$ \\sum_{i=1}^' + n + ' (' + a + '\\times' + r + '^i)$' + ' = ';
     // var expr = '$ \\sum_{i=1}^n a_i$';

    var expr = "S(" + n +") = " ;


      $('#equation3').html(expr);
       MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation3" ]);

       ans = sn;
     console.log("Make question3 " +  ans);

      return ans;


    }
</script>


<script>

    function makeQuestion4(a,d)


    {
        let n = randomInteger(8,16);

        let sn = fibonacci(n+2) -1 ;

    //  var expr = '$ \\sum_{i=1}^' + n + ' (' + a + '\\times' + r + '^i)$' + ' = ';
     // var expr = '$ \\sum_{i=1}^n a_i$';

        var expr = "S(n) = " + sn + ", n = ";


      $('#equation4').html(expr);
       MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation4" ]);

       ans = n;
     console.log("Make question4 " +  ans);

      return ans;


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

// get parameters and print out the series

   
answer = [];

answer[1] = makeQuestion1() ;
answer[2] = makeQuestion2() ;
answer[3] = makeQuestion3() ;
answer[4] = makeQuestion4() ;

correct = 0 ; // number correct;
points = 0 ;
checkAnswer(4);
console.log(answer);
  })


</script>




</script>



