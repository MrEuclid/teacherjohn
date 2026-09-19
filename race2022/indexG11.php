<?php $grade = $_REQUEST['grade']; ?>

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



    <meta charset="utf-8">
    
    <meta name="description" content="">
    <meta name="keywords" content="">
<title>2022 Maths Competition</title>

<style type="text/css">

  #myTeam, #theTeam {text-align: center; background-color: lightblue; font-size: 1.2em; font-weight: bold; margin: 10px;}


[class$=easy] {background-image: linear-gradient(yellow, blue);}
[class$=medium]  {background-image: linear-gradient(blue, red);}
[class$=hard]  {background-image: linear-gradient(green,red);}
[class$=extreme]  {background-image: linear-gradient(orange, red);}

img {
                width:100%;
                height:100%;
                object-fit:cover;
            }

[id^=q]  {

    color:white; 
    font-weight:bolder ; 
    font-size:1em ; 
    border-radius: 24px;
    height: 120px;
    width: 120px;
    font-family: "Lucida Console", "Courier New", monospace;
    display: inline-block;
    margin: 1px;
    border-width: 1px;
    border-color: orange;
    background-color: blue;
  
    font-family: "Lucida Console", "Courier New", monospace;
    

 
     }

h1 {display: inline-block; font-size:2em; font-weight:bolder; color:green; text-align:center;}

p {display:inline-block;}

#instructions {display: inline-block; font-size:2em; font-weight:bolder; color:green; text-align:center;}

img { width: 180px; height: 120px; padding: 5px; }



#teamName {display: inline-block; color: black; font-size: 2em;font-weight: bolder; width: auto;}
#total,#timer {display: inline-block; background-color: blue; color: white; 
width: 4em; height: 3em;font-size: 1em;font-weight: bolder;
padding-bottom: 1em;
text-align:center;
}


#home,#cancel {display: inline-block; background-color: green; color: yellow;font-size:1em ; font-weight:bolder; width:5em;}

#expression{margin: 10px ;
            background-color: lightblue;
            color: black;
            text-align: center;
            font-weight: bolder;
            font-size: 1.2em;
            width:120px ;
            height:40px;
            }

            #ans {margin: 10px ;
            background-color: lightgreen;
            color: black;
            text-align: center;
            font-weight: bolder;
            font-size: 1.2em;
            width:240px ;
            height:40px;
            }
#casio {border-style: solid; color: green;}

  </style>

  </head>
  <body>
      <div class  = "container-fluid">
      
      <div class = "row">
        <div class = "col- c">
         


 <div id = "heading">
   <h1><img id = "pio1" src = "images/dragon1.jpeg" width = "auto" height = "auto">
Welcome to the Maths Competition 2023 - G11
   <img id = "pio2" src = "images/dragon2.png" width = "50px" height = "auto">
 </h1>
</div> <!-- heading -->
</div></div>
<div id = "loginBox">
<div class = "row">
  <div class = "col- c">
<label>Team name</label>
<input type = "text" id = "theTeam">
<button id = "login">Log in</button>
<a href = "../index.php"><button>Home</button></a>
  </div></div>

<div class = "row">
  <div class = "col- text-center">

<div id = "errorMessage"></div>
</div></div>

</div> <!-- title -->

<div class = "row">
  <div class = "col- ">

<div id = "stats">


    <div class = "row">
  <div class = "col- text-center">
  <a href="../index.php" >
       
 <button id = "home">Home</button>
     </a>
   
    
    <button id = "start">Start</button>

 <button id = "total" >0</button>
 <button id = 'timer'>
    0:00
</button>  
<button id = "cancel">Cancel</button>
</div></div>

</div>  <!-- stats -->
</div></div>

<div class = "row">
  <div class = "col- ">


<div id = "menu">
<div class = "row">
  <div class = "col-12 text-center">
<h1 id = "instructions">Choose your game</h1>
</div></div>

  <div class = "row">
  <div class = "col- text-center">
 
 

   <div class = "row">
  <div class = "col-12 text-center">
    <button  id = 'q16'>Add two Squares - 4</button> 
       <button  id = 'q5'>Sort the Fractions - 4</button>
         <button  id = 'q17'>Make a Colour-4</button> 
    <!--
    <button  id = 'q6'>Sort the surds - 8</button>
    -->
    <button  id = 'q7'>Make the Number - 8</button> 
    <!--
    <button  id = 'q8'>Add the fractions -7</button>
