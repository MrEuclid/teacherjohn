<?php 
 
$question = isset($_POST['question']) ? $_POST['question'] : 'Delta Challenge';

?>

<!DOCTYPE html>
<html lang="en">

  <head>
 
 
 
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.com/libraries/mathjs"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/7.5.1/math.min.js"></script>

 <link rel="stylesheet" href="raceGeminiStyles.css">

<script src="javascript/utilities.js"></script>

<title>Delta</title>

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
   
   color:blue;
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



[id^=equation] {
    font-weight: bolder;
    color: black;
    font-size: 1.2em;
}

p.parameter  {
    display: inline-block;
    color: blue;
    font-size: 1em;
    font-weight: bolder;

}


</style>


</head>
<body>

    <div class  = "container-fluid">

    <div class = "row">
      <div class = "col-12 text-center">

    <h1> $ a \Delta  b =  ab + a - b $ </h1>

    <h3>
        a = <p class = "parameter" id = "a"></p>,
        b = <p class = "parameter" id = "b"></p>,
      
    </h3>   
  
</div></div>


<?php include "answerBootstrap4.html"; ?>


</div>

</body>
</html>

<script>
// 1. GLOBAL VARIABLES (Must be defined cleanly)
var answer = [];
var correct = 0;
var points = 0;
// Global variables for canvas

</script>

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
    
    function delta(a,b)
    {
        let d = parseInt(a*b + (a - b));
        console.log(a,b,d);
        return d;
    }
</script>



<script type="text/javascript">
    
    function makeQuestion1(a,b)


    {

        expr = '$ a \\Delta b  =  $';
        $('#equation1').html(expr);
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation1" ]);

        console.log("q1",a,b,delta(a,b));
        return delta(a,b) ;
    }
</script>

<script type="text/javascript">
    
    function makeQuestion2(a,b)


    {

       
        expr = '$ b \\Delta a =  $';
        $('#equation2').html(expr);
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation2" ]);

        console.log("q2",a,b,delta(b,a));
        return delta(b,a)

    }
</script>


<script type="text/javascript">
    
    function makeQuestion3()


    {
        

        expr = '$ a \\Delta a  - b \\Delta b =  $';
        $('#equation3').html(expr);
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation3" ]);

        console.log("q2",a,b,delta(b,a));
        return delta(a,a) - delta(b,b);
    }
</script>


<script>

    function makeQuestion4(a)


    {
        let m = 2*a;
        while ((m - a) /  (a-1) != parseInt((m - a) /  (a-1)))
        {
            m++;
        }
     
        expr = '$ a \\Delta p =  ' + m + ', p =  $';
        $('#equation4').html(expr);
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equation4" ]);

        console.log("q4",a,m-a, a-1, (m -a) / (a - 1));
        return (m -a) / (a - 1) ;
    }
</script>



<script>
// 1. GLOBAL VARIABLES (Must be defined cleanly)
var answer = [];
var correct = 0;
var points = 0;
// Global variables for canvas

</script>

<script type="text/javascript">
  
    $(document).ready(function(){
   
    question = '<?php echo $question; ?>' ;
// points = question.substr(-1);
// calculate points on exit
// $('#cancel').text("Exit");



a = randomInteger(2,10);
b = randomInteger(2,10);
c = randomInteger(2,20);
d = randomInteger(2,10);


answer[1] = makeQuestion1(a,b) ;
answer[2] = makeQuestion2(a,b,c,d) ;
answer[3] = makeQuestion3(a,b,c,d) ;
answer[4] = makeQuestion4(a,b,c,d) ;


  console.log(answer);

// get values of a,b,c,d - global

$('#a').text(a);
$('#b').text(b);
$('#c').text(c);
$('#d').text(d);

checkAnswer(4);

  })


</script>


