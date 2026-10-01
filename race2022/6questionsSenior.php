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

<title>6 Questions Junior</title>

<style>







h1 {
font-weight: bolder; 
   font-size: 24pt; 
   
   color:green;
}

h2 {
font-weight: bolder; 
   font-size: 20pt; 
   
   color:blue;

}

h3 {
font-weight: bolder; 
   font-size: 16pt; 
   
   color:green;
}

h4 {
font-weight: bold; 
   font-size: 14pt; 
   
   color:orange;
}



p {
font-weight: bold;
font-style: italic;
font-size: medium;
}


#message {font-size: 10pt ; font-style: italic;color: black ; text-align: justify;}

#answer {
            text-align: center;
            background-color: lightblue;
            font-size: 1.2em;
            font-weight: bolder;
}


h4 {
            text-align: center;
            
            font-size: 1.2em;
            font-weight: bold;
            color: black;
}

input {
    display: inline-block; 
    background-color: lightyellow; 
    text-align: center; 
    font-size: 1.2em; 
    font-weight: bolder;
    margin: 10px;
    width: 4em;
    height: 3em;


}

[id^=equation] {
    font-weight: bolder;
    color: black;
    font-size: 1.2em;
}


</style>


</head>
<body>

    <div class  = "container-fluid">

        <div class = "row">
            <div class = "col-sm-12 c">
                <p id = "stars"></p>
                </div></div>

    <div class = "row">
      <div class = "col-sm-12 c">

    <h1>Solve these Equations</h1>

    <h4>There are 3 marks for each question.</h4>
    <h4>You must answer all the questions!</h4>

    
  
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

<script>
function getVariables()

{

  valid = false ; 
  data = [] ;

  var a = 10;
  var b = 99;

    data[0] = randomInteger(a,b);
    data[1] = randomInteger(a,b);
    data[2] = randomInteger(a,b);

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
// x^2(x+1) = x^3 + x^2

    {
        var a = 0 ;
        a = randomInteger(3,10)   ;
        sum = a*a*a + a*a ;
        console.log(a,sum);
        var expr = '$ x^2(x+1) $' + ' = ' + sum + ' , $x = $';

        $('#equation1').html(expr);
         MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation1" ]);

        return a;
    }
</script>

<script type="text/javascript">
    
    function makeQuestion2()


    {
     //  arithmetic sequence using sigma notation

//     \sum_{i=1}^n a_i

 //    \displaystyle\\sum_{i=1}^n a_i

     var a = 0 ;
       
     var   upperLimit  = randomInteger(3,9)   ;
     var   lowerLimit = 1 ;

     var a = 0 ;
     var d = 0  ;    

     while (a == d) {
     a = randomInteger(2,5) ;
     d = randomInteger(5,10);
     var n = upperLimit ;
        }

     var sum = (n/2)*(2*a + (n-1)*d);

   

      console.log("a d n sum",a,d,n,sum);

   

      var first = parseInt(a - d);

      var expr = '$ \\sum_{i=1}^' + n + ' (' + first + '+'  + d + 'i)$' + ' = ';
     // var expr = '$ \\sum_{i=1}^n a_i$';


      $('#equation2').html(expr);
       MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation2" ]);



      return sum;



    }
</script>


<script type="text/javascript">
    
    function makeQuestion3()


    {

      
    
     //  geometric sequenc  using sigma notation

//     \sum_{i=1}^n a_i

 //    \displaystyle\\sum_{i=1}^n a_i

     var a = 0 ;
       
     var   upperLimit  = randomInteger(2,5)   ;
     var   lowerLimit = 1 ;
     var a = randomInteger(2,10) ;
     var r = randomInteger(2,5);
     var n = upperLimit ;
  var a1 = a*r ;
     var sum = (a1)*(Math.pow(r,n) - 1) / (r - 1);

   

      console.log("a1 r n sum",a1,r,n,sum);

   

      var first = a;

      var expr = '$ \\sum_{i=1}^' + n + ' (' + a + '\\times' + r + '^i)$' + ' = ';
     // var expr = '$ \\sum_{i=1}^n a_i$';


      $('#equation3').html(expr);
       MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation3" ]);



      return sum;



    }
</script>


<script>

    function makeQuestion4()


    {

     // TRIANGULAR NUMBERS, GIVEN S FIND n

       var n = randomInteger(20,50) ;

       var s = +(n/2)*(n+1);

       console.log(n,s);

       var term = '$ \\frac{x}{2} (x +1) = ' + s + ' , x > 0, x =  $' ;
       
     

        $('#equation4').html(term);
         MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation4" ]);

     
      
        return n;


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
        alert("Checking " + qNumber);

        var guess = $('#solution' + qNumber).val() ;
        if (guess == answer[qNumber])
        {
            alert("Correct");
            $('#solution' + qNumber).prop('disabled',true).css({"background-color":"lightgreen","color":"black"});
            $('#' + clicked).hide() ;
            points = points + 3 ;

            if (points == 12)

            {

                alert("You have solved " + points/3 + " equations!");
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



