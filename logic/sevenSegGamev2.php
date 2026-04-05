<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="refresh" content="600">
  <title>seven segment game</title>
<!--
    Multi level games
    start with all red or with n green
    players logon with id
    results go into tables - id,moves,time,total moves
    leader board with list and graph
-->
    <meta charset="utf-8">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- bootstrap loaded from server for intranet for better loading speed -->
 <link rel="stylesheet" href="javaScript/bootStrap/bootstrap-3.3.7-dist/css/bootstrap.min.css">
  <script src="javaScript/jQuery/jquery-3.3.1.min.js"></script>


  <script src="javaScript/jquery-ui-1.12.1.custom/jquery-ui.js"></script>

    <link rel = "stylesheet" href  = "css/pioStudentsStyles.css">

  <style>

.r {text-align: right;}
.c {text-align: center;}

.horizontal {
    height : 30px ;
    width: 90px;
   margin-top: 2px;
   margin-bottom: 2px ;
   margin-left: 0px;
    margin-right: 0% ;
  
}

.vertical {
    height : 100px ;
    width: 30px;
    margin-left: 25px ;
    margin-right: 25px ;
  
}

hr {margin:10px; color:blue;}

p {text-align:center ; font-size:14pt ; font-weight:bold ; color:blue ; }

.on {color:black ; background-color: chartreuse;}
.off {color:white; background-color: red;}

</style>

</head>

<body>

    <div class="container">
        <div class="row">
        <div class="col-12 c">
            <h1 class = "c">Make them Green</h1>
        </div></div>
<div id = "registration">


</div>

<div id = "menu">
<div class = "row">
            <div class = "col-12 c">
            <a href = "index.php"><button  class="btn btn-primary btn-lg ">Home</button></a>
    <a href = "sevenSegGamev2.php"><button  class="btn btn-success btn-lg ">New</button></a>

</div>
<div class = "row">
            <div class = "col-12 c">
            <hr>
</div></div>


<div id = "gameLevels">
<div class = "row">
            <div class = "col-12 c">
            <button id = "level0" class="btn btn-danger btn-lg ">Level 1</button>
            <button id = "level1" class="btn btn-warning btn-lg ">Level 2</button>
            <button id = "level2" class="btn btn-success btn-lg ">Level 3</button>
            <button id = "level3" class="btn btn-info btn-lg ">Level 4</button>
            <button id = "level4" class="btn btn-primary btn-lg ">Level 5</button>
            <button id = "level5" class="btn btn-success btn-lg ">Level 6</button>
</div>
<div class = "row">
            <div class = "col-12 c">
            <hr>
</div></div>
    <div id = "puzzles">
        <!-- create a grade and then hide / show buttons for each level as required -->
        <div class = "row">
            <div class = "col-12 c">

            <button id = "btn1" class = "horizontal c">1</button>
            <button id = "btn2" class = "horizontal c">2</button>
            <button id = "btn3" class = "horizontal c">3</button>

           </div>
        </div>  <!-- row 1 --> 

        <div class = "row">
            <div class = "col-12 c">
            
            <button id = "btn4" class = "vertical c">4</button>
            <button id = "btn5" class = "vertical c">5</button>
            <button id = "btn6" class = "vertical c">6</button>
            <button id = "btn7" class = "vertical c">7</button>

            </div>
        </div> <!-- row 2 -->

        <div class = "row">
            <div class = "col-12 c">

            <button id = "btn8" class = "horizontal c">8</button>
            <button id = "btn9" class = "horizontal c">9</button>
            <button id = "btn10" class = "horizontal c">10</button>

           </div>
        </div>  <!-- row 3 --> 

        <div class = "row">
            <div class = "col-12 c">
            
            <button id = "btn11" class = "vertical">11</button>
            <button id = "btn12" class = "vertical">12</button>
            <button id = "btn13" class = "vertical">13</button>
            <button id = "btn14" class = "vertical">14</button>

            </div>
        </div> <!-- row 4 -->

        <div class = "row">
            <div class = "col-12 c">

            <button id = "btn15" class = "horizontal c">15</button>
            <button id = "btn16" class = "horizontal c">16</button>
            <button id = "btn17" class = "horizontal c">17</button>

           </div>
        </div>  <!-- row 5 --> 

        <div class = "row">
            <div class = "col-12 c">
            
            <button id = "btn18" class = "vertical">18</button>
            <button id = "btn19" class = "vertical">19</button>
            <button id = "btn20" class = "vertical">20</button>
            <button id = "btn21" class = "vertical">21</button>

            </div>

        </div> <!-- row 6 -->

        <div class = "row">
            <div class = "col-12 c">

            <button id = "btn22" class = "horizontal c">22</button>
            <button id = "btn23" class = "horizontal c">23</button>
            <button id = "btn24" class = "horizontal c">24</button>

           </div>
        </div>  <!-- row 7 --> 

    </div>  <!-- puzzles -->
