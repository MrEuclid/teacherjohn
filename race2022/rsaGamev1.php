<!DOCTYPE html>
<html lang="en">
  <head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../javaScript/bootStrap/bootstrap-3.3.7-dist/css/bootstrap.min.css">
  <script src="../javaScript/jQuery/jquery-3.3.1.min.js"></script>
  <script src="../javaScript/bootStrap/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>



    
<script type="text/x-mathjax-config">
  MathJax.Hub.Config({
    extensions: ["tex2jax.js"],
    jax: ["input/TeX","output/HTML-CSS"],
    tex2jax: {inlineMath: [["$","$"],["\\(","\\)"]]}
  });
</script>
<script type="text/javascript" src="../MathJax-2.7.5/MathJax.js"></script>



<script >
  function makeprimes(max)
{
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

function checkPrime(n)

{
  var limit = Math.sqrt(n);
  if (!Number.isInteger(limit))  {limit = limit + 1;}
  var primeNumbers = [] ;
  primeNumbers = makeprimes(limit);
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

function gcd(a, b) {
   
   var a = Math.abs(a) ;
   var b = Math.abs(b) ;

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


// returns a random integer between min and max
  function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

  // gcd of a,b - recursive method
   var gcd = function(a, b) {
  if (!b) {
    return a;
  }

  return gcd(b, a % b);
}

</script>


  <link rel = "stylesheet" href  = "../css/pioStudentsStyles.css">

<meta charset="utf-8">
<meta name="description" content="">
<meta name="keywords" content="">
<title>RSA game</title>

<style type="text/css">

    #exit {margin: 10px ;}


html { font-size: calc(1em + 1vw) }

    .c {
            text-align: center;
            margin-right: auto;
            margin-left: auto;
            margin: 0 ;
          }

h1 {color: blue; font-size: 2em}
h2 {color: green ; font-size: 1.5em}

h3 {color: red; font-size: 1em}
h4 {color: lightblue ; font-size: 0.8em}

#words 
  {
    font-size: 1 em; 
    text-align: left; 
    font-family: sans-serif;}

.btn-med 
  {
    width:160px; 
    height:80px; 
    text-align: center ; 
    font-size: 1.2em ; 
    font-weight: bold; 
    color: white
  }

  .data 
      {
       margin-top:10px;
       margin-bottom: 10px ;
       margin-left: 20px ;
       margin-right: 20px ;
       background-color: lightblue ;
       color:black; 
       font-size: 1.2em; 
       text-align: center;
       width: 120px ; 
       height: 40px ;
      }

    label {text-align: center ; font-size: 1.2em ;}

  </style>

  </head>
  <body>


<div class  = "container-fluid">

<div class = "row">
<div class = "col-sm-12 c">
  <h2>Cryptography using RSA</h2>
</div></div>

<div id = "intro">

<div class = "row">
<div class = "col-sm-12 ">

  <p id = "words">
    This is a group project in which you have to moake and break codes using the RSA algorithm.
    The RSA method isnamed after the people that invented it - Rivest, Shamir, Adldeman. It
    is used whenever information needs to kept secret, especially on the internet.
    <br>
    You will learn how it works, but only using small numbers. When it is used on the internet the numbers are
    at least 128 digits long. Something like this 
    <strong><italic>
      <div class = "c">5a326d3b717e6f755dbb39fc3df9ce14bfbd80f46280ab5df64c3494a72a4fbafbb87682f7e20f8
        d51bd42f3b76a195033cd01b446ad92ec7892b203a6be6048</div>
    </italic></strong>
    <br>
    Let's get started and make some codes!

    $ C= P^e  \, mod \, n $ and  $ P = C^d \, mod \, n $
  
  </p>
</div></div>
</div> <!--intro -->


<div class = "row">
<div class = "col-sm-12 c">
     <button  id =  "infoSend" type="button" class="btn btn-success btn-med">Make messages</button>

     <!--
  <button  id = "infoPrimes" type="button" class="btn btn-warning  btn-med">
    Primes
    <br> 2,3,5,...
  </button>
-->
   <button  id = "infoRead" type="button" class="btn btn-info btn-med">Read messages</button>

   <!--

   <button  id = "infoCalculator" type="button" class="btn btn-primary btn-med">Calculator</button>

  -->

   <button  id = "infoModulo" type="button" class="btn btn-primary btn-med">Modulo<br></button>
</div></div>



<div class = "row">
<div class = "col-sm-12 c">
  <div id = "formLogin">
    <label>Team</label><input type = "text" id = "teamName" >
      <label>Password</label>
      <input type = "password" id = "teamPassword" >
      <button id = "loginCheck">Log in</button>
  </div>

<div id = "loginDetails">Check here</div>
</div></div>


  <div id = "lessonPrimes">
    <?php include "includes/primeLesson.php" ; ?>
  </div>
   <div id = "lessonCalculator">
     <?php // include "includes/lessonCalculator" ; ?>
   </div>
    <div id = "lessonPlay"></div>
     <div id = "lessonSend"></div>
      <div id = "lessonRead"></div>
       <div id = "lessonCrack"></div>
       <div id = "lessonSign"></div>



<!-- game parts -->




  <div id = "gamePart1">
    <?php include "includes/rsaPart1.html" ; ?>
  </div>
  <div id = "gamePart2">
      <?php //include "includes/rsaPart2.html" ; ?>
  </div>
  <div id = "gamePart3"></div>
  <div id = "gamePart4"></div>
  <div id = "gamePart5"></div>
  <div id = "gamePart6"></div>


</div>

</body>
</html>




  <script type="text/javascript">

    $(document).ready(function(){
      
      data = [] ; 
      e = 3 ;
      d = 107 ; // with e = 3 p ==11 and q = 17, n = 187, d =160
      $('[id^=lesson]').hide() ;
      $('[id^=info]').hide() ;
      $('[id^=gamePart]').show() ;
      $('[id^=checkPhi]').show() ;
      $('[id^=my]').empty() ;
      $('[id^=my]').show() ;
      
    })

</script>


<script>
$(document).ready(function(){
  $("#loginCheck").click(function(){

 //   alert('Logging in ');
    var team = $('#teamName').val() ;
    var password = $('#teamPassword').val()
    $.post("includes/rsaLogin.php",
    {
      team: team,
      password: password
    },
    function(data,status){
 //     alert("Data: " + data + "\nStatus: " + status);
      $('#loginDetails').text(data) ;
      $('[id^=info]').show() ;
      $('#formLogin').hide() ;
      $('#loginCheck').hide() ;
      $('#loginDetails').hide() ;
      $('#intro').hide() ;
      $('#gamePart1').show() ;
      $('#convertMessage').show() ;
      $('#sendEncoded').show() ;
    });
  });
});
</script>





<script type="text/javascript">
  
  $(document).ready(function(){
    $('[id^=info]').on('click', function()
  {
    $('[id^=lesson]').hide() ;
    buttonID = this.id ;
    var lesson = buttonID.substr(4);
    // alert('button ' + buttonID) ;
    $('#lesson'+lesson).show();
       

  })
})

    </script>
