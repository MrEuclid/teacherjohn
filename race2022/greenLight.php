<?php 
$question = $_POST['question'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>

  <title>GreenLight game xy+xy</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../bootstrap-5.0.2-dist/css/bootstrap.min.css">
  <script src="../javaScript/jQuery/jquery-3.3.1.min.js"></script>
  <script src="../bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="../css/templeStyles.css">
<link rel="stylesheet" href="../css/newTempleStyles.css">
 
    



<style type="text/css">





#listFactors {font-family: sans-serif;font-size: 10pt ; text-align: center;}

.square {
    
    display: inline-block;
    margin: 0;
    padding: 2px 2px;
    text-rendering: auto;
    text-align: center;
    text-transform: none;
    text-decoration: none;
    text-indent: 0;
    text-shadow: none;
    letter-spacing: normal;
    word-spacing: normal;
    font-weight: bolder ;
    font-family: sans-serif;
    height: 50px ;
    width: 50px ;
    font-size: 2em;
    border: 1px outset buttonface; }


    
.rectangle {
    
    display: inline-block;
    margin: 0;
    padding: 2px 2px;

    
    text-rendering: auto;
    text-align: center;
    text-transform: none;
    text-decoration: none;
    text-indent: 0;
    text-shadow: none;
    letter-spacing: normal;
    word-spacing: normal;
    font-weight: bolder ;
    font-family: sans-serif;
    height: 50px ;
    width: 100px ;
    border: 1px outset buttonface; }


   .circle { 
            width: 50px; 
            height: 50px; 
            padding: 5px 5px; 
            border-radius: 25px; 
            margin: 5px ;
           
            text-align: center; }


#light1,#light2, #light3, #light4 , #light5, #light6, #light7, #light8, #light9, #light10,#light11,#light12

{background-color: red ;
color :white;
font-weight:bolder ;
font-size: 12pt ;}


#light1ex,#light2ex, #light3ex, #light4ex , #light5ex, #light6ex, #light7ex, #light8ex, #light9ex, #light10ex, #lightex11, #lightex12



{background-color: red ;
color :white;


font-size: 1em ;}

input {
        font-size: 10pt ;
        font-family: sans-serif;
        font-weight: bold;
        }

#operand {font-size: 12pt ; font-weight: bolder ; background-color: blue ; color: white; white-space: normal;}

#clear,#end { font-size: 11pt ; font-weight: bolder ; background-color: black ; color: white;}
#check, #checkex {color: blue ; font-size: 18pt ; font-weight: bolder ; background-color:yellow;}

#message {font-size: 10pt ; text-align: left; font-style: italic;}





hr { border: 1px solid red; }

hr.green {border: 2px solid green ;}

.alignCenter {text-align: center;
margin-right: auto;
margin-left: auto;
margin: 0 ;}

#big {font-size: 18pt ; color: blue; font-weight: bolder;}

.testLink  {
    display: inline-block;
  
    margin: 0;
    padding: 10px 10px;

    
    text-rendering: auto;
    text-align: center;
    text-transform: none;
    text-decoration: none;
    text-indent: 0;
    text-shadow: none;
    letter-spacing: normal;
    word-spacing: normal;
    font-weight: bolder ;
    font-size: 16pt ;
    color:yellow ;
    font-family: sans-serif;
    height: 100px ;
    width: 200px ;
    border: 1px outset buttonface; }

 .long {
    display: inline-block;
  
    margin: 0;
    padding: 10px 10px;

    
    text-rendering: auto;
    text-align: center;
    text-transform: none;
    text-decoration: none;
    text-indent: 0;
    text-shadow: none;
    letter-spacing: normal;
    word-spacing: normal;
    font-weight: bolder ;
    font-size: 14pt ;
    color:white ;
    font-family: sans-serif;
    height: 120px ;
    width: 200px ;
    border: 1px outset buttonface; }


     .c {text-align: center;
margin-right: auto;
margin-left: auto;
margin: 0 ;} 


.medium {
    display: inline-block;
  
    margin: 0;
    padding: 10px 10px;

    
    text-rendering: auto;
    text-align: center;
    text-transform: none;
    text-decoration: none;
    text-indent: 0;
    text-shadow: none;
    letter-spacing: normal;
    word-spacing: normal;
    font-weight: bolder ;
    font-size: 14pt ;
    color:white ;
    font-family: sans-serif;
    height: 60px ;
    width: 100px ;
    border: 1px outset buttonface; }

.c {text-align: center;
margin-right: auto;
margin-left: auto;
margin: 0 ;} 

#message {font-size: 10pt ; font-style: italic;color: black ; text-align: justify;}

.comprehension {font-size: 11pt ; font-family: sans-serif; text-align: justify;}

body {background-color: white}

h2 {color: green }
h1 {color: blue;}
h3 {color:orange;}


img {position: relative;}


  .answerText {font-size: 14pt ; color: black ;}

   .studentText {font-size: 14pt ; color: green ;}

  #total {text-align: center; width:120px;}


  [id^=key-] {

      font-size: 1em ; 
  
      width: 50px; 
    height: 50px; 
    padding: 5px 5px; 
    border-radius: 25px; 
    margin: 5px ;
    font-weight:bolder;
           
            text-align: center; 
      
      
      }
</style>

</head>
  <body>

    <div class = "container h-100">

<div class = "row align-items-center h-100">
     <div class="col-12 c">
<h1>Make the lights green</h1>
</div></div>

<?php $op = 'a + b + ab' ; ?>
<div id = "grid">

  <?php include "includes/grid2x2.php" ; ?>
</div> <!-- grid -->
<!--
<div id = "options">
<div class = "row align-items-center h-100 c">
     <div class="col-12 c">
      <button id = "level1" class="btn btn-info rectangle" >Level 1</button>
      <button id = "level2" class="btn btn-success rectangle" >Level 2</button>
      <button id = "level3" class="btn btn-primary rectangle" >Level 3</button>
      </div></div>
</div>

-->




<div class = "row align-items-center h-100 c">
     <div class="col-12 c">
 <p>
 <div  id = "message" >
  <ul>
 <li>Put numbers in each row so that the sum of the numbers plus the product of the numbers make the number at the end of the row.</li>
 <li>Put numbers in each column so that the sum of the numbers plus the product of the numbers make the number at the top of the column.</li>
 <li> Use the ? button to check you answer.</li>
 <li>Choose a level to get started.</li>
</ul>
</p>
</div> <!-- message -->

<div class = "row">
        <div class = "col-sm-12 c">
            <button id = "key-0">7</button>
             <button id = "key-1">8</button>
              <button id = "key-2">9</button>
          </div></div>

         <div class = "col-sm-12 c">
            <button id = "key-3">4</button>
             <button id = "key-4">5</button>
              <button id = "key-5">6</button>
          </div></div>

         <div class = "col-sm-12 c">
            <button id = "key-6">1</button>
             <button id = "key-7">2</button>
              <button id = "key-8">3</button>
          </div></div>

            <div class = "col-sm-12 c">
            <button id = "key-9">0</button>
             <button id = "key-10">C</button>
              <button id = "key-11">AC</button>
          </div></div>

    </div></div>

<div class = "row align-items-center h-100 c">
     <div class="col-12 c">
 <button id = "help" class="btn btn-info rectangle" >Answers</button>
    </div></div>

    <div class = "row align-items-center h-100 c">
     <div class="col-12 c">
 <p id = "listCalculations" ></p></button>
    </div></div>

</div> <!-- container -->


</body>
</html>


  <script>
    



   $(document).ready(function(){



focused = "";
total = 0 ;
keys = [7,8,9,4,5,6,1,2,3,0,"C","AC"] ;

question = '<?php echo $question; ?>' ;
points = parseInt(question.substr(-1));

  finished = false ;  // flag for when level is completed

  $('#grid').show() ;
  $('#help').show() ;
 
  $('[id^=key-]').hide() ;
  $('[id^=addend]').attr("readonly" ,true).hide();
  $('[id^=addend]').css({"background-color":"lightblue" ,"font-size":"1.5em","font-weight":"bolder"});

})
 </script>

 <script>
$(document).ready(function(){

$("[id^=addend]").click(function(){
clicked = $(this).attr("id"); // get id of the key 

$('#' + clicked).val('') ;


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

if (isNaN(a)) {a = 0 ;}
if (isNaN(b)) {b = 0 ;}
if (isNaN(c)) {c = 0 ;}
if (isNaN(d)) {d = 0 ;}

$('#listCalculations').empty() ;
$('#listCalculations').show() ;

var answerC1 = a*c + a+c ;
var answerC2 = b*d + b + d ;
var answerR1 = a*b + a + b ;
var answerR2 = c*d + c + d ;
console.log(a,b,c,d);
// answer = parseInt(answer) ;
$('#listCalculations').append('Column 1 = ');
$('#listCalculations').append(a + '&times;' + c + '+' + a + '+' + c + ' = ' + answerC1);
// check if correct 
var correct = parseInt($('#light1').text());
if (answerC1 == correct) {$('#listCalculations').append('&check;') ;}
$('#listCalculations').append('<br>');
      
$('#listCalculations').append('Column 2 = ');
$('#listCalculations').append(b + '&times;' + d + '+' + b + '+' + d + ' = ' + answerC2);
var correct = parseInt($('#light2').text());
if (answerC2 == correct) {$('#listCalculations').append('&check;') ;}
$('#listCalculations').append('<br>');

$('#listCalculations').append('Row 1 = ');
$('#listCalculations').append(a + '&times;' + b + '+' + a + '+' + b + ' = ' + answerR1);
var correct = parseInt($('#light4').text());
if (answerR1 == correct) {$('#listCalculations').append('&check;') ;}
$('#listCalculations').append('<br>');

$('#listCalculations').append('Row 2 = ');
$('#listCalculations').append(c + '&times;' + d + '+' + c + '+' + d + ' = ' + answerR2);
var correct = parseInt($('#light6').text());
if (answerR2 == correct) {$('#listCalculations').append('&check;') ;}
$('#listCalculations').append('<br>');
  }
</script>


<script>



$(document).ready(function(){

$("[id^=key-]").click(function(){
clicked = $(this).attr("id"); // get id of the key 
clicked = clicked.substr(4);  // remove key-
// alert('id = ' + clicked + ' key = ' + keys[clicked]) ; // show the number that was clicked
//  alert('focused = ' + focused);
amount = keys[clicked] ;

  if ( focused != "")
  { 
    var showing =  $('#'+focused).val();  // what is already in the input box
  
if (amount == "C")
 {
  var l = showing.length ;
  if (l > 0)
  {
  showing = showing.slice(0,-1); 
  }  // reduce string by 1
  display = showing ; // amount = original amount
  $('#'+focused).val(display); 
 }

if (amount == "AC")
 {

  showing = ""; // set string to ""  
  display = showing ; // amount = original amount
  $('#'+focused).val(display); 
 }

 if (amount != "C" && amount != "AC")
 {
  var display = showing + amount ;  // add the value of what has been clicked
   $('#'+focused).val(display);  // update input box 
 }

}





})
})





</script>

 <script>

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




  finished = false ;  // flag for when level is completed

  $('#grid').show() ;
  $('#help').hide() ;


</script>




<script type="text/javascript">
  
   $(document).ready(function(){

 //   $('[id^=level]').on('click', function()
//  {

// respond when a level button is clicked

$('[id^=addend]').show() ;
$('[id^=key-]').show() ;

// var levelID = this.id ;
level = 1 ; // levelID.substring(5, 6);  // parse to get last digit = the playing level
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








//  $('[id^=light').css("background-color","red" ); // ipad didn't like this here ?????

 // alert('check if here ');
$('#check').text('?') ;
$('.operand').val('') ;


// alert('Level = ' + level) ;

var lowerLimit = 1 ;

if (level == 1)
{var upperLimit = 9;
lowerLimit = 2}
/*
if (level == 2)
{var upperLimit = 20;
lowerLimit = 5 ;}

if (level == 3)
{var upperLimit = 30;
     lowerLimit = 10}

*/


// get random prime numbers in a range based on the selected level

var a = Math.floor((Math.random() * upperLimit) + lowerLimit); 
var b = Math.floor((Math.random() * upperLimit) + lowerLimit); 
var c = Math.floor((Math.random() * upperLimit) + lowerLimit); 
var d = Math.floor((Math.random() * upperLimit) + lowerLimit); 


// row and column products 

t1 = a*c + a + c  ;
t2 = b*d + b + d  ;
t3 = a*b + b + a  ;
t4 = c*d + d + c  ;

console.log(a,b,c,d);
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

  //   }) ;

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

var answerC1 = a*c + a+c ;
var answerC2 = b*d + b + d ;
var answerR1 = a*b + a + b ;
var answerR2 = c*d + c + d ;
// answer = parseInt(answer) ;
$('#listCalculations').append('Column 1 = ');
$('#listCalculations').append(a + '&times;' + c + '+' + a + '+' + c + ' = ' + answerC1);
// check if correct 
var correct = parseInt($('#light1').text());
if (answerC1 == correct) {$('#listCalculations').append('&check;') ;}
$('#listCalculations').append('<br>');
      
$('#listCalculations').append('Column 2 = ');
$('#listCalculations').append(b + '&times;' + d + '+' + b + '+' + d + ' = ' + answerC2);
var correct = parseInt($('#light2').text());
if (answerC2 == correct) {$('#listCalculations').append('&check;') ;}
$('#listCalculations').append('<br>');

$('#listCalculations').append('Row 1 = ');
$('#listCalculations').append(a + '&times;' + b + '+' + a + '+' + b + ' = ' + answerR1);
var correct = parseInt($('#light4').text());
if (answerR1 == correct) {$('#listCalculations').append('&check;') ;}
$('#listCalculations').append('<br>');

$('#listCalculations').append('Row 2 = ');
$('#listCalculations').append(c + '&times;' + d + '+' + c + '+' + d + ' = ' + answerR2);
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
// alert("Checking") ;
showCalculations() ;

var a = parseInt($('#addend1').val()) ;
var b = parseInt($('#addend2').val()) ;
var c = parseInt($('#addend3').val()) ;
var d = parseInt($('#addend4').val()) ;



var col1Guess = a*c + c+a   ;
var col2Guess = b*d + d+b  ;

var row1Guess = a*b + b+a ;
var row2Guess = c*d + d+c  ;


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

if (finished) {



   
      var pts = parseInt($('#total').text());
     pts = parseInt(pts);
     points = parseInt(points) ;
     console.log("points",pts);
    // pts = parseInt(pts + points);
     console.log("points",pts);
     $('#total').text(pts);
alert("You made the lights green!");
    $('#menu').show();
     console.log("processing ",questionID);

processWin(questionID);
    
    
  

     $('#play').empty().show();
     $('#q3').prop('disabled',true).css({"background-color":"blue","color":"yellow"});
    
   
    
    
    
    
    }



  }) ;

})
                
</script>






