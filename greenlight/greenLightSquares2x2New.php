<!DOCTYPE html>
<html lang="en">
  <head>

  <title>greenLight game sum of squares 2 x 2</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- bootstrap loaded from server for intranet for better loading speed -->
 <link rel="stylesheet" href="javaScript/bootStrap/bootstrap-3.3.7-dist/css/bootstrap.min.css">
  <script src="javaScript/jQuery/jquery-3.3.1.min.js"></script>
  <script src="javaScript/bootStrap/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

<!-- need this to move the sentence parts in a vertical sortable list -->

  <script src="javaScript/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
  <script src="javaScript/touchPunch/punch.js"></script> 
  

  <script src = "javaScript/functionMakePrimes.js"></script>
  <script src = "javaScript/greenLightGame/functionMakePrimes.js"></script>
  <script src = "javaScript/greenLightGame/functionLevelFinished.js"></script>
  <script src = "javaScript/greenLightGame/clearGrid.js"></script>  
     <script src = "javaScript/keyboardClick.js"></script>   


  <link rel = "stylesheet" href  = "css/pioStudentsStyles.css">


<style type="text/css">
  #total {text-align: center; width:120px;}


  [id^=key-] {height: 6x0px ; width: 60px ; font-size: 1em ; margin-top: 10px ;margin-left: 10px ; margin-bottom: 10px ; margin-right: 10px}
</style>

<style type="text/css">
  #theSquares {font-size: 10pt ; color: blue ;}
</style>

</head>
  <body>

    <div class = "container h-100">

<div class = "row align-items-center h-100">
     <div class="col-sm-12 c">
<h1>Make the lights green</h1>
</div></div>
<input type = "text" hidden = "true" id = "level"> <!-- record level -->
<input type = "text" hidden = "true" id = "total"> <!-- record total -->
<?php $op = 'a<sup>2</sup>+b<sup>2</sup>' ; ?>
<div id = "grid">

  <?php include "includes/grid2x2.php" ; ?>
</div> <!-- grid -->

<div id = "options">
<div class = "row align-items-center h-100 c">
     <div class="col-sm-12 c">
      <button id = "level1" class="btn btn-info rectangle" >Level 1</button>
      <button id = "level2" class="btn btn-success rectangle" >Level 2</button>
      <button id = "level3" class="btn btn-primary rectangle" >Level 3</button>
        <a href = "indexNewMaths.php"> <button id = "end" class="btn btn-default rectangle" >Home</button></a>
      </div></div>
</div>

<div id = "scoreBoard">
<div class = "row align-items-center h-100 c">
     <div class="col-sm-12 c">
<p class = "c" id = "score"></p>
    </div></div>
</div> <!-- scoreboard -->


<div class = "row align-items-center h-100 c">
     <div class="col-sm-12 c">
 <p>
 <div  id = "message" >
  <ul>
 <li>Put numbers in each row so that the squares of the numbers add to make the number at the end of the row.</li>
 <li>Put numbers in each column so that the squares of the numbers add to make the number at the top of the column.</li>
 <li> Use the ? button to check you answer.</li>
 <li>Choose a level to get started.</li>
</ul>
</p>
</div> <!-- message -->
<div id = "example">
<?php // include  "includes/exampleSquares.html" ; ?>
</div> <!-- example -->


    </div></div>
<?php include "includes/keyboard.html" ; ?>
<div class = "row align-items-center h-100 c">
     <div class="col-sm-12 c">
      <div id = "theSquares">
      <?php 
for ($i = 1 ; $i <= 32 ; $i++)

{
 echo $i*$i . " " ;
}
      ?>
  </div>
</div></div>

<div class = "row align-items-center h-100 c">
     <div class="col-sm-12 c">
 <button id = "help" class="btn btn-info rectangle" >Answers</button>
    </div></div>

    <div class = "row align-items-center h-100 c">
     <div class="col-sm-12 c">
 <p id = "listCalculations" ></p></button>
    </div></div>

</div> <!-- container -->


