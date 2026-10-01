<?php 
// $question = $_POST['question'];

$question = 'q15-7';
?>

<!DOCTYPE html>
<html lang="en">

  <head>
 
 
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../bootstrap-5.0.2-dist/css/bootstrap.min.css">
  <script src="../javaScript/jQuery/jquery-3.3.1.min.js"></script>
  <script src="../bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    
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

<title>Factors</title>

<style>



button.bigWriting {padding: 2px ; width: 160px ; margin-bottom: 5px ;
  margin-top: 2px;vertical-align: top; margin-left: 5px ; margin-right: 5px ;
 // background-color: orange; 
  font-size: 18pt ; font-weight: bolder;color: white ;}

button.small {padding: 2px ; width: 80px ; height: 80px ;margin-bottom: 5px ;margin-top: 2px; 
  font-size: 24pt ; color:black ; background-color: lightblue ;vertical-align: top;}

button.large {padding: 2px ; width: 120px ; height:120px ; margin-bottom: 5px ;margin-top: 2px; 
  font-size: 24pt ; color:green ; background-color: lightyellow ; vertical-align: top;}

button.large1 {padding: 2px ; width: 120px ; height:120px ; 
vertical-align: top;
  margin-bottom: 5px ;margin-top: 2px; 
  font-size: 24pt ; color:blue ; background-color: lightyellow ;}

button.large2 {padding: 2px ; width: 120px ; height:120px ; 
  vertical-align: top;
  margin-bottom: 5px ;margin-top: 2px; 
  font-size: 24pt ; color:black ; background-color: lightgrey ;}

#operation+, #operation*,#operation-, #operation/
 {padding: 2px ; width: 120px ; 
vertical-align: top;
  margin-bottom: 5px ;margin-top: 2px; font-size: 18pt ; font-weight: bolder ;  lightblue ;}

#guess ,#teamName {
    background-color:lightgreen ; 
    color:black ;
    font-size:24pt ;
    width: 120ps ;
    height:60px ;
    text-align:center ;
  }

.round {
    background-color: #1164e0;
    border: none;
    color: white;
    padding: 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 24pt;
    margin: 4px 2px;
    font-weight:bolder ;

border-radius: 20;}

.alphabet {
    background-color: green;
    border: none;
    color: yellow;
    padding: 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 32px;
    margin: 2px 2px;
    font-weight:bolder ;

border-radius: 20;}



.square {
   
    display: inline-block;
    margin: 0;
    padding: 2px 2px;

    
    text-rendering: auto;
    text-align: center;
    text-transform: none;
    text-decoration: none;
    text-indent: 0;
    text-shadow: none;
    letter-spacing: normal;
    word-spacing: normal;
    font-weight: bolder ;
    font-family: sans-serif;
    height: 50px ;
    width: 50px ;
    border: 1px outset buttonface; }


    
.rectangle {
    
    display: inline-block;
    margin: 0;
    padding: 2px 2px;
    font-size: 2em;
    color: black;
    background-color: lightgreen;
    
    text-rendering: auto;
    text-align: center;
    text-transform: none;
    text-decoration: none;
    text-indent: 0;
    text-shadow: none;
    letter-spacing: normal;
    word-spacing: normal;
    font-weight: bolder ;
    font-family: sans-serif;
    height: 50px ;
    width: 100px ;
    border: 1px outset buttonface; }


   .circle { 
            width: 60px; 
            height: 60px; 
            margin:5px ;
            padding: 10px 16px; 
            border-radius: 20px; 
            background-color:green ;
            color:yellow ;
            font-size:24pt ;
            font-weight:bolder ;
            text-align: center; }



.menu {
    font-size: 24pt;
}

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

[id^=level] {
background-color: lavender;
color:black ;
font-weight: bolder;
font-size: 12pt ;
text-align: center;
width : 120px ;
height: 90px ;

}

p {
font-weight: bold;
font-style: italic;
font-size: medium;
}

#clear {background-color: blue; color: yellow; font-size: 1.2em; text-align: center; width: 120px; height: 40px;}

#calculate{

background-color:cornflowerblue; 
}

#answerm,#answern {
                    margin: 2em; 
                    background: lightblue; 
                    text-align: center; 
                    font-weight: bolder;
                    font-size: 1.2em;
                    color:black;
                    width:5em;
                  }



button.bigWriting {padding: 2px ; width: 160px ; margin-bottom: 5px ;
margin-top: 2px;vertical-align: top; margin-left: 5px ; margin-right: 5px ;
// background-color: orange; 
font-size: 18pt ; font-weight: bolder;color: white ;}

button.small {padding: 2px ; width: 80px ; height: 80px ;margin-bottom: 5px ;margin-top: 2px; 
font-size: 24pt ; color:black ; background-color: lightblue ;vertical-align: top;}

button.large {padding: 2px ; width: 120px ; height:120px ; margin-bottom: 5px ;margin-top: 2px; 
font-size: 24pt ; color:green ; background-color: lightyellow ; vertical-align: top;}

