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

<script src="javascript/utilities.js">


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

<title>Two squares</title>

<style>

#summary {text-align: center;}

[id^=solution]  {text-align: center;margin-bottom:1em;}
[id^=check] {margin-bottom:1em;}
[id^=equation] {margin-bottom:1em;}
</style>

</head>
<body>

    <div class  = "container-fluid">

    
 <div class = "row justify-content-center">
      <div class = "col-12 ">
<p id = "question">x <sup>2</sup></p>
</div></div>

  
</div></div>
   <div class = "row">
      <div class = "col-sm-12 c">

<canvas id="myCanvas" width="600" height="300" style="border:1px solid #d3d3d3;">
Your browser does not support the HTML canvas tag.</canvas>
</div></div>

<p id = "summary"></p>

<!-- questions -->


 <div class = "row justify-content-center">
      <div class = "col-3">
    <p id = "ex">x<sup>2</sup></p>
    </div>
    
    <div class = "col-3">   
<label id = "equation"></label>
</div>

    <div class = "col-3">   
<input id = "solution1">
</div>

 <div class = "col-3"> 
<button id = "check1">Check </button>
</div>
</div>






</body>
</html>

<script>

    function makeQuestion1()

    {

        let x = 0 ;
        let y = 0 ;
        let min = 2;
        let max = 10;

        while (x == y)
        {
            x = randomInteger(min,max);
            y = randomInteger(min,max);

        }
        let n = x*x + y*y;
        let a = parseInt(x + y);
     //  $('#ex').html("x<sup>2</sup>");
       let  term = '$ x^2 + y^2 = ' + n + "$";
       term = term + " ,  x + y = ? "
        $('#equation').html(term);
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation" ]);

     console.log("question 1 ",a,n,x,y);
      
        return a;

    }
</script>


<script type="text/javascript">
   function decodeHTML(html) {
    var txt = document.createElement("textarea");
    txt.innerHTML = html;
    return txt.value;
}
</script>

<script type="text/javascript">
    function labelSquareSides(ptx,pty,letter)

    {

        ctx.font = "24px Arial";
        ctx.fillText(letter,ptx,pty);
    }
</script>


<script>
    function drawLine(ptx1,pty1,ptx2,pty2)
    {
        // Start a new Path
            ctx.beginPath();
            ctx.moveTo(ptx1, pty1);
            ctx.lineTo(ptx2, pty2);

            // Draw the Path
        ctx.stroke();
    }
</script>

<script>
    function drawSquare(ptx1,pty1,side)
    {

        ctx.beginPath();
        ctx.rect(ptx1, pty1, side, side);
        ctx.stroke();
    }

</script>


<script type="text/javascript">
    function writeText(ptx,pty,words)
    {
             ctx.font = "24px Arial";
        ctx.fillText(letter,ptx,pty);
    }
</script>



<script>

$(document).ready(function(){

question = '<?php echo $question; ?>' ;

var c = document.getElementById("myCanvas");
 ctx = c.getContext("2d");

 xmax = 600;
 ymax = 300;
 ctx.width  = xmax;
ctx.height =  ymax;
labels = ["A","B"];

startY = ymax - 50;  // 550
endY = ymax - 50;
drawLine(0,startY,xmax,endY);
sideA = 60;
sideB = 130;

startAX = sideA;
startAY = startY - sideA;  // 550 - 100 = 450
// (100,450)
// squares go downwards from (0,0)

startBX = startAX + sideA;   // 100 + 100 = 200
startBY = startY - sideB;  // 450 - 250 = 200
// (450,200)
ctx.font = "24px Arial";

drawSquare(startAX,startAY ,sideA);
drawSquare(startBX,startBY,sideB);


// label x 

labelSquareSides(startAX + sideA/2, ymax-20 , "x");  // base
labelSquareSides(startAX - sideA/4, startAY + sideA/2 , "x");  // left hand side

// label y

labelSquareSides(startBX + sideB/2, ymax-20 , "y");  // base 
labelSquareSides(startBX + sideB + 10, startBY + sideB/2 , "y");  // right hand side



answer = makeQuestion1() ;



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
        if (guess == answer)
        {
            alert("Correct");
            $('#solution' + qNumber).prop('disabled',true).css({"background-color":"lightgreen","color":"black"});
            $('#' + clicked).hide() ;
            points = 6 ;
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



