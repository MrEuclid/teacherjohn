<?php 
$question = isset($_POST['question']) ? $_POST['question'] : 'Knapsack easy';
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
 
<title>Knapsack easy</title>

<style>

input {
    text-align: center; 
    background-color: lightyellow; 
    color: black; 
    font-size: 1.2em;
    font-weight: bold;
    height:2em;
    margin:1em;
    width:4em; }
label {font-weight: bolder; font-size: 2em; margin: 1em;}

#equations {
            text-align: center;
            font-size: 1.6em;
            font-weight: bold;
}

h2 : {text-align: center; color:blue;}
h4 : {text-align: green;}
</style>


</head>
<body>

    <div class  = "container-fluid">


   <div class = "row">
      <div class = "col-12 text-center">
 <h2>Use these numbers to answer the question.</h2>
 <h4 id = "possibles"></h4>
 <p id = "equations"></p>
</div></div>

    <div class = "row">
      <div class = "col-12 text-center">
<label>x  = </label><input id = "solution1"><button id = "check1" >Check</button>
</div></div>


 <div class = "row">
      <div class = "col-12 text-center">
     <label>y  = </label><input id = "solution2"><button id = "check2" >Check</button>


</div></div>


 <div class = "row">
      <div class = "col- 12 text-center">

        
   <label>z  = </label><input id = "solution3"><button id = "check3" >Check</button>       
        

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
    

    function makeQuestion()

 
// x + y = N

    {
        let x = numbers[0];
        let y = numbers[1];
        let z = numbers[2];
        let n = parseInt(x + y + z);
        let question  = 'Find x,y so that x y = ' + n + " and "  + "x < y" ; 
     //   $('#ex1').text(question);
       let answer = [];
       
        var expr = '$ x + y + z  ' + ' = ' + n + '$' + ' and '  + '$ x < y < z $' ;
        $('#equations').html(expr);
         MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equations" ]);
        answers = [x,y,z];
        console.log("q1",x,y,z,n,answers,expr);
        return answers ;
    }


</script>

<script type="text/javascript">
  

$(document).ready(function(){   
// problem 
       question = '<?php echo $question; ?>' ;
p = [];
numbers = [];
max = 41 ;
numbers = makePrimes(max);
numbersOriginal = numbers.slice();
shuffle(numbers);
// alert(numbers);
$('#possibles').text('(');

let l = numbers.length;

for (let i = 0; i < l -1  ; i++)
{
    $('#possibles').append(numbersOriginal[i] + ",");
}
 $('#possibles').append(numbersOriginal[l-1] + ")");
p = makeQuestion();

p.sort(function(a, b) {
  return a - b;
});
x = p[0];
y = p[1];
z = p[2] ;

answer[1] = x;
answer[2] = y;
answer[3] = z;

checkAnswer(3);
//console.log(p);
//console.log(answer);
}) 
</script>


