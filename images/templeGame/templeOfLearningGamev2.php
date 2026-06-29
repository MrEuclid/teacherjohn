<!DOCTYPE html>
<html>
<head>
  
   
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../javaScript/bootStrap/bootstrap-3.3.7-dist/css/bootstrap.min.css">
  <script src="../javaScript/jQuery/jquery-3.3.1.min.js"></script>
  <script src="../javaScript/bootStrap/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
  
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
 


<script type="text/javascript">
  function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

</script>
 
<script type="text/javascript">
  
  // these set x,y coordinates of player

 
  var newPosition = 0 ; // room number
  var positionX = 0 ;
  var positionY = 0 ;  
  var position = 0 ;

  // size of grid

 

  var  positionX = (place-1) % columns + 1 ;
  var positionY = (place - positionX) / columns + 1;

  var image = [] ;
  var visited = [] ; 
  for (i = 1 ; i <= rows*columns ; i++)
    {visited[i] = ' * '}
  moves = 0 ;
  var n = 0 ;
  image[0] =  "images/school1.png"  ;
  imageCat = "images/cat.png"  ;

/*
  for (j = 1 ; j <= rows ; j++)
  {
   for (i = 1 ; i <= columns ; i++)
   {
    n = i*j ; 
    image[n] = "images/templeGame/n" + ".png" ;} 
  }
  
  */
// need to load 15 x 15 images 5x5 10x10 and 15 x 15
  image[1] = "images/templeGame/001arctic.png" ;
  image[2] = "images/templeGame/002baseball.png" ;
  image[3] = "images/templeGame/006beach.png" ;
  image[4] = "images/templeGame/007beach.png" ;
  image[5] = "images/templeGame/button5.png" ;
  image[6] = "images/templeGame/button6.png" ;
  image[7] = "images/templeGame/button7.png" ;
  image[8] = "images/templeGame/button8.png" ;
  image[9] = "images/templeGame/button9.png" ;
  image[10] = "images/templeGame/button10.png" ;
  image[11] = "images/templeGame/button11.png" ;
  image[12] = "images/templeGame/button12.png" ;

  image[13] = "images/templeGame/pioLogo.png" ;
  image[14] = "images/templeGame/002baseball.png" ;
  image[16] = "images/templeGame/006beach.png" ;
  image[16] = "images/templeGame/007beach.png" ;
  image[17] = "images/templeGame/button5.png" ;
  image[18] = "images/templeGame/pioLogo.png" ;
  image[19] = "images/templeGame/button7.png" ;
  image[20] = "images/templeGame/button8.png" ;
  image[21] = "images/templeGame/button9.png" ;
  image[22] = "images/templeGame/button10.png" ;
  image[23] = "images/templeGame/button11.png" ;
  image[24] = "images/templeGame/button12.png" ;
  image[25] = "images/templeGame/007beach.png" ;
 
  
</script>

<script type="text/javascript">
  
  function placeTemple(level)
  {
  var rows = level*5 ;
  var columns = level*5 ;
  var location =  getRandomInt(rows*columns/2,rows*columns) ;
  image[place] = "images/templeGame/temple.png" ;
  return location ;
  }
</script>
    <meta charset="utf-8">
<style type="text/css">
	p {text-align: left;
margin-left: 10% ;
margin-right: 10% ;
font-family: sans-serif;
font-size: 12pt ;
font-style: normal;
font-weight:normal;}

.glyphicon.glyphicon-star-empty {
    font-size: 16px;
}

.c {text-align: center;
margin-right: auto;
margin-left: auto;
margin: 0 ;}

#eqtn  {text-align: center;
margin-right: auto;
margin-left: auto;
margin: 0 ;}

input {width: 60px ; text-align: center;}

img {height: 240px ; width: 240px ;}

#over {position: absolute; top: 200px ; left: 50%;  height: 100px ; width: 100px;}

#wrapper {position: relative;}

button {padding: 2px ; width: 120px ; margin-bottom: 5px ;margin-top: 2px;}

button.smaller {padding: 2px ; width: 60px ; margin-bottom: 5px ;margin-top: 2px;}
button.larger {padding: 2px ; width: 240px ; margin-bottom: 5px ;margin-top: 2px;}

</style>
</head>

<body>



 <div class = "container-fluid">

