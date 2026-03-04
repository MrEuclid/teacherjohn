<!DOCTYPE html>
<html lang="en">
  <head>

  <title>greenLight game 3 rows addition</title>
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
  <script src = "javaScript/functionLevelFinished.js"></script>
  <script src = "javaScript/clearGrid.js"></script>   
  <script src = "javaScript/keyboardClick.js"></script>  
  

  <link rel = "stylesheet" href  = "css/pioStudentsStyles.css">


<style type="text/css">
  #total {text-align: center; width:120px;}


  [id^=key-] {height: 6x0px ; width: 60px ; font-size: 1em ; margin-top: 10px ;margin-left: 10px ; margin-bottom: 10px ; margin-right: 10px}
</style>

</head>
  <body>

    <div class = "container h-100">

<div class = "row align-items-center h-100">
     <div class="col-sm-12 c">
<h1>Make the lights green</h1>
</div></div>

<?php $op = '&plus;' ; ?>
<div id = "grid">

  <?php include "includes/grid3x3.php" ; ?>
</div> <!-- grid -->

<div id = "options">
<div class = "row">
     <div class="col-12-sm c">
      <button id = "level1" class="btn btn-info rectangle" >Level 1</button>
      <button id = "level2" class="btn btn-success rectangle" >Level 2</button>
      <button id = "level3" class="btn btn-primary rectangle" >Level 3</button>
      <a href = "indexNewMaths.php"> <button id = "end" class="btn btn-default rectangle" >Home</button></a>
      </div></div>
</div>

<div id = "scoreBoard">
<div class = "row">
     <div class="col-sm-12 c">
<p class = "c" id = "score"></p>
    </div></div>
</div> <!-- scoreboard -->


<div class = "row">
     <div class="col-sm-12 c">
 <p>
 <div  id = "message" >
  <ul>
 <li>Put numbers in each row that add to make the number at the end of the row.</li>
 <li>Put numbers in each column that add to make the number at the top of the column.</li>
 <li>You cannot use 0.</li>
 <li> Use the ? button to check you answer.</li>
 <li>Choose a level to get started.</li>
</ul>
</p>
</div> <!-- message -->
<div id = "example">
<?php // include "includes/exampleAdd.html" ; ?>
</div> <!-- example -->


    </div></div>


<?php include "includes/keyboard.html" ; ?>

<div class = "row">
     <div class="col-sm-12 c">
 <label id = "answers"  >Answers</label>
    </div></div>

    <div class = "row">
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
  
  function showCalculations() 

  {

a = parseInt($('#addend1').val()) ;
b = parseInt($('#addend2').val()) ;
c = parseInt($('#addend3').val()) ;
d = parseInt($('#addend4').val()) ;
e = parseInt($('#addend5').val()) ;
f = parseInt($('#addend6').val()) ;
g = parseInt($('#addend7').val()) ;
h = parseInt($('#addend8').val()) ;
i = parseInt($('#addend9').val()) ;


if (isNaN(a)) {a = 0 ;}
if (isNaN(b)) {b = 0 ;}
if (isNaN(c)) {c = 0 ;}
if (isNaN(d)) {d = 0 ;}

if (isNaN(e)) {e = 0 ;}
if (isNaN(f)) {f = 0 ;}
if (isNaN(g)) {g = 0 ;}
if (isNaN(h)) {h = 0 ;}
if (isNaN(i)) {i = 0 ;}

$('#listCalculations').empty() ;
$('#listCalculations').show() ;

var answerC1 = a + d + g ;
var answerC2 = b + e + h ;
var answerC3 = c + f + i ;
var answerR1 = a + b + c ;
var answerR2 = d + e + f ;
var answerR3 = g + h + i ;


// answer = parseInt(answer) ;
$('#listCalculations').append('Column 1 = ');
$('#listCalculations').append(a + '+' + d + '+' + g + ' = ' + answerC1);
// check if correct 
var correct = parseInt($('#light1').text());
if (answerC1 == correct) {$('#listCalculations').append('&check;') ;}
$('#listCalculations').append('<br>');
      
$('#listCalculations').append('Column 2 = ');
$('#listCalculations').append(b + '+' + e + '+' + f + ' = ' + answerC2);
// check if correct 
var correct = parseInt($('#light2').text());
if (answerC2 == correct) {$('#listCalculations').append('&check;') ;}
$('#listCalculations').append('<br>');

$('#listCalculations').append('Column 3 = ');
$('#listCalculations').append(c + '+' + f + '+' + i + ' = ' + answerC3);
// check if correct 
var correct = parseInt($('#light3').text());
if (answerC3 == correct) {$('#listCalculations').append('&check;') ;}
$('#listCalculations').append('<br>');


// rows 

// answer = parseInt(answer) ;
$('#listCalculations').append('Row 1 = ');
$('#listCalculations').append(a + '+' + b + '+' + c + ' = ' + answerR1);
// check if correct 
var correct = parseInt($('#light4').text());
if (answerR1 == correct) {$('#listCalculations').append('&check;') ;}
$('#listCalculations').append('<br>');
      
$('#listCalculations').append('Row 2 = ');
$('#listCalculations').append(d + '+' + e + '+' + f + ' = ' + answerR2);
// check if correct 
var correct = parseInt($('#light6').text());
if (answerR2 == correct) {$('#listCalculations').append('&check;') ;}
$('#listCalculations').append('<br>');

$('#listCalculations').append('Row 3 = ');
$('#listCalculations').append(g + '+' + h + '+' + i + ' = ' + answerR3);
// check if correct 
var correct = parseInt($('#light8').text());
if (answerR3 == correct) {$('#listCalculations').append('&check;') ;}
$('#listCalculations').append('<br>');


  }
