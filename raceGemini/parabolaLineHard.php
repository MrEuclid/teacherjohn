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
  
<title>Line and parabola</title>

<style>

label {font-weight: bold; font-size: 1.2em; margin-top: 1em;}

#summary {text-align: center;}


</style>

</head>
<body>

    <div class  = "container-fluid">
    <div class = "row">
      <div class = "col-12 text-center">

    <h2>Parabola & Line</h2>
  <h3 id = "equation"></h3>
  
</div></div>
   <div class = "row">
      <div class = "col-12 text-center">

<canvas id="myCanvas" width="500" height="280" style="border:1px solid #d3d3d3;">
Your browser does not support the HTML canvas tag.</canvas>
</div></div>

<p id = "summary"></p>

<!-- questions -->

<?php include "answerBootstrap2.html"; ?>


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

 

// make as string for evaluation 
let y = 'x*x' ;

   let data = [];
   data[1] = expr;
   data[2] = y ;
 
        return  data;
    }
</script>


<script>
function makeQuestion1() {
    // 1. Secure variables with 'let'
    let n = randomInteger(2, 4); 
    
    let m = 10 * n * n / (n + 5);   
    let a = (n + 5);
    let b = -n * n;
    let c = -5 * n * n;
    
    let soltn = solveQuadratic(a, b, c);
    console.log("solvex", a, b, c, soltn);
    
    let ax = soltn[0];
    let ay = ax * ax;

    let bx = soltn[1];
    let by = bx * bx;

    let yEnd = (10 * n * n) / (n + 5);  

    // Ensure side, xMin, etc., are defined globally or passed in!
    let start = transform(-5, 0, side, side, xMin, yMin, xMax, yMax);
    let finish = transform(xMax, yEnd, side, side, xMin, yMin, xMax, yMax);
    
    let cx = start[0];
    let cy = start[1];
    let cxNext = finish[0];
    let cyNext = finish[1];
    
    // Ensure 'ctx' is defined before this point!
    ctx.moveTo(cx, cy);
    ctx.lineTo(cxNext, cyNext);
    ctx.stroke();

    let A = transform(ax, ay, side, side, xMin, yMin, xMax, yMax);
    let B = transform(bx, by, side, side, xMin, yMin, xMax, yMax);

    // Canvas text
    ctx.fillStyle = "green";
    ctx.font = "18px Georgia";
    ctx.fillText("A", A[0], A[1]); 
    ctx.fillText("B", B[0], B[1]); 

    // Build the equation string
    let p = n * n;
    let q = n + 5; 
    let r = 5 * p;
    
    let lineEqtn = `$ ${q}y = ${p}x + ${r} $`;
     expr = `$ y = x^2 $<br>${lineEqtn}`; 
    
    $('#equation').html(expr);
    MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation"]);


      var term = 'At A, x =  ';
    $('#equation1').html(term);
    MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation1" ]); // Fixed targeting equation1

        var term = 'At B, y =  $';
    $('#equation2').html(term);
    MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation2" ]); // Fixed targeting equation2
    return soltn[0]; 
}
</script>


<script>
$(document).ready(function(){
    question = '<?php echo $question; ?>';
    var c = document.getElementById("myCanvas");
    
    // Make sure ctx is global (no var/let) so makeQuestion1 can use it
    ctx = c.getContext("2d");
    side = 400; 
    ctx.width  = side;
    ctx.height = side;
    labels = ["A","B","C","D"];  
    xMin = -5;
    xMax = 5;
    yMin = -25;
    yMax = 25;

    drawAxes();

    // --- DRAW THE Y = X^2 PARABOLA DIRECTLY ---
    // This removes the need for fquad() and makeQuadratic() entirely!
    ctx.strokeStyle = "red";
    ctx.beginPath();
    for (let x = xMin; x <= xMax; x = x + 0.25) {
        let y = x * x; // Matches the math in your makeQuestion1 exactly!
        let cnvs = transform(x, y, side, side, xMin, yMin, xMax, yMax);
        
        if (x === xMin) {
            ctx.moveTo(cnvs[0], cnvs[1]);
        } else {
            ctx.lineTo(cnvs[0], cnvs[1]);
        }
    }
    ctx.stroke();
    // -------------------------------------------

    // Generate the question, the line, and the math string
    answer = [];
  let   x = makeQuestion1();
  answer[1] = x;
 answer[2] = x*x;
    console.log(answer)
    // Assuming you have checkAnswer bound to your buttons
    checkAnswer(2); 
});
</script>
</script> 

