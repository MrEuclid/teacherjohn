<!DOCTYPE html>
<html lang="en">
  <head>
 
 
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
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

    <meta charset="utf-8">
    
    <title>Cross number Competition </title>

<style type="text/css">

 
label {font-size: 1em; font-weight:bolder; color:blue;}

#home , #retry , #clear, #check {font-size:1.2em ; font-weight:bolder;}

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

.senior {color:yellow; background-color: green;}

.c {text-align: center;}

#lblStudentID {display: inline; font-size: 1.2em ; background-color: lightgrey; height: 2em;}
#studentIDNumber {background-color: lightgreen; text-align: center; width:12em; height: 2em; size:4;}
</style>

</head>

<body>


     <div class  = "container-fluid" id = "register">

      <div class = "row text-center">
        <div class = "col-12 ">
            <p class="h2 text-center">Cross Number Puzzles</p>
        </div></div>

      <div class = "row text-center">
        <div class = "col- ">
          <p id = "lblStudentID">School ID</p>
          <input type="number"  id ="studentIDNumber" max="9999" min="1000">
          <button class = "btn btn-success" id = "login">Login</button>
        </div></div>

          <div class = "row text-center">
        <div class = "col- ">
          <p id = "messageError" class = "text-center-danger"></p>
        </div></div>   
      </div> <!-- container -->



   <div class  = "container-fluid" id = "game">
      <div class = "row">
        <div class = "col-sm-12 c">
   <h1><img id = "pio1" src = "images/dragon1.jpeg" width = "auto" height = "auto">
Solve the Puzzles
   <img id = "pio2" src = "images/dragon2.png" width = "50px" height = "auto">
 </h1>
</div></div>
<div class = "row">
  <div class = "col-sm-12 c">
<a href="crossnumber5x5Competition.php" >

     <button id = "home" class="btn btn-info btn-sm">Home</button>
     </a>
        <button id = "retry" class="btn btn-success btn-sm">Clear</button>
       <button id = "check" class="btn btn-warning btn-sm">Check</button>
  </div></div>
  <div class = "row">
  <div class = "col-sm c">
 
    <button id = "puzzle-1" class = "crossnumber">1</button>
    <button id = "puzzle-2" class = "crossnumber">2</button>
    <button id = "puzzle-3" class = "crossnumber">3</button>
    <button id = "puzzle-4" class = "crossnumber">4</button>
    <button id = "puzzle-5" class = "crossnumber">5</button>
    <button id = "puzzle-6" class = "crossnumber">6</button>
    <button id = "puzzle-7" class = "crossnumber">7</button>
    <button id = "puzzle-8" class = "crossnumber">8</button>
    <button id = "puzzle-9" class = "crossnumber">9</button>
    <button id = "puzzle-10" class = "crossnumber">10</button>
    <button id = "puzzle-11" class = "crossnumber">11</button>
    <button id = "puzzle-12" class = "crossnumber senior">12</button>
    <button id = "puzzle-13" class = "crossnumber senior">13</button>
    <button id = "puzzle-14" class = "crossnumber senior">14</button>
      
    </div></div>


<div class = "row">
  <div class = "col-sm c">
   <p id = "messagePlayer"></p>
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
<h2 class = "text-center" id = "message1">Solve the Puzzles</h2>
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
<p id = "temp"></p>
</body>
</html>

<script type="text/javascript">

/*

https://stackoverflow.com/questions/3302702/jquery-return-value-using-ajax-result-on-success
  function getAjax(url, data){
    return $.ajax({
        type: 'POST',
        url : url,              
        data: data,
        dataType: 'JSON',
        //async: true,  //NOT NEEDED
        success: function(response) {
            //Data = response;
        }
    });
 }
  */
  function getQuestions(url,id)
  {
  return   $.ajax({
  url: url,
  type: "POST",
  data:{studentID:id},
  dataType:'json',
    success : function(data) {  
console.log("function data",data);

  }  // success
});  // ajax
  }  // function
</script>

<script> 

  $(document).ready(function(){

// grid size
  // puzzleNumber = 3;

// hide lablels 

$('#register').show();
$('#game').hide();
$('#studentIDNumber').focus();

// $('label').hide().empty() ;
  
$('[id^=grid]').prop('disabled',true);

    })

</script>

