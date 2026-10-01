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

<title>Lines</title>

<style>

#summary {text-align: center;}

[id^=solution]  {text-align: center;margin-bottom:1em;}
[id^=check] {margin-bottom:1em;}
[id^=equation] {margin-bottom:1em;}
</style>




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

</head>
<body>

    <div class  = "container-fluid">

    

    <div class = "row">
      <div class = "col-sm-12 c">


  
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
<label id = "equation1"></label>
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
<label id = "equation2"></label>
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
<label id = "equation3"></label>
</div>

<div class = "col-3">   
<input id = "solution3">
</div>

 <div class = "col-3"> 
<button id = "check3">Check 3</button>
</div></div>

<script>
    function makeTriples()

    {
        triples = [];
        p = makePrimes(2,200);
       // console.log(p);
        for (let m = 2 ; m <= 5; m++)
        {
            for (let n = 1; n < m ; n++)
            {
                a = m*m + n*n;
                b = m*m - n*n;
                c = 2*m*n;
                i = p.indexOf(a);
             //   triples.push([a,b,c])
           //     console.log(m,n,a,b,c,i);
               if (i > -1){
                    triples.push([a,b,c]);
                }
            }
        }

        return triples;
    }

</script>

<script>
    function getABC(triple) 

    {
        p = [];
       
        a = [triple[0],0];
        b = [triple[1],0];
        c = [0,triple[2]];
       
       
      
        p.push(a);
        p.push(b);
        p.push(c);

        return p
    }

</script>

<script type="text/javascript">
    
function transform(x,y,scale)
{
    data = [];


xmax = 300;
ymax = 300;
x0 = 100;   // offset
y0 = 200;   // offset
size = 200;

console.log("parameters",x,y,scale);
    x = parseInt(x*size/scale + x0) ;
    y = y0 - parseInt(y*size/scale);
  
    // transform from catesian to origin at top left
   
    data.push(x);
    data.push(y);
     console.log("Transform",data);
    return data;
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

<script>

    function makeQuestion2()

    {

       var term = 'Area of triangle ABC = ' ;
        $('#equation2').html(term);
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation2" ]);

  //   area = 0.5*b*c;
      
    //    return area;

    }
</script>

<script>

    function makeQuestion3()

    {

       var term = 'Perimeter of triangle ABC =' ;
        $('#equation3').html(term);
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation3" ]);


    }
</script>

<script type="text/javascript">
   function decodeHTML(html) {
    var txt = document.createElement("textarea");
    txt.innerHTML = html;
    return txt.value;
}
</script>

<script>

$(document).ready(function(){
var c = document.getElementById("myCanvas");
 ctx = c.getContext("2d");
 ctx.width  = 300;
ctx.height = 300;
labels = ["A","B","C"];
t = [];
points = 0 ;
correct = 0 ;
t  = makeTriples(); // use for checking triples
//console.log("triples",t);
let l = t.length;
let i = randomInteger(0,l-1);

// 200 points let to draw in 
pnts = getABC(triples[i]);
console.log(pnts);
scale = pnts[0][0]*1.5;

a = pnts[0][0];
b = pnts[1][0];
c = pnts[2][1];
console.log("abc",a,b,c);
console.log("scale",scale);
pts = []; // transformed points
pts.push(transform(0,0,scale));
pts.push(transform(b,0,scale));
pts.push(transform(b,c,scale));

console.log("pts",pts);

// make dots 

r = 5;
ctx.font = "24px Arial";

for (i = 0 ; i < 3 ; i++)
{

x = pts[i][0];
y = pts[i][1];
ctx.beginPath();
ctx.arc(x,y,r,0,2*Math.PI);
ctx.stroke();

ctx.fill();
// ctx.fillStyle = "yellow";
if (i == 0){ctx.fillText(labels[i], x-20, y+25);}
if (i == 1){ctx.fillText(labels[i], x+20, y+25);}
if (i == 2){ctx.fillText(labels[i], x+20, y);}



// Draw the Path
ctx.stroke();

}


x = pts[0][0];
y = pts[0][1];
ctx.moveTo(0, 0);
ctx.beginPath();
ctx.lineTo(x,y);
ctx.stroke();

x = pts[1][0];
y = pts[1][1];
ctx.lineTo(x,y);
ctx.stroke();

x = pts[2][0];
y = pts[2][1];
ctx.lineTo(x,y);
ctx.stroke();

x = pts[0][0];
y = pts[0][1];
ctx.lineTo(x,y);
ctx.stroke();

// legend
ctx.font = "14px Arial";
labelA = 'A = (0,0)';
labelB = 'B = (' + b + ',0)';
labelC = 'C = (0,' + c + ')';
labelD = decodeHTML("&#8736;") + 'B = 90' + decodeHTML("&deg;");
ctx.fillText(labelA, 250, 25);
ctx.fillText(labelB, 250, 50);
ctx.fillText(labelC, 250, 75);
ctx.fillText(labelD, 250, 100);
// if (i == 1){ctx.fillText(labels[i], x+20, y+25);}
// if (i == 2){ctx.fillText(labels[i], x+20, y);}

answer = [];

question = '<?php echo $question; ?>' ;

// x,y,radius, anngleStart, angleEnd

answer = [];

answer[1] = makeQuestion1() ;
answer[2] = makeQuestion2() ;
answer[3] = makeQuestion3() ;

answer[1] = a;
answer[2] = 0.5*b*c;
answer[3] = +a+b+c;
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
            points = +points + 2 ;
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



