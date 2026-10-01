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

<style type="text/css">

  #tens,#units {
              width: 8vw ; 
              height: 8vw; 
              background-color: lightblue;
              color: black;
              font-size: 3vw;
              text-align: center;
              vertical-align: center;
              font-weight: bolder;
              margin: 4vw;
            }


  [id^=moves]{
              width: 8vw ; 
              height: 8vw; 
              background-color: lightblue;
              color: black;
              font-size: 3vw;
              text-align: center;
              vertical-align: center;
              font-weight: bolder;
              margin: 1vw;
            }

  [id^=menu]{
              width: 8vw ; 
              height: 8vw; 
              background-color: lightgreen;
              color: black;
              font-size: 3vw;
              text-align: center;
              vertical-align: center;
              font-weight: bolder;
              margin: 1vw;
            }

#attempt{
              width: 20vw ; 
              height: 10vw; 
              background-color: lightyellow;
              color: black;
              font-size: 3vw;
              text-align: center;
              font-weight: bolder;
            
            }


 #guess {
              width: 15vw ; 
              height: 10vw; 
              background-color: lightgrey;
              color: black;
              font-size: 2vw;
              text-align: center;
              font-weight: bolder;
            
            }

#message {text-align: center; font-size: 3vw; ; color:green;}

img {display: inline-block;}


</style>

</head>

<body>

   <div class  = "container-fluid">
      <div class = "row">
        <div class = "col-sm-12 c">
   <h1><img id = "pio1" src = "images/dragon1.jpeg" width = "auto" height = "auto">
Guess the Number - it is between 10 and 99
  
 </h1>
</div></div>
<div class = "row">
  <div class = "col-sm-12 c">

  

  </div></div>

<div id = "game">
<div class = "row">
  <div class = "col-sm c">
   <p id = "messageGame"></p>
    </div></div>

</div> <!-- game -->

<div id = "unlock">
<!-- top left = (0,) and bottom right = (3,3)  -->

<div class = "row">
  <div class = "col-sm c">
    <p id = "message"></p>
    </div></div>

<!-- grd-row-column -->
<div class = "row">
<div class = "col-sm c">
  <button id = "tens" class = "digit"></button>
   <button id = "units" class = "digit"></button>

</div></div>

<div class = "row">
<div class = "col-sm c">

  <input id = "attempt" type = "number" min="10" max="99">
  <button id = "guess">Guess</button>
 
 
</div></div>

<div class = "row">
<div class = "col-sm c">

 
  <button id = "moves1"></button>
  <button id = "moves2"></button>
   <button id = "moves3"></button>
    <button id = "moves4"></button>
     <button id = "moves5"></button>
      <button id = "moves6"></button>
       <button id = "moves7"></button>
 
</div></div>



</div> <!-- unlock -->
  
</div> <!-- container -->
  
</body>
</html>

<script>

  function newGame()
  {
 
   tries = 0 ;

  // set places[x,y] = 0 
  // enable all squares
  
  }



</script>

<script>

function randomIntFromInterval(min, max) { // min and max included 
  return Math.floor(Math.random() * (max - min + 1) + min)
}

</script>
<script>
function initialise()
{
$('#attempt').val(50);
tries = 0 ;
$('#message').text("You have 8 moves to find the number.");
$('#attempt').val(50);
// $('[id^=moves]').hide();

  $('[id^=grd]').text("?");
  $('[id^=moves]').empty() ;

  tens = randomIntFromInterval(1,9);
  units = randomIntFromInterval(0,9);

  console.log(tens,units);
  number = parseInt(tens*10 + units);
  console.log(number,tens,units);

}

</script>

<script> 

  $(document).ready(function(){

    question = '<?php echo $question; ?>' ;
    points = question.substr(-1);

    initialise();
    $('#unlock').show() ;
    $('#game').hide();

    })

</script>


<script> 

  $(document).ready(function(){
      $('#guess').click(function(){

  var choice = $('#attempt').val();
  $('#message').text("");

console.log("Choice",choice,"Number",number,"Tries",tries);

  var t = Math.floor(choice/10);
  var u = choice % 10 ;

  if (choice > 99 | choice < 10) {alert("The Number is between 10 and 99.");  $('#attempt').val(""); }
else
{
tries++ ;

  if (choice < number) {$('.digit').css("background-color","yellow") ;  
  // alert("Low");
  $('#message').text("Too small!");}
    if (choice > number) {$('.digit').css("background-color","orange") ; 
    $('#message').text("Too big!");
  //   alert("High");
  }
  
      if (choice ==  number) {$('.digit').css({"background-color":"green","color":"yellow"}) ;}
  $('#tens').text(t);
  $('#units').text(u);
  $('#moves' + tries).text(choice);
   if (choice < number) 
    { $('#moves' + tries).css("background-color","yellow") ;  
     
    }

    if (choice > number) 
      {
        $('#moves' + tries).css("background-color","orange") ;
        
      }

     if (choice ==  number & tries < 8) 
      { 
        $('#moves' + tries).css("background-color","green").css("color","yellow") ; 
      //  $('#messageGame').text("Welcome to the Game!");

      $('#victory').text("You win!").show();
   
      $('#send').hide();
      $('#clear').hide();

      processWin(questionID);

/*
     var pts = parseInt($('#total').text());
     pts = parseInt(pts);
     points = parseInt(points) ;
     console.log("points",pts);
     pts = parseInt(pts + points);
     console.log("points",pts);
     $('#total').text(pts);
alert("You have opened the door!");
    $('#menu').show();
  

     $('#play').empty().show();
     $('#q1').prop('disabled',true).css({"background-color":"blue","color":"yellow"});
     $('#q1').text(number);
      
   var t = team.split("*");
    var teamName = t[1];
    var grade = t[0] ;
    var score = $('#total').text() ;
    var timer = $('#timer').text() ;

     console.log("output",teamName,score,timer,grade,question,questionID);
    updateDatabase(teamName,score,timer,question,grade,questionID);

*/
     
      }

  if (tries > 8) {initialise();}
  console.log("Tries",tries,choice == number);


}


})
})


</script>



<script> 

$(document).ready(function(){


initialise() ;

    })

</script> 


  <script type="text/javascript">
  
    $(document).ready(function(){
    $('#exit').on('click', function()

{


var data = localStorage.getItem("teamName");
alert(data);

 $('#menu').show() ;
 $('#title').hide();
 $('#play').hide();
 $('#q1').prop('disabled',true).css({"background-color":"lightblue","color":"red"});

  })
  })


</script>


<script type="text/javascript">
  
    $(document).ready(function(){
    $('#retry').on('click', function()
  {


  


    $('#menu').hide() ;
    $('#play').show() ;
    var value = $('#q1').text();
   $('#play').load("openTheDoor.php",{question: value}) ;

  })
  })


</script>