<script> 

  $(document).ready(function(){
      $('#login').click(function(){

let clicked = this.id;
studentID = $('#studentIDNumber').val();
//alert(clicked + ' ' + studentID);

    console.log("Password",studentID);
     $.ajax({
  url: "checkStudentID.php",
  type: "POST",
  data:{studentID:studentID},
  dataType:'text',
    success : function(data) {  



let found = data.includes('not found');

console.log(data,found);
if (found == true)
{
  $('#messageError').text(data);
}

else 
{ 
$('#register').hide();
$('#game').show();
$('#messagePlayer').text(data);
}

let url = 'readCrossnumberDatabase.php';
getQuestions(url, studentID).done(function(response){
    console.log(response);
   let l = response.length;

   for (let i = 0; i < l ; i++)
   {
     let qs = response[i].question;
   let target = '#puzzle-' + qs;
   $('#puzzle-'+qs).hide();
   }


 
    
  
});
   


    }, // success
    error : function(request,error)
    {
        alert("Stats errort: " +JSON.stringify(request));
    } // error
});  // ajax





})
    })
</script>



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

a = 12;
b = 20 ;
c = 3 ;

lines[0] = "1632-";
lines[1] = "444-8" ;
lines[2] = "4-644" ;
lines[3] = "-240-" ;
lines[4] = "180--" ;

wordsAcross  = ["1632","444","644","240","180"] ;
wordsDown = ["144","64","28","34640","40","84"] ;

questionsAcross = [] ;
questionsAcross[1] = "$ c(a^2 + b^2) $";  // 3(144 + 400) = 1632

questionsAcross[2] = "$ b^2 + 2b + 4 $"; // 400 + 40 + 4 = 444 
questionsAcross[3] = "$ a^2 + b^2 + b(c + 2)  $"; // 144 + 400 + 20 x 5 = 644

questionsAcross[4] = "$ ab $";  // 240 
questionsAcross[5] = " $ bc^2$ ";  // 20 x 9 = 180


// $ \\sqrt{a^2 + b^2} $


questionsDown = [] ;
questionsDown[1] = "$ a^2 $";  //144
questionsDown[2] = "$ (b-a)^2 $ ";  //64
questionsDown[3] = "$ b + (b-a) $ ";  //28
questionsDown[4] = " $ (3b - 2)^2 \\times $ 10 + 1000";  // (60 -2)^2 x 10 + 1000
questionsDown[5] = "b(c-1)"; //40
questionsDown[6] = "a $ \\times $ 7"; //84


 // alert("Maths " + puzzleNumber);
  $('#message1').text('Solve puzzle ' + n) ;

  $('#message2').text('a = 12, b = 20 , c = 3');



console.log("Puzzle 9 ",lines);
}


if (n == 2)
{
lines = [] ;

a = 3;
b = 4 ;
c = 5 ;
d = 7 ;
  $('#message1').text('Solve puzzle ' + n) ;
  $('#message2').text('a = 3, b = 4 , c = 5, d = 7');

lines[0] = "105-8";
lines[1] = "2-0-2" ;
lines[2] = "55--1" ;
lines[3] = "-729-" ;
lines[4] = "127--" ;

wordsAcross  = ["105","55","729","127"] ;
wordsDown = ["125","572","50","27","821"] ;

questionsAcross = [] ;
questionsAcross[1] = "$ acd $";  // 3 x 5 x 7 = 15 x 7 = 105

questionsAcross[2] = "$ b^3 - a^2 $"; // 4^3 - 3^2 = 64 - 9 = 55
questionsAcross[3] = "$ (b + c)^3 $"; // 9^3 = 729

questionsAcross[4] = "$ 2^d - 1 $";  //  2^7 = 1 = 128 -1 = 127



// $ \\sqrt{a^2 + b^2} $


questionsDown = [] ;
questionsDown[1] = "$ c^3 $";  // 5^3 125
questionsDown[2] = "$ bc^3 + a^2(d - c)^3 $ ";  // 572 = 4 x 5^3 +  3^2 x (7-5)^3 = 500 + 9 x 8
questionsDown[3] = "$ cd + ac $ ";  // 5x7 + 3x5 = 35 + 15 = 50 
questionsDown[4] = "$ a^3 $";  // 3^3 = 27
questionsDown[5] = "$ ad + b^2(a^2 + b^2 + c^2) $"; // 821  = 3x7 + 16 x 50



 // alert("Maths " + puzzleNumber);






console.log("Puzzle 11 ",lines);
}

// new puzzle

