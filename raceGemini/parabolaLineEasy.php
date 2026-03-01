<?php 
 $question = isset($_POST['question']) ? $_POST['question'] : '';
// line intersecting a parabola at AB, find the length of AB
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/11.8.0/math.min.js"></script>

  <script type="text/x-mathjax-config">
    MathJax.Hub.Config({
      extensions: ["tex2jax.js"],
      jax: ["input/TeX","output/HTML-CSS"],
      tex2jax: {inlineMath: [["$","$"],["\\(","\\)"]]}
    });
  </script>   
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.7/MathJax.js"></script>

  <link rel="stylesheet" href="../css/templeStyles.css">
  <link rel="stylesheet" href="../css/newTempleStyles.css">
  <link rel="stylesheet" href="race2024.css">
  <script src="javascript/utilities.js"></script>

  <title>Line and parabola</title>

  <style>
    #summary {text-align: center;}
    [id^=solution]  {text-align: center;margin-bottom:1em;}
    [id^=check] {margin-bottom:1em;}
    [id^=equation] {margin-bottom:1em;}
  </style>
</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 c">
        <h2>Parabola & Line</h2>
        <h3 id="equation"></h3>
      </div>
    </div>
    
    <div class="row">
      <div class="col-sm-12 c">
        <canvas id="myCanvas" width="500" height="280" style="border:1px solid #d3d3d3;">
          Your browser does not support the HTML canvas tag.
        </canvas>
      </div>
    </div>

    <p id="summary"></p>

    <div class="row justify-content-center">
      <div class="col-3">
        <div id="ex1"></div>
      </div>
      <div class="col-3">   
        <label id="equation1">At point C, y = </label>
      </div>
      <div class="col-3">   
        <input id="solution1">
      </div>
      <div class="col-3"> 
        <button id="check1" class="btn btn-primary">Check 1</button>
      </div>
    </div>
  </div>

<script>
// 1. GLOBAL VARIABLES (Must be defined cleanly)
var answer = [];
var correct = 0;
var points = 0;
// Global variables for canvas
var ctx, side, xMin, xMax, yMin, yMax;
</script>

<script type="text/javascript">
  function drawAxes() {
    ctx.font = "18px Arial";
    ctx.strokeStyle = "blue";

    // x axis
    ctx.beginPath();
    ctx.moveTo(0, side/2);
    ctx.lineTo(side, side/2);
    ctx.stroke();

    // y axis
    ctx.beginPath();
    ctx.moveTo(side/2,0);
    ctx.lineTo(side/2, side);
    ctx.stroke();

    ctx.font = "18px Georgia";
    ctx.fillText("X", 400,200); 
    ctx.fillText("Y", 200,20); 
    ctx.fillText("0", 200,200); 
  }
</script>

<script type="text/javascript">
  function transform(x, y, canvasWidth, canvasHeight, minX, minY, maxX, maxY) {
    var data = [];
    if (minX >= maxX || minY >= maxY) {
      throw new Error("Invalid range for cartesian coordinates.");
    }
    const scaleX = canvasWidth / (maxX - minX);
    const scaleY = canvasHeight / (maxY - minY);
    const canvasX = scaleX * (x - minX);
    const canvasY = canvasHeight - scaleY * (y - minY); 
    data[0] = [canvasX,canvasY];
    return data[0];
  }
</script>

<script type="text/javascript">
  function makeQuadratic(xmin,xmax) {
    var expr = '$ y = x^2  $';
    $('#equation').html(expr);
    MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation" ]);
  
    let y = 'x*x';
    let data = [];
    data[1] = expr;
    data[2] = y;
    return data;
  }
</script>

<script>
  function makeQuestion1() {
    let n = randomInteger(2,20);
    let start = transform(xMin,n,side,side,xMin,yMin,xMax,yMax);
    let finish = transform(xMax,n,side,side,xMin,yMin,xMax,yMax);
    
    let cx = start[0];
    let cy = start[1];
    let cxNext = finish[0];
    let cyNext = finish[1];

    ctx.moveTo(cx,cy);
    ctx.lineTo(cxNext,cyNext);
    ctx.stroke();

    let x = Math.sqrt(n);
    let x1 = -x;
    let x2 = x;

    let A = transform(x1,n,side,side,xMin,yMin,xMax,yMax);
    let B = transform(x2,n,side,side,xMin,yMin,xMax,yMax);

    let ax = A[0];
    let ay = A[1];
    let bx = B[0];
    let by = B[1];

    ctx.fillStyle = "green";
    ctx.font = "18px Georgia";
    ctx.fillText("A", ax,ay); 
    ctx.fillText("B", bx,by); 

    let d = 2*x;
    let roundedNum = (Math.round( d * 100 ) / 100);

    let lineEqtn = ' y = ' + n ;
    $('#equation').append(' and ' + lineEqtn);

    var term = '$ \\overline{AB} =  (2dp) $';
    $('#equation1').html(term);
    MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation1" ]); // Fixed targeting equation1
  
    return roundedNum;
  }
</script>

<script type="text/javascript">
  function fquad(x,expr) {
    let y = eval(expr);
    return y;
  }
</script>

<script>
// --- GRAPH DRAWING AND QUESTION GENERATION ---
$(document).ready(function(){
  var question = '<?php echo addslashes($question); ?>';
  var c = document.getElementById("myCanvas");
  ctx = c.getContext("2d");
  side = 400; 
  ctx.width = side;
  ctx.height = side;
  
  xMin = -5;
  xMax = 5;
  yMin = -25;
  yMax = 25;

  drawAxes();
  let fnc = makeQuadratic(xMin,xMax);
  let yxpr = fnc[2]; 

  ctx.font = "18px Arial";
  ctx.strokeStyle = "red";
  
  let newData = [];
  let i = 0;
  for (let x = xMin; x < xMax; x = x + 0.25) {
    let y = fquad(x,yxpr);
    let cnvs = transform(x, y, side, side, xMin, yMin, xMax, yMax);
    newData[i] = cnvs;
    i++;
  }

  for (let i = 0; i < newData.length - 1; i++) {
    ctx.beginPath();
    let cx = newData[i][0];
    let cy = newData[i][1];
    let next = parseInt(i+1);
    let cxNext = newData[next][0];
    let cyNext = newData[next][1];
    ctx.moveTo(cx,cy);
    ctx.lineTo(cxNext,cyNext);
    ctx.stroke();
  }

  // FIX: Properly place the answer into the array without destroying the array
  answer[1] = makeQuestion1();
  console.log("Answer array is now:", answer);
  checkAnswer(1);
});
</script> 

</body>
</html>