</script>


<script type="text/javascript">
  
   $(document).ready(function(){

    $('[id^=level]').on('click', function()
  {

// respond when a level button is clicked

var levelID = this.id ;
var level =  levelID.substring(5, 6);  // parse to get last digit = the playing level

$('[id^=addend]').show() ;
$('[id^=key-]').show() ;

// alert('Level = ' + level) ;
$('#example').hide() ;
$('#grid').show() ;
$('#go').hide() ;
$('#newGame').hide() ;
$('#clear').show() ;
$('#options').hide() ;
$('#help').show() ;
$('#listFactors').hide() ;
$('#message').hide()  ;
$('#scoreboard').show() ;


//  $('[id^=light').css("background-color","red" ); // ipad didn't like this here ?????
// alert('check if here ');

$('#check').text('?') ;
$('.operand').val('') ;



var levelID = this.id ;
var level =  levelID.substring(5, 6);
alert('Level = ' + level) ;
level = parseInt(level) ;

var upperLimit = level*5 + 1 ;
var lowerLimit = 1 ;

// get random prime numbers in a range based on the selected level

var a = Math.floor((Math.random() * upperLimit) + lowerLimit); 
var b = Math.floor((Math.random() * upperLimit) + lowerLimit); 
var c = Math.floor((Math.random() * upperLimit) + lowerLimit); 
var d = Math.floor((Math.random() * upperLimit) + lowerLimit); 
var e = Math.floor((Math.random() * upperLimit) + lowerLimit); 
var f = Math.floor((Math.random() * upperLimit) + lowerLimit); 
var g = Math.floor((Math.random() * upperLimit) + lowerLimit); 
var h = Math.floor((Math.random() * upperLimit) + lowerLimit); 
var i = Math.floor((Math.random() * upperLimit) + lowerLimit); 


// row and column products 

t1 = a + d + g ;
t2 = b + e + h ;
t3 = c + f + i ;
t4 = a + b + c ;
t5 = d + e + f ;
t6 = g + h + i ;

// put the numbers in the red lights

$('#light1').text(t1);
$('#light10').text(t1);

$('#light2').text(t2);
$('#light11').text(t2);

$('#light3').text(t3);
$('#light12').text(t3);

$('#light4').text(t4);
$('#light5').text(t4);

$('#light6').text(t5);
$('#light7').text(t5);

$('#light8').text(t6);
$('#light9').text(t6);

 // set colour of lights to red

  $('[id^=light').css("background-color","red" );

     }) ;

  })
    
