<?php 
$question = isset($_POST['question']) ? $_POST['question'] : 'Pendulum';
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
<title>Pendulum</title>

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
                <p id = "stars"></p>
                </div></div>

    <div class = "row">
      <div class = "col-sm-12 c">

    <h1>Pendulum</h1>

<h3>
    $ T = 2\pi \sqrt{\frac{l}{g}} $, $f = \frac{1}{T} $
</h3>
<p> &pi; = 3.14  and g = 9.8 ms<sup>-2</sup>..</p>
 

  
</div></div>


 <div class = "row">
      <div class = "col- c">
    <div id = "ex1">
<label id = "equation1"></label>
<input id = "solution1">
<button id = "check1">Check 1</button>
</div>
</div></div>



 <div class = "row">
      <div class = "col- c">
    <div id = "ex2">
<label id = "equation2"></label>
<input id = "solution2">
<button id = "check2">Check 2</button>
</div>
</div></div>



 <div class = "row">
      <div class = "col- c">
    <div id = "ex3">
<label id = "equation3"></label>
<input id = "solution3">
<button id = "check3">Check 3</button>
</div>
</div></div>


 <div class = "row">
      <div class = "col- c">
    <div id = "ex4">
<label id = "equation4"></label>
<input id = "solution4">
<button id = "check4">Check 4</button>
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
    function round4DP(n)
{
roundedNum = (Math.round( n * 10000 ) / 10000);

return roundedNum;

}
</script>


<script type="text/javascript">
    
    function shuffle(array) {
  let currentIndex = array.length;

  // While there remain elements to shuffle...
  while (currentIndex != 0) {

    // Pick a remaining element...
    let randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex--;

    // And swap it with the current element.
    [array[currentIndex], array[randomIndex]] = [
      array[randomIndex], array[currentIndex]];
  }
}

</script>

<script >
    function period(l)

    {
        const pi = 3.14;
        const g = 9.8;
        let T = 2*pi*Math.sqrt(l/g);
        return T;
    }

</script>

<script type="text/javascript">
    
    function makeQuestion1()


    {
       
        let l = getRandomInt(1, 20)/10;;
        console.log("l = ",l);
        expr = '<b>Question 1</b><br>What is the value of T (2dp) when l = ' + l +'m?';
        let T1 = period(l);
        $('#equation1').html(expr);
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation1" ]);

        let T = round2DP(T1);
      
console.log(l,T,T1);
   
        return T ;
    }
</script>

<script type="text/javascript">
    
    function makeQuestion2()


    {

       
        let l = getRandomInt(1, 20)/10;;
        console.log("l = ",l);
        expr = '<b>Question 2</b><br>What is the value of f (2dp) when l = ' + l +'m?';
        let T = period(l);
        $('#equation2').html(expr);
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation2" ]);

        let f = round2DP(1/T);
      
console.log(l,T,f);
   
        return f ;
    }
</script>


<script type="text/javascript">
    
    function makeQuestion3()

    {
        
        const pi = 3.14;
        const g = 9.8;
        let T = getRandomInt(10, 20)/10;;
        console.log("T = ",T);
        expr = '<b>Question 3</b><br>What is the value of l (2dp) when T = ' + T +'s?';
       
        $('#equation3').html(expr);
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation3" ]);

        let l = g*T*T/(4*pi*pi);
         l = round2DP(l);
      
console.log(T,l);
   
        return l ;
    }
</script>


<script>

    function makeQuestion4()


    {
       const pi = 3.14;
        const g = 9.8;
        let T = getRandomInt(10, 20)/10;;
      
        let f = 1/T ;
        f = round2DP(f);
          console.log("T = ",T,"f = ",f);
        expr = '<b>Question 4</b><br>What is the value of l (2dp) when f = ' + f +'hz?';
       
        $('#equation4').html(expr);
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation4" ]);

        let l = g/(4*pi*pi*f*f);
        l = round2DP(l);
      
console.log(T,f,l);
   
        return l ;

    }
</script>

<script type="text/javascript">
  
    $(document).ready(function(){
   
    question = '<?php echo $question; ?>' ;
// points = question.substr(-1);
// calculate points on exit
// $('#cancel').text("Exit");



 answer[1] = makeQuestion1() ;
 answer[2] = makeQuestion2() ;
 answer[3] = makeQuestion3() ;
 answer[4] = makeQuestion4() ;

 checkAnswer(4);
console.log(answer);



  })


</script>

