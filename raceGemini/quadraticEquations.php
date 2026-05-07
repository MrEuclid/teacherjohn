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
<link rel="stylesheet" href="../race2024.css">

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

<title>Quadratics</title>

<style>

[id^=solution]  {text-align: center;margin-bottom:1em;}
[id^=check] {margin-bottom:1em;}
[id^=equation] {margin-bottom:1em;}

</style>


</head>
<body>

    <div class  = "container-fluid">


    <div class = "row">
      <div class = "col-sm-12 c">

 <h1>Each equation has 2 answers.</h1>
 <h3>Find the &nbsp; <strong>bigger</strong> &nbsp; answer.</h3>
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
    

      function randomInteger(min, max) { // min and max included 
  return Math.floor(Math.random() * (max - min + 1) + min);
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
    


function findDouble(limit) {


// equation 2 
    // ab / (a-b)
let p = 1;
while (true) {
  const [a, b] = Array.from({ length: 4 }, () => Math.floor(Math.random() * limit) + 1);
   p = (a*b) / (a - b);
 //  console.log(a,b,c,d,p);
 // if (gcd(d - c, a - b) === 1) 
   if 
    (
    (parseInt(p) == p) & 
    (a  != b ) & 
    (gcd(a*b,(a-b)) == 1)
     )
  {
    var data = [a,b,p];
   return data;
    break;
  }
}



}

</script>

<script type="text/javascript">
    


function findQuadruple(limit) {

let p = 1;
while (true) {
  const [a, b, c, d] = Array.from({ length: 4 }, () => Math.floor(Math.random() * limit) + 1);
   p = (d-c) / (a - b);
 //  console.log(a,b,c,d,p);
 // if (gcd(d - c, a - b) === 1) 
   if 
    (
    (parseInt(p) == p) & 
    (a + 10 > b) & 
     (c + 10 > 10)
     )
  {
    var data = [a,b,c,d,p];
   return data;
    break;
  }
}



}

</script>

<script type="text/javascript">

function findQuadrupleQ3(limit) {

// matrix inverse


let p = 1;
let x = 0 ;
let y = 0 ;
let delta = 0;
while (true) {
     const [a, b, c, d,e,f] = Array.from({ length: 6 }, () => Math.floor(Math.random() * limit) + 1);
     delta = a*d - b*c ;
     x = (d*e - b*f)/delta;
     y = (-c*e + a*f)/ delta
    if 
        (
            (parseInt(x) == x) & 
            (parseInt(y) == y) & 
            (b > 0) &
            (d > 0) &
            (a != c) &
            (b != d) &
            (x*y != 0) &
            (delta != 0) 
        )
  {
    var data = [a,b,c,d,e,f,x,y];
   return data;
    break;
  }
}  // while



}  // function

</script>


<script type="text/javascript">

function makeQuadratic(limit) {

// ax^2 + bx + c = 0 , x^2 + b/ax + c/a = 0
    // a,b,c > 0


let delta = 0 ;
while (true) {
     const [b, c] = Array.from({ length: 2 }, () => Math.floor(Math.random() * limit) + 1);
      a = randomInteger(2,5);
      delta = b*b - 4*a*c;
      root = Math.sqrt(delta);
      x1 = (-b - root) / (2*a);
      x2 = (-b + root) / (2*a);

    if 
        (
            (parseInt(root) == root) & 
            (parseInt(x1) == x1) & 
            (parseInt(x2) == x2) & 
           // gcd(a,b) == 1 &
           // gcd(a,c) == 1 &
            (delta != 0 ) 
        )
  {

    var data = [a,b,c,delta,x1,x2];
   return data;
    break;
  }
}  // while



}  // function

</script>

<script type="text/javascript">
    
    function makeQuestion1()

    {

let n = randomInteger(15,25);
let m = n*n;

 var expr = '$ x^2 - ' + m + ' = 0 $'; // + n^2  + ' = 0  $';
  $('#equation1').html(expr);
       MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation1" ]);
console.log("data1",n,m,expr);
ans = n;
    return ans;
    }

</script>

<script type="text/javascript">
    
    function makeQuestion2()

    {
// x^2 +/- bx +/- c = 0
 let  x1 = 0;
 let  x2 = 0; 
while (x1*x2 ==0 | x1 == x2) 
{
    x1 = randomInteger(-20,20);
    x2 = randomInteger(-20,20);
}
let b = +x1+x2;
let c = x1*x2;
// allow for negative coefficients
let linear = 'bx';
let cnst = 'c';
if (b < 0) {linear =  b;} 
if (b == 1) {linear = "";}
if (b > 1 ) {linear = '+' + b;}
if (c < 0) {cnst = c;} else {cnst = '+' + c;}
x1 = -x1;
x2 = -x2;
       var expr = '$ x^2 ' + linear + 'x' + cnst + '= 0 $';
    //  var expr = '$ \\sum_{i=1}^n a_i$';
    $('#equation2').html(expr);
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation2" ]);
   if  (x2 >= x1){ans = x2;}   else {ans = x1;} 

   console.log("q2",b,c,expr,x1,x2,ans) ;
        return ans;
    }
</script>


<script type="text/javascript">
    
    function makeQuestion3()


    {
// factor 1 = ax + n, factor 2 = x-m, the larger factor.
// (ax + n)(x-m) =  ax^2 + x(n -am) -nm
//b = n -am, c = -nm
// checj gcd (a,b) = 1 and gcd(a,c) = 1
// var data = makeQuadratic(50);
//   var data = [a,b,c,delta,x1,x2];
let a = 4;
let b = 2;
let c = 6;

//while (b != 0)
//{
    a = randomInteger(2,5);
    m = randomInteger(2,10);
    n = randomInteger(5,20);
    b =  n - a*m;
    c =  -n*m ;
//}
console.log(a,m,n,b,c);

let x1 = -n/a
let x2 = m;

let linear = 'bx';
let cnst = 'c';
if (b < 0) {linear =  b;} 
if (b == 1) {linear = "+";}
if (b > 1 ){linear = '+' + b;}
if (b == 0){linear = '0';}

if (c < 0) {cnst = c;} else {cnst = '+' + c;}
var expr = '$ ' + a + 'x^2 ' + linear + ' x ' + cnst + '= 0 $';
    //  var expr = '$ \\sum_{i=1}^n a_i$';
    $('#equation3').html(expr);
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation3" ]);
   if  (x2 >= x1){ans = x2;}   else {ans = x1;} 

   console.log("q3",a,b,c,expr,x1,x2,ans) ;
        return ans;
    }
</script>


<script>

    function makeQuestion4()

   {
// same as 2 but in the format x^2 = bx + c
    // x^2 +/- bx +/- c = 0
 let  x1 = 0;
 let  x2 = 0; 
while (x1*x2 ==0 | x1 == x2) 
{
    x1 = randomInteger(-10,10);
    x2 = randomInteger(-10,10);
}

let b = +x1+x2;
let c = x1*x2;

// allow for negative coefficients
let linear = 'bx';
let cnst = 'c';
if (b < 0) {linear =  b;} // b neg becomes pos
// if (b == 1) {linear = "-";}  
if (b >= 1 ) {linear = '-' + b;}
if (c > 0) {cnst = -c ;} else {cnst = '+' + c;} 
x1 = -x1;
x2 = -x2;
       var expr = '$ x^2 ' + linear + 'x' + cnst + '= 0 $';
       var expr = '$ x^2 ' + ' = ' + linear +  'x' + cnst + ' $';
    //  var expr = '$ \\sum_{i=1}^n a_i$';
    $('#equation4').html(expr);
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation4" ]);
   if  (x2 >= x1){ans = x2;}   else {ans = x1;} 

   console.log("q4",b,c,expr,x1,x2,ans) ;
        return ans;

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
//answer[4] = makeQuestion4() ;

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

        var guess1 = $('#solution' + qNumber).val() ;

        if (qNumber == 3)
            {
                guess = parseFloat(guess1);
                guess = +guess.toFixed(2);  // + to change from string to number
             //   alert(guess + ' ' + guess1);
                $('#solution3').text(guess);
    }
    else {guess = guess1;}
        if (guess == answer[qNumber])
        {
           // alert("Correct");
            $('#solution' + qNumber).prop('disabled',true).css({"background-color":"lightgreen","color":"black"});
            $('#' + clicked).hide() ;
            
            points = parseInt(points + 3);
            console.log("points", points,clicked,qNumber,total);
            if (points == 9)

            {

            //    alert("You have solved " + points/3 + " equations!");
// alert("Processing win " + questionID + " with " + points + " pts");
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