if (n == 3)
{

lines = [] ;

a = 5;
b = 7 ;
c = 13 ;

  $('#message1').text('Solve puzzle ' + n) ;
  $('#message2').text('a = 5, b = 7 , c = 13');

lines[0] = "144--";
lines[1] = "6-9--" ;
lines[2] = "91-1-" ;
lines[3] = "-2401" ;
lines[4] = "25-81" ;

wordsAcross  = ["144","91","2401","25","81"] ;
wordsDown = ["169","125","49","108","11"] ;

questionsAcross = [] ;
questionsAcross[1] = "$ (c-1)^2 $";  // 12^2 = 144
questionsAcross[2] = "$ bc $"; // 7 x 12
questionsAcross[3] = "$ b^4 $"; // 7^4
questionsAcross[4] = "$ a^2 $";  // 5^2 
questionsAcross[5] = "$ a^2 + b(b+1) $";  // 25 + 49 + 7 = 81


// $ \\sqrt{a^2 + b^2} $


questionsDown = [] ;
questionsDown[1] = "$ c^2 $";  // 
questionsDown[2] = "$ a^3 $" ; // 
questionsDown[3] = "$ (\\frac{a+b}{2}) ^ 2 + c   $ ";  // 6^2 + 13
questionsDown[4] = "$ (a +b) \\times (\\frac{c-b}{2}) ^ 2   $ ";  // 12 x 3^2
questionsDown[5] = "$ a + c -b $";  // 



 // alert("Maths " + puzzleNumber);





console.log("Puzzle 12 ",lines);
}



if (n == 4)
{
lines = [] ;

a = 9;
b = 15 ;
c = 27 ;
d = 2 ;
  $('#message1').text('Solve puzzle ' + n) ;
  $('#message2').text('a = 9, b = 15 , c = 27, d = 42');

lines[0] = "1232-";
lines[1] = "-0-4-" ;
lines[2] = "-1638" ;
lines[3] = "581-0" ;
lines[4] = "7-221" ;

wordsAcross  = ["1232","1638","581","221"] ;
wordsDown = ["57","2018","612","243","801"] ;

questionsAcross = [] ;
questionsAcross[1] = "$  7(b+7)(b-7)$";  // 7(b^2 - 49) = 7x(225 -49) = 7x176 = 1232
questionsAcross[2] = "$ d(d-1)(d+3)-d^2(d+1)$"; // 42 x 41 x 45 - (42^2)*43 = 77490 - 75852 = 1638
questionsAcross[3] = "$  \\frac{100b}{3} + a^2$"; // 1500/3 + 81 = 581
questionsAcross[4] = "$ \\frac{(b^2+d^2)}{a} $";  //  (225 + 1764)/9 = 1989/9 = 221


questionsDown = [] ;
questionsDown[1] = "$  2c + \\sqrt{a} $";  // 54 + 3 =57
questionsDown[2] = "$  3c^2 - (b + 1 + \\sqrt{a)}) $ ";  // (3 x 27*27 - (15+1 -3)^2 = 2187-169 = 2018
questionsDown[3] = "$  (b + 2)(a^2 + b^2 -270) $ ";  // 17 x (81 + 225 - 270) = 17 x 36 = 612
questionsDown[4] = "$ b^2 + 2a $";  // 225 + 18 = 243
questionsDown[5] = "$9 \\times 8 \\times 7 + 11c  $";  // 504 + 297 = 801




 // alert("Maths " + puzzleNumber);






console.log("Puzzle 11 ",lines);
}

if (n == 5)
{
lines = [] ;

a = 2;
b = 3 ;
c = 5 ;
d = 7 ;
e = 11 ;
  $('#message1').text('Solve puzzle ' + n) ;
  $('#message2').text('a = 2, b = 3 , c = 5, d = 7, e = 11');

lines[0] = "-2-49";
lines[1] = "700-9" ;
lines[2] = "-4-88" ;
lines[3] = "-87--" ;
lines[4] = "--352" ;

wordsAcross  = ["49","700","88","87","352"] ;
wordsDown = ["2048","73","998"] ;

questionsAcross = [] ;
questionsAcross[1] = "$ d^a  $"; // 7^2 = 49
questionsAcross[2] = "$ (ac)^a x d $"; // 20^2 x 7 = 700
questionsAcross[3] = "$ e(e-b) $";  // 11 (11-3) = 88 
questionsAcross[4] = "$ b \\times $ A prime number ";  //  87
questionsAcross[5] = "$ d^3 + (e-a)  $";  // (7^3 = 343 + 9 = 352


questionsDown = [] ;

questionsDown[1] = "$ a^e $" ; // 2^11 = 2048
questionsDown[2] = "A prime number ";  // 73
questionsDown[3] = "$ (ac)^b -a $";  // 1000 - 2





 // alert("Maths " + puzzleNumber);






console.log("Puzzle 11 ",lines);
}