-->
</div></div>

  <div class = "row">
  <div class = "col-12 text-center">
    <button  id = 'q10'>Mastermind Hard - 8</button> 
    <button  id = 'q11'>Solve the equations - 7</button>
    <button  id = 'q15'>Factorise - 7</button> 
    <!--
      <button class = "hard" id = 'q8'>Add the fractions -7</button>
  -->
    <!--
    <button  id = 'q18'>Tigers game - 8</button> 
     -->
</div></div>

  <div class = "row">
  <div class = "col-12 text-center">

  
    <button  id = 'q2'>Egyption Fractions - 7</button>
    <button  id = 'q3'>Green light  axb + a + b- 6</button>
  
    
         <button  id = 'q20'>Find x Medium- 12</button> 
        
   

</div></div>



</div></div>

  <div class = "row">
  <div class = "col- text-center">

 </div></div>  
 <!--
    <button class = "hard" id = 'q6'>Sort the surds - 8</button>
    <button class = "hard" id = 'q7'>Make the Number - 8 </button> 
    <button class = "hard" id = 'q8'>Add the fractions -7</button>
    <button class = "hard" id = 'q10'>Mastermind Hard - 8 </button> 
    <button class = "hard" id = 'q11'>Solve the equations - 7</button>
    
    <button class = "hard" id = 'q15'>Factorise - 7</button> 

    <button class = "hard" id = 'q18'>Tigers game - 8</button> </div>
    <button class = "hard" id = 'q2'>Egyptiona Fractions - 7</button>
    <button class = "hard" id = 'q3'>Green light  axb + a + b- 6</button>
    <button class = "extreme" id = 'q20'>Seniors Find x - 12</button> 
  --> 

</div></div>

</div> <!-- menu -->


<div class = "row">
<div class = "col-sm-12 c">

  <div id = "play">Play</div>
</div></div>

<div class = "row">
<div class = "col- text-center">

<p id = "myTeam" ></p>
</div></div>


<div id = "casio">

   <div class = "row">
      <div class = "col-sm-12 c">
      
        <input type = "text" id = "expression">
        <button id = "calc" type="button" class="btn btn-success btn-sm">Calculate</button> 
        <input type = "text" id = "ans" readonly = "true">
      
    </div></div>
          </div>  <!-- casio -->

</div> <!-- container -->
  </body>
</html>


<script type="text/javascript">
  
    $(document).ready(function(){

      $('#menu').hide() ;
       $('#play').hide() ;
       $('#stats').hide();
       $('#casio').hide();

   //    $('#instructions').hide() ;
timed = 50*60 ;

grade = '<?php echo $grade; ?>' ;
// grade = "junior";

})
</script>


<script type="text/javascript">
  
    $(document).ready(function(){
    $('#login').on('click', function()

{
    var team = $('#theTeam').val() ;

if (team.length > 1)
 { var me = $('#theTeam').val();
  alert("Your are in team " + me);

$('#menu').show() ;
$('[id^=q]').prop('disabled',true);
 $('#loginBox').hide();
 $('#total').text('0');
 $('#stats').show();

 $('#instructions').text('Press the start button');
}

else

{
    alert('Please enter a team name!');
}

  })
  })


</script>

<script type="text/javascript">
  
    $(document).ready(function(){
    $('[id^=q]').on('click', function()
  {
$('#menu').hide() ;
    $('#play').show() ;
  $('#home').hide() ;
   // $('#title').hide();
    $('#heading').hide() ;
    var clicked = this.id;
    console.log("Clicked",clicked);
   qtn = $('#' + clicked).text();
    console.log("Clicked",clicked,qtn);

points = parseInt(qtn.substr(-1));
// alert(points);
    //questionID = clicked.substring(1,1);

    //questionID = parseInt(questionID);
   // alert("Clicked " + clicked);

    questionID = clicked;
 

  })
})
</script>


<script type="text/javascript">
  
    $(document).ready(function(){
    $('#q1').on('click', function()
  {


    var value = $('#q1').text();
    var value = "Open door 2"; 
   $('#play').load("openTheDoor.php",{question: value}) ;

  })
  })


</script>


<script type="text/javascript">
  
    $(document).ready(function(){
    $('#q2').on('click', function()
  {


    var value = $('#q2').text();
 //  alert("V2 " + value) ;
   $('#play').load("egyptianFractions.php",{question: value}) ;

  })
  })


</script>

