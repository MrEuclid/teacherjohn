<?php 
 
$question = isset($_POST['question']) ? $_POST['question'] : 'Delta Challenge';

?>

<!DOCTYPE html>
<html lang="en">

  <head>
 
 
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"></script>
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
 
<script src="javascript/utilities.js"></script>
 
  <script type="text/javascript" src="../MathJax-2.7.5/MathJax.js"></script>

<title>4 Questions Calculus</title>

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
    width: 4em;
    height: 3em;


}

[id^=equation] {
    font-weight: bolder;
    color: black;
    font-size: 1.2em;
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

    <h1>Solve these Calculus Equations</h1>

    <h4>There are 3 marks for each question.</h4>
    
  
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

function generateCalculusClue(target) {
   const type = Math.floor(Math.random() * 7); 
    let questionStr = "";

    if (type === 0) {
        let k = Math.floor(Math.random() * 4) + 1; 
        let a = Math.floor(Math.random() * 5) + 1; 
        let b = target - (2 * a * k);
        let poly = `${a > 1 ? a : ''}x^2`;
        if (b > 0) poly += ` + ${b}x`; else if (b < 0) poly += ` - ${Math.abs(b)}x`;
        questionStr = `If $f(x) = ${poly}$, find $f'(${k})$`;
    }
    else if (type === 1) {
        let k = Math.floor(Math.random() * 3) + 2; 
        let A = target - (3 * k * k);
        let poly = `x^3`;
        if (A > 0) poly += ` + ${A}x`; else if (A < 0) poly += ` - ${Math.abs(A)}x`;
        questionStr = `If $f(x) = ${poly}$, find $f'(${k})$`;
    }
    else if (type === 2) {
        let k = 2; 
        if (target % 5 === 0) k = 5;
        else if (target % 2 !== 0) k = 1; 
        let C = (target - (k * k)) / k;
        let integrand = `2x`;
        if (C > 0) integrand += ` + ${C}`; else if (C < 0) integrand += ` - ${Math.abs(C)}`;
        questionStr = `Evaluate $\\int_{0}^{${k}} (${integrand}) \\, dx$`;
    }
    else if (type === 3) {
        let width = 1;
        if (target % 2 === 0) width = 2;
        if (target % 3 === 0) width = 3;
        let C = target / width;
        let start = Math.floor(Math.random() * 3);
        let end = start + width;
        questionStr = `Evaluate $\\int_{${start}}^{${end}} ${C} \\, dx$`;
    }
    else if (type === 4) {
        let C = target - 2;
        let D = -1 - C;
        let poly = `x^2`;
        if (C > 0) poly += ` + ${C}x`; else if (C < 0) poly += ` - ${Math.abs(C)}x`;
        if (D > 0) poly += ` + ${D}`; else if (D < 0) poly += ` - ${Math.abs(D)}`;
        questionStr = `If $f(x) = e^{${poly}}$, find $f'(1)$`;
    }
    else if (type === 5) {
        let A = Math.floor(Math.random() * 4) + 2; 
        let B = (2 * target) - (2 * A);
        let C = 1 - A - B;
        let poly = `${A}x^2`;
        if (B > 0) poly += ` + ${B}x`; else if (B < 0) poly += ` - ${Math.abs(B)}x`;
        if (C > 0) poly += ` + ${C}`; else if (C < 0) poly += ` - ${Math.abs(C)}`;
        questionStr = `If $f(x) = \\sqrt{${poly}}$, find $f'(1)$`;
    }
    else {
        let A = Math.floor(Math.random() * 4) + 2; 
        let B = target - (2 * A);
        let C = 1 - A - B;
        let poly = `${A}x^2`;
        if (B > 0) poly += ` + ${B}x`; else if (B < 0) poly += ` - ${Math.abs(B)}x`;
        if (C > 0) poly += ` + ${C}`; else if (C < 0) poly += ` - ${Math.abs(C)}`;
        questionStr = `If $f(x) = \\ln(${poly})$, find $f'(1)$`;
    }

    return questionStr ;
}

    
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
  
function gcd(a, b) {
    if (b) {
        return gcd(b, a % b);
    } else {
        return Math.abs(a);
    }
}

</script>

<script type="text/javascript">
    
    function makeQuestion1()

    {
       
        let target = Math.floor(Math.random() * 25) + 1; 
 
       let clue = generateCalculusClue(target); // 1 = evaluated f'(x) given f(x)
    console.log("clue",clue);

        $('#equation1').html(clue);
         MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation1"]);

   a = target ; // the experession is generated so that target is a solution
    
        return a;
    }
</script>

<script type="text/javascript">
    
    function makeQuestion2()


    {

    let target = Math.floor(Math.random() * 25) + 1; 

       let clue = generateCalculusClue(target); // 1 = evaluated f'(x) given f(x)
    console.log("clue",clue);

        $('#equation2').html(clue);
         MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation2"]);

   a = target ; // the experession is generated so that target is a solution

      return a;



    }
</script>


<script type="text/javascript">
    
    function makeQuestion3()


    {

   

    let target = Math.floor(Math.random() * 25) + 1; 

 
       let clue = generateCalculusClue(target); // 1 = evaluated f'(x) given f(x)
    console.log("clue",clue);

        $('#equation3').html(clue);
         MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation3"]);

   a = target ; // the experession is generated so that target is a solution

      return a;

 



    }
</script>


<script>

    function makeQuestion4()


    {

  
    let target = Math.floor(Math.random() * 25) + 1; 

 
       let clue = generateCalculusClue(target); // 1 = evaluated f'(x) given f(x)
    console.log("clue",clue);

        $('#equation4').html(clue);
         MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation4"]);

   a = target ; // the experession is generated so that target is a solution

      return a;

     
    


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


