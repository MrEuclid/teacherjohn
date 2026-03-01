<?php 
$question = isset($_POST['question']) ? $_POST['question'] : 'Travelling salesperson';
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

<title>Pizza</title>

<style>

#summary {text-align: center;}
</style>

<script>
// 1. GLOBAL VARIABLES (Must be defined cleanly)
var answer = [];
var correct = 0;
var points = 0;
// Global variables for canvas

</script>



<script type="text/javascript">

     function makePrimes(min,max) {
  // Create an array to store if a number is prime
  const isPrime = new Array(max + 1).fill(true);

  isPrime[0] = isPrime[1] = false;

  for (let i = 2; i * i <= max; i++) {
    if (isPrime[i]) {
      // If the number is prime, mark its multiples as composite (not prime)
      for (let j = i * i; j <= max; j += i) {
        isPrime[j] = false;
      }
    }
  }

  // Collect prime numbers from the isPrime array
  const primes = [];
  for (let i = 2; i <= max; i++) {
    if (isPrime[i] & i >= min) {
      primes.push(i);
    }
  }

  return primes;
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
  return array;
}


</script>

<script>
    
    function permute(permutation) {
  var length = permutation.length,
      result = [permutation.slice()],
      c = new Array(length).fill(0),
      i = 1, k, p;

  while (i < length) {
    if (c[i] < i) {
      k = i % 2 && c[i];
      p = permutation[i];
      permutation[i] = permutation[k];
      permutation[k] = p;
      ++c[i];
      i = 1;
      result.push(permutation.slice());
    } else {
      c[i] = 0;
      ++i;
    }
  }
  return result;
}
</script>


<script>
    function drawLine(pt1,pt2,n)
    {

        // point 1, point 2 as integers and distance = p
        ctx.font = "18px Arial";
        ctx.fillStyle = 'green';
//AB
        x1 = centers[pt1][0];
        x2 = centers[pt2][0];
        y1 = centers[pt1][1];
        y2 = centers[pt2][1];
        midx =  (x2 + x1) / 2;
        midy = (y2+ y1)/2 ;

        ctx.moveTo(centers[pt1][0],centers[pt1][1]);
        ctx.lineTo(centers[pt2][0],centers[pt2][1]);
        ctx.stroke();
        ctx.fillText(n, midx, midy - 5);
     //   alert(pt1 + " " + pt2 + " " + midx + " " + midy + " " + n);
        console.log(pt1,pt2,midx,midy,n);
    }

</script>

<script>

    function calcTime(code)
    {
        var c = 0 ;
        var cost = 0;
        var temp = 0;
    // alert(code + " " + code.length);
        for (var i = 0 ; i <= code.length - 2; i++)
        {
            var cost = 0;
            // get index of char pair in times[i][0]
            // get times[i][1] add to total
            var next = parseInt(i+1);
            if (code[i] < code[next])
            {target = code[i] + code[next];}
            if (code[i] > code[next])
            {target =  code[next] + code[i];}
            for (var j = 0; j <= times.length - 1; j++) 
            {
        // This if statement depends on the format of your array
                if (times[j][0] == target ) 
                    {
                        cost = times[j][1]  ; 
                        temp += cost ;
                        console.log("hit",i,j,target,cost,c);
                    }
                    
                c = parseInt(cost + c);
            }  // j
          
          
         //    console.log(i,code[i],code[i] + code[next],target,cost,c);
        }  // i
        return temp
    } // function
</script>
</head>
<body>

    <div class  = "container-fluid">

    

    <div class = "row">
      <div class = "col-sm-12 c">

    <h3>Deliver the Pizzas!</h3>
  <p>Start at A. Visit houses B,C and D and return to A.</p>
  
</div></div>
   <div class = "row">
      <div class = "col-sm-12 c">

<canvas id="myCanvas" width="500" height="280" style="border:1px solid #d3d3d3;">
Your browser does not support the HTML canvas tag.</canvas>
</div></div>

<p id = "summary"></p>

<!-- questions -->


 <div class = "row justify-content-center">
      <div class = "col-3">
    <div id = "ex1"></div>
    </div>
    
    <div class = "col-3">   
