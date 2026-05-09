<!DOCTYPE html>
<html lang="en">
  <head>
 
 
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"></script>
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



    <meta charset="utf-8">
    
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>Cross word 5x5 php </title>

<style type="text/css">

 
label {font-size: 1em; font-weight:bolder; color:blue;}

#home , #retry , #check {font-size:1.2em ; font-weight:bolder;}

  [id^=grid]{
              width: 50px ; 
              height: 50px; 
              background-color: lightblue;
              color: black;
              font-size: 1.2em;
              text-align: center;
              vertical-align: center;
              font-weight: bolder;
              margin-right: 1px;
              margin-bottom: 1px;
            }

[id^=puzzle] {
  color:black; 
  background-color:pink; 
  font-weight:bolder ; 
  font-size:1.2em; 
  width:40px ; 
  height:40px;
  margin-top:10px;
  padding-bottom:5px;

}

#message {text-align: center; font-size: 3vw; ; color:green;}

img {display: inline-block;}
input {width: 50px ; height: 50px; display: inline-block; text-align: center; text-transform:uppercase;}
	div {display: inline-block;}

.wrapper{
  margin:2px ;
 
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

.crossnumber {background-color:blue; color:white;}

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
<a href="../index.php" >

     <button id = "home" class="btn btn-info btn-sm">Home</button>
     </a>
        <button id = "retry" class="btn btn-success btn-sm">Clear</button>
       <button id = "check" class="btn btn-warning btn-sm">Check</button>
  </div></div>
  <div class = "row">
  <div class = "col-sm c">
  <button id = "puzzle-1">1</button>
  <button id = "puzzle-2">2</button>
  <button id = "puzzle-3">3</button>
  <button id = "puzzle-4">4</button>
  <button id = "puzzle-5">5</button>
  <button id = "puzzle-6">6</button>
  <button id = "puzzle-7">7</button>
  <button id = "puzzle-8">8</button>
  <button id = "puzzle-9">9</button>
  <button id = "puzzle-10">10</button>
   <button id = "puzzle-11">11</button>
  <button id = "puzzle-12">12</button>
  <button id = "puzzle-13">13</button>
  <button id = "puzzle-14">14</button>  
  <button id = "puzzle-15">15</button> 
   <button id = "puzzle-16">16</button> 
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
<h2 class = "text-center" id = "message1">Find the Correct Words</h2>
</div></div>

<div class = "row">
<div class = "col-sm c">
<h2 class = "text-center" id = "message2"></h2>
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
  <label id = "6A"></label>
  <br>
  <label id = "7A"></label>
  <br>
  <label id = "8A"></label>
  <br>

</div>
<div class = "col-4">
<label id = "1D"></label>
<br>
<label id = "2D"></label>
<br>
<label id = "3D"></label>
<bR>
<label id = "4D"></label>
<br>
<label id = "5D"></label>
  <br>
  <label id = "6D"></label>
  <br>
  <label id = "7D"></label>
  <br>
  <label id = "8D"></label>
  <br>
 
</div>
  <div class = "col-2"></div>
</div>
  
</div> <!-- container -->
  
</body>
</html>




<script>

function initialise(n)
{

  // load grid with answers line by line

  // and load+

  $('[id^=grid]').empty() ;
  $('[id^=grid]').prop('disabled', true).css({"background-color":"lightblue","color":"black"}).val("") ;
lines = [];

$('#message1').text('');
$('#message2').text('');


// puzzles

if (n == 1)
{

lines = [] ;

lines[0] = "SIXTY";
lines[1] = "U--O-" ;
lines[2] = "NAME-" ;
lines[3] = "N--SO" ;
lines[4] = "YOU-N" ;

wordsAcross  = ["SIXTY","NAME","SO","YOU"] ;
wordsDown = ["SUNNY","TOES","ON"] ;

questionsAcross = [] ;
questionsAcross[1] = "The book has S _ _ _ _ pages.";
questionsAcross[2] = "My mother's _ _ _ _ is Tida.";
questionsAcross[3] = "It is _ _ hot today!";
questionsAcross[4] = "What are _ _ _ doing?";

questionsDown = [] ;
questionsDown[1] = "Today it is hot and  S _ _ _ _.";
questionsDown[2] = "My foot has five _ _ _ _ _.";
questionsDown[3] = "I am sititng _ _ a chair.";

console.log("Puzzle 1 ",lines);

}

if (n == 2)
{

lines = [] ;

lines[0] = "WRITE";
lines[1] = "-I-I-" ;
lines[2] = "-V-M-" ;
lines[3] = "-EYES" ;
lines[4] = "OR---" ;

wordsAcross  = ["WRITE","EYES","OR"] ;
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


if (n == 3)
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
if (n == 4)
{
lines = [] ;

lines[0] = "BREAD";
lines[1] = "R-A-O" ;
lines[2] = "I-T-I" ;
lines[3] = "NO--N" ;
lines[4] = "G-BAG" ;

wordsAcross  = ["BREAD","NO","BAG"] ;
wordsDown = ["BRING","EAT","DOING"] ;

questionsAcross = [] ;
questionsAcross[1] = "The baker makes _ _ _ _ _.";
questionsAcross[2] = "__, you can't do that!";
questionsAcross[3] = "I put my shopping into the _ _ _.";


questionsDown = [] ;
questionsDown[1] = "Always _ _ _ _ _ your books to class..";
questionsDown[2] = "I like to _ _ _ bananas.";
questionsDown[3] = "What are those people _ _ _ _ _?";

console.log("Puzzle 4 ",lines);
}

if (n == 5)
{
lines = [] ;

lines[0] = "SPEAK";
lines[1] = "TO--N" ;
lines[2] = "AT-DO" ;
lines[3] = "Y-NOW" ;
lines[4] = "-LOG-" ;

wordsAcross  = ["SPEAK","TO","AT","DO","NOW","LOG"] ;
wordsDown = ["STAY","POT","NO","DOG","KNOW"] ;

questionsAcross = [] ;
questionsAcross[1] = "I can _ _ _ _ _ English.";
questionsAcross[2] = "Let's go _ _ the park.";
questionsAcross[3] = "She is _ _ home now.";
questionsAcross[4] = "_ _ you know what to do next?";
questionsAcross[5] = "_ _ _, I am going home.";
questionsAcross[6] = "I put a _ _ _ on the fire.";


questionsDown = [] ;
questionsDown[1] = "We can _ _ _ _ at my friend's house.";
questionsDown[2] = "He cooked soup in a big _ _ _.";
questionsDown[3] = "_ _ I won't!";
questionsDown[4] = "That _ _ _ is barking.";
questionsDown[5] = "Do you _ _ _ _ how to swim?";


console.log("Puzzle 5 ",lines);
}


if (n == 6)
{
lines = [] ;

lines[0] = "MOUSE";
lines[1] = "A-NO-" ;
lines[2] = "TIDY-" ;
lines[3] = "H-E--" ;
lines[4] = "SORE-" ;

wordsAcross  = ["MOUSE","NO","TIDY","SORE"] ;
wordsDown = ["MATHS","UNDER","SOY"] ;

questionsAcross = [] ;
questionsAcross[1] = "I use a _ _ _ _ _ with my computer.";
questionsAcross[2] = "There are _ _ zebras in Cambodia!";
questionsAcross[3] = "I helped _ _ _ _ our classroom.";
questionsAcross[4] = "I have a _ _ _ _ throat.";



questionsDown = [] ;
questionsDown[1] = "_ _ _ _ _ is my best subject.";
questionsDown[2] = "The snake lived _ _ _ _ _ the ground.";
questionsDown[3] = "The drink was made from _ _ _ beans.";



console.log("Puzzle 6 ",lines);
}


if (n == 7)
{
lines = [] ;

lines[0] = "THEM-";
lines[1] = "I--AM" ;
lines[2] = "MARRY" ;
lines[3] = "E--C-" ;
lines[4] = "---HI" ;

wordsAcross  = ["THEM","I","AM","MARRY","HI"] ;
wordsDown = ["TIME","MARCH","MY"] ;

questionsAcross = [] ;
questionsAcross[1] = "Where do I put _ _ _ _ ?";
questionsAcross[2] = "Where am _ ?";
questionsAcross[3] = "I _ _ going home.";

questionsAcross[4] = "Penh will _ _ _ _ _ Tida next year.";
questionsAcross[5] = "let's go and say _ _ to my friend.";




questionsDown = [] ;
questionsDown[1] = "Is it _ _ _ _ to go home?";
questionsDown[2] = "After February it is _ _ _ _ _.";
questionsDown[3] = "Where are _ _ pencils?";



console.log("Puzzle 7 ",lines);
}



if (n == 8)
{
lines = [] ;

lines[0] = "FISH-";
lines[1] = "L-HIT" ;
lines[2] = "Y-O-I" ;
lines[3] = "--PIE" ;
lines[4] = "---N-" ;

wordsAcross  = ["FISH","HIT","PIE"] ;
wordsDown = ["FLY","SHOP","HI","IN","TIE"] ;

questionsAcross = [] ;
questionsAcross[1] = "The _ _ _ _ live in the sea.";
questionsAcross[2] = "The ball _ _ _ the window.";
questionsAcross[3] = "My mother made an apple _ _ _.";


questionsDown = [] ;
questionsDown[1] = "The bird can _ _ _.";
questionsDown[2] = "That is the _ _ _ _ that sells books.";
questionsDown[3] = "_ _ , how are you?";
questionsDown[4] = "I live _ _ a big house.";
questionsDown[5] = "The teacher is wearing a _ _ _";


console.log("Puzzle 8 ",lines);
}


if (n == 9)
{
lines = [] ;

lines[0] = "MOON-";
lines[1] = "A--OF" ;
lines[2] = "T--N-" ;
lines[3] = "HOME-" ;
lines[4] = "SHE--" ;

wordsAcross  = ["MOON","AN","OF","HOME","SHE"] ;
wordsDown = ["MATHS","ON","OH","ME","NONE"] ;

questionsAcross = [] ;
questionsAcross[1] = "The _ _ _ _ is in the sky.";
questionsAcross[2] = "I have _ _ apple.";
questionsAcross[3] = "What is the name _ _ your dog?";
questionsAcross[4] = "My _ _ _ _ is near the school/";
questionsAcross[5] = "Is _ _ _ your sister?";


questionsDown = [] ;
questionsDown[1] = "_ _ _ _ _ is my favourite subject.";
questionsDown[2] = "My book is _ _ the table.";
questionsDown[3] = "_ _ no,I broke the glass!";
questionsDown[4] = "Will you walk with _ _?";
questionsDown[5] = "There are _ _ _ _ left.";


console.log("Puzzle 9 ",lines);
}

if (n == 10)
{
lines = [] ;

lines[0] = "-CARS";
lines[1] = "----O-" ;
lines[2] = "SEEN-" ;
lines[3] = "E-A-I" ;
lines[4] = "T-RUN" ;

wordsAcross  = ["CARS","SEEN","RUN"] ;
wordsDown = ["SET","EAR","SO","IN"] ;

questionsAcross = [] ;
questionsAcross[1] = "There are many _ _ _ _ on the road.";
questionsAcross[2] = "Have you _ _ _ _ my coat?";
questionsAcross[3] = "_ _ _ fast, we are late!";
// questionsAcross[4] = "";
// questionsAcross[5] = "";


questionsDown = [] ;
questionsDown[1] = "The teacher _ _ _ us homework.";
questionsDown[2] = "My _ _ _ is sore.";
questionsDown[3] = "_ _, what will we do now?";
questionsDown[4] = "Put the books _ _ your bag.";
// questionsDown[5] = "";


console.log("Puzzle 10 ",lines);
}

if (n == 11)
{
lines = [] ;

lines[0] = "THEIR";
lines[1] = "H----" ;
lines[2] = "EVERY" ;
lines[3] = "R--E-" ;
lines[4] = "E-ADD" ;

wordsAcross  = ["THEIR","EVERY","ADD"] ;
wordsDown = ["THEIR","I","RED"] ;

questionsAcross = [] ;
questionsAcross[1] = "Where is _ _ _ _ _ house?";
questionsAcross[2] = "Is _ _ _ _ _ student listening?";
questionsAcross[3] = "Can you _ _ _ 3 and 12?";
// questionsAcross[4] = "";
// questionsAcross[5] = "";


questionsDown = [] ;
questionsDown[1] = "_ _ _ _ _ is the school!";
questionsDown[2] = "What can _ do?";
questionsDown[3] = "The car is _ _ _.";
//questionsDown[4] = "";
//questionsDown[5] = "";


console.log("Puzzle 11 ",lines);
}

if (n == 12)
{
lines = [] ;

lines[0] = "DESK-";
lines[1] = "R--E-" ;
lines[2] = "I-BYE" ;
lines[3] = "V-I-N" ;
lines[4] = "EGG-D" ;

wordsAcross  = ["DESK","I","BYE","EGG"] ;
wordsDown = ["DRIVE","BIG","KEY","END"] ;

questionsAcross = [] ;
questionsAcross[1] = "My _ _ _ _ is at the front of the class.";
questionsAcross[2] = "_ am hungry.";
questionsAcross[3] = "_ _ _, see you later!";
questionsAcross[4] = "I ate an _ _ _ for lunch.";
// questionsAcross[5] = "";


questionsDown = [] ;
questionsDown[1] = "My brother can _ _ _ _ _ a truck.";
questionsDown[2] = "My house is very _ _ _.";
questionsDown[3] = "The _ _ _ will open the door.";
questionsDown[4] = "I live at the _ _ _ of the road";
// questionsDown[5] = "";


console.log("Puzzle 12 ",lines);
}


if (n == 13)
{

lines = [] ;

lines[0] = "SMALL";
lines[1] = "TEN--" ;
lines[2] = "O-TOP" ;
lines[3] = "PI--O" ;
lines[4] = "-SEAT" ;

wordsAcross  = ["SMALL","TEN","TOP","PI","SEAT"] ;
wordsDown = ["STOP","ME","IS","ANT","POT"] ;

questionsAcross = [] ;
questionsAcross[1] = "The baby is  - - - - -.";
questionsAcross[2] = "I have - - - fingers.";
questionsAcross[3] = "I climbed to the - - - of the mountain.";
questionsAcross[4] = "- - is equal to 3.14";
questionsAcross[5] = "My - - - - is next to the teacher.";

questionsDown = [] ;
questionsDown[1] = "- - - - talking!";
questionsDown[2] = "He is talking to - -.";
questionsDown[3] = "That - - a book.";
questionsDown[4] = "An - - - is eating the food.";
questionsDown[5] = "That is a cooking - - - .";

console.log("Puzzle 13 ",lines);

}


if (n == 14)
{

lines = [] ;

lines[0] = "TREES";
lines[1] = "E-M-O" ;
lines[2] = "NAP--" ;
lines[3] = "T-TOO" ;
lines[4] = "HAY-F" ;

wordsAcross  = ["TREES","NAP","TOO","HAY"] ;
wordsDown = ["TENTH","EMPTY","SO","OF"] ;

questionsAcross = [] ;
questionsAcross[1] = "The _ _ _ _ _ has green leaves.";
questionsAcross[2] = "I small sleep is a - - -.";
questionsAcross[3] = "It is - - - hot today.";
questionsAcross[4] = "The cows ate _ _ _.";

questionsDown = [] ;
questionsDown[1] = "It is the - - - - - of May.";
questionsDown[2] = "The bottle is - - - - - .";
questionsDown[3] = "There is _ _ much food.";
questionsDown[4] = "The 1st - -  May is a holiday.";


console.log("Puzzle 14 ",lines);

}

if (n == 15)
{

lines = [] ;

lines[0] = "AFTER";
lines[1] = "BE-NO" ;
lines[2] = "OW-DO" ;
lines[3] = "U---M" ;
lines[4] = "TOY-S" ;

wordsAcross  = ["AFTER","BE","NO","OW","DO","TOY"] ;
wordsDown = ["ABOUT","FEW","END","ROOMS"] ;

questionsAcross = [] ;
questionsAcross[1] = "What are you doing - - - - - school?";
questionsAcross[2] = "I want to - -  a teacher";
questionsAcross[3] = "_ _ ,you can't go home yet!";
questionsAcross[4] = "- - ! That hurt!";
questionsAcross[5] = "There is nothing to - - .";
questionsAcross[6] = "That is my brother's - - - .";


questionsDown = [] ;
questionsDown[1] = "What's that book - - - - - ?";
questionsDown[2] = "There are only a _ _ _ books left.";
questionsDown[3] = "That is the - - -  of the story.";
questionsDown[4] = "Our house has many - - - - - .";


console.log("Puzzle 15 ",lines);

}

if (n == 16)
{

lines = [] ;

lines[0] = "-M-GO";
lines[1] = "DO-E-" ;
lines[2] = "-VET-" ;
lines[3] = "HI--I" ;
lines[4] = "MELTS" ;

wordsAcross  = ["GO","DO","VET","HI","MELTS"] ;
wordsDown = ["HM","MOVIE","GET","IS"] ;

questionsAcross = [] ;
questionsAcross[1] = "Do you want to _ _  home now?";
questionsAcross[2] = "I - - my homework after school.";
questionsAcross[3] = "A - - - looks after sick animals.";
questionsAcross[4] = "- - , how are you?";
questionsAcross[5] = "The ice - - - - -  in the sun.";


questionsDown = [] ;
questionsDown[1] = "_ _ what is that??";
questionsDown[2] = "I watched a good _  _  _ _ _ on YouTube.";
questionsDown[3] = "Would you _ _ _ my bag please?";
questionsDown[4] = "What _ _  that?.";


console.log("Puzzle 16 ",lines);

}



var l = questionsAcross.length ; 
for (var i = 1 ; i < l ; i++)
{
  var locationA = i + 'A';
    $('#' + i + 'A').text(i + " " + questionsAcross[i]).show() ;
    MathJax.Hub.Queue(["Typeset", MathJax.Hub, "locationA"]);
}

var m = questionsDown.length ; 
for (var i = 1 ; i < m ; i++)
{
  var locationD = i + 'D';
    $('#' + i + 'D').text(i + " " + questionsDown[i]).show() ;
    MathJax.Hub.Queue(["Typeset", MathJax.Hub, "locationD"]);
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
  // puzzleNumber = 3;

// hide lablels 

$('label').hide().empty() ;
  
  
    $('#game').show();
    $('[id^=grid]').prop('disabled',true);

    })

</script>


<script> 

  $(document).ready(function(){
      $('label').click(function(){

        
keyCount = 0 ; // keep count of presses along this clue
        $('label').css({"background-color":"white"});
        $('[id^=grid]').css({"background-color":"lightblue"}).prop('disabled',true);
        for (var i = 0; i < blanks.length; i++)
{
  $('#' + blanks[i]).prop('disabled', true).css({"background-color":"black","color":"black"}).val("-") ;
}

        clicked = this.id ;
        console.log("clicked",clicked);

        $('#' + clicked).css({"background-color":"lightblue"});

        // get number and letter;

        var l = clicked.length ;
        letter = clicked[l-1] ;
        navigation = letter; // used to set focus on adjacent grid element
        number = parseInt(clicked.substring(0,l-1));
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
                    $('#' + t[i]).css({"background-color":"lightgreen"}).prop('disabled',false);
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
                    
                  $('#' + t[i]).css({"background-color":"lightgreen"}).prop('disabled',false);
                }
                $('#' + t[0]).focus();
            }

            firstLocation = t[0] ;



})
})


