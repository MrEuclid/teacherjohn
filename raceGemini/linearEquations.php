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

<title>Linear equations</title>

<style>
<!--
[id^=solution]  {text-align: center;margin-bottom:1em;}
[id^=check] {margin-bottom:1em;}
[id^=equation] {margin-bottom:1em;}
-->
</style>


</head>
<body>

    <div class  = "container-fluid">


    <div class = "row">
      <div class = "col-sm-12 c">

 <h1>Find x</h1>
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

<!--
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

-->



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

function findQuadrupleQ2(limit) {

// 1/x + a/b  = c/d 
 //   p = b*d /(b*c - a*d)

let p = 1;
while (true) {
     const [a, b, c, d] = Array.from({ length: 4 }, () => Math.floor(Math.random() * limit) + 1);
      p = (b*d /(b*c - a*d));

    if 
        (
            (parseInt(p) == p) & 
            (a  < b) & 
            (c  < d) &
            (gcd(b*d ,(b*c - a*d))) == 1
        )
  {
    var data = [a,b,c,d,p];
   return data;
    break;
  }
}  // while



}  // function

</script>

<script type="text/javascript">
    
    function makeQuestion1()

    {

        data = findQuadruple(100);
        a = data[0];
        b = data[1];
        c = data[2];
        d = data[3];
        p = data[4];
        num = (d-c);
        den = (a-b)
        x = num/den;

console.log("q1",a,b,c,d,num,den,p);

 var expr = '$ ' + a + 'x + ' + c + ' = ' + b + 'x + ' +  d + ' $';
  //  var expr = '$ \\frac{' + a + '!' + '}{' + b + '!' + '} = $';
  $('#equation1').html(expr);
       MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation1" ]);

ans = x;
    return x;
    }

</script>

<script type="text/javascript">
    
    function makeQuestion2()

    {
// 1/x + a/b  = c/d 
var data = findQuadrupleQ2(20);
a = data[0];
b = data[1];
c = data[2];
d = data[3];
x = data[4];

       var expr = '$ \\frac{1}{x} + \\frac{' + a + '}{' + b + '}'  
                    + ' = \\frac{' +  c + '}{' + d + '} $';
    //  var expr = '$ \\sum_{i=1}^n a_i$';
    $('#equation2').html(expr);
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation2" ]);
        ans = x;
        return x;
    }
</script>


<script>

    function makeQuestion3()

   {
// x (x+1) = n
 x = randomInteger(5,15);
 let m = x*parseInt((x+1));
      var expr = '$ x(x+1) = ' + m + ' $' ;
    $('#equation3').html(expr);
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation3" ]);


        return x;

    }
</script>

<script type="text/javascript">
  
    $(document).ready(function(){
   
    question = '<?php echo $question; ?>' ;
// points = question.substr(-1);
// calculate points on exit
// $('#cancel').text("Exit");

answer = [];
points = 0;

answer[1] = makeQuestion1() ;
answer[2] = makeQuestion2() ;
answer[3] = makeQuestion3() ;
//answer[4] = makeQuestion4() ;

correct = 0 ; // number correct;
points = 0 ;

console.log("answers - all",answer);
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
            
            points = parseInt(qNumber) + parseInt(points);
            console.log("points", points,clicked,qNumber,total);
            if (points == 6)

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



