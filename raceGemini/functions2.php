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

<title>Functions</title>

<style>

</style>


</head>
<body>

    <div class  = "container-fluid">


    <div class = "row">
      <div class = "col-sm-12 c">


    <h4>$ f(x) = 1 - \frac{1}{x^2} $</h4>
    <h4>$ g(x,y) = x^2- 2xy + y^2$</h4>
 
 <h1>Answer these questions</h1>
</div></div>


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


 <div class = "row justify-content-evenly">
      <div class = "col-3">
    <div id = "ex4"></div>
    </div>
    
 <div class = "col-3"> 
<label id = "equation4"></label>
</div>

<div class = "col-3">   
<input id = "solution4">
</div>

 <div class = "col-3"> 
<button id = "check4">Check 4</button>
</div>
</div>





</div>

</body>
</html>

<script type="text/javascript">
    
    function gcd(a, b) {
   
   a = Math.abs(a) ;
   b = Math.abs(b) ;

//alert('Now ' + a + ' ' + b);

    if (a == 0)
        return b;

    if (b == 0)
       return a ;  

    while (b != 0) 
    {
        if (a > b)
            a = a - b;
        else
            b = b - a;
    }

    return a;
}

</script>

<script type="text/javascript">
    

      function factorial(n) {

        var f = 1 ;
        for (var i = 1 ; i <= n ; i++)
            {f = f * i;}
  return f;
}
</script>

<script type="text/javascript">
    

      function randomInteger(min, max) { // min and max included 
  return Math.floor(Math.random() * (max - min + 1) + min);
}
</script>

<script>
function getVariables()

{

  valid = false ; 
  data = [] ;
  var n = 10;
  var r = 9;

while (n < r)
{
    n = randomInteger(2,n);
    r = randomInteger(1,n);
}
data[0] = n;
data[1] = r; 
return data;
}


</script>

<script type="text/javascript">
  
function gcd(a, b) {
    if (b) {
        return gcd(b, a % b);
    } else {
        return Math.abs(a);
    }
}

</script>

<script type="text/javascript">
    
    function makeQuestion1()
// f(1/2)

    {
       
        x = randomInteger(2,10)   ;
    
        var expr = "$ f(\\frac{-1}{" +  x + "}) = $";

        $('#equation1').html(expr);
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation1" ]);

        var answer = 1-x*x;
        console.log("q1 params",x,answer);
        return answer;
        
    }
</script>

<script type="text/javascript">
    
    function makeQuestion2()


    {
    
   // get two random numbers, a > b

    x = randomInteger(5,12);
    y = -x ;
var answer = parseInt(x*x - 2*x*y + y*y);

      var expr = ' $g(' + x + ',-' + x + ') = $';
     // var expr = '$ \\sum_{i=1}^n a_i$';


      $('#equation2').html(expr);
       MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation3" ]);
console.log("q2",x,y,answer);
console.log(expr);
      return answer;



    }
</script>


<script type="text/javascript">
    
    function makeQuestion3()


    {
// cubic x^2 
    
n = randomInteger(1,9);
var expr = "$ x^3 + " + n*n*n + ' = 0 , x = $ ';
var answer = -n ;
  $('#equation3').html(expr);
       MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation3" ]);
console.log(expr,n);
      return answer;




    }
</script>


<script>

    function makeQuestion4()

   
    {
// complex numbers x^2 + n^2 = 0, x = 
    
n = randomInteger(2,9);
var expr = "$ x^2 -" + n*n + ' = 0 , \\; x < 0 , \\, x = $ ';
var answer = -n ;
  $('#equation4').html(expr);
       MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation3" ]);
console.log(expr,n);
      return answer;




    }
</script>

<script type="text/javascript">
  
    $(document).ready(function(){
   
    question = '<?php echo $question; ?>' ;
// points = question.substr(-1);
// calculate points on exit
// $('#cancel').text("Exit");

answer = [];

answer[1] = makeQuestion1() ;
answer[2] = makeQuestion2() ;
answer[3] = makeQuestion3() ;
answer[4] = makeQuestion4() ;

correct = 0 ; // number correct;
points = 0 ;

console.log(answer);
  })


</script>








<script>
      $(document).ready(function(){
    $('[id^=check]').on('click', function()


    {
        var clicked = this.id;
        var qNumber = clicked.slice(-1);
      //  alert("Checking " + qNumber);

        var guess = $('#solution' + qNumber).val() ;
        if (guess == answer[qNumber])
        {
           // alert("Correct");
            $('#solution' + qNumber).prop('disabled',true).css({"background-color":"lightgreen","color":"black"});
            $('#' + clicked).hide() ;
            
            points = parseInt(qNumber) + parseInt(points);
            console.log("points", points,clicked,qNumber,total);
            if (points == 10)

            {

            //    alert("You have solved " + points/3 + " equations!");
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



