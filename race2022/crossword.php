<!DOCTYPE html>
<html lang="en">
  <head>
 

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../bootstrap-5.0.2-dist/css/bootstrap.min.css">
  <script src="../javaScript/jQuery/jquery-3.3.1.min.js"></script>
  <script src="../bootStrap/bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    
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
    <title>Cross word 3x3 v2</title>

<style type="text/css">

 
#theClues {font-size: 10pt;}



  [id^=grid]{
              width: 50px ; 
              height: 50px; 
              background-color: lightblue;
              color: black;
              font-size: 1.2em;
              text-align: center;
              vertical-align: center;
              font-weight: bolder;
              margin: 0px;
            }



#message {text-align: center; font-size: 3vw; ; color:green;}

img {display: inline-block;}
input {width: 50px ; height: 50px; display: inline-block; text-align: center; text-transform:uppercase;}
	div {display: inline-block;}

.wrapper{
  margin:0 ;
 
 width: 50px ; height: 50px;
  position:relative;


}
[id^=num] {
  width:20px;
  line-height:20px;
  font-size: 10pt;
  color:black;
  
  position:absolute;

  left:0.31em;
  top:0;
}


.c {text-align: center;}
</style>

</head>

<body>

   <div class  = "container-fluid">
      <div class = "row">
        <div class = "col-sm-12 c">
   <h1><img id = "pio1" src = "images/dragon1.jpeg" width = "auto" height = "auto">
Solve the Puzzle
   <img id = "pio2" src = "images/dragon2.png" width = "50px" height = "auto">
 </h1>
</div></div>
<div class = "row">
  <div class = "col-sm-12 c">
<a href="index.php" >

     <button id = "home" class="btn btn-info btn-sm">Home</button>
     </a>

  <a href="crossnumberv2.html" >
      
        <button id = "retry" class="btn btn-info btn-sm">Clear</button>
     </a>

       <button id = "check">Check</button>
  </div></div>


<div class = "row">
  <div class = "col-sm c">
   <p id = "messageGame"></p>
    </div></div>

<!-- menu grid  -->
<?php include "crosswordGrid10x10.html"; ?>

</div> <!-- game -->


<!-- top left = (0,) and bottom right = (3,3)  -->

<div class = "row">
  <div class = "col-sm c">
    <p id = "message"></p>
    </div></div>



<div class = "row">
<div class = "col-sm c">

</div></div>

<div class = "row">
<div class = "col-sm c">

 
</div></div>



<div class = "row">
<div class = "col-sm c">
<h2 class = "text-center">Clues</h2>
</div></div>

<div class = "row">
  <div class = "col-2"></div>
<div class = "col-4 text-center"><b>Across</b></div>
<div class = "col-4 text-center"><b>Down</b></div>
  <div class = "col-2"></div>

</div>

<div class = "row">
    <div class = "col-2"></div>
<div class = "col-4">
  <label id = "1A">1. This is _ _ book.</label>
  <br>
  <label id = "3A">3. The _ _ _ is yellow.</label>
  <br>

</div>
<div class = "col-4">
<label id = "2D"> 2. How are  _ _ _? </label>
  <br>
 
</div>
  <div class = "col-2"></div>
</div>
  
</div> <!-- container -->
  
</body>
</html>


<script>

function initialise()
{

  $('[id^=grid]').empty() ;
answer = [];
answer[1] = "MY-";
answer[2] = "-O-" ;
answer[3] = "SUN" ;



across = [] ;
across[1] = ["grid11","grid12"] ;
across[3] = ["grid31","grid32","grid33"] ;
down = [] ;
down[2] = ["grid12","grid22","grid32"];


blanks =["13","21","23"];

for (var i = 0; i < blanks.length; i++)
{
  $('#grid' + blanks[i]).prop('disabled', true).css({"background-color":"black","color":"black"}).val("-") ;
}




}

</script>

<script> 

  $(document).ready(function(){

    initialise();
  
    $('#game').show();

    })

</script>