</body>
</html>


  <script>
    



   $(document).ready(function(){

total  = 0 ;
$('#total').text(total);

focused = "";
total = 0 ;
keys = [7,8,9,4,5,6,1,2,3,0,"C","AC"] ;


  finished = false ;  // flag for when level is completed

  $('#grid').show() ;
  $('#help').show() ;
  $('#scoreboard').hide() ;
  $('[id^=key-]').hide() ;
  $('[id^=addend]').attr("readonly" ,true).hide();
  $('[id^=addend]').css({"background-color":"lightblue" ,"font-size":"1.5em","font-weight":"bolder"});

})
 </script>


<script type="text/javascript">

$(document).ready(function(){

    $("[id^=addend]").click(function(){
      focused = $(this).attr("id");  // gets id of focused element
   //  alert('input clicked = ' + focused);

  

})
})

  </script>  

<script type="text/javascript">
  
// some initialisation
p = [] ; // stores prime numbers

p = makeprimes(1000) ;

  finished = false ;  // flag for when level is completed

  $('#grid').show() ;
  $('#help').hide() ;
  $('#scoreboard').hide() ;

</script>

<script type="text/javascript">
  
// some initialisation


$('#level').val(0) ;
$('#total').val(0) ;

  finished = false ;  // flag for when level is completed

  $('#grid').show() ;
  $('#help').hide() ;
  $('#scoreboard').hide() ;

</script>




<script type="text/javascript">
  
   $(document).ready(function(){

    $('[id^=level]').on('click', function()
  {

// respond when a level button is clicked

$('[id^=addend]').show() ;
$('[id^=key-]').show() ;

var levelID = this.id ;
var level =  levelID.substring(5, 6);  // parse to get last digit = the playing level
level = parseInt(level);
$('#level').val(level);
$('#example').hide() ;
$('#grid').show() ;
$('#go').hide() ;
$('#newGame').hide() ;
$('#clear').show() ;
$('#options').hide() ;
$('#help').show() ;
$('#listCalculations').hide() ;
$('#message').hide()  ;
$('#scoreboard').show() ;
$('#score').show() ;






//  $('[id^=light').css("background-color","red" ); // ipad didn't like this here ?????

 // alert('check if here ');
$('#check').text('?') ;
$('.operand').val('') ;



var levelID = this.id ;
var level =  levelID.substring(5, 6);
level = parseInt(level) ;
// alert('Level = ' + level) ;

var lowerLimit = 1 ;

if (level == 1)
{var upperLimit = 10;
lowerLimit = 1}

if (level == 2)
{var upperLimit = 20;
lowerLimit = 5 ;}

if (level == 3)
{var upperLimit = 30;
     lowerLimit = 10}




// get random prime numbers in a range based on the selected level

var a = Math.floor((Math.random() * upperLimit) + lowerLimit); 
var b = Math.floor((Math.random() * upperLimit) + lowerLimit); 
var c = Math.floor((Math.random() * upperLimit) + lowerLimit); 
var d = Math.floor((Math.random() * upperLimit) + lowerLimit); 


// row and column products 

t1 = a*a + c*c  ;
t2 = b*b + d*d  ;
t3 = a*a + b*b  ;
t4 = c*c + d*d  ;


// put the numbers in the red lights

$('#light1').text(t1);
$('#light7').text(t1);

$('#light2').text(t2);
$('#light8').text(t2);

$('#light3').text(t3);
$('#light4').text(t3);

$('#light5').text(t4);
$('#light6').text(t4);


 // set colour of lights to red

  $('[id^=light').css("background-color","red" );

     }) ;

  })
    
</script>