</script>


<script type="text/javascript">

$(document).ready(function(){


$('#check').on('click', function()
  {


showCalculations() ;
// check the product of the inputs



var a = parseInt($('#addend1').val()) ;
var b = parseInt($('#addend2').val()) ;
var c = parseInt($('#addend3').val()) ;
var d = parseInt($('#addend4').val()) ;
var e = parseInt($('#addend5').val()) ;
var f = parseInt($('#addend6').val()) ;
var g = parseInt($('#addend7').val()) ;
var h = parseInt($('#addend8').val()) ;
var i = parseInt($('#addend9').val()) ;




var col1Guess = a + d + g ;
var col2Guess = b + e + h ;
var col3Guess = c + f + i ;
var row1Guess = a + b + c ;
var row2Guess = d + e + f ;
var row3Guess = g + h + i ;

// test if conditions are satisfied

if (col1Guess == t1 & (a > 0 & d > 0 & g > 0)) 
{ 
  $('#light1').css("background-color","green" );
  $('#light10').css("background-color","green" ) ;
}


if (col1Guess != t1 | (a <= 0 | d <= 0 | g <= 0)) 
  {
  $('#light1').css("background-color","red" );
  $('#light10').css("background-color","red" );
}

 

if (col2Guess == t2 & (b > 0 & e > 0 & h > 0)) 
{ 
  $('#light2').css("background-color","green" );
  $('#light11').css("background-color","green" ) ;
}


if (col2Guess != t2 | (b <= 0 | e <= 0 | h <= 0)) 
  {
  $('#light2').css("background-color","red" );
  $('#light11').css("background-color","red" );

}

if (col3Guess == t3 & (c > 0 & f > 0 & i > 0)) 
{ 
  $('#light3').css("background-color","green" );
  $('#light12').css("background-color","green" ) ;
}


if (col3Guess != t3 | (c <= 0 | f <= 0 | i <= 0)) 
  {
  $('#light3').css("background-color","red" );
  $('#light12').css("background-color","red" );
 
}

if (row1Guess == t4 & (a > 0 & b > 0 & c > 0)) 
{ 
  $('#light4').css("background-color","green" );
  $('#light5').css("background-color","green" ) ;
}


if (row1Guess != t4 | (a <= 0 | b <= 0 | c <= 0)) 
  {
  $('#light4').css("background-color","red" );
  $('#light5').css("background-color","red" );
  }    
 

if (row2Guess == t5 & (d > 0 & e > 0 & f > 0)) 
{ 
  $('#light6').css("background-color","green" );
  $('#light7').css("background-color","green" ) ;
}


if (row2Guess != t5 | (d <= 0 | e <= 0 | f <= 0)) 
  {
  $('#light6').css("background-color","red" );
  $('#light7').css("background-color","red" );
 }     


if (row3Guess == t6 & (g > 0 & h > 0 & i > 0)) 
{ 
  $('#light8').css("background-color","green" );
  $('#light9').css("background-color","green" ) ;
}


if (row3Guess != t6 | (g <= 0 | h <= 0 | i <= 0)) 
  {
  $('#light8').css("background-color","red" );
  $('#light9').css("background-color","red" );
   }   
 

if ((col1Guess == t1 && col2Guess == t2 && col3Guess == t3 && row1Guess == t4 && row2Guess == t5 && row3Guess == t6)

  && (a > 0 && b > 0 && c > 0 && d > 0 && e > 0 && f > 0 && g > 0 && h > 0 && i > 0))

  {finished = true ;} else {finished = false;} 

// do this if solved

if (finished) {alert('You win !!') ;
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

<script type="text/javascript">
  
   $(document).ready(function(){

    $('#clear').on('click', function()
  {

// remove inputs and turn all lights red

$('#example').hide() ;
$('#grid').show() ;
$('#go').hide() ;
$('[id^=light]').css("background-color","red" );

$('.operand').val('') ;


     }) ;

  })
    
</script>

