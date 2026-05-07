<?php 
$question = isset($_POST['question']) ? $_POST['question'] : 'RSA';
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

<title>RSA</title>

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

#lbl1, #ans {text-align: center; width: 20em;  background-color: lightgreen; color: black;}
#expression {text-align: center; width: 20em;  background-color: lightblue; color: black;}

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

#calcBig {background-color: blue; color: yellow; font-weight: bolder; font-size: 1.2em;}


</style>


</head>
<body>

    <div class  = "container-fluid">

      <div class = "row">
      <div class = "col-sm-12 c">

    <h1>Secret codes</h1>
</div></div>

  <div class = "row">
      <div class = "col-12 text-center">
<h2>
     <p>n = axb where a and b are prime numbers.</p>
     <p>m = (a-1)(b-1) </p>
   <p>C = P<sup>e</sup> mod n </p>
    
</h2>
</div></div>

  <div class = "row">
      <div class = "col-sm-12 c">

    <h3 id = "primeNumbers"></h3>

</div></div>  
  


 <div class = "row">
      <div class = "col-12 c">
    <div id = "ex1"> 

    
<label id = "equation1"></label>
<input id = "solution1">
<button id = "check1">Check 1</button>
</div>
</div></div>



 <div class = "row">
      <div class = "col-12 c">
    <div id = "ex2">
<label id = "equation2"></label>
<input id = "solution2">
<button id = "check2">Check 2</button>
</div>
</div></div>




 <div class = "row">
      <div class = "col-12 c">
    <div id = "ex4">
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

function extended_gcd(a, b) {
    if (b == 0) {
        return [a, 1, 0];
    } else {
        const [g, x, y] = extended_gcd(b, a % b);
        return [g, y, x - Math.floor(a / b) * y];
    }
}

function modInverse(e, n) {
    const [g, x, y] = extended_gcd(e, n);
    if (g != 1) {
        return null; // Inverse doesn't exist
    } else {
        return (x % n + n) % n; // Ensure the result is positive
    }
}

function findSmallestD(e, n) {
  if (e <= 0 || n <= 0) {
    return null; // e and n must be positive integers
  }

  // We are looking for the smallest positive integer d such that (e * d - 1) % n === 0
  // This is equivalent to finding the modular multiplicative inverse of e modulo n.
  // e * d ≡ 1 (mod n)

  const d = modInverse(e, n);
  return d;
}

function powerMod(a, b, n) {
  a = a % n;
  let res = 1;
  while (b > 0) {
    if (b % 2 === 1) {
      res = (res * a) % n;
    }
    a = (a * a) % n;
    b = Math.floor(b / 2);
  }
  return res;
}
  
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

<script>

    function getParameters(primes)

    {
        let a = [];

// get p and q 

        let l = primes.length;
        console.log(primes);
        x = getRandomInt(2, l-1);
        y = getRandomInt(2,l-1);
    while (x == y)
    {
       x = getRandomInt(2, l-1);
       y = getRandomInt(2,l-1);
    }
       let p = primes[x];
       let q = primes[y] ;
       let n = p*q;
       let start = 2 ;
       let e = primes[start];
       let phi = (p -1)*(q-1);
    console.log("pq n  phi",p,q,n,phi);
       // choose e so the gcd(e,phi) = 1
       while (gcd(e,phi) != 1)
       {
         e = primes[start] ;
         start ++;
       }
       
     d = findSmallestD(e,phi);
        console.log("ed",e,d, phi) ;


        a[0] = p;
        a[1] = q;
        a[2] = e;
        a[3] =  d ;
        a[4] = phi;
        a[5] = p*q;

        console.log(a);
        return a ;
    
    }
</script>



<script type="text/javascript">
    
    function makeQuestion1(n,m)


    {
      

    
        
        expr = '<b>Question 1</b>' +
         '<br>' +
         'n = ' + n + '. Find and b to calculate m. m = ' ;
        $('#equation1').html(expr);
     //   MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation1" ]);
// alert(expr);
       
       return m;
       
    }
</script>

<script type="text/javascript">
    
    function makeQuestion2(e,n)


    {
 console.log(words);
       let l = words.length;
       let w = getRandomInt(0,l-1);
       let word = words[w];

        let c1 =  word.charCodeAt(0) - 64;
        let c2 =  word.charCodeAt(1) - 64;
        
        let c =  c2 ; // convert to one number

         console.log(word,c2,c);
            expr = '<b>Question 2</b>' +
         '<br>' + 'Find C where P = ' + c + ', n = ' + n + ', and e = ' + e + '. C = ';
            $('#equation2').html(expr);
        let P = c;  
        let C = powerMod(P,e,n);
        console.log(P,e,n,C)
        return C;

    }
</script>




<script>
</script>

<script type="text/javascript">
  
    $(document).ready(function(){

// points = question.substr(-1);
// calculate points on exit
// $('#cancel').text("Exit");

words = ["AD","AH","AM","AN","AS","AT","BE","BY","DO","GO","HA","HE","HI","MA","ME","MY","NO","OK","PA","PI","SO","TO","WE"];

answer = [];

primes = makePrimes(17);
let params = getParameters(primes);
console.log("params",params);
let n = params[5]; // pq
let m = params[4]; // phi
let e = params[2];
let d = params[3] ;
answer[1] = makeQuestion1(n,m) ;
answer[2] = makeQuestion2(e,n) ;


checkAnswer(2);

console.log(answer);


  })


</script>



