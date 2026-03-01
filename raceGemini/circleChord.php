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
    <script src = "https://cdnjs.com/libraries/mathjs"></script>
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
  <link rel="stylesheet" href="race2024.css">
<script src="javascript/utilities.js"></script>

<title>Circle and line</title>

<style>

#summary {text-align: center;}

[id^=solution]  {text-align: center;margin-bottom:1em;}
[id^=check] {margin-bottom:1em;}
[id^=equation] {margin-bottom:1em;}
</style>

</head>
<body>

    <div class  = "container-fluid">
    <div class = "row">
      <div class = "col-sm-12 c">

    <h2>Circle & Line</h2>
  <h3 id = "equation"></h3>
  
</div></div>
   <div class = "row">
      <div class = "col-sm-12 c">

<canvas id="myCanvas" width="400" height="400" style="border:1px solid #d3d3d3;">
Your browser does not support the HTML canvas tag.</canvas>
</div></div>

<p id = "summary"></p>

<!-- questions -->


 <div class = "row justify-content-center">
      <div class = "col-3">
    <div id = "ex1"></div>
    </div>
    
    <div class = "col-3">   
<label id = "equation1">At point A, x = </label>
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
<label id = "equation2">At point B, x = </label>
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
<label id = "equation3"> $ \overline{AB} $ =  (2dp) </label>
</div>

<div class = "col-3">   
<input id = "solution3">
</div>

 <div class = "col-3"> 
<button id = "check3">Check 3</button>
</div></div>



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
    
    function drawAxes()

    {
// use central axes - x -10 to 10, y = -10 to 20
        // point 1, point 2 as integers and distance = p
ctx.font = "18px Arial";
ctx.strokeStyle = "blue";


// x axis
ctx.beginPath();
ctx.moveTo(0, side/2);
ctx.lineTo(side, side/2);
ctx.stroke();
//ctx.fillText("X", side -10, side/2 - 5);


// y axis from xmid, ymin to xmid,ymax
ctx.beginPath();
ctx.moveTo(side/2,0);
ctx.lineTo(side/2, side);
ctx.stroke();

  ctx.font = "18px Georgia";
ctx.fillText("X", 400,200)   ; 
ctx.fillText("Y", 200,20)   ; 
ctx.fillText("0", 200,200)   ; 
   


        
    }
    
</script>


<script type="text/javascript">
    

   function transform(x, y, canvasWidth, canvasHeight, minX, minY, maxX, maxY)
    {

        data = [];
  // Check for invalid input
  if (minX >= maxX || minY >= maxY) {
    throw new Error("Invalid range for cartesian coordinates.");
  }

  // Calculate scaling factors
  const scaleX = canvasWidth / (maxX - minX);
  const scaleY = canvasHeight / (maxY - minY);

  // Apply scaling and offset
  const canvasX = scaleX * (x - minX);
  const canvasY = canvasHeight - scaleY * (y - minY); // Invert Y for canvas
data[0] = [canvasX,canvasY];
return data[0];
 // return { x: canvasX, y: canvasY };
}





</script>


<script type="text/javascript">
    
    function drawCircle(radius)

{

let r = radius * 20;

cX = side/2;
cY = side/2;

ctx.beginPath();
ctx.arc(cX, cY, r, 0, 2 * Math.PI);
//ctx.lineWidth = 1; 
ctx.stroke();



 var expr = '$ x^2 + y^2  = ' + radius*radius + '$';

$('#equation').html(expr);
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation" ]);

    }
</script>


<script>

    function makeQuestion()

    {

// draw a line y = n where 1 <= n <= 5
let r = randomInteger(3,9);
var n = r-1;
drawCircle(r);

let start = transform(xMin,n,side,side,xMin,yMin,xMax,yMax);
let finish = transform(xMax,n,side,side,xMin,yMin,xMax,yMax);
cx = start[0];
cy = start[1];


cxNext = finish[0];
cyNext = finish[1];
console.log(start,finish);
console.log(cx,cy,cxNext,cyNext);
  ctx.moveTo(cx,cy);
    ctx.lineTo(cxNext,cyNext);
    ctx.stroke();

// intercepts on the circle are +/- sqrt(n)

let x = Math.sqrt(n);
let x1 = -x;
let x2 = x;

A = transform(x1,n,side,side,xMin,yMin,xMax,yMax);
B = transform(x2,n,side,side,xMin,yMin,xMax,yMax);

ax = A[0];
ay = A[1];
bx = B[0];
by = B[1];

// write A, B
ctx.fillStyle = "green";
ctx.font = "18px Georgia";
ctx.fillText("A", ax,ay)   ; 
ctx.fillText("B", bx,by)   ; 


// find the points where x^2 = r^2-n^2;

let xA = -Math.sqrt(r*r  - n*n) ;
let xB = Math.sqrt(r*r  - n*n) ;
// let AB = Math.sqrt((xA - n)*(xA - n) + (xB - n)*(xB - n));
let AB = xB - xA;


let lineEqtn = '$ y = ' + n    + ' $';

a = [0,xA, xB,AB] ;  // 0 is to start answers at index 1

$('#equation').append(' and ' + lineEqtn);

      
        return a ;

    }
</script>

<script type="text/javascript">
    function fquad(x,expr) // uses expression generated by makeQuadratic
    {
        y = eval(expr);
        return y
    }
</script>

<script>

$(document).ready(function(){
      question = '<?php echo $question; ?>' ;
var c = document.getElementById("myCanvas");
 ctx = c.getContext("2d");
 side = 400; 
ctx.width  = side;
ctx.height = side;
labels = ["A","B","C","D"];  // axes intercepts + minima/maxima
xMin = -10;
xMax = 10;
yMin = -10;
yMax = 10;
rMax = 10;

rScale = rMax*side/2/(xMax - xMin);   // 10*200/20 = 20
// drawAxes();
// x axis
ctx.beginPath();
ctx.moveTo(0, side/2);
ctx.lineTo(side, side/2);
ctx.stroke();
//ctx.fillText("X", side -10, side/2 - 5);


// y axis from xmid, ymin to xmid,ymax
ctx.beginPath();
ctx.moveTo(side/2,0);
ctx.lineTo(side/2, side);
ctx.stroke();

ctx.font = "18px Georgia";
ctx.fillText("X", 400,200)   ; 
ctx.fillText("Y", 200,20)   ; 
ctx.fillText("0", 200,200)   ; 
   
 answer = makeQuestion()
question = '<?php echo $question; ?>' ;

// x,y,radius, anngleStart, angleEnd
// answer[1] = answer ;
console.log("answer",answer);

checkAnswer(3);

})
</script> 


