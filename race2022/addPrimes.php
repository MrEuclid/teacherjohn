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

<!--
<link rel="stylesheet" href="../css/templeStyles.css">
<link rel="stylesheet" href="../css/newTempleStyles.css">
 -->  

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

<title>Add two primes</title>

<style>
#prmes {background-color: white; color:black; text-align: center; }

input {
    text-align: center; 
    background-color: 
    yellow; color:green ; 
    font-weight: bolder; 
    font-size: 1.1em ;
    width: 5em;
    margin-left: 10px;

    }

    #puzzle    
    { 
        display: inline;
        text-align: center; 
        background-color: lightblue; 
        color:green ; 
        font-weight: bolder; 
        font-size: 1.4em ;
}

.c {text-align: center; width: auto;}

</style>


</head>
<body>

    <div class  = "container-fluid">


    <div class = "row">
      <div class = "col-sm-12 c">

    <h1 class = "c">Find the numbers m and n </h1>

    <h3 class = "c">m and n are prime numbers.</h3>
  
</div></div>


 <div class = "row">
      <div class = "col-12 c">
<h3 clas s= "c" id = "puzzle">
m + n =  <label id = "A"></label>
</h3>



</div></div>



 <div class = "row">
      <div class = "col- ">

        <label>m  = </label><input id = "answerm">
         <label>n  = </label><input id = "answern">
         <button id = "check" >Check</button>

</div></div>

 <div class = "row">
      <div class = "col- ">
<p id = "prmes"></p>
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

<script type="text/javascript">
  
    $(document).ready(function(){
   
question = '<?php echo $question; ?>' ;
points = question.substr(-1);
points = parseInt(points);
alert(question + ' ' + points);
minIndex = 5;
maxIndex = 20;

for (var i = minIndex ; i <= maxIndex; i++)
{
    $('#prmes').append(primes[i] + " ");
}


  $('#primes').show() ;
// 168 primes less than 100

  var n1 = getRandomInt(5,10);
  prime1 = primes[n1] ;

  var n2 = getRandomInt(11,20);
  prime2 = primes[n2] ;

  n = parseInt(prime1 + prime2) ;
  sum = parseInt(n);

  $('#hiddenX').val(n1) ;
  $('#hiddenY').val(n2) ;
  console.log(prime1,prime2,sum) ;

 // alert(n + ' ' + n1 + ' + ' + n2) ;
  $('#label-1a').show() ;
  $('#label-1a').text(n + ' = ') ;
  $('#label-1b').show() ;
  $('#A').text(sum);
  $('#answer-1').show() ;
  $('#comment-1').show() ;
  
  var solved = false ;
  var question = 'Find two prime numbers that add together to equal ' + n ;

  var photo = "images/temple.png" ;
  $("#picture").attr("src",photo);  
  var location = "PIO - Temple of Learning" ;
  var description = "A place where students, study, learn and achieve!" ;  
  var title = "Question 0" ;
 
  $('#location-1').text(location) ;
  $('#description-1').text(description) ;
  $('#title-1').text(title) ;
  $('#question-1').text(question) ;

console.log("q0",n,n1,n2);



  
  })


</script>


<script type="text/javascript">
  
    $(document).ready(function(){
    $('#check').on('click', function()
    {

var a1 = parseInt($('#answerm').val()) ;
var a2 = parseInt($('#answern').val()) ;
answer = parseInt(a1 + a2);
alert(answer + " S " + sum) ;
if (answer == sum )
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



