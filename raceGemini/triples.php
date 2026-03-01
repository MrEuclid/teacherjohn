<?php 
$question = isset($_POST['question']) ? $_POST['question'] : 'Triples';
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

<title>Triples</title>

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

    <h1>Solve the equations </h1>

    <h3>First you need to to find m and n and then use those numbers to find z.</h3>
  
</div></div>


 <div class = "row">
      <div class = "col- c">

$ m^2 + n^2 = $ <label id = "A"></label>
<br>

$ m^2 - n^2 = $  <label id = "B"></label>
<br>
$ z = m \times n $

</div></div>

 <div class = "row">
      <div class = "col- c">

Find m,n first and then calculate z.

</div></div>

 <div class = "row">
      <div class = "col-  c">

        <label>z =    </label><input id = "solution1"><button id = "check1" >Check</button>

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
    
    function gcd(a, b) {
   
   a = Math.abs(a) ;
   b = Math.abs(b) ;

//alert('Now ' + a + ' ' + b);

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

<script>
function getVariables()

{

  valid = false ; 
  data = [] ;

  while (!valid)
  {
    m =randomInteger(20,50);
    n = randomInteger(5,25);

    gcdmn = gcd(m,n);
    gcdm2 = gcd(2,m);
    gcdn2 = gcd(2,n);

    if (m > n && gcdmn == 1 && gcdm2 == 1 && gcdn2 == 1)

{
    valid = true;

    data[0] = m*m + n*n;
    data[1] = m*m - n*n ;
}



  }

return data;
}


</script>

<script type="text/javascript">
  
    $(document).ready(function(){
   


    A = 0;
    B = 0;
    C = 0

    m = 0;
    n = 0;

    // A = m^2 + n^2

    // B = m^2 - n^2 

    // C = 2mn = sqrt(A^2 - B^2)

// find m and n so they are both odd. 
// 10 < m < 25
// 5 < n < 15

// m > n


  
mn  = [] ; // array to hold values of m,n

mn = getVariables();



a = mn[0];
b = mn[1];



$('#A').text(a);
$('#B').text(b);

C = m*n;
answer[1] = C;

checkAnswer(1);

console.log(answer);



  
  })


</script>

