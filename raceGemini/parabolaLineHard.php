<?php 
$question = isset($_POST['question']) ? $_POST['question'] : 'Parabola line';
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

<title>Line and parabola</title>

<style>

label {font-weight: bold; font-size: 1.2em; margin-top: 1em;}

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

    <h2>Parabola & Line</h2>
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
<label>At point A, x =  (2dp)</label>
</div>

    <div class = "col-3">   
<input id = "solution1">
</div>

 <div class = "col-3"> 
<button id = "check1">Check 1</button>
</div></div>


 <div class = "row justify-content-center">
      <div class = "col-3">
    <div id = "ex1"></div>
    </div>
    
    <div class = "col-3">   
<label>At point B, x =  (2dp) </label>
</div>

    <div class = "col-3">   
<input id = "solution2">
</div>

 <div class = "col-3"> 
<button id = "check2">Check 1</button>
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
    function solveQuadratic(a,b,c)
    {
        let x = [];

        let det = b*b -4*a*c;
        x1 = (-b - Math.sqrt(det))/ (2*a);
        x2 = (-b + Math.sqrt(det))/ (2*a);

        // sort x1, x2
        let t = x1 ;
        if (x2 < x1)
            {
                x1 = x2;
                x2 = t;
            }
        num1 = -b - Math.sqrt(det);
        num2 = -b + Math.sqrt(det);
        denom = 2*a;
        x1 = round2DP(x1);
        x2 = round2DP(x2);
        x[0] = [x1,x2,num1,num2,denom];
        return x[0];
    }
</script>


<script type="text/javascript">
    
    function makeQuadratic(xmin,xmax)

 //   y = x^2
// line y = mx + c
 
    {
// draw y = x^2

 var expr = '$ y = x^2  $';
    //  var expr = '$ \\sum_{i=1}^n a_i$';
$('#equation').html(expr);
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation" ]);
  
// make as string for evaluation 
let y = 'x*x' ;

   let data = [];
   data[1] = expr;
   data[2] = y ;
 
        return  data;
    }
</script>


<script>

    function makeQuestion1()

    {
// y = mx + c cuts the parabola in two places.
// the line goes from (-5,0) and cuts at (n,n^2) where n in [1,2,3,4]
//B has coordinate (n,n*n)
// the equation of the line is (n+5)y = n*n x + 5n = by - ax = 5n
let n = randomInteger(2,4); // Bx
// n = 2; // known soluntion
// y = mx + c 
// m = n*n / (n + 5)
// y = (ax + c) / b 

let m = 10*n*n / (n + 5);   // goes back to x = -5 
// let quadratic = (n+5)*x*x - n*n*x -5n*n = 0 ;
a = (n+5);
b = -n*n;
c= -5*n*n;
soltn = solveQuadratic(a,b,c);
console.log("solvex",a,b,c,soltn);
ax = soltn[0];
ay = ax*ax;

bx = soltn[1];
by = bx*bx;

let yEnd = (10*n*n)/(n+5);  // highest point of the line

let start = transform(-5,0,side,side,xMin,yMin,xMax,yMax);
let finish = transform(xMax,yEnd,side,side,xMin,yMin,xMax,yMax);
cx = start[0];
cy = start[1];

cxNext = finish[0];
cyNext = finish[1];
console.log(start,finish);
console.log(cx,cy,cxNext,cyNext);
  ctx.moveTo(cx,cy);
    ctx.lineTo(cxNext,cyNext);
    ctx.stroke();

// intercepts on the parabola are x = 0, sqrt(m)

let Bx = n;
let By = n*n;

// let Ax = 

A = transform(ax,ay,side,side,xMin,yMin,xMax,yMax);
B = transform(bx,by,side,side,xMin,yMin,xMax,yMax);

ax = A[0];
ay = A[1];
bx = B[0];
by = B[1];

// write A, B
ctx.fillStyle = "green";
ctx.font = "18px Georgia";
ctx.fillText("A", ax,ay)   ; 
ctx.fillText("B", bx,by)   ; 

//d =  Math.sqrt(x*x + y*y);

// console.log("q1",m,x,y,d);
// javascript doesn't do rounding as expected
// roundedNum = (Math.round( d * 100 ) / 100)

// append equation 
// straight line = n*n*x/(n+5) + 5n*n/(n+5)
let p = n*n;
let q = +n+5;
let r = 5*p;
let lineEqtn = '$' + q + 'y' + ' = ' + p + 'x + '  +  r  + ' $';

$('#equation').append(' and ' + lineEqtn);

       var term = '$ \\overline{OA} =  (2dp) $' ;
        $('#equation1').html(term);
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation2" ]);

        return soltn; // includes roots as decimal and fractions

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
xMin = -5;
xMax = 5;
yMin = -25;
yMax = 25;

drawAxes();
let fnc = [];
fnc = makeQuadratic(xMin,xMax);
// console.log("returned ",fnc);

yxpr = fnc[2] ;  // equation
// alert(yxpr + ' ' + fquad(0,yxpr));
ctx.font = "18px Arial";
ctx.strokeStyle = "red";
// build an array of transformed points;
newData = [];
let i = 0;
for (let x = xMin; x < xMax; x = x+ 0.25)
{
   // y = x*x + 2*x - 3;
    y = fquad(x,yxpr);
    //x*x;
  
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

// console.log("newData",newData);

let a = makeQuestion1()
question = '<?php echo $question; ?>' ;

// x,y,radius, anngleStart, angleEnd
answer[1] = a[0] ;   
answer[2] = a[1]  ;    // B
checkAnswer(2);
console.log(answer);

})
</script> 