<div class = "row">

  <div class = "col-sm-12 c">
    <h1 id = "title" >Find the Temple of Learning</h1>
  
 <h2 id = "distance"></h2>
 <h3 id = "instruction">Choose Easy, Medium or Hard</h3>


   <br>
 <label id = "question"></label> 

<input id = "answer" type = "text" >
<button id = "submit">Go</button>
<p id = "solution"></p>
<br>

<button id = "where">0</button>
<button id = "location"></button>
  </div></div>


<div class = "row">
<div class = "col-sm-12 c">
  
   <div id = "wrapper">
 <img src = "" id = "here" >

  <img src = "images/cat.png" id = "over">
   </div>
   


</div>
</div>

  <div class = "row">
  <div class = "col-sm-12 c">
    <br>



     <button id = "easy" class="btn btn-success btn-lg custom">Easy</button>  
     <button id = "medium" class="btn btn-danger btn-lg custom">Medium</button>
    <button id = "hard" class="btn btn-info btn-lg custom">Hard</button>
    </div></div> 

      <div class = "row">
  <div class = "col-sm-12 c">
    <br>
 <button id = "btn-north">North</button>
 <br>
 <button id = 'btn-west'>West</button>
    <button id = "btn-east">East</button>
      
      <br>
        <button id = "btn-south">South</button>
    </div></div> 


       <div class = "row">
  <div class = "col-sm-12 c" id = "grid">
  The journey
    </div></div> 
</div>



  


</body>
</html>

<script type="text/javascript">
function showQuestion(level,room) 
{
var m = getRandomInt(2,50) ;
var n = getRandomInt(500,1000) ;
var p = m*n ;

var question = '$ ' + m + 'x = ' + p + ', x = ' + '$' ;  
var answer = n ;
$('#solution').text(answer).show() ;
$('#answer').val('') ;


return question;

}

</script>

<script type="text/javascript">
  function drawGrid()
  {
 $('#grid').text('') ;   
$('#grid').append('<br>') ;
for (row = rows ; row >= 0 ; row--)
   {
    for (col = 1 ; col <= columns ; col++)
     { 
      pos = row * rows + col ;
      $('#grid').append(visited[pos]) ; 
 } 
   $('#grid').append('<br>') ;
  }

}
</script>


<script type="text/javascript">

function xyToN (x,y)
{
 
// alert(' x = ' + x + ' y = ' + y) ;
 var n = x + columns * (y-1) ;
 return n ; 
}


function distanceToTemple(player,temple)
{
var d = Math.abs(temple-player) ;
// get (x,y) of player
var py = Math.floor(player/columns) ;
var px = player % columns   ;

var ty = Math.floor(temple/columns) ;
var tx = temple % columns  

var steps = Math.floor(d/columns) + d % columns ;
return steps ;
}

</script>

<script type="text/javascript">
  
  function moveIt(index,position) 
  {

// alert('Position = ' + position ) ;
 var  positionX = (position-1) % columns + 1 ;
  var positionY = (position - positionX) / columns + 1;

   // alert(' posX ' + positionX + ' posY ' + positionY) ; 


// if (index == "Enter") {newPosition = 1 ; return newPosition ;}


if (index == 'North') { 

  positionY = positionY + 1  ;
if (positionY > rows) {positionY = rows; }}


if (index == 'South') {positionY = positionY - 1 ;
if (positionY <= 0) {positionY  = 1 ; }}

if (index == 'East') {positionX = positionX + 1 ;
if (positionX > columns) {positionX = columns ;} }

if (index == 'West') {positionX = positionX - 1 ;
if (positionX < 1 )  {positionX = 1 ;}}


newPosition = xyToN(positionX,positionY) ;

//if (newPosition % columns == 0){newPosition = position}
//if (newPosition % (columns + 1) == 0){newPosition = position}  

//if (newPosition > columns * rows - (columns  - 1)) {newPosition = position ;} 
// alert('New position ' + newPosition) ;
  return newPosition ;  
  }
</script>