if (n == 6)
{
lines = [] ;

a = 2;
b = 4 ;
c = 5 ;
d = 7 ; 

  $('#message1').text('Solve puzzle ' + n) ;
  $('#message2').text('a = 2, b = 4 , c = 5 , d = 7');

lines[0] = "14-54";
lines[1] = "196-7" ;
lines[2] = "2-243" ;
lines[3] = "-64-6" ;
lines[4] = "80---" ;

wordsAcross  = ["14","54","196","243","64","80"] ;
wordsDown = ["112","49","60","624","4736"] ;

questionsAcross = [] ;
questionsAcross[1] = "$ ad $";  // 2 x 7 = 14 
questionsAcross[2] = "$ \\sum_{i=5}^7 3i $"; // 15 + 18 + 21 = 54 
questionsAcross[3] = "$ a^2d^2 $"; // 4 x 49 = 196 
questionsAcross[4] = "$ \\sqrt{d^6} - bc^2 $";  // 7^3 - 4 x 25 = 243
questionsAcross[5] = "$ \\sqrt{b^6} $";  // b^3  4^3 = 64 
questionsAcross[6] = "$ (b\\sqrt{c})^2 $";  // (4sqrt(5))^2 = 16 x 5 = 80 




questionsDown = [] ;
questionsDown[1] = "$ \\frac{b^2d^4}{d^3} $"; // b^2d = 16 x 7 = 112 
questionsDown[2] = "$ a^2 + 2ac + c^2 $" ; // 4 + 2 x 2 x 5 + 25 = 49
questionsDown[3] = "$ b^3 - a^2 $ ";  
questionsDown[4] = "$  c^4 - 1 $ "; // 5^4 - 1 = 624  
questionsDown[5] = "$ \\frac{bd}{ac} \\times 2368 \\times \\frac{c}{d} $";
// 2368 x 4 / 2 = 4736  



 // alert("Maths " + puzzleNumber);






console.log("Puzzle 18 ",lines);
}



if (n == 7)
{
lines = [] ;

a = 16;
b = 12 ;
c = 28 ;
d = 4 ; 

  $('#message1').text('Solve puzzle ' + n) ;
  $('#message2').text('a = 16, b = 12 , c = 28 , d = 4');

lines[0] = "3925-";
lines[1] = "-8--1" ;
lines[2] = "857-6" ;
lines[3] = "4-768" ;
lines[4] = "-15--" ;

wordsAcross  = ["3952","857","768","15"] ;
wordsDown = ["84","985","775","168"] ;

questionsAcross = [] ;
questionsAcross[1] = "$ a^3 - b^2 $";  // 16^3 - 12^2 = 3925 
questionsAcross[2] = "$ c^2 + d^3 + \\frac{c}{d} + \\sqrt{d} $"; 
//28^2 + 4^3 + 28 / 4 + 2 = 784 + 64 + 7 + 2 = 857
questionsAcross[3] = "$ 3c^2 -6bc + 3b^2 $"; // 3*28^2 - 6*12*28 +3+12^2
// 2352 - 2016 + 432 = 768
questionsAcross[4] = "$ \\frac{a+b+c+d}{d} $";  // 16 + 12 + 28 + 4 = 60 / 4 = 15


questionsDown = [] ;
questionsDown[1] = "$ \\frac{bc}{\\sqrt{a}} $";  // 12 * 28 / 4 = 84 
questionsDown[2] = "$ 5 + 14 \\sum_{i=12}^{16} i $" ; // 5 + 14*70 = 985
questionsDown[3] = "$  31 \\sum_{i=1}^4 \\frac{b}{i} $ "; 
// 31 * (12/1 + 12/2 + 12/3 + 12/4) = 31 * (12 + 6 + 3 + 4) = 775
questionsDown[4] = "$ \\frac{2bc}{d} $ "; // 2*12*28/4 = 168  



 // alert("Maths " + puzzleNumber);






console.log("Puzzle 11 ",lines);
}

