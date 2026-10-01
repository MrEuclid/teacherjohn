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
    <title>Cross word 5x5 php v2</title>

<style type="text/css">

 
label {font-size: 1em; font-weight:bolder; color:blue;}



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

  <a href="crossnumberv2.php" >
      
        <button id = "retry" class="btn btn-info btn-sm">Clear</button>
     </a>

       <button id = "check">Check</button>
  </div></div>


<div class = "row">
  <div class = "col-sm c">
   <p id = "messageGame"></p>
    </div></div>

<!-- menu grid  -->
<?php include "crosswordGrid5x5.html"; ?>

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
  <label id = "1A"></label>
  <br>
  <label id = "2A"></label>
  <br>

  <label id = "3A"></label>
  <br>

  <label id = "4A"></label>
  <br>

  <label id = "5A"></label>
  <br>

</div>
<div class = "col-4">
<label id = "1D"></label>
<br>
<label id = "2D"></label>
<br>
<label id = "3D"></label>
<be>
<label id = "4D"></label>
<br>
<label id = "5D"></label>
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

  // load grid with answers line by line

  // and load+

  $('[id^=grid]').empty() ;
lines = [];



// loaded from file



if (puzzleNumber == 1)
{

lines = [] ;

lines[0] = "WHITE";
lines[1] = "I--O-" ;
lines[2] = "NAME-" ;
lines[3] = "D--SO" ;
lines[4] = "YOU-N" ;

wordsAcross  = ["WHITE","NAME","SO","YOU"] ;
wordsDown = ["WINDY","TOES","ON"] ;

questionsAcross = [] ;
questionsAcross[1] = "The book has _ _ _ _ _ pages.";
questionsAcross[2] = "My mother's _ _ _ _ is Tida.";
questionsAcross[3] = "It is _ _ hot today!";
questionsAcross[4] = "What are _ _ _ doing?";

questionsDown = [] ;
questionsDown[1] = "Today it is very _ _ _ _ _.";
questionsDown[2] = "My foot has five _ _ _ _ _.";
questionsDown[3] = "I am sititng _ _ a chair.";

console.log("Puzzle 1 ",lines);

}

if (puzzleNumber == 2)
{

lines = [] ;

lines[0] = "WRITE";
lines[1] = "-I-I-" ;
lines[2] = "-V-M-" ;
lines[3] = "-EYES" ;
lines[4] = "OR---" ;

wordsAcross  = ["WRITE","EYE","OR"] ;
wordsDown = ["RIVER","TIME"] ;

questionsAcross = [] ;
questionsAcross[1] = "I _ _ _ _ _ in my book.";
questionsAcross[2] = "I see with my _ _ _ _.";
questionsAcross[3] = "Do I go left _ _ right?";


questionsDown = [] ;
questionsDown[1] = "The fish live in the _ _ _ _ _.";
questionsDown[2] = "What's the _ _ _ _?";


console.log("Puzzle 2 ",lines);

}


if (puzzleNumber == 3)
{

lines = [] ;

lines[0] = "APPLE";
lines[1] = "F--E-" ;
lines[2] = "TO-S-" ;
lines[3] = "E--SO" ;
lines[4] = "RED-F" ;

wordsAcross  = ["APPLE","TO","SO","RED"] ;
wordsDown = ["AFTER","LESS","OF"] ;

questionsAcross = [] ;
questionsAcross[1] = "That is an _ _ _ _ _ tree.";
questionsAcross[2] = "Where are you going _ _?";
questionsAcross[3] = "The test is _ _ hard!";
questionsAcross[4] = "The fire engine is _ _ _.";



questionsDown = [] ;
questionsDown[1] = "What do you do _ _ _ _ _ school?";
questionsDown[2] = "It is _ _ _ _ hot than yesterday?";
questionsDown[3] = "Who is the teacher _ _ that class?";


console.log("Puzzle 3 ",lines);

}


var l = questionsAcross.length ; 
for (var i = 1 ; i < l ; i++)
{
    $('#' + i + 'A').text(i + " " + questionsAcross[i]).show() ;
}

var m = questionsDown.length ; 
for (var i = 1 ; i < m ; i++)
{
    $('#' + i + 'D').text(i + " " + questionsDown[i]).show() ;
}



questionsDown = [] ;

var rows = lines.length ;
var columns = lines[0].length ;

across = [] ;
down   = [] ;

// pushed in from file


var acrossN = wordsAcross.length ;
var downN = wordsDown.length ;


// locate words across

for (var i = 0 ; i < wordsAcross.length ; i++)  // each of the across words
{
   var found = false ;
   var rowNumber = 0;
   var colNumber = 0 ;  // start of word
   while (found == false & rowNumber < rows)   // walk down the rows
    {
        colNumber = lines[rowNumber].indexOf(wordsAcross[i]);   // find index of wordsAcross[i] in line i
        if (colNumber >= 0)   // if found the start position at row i, column where
        {
            found = true; 
            
             var l = wordsAcross[i].length ;   // l length of target word
            console.log("found word",wordsAcross[i],rowNumber,colNumber,"grid"+ rowNumber + colNumber,l);
            // get grid position of wordsAcross[i]
            
            across[i] = [] ;  // initialise across[i]

            for (var k = 0 ; k < l ; k++)   // for length of word
            {
                var position = "grid" + rowNumber  + parseInt(colNumber +k) ;
                across[i].push(position);
            }
            console.log(i,across[i]);
            
        }

        rowNumber++ ;
    }
}



