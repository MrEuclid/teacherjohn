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

  input {text-align: center;font-size: 1.2em;}

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

<button id = "gp1">Part 1</button>
<button id = "gp2">Part 2</button>
<button id = "gp3">Part 3</button>

<!-- game parts -->
<script type="text/javascript">
  $(document).ready(function(){
  $("[id^=gp]").click(function(){

{
    clicked = this.id;
  //  alert('Clicked' + clicked);

  $('[id^=gamePart]').hide() ;

    if (clicked == 'gp1') {$('#gamePart1').show();}
    if (clicked == 'gp2') { $('#gamePart2').show();}
    if (clicked == 'gp3') {$('#gamePart3').show();}}

  })
})

</script>


<!-- don't know why part3 cannot be after part 2 -->

<div class = "row">
<div class = "col-sm-12">

  <div id = "gamePart3"> 
    Part3 start
      <?php include "includes/rsaPart3.html" ; ?>
      Part 3 end
  </div>

  <div id = "gamePart1"> 
      <?php include "includes/rsaPart1.html" ; ?>
  </div>

    <div id = "gamePart2"> 
      <?php include "includes/rsaPart2.html" ; ?>
  </div>



end of parts
</div></div>

<!--
  <div id = "gamePart4"> 
      <?php // include "includes/rsaPart4.html" ; ?>
  </div>

    <div id = "gamePart5">
      <?php // include "includes/rsaPart4.html" ; ?>
  </div>
-->


</div>

</body>
</html>




  <script type="text/javascript">

    $(document).ready(function(){
      
      data = [] ; 
      e = 3 ;
      //d = 107 ; // with e = 3 p ==11 and q = 17, n = 187, d =160


      letterArray = [] ;
      e = 3 ;
      d = 107 ; // with e = 3 p ==11 and q = 17, n = 187, d =160
      p = 11;
      $('#part1P').attr('value', p) ;
      q = 17 ;
      $('#part1Q').attr('value', q) ;
      $('#part1D').attr('value', d) ;
      $('#part1E').attr('value', e) ;
     
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

      $('#checkD').hide() ;
      $('#level3').hide() ;
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