</script>



<script> 

$(document).ready(function(){



// $('#grid13').prop('disabled', true).css({"background-color":"grey","color":"black"}).empty() ;
// $('#grid21').prop('disabled', true).css({"background-color":"grey","color":"black"}).empty() ;
//initialise() ;

    })

</script> 
<script>
      $(document).on('keypress', function(event) {
          var keycode = (event.keyCode ? event.keyCode : event.which);
          console.log("key",keycode) ;
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

    $("#retry").click(function(){

    //  alert("Clearing grid");
      console.log("Clearing");
      $('[id^=grid]').prop('disabled', true).css({"background-color":"lightblue","color":"black"}).val("") ;
      $('[id^=grid]').val("");
      initialise() ;

    })
})

</script>

<script>
$(document).ready(function(){

    $("#check").click(function(){

 //     alert("Checking");
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

 $('#puzzle-' + puzzleNumber).text('!').prop('disabled', true).css({"background-color":"yellow","color":"black"}) ;
}

      })
  })

</script>

<script>

$(document).ready(function(){
      $('[id^=puzzle]').click(function(){

        $('[id^=grid]').prop('disabled', true).css({"background-color":"lightblue","color":"black"}).val("") ;
        $('label').empty();

        var click = this.id;
    //    alert(click) ;
        var num = click.split("-");
        puzzleNumber = parseInt(num[1]) ;
        alert("Puzzle number " + puzzleNumber);
  //      alert("Clearing grid");
      console.log("Clearing");
      console.log("Puzzle #",puzzleNumber);
     
      $('[id^=grid]').val("");
        initialise(puzzleNumber);


      })
})

  </script>

