<?php 
$question = isset($_POST['question']) ? $_POST['question'] : 'Primes';
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
<script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
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


<title>Modular equation</title>

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
   
   color:blue;
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

p.parameter  {
    display: inline-block;
    color: blue;
    font-size: 1em;
    font-weight: bolder;

}


</style>


</head>
<body>

    <div class  = "container-fluid">

      <div class = "row">
      <div class = "col-12 text-center">

    <h1>Solve the equation</h1>

 
 
  
</div></div>  
  


 <div class = "row">
      <div class = "col-12 text-center">
    <div id = "ex1"> 

    
<label id = "equation1"></label>
<input id = "solution1">
<button id = "check1">Check 1</button>
</div>
</div></div>



 <div class = "row">
      <div class = "col-12 text-center">
    <div id = "ex2">
<label id = "equation2"></label>
<input id = "solution2">
<button id = "check2">Check 2</button>
</div>
</div></div>



 <div class = "row">
      <div class = "col-12 c">
    <div id = "ex3">

<label id = "equation3"></label>
<input id = "solution3">
<button id = "check3">Check 3</button>
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

<script>
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

</script>

<script type="text/javascript">
  function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

</script>

<script type="text/javascript">
  
  function isPrime(num) {
  var sqrtnum=Math.floor(Math.sqrt(num));
    var prime = num != 1;
    for(var i=2; i<sqrtnum+1; i++) { // sqrtnum+1
        if(num % i == 0) {
            prime = false;
            break;
        }
    }
    return prime;
}
</script>


<script type="text/javascript">
  
  function makePrimes(limit) 
  {
 
  var cnt = 1 ;
  n = 2 ;
  let primes = [];
  primes[1] = n ;
  $('#primeNumbers').empty() ;
  $('#primeNumbers').append(n + ", ") ;
    var n = 3  ;
      $('#primeNumbers').append(n + ", ") ;
  while (n <= limit)
  {
   n = n + 2 ;
   if (isPrime(n) == true) 
    {primes[cnt] = n ;
        $('#primeNumbers').append(n + ",") ;
      cnt = cnt + 1 ;
   // if (cnt % 10 == 0) { $('#primeNumbers').append('<br>') ;} 
    }
  

  }
  return primes;
}
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



<script type="text/javascript">
    
    function makeQuestion1(primes)
    {
// need a prime number and the primitive roots for that prime.
// then randomly select a primitve root
// select a random number < n -1
// generate a = g^x mod p


        // get p from primes 
        let l = primes.length -1; 
        let n = getRandomInt(1,l);
        let p = primes[n];
        console.log("primes",l,n,p);
       
        let primitiveRoots = getPrimitiveRoots(p);
        l = primitiveRoots.length -1;
        n = getRandomInt(0,l);
        let g = primitiveRoots[n];
        console.log("primitive roots",primitiveRoots,n,g);
        let x = getRandomInt(1,p-2);
        let a = powerMod(g,x,p);
        // Wrap the whole string in $ tags and use \\bmod for the modulo operator
var expr = '$' + g + '^x \\bmod ' + p + ' = ' + a + ', \\; x = $';

console.log(expr);
$('#equation1').html(expr);
MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation1"]);
        
        
        return a;
       
       
    }
</script>



<script type="text/javascript">
  
    $(document).ready(function(){
   
    question = '<?php echo $question; ?>' ;

primes = makePrimes(17);      
answer[1] = makeQuestion1(primes) ;


checkAnswer(1);
console.log("Answer", answer);



  })


</script>

