<?php 
$question = $_POST['question'];

?>

<!DOCTYPE html>
<html lang="en">

  <head>
 
 
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../bootstrap-5.0.2-dist/css/bootstrap.min.css">
  <script src="../javaScript/jQuery/jquery-3.3.1.min.js"></script>
  <script src="../bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
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

<title>Lines</title>

<style>

#summary {text-align: center;}

[id^=solution]  {text-align: center;margin-bottom:1em;}
[id^=check] {margin-bottom:1em;}
[id^=equation] {margin-bottom:1em;}
</style>






<script>
   

</script>

</head>
<body>

    <div class  = "container-fluid">

    

    <div class = "row">
      <div class = "col-sm-12 c">

    <h2>Parabola</h2>
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
<label id = "equation1">At point C, y = </label>
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
<label id = "equation2">At point A, x = </label>
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






</body>
</html>


<script type="text/javascript">
    
    function drawAxes()

    {
// use central axes - x -10 to 10, y = -10 to 20
        // point 1, point 2 as integers and distance = p
ctx.font = "18px Arial";

ctx.strokeStyle = "blue";
// x axis starts at 0,ymid to xmax,ymid
let xMid = (xMax + xMin)/2;
let yMid = (yMax + yMin)/2;
cnvs = transform(xMid,yMid,xMin,xMax,yMin,yMax);  // mid points
let cxmid = cnvs[0][0];
let cymid = cnvs[0][1];
// alert(xMid + " " + yMid + " " +cxmid + " " + cymid);
cnvs = transform(xMin,yMin,xMin,xMax,yMin,yMax);  // 0,ymid
let cxstart = cnvs[0][0]; // x = 0 
let cystart = cnvs[0][1]; // y = ymid
      
 cnvs = transform(xMax,yMax,xMin,xMax,yMin,yMax); // xmax,ymid
let cxend = cnvs[0][0];  // xmax
let cyend = cnvs[0][1];  // ymid

// x axis
ctx.beginPath();
ctx.moveTo(cxstart,cymid); //y units up left hand side
ctx.lineTo(cxend,cymid);
ctx.stroke();
 ctx.fillText("X", cxend + 5,cyend-5);


// y axis from xmid, ymin to xmid,ymax

ctx.beginPath();
ctx.moveTo(cxmid,cystart); //y units up left hand side
ctx.lineTo(cxmid,cyend);
ctx.stroke();

  ctx.font = "18px Georgia";
ctx.fillText("X", 400,200)   ; 
ctx.fillText("Y", 200,20)   ; 
ctx.fillText("0", 200,200)   ; 
    

        
    }
    
</script>


<script type="text/javascript">
    
function transform(x,y,xMin,xMax,yMin,yMax)
{
    data = [];


let cxMax = side;  // canvas is 300 x 300
let cyMax = side;

let xScale = (cxMax)/(xMax- xMin);  // 300/20 = 15
let xShift = -xMin*xScale;          // -10*15 = -150

let yScale = cyMax/(yMax - yMin); // 300/(20 --10) = 10
let yShift = yMin*yScale;        // -10*10 = -100

let xc = x*xScale + xShift;    // x = -10, xc = -10*15 -xGhift  = 0 
let yc = side - (+y*yScale - yShift) ;    // y = 10 , yc = 300 - (10*10 + 100 )= 100

data[0] = [xc,yc];

return data;




}

</script>


