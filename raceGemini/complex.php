<?php 
$question = isset($_POST['question']) ? $_POST['question'] : 'Complex Challenge';
?>

<!DOCTYPE html>
<html lang="en">

  <head>
 
 
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"></script>
    <script src = "https://cdnjs.com/libraries/mathjs"></script><script src="https://cdnjs.com/libraries/mathjs"></script>
<script src="https://cdnjs.com/libraries/mathjs"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/7.5.1/math.min.js"></script>
    
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
  
  <script type="text/javascript" src="../MathJax-2.7.5/MathJax.js"></script>

<title>complex numbers</title>

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
   
   color:green;
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
    width: 12em;
    height: 4em;


}

[id^=equation] {
    font-weight: bolder;
    color: blue;
    font-size: 1.5em;
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

    <h1>Complex numbers</h1>
    <h2 id = "complexNumbers"></h2>
 
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
    
    function makeQuestion1(z1,z2)
// z1/z3  + z2/z4

    {
      
        a = math.add(z1,z2);
       

       expr =  '$ z_1 + z_2 = $ ' ;
         $('#equation1').html(expr);
         MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation1" ]);
      let z = formatComplex(a);
        return z;
    }
</script>

<script type="text/javascript">
    
    function makeQuestion2(z1,z2)
// z1 - z2

    {
         a = math.subtract(z1,z2);

       expr =  '$ z_1 - z_2 = $ ' ;
         $('#equation2').html(expr);
         MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation2" ]);
        let z = formatComplex(a);
        return z;


    }
</script>


<script type="text/javascript">
    
      function makeQuestion3(z1,z2)
// z1 x z2

    {
         a = math.multiply(z1,z2);

       expr =  '$ z_1 \\times  z_2 = $ ' ;
         $('#equation3').html(expr);
         MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation3" ]);
      
  let z = formatComplex(a);
        return z;

    }
    
</script>


<script>

      function makeQuestion4(z1,z2)
// z1^2 +  z2^2

    {
         a = math.add(math.multiply(z1,z1),math.multiply(z2,z2));

       expr =  '$ z_1^2 + z_2^2 = $ ' ;
         $('#equation4').html(expr);
         MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation4" ]);
      
         let z = formatComplex(a);
        return z;



    }
</script>



<script type="text/javascript">
  
    $(document).ready(function(){
    question = '<?php echo $question; ?>' ;
      let a = 2; 
    let b = 4;
  while (gcd(a,b) != 1)
    { 
        a = randomInteger(2,10);
        b = randomInteger(2,10);
    }
  let c = 2; 
  let d = 4;
  while (gcd(c,d) != 1)
    { 
        c = randomInteger(2,10);
        d = randomInteger(2,10);
    }
    z1 = math.complex(a,b);
    z2 = math.complex(c,d);
    a1 = math.add(z1,z2);

   var expr = '$ z_1 = ' + a + '+' + b + 'i $' ;
        expr +=  " and " ;
        expr += '$ z_2 = ' + c + '+' + d + 'i $' ;

        $('#complexNumbers').html(expr);
    question = '<?php echo $question; ?>' ;
// points = question.substr(-1);
// calculate points on exit
// $('#cancel').text("Exit");

answer = [];

ans = makeQuestion1(z1,z2) ;
answer[1] = ans;

ans = makeQuestion2(z1,z2) ;
answer[2] = ans;

ans = makeQuestion3(z1,z2) ;
answer[3] = ans;

ans = makeQuestion4(z1,z2) ;
answer[4] = ans;


console.log(answer);
checkAnswer(4);


  })


</script>