if (n == 8)
{
lines = [] ;



  $('#message1').text('Solve puzzle ' + n) ;
  $('#message2').text('Square numbers are 1,4,9,16,25,36,...');

lines[0] = "144-3";
lines[1] = "6-843" ;
lines[2] = "-5-98" ;
lines[3] = "81--6" ;
lines[4] = "72-24" ;

wordsAcross  = ["144","843","98","81","72","24"] ;
wordsDown = ["16","87","512","48","49","33864"] ;

questionsAcross = [] ;
questionsAcross[1] = "A square number whose digits add up to 9";  // 144
questionsAcross[2] = "b + a = 284 and b - a = 278, find ab"; 
// a = 3, b = 281 2b = 562, b = 281, a = 3 ab = 843
questionsAcross[3] = "$x = 10, y = 2 $ , z = $ x^2 - \\sqrt[3]{(x-y)} $"; // 
questionsAcross[4] = "$ x^{x+1} $ , x is whole number,1 < x < 5";  // 3^4 = 81
questionsAcross[5] = "$ x^{x+1} \\times (x+1)^x $, x is whole number,1 < x < 5";
 // 32 x 2 ^3 = 72 
questionsAcross[6] = "$ 2 \\times \\sqrt{1 \\, Across}$";  // 24

questionsDown = [] ;
questionsDown[1] = "$ x^ \\sqrt{x} $, x is whole number,1 < x < 5";  
// 4^2  
questionsDown[2] = "m = 3, Answer = $ m(m^m + m -1)$";  // 3 x (27+3 -1) = 3 x 29 
questionsDown[3] = " $ x^{y^2} $ , y = x+1,x is whole number, 1 < x < 5";
 // 2 ^ 3^2 = 512
questionsDown[4] = " 3 $ \\times $ 1 Down " ; // 3 x 16 = 48
questionsDown[5] = "3 Down + 1 "; //  
questionsDown[6] = "$ 3 \\times 2^3 (7 \\times 2^3 \\times 5^2  + 11)$ "; //3 x 8 x (8*25 *7 + 11)


 // alert("Maths " + puzzleNumber);






console.log("Puzzle 11 ",lines);
}



if (n == 9)
{
lines = [] ;

  $('#message1').text('Solve puzzle ' + n) ;
  $('#message2').text('a = 121, b = 65, c = 28 , d = $ \\sqrt{a} $');

lines[0] = "-121-";
lines[1] = "3-8-5" ;
lines[2] = "6-930" ;
lines[3] = "76-2-" ;
lines[4] = "4-168" ;

wordsAcross  = ["121","930","76","168"] ;
wordsDown = ["3674","289","326","50"] ;

questionsAcross = [] ;
questionsAcross[1] = "$ d \\sqrt{a} $";  // 11 x 11 = 121
questionsAcross[2] = "$ 5d^2 + b(d - 6)  $"; // 5 x 121 + 65x5 = 605 + 325  = 930
questionsAcross[3] = "$ 6 \\sqrt{a} + b - 5d $"; // 66 + 65 - 55 = 76
questionsAcross[4] = "$ \\frac{c^2}{4} -c $";  // 28x28/4 -28 = 6 x 28 = 168


questionsDown = [] ;
questionsDown[1] = "$ cd +2bd -3cd + 4bd$";  // 6 x 65 x 11 -2x28x11 = 66 x 65 - 56 x 11      = 3674
questionsDown[2] = " $ -2cd + c^2 + a $ ";  // -2x28x11 + 28^2 + 121 = 784 + 121 - 626 
questionsDown[3] = "$ a - (b -c) + 2a $"; //  121 - (65 - 28) + 242 = 121 - 37 + 242 = 326
questionsDown[4] = "$ b \\sqrt{c -(\\frac{b}{5} -10)} \\times \\frac{10}{b}$ " ; 

// 65 x sqrt(28 - 13 +10) x 10/65 = sqrt(25) x 10 = 50

 // alert("Maths " + puzzleNumber);






console.log("Puzzle 11 ",lines);
}