<script type="text/javascript">
    
    function makeQuadratic(xmin,xmax)

 //   -x*x + bx + bc = -(x+b)(x-c) where b,c > 0
 
    {
// x^2 +/- bx +/- c = 0
// -(x+p)(x-q) = 0  -(x^2 +px - qx -pq) = -(x^2 +x(p-q) -pq)
// y = -x^2 -(p-q)x + pq
 let  p = 0;
 let  q = 0; 
 let lim = xmax;
while (p*q == 0 ) 
{
    p = randomInteger(-lim,0);
    q = randomInteger(1,lim);
}

let b = q - p;
let c = -p*q;
// allow for negative coefficients
let linear = '';
let cnst = '';
if (b < 0) {linear =  b;} 
if (b == 1) {linear = "+";}
if (b == -1) {linear = "-";}
if (b > 1 ) {linear = '+' + b;}
if (c < 0) {cnst = c;} else {cnst = '+' + c;}

       var expr = '$ y = -x^2 ' + linear + 'x' + cnst +  '$';
    //  var expr = '$ \\sum_{i=1}^n a_i$';
    $('#equation').html(expr);
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation" ]);
  
// make as string for evaluation 
let y = '-x*x + ' + b + '*x' + '+' + c;
  let midpt = +(p + q)/2;
   let data = [];
   data[0] = [-q,p]; // roots
   data[1] = expr;
   data[2] = y ;
   data[3] = midpt ;
        return  data;
    }
</script>


<script>

    function makeQuestion1()

    {

       var term = '$ \\overline{AC} = $' ;
        $('#equation1').html(term);
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation2" ]);

     
      
        return a;

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
var c = document.getElementById("myCanvas");
 ctx = c.getContext("2d");
 side = 400; 
ctx.width  = side;
ctx.height = side;
labels = ["A","B","C","D"];  // axes intercepts + minima/maxima
xMin = -6;
xMax = 6;
yMin = -20;
yMax = 20;

// alert(xMin + " " + xMax + " " + yMin + " " + yMax);



drawAxes();
let fnc = [];
fnc = makeQuadratic(xMin,xMax);
console.log("returned ",fnc);
x1 = fnc[0][0];
x2 = fnc[0][1] ;
yxpr = fnc[2] ;
// alert(yxpr + ' ' + fquad(0,yxpr));
ctx.font = "18px Arial";
ctx.strokeStyle = "red";

for (let x = xMin; x < xMax; x = x+ 0.25)
{
   // y = x*x + 2*x - 3;
    y = fquad(x,yxpr);
    //x*x;
  
    cnvs = transform(x,y,xMin,xMax,yMin,yMax);
     let cx = cnvs[0][0];
    let cy = cnvs[0][1];
   let cxy = +(cx + cy);
  if (x == 0){ctx.fillText("C",cx,cy);}
  if (x == x1){ctx.fillText("A",cx,cy);}
  if (x == x2){ctx.fillText("B",cx,cy);}
  //   console.log("cnvx",cx,cy,cxy);
    let xnext = x+0.25;
    let ynext = fquad(xnext,yxpr); 
    //xnext*xnext;
    cnvsnext = transform(xnext,ynext,xMin,xMax,yMin,yMax);
    let cxnext = cnvsnext[0][0];
    let cynext = cnvsnext[0][1];
    // console.log("cnvxnext",cxnext,cynext,cnvsnext);
    ctx.beginPath();
    ctx.moveTo(cx,cy);
    ctx.lineTo(cxnext,cynext);
    ctx.stroke();

//    ctx.beginPath();
//ctx.moveTo(cx,cy);
//ctx.lineTo(16.5,250.9);
//ctx.stroke();


}



points = 0 ;
correct = 0 ;

answer = [];

question = '<?php echo $question; ?>' ;

// x,y,radius, anngleStart, angleEnd

answer = [];

answer[1] = fquad(0,yxpr) ;
answer[2] = x1;
answer[3] = x2 ;

console.log(answer);

})
</script> 


<script>
      $(document).ready(function(){
    $('[id^=check]').on('click', function()


    {
        var clicked = this.id;
        var qNumber = clicked.slice(-1);
        alert("Checking " + qNumber);

        var guess = $('#solution' + qNumber).val() ;
        if (guess == answer[qNumber])
        {
            alert("Correct");
            $('#solution' + qNumber).prop('disabled',true).css({"background-color":"lightgreen","color":"black"});
            $('#' + clicked).hide() ;
            points = parseInt(points) + parseInt(qNumber) ;
            console.log(clicked,points);
            if (points == 6)

            {


alert("Processing win " + questionID + " with " + points + " pts");
processWin(questionID);
    console.log("processing ",questionID);


            }
        }

        else

        {
            alert("keep trying")
        }
})
})

</script>





