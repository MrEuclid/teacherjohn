
  function writeData(team,score) {

    //  alert("Calling write") ;
          // write to countDownResults ;
   //       console.log("writing",team,word) ;
  $.ajax({
  url: 'writeTriangleData.php',
  type: 'POST',
  data: {team:team,score:score }, 
  datatype: 'json'
})  // parameters
.done(function (response) { 

console.log("writing",team,score) ;

})  //done
.fail(function (jqXHR, textStatus, errorThrown) { 
alert("Failure " + jqXHR + ' ' + textStatus + ' error ' + errorThrown) ;

})  // fail


  }  // function


  function getRank(team) {

    //  alert("Calling write") ;
          // write to countDownResults ;
   //       console.log("writing",team,word) ;
  $.ajax({
  url: 'getTriangleRank.php',
  type: 'POST',
  data: {team:team}, 
  datatype: 'json'
})  // parameters
.done(function (response) { 

console.log("rank",response) ;

})  //done
.fail(function (jqXHR, textStatus, errorThrown) { 
alert("Failure " + jqXHR + ' ' + textStatus + ' error ' + errorThrown) ;

})  // fail


  }  // function




    function getRandomInt(min, max) {
      return Math.floor(Math.random() * (max - min + 1)) + min;
  }
  

function hideCanvas()
{
   
$('#svgCanvas').hide() ;
// document.getElementById('tX').style.fontSize = "24px";
 $('[id^=equation]').hide() ;
 $('[id^=start]').hide() ;

  $('#aPlus').hide() ;
 $('#aMinus').hide() ; 

 $('#bPlus').hide() ;
 $("#bMinus").hide() ;

 $('#cPlus').hide() ;
 $('#cMinus').hide() ;

 $('#equationA1').text('A') ;
 $('#equationA2').text('A') ;
 $('#equationB1').text('B') ;
 $('#equationB2').text('B') ;
 $('#equationC1').text('C') ;
 $('#equationC2').text('C') ;


}

function showCanvas()
{
   
$('#svgCanvas').show() ;
// document.getElementById('tX').style.fontSize = "24px";
 $('[id^=equation]').show() ;
 $('[id^=start]').show() ;

  $('#aPlus').show() ;
 $('#aMinus').show() ; 

 $('#bPlus').show() ;
 $("#bMinus").show() ;

 $('#cPlus').show() ;
 $('#cMinus').show() ;


}



  function checkAnswer()
  {

    var a = $('#startA').val() ;
    var b = $('#startB').val() ;
    var c = $('#startC').val() ;
    var x = $('#tX').text() ;
    var y = $('#tY').text() ;
    var z = $('#tZ').text() ;

    var resultX = false ;
    var resultY = false ;
    var resultZ = false ;
    
   // alert('Outcome for ' + a + ' ' + ' ' + b + ' ' + x) ; 
   a = parseInt(a) ;
   b = parseInt(b) ;
   c = parseInt(c) ;

   x = parseInt(x) ;
   y = parseInt(y) ;
   z = parseInt(z) ;

   answerX = parseInt(a+b) ; 
   answerY = parseInt(b+c) ;
   answerZ = parseInt(a+c) ;

   $('#equationX').html(answerX) ;
   $('#equationY').html(answerY) ;
   $('#equationZ').html(answerZ) ;

   if (a + b == x)
   {resultX = true ;}
   else
   {resultX = false ;} 

    if (b + c == y)
   {resultY = true ;}
   else
   {resultY = false ;} 

  if (a + c == z)
   {resultZ = true ;}
   else
   {resultZ = false ;} 
   if (a + b == x )
    {$('#equationX').css({"background-color":"orange","color":"white"}) ;
     document.getElementById('tX').setAttribute("fill", "pink");}

     
  else 
    {$('#equationX').css({"background-color":"white","color":"black"}) ;
 document.getElementById('tX').setAttribute("fill", "black");
}


   if (b + c == y )
     {$('#equationY').css({"background-color":"orange","color":"white"}) ;
     document.getElementById('tY').setAttribute("fill", "pink");}

     
  else 
    {$('#equationY').css({"background-color":"white","color":"black"}) ;
 document.getElementById('tY').setAttribute("fill", "black");
}

   if (a + c == z )
     {$('#equationZ').css({"background-color":"orange","color":"white"}) ;
     document.getElementById('tZ').setAttribute("fill", "pink");}

     
  else 
    {$('#equationZ').css({"background-color":"white","color":"black"}) ;
 document.getElementById('tZ').setAttribute("fill", "black");
}
result = (resultX & resultY & resultZ); 
if (result == 1) {
  $('#svgCanvas').hide() ;
  alert('You solved it!') ; 
  score = level * 3 ;
  writeData(team,score)
$('#svgCanvas').hide() ;
hideCanvas() ;
}
  return result;  
  }