<p id = "results"></p>
    </div> <!-- container -->
</body>
</html>

<script>
  $(document).ready(function() {

$('#registration').show() ;
$('#puzzles').show() ;
$('[id^=btn]').addClass("off");
$('[id^=btn]').prop('disabled', true);
$('[id^=level]').prop('disabled', true);
$('#level0').prop('disabled', false);
levels = [[1,4,5,8],
          [1,2,4,5,6,8,9],
          [1,2,3,4,5,6,7,8,9,10],
          [1,2,4,5,6,8,9,11,12,13,15,16],
          [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17],
        [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24]
        ] ;  // buttons used at each level
  
connections = [[0,0],
                [2,4,5],
                [1,3,5,6],
                [2,6,7],
                [1,8,11],
                [1,2,8,9],
                [2,3,9,10],
                [3,10,14],
                [4,5,9,11,12] ,   
                [5,6,8,10,12,13]  ,
                [6,7,9,10,13,14]  ,
                [4,8,15,18]  ,
                [5,8,9,15,16,19] ,
                [9,10,16,17] ,
                [7,10,17,21],
                [11,12,16,18,19], 
                [12,13,15,17,19,20] , 
                [13,14,16,20,21], 
                [11,15,22] ,
                [12,15,16,22,23],
                [13,16,17,23,24]  ,
                [14,17,24]  ,
                [18,19,23],
                [19,20,22,24],
                [20,21,23]];  // [0,0] to adjst for numbering of btns from 1 - 4 


states = [];
links = [] ;
moves = 0 ; //moves per game 
for (var i = 0;i <= 24;i++)    
{
  states[i] = 0;  // all are off
}            

$('[id^=btn]').addClass("off");
    
  })
  </script>


<script>
  $(document).ready(function() {
    $('[id^=level]').on('click', function(){
      for (var i = 0;i <= 24;i++)    
{
  states[i] = 0;  // all are off
}    

$('#results').empty() ;
moves = 0 ;

$('[id^=btn]').addClass("off") ;
var clicked;
clicked = this.id ;
// alert(clicked.substr(5)) ;
play = parseInt(clicked.substr(5));  // game level
// alert(play + levels[play]) ;
$('[id^=btn]').hide() ;

// enable active buttons for this level 
for (var i = 0 ; i < levels[play].length; i++)
{
$('#btn' + levels[play][i]).show().prop("disabled",false) ;
}



    })

  })

</script>

<script>



</script>

<script>
  $(document).ready(function() {
    $('[id^=btn]').on('click', function(){
var clicked ;
clicked = this.id ;
$('#results').append()
var index = parseInt(clicked.substr(3,4));
$('#results').append(index + "*") ;
moves = moves + 1;
if (moves % 25 == 0 & moves > 0) {$('#results').append("<br>") ;}
// alert("clicked " + clicked + " " + index);
 links = connections[index] ; 

// alert(links) ;

  var clickedState = states[index] ;
  if (clickedState == 0)
  {
    $('#btn'+index).removeClass("off") ; 
    $('#btn'+index).addClass("on")
  }
  else 
  {
    $('#btn'+index).removeClass("on").addClass("off") ; ;
  }

// update states
states[index] = !states[index] ;

// now work with the buttons connected to btn +index
  for (var i = 0 ; i < links.length ; i++)
{ 
  if (states[links[i]]  == 0)
  {
    $('#btn'+links[i]).removeClass("off").addClass("on") ; ;
  }
  else 
  {
    $('#btn'+links[i]).removeClass("on").addClass("off") ; ;
  }
states[links[i]] = !states[links[i]] ;
}

// check if level completed
console.log("status",play,levels[play])
console.log("states",states);

var finished = true ;

// check if all buttons for this are on level 
 for (var i = 0 ;i < levels[play].length; i++)
{
if (states[levels[play][i]] == 0) 
{finished = false ;
console.log("testing",i,levels[play][i]);
}
}
console.log("Over",finished) ;

if (finished == true) 
{
  $("#results").append('<br>' + 'You won in ' + moves + " moves") ;
  $('#level' + play).prop("disabled",true) ;
  $('#level' + parseInt(play+1)).prop("disabled",false) ;
  // alert("Play " + play + " finished") ;
}

    })
  })
  </script>
