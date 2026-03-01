
<?php $question = $_POST['question']; ?>
<!DOCTYPE html>
<html>
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

<title>exponents</title>

<style>
.c {text-align: center; margin: auto;}
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
      <div class = "col- c">

<h1>Find the value x for each question.</h1>
  <h2 id = "equation"></h2>
  
</div></div>



 <div class = "row">
      <div class = "col- c">
    <div id = "ex1">
<label id = "equation1"></label>
<input id = "solution1">
<button id = "check1">Check 1</button>
</div>
</div></div>



 <div class = "row">
      <div class = "col- c">
    <div id = "ex2">
<label id = "equation2"></label>
<input id = "solution2">
<button id = "check2">Check 2</button>
</div>
</div></div>



 <div class = "row">
      <div class = "col- c">
    <div id = "ex3">
<label id = "equation3"></label>
<input id = "solution3">
<button id = "check3">Check 3</button>
</div>
</div></div>


 <div class = "row">
      <div class = "col- c">
    <div id = "ex4">
<label id = "equation4"></label>
<input id = "solution4">
<button id = "check4">Check 4</button>
</div>
</div></div>


</div>

</body>
</html>



<script type="text/javascript">


    function makeQuestion1()

    {
      // p + 2q + 3r = s
     
      let p = 0;
      let q = 0;
      let r = 0;

while (p == 0 | q == 0 | r == 0)
{
  p = randomInteger(2,5);
  q = randomInteger(2,5);
  r = randomInteger(2,5);
}
let s = 2**(p + 2*q + 3*r);
let x = parseInt(p + 2*q + 3*r);

expr = '$ 2^' + p + ' \\times  4^ ' + q + ' \\times  8^' + r  + '= 2^x , x = $';
$('#equation1').html(expr);
    MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation1" ]);
console.log("output1",expr,s);

      return x;
    }


</script>


<script type="text/javascript">


    function makeQuestion2()

    {
      // p + 2q + 3r = s
    
      let p = 0;
      let q = 0;
      let r = 0;

while (p == 0 | q == 0 | r == 0)
{
  p = randomInteger(2,5);
  q = randomInteger(2,5);
  r = randomInteger(2,5);
}
let s = 3**(p + 2*q + 3*r);
let x = parseInt(p + 2*q + 3*r);

expr = '$ 3^' + p + ' \\times  9^ ' + q + ' \\times  27^' + r  + '= 3^x , x = $';
$('#equation2').html(expr);
    MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation2" ]);
console.log("output2",expr,s);

      return x;
    }


</script>


<script type="text/javascript">


    function makeQuestion3()

    {
 
  p = randomInteger(5,12);

let s = 2**p;

expr = '$ 2^{5x}'  + ' \\times  2^{3x +1} ' + ' \\times  2^{2x} = ' + s + ' , x = $';
$('#equation3').html(expr);
    MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation3" ]);
console.log("output3",expr,s.n);

// 5x + 3x + 1 + 2x = s
x = (p-1)/10;
console.log("output3",expr,s.p,x);
      return x;
    }


</script>


<script type="text/javascript">


    function makeQuestion4()

    {
      // p + 2q + 3r = s
    

  p = randomInteger(5,12);

let s = 2**p;

expr = '$ \\frac{4^{2x+1}}{2^{3x-2}}  = ' + s + ' , x = $';
$('#equation4').html(expr);
    MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation4" ]);
console.log("output4",expr,s.n);

// 4x + 2 -3x + 2  = p
x = (p-4);
console.log("output4",expr,s.p,x);
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

answer[1] = makeQuestion1() ;
answer[2] = makeQuestion2() ;
answer[3] = makeQuestion3() ;
answer[4] = makeQuestion4() ;

correct = 0 ; // number correct;
points = 0 ;
//let x = Math.log(25**3*5**10*5**5)/Math.log(5);
// x = parseInt(x);
//y = Math.log2(4**3*2**10*2**5);
// alert(x + " " + y);



console.log(answer);
  })


</script>


<script>
      $(document).ready(function(){
    $('[id^=check]').on('click', function()


    {
        var clicked = this.id;
        var qNumber = clicked.slice(-1);
       // alert("Checking " + qNumber);
console.log("answers",answer);
        var guess = $('#solution' + qNumber).val() ;
        guess = round2DP(guess);
        if (guess == answer[qNumber])
        {
            alert("Correct");
            $('#solution' + qNumber).prop('disabled',true).css({"background-color":"lightgreen","color":"black"});
            $('#' + clicked).hide() ;
            points = points + 2 ;

            if (points == 8)

            {

                alert("You have answered the questions." );
alert("Processing win " + questionID + " with " + points + " pts");
processWin(questionID);
    console.log("processing ",questionID);

            }
        }

        else

        {
            alert("keep tryings")
        }
})
})

</script>