<script type="text/javascript">
  
  function showCalculations() 

  {

a = parseInt($('#addend1').val()) ;
b = parseInt($('#addend2').val()) ;
c = parseInt($('#addend3').val()) ;
d = parseInt($('#addend4').val()) ;

if (isNaN(a)) {a = 0 ;}
if (isNaN(b)) {b = 0 ;}
if (isNaN(c)) {c = 0 ;}
if (isNaN(d)) {d = 0 ;}

$('#listCalculations').empty() ;
$('#listCalculations').show() ;

var answerC1 = a*a + c*c  ;
var answerC2 = b*b + d*d  ;
var answerR1 = a*a + b*b  ;
var answerR2 = c*c + d*d  ;

// answer = parseInt(answer) ;
$('#listCalculations').append('Column 1 = ');
$('#listCalculations').append(a + '<sup>2</sup> + ' + c + '<sup>2</sup>  ' + ' = ' + answerC1);
// check if correct 
var correct = parseInt($('#light1').text());
if (answerC1 == correct) {$('#listCalculations').append('&check;') ;}
$('#listCalculations').append('<br>');
      
$('#listCalculations').append('Column 2 = ');
$('#listCalculations').append(b + '<sup>2</sup> + ' + d + '<sup>2</sup>  ' + ' = '  + answerC2);
var correct = parseInt($('#light2').text());
if (answerC2 == correct) {$('#listCalculations').append('&check;') ;}
$('#listCalculations').append('<br>');

$('#listCalculations').append('Row 1 = ');
$('#listCalculations').append(a + '<sup>2</sup> + ' + b + '<sup>2</sup>  ' + ' = '  + answerR1);
var correct = parseInt($('#light4').text());
if (answerR1 == correct) {$('#listCalculations').append('&check;') ;}
$('#listCalculations').append('<br>');

$('#listCalculations').append('Row 2 = ');
$('#listCalculations').append(c + '<sup>2</sup> + ' + d + '<sup>2</sup>  ' + ' = '  + answerR2);
var correct = parseInt($('#light6').text());
if (answerR2 == correct) {$('#listCalculations').append('&check;') ;}
$('#listCalculations').append('<br>');
  }
</script>

<script type="text/javascript">

$(document).ready(function(){


$('#check').on('click', function()
  {

// check the product of the inputs

showCalculations() ;

var a = parseInt($('#addend1').val()) ;
var b = parseInt($('#addend2').val()) ;
var c = parseInt($('#addend3').val()) ;
var d = parseInt($('#addend4').val()) ;



var col1Guess = a*a + c*c ;
var col2Guess = b*b + d*d ;

var row1Guess = a*a + b*b ;
var row2Guess = c*c + d*d ;


// test if conditions are satisfied

if (col1Guess == t1 & (a > 0 & c > 0 )) 
{ 
  $('#light1').css("background-color","green" );
  $('#light7').css("background-color","green" ) ;
}


if (col1Guess != t1 | (a <= 0 | c <= 0 )) 
  {
  $('#light1').css("background-color","red" );
  $('#light7').css("background-color","red" );
}

 

if (col2Guess == t2 & (b > 0 & d > 0 )) 
{ 
  $('#light2').css("background-color","green" );
  $('#light8').css("background-color","green" ) ;
}


if (col2Guess != t2 | (b <= 0 | d <= 0 )) 
  {
  $('#light2').css("background-color","red" );
  $('#light8').css("background-color","red" );

}


if (row1Guess == t3 & (a > 0 & b > 0 )) 
{ 
  $('#light3').css("background-color","green" );
  $('#light4').css("background-color","green" ) ;
}


if (row1Guess != t3 | (a <= 0 | b <= 0 )) 
  {
  $('#light3').css("background-color","red" );
  $('#light4').css("background-color","red" );
  }    
 

if (row2Guess == t4 & (c > 0 & d > 0 )) 
{ 
  $('#light5').css("background-color","green" );
  $('#light6').css("background-color","green" ) ;
}


if (row2Guess != t4 | (c <= 0 | d <= 0 )) 
  {
  $('#light5').css("background-color","red" );
  $('#light6').css("background-color","red" );
 }     



if ((col1Guess == t1 && col2Guess == t2 &&  row1Guess == t3 && row2Guess == t4 )

  && (a > 0 && b > 0 && c > 0 && d > 0 ))

  {finished = true ;} else {finished = false;} 

// do this if solved

var l = parseInt($('#level').val()) ;

// alert('Level = ' + l);

if (finished) 
{ 
alert('You win !!') ;
$('#check').html('&#10004;');
$('#options').show() ;
$('#clear').hide() ;
$('#help').hide() ;
$('#listFactors').hide() ;
var text = '<span>&#10035;</span>' ;
$('#score').append(text) ;
}



  }) ;

})
                
</script>