<label id = "equation1">How many different journeys can you make? e.g. ABCDA, ACDBA,...</label>
</div>

    <div class = "col-3">   
<input id = "solution1">
</div>

 <div class = "col-3"> 
<button id = "check1">Check 1</button>
</div>
</div>



 <div class = "row justify-content-center">
      <div class = "col-3">
    <div id = "ex2"></div>
    </div>
    
 <div class = "col-3"> 
<label id = "equation2">How many minutes for the quickest journey?</label>
</div>

<div class = "col-3">   
<input id = "solution2">
</div>

 <div class = "col-3 "> 
<button id = "check2">Check 2</button>
</div></div>



 <div class = "row justify-content-center">
      <div class = "col-3">
    <div id = "ex3"></div>
    </div>

 <div class = "col-3"> 
<label id = "equation3">How many minutes for the slowest journey?</label>
</div>

<div class = "col-3">   
<input id = "solution3">
</div>

 <div class = "col-3"> 
<button id = "check3">Check 3</button>
</div></div>




<script>
$(document).ready(function(){
var c = document.getElementById("myCanvas");
 ctx = c.getContext("2d");
labels = ["A","B","C","D"];
p  = makePrimes(13,37);
d = shuffle(p);
console.log(d);
answer = [];
points = 0 ;
question = '<?php echo $question; ?>' ;
centers = [[100,50],[400,40],[450,220],[120,200]];
r = 40;
ctx.font = "24px Arial";
for (var i = 0 ; i <= 3 ; i++)
{
x = centers[i][0];
y = centers[i][1];
ctx.beginPath();
ctx.arc(x,y,r,0,2*Math.PI);
ctx.stroke();
if (i > 0 ){ctx.fillStyle = 'red';}
else {ctx.fillStyle = 'green';}
ctx.fill();
ctx.fillStyle = "yellow";
ctx.fillText(labels[i], x-5, y+5);


}
// x,y,radius, anngleStart, angleEnd

times = [];
drawLine(0,1,d[0]); //ab 0
times.push([labels[0]+labels[1],d[0]]);
drawLine(1,2,d[1]); // bc 1
times.push([labels[1]+labels[2],d[1]]);
drawLine(2,3,d[2]); // cd 2
times.push([labels[2]+labels[3],d[2]]);
drawLine(3,0,d[3]); // ad 3
times.push([labels[0]+labels[3],d[3]]);
drawLine(0,2,d[4]); // ac 4
times.push([labels[0]+labels[2],d[4]]);
drawLine(1,3,d[5]); // bd 5
times.push([labels[1]+labels[3],d[5]]);


var l = times.length;
message = "";
var lookup = [];
for (var i = 0 ; i < l; i++)
{
  message += times[i][0] + " = " + times[i][1] + "min  ";
}
$("#summary").text(message);
console.log("times",times);
answer1 = times.length;
// times

r = permute(labels);
//console.log(r);
paths = [];
l = r.length;
for (var i = 0 ; i < l; i++)
{
    if (r[i][0] == "A")
        {paths.push(r[i])}
}
console.log("possible from A",paths);
journeys = [];

var l = paths.length;
for (var i = 0; i < l ; i++)
{
    var route = "";
    for (var j = 0 ; j < paths[i].length ; j++)
    {
        route += paths[i][j];
    }
    route += "A";
    journeys[i] = route;
    console.log("route",i,journeys[i]);
}

console.log(journeys);
min = 999;
max = 0;
for (var i = 0 ; i < journeys.length; i++)

{
x = calcTime(journeys[i]);
console.log("cost",journeys[i],x)
if (x < min) {min = x;}
if (x > max){max = x;}
}

answer2 = min;
answer3 = max;

answer[1] = answer1;
answer[2] = answer2;
answer[3] = answer3;

checkAnswer(3);

console.log(answer);
})
</script> 



</body>
</html>


<script type="text/javascript">
    

      function randomInteger(min, max) { // min and max included 
  return Math.floor(Math.random() * (max - min + 1) + min);
}
</script>