<script type="text/javascript">
  
    $(document).ready(function(){
    $('#q3').on('click', function()
{
   
    var value = $('#q3').text();

   
   $('#play').load("greenLight.php",{question: value}) ;

 

  })
  })


</script>

<script type="text/javascript">
  
    $(document).ready(function(){
    $('#q4').on('click', function()


  {


  
    var value = $('#q4').text();
   $('#play').load("4color.php",{question: value});

  

  })
  })
</script>

<script type="text/javascript">
  
    $(document).ready(function(){
    $('#q5').on('click', function()


  {

    var value = $('#q5').text();

  
   $('#play').load("sortFractions.php",{question: value});

  })
  })
</script>

<script type="text/javascript">
  
    $(document).ready(function(){
    $('#q6').on('click', function()


  {

    var value = $('#q5').text();

   $('#play').load("sortTheSurds.php",{question: value});


  })
  })
</script>

<script type="text/javascript">
  
    $(document).ready(function(){
    $('#q7').on('click', function()


  {

 
    var value = $('#q7').text();
    alert("Value " + value) ;
   $('#play').load("countDownNumber.php",{question: value});

  })
  })
</script>

<script type="text/javascript">
  
    $(document).ready(function(){
    $('#q8').on('click', function()

  {

    var value = $('#q8').text();
   $('#play').load("make1.php",{question: value});

  })
  })
</script>

<script type="text/javascript">
  
    $(document).ready(function(){
    $('#q9').on('click', function()


  {

var value = $('#q9').text();

   $('#play').load("masterMindEasy.php",{question: value});

  })
  })


</script>

<script type="text/javascript">
  
    $(document).ready(function(){
    $('#q10').on('click', function()


  {


var value = $('#q10').text();
   $('#play').load("masterMindHard.php",{question: value});

  })
  })


</script>

<script type="text/javascript">
  
    $(document).ready(function(){
    $('#q11').on('click', function()


  {

var value = $('#q11').text();

   $('#play').load("triples.php",{question: value});

  })
  })


</script>

<script type="text/javascript">
  
    $(document).ready(function(){
    $('#q12').on('click', function()


  {


var value = $('#q12').text();
   $('#play').load("four_foursx.php",{question: value});

  })
  })


</script>


<script type="text/javascript">
  
    $(document).ready(function(){
    $('#q13').on('click', function()


  {

var value = $('#q13').text();
   $('#play').load("egyptianFractionsEasy.php",{question: value});

  })
  })


</script>


<script type="text/javascript">
  
    $(document).ready(function(){
    $('#q14').on('click', function()


  {


var value = $('#q14').text();
   $('#play').load("trianglePuzzle.php",{question: value});

  })
  })


</script>


<script type="text/javascript">
  
    $(document).ready(function(){
    $('#q15').on('click', function()


  {

var value = $('#q15').text();
   $('#play').load("factors.php",{question: value});

  })
  })


</script>


<script type="text/javascript">
  
    $(document).ready(function(){
    $('#q16').on('click', function()


  {

var value = $('#q16').text();
   $('#play').load("greenLightSquares.php",{question: value});

  })
  })


</script>


<script type="text/javascript">
  
    $(document).ready(function(){
    $('#q17').on('click', function()


  {

var value = $('#q17').text();
   $('#play').load("colourGame.php",{question: value});

  })
  })


</script>

<script type="text/javascript">
  
    $(document).ready(function(){
    $('#q18').on('click', function()


  {

var value = $('#q18').text();
   $('#play').load("tigers.php",{question: value});

  })
  })


</script>

<script type="text/javascript">
  
    $(document).ready(function(){
    $('#q19').on('click', function()


  {

var value = $('#q19').text();
   $('#play').load("6questionsJunior.php",{question: value});

  })
  })


</script>



<script type="text/javascript">
  
    $(document).ready(function(){
    $('#q20').on('click', function()


  {

var value = $('#q18').text();
   $('#play').load("6questionsSenior.php",{question: value});

  })
  })


</script>



<script>

function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.text(minutes + ":" + seconds);

        if (--timer < 0) {
            display.text('X' + ":" + 'X');
            $('#play').hide() ;
            $('#menu').hide() ;
            $('#home').show();


        }
    }, 1000);

    return;
}

</script>