wordColumns = [] ;



for (var c = 0 ; c < columns ; c++)
{
    wordColumns[c] = [];
    var word = "";
    for (var r = 0 ; r < rows; r++)
    {
        // need column 0 for all lines , then column 2 etc
        var t = lines[r];
        var letter = t[c]
        word +=  letter
    }
    wordColumns[c] = word;
}
console.log("Word columns ") ;
console.log(wordColumns) ;

// locate down words
down = [] ;


for (var i = 0 ; i < wordsDown.length ; i++)  // each of the down words
{
   var found = false ;
   var rowNumber = 0;
   var colNumber = 0 ;  // start of word
   while (found == false & colNumber < columns)   // walk across the columns
    {
        rowNumber = wordColumns[colNumber].indexOf(wordsDown[i]);   // find index of wordsDown[i] in column 
        if (rowNumber >= 0)   // if found the start position at  colNumber, rowNumber 
        {
            found = true; 
            
             var l = wordsDown[i].length ;   // l length of target word
            console.log("found word",wordsDown[i],rowNumber,colNumber,"grid"+ rowNumber + colNumber,l);
            // get grid position of wordsDown[i]
            
            down[i] = [] ;  // initialise across[i]

            for (var k = 0 ; k < l ; k++)   // for length of word
            {
                var position = "grid" + parseInt(rowNumber +k) + colNumber;
                down[i].push(position);
            }
            console.log(i,down[i]);
            
        }

        colNumber++ ;
    }
}





console.log("Across") ;
console.log(across);
console.log("Down");
console.log(down);



// get blanks
blanks = [] ;
for (var r = 0; r <= 4 ; r++)
{
    var t = [] ;
    for (var c = 0 ; c <= 4 ; c++)
    {
        t = lines[r];

        if (t[c] == '-')
        {
            blanks.push("grid" + r + c );
        //    console.log(blanks);
        }

        else
        {
          //  $("#grid" + r + c ).val(t[c]);
        }
        
    } 

    
}

for (var i = 0; i < blanks.length; i++)
{
  $('#' + blanks[i]).prop('disabled', true).css({"background-color":"black","color":"black"}).val("-") ;
}


console.log("blanks",blanks);




}

</script>

<script> 

  $(document).ready(function(){

// grid size
  puzzleNumber = 3;

// hide lablels 

$('label').hide() ;
  
  
    $('#game').show();

    })

</script>


<script> 

  $(document).ready(function(){
      $('label').click(function(){

        $('label').css({"background-color":"white"});
        $('[id^=grid]').css({"background-color":"lightblue"});
        for (var i = 0; i < blanks.length; i++)
{
  $('#' + blanks[i]).prop('disabled', true).css({"background-color":"black","color":"black"}).val("-") ;
}

        var clicked = this.id ;
        console.log("clicked",clicked);

        $('#' + clicked).css({"background-color":"lightblue"});

        // get number and letter;

        var l = clicked.length ;
        var letter = clicked[l-1] ;
        var number = parseInt(clicked.substring(0,l-1));
        number = number - 1 ; // starting from 0
        var cells = [] ;
        console.log(clicked,letter,number);
        if (letter == "D")
            {
             
              console.log("D",letter,number,down[number])  ; 
                t = down[number];
                console.log("t",t) ;
                for (var i = 0 ; i < down[number].length ; i++)
                {
                    $('#' + t[i]).css({"background-color":"lightgreen"});
                }
                $('#' + t[0]).focus();
            }


if (letter == "A")
            {
                
             console.log("A",letter,number,across[number])  ; 
            
                t = across[number];
                console.log("t",t);
                for (var i = 0 ; i < across[number].length ; i++)
                {
                    
                  $('#' + t[i]).css({"background-color":"lightgreen"});
                }
                $('#' + t[0]).focus();
            }



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

    $("input").attr("maxlength", 1) ; // this can't be done with CSS

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

   //   alert("Checking");
      console.log("Checking");
    var result = true;
    var lost = false;
    var guess = [] ;
   rows = lines.length;

   for (var r = 0; r < rows; r++)

   {
    guess[r] = "";
    for (c = 0 ; c <= 4 ; c++)
  {
    guess[r] +=  $('#grid' + r + c).val();
    guess[r] = guess[r].toUpperCase() 
 
  }
    result =  (guess[r] == lines[r]);
    if (guess[r] !== lines[r]) 
    {
      lost = true; 
   //    alert(r + " " + guess[r] + " " + lines[r] + " " + result + " lost " + lost) ;
      }
  
  console.log("guess",r,c,guess[r],lines[r],lines[r] == guess[r],lost,result) ;
 

   }
  
if (lost == true) 
  {alert("keep trying.");} 
else {
  alert('You win');
}

      })
  })

</script>


