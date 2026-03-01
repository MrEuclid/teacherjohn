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
 <script src="https://cdnjs.com/libraries/mathjs"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/7.5.1/math.min.js"></script>

    
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

<title>star function</title>

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
    width: 8em;
    height: 3em;


}

[id^=equation] {
    font-weight: bolder;
    color: blue;
    font-size: 1.2em;
}

[id^=check] {
    font-weight: bold;
    margin-top: 0.75em;
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

    <h1>$ f(x,y) = x^2  + xy + y^2 $</h1>
    <h2>Solve these equations</h2>
 
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
</div></div>


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

 <div class = "col-3"> 
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

 <div class = "row justify-content-center">
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
</div></div>



</div>

</body>
</html>


<script type="text/javascript">
    
    function star(x,y)
    {
        let a = x*x + x*y + y*y;
        return a;
    }

</script>
<script type="text/javascript">
    
    function makeQuestion1()


    {
      let x = 0;
      let y = 0 ;

while (x == y)
        {
            x = randomInteger(1,10);
            y = randomInteger(1,10);
        }
        a = star(x,y);
       


       expr =  '$ f(' + x + ',' + y + ') = $ ' ;
         $('#equation1').html(expr);
         MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation1" ]);
      
        return a;
    }
</script>

<script type="text/javascript">
    
    function makeQuestion2()

    {
      let x = 0;
      let y = 0 ;

while (x == y)
        {
            x = randomInteger(-10,-1);
            y = randomInteger(1,10);
        }
        a = star(x,y);
       


       expr =  '$ f(' + x + ',' + y + ') = $ ' ;
         $('#equation2').html(expr);
         MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation2" ]);
      
        return a;
    }
</script>


<script type="text/javascript">
    
      function makeQuestion3(z1,z2)
 {
      let x = 0;
      let y = 0 ;

while (x == y)
        {
            x = randomInteger(6,10);
            y = randomInteger(2,5);
        }
        a = star(1/x,1/y);
       


       expr =  '$ f(' + '\\frac{1}{' + x + '},\\frac{1}{' + y + '}) =  (2dp) $ ' ;
         $('#equation3').html(expr);
         MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation3" ]);
      
        return round2DP(a);
    }
    
</script>


<script>

      function makeQuestion4(z1,z2)
// f(x,1) = n , x > 0 2dp

    {
         let n = randomInteger(5,25);

       expr =  '$ f(x,1) = ' + n + ' , x > 0 $ ' ;
       expr += "<br>" ;
       expr += '$ x = (2dp)  $ ' ;
         $('#equation4').html(expr);
         MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation4" ]);
      
      d = solveQuadratic(1,1,1-n);
      a = round2DP(d[1]);
        return a;



    }
</script>

<script>

      function makeQuestion5()
// z1^2 +  z2^2

    {
       
      a = 0;
        return a;



    }
</script>

<script type="text/javascript">
  
    $(document).ready(function(){

          question = '<?php echo $question; ?>' ;
  
    let a = randomInteger(2,10);
    let b = randomInteger(2,10);
    let c = randomInteger(2,10);
    let d = randomInteger(2,10);

    z1 = math.complex(a,b);
    z2 = math.complex(c,d);
    a1 = math.add(z1,z2);

   var expr = '$ z_1 = ' + a + '+' + b + 'i $' ;
        expr +=  " and " ;
        expr += '$ z_2 = ' + c + '+' + d + 'i $' ;

        $('#complexNumbers').html(expr);
    question = '<?php echo $question; ?>' ;
// points = question.substr(-1);
// calculate points on exit
// $('#cancel').text("Exit");

answer = [];

ans = makeQuestion1() ;
answer[1] = ans;

ans = makeQuestion2() ;
answer[2] = ans;

ans = makeQuestion3() ;
answer[3] = ans;

ans = makeQuestion4() ;
answer[4] = ans;

ans = makeQuestion5() ;
answer[5] = ans;
console.log(ans, answer)
correct = 0 ; // number correct;
points = 0 ;


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
        var theAnswer = answer[qNumber];
        console.log(guess,theAnswer);
        let z3 = math.complex(guess);
        let z4 = math.complex(theAnswer);
        if (JSON.stringify(z3) === JSON.stringify(z4))
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