if (n == 10)
{
lines = [] ;

  $('#message1').text('Solve puzzle ' + n) ;
  $('#message2').text('a = 12, b = 26, c = 36 , d = 32');
  $('#message3').text('x,y are whole numbers, x < y and y < 8');
  $('message 4').text(' a = xy, b = 10x + y, c = $ y ^2 $, d = $ c - x^2 $') ;

lines[0] = "5468-";
lines[1] = "-4-0-" ;
lines[2] = "348-3" ;
lines[3] = "2-1-6" ;
lines[4] = "-1650" ;

wordsAcross  = ["5468","348","1650"] ;
wordsDown = ["32","444","816","80","360"] ;

questionsAcross = [] ;
questionsAcross[1] = "$  \\frac{d}{2} \\times (a +  ab -1) $";  
// 16 x (12 + 12 x 26 -1)
// 16 x (11 + 312) = 16 x 333 = 5468

questionsAcross[2] = "$ \\frac{a}{3}  \\times \\frac{7ac + 108}{c} $"; 
// 4 x (7 x 12 x 36 + 108) / 36 = (84 + 3) x 4 = 87 x 4 = 348
questionsAcross[3] = "$ 10 \\sum_{i=d}^{c} (i-1)  $"; // n = 10 x (31 + 32 + 33 + 34 + 35) = 1650



questionsDown = [] ;
questionsDown[1] = "$  \\frac{11c}{a} -1 $" ; // 11 x 36/12 -1 = 32
questionsDown[2] = " $ 4(b-d)^2 $ ";  // 4 x 36 = 144
questionsDown[3] = "$ (a + \\sqrt{c} -1)(a+c) $"; //  17 x 48 = 816
questionsDown[4] = "$  3(\\frac{8a}{9} + \\frac{4a}{3}) $"; // 3 x 20x12/9 = 720 /9 = 80
questionsDown[5] = "$ 10 \\sqrt{(\\frac{a}{2})^2 c} $ " ; // 10 x sqrt(36 x 36) = 10 x 36 = 360


 // alert("Maths " + puzzleNumber);






console.log("Puzzle 11 ",lines);
}


// puzzle 



if (n == 11)
{
lines = [] ;

  $('#message1').text('Solve puzzle ' + n) ;
  $('#message2').text('a = 5, b = 14, c = 35 , d = 63');
  

lines[0] = "-1764";
lines[1] = "8-3-4" ;
lines[2] = "457-1" ;
lines[3] = "-4-9-" ;
lines[4] = "2940-" ;

wordsAcross  = ["1764","457","2940"] ;
wordsDown = ["84","549","737","90","441"] ;

questionsAcross = [] ;
questionsAcross[1] = "$ 3b^2 $"; // 42^2 = 1764
questionsAcross[2] = "$ \\frac{1}{2}(a^2 + b  + c^2 -2ac) $"; 
// 0.5 x (25 + 14 + 35^2 - 350 )
// 0.5 x (39 + 875) 0.5 x 914 = 457
questionsAcross[3] = "$ 40b^2 - 10bc $"; // 40 * 196 - 140 * 35 = 2940



questionsDown = [] ;
questionsDown[1] = "$ \\frac{\\sqrt{324b^2}}{3}$ " ;  // 18 x 14 / 3 = 84
questionsDown[2] = " $  \\frac{a^5 - a^4}{a}  + \\frac{c^2}{a^2} $ ";  
// 5^4 - 5^3 + 35^2 / 5^2 = 500 + 49 = 549
questionsDown[3] = "$ \\frac{b^3 + d^3}{7^3} $"; //  (14**3 + 63**3) / 343 = 737
questionsDown[4] = "$ 2a(a + 4) $"; // 10 x 9 = 90
questionsDown[5] = "$  \\sum_{i=1}^{6} \\frac{20d}{7i} $ " ; // 
// 20*63/1 + 20*63/2 + 20*63/3 + 20*63/4 + 20*63/5 + 20*63/6


 // alert("Maths " + puzzleNumber);






console.log("Puzzle 11 ",lines);
}


// puzzle 12