button.large1 {padding: 2px ; width: 120px ; height:120px ; 
vertical-align: top;
margin-bottom: 5px ;margin-top: 2px; 
font-size: 24pt ; color:blue ; background-color: lightyellow ;}

button.large2 {padding: 2px ; width: 120px ; height:120px ; 
vertical-align: top;
margin-bottom: 5px ;margin-top: 2px; 
font-size: 24pt ; color:black ; background-color: lightgrey ;}

#operation+, #operation*,#operation-, #operation/
{padding: 2px ; width: 120px ; 
vertical-align: top;
margin-bottom: 5px ;margin-top: 2px; font-size: 18pt ; font-weight: bolder ;  lightblue ;}

#target {background-color: orange; color:lime ;}

#newGame, #quit {font-size: 18pt; font-weight: bolder;}




.medium {
    display: inline-block;
  
    margin: 0;
    padding: 10px 10px;

    
    text-rendering: auto;
    text-align: center;
    text-transform: none;
    text-decoration: none;
    text-indent: 0;
    text-shadow: none;
    letter-spacing: normal;
    word-spacing: normal;
    font-weight: bolder ;
    font-size: 14pt ;
    color:white ;
    font-family: sans-serif;
    height: 60px ;
    width: 100px ;
    border: 1px outset buttonface; }



#message {font-size: 10pt ; font-style: italic;color: black ; text-align: justify;}

#answer {
            text-align: center;
            background-color: lightblue;
            font-size: 1.2em;
            font-weight: bolder;
}

h2 {color: green }
h1 {color: blue;}
h3 {color:orange;}


img {position: relative;}


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

    <h1>Find the numbers m and n </h1>

    <h3>m and n are prime numbers.</h3>
  
</div></div>


 <div class = "row">
      <div class = "col- c">

$ m \times n = $ <label id = "A"></label>
<br>




</div></div>

 <div class = "row">
      <div class = "col- c">


</div></div>

 <div class = "row">
      <div class = "col- ">

        <label>m  = </label><input id = "answerm">
         <label>n  = </label><input id = "answern">
         <button id = "check" >Check</button>

</div></div>

 <div class = "row">
      <div class = "col- ">
<p id = "divisors"></p>
      </div></div>
</div>

</body>
</html>

<script>

  function makePrimes(max)
{

  // a list of primes up to max
  var max_sqrt = Math.sqrt(max) ;
  var  range = [] ;
  var  current = 0;
  
  //generate array of numbers
  for (var i = 2; i <= max; i++)
      range.push(i);
  
  //filter multiples out
  while (range[current] <= max_sqrt)
  {
      range = range.filter(function(n)
      {
          return (n == range[current] || n % range[current] != 0);
      });
      
      current++;
  }
  
  return range;
}

</script>

<script type="text/javascript">

function checkPrime(n)

{

  // tests if a number is prime by dividing by prime factors up to sqrt(n)
  var limit = Math.sqrt(n);
  if (!Number.isInteger(limit))  {limit = limit + 1;}
  var primeNumbers = [] ;
  primeNumbers = makePrimes(limit);
  var l = primeNumbers.length ;
  var prime = true;
  i = 0 ;
  while (i < l & prime)
    {
       if (n % primeNumbers[i] == 0) {prime = false;}
    //  alert('Checking ' + n + ' with ' + primeNumbers[i] + ' i ' + i + ' is prime ' + prime);
     
    i++ ;
  }

  return prime ;

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

console.log(data[0],data[1]);

  }

return data;
}


</script>

<script type="text/javascript">
  
    $(document).ready(function(){
   
question = '<?php echo $question; ?>' ;
points = question.substr(-1);
points = parseInt(points);
// alert(question + ' ' + points);
primes = [] ;
max = 100;

primes = makePrimes(max);
console.log(m,n);
var l = primes.length;
// alert(l + " Primes = " + primes);
for (var i = 0; i < l ; i++)

{
    $('#divisors').append(primes[i] + ' ');
}

var m = randomInteger(5,parseInt(l/2));

var n = randomInteger(parseInt(l/2),l-1);



var n1 = primes[m];
var n2 = primes[n];

sum = parseInt(n1 + n2);
product = n1*n2;
console.log("primes",n1,n2,product,sum);

$('#A').text(product);

 
// get two primes



  
  })


</script>


<script type="text/javascript">
  
    $(document).ready(function(){
    $('#check').on('click', function()
    {

var answer = parseInt($('#answerm').val()  * $('#answern').val()) ;
alert(answer) ;
if (answer == product )
{


      $('#playingArea').hide();
      $('#numPad').hide() ;
      $('#send').hide();
      $('#clear').hide();
/*
     var pts = parseInt($('#total').text());
     
     console.log("points",pts);
     pts = parseInt(pts + points);
     console.log("points now ",pts);
     $('#total').text(pts);

    $('#menu').show();
  */
alert("You found the numbers");
processWin(questionID);
    
     $('#play').empty().show();
     $('#q15').prop('disabled',true).css({"background-color":"blue","color":"yellow"});
     

   console.log("processing ",questionID);


    
  

}

else 
{
    alert('Keep trying!');
}
  


  })
  })


</script>



