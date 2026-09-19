<!DOCTYPE html>
<html lang="en">
  <head>
<title>RSA Game</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../javaScript/bootStrap/bootstrap-3.3.7-dist/css/bootstrap.min.css">
  <script src="../javaScript/jQuery/jquery-3.3.1.min.js"></script>
  <script src="../javaScript/bootStrap/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
  <link rel = "stylesheet" href  = "css/rsaStyles.css">
    
<script type="text/x-mathjax-config">
  MathJax.Hub.Config({
    extensions: ["tex2jax.js"],
    jax: ["input/TeX","output/HTML-CSS"],
    tex2jax: {inlineMath: [["$","$"],["\\(","\\)"]]}
  });
</script>
<script type="text/javascript" src="../MathJax-2.7.5/MathJax.js"></script>

<!-- scripts for functions used in the app -->

<script type="text/javascript">

  function expModulo(a,b,m)

  {
     // calculates a^b mod m
  //  alert('received a^b mod m' + a + ' ' + b + ' ' + m + a*m % m);

    var term = a ;
    var product =1 ;
    var q = b ;
    var r = 0 ;

    while (q > 0)
    {
      r = q % 2 ;
      q = Math.floor(q / 2) ;
      if (r == 1) 
        {
          product = (product*term) % m ;
        }
        term = (term * term) % m ;
      
    }
   return product ;
  }

</script>

<script >

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

function gcd(a, b) {
   
   var a = Math.abs(a) ;
   var b = Math.abs(b) ;

// gcd of a, b

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


<script type="text/javascript">

  function findD(e,phi)

  {
    // calculates a^b mod m
   // console.log(e,phi);
    var step = 1;
    var a1 = 1 ;
    var found = false ;
    var a2 = Math.floor(phi/e) ;
    var d = a1 + a2 ;
    var answer = (e*d) % phi ;
     if (answer == 1){found = true;}
  //  console.log(a1,a2,d,found,step,answer);
  
    while (!found)
    {
      a1 = a2 ;
      a2 = d ;
      var d = a1 + a2 ;
      var answer = (e*d) % phi ;
      if (answer == 1){found = true;}
   //   console.log(a1,a2,t,found,step,answer);
      step++ ;

    }
    if (found) {return d ;} else return 0 ;
  }

</script>



  </head>
  <body>


<div class  = "container-fluid">

<div class = "row">
<div class = "col-sm-12 c">
  <h2>Cryptography using RSA</h2>
</div></div>

<div class = "row">
<div class = "col-sm-12 ">

  <div id = "intro">

  <p id = "words">
    This is a group project in which you have to make and break codes using the RSA algorithm.
    The RSA method is named after the people that invented it - Rivest, Shamir and Adleman. It
    is used whenever information needs to kept secret, especially on the internet.
    </p>


     <p id = "words">
    You will learn how it works, but only using small numbers. When it is used on the internet the numbers are
    at least 128 digits long. Something like this 
    <strong><italic>
      
      <div id = "bigNumber" class = "c">5a326d3b717e6f755dbb39fc3df9ce14bfbd80f46280ab5df64c3494a72a4fbafbb87682f7e20f8
        d51bd42f3b76a195033cd01b446ad92ec7892b203a6be6048
      </div>

    </italic></strong>
  </p>

    <p class = "c">
    Let's get started and make some codes!
</p>

  <p class = "c">
    $ C= P^e  \, mod \, n $ and  $ P = C^d \, mod \, n $  
<a href = "rsaFullExample.html" target = "_blank">
    <button>Help</button></a>
  </p>

  </div> <!--intro -->
</div></div>




<div class = "row">
<div class = "col-sm-12 c">

  <div id = "formLogin">
    <label>Team</label><input type = "text" id = "teamName" >
      <label>Password</label>
      <input type = "password" id = "teamPassword" >
      <button id = "loginCheck">Log in</button>
  </div>

<div id = "loginDetails"></div>


</div></div>



<!-- don't know why part3 cannot be after part 2 -->

<div class = "row">
<div class = "col-sm-12">

  <div id = "gamePart3"> 
      <?php include "includes/rsaPart3.html" ; ?>
  </div>

  <div id = "gamePart1"> 
      <?php include "includes/rsaPart1.html" ; ?>
  </div>

    <div id = "gamePart2"> 
      <?php include "includes/rsaPart2.html" ; ?>
  </div>


<!--
  <div id = "gamePart4"> 
      <?php // include "includes/rsaPart4.html" ; ?>
  </div>

    <div id = "gamePart5">
      <?php // include "includes/rsaPart4.html" ; ?>
  </div>
-->


</div></div>



</div>

</body>
</html>




  <script type="text/javascript">

    $(document).ready(function(){
      
      data = [] ; 
      letterArray = [] ;

// set dom elements for part 1 

      e = 3 ;
      d = 107 ; // with e = 3 p ==11 and q = 17, n = 187, d =160
      p = 11;
      q = 17 ;
      $('#part1P').attr('value', p) ;
      $('#part1Q').attr('value', q) ;
      $('#part1D').attr('value', d) ;
      $('#part1E').attr('value', e) ;

// elements for part 2
     
      $('#questiond2').hide() ;
      $('[id^=lesson]').hide() ;
      $('[id^=info]').hide() ;
      $('[id^=gamePart]').show() ;
      $('[id^=checkPhi]').hide() ;
      $('[id^=my]').empty() ;
      $('[id^=my]').show() ;
      $('#teacherJohnHeading').hide() ;
      $('#sendEncoded').hide() ;
      $('#nextLevel').hide() ;
      $('#checkD2').hide() ;
      $('#level3').hide() ;
      $('#level4').hide() ;
      $('#myD').hide() ;
     

      
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
      $('[id^=info]').hide() ;
      $('#formLogin').hide() ;
      $('#loginCheck').hide() ;
      $('#loginDetails').hide() ;
      $('#intro').hide() ;
      $('#gamePart1').show() ;
      $('#convertMessage').show() ;
      $('#sendEncoded').hide() ;
    });
  });
});
</script>



