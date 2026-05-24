<?php 
$question = isset($_POST['question']) ? $_POST['question'] : 'Triangle';
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

<title>CountdownNumber</title>

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
      <div class = "col-sm-12 text-center">

    <h1>Solve the equations </h1>

    <h3>First you need to to find A , B and C and then use those numbes to find D.</h3>
  
</div></div>


 <div class = "row">
      <div class = "col-sm-12 text-center">

$ A + B = $ <label id = "A"></label>
<br>

$ B + C = $  <label id = "B"></label>
<br>

$ A + C = $  <label id = "C"></label>
<br>
$ D = A + B + C $

</div></div>

 <div class = "row">
      <div class = "col-sm-12 text-center">

Find A,B and C first and then calculate D.

</div></div>
<?php include "answerBootstrap1.html" ?>

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
$('#equation1').text('D = ');
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

  var a = 10;
  var b = 99;

    data[0] = randomInteger(a,b);
    data[1] = randomInteger(a,b);
    data[2] = randomInteger(a,b);

return data;
}


</script>

<script type="text/javascript">
  
    $(document).ready(function(){
   
    question = '<?php echo $question; ?>' ;

abc  = [] ; // array to hold values of m,n
abc = getVariables();

a = abc[0];
b = abc[1];
c = abc[2];

sum1 = parseInt(+a+b);
sum2 = parseInt(+b+c);
sum3 = parseInt(+a+c);

$('#A').text(sum1);
$('#B').text(sum2);
$('#C').text(sum3);


d = parseInt(a + b + c) ;
answer[1] = d;
checkAnswer(1);
console.log("answers a b c d ",a,b,c,d);



  
  })


</script>