if (n == 12)
{
lines = [] ;

  $('#message1').text(n + ' - Find answer for each question.  x is always a whole number.') ;
  $('#message2').text('Prime numbers are 2,3,5,7,11,13,17,...');
  

lines[0] = "-127-";
lines[1] = "32-9-" ;
lines[2] = "45-36" ;
lines[3] = "--456" ;
lines[4] = "899--" ;

wordsAcross  = ["127","32","45","36","456","899"] ;
wordsDown = ["34","125","49","7935","66"] ;

questionsAcross = [] ;
questionsAcross[1] = "$ 2^7 - 1 $ " ;//$  log_2 (n+1) = 7 $"; // x+1 = 128 x = 127
questionsAcross[2] = "$ x^(x+3) $"; //  n 2^5 = 32
questionsAcross[3] = "$ x^2(2x -1) $"; // 2^2(3) = 12, or 3^2(5) = 45 16x7 too big
questionsAcross[4] = "$ x^x(x + 1)^x $"; //  2^2 x (3^2) = 4 x 9 = 36 or 3^3 x 4^3 = 27 x 64
questionsAcross[5] = "$  111x + 12 $"; // 123, 234,345,456,567,789
questionsAcross[6] = " xy, y = x + 2 , x and y are both prime numbers "; 
// 3x5, 5 x 7 , 11 x 13 = 143, 17 x 19 = 323, 29 x 31 = 899


questionsDown = [] ;
questionsDown[1] = "$ 2(4^x + 1) $ " ;  //2 x 5 = 10, 2 x 17 = 34 , 2 x 65 = too big
questionsDown[2] = " $  x^3 $ and x is a prime number  ";  // 5^3 = 125, 7^3 = 343
questionsDown[3] = "$  \\frac{10^x}{x} - 1 $ "; // 10 -1 , 50-1 = 49 , 499
questionsDown[4] = "$   (x^2 + 2x)(7x + 2)^2 $"; //8 x 16^2 = 2048, 15 x 23 x 23 = 7935
questionsDown[5] = "$  4 \\,across\\times - \\sqrt{4 \\, across} $ " ; // 72 - 6 = 66


console.log("Puzzle 12 ",lines);
}

// puzzle 25



if (n == 13)
{
lines = [] ;

  $('#message1').text(n + ' - Find the answer for each question.  x is always a whole number.') ;
  $('#message2').text('');
  

lines[0] = "113--";
lines[1] = "7-3-1" ;
lines[2] = "5-312" ;
lines[3] = "-7-9-" ;
lines[4] = "92-63" ;

wordsAcross  = ["113","312","92","63"] ;
wordsDown = ["175","72","333","196","12"] ;

questionsAcross = [] ;
questionsAcross[1] = "$  (x+1)^x+2 + x^x+3 $"; // 3^4 + 2^5 = 81 + 32 = 113
questionsAcross[2] = "$   \\sum_{i=3}^{8} 2^i - \\sum_{i=6}^{7} 2^ii$"; 
// 2^3 + 2^4 + 2^5 + 2^8 = 8 + 16 + 32 + 256 = 256 + 56 = 312
questionsAcross[3] = "$   x^2 - \\frac{x^3}{5} $"; // 100 - 8 = 92
questionsAcross[4] = "$  x^2 -1  $"; // 64 -1 = 63

questionsDown = [] ;
questionsDown[1] = "$ 3x^2 +  (2x)^2 $ "; // 3 x 25 + 100 = 175
questionsDown[2] = "$  x^{x+1} \\times (x+1)^x $ ";  // 2^3 x 3^2  = 72
questionsDown[3] = "$  3 \\times (1 across -2) $ " ;  //  = 3 x (113 -2)
questionsDown[4] = "$   \\frac{49x^2}{25}$" ; // 4900 / 25 = 196
questionsDown[5] = "$   (2x)^2 - x^2$" ; // 3 x 4 = 12 

console.log("Puzzle 26 ",lines);
}

// puzzle 26


if (n == 14)
{
lines = [] ;

  $('#message1').text(n + ' - Find the answer for each question.  x is always a whole number.') ;
  $('#message2').text('Square numbers are 1,4,9,16,25,36,..');
  

lines[0] = "512-6";
lines[1] = "595-7" ;
lines[2] = "---45" ;
lines[3] = "7244-" ;
lines[4] = "2--84" ;

wordsAcross  = ["512","595","45","7244","84"] ;
wordsDown = ["55","72","19","25","448","675"] ;

questionsAcross = [] ;
questionsAcross[1] = "$  x^{(x+1)^2} $"; // 2^9 = 512
questionsAcross[2] = "$  145x^2 + (x^2 -1)(x^2 +1) $"; // 145 x 4 + 3x5 = 580 + 15 = 595
questionsAcross[3] = " The sum of two square numbers."; 
questionsAcross[4] = "100 x 1 down $ \\times $ (3 across - 1 "; // 7200 + 44 = 7244
questionsAcross[5] = "$  x^2 + 5x $" ; // 49 + 35 = 84

questionsDown = [] ;
questionsDown[1] = " 3 across + 10 "; // 45 + 10 = 55
questionsDown[2] = "$  x^2 - x $ ";  // 9^2 - 9 = 72
questionsDown[3] = "$  x(x +1) - 1$ " ;  // 4x5 -1  = 19
questionsDown[4] = "  A square number  " ; // 25
questionsDown[5] = "$  2(x^2 + 2x)^2  - 2 $ " ; // 2(9 + 6)^2 -2 = 2 x 225 -2 = 448
questionsDown[6] = "$  x^3(x+2)^2$ " ; // 3^3 x 5^2 = 27 x 25 = 675
console.log("Puzzle 26 ",lines);
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
$("[id^=grid]").on('click', function() {

  //  $("[id^=grid]").attr("maxLength", 1) ; // this can't be done with CSS

   var focused = this.id ;
  //  $(focused).prop('maxLength', 1)
   var value = $('#' + focused).val();
    console.log('input value when clicked',focused, value) ;
    $('#key-' + value).prop('disabled', false);
    // .css({"background-color":"green","color":"white"})
    target = focused ;
    $('#' + focused).val('') ;
    // change state of number key for value 

 

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
    // initialise();

    })
})