$(document).ready(function(){
    $('#register').on('click', function(){
      teamName = $('#teamName').val() ;
     team = teamName ;
    //  alert(teamName);
       if (teamName.length > 0 )
       {
        var lowerLimit = 100 ; 
        var upperLimit = 999 ;   
        var n = Math.floor((Math.random() * upperLimit) + lowerLimit);   
       teamName = teamName + '-#' + n ;
       $('#ourTeam').text(teamName);


$('#registration').hide();
showCanvas() ;
hideCanvas() ;
$('#menuButtons').show() ;
$('#abc').show() ;
teamName = $('#teamName').val() ;
alert('Team = ' + teamName);
$('#team').text(teamName) ;

    }
else
{
$('#error').text("Please write you team name") ;
}

    })
})

$(document).ready(function(){
hideCanvas() ;
$('#menuButtons').hide() ;
$('#abc').hide() ;
level = 0 ;
score = 0 ;




})


$(document).ready(function(){


$("#easy").click(function() {

$('#svgCanvas').show() ;

level = 1 ;
$('[id^=equation]').show() ;
$('[id^=start]').show() ;

$('#aPlus').show() ;
$('#aMinus').show() ; 

$('#bPlus').show() ;
$('#bMinus').show() ;

$('#cPlus').show() ;
$('#cMinus').show() ;
var min = 1 ;
var max = 10 ;
var numX = getRandomInt(min,max) ;
var numY = getRandomInt(min,max) ;
var numZ = getRandomInt(min,max) ;




numX = numX * 2 ;
numY = numY * 2 ;
numZ = numZ * 2 ;

$('#tX').html(numX) ;
document.getElementById('tX').style.fontSize = "24px";
 $('#tY').html(numY) ;
document.getElementById('tY').style.fontSize = "24px";
 $('#tZ').html(numZ) ;
document.getElementById('tZ').style.fontSize = "24px";

$('#equationX').html(numX) ;
$('#equationY').html(numY) ;
$('#equationZ').html(numZ) ;

var a = 0 ;
$('#startA').val(0);
$('#tA').html(a) ;

 var b = 0 ;
 $('#startB').val(0);
$('#tB').html(b) ;

 var c = 0 ;
 $('#startC').val(0);
$('#tC').html(c) ;

});
})


$(document).ready(function(){
$('#aPlus').show() ;
$('#aMinus').show() ; 

$('#bPlus').show() ;
$('#bMinus').show() ;

$('#cPlus').show() ;
$('#cMinus').show() ;

$("#medium").click(function() {

level = 2 ;

$('#svgCanvas').show() ;

$('#svgCanvas').show() ;
$('[id^=equation]').show() ;
$('[id^=start]').show() ;

var min = 15 ;
var max = 100 ;
var numX = getRandomInt(min,max) ;
var numY = getRandomInt(min,max) ;
var numZ = getRandomInt(min,max) ;



numX = numX * 2 ;
numY = numY * 2 ;
numZ = numZ * 2 ;

$('#tX').html(numX) ;
document.getElementById('tX').style.fontSize = "24px";
 $('#tY').html(numY) ;
document.getElementById('tY').style.fontSize = "24px";
 $('#tZ').html(numZ) ;
document.getElementById('tZ').style.fontSize = "24px";

$('#equationX').html(numX) ;
$('#equationY').html(numY) ;
$('#equationZ').html(numZ) ;

var a = min ;
$('#startA').val(min);
$('#tA').html(a) ;

 var b = min ;
 $('#startB').val(min);
$('#tB').html(b) ;

 var c = min ;
 $('#startC').val(min);
$('#tC').html(c) ;

});
})


$(document).ready(function(){
$('#aPlus').show() ;
$('#aMinus').show() ; 

$('#bPlus').show() ;
$('#bMinus').show() ;

$('#cPlus').show() ;
$('#cMinus').show() ;

$("#hard").click(function() {

level = 3

$('#svgCanvas').show() ;

$('#svgCanvas').show() ;
$('[id^=equation]').show() ;
$('[id^=start]').show() ;

var min = -50 ;
var max = 50 ;
var numX = getRandomInt(min,max) ;
var numY = getRandomInt(min,max) ;
var numZ = getRandomInt(min,max) ;



numX = numX * 2 ;
numY = numY * 2 ;
numZ = numZ * 2 ;

$('#tX').html(numX) ;
document.getElementById('tX').style.fontSize = "24px";
 $('#tY').html(numY) ;
document.getElementById('tY').style.fontSize = "24px";
 $('#tZ').html(numZ) ;
document.getElementById('tZ').style.fontSize = "24px";

$('#equationX').html(numX) ;
$('#equationY').html(numY) ;
$('#equationZ').html(numZ) ;
var a = min ;
$('#startA').val(a);
$('#tA').html(a) ;

 var b = max ;
 $('#startB').val(max);
$('#tB').html(b) ;

 var c = min ;
 $('#startC').val(min);

$('#tC').html(c) ;

});
})


