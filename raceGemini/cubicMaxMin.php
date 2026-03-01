<?php 
$question = isset($_POST['question']) ? $_POST['question'] : 'Cubic Challenge';
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

<link rel="stylesheet" href="../css/templeStyles.css">
<link rel="stylesheet" href="../css/newTempleStyles.css">
<link rel="stylesheet" href="race2024.css">

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

<title>cubic - turning points </title>

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

    <h2>Find the turning points, A and B.</h2>
  <h3 id = "equation"></h3>
  
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
<label id = "equation2">At point A, y = </label>
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
<label id = "equation3">At point B, x = </label>
</div>

<div class = "col-3">   
<input id = "solution3">
</div>

 <div class = "col-3"> 
<button id = "check3">Check 3</button>
</div></div>


 <div class = "row justify-content-center">
      <div class = "col-3">
    <div id = "ex4"></div>
    </div>

 <div class = "col-3"> 
<label id = "equation4">At point B, y = </label>
</div>

<div class = "col-3">   
<input id = "solution4">
</div>

 <div class = "col-3"> 
<button id = "check4">Check 4</button>
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

/*
// x axis starts at 0,ymid to xmax,ymid
let xMid = (xMax + xMin)/2;
let yMid = (yMax + yMin)/2;
cnvs = transform(xMid,yMid,side,side,xMin,yMin,xMax,yMax);  // mid points
let cxmid = cnvs[0][0];
let cymid = cnvs[0][1];
// alert(xMid + " " + yMid + " " +cxmid + " " + cymid);
cnvs = transform(xMin,yMin,side,side,xMin,yMin,xMax,yMax);  // 0,ymid
let cxstart = cnvs[0][0]; // x = 0 
let cystart = cnvs[0][1]; // y = ymid
      
 cnvs = transform(xMax,yMax,side,side,xMin,yMin,xMax,yMax); // xmax,ymid
let cxend = cnvs[0][0];  // xmax
let cyend = cnvs[0][1];  // ymid

*/
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
    
    function makeCubic()

// chose the derivative to be an easily factorisable quadratic
// b^2 - 4c 
// example x^2 - 5x + 6
// y = 1/3x^3 - 5/2x^2 + 6x + 1
// piars to make derivative


{
let alpha = randomInteger(-5,-1);
let beta = randomInteger(-5,-1)

let a = randomInteger(2,10);  // x^2 - a^2
// let b = 1;
//let b = randomInteger(4,5);
//let c = randomInteger(6,7);
//let expr =  '$ y = (x-' +a + ')(x - ' + b + ')(x - ' + c +') $' ;
// let  expr = '$ y = x^3 + ' + a + 'x^2 + ' + (b*c - a*b - a*c) + 'x + '  + a*b*c + ' $';
// let  y = 'x^3 + ' + a + 'x^2' + (b*c - a*b - a*c) + 'x + '  + a*b*c ;
//let y = '(x-' +a + ')(x - ' + b + ')(x - ' + c +')' ;

let expr = '$ y = x^3 - ' + a + 'x $' + ' and ' + '$ \\frac{dy}{dx} = 3x^2 - ' + a + '$';
$('#equation').html(expr);
MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation" ]);
  y = 'x**3' + ' - ' + a + '*x' ;
// make as string for evaluation 


   let data = [];
   data[0] = expr;
   data[1] = y ;
   data[2] = -a/3; // 1st turning point
   data[3] = a/3; // 2nd turning point
 
        return  data;
    }
</script>


<script>

    function makeQuestion1()

    {


    }
</script>

<script type="text/javascript">
    function fn_eval(x,expr) // uses expression generated by makeCubic
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
xMin = -5;
xMax = 5;
yMin = -25;
yMax = 25;
answer=[];
drawAxes();
let fnc = [];
fnc = makeCubic();
console.log("returned ",fnc);


yxpr =  fnc[1];  // equation
x = 3 ;
// alert(yxpr + ' x ' + fn_eval(3,yxpr));
ctx.font = "18px Arial";
ctx.strokeStyle = "black";
// build an array of transformed points;
newData = [];
let i = 0;
for (let x = xMin; x < xMax; x = x+ 0.25)
{
  
    y   =   fn_eval(x,yxpr);
     console.log(i,x,y);
    cnvs =  transform(x, y, side, side, xMin, yMin, xMax, yMax);
   newData[i] = cnvs;

   i++;
}

for (let i =0; i < newData.length -1 ; i++)
{
     ctx.beginPath();
     cx = newData[i][0] ;
     cy = newData[i][1] ;
     next = parseInt(i+1);
     cxNext = newData[next][0];
     cyNext = newData[next][1];
    ctx.moveTo(cx,cy);
    ctx.lineTo(cxNext,cyNext);
    ctx.stroke();
}

// add turning points 
let tpx1 = -Math.sqrt(Math.abs(fnc[2]));
let tpx2 = Math.sqrt(Math.abs(fnc[3]));
console.log("sqrt x",tpx1,tpx2);
let tpy1 = fn_eval(tpx1,yxpr);
let tpy2 = fn_eval(tpx2,yxpr);

answer = [0,round2DP(tpx1),round2DP(tpy1),round2DP(tpx2),round2DP(tpy2)];
console.log("turning points",tpx1,tpy1,tpx2,tpy2);
console.log(fnc);
// transform and label 
let turning = transform(tpx1, tpy1, side, side, xMin, yMin, xMax, yMax);

  ctx.font = "18px Georgia";
ctx.fillText("A", turning[0], turning[1]); 

turning = transform(tpx2, tpy2, side, side, xMin, yMin, xMax, yMax);
  ctx.font = "18px Georgia";
ctx.fillText("B", turning[0], turning[1]); 
console.log(answer);
checkAnswer(4);

})
</script> 