</script>

<script>
$(document).ready(function(){

    $("#check").click(function(){

      alert("Checking");
      console.log("Checking");
    var result = true;
    var lost = false;
    var guess = [] ;
   rows = lines.length;
   let cntCorrect = 0;

   for (var r = 0; r < rows; r++)

   {
    guess[r] = "";
    for (c = 0 ; c <= 4 ; c++)
  {
    guess[r] +=  $('#grid' + r + c).val();
    guess[r] = guess[r].toUpperCase() 
 
  }
    result =  (guess[r] == lines[r]);
    cntCorrect ++ ;
    if (guess[r] !== lines[r]) 
    {
      lost = true; 
   //    alert(r + " " + guess[r] + " " + lines[r] + " " + result + " lost " + lost) ;
      }
  
  console.log("guess",r,c,guess[r],lines[r],lines[r] == guess[r],lost,result,cntCorrect) ;
 

   }
  
if (lost == true) 
  {alert("keep trying.");} 
if (lost == false  & cntCorrect == 5){
  alert('You win ' + puzzleNumber + ' ' + studentID);
 $('#puzzle-' + puzzleNumber).text('!').prop('disabled', true).css({"background-color":"yellow","color":"black"}) ;

  $('[id^=puzzle]').show();
// $('messagePlayer').load('updateCrossNumberDatabase.php', {studentID:studentID, puzzleNumber:puzzleNumber});
// ajax to update player database

      $.ajax({
  url: "updateCrossnumberDatabase.php",
  type: "POST",
  data:{studentID:studentID, puzzle:puzzleNumber},
  dataType:'text',
    success : function(data) {  

console.log("updated",data);
    }, // success
    error : function(request,error)
    {
        alert("Update error: " +JSON.stringify(request));
    } // error
});  // ajax

let url = 'readCrossnumberDatabase.php';
getQuestions(url, studentID).done(function(response){
    console.log(response);
   let l = response.length;

   for (let i = 0; i < l ; i++)
   {
    
   let target = '#puzzle-' + i;
   $('#puzzle-'+i).hide();
   }


    
    })

}





      })
  })

</script>

<script>

$(document).ready(function(){
      $('[id^=puzzle]').click(function(){

        $('[id^=grid]').prop('disabled', true).css({"background-color":"lightblue","color":"black"}).val("") ;
        $('label').empty();
        $('[id^=puzzle]').hide();
        $('#clear').show();
        var click = this.id;
    //    alert(click) ;
        var num = click.split("-");
        puzzleNumber = parseInt(num[1]) ;
       // alert("Puzzle number " + puzzleNumber);
  //      alert("Clearing grid");
      console.log("Clearing");
      console.log("Puzzle #",puzzleNumber);
// alert(click + ' ' + puzzleNumber)
      // reset colors
        $('[id^=puzzle]').css({"background-color":"blue","color":"yellow"}).val("") ;

        $('#' + click).css({"background-color":"yellow","color":"blue"}) ;
    
        for (var i = 12; i<= 14; i++)
        {
       
          $('#puzzle-'+i).css({"background-color":"green","color":"yellow"}) ;
     }
       $('#' + click).css({"background-color":"yellow","color":"blue"}) ;
   
      $('[id^=grid]').val("");
        initialise(puzzleNumber);


      })
})

  </script>

