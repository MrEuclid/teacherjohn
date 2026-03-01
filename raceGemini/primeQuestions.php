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

<title>Prime questions</title>

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
      <div class = "col-sm-12 c">

    <h1>Find p and q</h1>
<h2>p < q, p and q are prime numbers.</h2>
    <h3 id = "primeNumbers">2,3,5,7,11,13,17,19,23,29,31,37,41,43,47</h3>
 
 
  
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
    <div id = "ex3">

<label id = "equation3"></label>
<input id = "solution3">
<button id = "check3">Check 3</button>
</div>
</div></div>

<!--
 <div class = "row">
      <div class = "col-12 c">
    <div id = "ex4">
<label id = "equation4"></label>
<input id = "solution4">
<button id = "check4">Check 4</button>
</div>
</div></div>

-->



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
        // get p,q from primes where p <  q
        let l = primes.length -1; 
        let n = getRandomInt(Math.trunc(l/2),l);
        let p = primes[n];
        console.log(l,n,p);
        //m = getRandomInt(parseInt(n+1),l);
        //let q = primes[m];
        //console.log(l,m,q);
        let sum = p*p - 1;
        expr = '$' +  'p^2 - 1'  + ' = ' +  sum  + '$' + ' ,p = ' ;
        $('#equation1').html(expr);
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation1" ]);
        
        console.log("q1",p,sum);
        return p;
       
       
    }
</script>

<script type="text/javascript">
    
    function makeQuestion2(primes)


    {

      
        // get p,q from primes where p <  q
        let l = primes.length -1; 
        let n = getRandomInt(1,Math.trunc(l/2));
        let p = primes[n];
        console.log(l,n,p);
        m = getRandomInt(parseInt(n+1),l);
        let q = primes[m];
        console.log(l,m,q);
        let product = p*q;
        expr = '$' +  'p' + ' \\times ' +  'q'  + ' = ' +  product  + '$' + ' ,p + q = ' ;
        $('#equation2').html(expr);
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation2" ]);
        
        console.log("q2",p,q,product);
        return +p+q;

    }
</script>

<!--
<script type="text/javascript">
    
    function makeQuestion3(primes)

    {
            // get p,q from primes where p <  q
        let l = primes.length -1 ; 
        let n = getRandomInt(1,Math.trunc(l/4));
        let p = primes[n];
        console.log(l,n,p);
        m = getRandomInt(parseInt(n+1),Math.trunc(l/2));
        let q = primes[m];
        console.log(l,m,q);
        let sumSquares   = +p*p+q*q;
        expr = '$' +  'p^2' + ' + ' +  'q^2'  + ' = ' +  sumSquares  + '$' + ' ,p + q = ' ;
        $('#equation3').html(expr);
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation3" ]);
        
        console.log("q3",p,q,sumSquares);
        return parseInt(p+q);
    }
</script>

-->
<script>

    function makeQuestion3(primes)


    {
           // get p,q from primes where p <  q
        let l = primes.length -1 ; 
        let m = getRandomInt(1,Math.trunc(l/3));
        let p = primes[m];
       
        n = getRandomInt(parseInt(m+1),Math.trunc(2*l/3));
        let q = primes[n];
        
        let o = getRandomInt(parseInt(n+1),l);
        let r = primes[o];
        let numerator  = +q*r + p*r + p*q;
        let denominator = p*q*r;

        
        expr = '$ \\frac{1}{p} + \\frac{1}{q} + \\frac{1}{r} =  \\frac{' + numerator +' }{' + denominator + '}  ,p + q + r = $'  ;
        $('#equation3').html(expr);
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation3" ]);
        
        console.log("q4",p,q,r,numerator,denominator);
        return parseInt(+p+q+r);
    }
</script>

<script type="text/javascript">
  
    $(document).ready(function(){
   
    question = '<?php echo $question; ?>' ;
// points = question.substr(-1);
// calculate points on exit
// $('#cancel').text("Exit");



primes = makePrimes(37);

console.log(primes);
answer[1] = makeQuestion1(primes) ;
answer[2] = makeQuestion2(primes) ;
answer[3] = makeQuestion3(primes) ;
// answer[4] = makeQuestion4(primes) ;

checkAnswer(3);
console.log(answer);



  })


</script>

