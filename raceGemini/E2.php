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

<title>Find x,y</title>

<style>

input {
    text-align: center; 
    background-color: lightyellow; 
    color: black; 
    font-size: 1.2em;
    font-weight: bold;
    height:40px;
    margin:5px;
    width:5em; }
label {font-weight: bolder; font-size: 2em; margin: 1em;}
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

    <h1>Find the numbers x and y</h1>
    <h3>x and y are whole numbers. x > 0</h3>
  
</div></div>


 <div class = "row">
      <div class = "col- c">

<p id = "equations"></p>

</div></div>


 <div class = "row">
      <div class = "col- 12 c">

        <label>x  = </label><input id = "answerx">
         <label>y  = </label><input id = "answery">
         <button id = "check" >Check</button>

</div></div>


</div>

</body>
</html>

<script type="text/javascript">
    

      function randomInteger(min, max) { // min and max included 
  return Math.floor(Math.random() * (max - min + 1) + min);
}
</script>


<script type="text/javascript">
    

    function makeEquations()

   {
let x = 0;
let y = 0;
while (parseInt(x + y)  <= 0 )
{
    x = randomInteger(10,20);
    y = randomInteger(1,20);
}
let z1 = x*y ;
let z2 = parseInt(x - y);
var expr = '$ x' + ' - '  + 'y = ' +  z2 +  '$';
expr += '<br>';
expr += '$ xy = ' + z1 + '$'
expr += '<br>';
expr += '$ x + y > 0  ' + '$' ;
  $('#equations').html(expr);
       MathJax.Hub.Queue(["Typeset", MathJax.Hub, "equations" ]);
console.log(expr,x,y,z1,z2);



answer = [x,y];
console.log(answer);
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

answers = makeEquations();
x = answers[0];
y = answers[1];


console.log(answer);
  })


</script>




<script type="text/javascript">
  
    $(document).ready(function(){
    $('#check').on('click', function()
    {

var answerx = parseInt($('#answerx').val()) ;
var answery = parseInt($('#answery').val()) ;
//alert(answer) ;
if (answerx == x & answery == y)
{


      $('#playingArea').hide();
      $('#numPad').hide() ;
      $('#send').hide();
      $('#clear').hide();

// alert("You found the numbers");
// processWin(questionID);
    
     $('#play').empty().show();
 //    $('#q15').prop('disabled',true).css({"background-color":"blue","color":"yellow"});
     
processWin(questionID);
   console.log("processing ",questionID);


    
  

}

else 
{
    alert('Keep trying!');
}
  


  })
  })


</script>



