<?php 
$question = isset($_POST['question']) ? $_POST['question'] : 'Primitives';
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

<link rel="stylesheet" href="../css/templeStyles.css">
<link rel="stylesheet" href="../css/newTempleStyles.css">
<link rel="stylesheet" href="race2024.css">

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

<title>Pellian</title>

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
      <div class = "col-12 text-center">

    <h1>Find the numbers z and y</h1>
    <h3>m and n are whole numbers.</h3>
  
</div></div>


 <div class = "row">
      <div class = "col-12 c">

<p id = "pellian"></p>

</div></div>


 <div class = "row">
      <div class = "col- 12 c">

        <label>m  = </label><input id = "solution1"> <button id = "check1" >Check</button>
         <label>n  = </label><input id = "solution2"> <button id = "check2" >Check</button>
       

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
    

      function randomInteger(min, max) { // min and max included 
  return Math.floor(Math.random() * (max - min + 1) + min);
}
</script>


<script type="text/javascript">
	
/**
 * Efficiently computes all primitive roots of a small prime number p.
 */
function getPrimitiveRoots(p) {
    if (!isPrime(p)) return [];

    const phi = p - 1;
    const factors = getPrimeFactors(phi);
    const roots = [];

    // Check each candidate from 2 to p-1
    for (let g = 2; g < p; g++) {
        let isPrimitive = true;
        
        // For a primitive root, g^(phi/f) mod p != 1 for all prime factors f of phi
        for (let f of factors) {
            if (powerMod(g, phi / f, p) === 1) {
                isPrimitive = false;
                break;
            }
        }
        
        if (isPrimitive) roots.push(g);
    }
    return roots;
}

// Modular Exponentiation: (base^exp) % mod
function powerMod(base, exp, mod) {
    let res = 1;
    base = base % mod;
    while (exp > 0) {
        if (exp % 2 === 1) res = (res * base) % mod;
        base = (base * base) % mod;
        exp = Math.floor(exp / 2);
    }
    return res;
}

// Get unique prime factors of n
function getPrimeFactors(n) {
    const factors = new Set();
    while (n % 2 === 0) { factors.add(2); n /= 2; }
    for (let i = 3; i * i <= n; i += 2) {
        while (n % i === 0) { factors.add(i); n /= i; }
    }
    if (n > 2) factors.add(n);
    return Array.from(factors);
}

// Basic primality test
function isPrime(n) {
    if (n < 2) return false;
    for (let i = 2; i * i <= n; i++) {
        if (n % i === 0) return false;
    }
    return true;
}

// Example usage: Find primitive roots for 7
console.log(getPrimitiveRoots(7)); // Output: [3, 5]

    

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
if ( x< y)
{a = [0,x,y];}
else 
{a = [0,y,x]; }


      return a;




    }
</script>

<script type="text/javascript">
  
    $(document).ready(function(){
   

// points = question.substr(-1);
// calculate points on exit
// $('#cancel').text("Exit");

answer = makePellian();
console.log(answer);
checkAnswer(2)

  })


</script>