<script> 

  $(document).ready(function(){
      $('label').click(function(){

        $('label').css({"background-color":"white"});
        $('[id^=grid').css({"background-color":"lightblue"});
        for (var i = 0; i < blanks.length; i++)
{
  $('#grid' + blanks[i]).prop('disabled', true).css({"background-color":"black","color":"black"}).val("-") ;
}

        var clicked = this.id ;
        alert(clicked);

        $('#' + clicked).css({"background-color":"lightblue"});

        // get number and letter;

        var l = clicked.length ;
        var letter = clicked[l-1] ;
        var number = parseInt(clicked.substring(0,l-1));
        var cells = [] ;
        alert(clicked + " " + letter + " " + number);
        if (letter == "D")
            {
                console.log(down[number]);
                cells = down[number];
                console.log(cells) ;
                for (var i = 0 ; i < down[number].length ; i++)
                {
                    $('#' + cells[i]).css({"background-color":"lightgreen"});
                }
            }


if (letter == "A")
            {
                console.log(across[number]);
                cells = across[number];
                console.log(cells) ;
                for (var i = 0 ; i < across[number].length ; i++)
                {
                    $('#' + cells[i]).css({"background-color":"lightgreen"});
                }
            }
$('#' + cells[0]).focus();


})
})


</script>



<script> 

$(document).ready(function(){



// $('#grid13').prop('disabled', true).css({"background-color":"grey","color":"black"}).empty() ;
// $('#grid21').prop('disabled', true).css({"background-color":"grey","color":"black"}).empty() ;
initialise() ;

    })

</script> 

<script>
    $(document).ready(function(){
$(':input').on('blur', function() {

    focused = this.id ;
 //   console.log("input focus",focused) ;
 

})
    })
</script>



<script>
    $(document).ready(function(){
$(':input').on('click', function() {

   var focused = this.id ;
   var value = $('#' + focused).val();
    console.log('input value when clicked',focused, value) ;
    $('#key-' + value).prop('disabled', false);
    // .css({"background-color":"green","color":"white"})
    target = focused ;
    $('#' + focused).val('') ;
    // change stae of number key for value 

 

})
    })
</script>

<script>
$(document).ready(function(){

    $("[id^=key-]").click(function(){
    clicked = $(this).attr("id"); // get id of the key 
    clickedNumber = parseInt(clicked.substr(4));  // remove key-

//console.log("clicked number",clicked,clickedNumber) ;
    $('#'+target).val(clickedNumber) ;
  //  alert("focused is now " + target) ;
    var lastChar = focused.substr(-1) ;

    
      if ( focused != "")
      { 
        $('#'+focused).val(clickedNumber);  // update input box
   //    alert(clickedNumber + focused) ;
   // var n = focused.charAt(focused.length-1); // get position of focused ID
  
     //   console.log("Update = ",clickedNumber);
    //    console.log("key",clicked,clickedNumber,focused,lastChar);
      //  $('#key-'+clickedNumber).prop('disabled', true).css({"background-color":"pink","color":"red"}) ;
     
      }
    


})
})

</script>

<script>
$(document).ready(function(){

    $("#check").click(function(){

      alert("Checking");
      console.log("Checking");

      var guess = [] ;


  guess[1] = $('#grid1' + 1).val() + $('#grid1' + 2).val() + $('#grid1' + 3).val() ;
  guess[2] = $('#grid2' + 1).val() + $('#grid2' + 2).val() + $('#grid2' + 3).val() ;
  guess[3] = $('#grid3' + 1).val() + $('#grid3' + 2).val() + $('#grid3' + 3).val() ;

guess[1] = guess[1].toUpperCase() ;
guess[2] = guess[2].toUpperCase() ;
guess[3] = guess[3].toUpperCase() ;

console.log(guess[1],answer[1],guess[1] == answer[1]);
console.log(guess[2],answer[2],guess[2] == answer[2]);
console.log(guess[3],answer[3],guess[3] == answer[3]);

var result = guess[1] == answer[1] & guess[2] == answer[2] & guess[3] == answer[3]; 
      
if (!result) 
  {alert("keep trying.");} 
else {
  alert('You win');
}

      })
  })

</script>