$(document).ready(function(){
$('#aPlus').show() ;
$('#aMinus').show() ; 

$('#bPlus').show() ;
$('#bMinus').show() ;

$('#cPlus').show() ;
$('#cMinus').show() ;

$("#difficult").click(function() {

$('#svgCanvas').show() ;
level = 4 ;

$('#svgCanvas').show() ;
$('[id^=equation]').show() ;
$('[id^=start]').show() ;

var min = -499 ;
var max = 499 ;
var numX = getRandomInt(min,max) ;
var numY = getRandomInt(min,max) ;
var numZ = getRandomInt(min,max) ;



numX = numX * 2 ;
numY = numY * 2 ;
numZ = numZ * 2 ;

$('#tX').html(numX) ;
document.getElementById('tX').style.fontSize = "24px";
 $('#tY').html(numY) ;
document.getElementById('tY').style.fontSize = "24px";
 $('#tZ').html(numZ) ;
document.getElementById('tZ').style.fontSize = "24px";
$('#equationX').html(numX) ;
$('#equationY').html(numY) ;
$('#equationZ').html(numZ) ;
 var a = 0 ;
$('#startA').val(a);
$('#tA').html(a) ;

 var b = 0;
 $('#startB').val(b);
$('#tB').html(b) ;

 var c = 0 ;
 $('#startC').val(c);
 
$('#tC').html(c) ;

});
})


$(document).ready(function(){


$( "#aPlus" ).click(function() {

var a = $('#tA').html() ;
a = parseInt(a) ;
a = a + 1 ;
$('#tA').html(a) ;
$('#startA').val(a) ;
$('#equationA1').html(a) ;
$('#equationA2').html(a) ;
var outcome = checkAnswer() ;
});
})


$(document).ready(function(){
$('#aPlus').show() ;
$('#aMinus').show() ; 

$('#bPlus').show() ;
$('#bMinus').show() ;

$('#cPlus').show() ;
$('#cMinus').show() ;

$("#easy").click(function() {

$('#svgCanvas').show() ;
$('[id^=equation]').show() ;
$('[id^=start]').show() ;

var min = 1 ;
var max = 10 ;
var numX = getRandomInt(min,max) ;
var numY = getRandomInt(min,max) ;
var numZ = getRandomInt(min,max) ;

numX = numX * 2 ;
numY = numY * 2 ;
numZ = numZ * 2 ;

$('#tX').html(numX) ;
document.getElementById('tX').style.fontSize = "24px";
 $('#tY').html(numY) ;
document.getElementById('tY').style.fontSize = "24px";
 $('#tZ').html(numZ) ;
document.getElementById('tZ').style.fontSize = "24px";

var a = $('#startA').val(min);
$('#tA').html(a) ;

 var b = $('#startB').val(min);
$('#tB').html(b) ;

 var c = $('#startC').val(min);
$('#tC').html(c) ;

});
})


$(document).ready(function(){


$( "#aMinus" ).click(function() {

var a = $('#tA').html() ;
a = parseInt(a) ;
a = a - 1 ;
$('#tA').html(a) ;
$('#startA').val(a) ;
$('#equationA1').html(a) ;

var outcome = checkAnswer() ;


});
})



$(document).ready(function(){


$( "#startA" ).change(function() {

var inputA = $('#startA').val() ;
inputA = parseInt(inputA) ;

$('#tA').html(inputA) ;
$('#equationA1').html(inputA) ;
$('#equationA2').html(inputA) ;

// check A + B = x and A + C = z
var outcome = checkAnswer() ;

});
})


$(document).ready(function(){


$( "#bPlus" ).click(function() {

var b = $('#tB').html() ;
b = parseInt(b) ;
b = b + 1 ;
$('#tB').html(b) ;
$('#startB').val(b) ;
$('#equationB1').html(b) ;
$('#equationB2').html(b) ;
var outcome = checkAnswer() ;
});
})


$(document).ready(function(){


$( "#bMinus" ).click(function() {

var b = $('#tB').html() ;
b = parseInt(b) ;
b = b - 1 ;
$('#tB').html(b) ;
 $('#startB').val(b) ;
 $('#equationB1').html(b) ;
$('#equationB2').html(b) ;
var outcome = checkAnswer() ;
});
})


$(document).ready(function(){


$( "#startB" ).change(function() {

var inputB = $('#startB').val() ;
inputB = parseInt(inputB) ;


$('#tB').html(inputB) ;
$('#equationB1').html(inputB) ;
$('#equationB2').html(inputB) ;

var outcome = checkAnswer() ;
});
})


$(document).ready(function(){


$( "#cPlus" ).click(function() {

var c = $('#tC').html() ;
c = parseInt(c) ;
c = c + 1 ;
$('#tC').html(c) ;
$('#startC').val(c) ;
 $('#equationC1').html(c) ;
$('#equationC2').html(c) ;
var outcome = checkAnswer() ;
});
})


$(document).ready(function(){


$( "#cMinus" ).click(function() {

var c = $('#tC').html() ;
c = parseInt(c) ;
c = c - 1 ;
$('#tC').html(c) ;
 $('#startC').val(c) ;
 $('#equationC1').html(c) ;
$('#equationC2').html(c) ;
var outcome = checkAnswer() ;
});
})


$(document).ready(function(){


$( "#startC" ).change(function() {

var inputC = $('#startC').val() ;
inputC = parseInt(inputC) ;

$('#tC').html(inputC) ;
$('#equationC1').html(inputC) ;
$('#equationC2').html(inputC) ;
var outcome = checkAnswer() ;
});
})