<script>
$(document).ready(function(){
    $('#start').on('click', function(){

      $('#instructions').text('Choose your Game').show() ;

       // alert("Timer on") ;
   
        $('#start').hide() ;
        $('#score').show() ;
        $('#menu').show() ;
        $('#home').hide() ;
        $('#casio').show();
       
        $('[id^=q]').prop('disabled',false);

        jQuery(function ($) {
            var fiveMinutes = timed,
                display = $('#timer');
            startTimer(fiveMinutes, display);
        });      
    })
    })
        </script>

<script type="text/javascript">
  
    $(document).ready(function(){
    $('#cancel').on('click', function()

{
  console.log("Cancel");
  $('#home').show();
 $('#menu').show() ;
 $('#title').hide();
 $('#stats').show() ;
 $('#play').hide().empty();



  })
  })


</script>

<script>
function remove_linebreaks(str) {
    return str.replace( /[\r\n]+/gm, "" );
}
  </script>

<script type="text/javascript">
  
    $(document).ready(function(){
    $('#login').on('click', function()

{

 team = $('#theTeam').val() ;
 team = team.trim() ;
 if (team.length > 0)
 {
// alert("Logging in as " + team);
    $.ajax({
        url: 'loadTeam.php', // to be done
        type: 'POST',
        data: {team:team,grade:grade}, 
        datatype: 'text',
        
    })  // parameters
    .done(function (response) { 


console.log("Response",response);
      var code = response.split("*");
console.log("response",response) ;
  
 code[0] = remove_linebreaks(code[0]) ;
      console.log(code);
    
// alert(code[0] + ' get ready to play! ' + code[2] + 'id ' + code[1]);
console.log("Code",code);

if (grade == 'senior') 
{
    $('.easy').hide() ; // hide the easy ones ;
}

if (grade == 'junior') 
{
    $('.hard').hide() ; // hide the easy ones ;
}

team = grade + "*" + code[0] + "*" +  code[2]; // grade + team + number of times used
//alert(team);
$('#myTeam').text(team) ;
   
    })  //done
    .fail(function (jqXHR, textStatus, errorThrown) { 
    alert("Failure " + jqXHR + ' ' + textStatus + ' error ' + errorThrown) ;
    
    })  // fail

}

  })
  })


</script>

<script>
function updateDatabase(teamName,score,timer,question,grade,questionID)



{


 $.ajax({
        url: 'updateScores.php', // to be done
        type: 'POST',
        data: {teamName:teamName,score:score,timer:timer,question:question,grade:grade, questionID:questionID}, 
        datatype: 'text',
        
    })  // parameters
    .done(function (response) { 

      alert("Database updated " + teamName + " " + score + " " + timer + " " + question + " " + grade + " " + questionID);
console.log("Response to update",response);
  
   
    })  //done
    .fail(function (jqXHR, textStatus, errorThrown) { 
    alert("Failure " + jqXHR + ' ' + textStatus + ' error ' + errorThrown) ;
    
    })  // fail
  

}

  </script>

  <script>

function processWin(q)  // for question id q

{


// alert("Using " +points);
 var pts = parseInt($('#total').text());
  
     points = parseInt(points) ;
     console.log("points",pts);
     pts = parseInt(pts + points);
     console.log("points",pts);
     $('#total').text(pts);

    $('#menu').show();

     $('#play').empty().show();
     $('#' + q).prop('disabled',true).css({"background-color":"blue","color":"yellow"});

     var t = team.split("*");
    var teamName = t[1];
    var grade = t[0] ;
    var score = $('#total').text() ;
    var timer = $('#timer').text() ;

     console.log("output",teamName,score,timer,grade,question,questionID);
    updateDatabase(teamName,score,timer,question,grade,questionID);


}

  </script>

  <script>
function calculate(){
  //  "use strict";
    var s= prompt('Enter problem');
    if(/[^0-9()*+\/ .-]+/.test(s)) throw Error('bad input...');
    try{
        var ans= eval(s);
    }
    catch(er){
        alert(er.message);
    }
    alert(ans);
}
</script>

  <script>
   $(document).ready(function () {
    $('#calc').on('click', function(){
// calculate();
var expr = $('#expression').val() ;

 $.ajax({
    dataType: 'text',
    type: 'post',
    async: false,
    url: 'evaluate.php',
    data: {expr:expr},
    
    success: function(response){

    console.log(response);
    $('#ans').val(response) ;
    $('#expression').val('') ;
    alert(response) ;

        }, // success

      error: function(xhr, textStatus, errorThrown){
                        alert('request student data failed');
                          $('#errorMessage').text(response) ;
                      } // failure
                }); //ajax



    })

    })

  </script>





