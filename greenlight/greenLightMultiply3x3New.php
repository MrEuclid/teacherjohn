<!DOCTYPE html>
<html lang="en">
  <head>

  <title>greenLight game 3 rows multiplication</title>
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

<?php $op = '&times;' ; ?>
<div id = "grid">

  <?php include "includes/grid3x3.php" ; ?>
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
 <li>Put numbers in each row that multiply to make the number at the end of the row.</li>
 <li>Put numbers in each column that multiply to make the number at the top of the column.</li>
 <li> Use the ? button to check you answer.</li>
 <li>Choose a level to get started.</li>
</ul>
</p>
</div> <!-- message -->
<div id = "example">
<?php // include "includes/exampleMult.html" ; ?>
</div> <!-- example -->


    </div></div>
<?php include "includes/keyboard.html" ; ?>

<div class = "row align-items-center h-100 c">
     <div class="col-sm-12 c">
 <button id = "help" class="btn btn-info rectangle" >Help</button>
    </div></div>

    <div class = "row align-items-center h-100 c">
     <div class="col-sm-12 c">
 <p id = "listFactors" ></p></button>
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
  
   $(document).ready(function(){

    $('[id^=level]').on('click', function()
  {

// respond when a level button is clicked

$('[id^=addend]').show() ;
$('[id^=key-]').show() ;

var levelID = this.id ;
var level =  levelID.substring(5, 6);  // parse to get last digit = the playing level

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
a = p[a] ;
var b = Math.floor((Math.random() * upperLimit) + lowerLimit); 
b = p[b] ;
var c = Math.floor((Math.random() * upperLimit) + lowerLimit); 
c = p[c] ;
var d = Math.floor((Math.random() * upperLimit) + lowerLimit); 
d = p[d] ;
var e = Math.floor((Math.random() * upperLimit) + lowerLimit); 
e = p[e] ;
var f = Math.floor((Math.random() * upperLimit) + lowerLimit); 
f = p[f] ;
var g = Math.floor((Math.random() * upperLimit) + lowerLimit); 
g = p[g] ;
var h = Math.floor((Math.random() * upperLimit) + lowerLimit); 
h = p[h] ;
var i = Math.floor((Math.random() * upperLimit) + lowerLimit); 
i = p[i] ;

// row and column products 

t1 = a * d * g ;
t2 = b * e * h ;
t3 = c * f * i ;
t4 = a * b * c ;
t5 = d * e * f ;
t6 = g * h * i ;

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


var col1Guess = a * d * g ;
var col2Guess = b * e * h ;
var col3Guess = c * f * i ;
var row1Guess = a * b * c ;
var row2Guess = d * e * f ;
var row3Guess = g * h * i ;

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


<script type="text/javascript">
  
     $(document).ready(function(){

    $('#help').on('click', function()
  {

// lists the factors of the target numbers 
// so students can search for commnfactors

var i,j ;
var j = 0 ; // index of prime divisor
var temp = [] ;

$('#help').show() ;
$('#listFactors').show() ;
$('#listFactors').empty() ;
$('#listFactors').append('<h3>Factors</h3>') ;

for (i = 1 ; i <= 9 ; i++)
{
temp.length = 0  ;  
if (i != 5 & i != 7 & i != 9)  // avoid duplicates
 
 {
  n = $('#light'+i).text() ;
  n = parseInt(n) ;
 // alert('Checking ' + n + ' Index ' + i) ;
  $('#listFactors').append(n + ' -> ') ;
  j = 1 ; // reset divisor index
  while (p[j] <= Math.sqrt(n))
    {
      divisor = p[j] ;
      if (n % divisor == 0)
        {
      // add divisor and quotient to temp array 
          temp.push(divisor);
          var quotient = n/divisor ;
          temp.push(quotient);
          // alert('This is temp now ' + temp);
         } // if 

      j = j + 1 ;  // get next prime divisor
    }  // while



// show factors of numbers 
    t = temp.sort(function(a, b){return a - b});  // to avoid numbers being sortred as strings so 25 > 100 because 2 > 1 
    var l = t.length ;
    for (var k = 0 ; k < l ; k++)
      {
        $('#listFactors').append(t[k] + ' ');
      }
    
    $('#listFactors').append("<br>") ;

  } // if for condition

} // for 

    });

  })
</script>