<script type="text/javascript">
 $(document).ready(function(){
position = 0 ;
positionX = 0 ;
positionY = 0 ;
visited[0] = 0 ;
moves = 0 ;

drawGrid() ;

$('[id^=btn-]').hide() ;
// ${'#btn-enter'}.show() ;

//stepsX = Math.abs(positionX - placeX ) -1 ;
//stepsY =  Math.abs(positionY - placeY) - 1  ;
// alert(stepsX + ' ' + stepsY) ;
//steps = stepsX + stepsY + 1;
//message = 'There are ' + steps + ' steps to the temple' ;
//$('#distance').text(message) ;
//$('#distance').show() ;

$('#btn-easy').show() ;
$('#btn-medium').show() ;
$('#btn-hard').show() ;

$('#btn-north').hide() ;
$('#btn-south').hide() ; 
$('#btn-east').hide() ;
$('#btn-west').hide() ;

$('#question').hide() ;
$('#answer').hide() ;
$('#submit').hide() ;

$('#location').html(place).show() ;
$("#here").attr("src", image[position]);
// $('#location').hide() ;
$('#where').show() ;
var startInstruction = 'Choose Easy, Medium or Hard' ;
$('#instruction').html(startInstruction).show() ;
  
})
  </script>


<script type="text/javascript">

  $(document).ready(function(){
     
  $('#easy').on("click", function(event) {
  

    
    index = 1 ;
    level = 1 ;
    templeLocation = placeTemple(level) ;
    position = 1
    newPosition = 1 ;

    $('#where').text(newPosition) ;
// alert('position = ' + newPosition + image[newPosition]) ;
// alert('Index = ' + index) ;

$("#here").attr("src", image[newPosition]);
$('#here').show() ;  
messageGo = 'Give the correct answer. Then you can move' ;
$('#instruction').html(messageGo)
$('#question').show() ;
$('#answer').show() ;
$('#submit').show() ;

$('#easy').hide() ;
$('#medium').hide() ;
$('#hard').hide() ;

$('#btn-north').hide() ;
$('#btn-south').hide() ; 
$('#btn-east').hide() ;
$('#btn-west').hide() ;

// if question answered
q = showQuestion(level,newPosition) ;

$('#question').html(q).show()  ;
  MathJax.Hub.Queue(["Typeset", MathJax.Hub, "question"]);


  newPosition = moveIt(index,position) ;
steps = distanceToTemple(newPosition,templeLocation) ;

if (steps == 0) 
{message = 'Well done! You have found rhe Temple of Learning' ;
$('#question').hide() ;
$('#answer').hide() ;
$('#submit').hide() ;
}
else {message = 'There are ' + steps + ' steps to the temple' ;}
$('#distance').text(message) ;

// alert('Moving to ' + newPosition) ;
visited[1] = steps ;
drawGrid() ;

 $('#where').text(newPosition) ;      
 // alert(' Moved to ' + position) ;

  })

})
  
</script>




<script type="text/javascript">

  $(document).ready(function(){
     
  $('[id^=btn-]').on("click", function(event) {
  
    var index = $(this).text() ;
// alert('position = ' + position) ;
// alert('Index = ' + index) ;
q = showQuestion(level,newPosition) ;

$('#question').html(q).show()  ;
  MathJax.Hub.Queue(["Typeset", MathJax.Hub, "question"]);
$('#submit').show() ;


// if question answered

$('#btn-north').hide() ;
$('#btn-south').hide() ; 
$('#btn-east').hide() ;
$('#btn-west').hide() ;




  newPosition = moveIt(index,position) ;

 steps = distanceToTemple(newPosition,templeLocation) ;
if (steps == 0) 
{message = 'Well done! You have found rhe Temple of Learning' ;
$('#question').hide() ;
$('#answer').hide() ;
$('#submit').hide() ;}
else {message = 'There are ' + steps + ' steps to the temple' ;}
$('#distance').text(message) ;


// alert('Moving to ' + newPosition) ;
$("#here").attr("src", image[newPosition]);
       position = newPosition ;

 $('#where').text(position) ;      
  alert(' Moved to ' + position) ;
  visited[position] = steps ;
drawGrid() ;

  })

})
  
</script>

<script type="text/javascript">
   $(document).ready(function(){
  

$( "#submit" ).click(function() {
  
  alert('Checking') ;
  myAnswer = $('#answer').val() ;
  myAnswer = parseInt(myAnswer) ;
  mySolution = $('#solution').text() ;
 // mySolution = parseInt(mySolution) ;

  if (myAnswer == mySolution) {

alert('Correct answer - travel on') ;

$('#btn-north').show() ;
$('#btn-south').show() ; 
$('#btn-east').show() ;
$('#btn-west').show() ;

$('#submit').hide() ;
$('#question').hide() ;
$('#answer').text('') ;


} else {alert('Try again') ;}

 // alert('My answer = ' + myAnswer) ;

})

})

</script>



