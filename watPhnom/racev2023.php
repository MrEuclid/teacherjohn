
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Race to wat Phnom</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"></script>

  <script type="text/x-mathjax-config">
    MathJax.Hub.Config({
      extensions: ["tex2jax.js"],
      jax: ["input/TeX","output/HTML-CSS"],
      tex2jax: {inlineMath: [["$","$"],["\\(","\\)"]]}
    });
  </script>   
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.7/MathJax.js"></script>
  <script src="javascript/utilities.js"></script>

    <link rel="stylesheet" href="css/raceStyles.css">

   

<title>Race 2023</title>

    <meta charset="utf-8">
    <style>
#expression {text-align: center; ; background-color: lightblue; }
.c {text-align: center;}

#expression , #ans {width: 160px;  text-align: center; font-size: 12pt; font-weight: bold;}

#factors, #primes, #squares, #cubes ,#code , #restart
{
  background-color: blue;
  color:yellow;
  font-weight: bolder;
  font-size: 1.2em;
}
    </style>

</head>
<body>

<?php
include "../connectTeacherJohn.php" ;
$query = "select UPPER(word) from spellingWords where level >= 6 AND LENGTH(word) = 6 ORDER BY RAND()
LIMIT 1" ;
$result = mysqli_query($dbServer,$query) ;
$data = mysqli_fetch_array($result) ;
$word = $data[0] ;


$query = "select UPPER(word) from spellingWords where level >= 6 AND LENGTH(word) = 3 ORDER BY RAND()
LIMIT 1" ;
$result = mysqli_query($dbServer,$query) ;
$data = mysqli_fetch_array($result) ;
$codeWord = $data[0] ;


?>

<input id = "myWord" type = "hidden" value="<?php echo $word ; ?>">
<input id = "codeWord" type = "hidden" value = "<?php echo $codeWord ; ?>">

 <div class = "container-fluid">

<div class = "row">
<div class = "col-sm-12 c">
  <h2>
<a href="../index.php" class="btn btn-info btn-sm">Home</a>
  <button type="button" class="btn btn-primary btn-sm" id = "escapeKey">        
 <!--
       <button type="button" class="btn btn-info btn-sm" id = "help">  
        <a href = "raceHelp.html" target = "_blank">
         
          <span class="glyphicon glyphicon-info-sign"></span> Help
        </button></a>

      -->
        </h2>

      </div></div>
      <div class = "row">
      <div class = "col-sm-12 c">
      
        <input type = "text" id = "expression">
        <button id = "calc" type="button" class="btn btn-success btn-sm">Calculate</button> 
        <input type = "text" id = "ans" readonly = "true">
      
    </div></div>

    <div id = "green">
      
  
    </div>

    <div id = "playArea">
    <div class = "row">
      <div class = "col-sm-12 c">
     <p id = "word1">To move you select a place to visit and then solve a puzzle to move to the another place, 
     You can visit the places in any order but everyone starts from the Temple of Learning.
    The puzzles get harder as the number of the place gets bigger. Puzzle 1 is easy but puzzle 10 is hard. Some of the puzzles use prime numbers,</p>
    <br>
    <p id = "words2" class = "c"> After you have solved 10 puzzles you are ready to go to Wat Phnom.</p>  
     <h3> Good luck!</h3> 
  </div>
</div>

<div class = "row">
  <div class = "col-sm-12 c">  
  <img id = "picture" src = "images/watPhnom.jpg">    
</div> </div> 

<div class = "row">
  <div class = "col-sm-12 c"> 
<div id = "words3">
    <h2>Solve puzzles to visit famous places in Phnom Penh</h2>
    <h3>The winner is the first person to visit all the places and then see the Buddha statue at Wat Phnom</h3>
</div>
    </div></div>

<div class = "row">
  <div class = "col-sm-12 c"> 
 
<div id = "register"> 
  
  <button id = "restart">Go</button>
</div>

</div></div>

 <div class = "row">
    <div class = "col-sm-12 c">

      <button class = "num" id = "place1">1</button>
       <button class = "num" id = "place2">2</button>
        <button class = "num" id = "place3">3</button>
         <button class = "num" id = "place4">4</button>
          <button class = "num" id = "place5">5</button>
           <button class = "num" id = "place6">6</button>
            <button class = "num" id = "place7">7</button>
             <button class = "num" id = "place8">8</button>
              <button class = "num" id = "place9">9</button>
               <button class = "num" id = "place10">10</button>
            

  </div></div>   


  <div class = "row">
    <div class = "col-sm-12">


       <div id = "puzzle-1">
      <h2 class = "c" id = "location-1"></h2>
      <p class = "c" id = "description-1"></p>
      <h3 class = "c" id = "title-1"></h3>
      <br>
      <p class = "c" id = "question-1"></p>
      <br>
      <div id = "answer-1" class = "c">
        <label id = "label-1a"></label>
        <input id = "input-1a" type = "text" class = "data">
       <label id = label-1b > &nbsp &nbsp + &nbsp &nbsp </label>  
         <input id = "input-1b" type = "text" class = "data">
         <label id = "comment-1" class = "comments"></label>
        <label class = "c" id = "feedback-1"></label>
      
     </div>

</div> <!-- play -->
 
    

 </div> <!-- puzzle 1  -->  

  <div id = "puzzle-2">
      <h2 class = "c" id = "location-2"></h2>
      <p class = "c" id = "description-2"></p>
      <h3 class = "c" id = "title-2"></h3>
      <br>
      <p class = "c" id = "question-2"></p>
      <br>
      <div id = "answer-2" class = "c">
        <label id = "label-2a"></label>
        <input id = "input-2a" type = "text" class = "data">
       <label id = label-2b > &nbsp &nbsp x &nbsp &nbsp </label>  
         <input id = "input-2b" type = "text" class = "data">
         <input id = "hidden2X" type = "hidden">
         <input id = "hidden2Y" type = "hidden">
            <label id = "comment-2" class = "comments"></label>
     </div>

 
      <p class = "c" id = "feedback-2"></p>

   </div> <!-- puzzle 2  -->   
  




     <div id = "puzzle-3">
      <h2 class = "c" id = "location-3"></h2>
      <p class = "c" id = "description-3"></p>
      <h3 class = "c" id = "title-3"></h3>
      <br>
      <p class = "c" id = "question-3"></p>
      <br>
      <div id = "answer-3" class = "c">
        <label id = "label-3a"></label>
        <input id = "input-3a" type = "text" class = "data">
        <input id = "hidden3X" type = "hidden"> 
           <label id = "comment-3" class = "comments"></label>
    
     </div>

 
      <p class = "c" id = "feedback-3"></p>

   </div>  <!-- puzzle 3 -->

<div id = "puzzle-4">
      <h2 class = "c" id = "location-4"></h2>
      <p class = "c" id = "description-4"></p>
      <h3 class = "c" id = "title-4"></h3>
      <br>
      <p class = "c" id = "question-4"></p>
      <br>
      <div id = "answer-4" class = "c">
        <label id = "label-4a"></label>
        <input id = "input-4a" type = "text" class = "data">
       <label id = label-4b ></label>  
         <input id = "input-4b" type = "text" class = "data">
          <input id = "hidden4X" type = "hidden"> 
           <input id = "hidden4Y" type = "hidden"> 
              <label id = "comment-4" class = "comments"></label>


     </div>

 
      <p class = "c" id = "feedback-4"></p>

   </div> <!-- puzzle 4  -->   
  

<div id = "puzzle-5">
      <h2 class = "c" id = "location-5"></h2>
      <p class = "c" id = "description-5"></p>
      <h3 class = "c" id = "title-5"></h3>
      <br>
      <p class = "c" id = "question-5"></p>
      <br>
      <div id = "answer-5" class = "c">
        <label id = "label-5a"></label> &nbsp &nbsp &nbsp &nbsp 
        <input id = "input-5a" type = "text" class = "letters"  style="cursor: pointer">
           <label id = "comment-5" class = "comments"></label>
     

     
     </div>

 
      <p class = "c" id = "feedback-5">Output from answer</p>

   </div> <!-- puzzle 5 -->  



    <div id = "puzzle-6">
      <h2 class = "c" id = "location-6"></h2>
      <p class = "c" id = "description-6"></p>
      <h3 class = "c" id = "title-6"></h3>
      <br>
      <p class = "c" id = "question-6"></p>
      <br>
      <div id = "answer-6" class = "c">
        <label id = "label-6a" ></label>
        <input id = "input-6a" type = "text" class = "data">
        <input id = "hiddenN" type = "hidden"> 
           <label id = "comment-6" class = "comments"></label>
        <button>Check</button>
    
     </div>

 
      <p class = "c" id = "feedback-6"></p>

   </div> 


     <div id = "puzzle-7">
      <h2 class = "c" id = "location-7"></h2>
      <p class = "c" id = "description-7"></p>
      <h3 class = "c" id = "title-7"></h3>
      <br>
      <p class = "c" id = "question-7"></p>
      <br>
      <div id = "answer-7" class = "c">
        <label id = "label-7a" ></label>
        <input id = "input-7a" type = "text" class = "data">
        <input id = "hiddenAnswer" type = "hidden"> 
           <label id = "comment-7" class = "comments"></label>
        <button>Check</button>
    
     </div>

 
      <p class = "c" id = "feedback-7">Output from answer</p>

   </div> 


     <div id = "puzzle-8">
      <h2 class = "c" id = "location-8"></h2>
      <p class = "c" id = "description-8"></p>
      <h3 class = "c" id = "title-8"></h3>
      <br>
      <p class = "c" id = "question-8"></p>
      <br>
      <div id = "answer-8" class = "c">
        <label id = "label-8a"></label>
        <input id = "input-8a" type = "text" class = "data">
       <label id = label-8b ></label>  
         <input id = "input-8b" type = "text" class = "data">
         <input id = "hiddenAnswerX" type = "hidden"> 
         <input id = "hiddenAnswerY" type = "hidden"> 
            <label id = "comment-8" class = "comments"></label>
     </div>

 
      <p class = "c" id = "feedback-8"></p>

   </div> <!-- puzzle 8 -->  



     <div id = "puzzle-9">
      <h2 class = "c" id = "location-9"></h2>
      <p class = "c" id = "description-9"></p>
      <h3 class = "c" id = "title-9"></h3>
      <br>
      <p class = "c" id = "question-9"></p>
      <br>
      <div id = "answer-9" class = "c">
        <label id = "label-9a"></label>
        <input id = "input-9a" type = "text" class = "data">
       <label id = label-9b ></label>  
         <input id = "input-9b" type = "text" class = "data">

          <label id = label-9c ></label>  
         <input id = "input-9c" type = "text" class = "data">
         <input id = "hiddenAnswerA" type = "hidden"> 
         <input id = "hiddenAnswerB" type = "hidden"> 
        <input id = "hiddenAnswerC" type = "hidden"> 
           <label id = "comment-9" class = "comments"></label>
     </div>

 
      <p class = "c" id = "feedback-9"></p>

   </div> <!-- puzzle 9 -->  



     <div id = "puzzle-ten">
      <h2 class = "c" id = "location-ten"></h2>
      <p class = "c" id = "description-10"></p>
      <h3 class = "c" id = "title-ten"></h3>
      <br>
      <p class = "c" id = "question-ten"></p>
      <br>
      <div id = "answer-ten" class = "c">
        <label id = "label-tena"></label>
        <input id = "input-tena" type = "text" class = "data">
       <label id = "label-tenb" ></label>  
         <input id = "input-tenb" type = "text" class = "data">

          <label id = "label-tenc" ></label>  
         <input id = "input-tenc" type = "text" class = "data">
         <input id = "hiddenAnswerP" type = "hidden"> 
         <input id = "hiddenAnswerQ" type = "hidden"> 
        <input id = "hiddenAnswerR" type = "hidden"> 
           <label id = "comment-ten" class = "comments"></label>
     </div>

 
      <p class = "c" id = "feedback-ten"></p>

   </div> <!-- puzzle 10--> 

    </div></div>


  <div class = "row">
  <div class = "col-sm-12 c"> 
 <p id = "userData"></p>
  </div></div>
  
 <div class = "row">
  <div class = "col-sm-12 c"> 
    <p class = "c" id = "visited"></p>
  </div></div>

   <div class = "row">
  <div class = "col-sm-12 c"> 

    <button id = "factors">Factors</button>
    <button id = "primes">Prime numbers</button>
    <button id = "squares">Square numbers</button>
    <button id = "cubes">Cubes</button>
    <button id = "code">Codes</button>

   <p id = "factorList" class = "c"></p>
    <p id = "primeNumbers" class = "c"></p>
    <p id = "squareNumbers" class = "c"></p>
    <p id = "cubeNumbers" class = "c"></p>
    <p id = "letters" class = "c"></p>
  </div></div>

</div>
   </body>
</html>




<script type="text/javascript">
  function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

</script>



<script type="text/javascript">
  function makeShiftPlusMinus(n)
  // caesar code 
  {
   start = 65 ;
   end = 91 ;

   $('#letters').empty() ;
  
   var forwardShift = 0 ;
   var backShift  = 0 ;
  
  for (i = 0 ;i <= 25; i++)
  {
  letters[i] = String.fromCharCode(i+65) ;
  $('#letters').append(letters[i] + "\t") ;
}

$('#letters').append('<br><br>') ;
 for (i = 0  ;i <= 25  ; i++)

  {
   place = i + n ;
   if (place > 25) {place = place % 25 -1 ;}
   shiftForward[i] = letters[place] ;
    $('#letters').append(shiftForward[i] + "\t") ;
}

$('#letters').append('<br><br>') ;
 for (i = 0  ;i <= 25  ; i++)

  {
   place = i - n ;
   if (place < 0 ) {place = 25 + place + 1 ; ;}
   shiftBack[i] = letters[place] ;
    $('#letters').append(shiftBack[i] + "\t") ;
}



  }
</script>

<script type="text/javascript">
  
  function isPrime(num) {
  var sqrtnum=Math.floor(Math.sqrt(num));
    var prime = num != 1;
    for(var i=2; i<sqrtnum+1; i++) { // sqrtnum+1
        if(num % i == 0) {
            prime = false;
            break;
        }
    }
    return prime;
}
</script>

<script type="text/javascript">
  
  function makePrimes(limit) 
  {
 // var limit = 999 ;
  var cnt = 1 ;
  n = 2 ;
  primes[1] = n ;
  $('#primeNumbers').empty() ;
  $('#primeNumbers').append(n + "\t") ;
    var n = 3  ;
      $('#primeNumbers').append(n + "\t") ;
  while (n <= limit)
  {
   n = n + 2 ;
   if (isPrime(n) == true) 
    {primes[cnt] = n ;
        $('#primeNumbers').append(n + "\t") ;
      cnt = cnt + 1 ;
    if (cnt % 10 == 0) { $('#primeNumbers').append('<br>') ;} 
    }
  

  }
}
</script>


<script type="text/javascript">
  
  function makeCubes() 
  {

  $('#cubeNumbers').empty() ;   
  var limit = 40 ;
  var cnt = 1 ;
  n = 1 ;

  for (i = 1 ; i <= limit ; i++)
  {
  
  
    {  n = i*i*i ;
      cubes[i] = n ;
        $('#cubeNumbers').append(n + "\t") ;
      cnt = cnt + 1 ;
    if (cnt % 10 == 0) { $('#cubeNumbers').append('<br>') ;} 
    }
  

  }
}
</script>


<script type="text/javascript">
  
  function makeSquares() 
  {

  $('#squareNumbers').empty() ;   
  var limit = 99 ;
  var cnt = 1 ;
  n = 1 ;

  for (i = 1 ; i <= limit ; i++)
  {
  
  
    {  n = i*i ;
      squares[i] = n ;
        $('#squareNumbers').append(n + "\t") ;
      cnt = cnt + 1 ;
    if (i% 10 == 0) { $('#squareNumbers').append('<br>') ;} 
    }
  

  }
}
</script>

<script type="text/javascript">
  function makeFactors(n) 
  {

  $('#factorList').empty() ;   
 
var cnt = 0 ;

  for (i = 1 ; i <= n ; i++)
  {
  
  
    if (n % i == 0 )
       { $('#factorList').append(i + "\t") ;
      cnt = cnt + 1 ;
    if (cnt % 20 == 0) { $('#factorList').append('<br>') ;} 
    }
  

  }
}
</script>


<script type="text/javascript">

  function hideAll()
  {
  $('#squares').hide() ;
  $('#cubes').hide() ;
  $('#primes').hide() ;
  $('#primeNumbers').hide() ;
  $('#squareNumbers').hide() ;
  $('#cubeNumbers').hide() ;
  $('#letters').hide() ;
  $('#factors').hide() ;
  $('#factorList').hide() ;
  $('#code').hide() ;
  $('[id^=puzzle]').hide() ;


 //  $('[id^=words]').hide() ;
 //  $('[id^=puzzle]').hide() ;
     $('[id^=answer]').hide() ;
     $('[id^=question]').hide() ;
      $('[id^=location]').hide() ;
       $('[id^=description]').hide() ;
     $('[id^=title]').hide() ;
     $('[id^=feedback]').hide() ;
     $('[id^=comment-]').hide() ;
  // $('[id^=place]').hide() ;
}

</script>


<script type="text/javascript">
  
  primes  = [] ;
  squares = [] ;
  cubes   = [] ;
  factors = [] ;
  letters = [] ;
  shiftForward = [] ;
  shiftBack = [] ;
  numbers = [] ;
  solved = [] ;




  makePrimes(200) ;
  makeSquares() ;
  makeFactors()  ;
  makeCubes() ;
  makeShiftPlusMinus(1) ;
  hideAll() ;

  $('#escapeKey').hide() ;

</script>
=


<script type="text/javascript">
  
function encryptWord(word) 

{
 
var l = word.length ;
var changed = word.split("") ;
// alert(letters + shiftForward + shiftBack) ;
var code= [] ;
var changed = [] ;
changed = word ;  
var str = '' ;
var newLetter ;
// alert('Changed = ' + word + '  ' + changed  + '  ' +  word[3] + ' c3 ' + changed[3] ) ;
for (var i = 0 ; i < l ; i++)
{
var x = getRandomInt(1,2) ;
var index = letters.indexOf(word[i]) ;

if (x == 1 ) {newLetter = shiftForward[index] ;} 
else {newLetter = shiftBack[index] ; }

// Split string into an array


// Replace char at index
str = str + newLetter;


// Output new string
changed = str ;
// alert(' x ' + x + 'str' + str +  ' i = '  + i + ' index ' + index + ' changed i' + changed[i] + ' ' + changed
//  + ' forward ' + shiftForward[index] + ' back ' + shiftBack[index]) ;

}
  

 code = str ; 
// alert('Code = ' + code) ;
code = code.toUpperCase() ;
console.log(5,changed,code,word) ;
return code ;  
}

</script>

<script type="text/javascript">
  
  function factorOf(n)

  {
    factors = [] ;
    cnt = 0 ;
for (i = 1 ; i < n ;i++)
if (n % i == 0)
  {cnt = cnt + 1 ;
    factors[cnt] = i ;
  }
}
</script>

<script type="text/javascript">
  
  function powerMod(base, exponent, modulus) {
    if (modulus === 1) return 0;
    var result = 1;
    base = base % modulus;
    while (exponent > 0) {
        if (exponent % 2 === 1)  //odd number
            result = (result * base) % modulus;
        exponent = exponent >> 1; //divide by 2
        base = (base * base) % modulus;
    }
    return result;
}
</script>


<script type="text/javascript">
  
  function encodeWord(word) 

  {
    var numbers = [] ; // array to hold codes.

    // based on RSA
  //  n = 33 , e = 7 (d = 3)
  // powerMod(base, exponent modulus). e.g. 3^7 mod 35 = powerMod(3,7,50)

  var n = 33 ;
  var e = 7 ;
  var firstLetter = word.substr(0,1);
  var secondLetter = word.substr(1,2);
  var thirdLetter  = word.substr(2); 


  var n1 = firstLetter.charCodeAt(0) - 64;
  var n2 = secondLetter.charCodeAt(0) - 64 ;
  var n3 = thirdLetter.charCodeAt(0) - 64 ;

//  alert('hiddens to be encoded ' + n1+n2+n3) ;

  // now get ascii - 65 ;
numbers[0] = powerMod(n1,e,n) ;
numbers[1] = powerMod(n2,e,n) ;
numbers[2] = powerMod(n3,e,n) ;

// alert('Word ' + word + ' numbers ' + numbers) ;

    return numbers ;
  }
</script>



<script type="text/javascript">
  
  function isSquare(num) {
  var sqrtNum=Math.floor(Math.sqrt(num));
   
   if (sqrtNum*sqrtNum == num)
    {square = true ; } else {square = false ;}
   
    
    return square;
}
</script>


<script type="text/javascript">
  
  function displayUnsolved()
  {
     
    var escapeCode = 0 ;
    for (var x = 1 ; x <= 10 ; x++)
    {if (solved[x] == 1) {escapeCode = escapeCode + Math.pow(2,x) ; }}

escapeCode = parseInt(escapeCode) ;

  $('#escapeKey').text(escapeCode) ;

  // alert('Escape code = ' + escapeCode + '  ' + solved) ;


  var cnt = 0 ;  
   
// alert('Showing unsolved display ' + solved);
   $('[id^=place]').show() ;
   for (var i = 1 ; i <=10 ; i++)
   {
    if (solved[i] == 1)
      {cnt = cnt + 1 ;
        $('#place'+i).attr('disabled',true).css({"background-color":"green"}) ;
       }
// replaced < 9 with < 1
     if (cnt < 9 ) {$('#place10').attr('disabled',true).css({"background-color":"red"}) ;} 
     else {$('#place10').attr('disabled',false).css({"background-color":"blue"}) ;
    $('[id^=place]').show() ; }

     // change after debugging
     
   hideAll() ;
   }  
  }
</script>

<script type="text/javascript">
  
  function decodeQ(n) 
  {
 // converts n to binary 
 var temp =  [] ;
 n = parseInt(n) ;
 var base2 = n.toString(2);
 // alert('Base 2 = ' + base2) ;
 var l = base2.length ;


 for (var i = 0 ; i <= 10 ; i++)   // zero all places 
  {temp[i] = 0 ; }



//  alert('Base 2 = ' + base2 + ' length = ' + l) ;

for (var i = 0 ; i < l ;  i++)
  {temp[i+1] = base2[i] ;}



 return temp  ;

  }
</script>


<script type="text/javascript">

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};

</script>

<script type="text/javascript">
  

 $(document).ready(function () {
 
// happens on load and reload

   $('[id^=place]').hide() ;

hideAll();
  solved = [] ;
  for (i = 1 ; i <= 10 ; i++)
    {solved[i] = 0 ; }
// start from 0




var p = getUrlParameter('q') ;
// alert('q -> p ' + p) ;


if (p > 0)

{ solved = decodeQ(p) ;
alert('Solved = ' + solved) ;
escapeCode= $('#escapeKey').text() ;
escapeCode = parseInt(escapeCode) ;
var cnt = 0 ;  
// alert('Showing unsolved display ' + solved);

//   $('[id^=place]').show() ;

   for (var i = 1 ; i <=10 ; i++)
   {
    if (solved[i] == 1)
      {cnt = cnt + 1 ;
        $('#place'+i).attr('disabled',true).css({"background-color":"green"}) ; }
// replaced < 9 with < 1
     if (cnt < 9 ) {$('#place10').attr('disabled',true).css({"background-color":"red"}) ;} 
     else {$('#place10').attr('disabled',false).css({"background-color":"blue"}) ;}
}
     // change after debugging

    // alert('All buttons written to screen');

}

   

 })
</script>

<script type="text/javascript">
  
   $(document).ready(function(){  

$('#green').load("greenLightab.php");
$('#playArea').hide();
$('#green').show();
$('#place10').attr('disabled',true).css({"background-color":"red"}) ;
$('[id^=input-1]').on('change',function(e){
 $('[id^=place]').hide() ;
//  $('[id^=place]').show() ;

$('#primeNumbers').show() ;
$('#primes').show() ;
$('#puzzle-1').show() ;
var answerA =  parseInt($('#input-1a').val()) ;
var answerB =  parseInt($('#input-1b').val()) ;
pA = isPrime(answerA) ;
pB = isPrime(answerB) ;

if (isNaN(answerA)){answerA = 0 ;}
if (isNaN(answerB)){answerB = 0 ;}

solution = answerA + answerB ;

$('#comment-1').text(solution) ;

// alert(pA + pB) ;
if (( pA == false | pB == false) & (answerA > 1  & answerB > 1)) {alert('You can only use prime numbers!') ;}


// $('#feedback-1').text('Your answer is ' + solution) ;
var x = parseInt($('#label-1a').text()) ;
if (x == solution & isPrime(answerA) & isPrime(answerB)  & (answerA > 0 & answerB > 0))
{
$('#comment-1').text(solution) ;
 solved[1] = 1 ;
 $('#escapeKey').text('2') ;
  $('#primeNumbers').hide() ;
 alert('Solved puzzle 1 ' + x + ' = ' + answerA + ' + ' + answerB + '  ' + solved) ; 
 $('#restart').hide() ;
 $('#escapeKey').show() ;
 displayUnsolved() ;
 $('#visited').append('<img class = "thumb c" src = "images/temple.png">')} 
 else { 
 alert('Keep trying!') ;
  };
// alert('Not yet! ' + solution) ;

 // else {alert('Not solved yet ')}
});

})
</script>

<script type="text/javascript">
  
   $(document).ready(function(){  

// goes with puzzle 2
// hideAll() ;
// $('[id^=place]').hide() ;
$('[id^=input-2]').on('change',function(e){

$('#primeNumbers').show() ;
$('#primes').show() ;
$('#puzzle-2').show() ;
$('#comment-2').show() ;
var answerX =  parseInt($('#input-2a').val()) ;
var answerY =  parseInt($('#input-2b').val()) ;

if (isNaN(answerX)){answerX = 1 ;}
if (isNaN(answerY)){answerY = 1 ;}

$('#comment-2').text(solution) ;
pX = isPrime(answerX) ;
pY = isPrime(answerY) ;
// alert(pA + pB) ;
if ((pX == false | pY == false) & (answerX > 1 & answerY > 1))  {alert('You must use prime numbers!') ;}
var solution = answerX * answerY ;
//alert('Solution ' + solution) ;
$('#comment-2').text(solution) ;

var x = parseInt($('#hidden2X').val()) ;
var y = parseInt($('#hidden2Y').val()) ;

if (x *y == solution & isPrime(answerX) & isPrime(answerY) )
{$('#comment-2').text('Solved') ;

 solved[2] = 1 ;
 $('#primeNumbers').hide() ;
 alert('Solved puzzle 2 ' + solution + ' = ' + answerX + ' x ' + answerY + '  ' + solved) ; 
 displayUnsolved() ;
 $('#visited').append('<img class = "thumb c" src = "images/russianMarket.jpg">') ;} 
 else { if (answerX > 1 & answerY > 1){alert('Keep trying!') ;}}
});

})
</script>


<script type="text/javascript">
  
   $(document).ready(function(){  

// goes with puzzl3 3

// x62 - y^2 = Prime

$('[id^=input-3]').on('change',function(e){

$('#squareNumbers').show() ;
$('#squares').show() ;
$('#puzzle-3').show() ;
var answerA =  parseInt($('#input-3a').val()) ;
var x = $('#hidden3X').val() ;
x = parseInt(x) ;
var solution = 4*answerA * answerA + 1 ;  //
alert('Solution ' + solution + 'x = ' + answerA ) ;
$('#comment-3').text(solution) ;

if (x == answerA & x > 0)
{
$('#feedback-3').text('Solved') ;
$('#input-3a','#input-3b','label-3a').css({"background-color":"green","color":"white"}) ;
solved[3] = 1 ;
$('#squareNumbers').hide() ;
$('#squares').hide() ;
alert('Solved puzzle 3 ' + 'x ' + ' = ' + answerA) ; 
solved[3] = 1 ;
 displayUnsolved() ;
 $('#visited').append('<img class = "thumb c" src = "images/aeonMall.jpg">')} 
  else {alert('Keep trying'); }
});

})
</script>


<script type="text/javascript">
  
   $(document).ready(function(){  
// hideAll();
// goes with puzzle 4
$('[id^=input-4]').on('change',function(e){
 //  alert('Changed! ' ) ;
$('#puzzle-4').show() ;
$('#comment-4').show() ;

var answerX = 0 ;
var answerY = 0 ;
answerX =  parseInt($('#input-4a').val()) ;
answerY =  parseInt($('#input-4b').val()) ;



var solution = answerX*answerX - answerY*answerY ;
 // alert(' attempted Solution ' + solution) ;
$('#comment-4').text(solution) ;

var x = $('#hidden4X').val() ;
var y = $('#hidden4Y').val() ;
var diff = x*x - y*y ;

x = parseInt(x) ;
y = parseInt(y) ;

if (isNaN(answerX)){answerX = 0 ;}
if (isNaN(answerY)){answerY = 0 ;}
var z = x*x - y*y ;

if (z == solution & answerX > 0 & answerY > 0 )
{
  $('#comment-4').text('z') ;

 solved[4] = 1 ;
 alert('Solved puzzle 4 ' + 'x  = ' + answerX + ' y =  ' + answerY) ; 
 displayUnsolved() ;
 $('#visited').append('<img class = "thumb c" src = "images/sisowatQuay.jpg">')
} 
 else 
  { 
    if (answerX > 0 & answerY > 0)
    {alert('Q4 - Not solved yet ');}
  }
});

})
</script>

<script type="text/javascript">
  


  
   $(document).ready(function(){  

// goes with puzzle 5
  $('#input-5a').on('change', function(){


// alert('Student ID ' + studentID) ;

//alert('Clicker') ;



var answerA =  $('#input-5a').val() ;
$('#puzzle-5').show() ;

var solution = answerA ;
 //alert(' attempted Solution ' + answerA) ;


$('#comment-5').text(solution) ;
myWord = $('#myWord').val() ;
myUpperWord = myWord.toUpperCase() ;
//alert('My word = ' + myUpperWord + '<-- ' + myWord) ;


if (myUpperWord.toUpperCase() == solution.toUpperCase() & solution > "")
{
  $('#comment-5').text('Solved') ;
 solved[5] = 1 ;
 alert('Solved puzzle 5 ' + 'Word   = ' + answerA) ; 
 displayUnsolved() ;
 $('#visited').append('<img class = "thumb c" src = "images/sisowatQuay.jpg">'); 
} 
else {alert('Not solved yet.');}



 
});

})
</script>


<script type="text/javascript">
  
   $(document).ready(function(){  

// goes with puzzl3 3

// x62 - y^2 = Prime

$('[id^=input-6]').on('change',function(e){

$('#puzzle-6').show() ;
$('#comment-6').show() ;
var guessN = parseInt($('#input-6a').val()) ;
var answerA =  Math.pow(2,guessN) - 1 ;
var n = $('#hiddenN').val() ;
n = parseInt(n) ;
var solution = Math.pow(2,n) -1  ;  
var myValue = Math.pow(2,guessN) -1 ;//
// alert('Solution ' + solution + 'n = ' + n) ;
$('#comment-6').text(myValue) ;

if (guessN == n & n > 0)
{
$('#fcomment-6').text('Solved') ;


$('#squareNumbers').hide() ;
$('#squares').hide() ;
alert('Solved puzzle 6' + 'n' + ' = ' + answerA) ; 
solved[6] = 1 ;
 displayUnsolved() ;
 $('#visited').append('<img class = "thumb c" src = "images/phsar_thmei.jpg">')} else {alert('Not solved yet ')}
});

})
</script>




<script type="text/javascript">
  
   $(document).ready(function(){  

// goes with puzzle 7

$('#puzzle-7').show() ;
$('#comment-7').show() ;

$('[id^=input-7]').on('change',function(e){

var answerA = parseInt($('#input-7a').val()) ;


var solution = $('#hiddenAnswer').val() ;

//solution = $('#hiddenAnswer').val(n) ;


// var solution = Math.pow(2,n) -1  ;  //
// alert('Solution ' + solution + 'n = ' + n) ;
$('#comment-7').text(answerA) ;

if (solution == answerA & answerA > '')
{
$('#comment-7').text('Solved') ;


//$('#squareNumbers').hide() ;
//$('#squares').hide() ;
alert('Solved puzzle 7' + 'n' + ' = ' + answerA) ; 
solved[7] = 1 ;
 displayUnsolved() ;
 $('#visited').append('<img class = "thumb c" src = "images/silverPagoda.jpg">')} else {alert('Not solved yet ')}
});

})
</script>




<script type="text/javascript">
  
   $(document).ready(function(){  

// goes with puzzle 8
hideAll() ;
// $('[id^=place]').hide() ;
$('[id^=input-8]').on('change',function(e){
$('#puzzle-8').show() ;
$('#comment-8').show() ;
$('#cubeNumbers').show() ;
$('#cubes').show() ;
var answerA =  parseInt($('#input-8a').val()) ;
var answerB =  parseInt($('#input-8b').val()) ;

if (isNaN(answerA)){answerA = 0 ;}
if (isNaN(answerB)){answerB = 0 ;}

// alert(pA + pB) ;
sumAB = answerA*answerA*answerA + answerB*answerB*answerB ;
diffAB = answerA*answerA*answerA - answerB*answerB*answerB ;

var solutionX = $('#hiddenAnswerX').val() ;
var solutionY = $('#hiddenAnswerY').val() ;

//alert('Solution ' + solution) ;
$('#comment-8').text('sum = ' + sumAB + ' difference =  ' + diffAB) ;

if (answerA == solutionX & answerB == solutionY  & (answerA > 0 & answerB > 0))
{$('#comment-8').text('Solved') ;

 solved[8] = 1 ;
 $('#cubeNumbers').hide() ;
 alert('Solved puzzle 8 ' + ' m = ' + answerA + ' n = ' + answerB) ; 
 displayUnsolved() ;
 $('#visited').append('<img class = "thumb c" src = "images/royalPalace.jpg">')} 
 else {
  if (answerA > 0 & answerB > 0) {alert('Not solved yet ')}
}
});

})
</script>



<script type="text/javascript">
  
   $(document).ready(function(){  

// goes with puzzle 9
hideAll() ;
// $('[id^=place]').hide() ;
$('[id^=input-9]').on('change',function(e){

$('#primeNumbers').show() ;
$('#primes').show() ;
$('#puzzle-9').show() ;
$('#comment-9').show() ;
var answerA =  parseInt($('#input-9a').val()) ;
var answerB =  parseInt($('#input-9b').val()) ;
var answerC =  parseInt($('#input-9c').val()) ;

pA = isPrime(answerA) ;
pB = isPrime(answerB) ;
pC = isPrime(answerC) ;
// alert(pA + pB) ;
if ( pA == false | pB == false | pC == false) {alert('You must use prime numbers!') ;}


var solutionA = $('#hiddenAnswerA').val() ;
var solutionB = $('#hiddenAnswerB').val() ;
var solutionC = $('#hiddenAnswerC').val() ;

var a = answerA ;
var b = answerB ;
var c = answerC ;

var myDenominator = a*b*c ;
var myNumerator = a*b + a*c + b*c ;

var myFraction = '$ \\frac{' + myNumerator + '}{' + myDenominator + '} $' ;


$('#comment-9').html(myFraction);

// numbera,B,C are the encoded numbers based on the letters
 MathJax.Hub.Queue(["Typeset", MathJax.Hub, "feedback-9"]);

if (answerA == solutionA & answerB == solutionB  & answerC == solutionC & (answerA > 0 & answerB > 0 & answerC > 0))
{$('#comment-9').text('Solved') ;
$('#input-9a','#input-9b','label-9a', "#input-9c").css({"background-color":"green","color":"white"}) ;
 solved[9] = 1 ;
 $('#cubeNumbers').hide() ;
 alert('Solved puzzle 9 ' + ' a = ' + answerA + ' b = ' + answerB + ' c = ' + answerC) ; 
 displayUnsolved() ;
 $('#visited').append('<img class = "thumb c" src = "images/nationalMuseum.jpg">')} 
 else {
  if (answerA > 0 & answerB > 0 & answerC > 0)
    {alert('Not solved yet ')}
}
});

})
</script>



<script type="text/javascript">
  
   $(document).ready(function(){  

hideAll() ;

$('[id^=input-ten]').on('change',function(e){


// $('[id^=place]').hide() ;
// alert('Input question 10');
$('#puzzle-10').show() ;
$('#content-ten').show() ;
solutionP = $('#hiddenAnswerP').val() ;
solutionQ = $('#hiddenAnswerQ').val() ;
solutionR = $('#hiddenAnswerR').val() ;



var answerP = $('#input-tena').val() ;
var answerQ = $('#input-tenb').val() ;
var answerR = $('#input-tenc').val() ;

solutionP = solutionP.toUpperCase() ;
solutionq = solutionQ.toUpperCase() ;
solutionR = solutionR.toUpperCase() ;

//alert('Solution Q. = ' + solutionQ) ;

answerP = answerP.toUpperCase() ;
answerQ = answerQ.toUpperCase() ;
answerR = answerR.toUpperCase() ;

//alert('Answer Q. = ' + answerQ) ;

//alert(answerP+answerQ+answerR+' compared with ' + solutionP+solutionQ+solutionR) ;

$('#puzzle-10').show() ;
if (answerP == solutionP & answerQ == solutionQ  & solutionR == answerR 
  & (answerA > '' & answerB > '' & answerC > ''))
{$('#comment-ten').text('Solved') ;

 solved[10] = 1 ;
 alert('Solved puzzle 10 ' + ' a = ' + answerP + ' b = ' + answerQ + ' c = ' + answerR) ; 
 displayUnsolved() ;
var photo = "images/buddha.jpg" ;
$("#picture").attr("src",photo);  
 $('#visited').append('<img class = "thumb c" src = "images/watPhnom.jpg">')

} 
else {
if (answerA > '' & answerB > '' & answerC > '')
  {alert('Not solved yet ')}
}
});

})
</script>


<script type="text/javascript">

 $(document).ready(function () {

  $('[id^=place]').on("click", function(event) {

//$('#l1,#l2').on("click", function(event) {
$('[id^=place]').show() ;
 //$('[id^=light').css({"background-color":"black" , "color":"white"}) ;
 // $('[id^=light').html('----') ;
    var place =  $(this).attr("id"); 
  
  // hideAll() ;
  if (place == 'ten'){place = 10 ;}

else{
    place = place.substr(5) ;}
    place = parseInt(place) ;
 //   alert('Place = ' + place) ;
 $('[id^=place]').hide() ;
    if (place == 1) 
      {  
  $('#puzzle-1').show() ;
  $('#question-1').show() ;
  makePrimes(110) ;
  $('#primeNumbers').show() ;
  $('#primes').show() ;

  var prime = false
  while (prime == false)
  {
  var n1 = getRandomInt(50,75);
  prime = isPrime(n1) ;
}

  var prime = false
  while (prime == false )
  {
  var n2 = getRandomInt(n1+1,100);
  prime = isPrime(n2) ;
}
  n = n1 + n2 ;
  console.log(1,n,n1,n2) ;

  $('#hiddenX').val(n1) ;
  $('#hiddenY').val(n2) ;

 // alert(n + ' ' + n1 + ' + ' + n2) ;
  $('#label-1a').show() ;
  $('#label-1a').text(n + ' = ') ;
  $('#label-1b').show() ;

  $('#answer-1').show() ;
  $('#comment-1').show() ;
  
  var solved = false ;
  var question = 'Find two prime numbers that add together to equal ' + n ;

  var photo = "images/temple.png" ;
  $("#picture").attr("src",photo);  
  var location = "PIO - Temple of Learning" ;
  var description = "A place where students, study, learn and achieve!" ;  
  var title = "Question 1" ;
 
  $('#location-1').text(location) ;
  $('#description-1').text(description) ;
  $('#title-1').text(title) ;
  $('#question-1').text(question) ;



}


    if (place == 2) 
      { 
  hideAll() ;     
  $('#puzzle-2').show() ;
  $('#question-2').show() ;
  $('#answer-2').show() ;
  $('#feedback-2').show() ;
  $('#comment-2').show() ;

    makePrimes(100)  ;
   $('[id^=words]').show() ;
   $('#primeNumbers').show() ;
   $('#primes').show() ;
 //  $('[id^=puzzle]').show() ;
  // $('[id^=answer]').show() ;
 $('[id^=place]').hide() ;
// alert('Place = ' +place) ;
  var prime = false
  while (prime == false)
  {
  var n1 = getRandomInt(30,50);
  prime = isPrime(n1) ;
}

  var prime = false
  while (prime == false )
  {
  var n2 = getRandomInt(n1+1,75);
  prime = isPrime(n2) ;
}

m = n1*n2 ;
console.log(2,m,n1,n2);

$('#hidden2X').val(n1) ;
$('#hidden2Y').val(n2) ;
// alert(m + ' ' + n1 + ' * ' + n2) ;
  $('#label-2a').show() ;
  $('#label-2a').text(m + ' = ') ;
  $('#label-2b').show() ;

  $('#answer-2').show() ;
  
  var solved = false ;
  var question = 'Find two prime numbers that multiply together to equal ' + m ;

  var photo = "images/russianMarket.jpg" ;
  $("#picture").attr("src",photo);  
  var location = "The Russian Market" ;
  var description = "A place where where people go shopping. It is popular with toursits. It is called the " + "Russian Market because in the 1980s it is where Russian tourists went shopping. The Khmer name is Psar Tuol Tompong"  ;  
  var title = "Question 2" ;
 
  $('#location-2').text(location).show() ;
  $('#description-2').text(description).show() ;
  $('#title-2').text(title).show() ;
  $('#question-2').text(question).show() ;


}


    if (place == 3) 
      {  
    hideAll() ;      
  $('#puzzle-3').show() ;
  $('#question-3').show() ;
  $('#answer-3').show() ;
   $('#comment-3').show() ;
 

    makeSquares() ;
   $('[id^=words]').show() ;
   $('#squareNumbers').show() ;
   $('#squares').show() ;
 //  $('[id^=puzzle]').show() ;
  // $('[id^=answer]').show() ;
// $('[id^=place]').hide() ;
// alert('Place = ' +place) ;

 var x = getRandomInt(50,99) ;
  var y = 4*x*x+1 ;

  var x = Math.sqrt((y-1)/4) ;
  console.log(3,x);
  $('#hidden3X').val(x) ;
  // alert(y + ' = 4' + x + '^2 + 1' ) ;
  $('#label-3a').show() ;
  $('#label-3a').text('$x = $') ;
  MathJax.Hub.Queue(["Typeset", MathJax.Hub, "label-3a"]);
 

  $('#answer-3').show() ;
  
  var solved = false ;
  var question = 'The question is to find the value of x where ' + '$4x^2 + 1 =  $' + y ;

  var photo = "images/aeonMall.jpg" ;
  $("#picture").attr("src",photo);  
  var location = "Aeon Mall" ;
  var description = "The newest and biggest shopping mall in Cambodia.  It is very popular and it is always full of shoppers.It has many shops and the things they sell are of good quality but they are expensive."  ; 

  var title = "Question 3" ;
 
  $('#location-3').text(location).show() ;
 
  $('#description-3').text(description).show() ;
  
  $('#title-3').text(title) ;
  $('#question-3').text(question) ;
    MathJax.Hub.Queue(["Typeset", MathJax.Hub, "question-3"]);




}

  if (place == 4) 
      {  

    hideAll() ;      
  $('#puzzle-4').show() ;
  $('#question-4').show() ;
  $('#answer-4').show() ;
 $('#comment-4').show() ;


    $('#squareNumbers').empty() ;
    makeSquares() ;

 
   $('[id^=words]').show() ;
   $('#squareNumbers').show() ;
   $('#squares').show() ;
 //  $('[id^=puzzle]').show() ;
  // $('[id^=answer]').show() ;
// $('[id^=place]').hide() ;
// alert('Place = ' +place) ;

  var y = getRandomInt(20,30);
  var x = getRandomInt(30,40);
  z = x*x - y*y ;
  makeFactors(z) ;

  $('#hidden4X').val(x) ;
  $('#hidden4Y').val(y) ;

  $('#squares').show() ;
  $('#squareNumbers').show() ;
  console.log(4,x,y,z);4

// alert(z + ' ' + x + ' * ' + y) ;
  $('#label-4a').show() ;
  $('#label-4a').text( 'x = ') ;
  $('#label-4b').show() ;
  $('#label-4b').text('y = ') ;
  $('#input-4a').show() ;
  $('#input-4b').show() ;

  // $('#answer-4').show() ;
  
  var solved = false ;
  var question = 'Find  x and y so that ' + '$x^2 - y^2$'+ ' =  ' + z 
  + '<br>' + '$(x + y) $ ' + ' and '+ '$(x-y) $' + ' are factors of ' + z + '<br>' ;

  var photo = "images/sisowatQuay.jpg" ;
  $("#picture").attr("src",photo);  
  var location = "Sisowat Quay" ;
  var description = "A place where where people go to relax. Enjoy the beautiful river and have a meal at one of the many places to eat from roadside stalls to restaurant. Finish the day with a sunset cruise on the river."  ;  
  var title = "Question 4" ;
 
  $('#location-4').text(location).show() ;
  $('#description-4').text(description).show() ;
  $('#title-4').text(title).show() ;
  $('#question-4').html(question).show() ;

   MathJax.Hub.Queue(["Typeset", MathJax.Hub, "question-4"]);

}


  if (place == 5) 
      {  


  hideAll() ;      
  $('#puzzle-5').show() ;
  $('#question-5').show() ;
  $('#answer-5').show() ;
   $('#comment-5').show() ;

    makeShiftPlusMinus(1) ;
    $('#letters').show() ;
    $('#code').show() ;
  //  $('#codes').show() ;
   $('[id^=words]').show() ;
  
 //  $('[id^=puzzle]').show() ;
  // $('[id^=answer]').show() ;
 $('[id^=place]').hide() ;
// alert('Place = ' +place) ;

 myWord = $('#myWord').val() ;

 myWord = myWord.toUpperCase() ;

 encryptedWord = encryptWord(myWord) ;
 encryptedWord = encryptedWord.toUpperCase() ;

//  alert(myWord + ' ' + encryptedWord) ;
  $('#label-5a').show() ;
  $('#label-5a').text(encryptedWord) ;

 console.log(5,encryptedWord);

  $('#answer-5').show() ;
  
  var solved = false ;
  var question = 'The word has been turned into a code by changing letters to either the next letter in the alphabet or the previous letter. So C could be changed into D or B. The letter Z could have been changed into Y or A. The letter A could be changed into B or Z. Break the code to find nout what the word was befored it was encoded.';

  var photo = "images/independenceMonument.jpg" ;
  $("#picture").attr("src",photo);  
  var location = "Independence Monument" ;
  var description = "The Independence Monument was built to celebrate Cambodia gaining its independence from France. Cambodia became independent in 1953 after being ruled by the French for more than 100 years."  ; 

  var title = "Question 5" ;
 
  $('#location-5').text(location).show() ;
 
  $('#description-5').text(description).show() ;
  
  $('#title-5').text(title).show() ;
  $('#question-5').text(question).show() ;
   




}


 if (place == 6) 
      {  
// y = 2^n -1 n odd y prime

  hideAll() ;      
  $('#puzzle-6').show() ;
  $('#question-6').show() ;
  $('#answer-6').show() ;
   $('#comment-6').show() ;

 
  
 //  $('[id^=puzzle]').show() ;
  // $('[id^=answer]').show() ;
// $('[id^=place]').hide() ;
// alert('Place = ' +place) ;




  // alert(myWord + ' ' + encryptedWord) ;
 

 

  $('#answer-6').show() ;
  
  var solved = false ;
  var n = getRandomInt(12,20) ;
  
  if (n % 2 ==0 ){n = n + 1 ;}

   var m = Math.pow(2,n)-1 ;
  $('#hiddenN').val(n) ;

  console.log(6,n);

   $('#label-6a').show() ;
  $('#label-6a').text('n = ') ;
 
  var question = "Find the value of n that makes this equation true.   " + 
  '$ 2^n -1 = $' + m 
  +   " where n is an odd number." ;

  

  var photo = "images/phsar_thmei.jpg" ;
  $("#picture").attr("src",photo);  
  var location = "Central Market" ;
  var description = "The Central Market (phsar thmei) is a very beautiful building and there you will find many different shops. It is very popular with tourists and locals."  ; 

  var title = "Question 6" ;
 
  $('#location-6').text(location).show() ;
 
  $('#description-6').text(description).show() ;
  
  $('#title-6').text(title).show() ;
  $('#question-6').html(question).show() ;
   
  MathJax.Hub.Queue(["Typeset", MathJax.Hub, "question-6"]);



}

 if (place == 7) 
      {  
// 3 equations

  hideAll() ;      
  $('#puzzle-7').show() ;
  $('#question-7').show() ;
  $('#answer-7').show() ;
   $('#comment-7').show() ;
 
  
 //  $('[id^=puzzle]').show() ;
  // $('[id^=answer]').show() ;
// $('[id^=place]').hide() ;
// alert('Place = ' +place) ;



 
var p = getRandomInt(10,20) ;
if (p % 2 != 0){p = p + 1 ;}



var q = getRandomInt(10,20) ;
 if (q % 2 != 0){q = q + 1 ;}



var r = getRandomInt(10,20) ;
 if (r % 2 != 0){r = r + 1 ; }



var c = (q+r-2*p) / 2 ;
var b = (r - c) / 2 ;
var a = p - b ;
var n = a + b + c ;

console.log(7,a,b,c,n);

// alert(' A + B + C = ' + n) ;

$('#label-7a').text('A + B + C = ')

 

  $('#answer-7').show() ;
  
  var solved = false ;
 // var n = getRandomInt(12,20) ;
  
//  if (n % 2 ==0 ){n = n + 1 ;}

//   var m = Math.pow(2,n)-1 ;
  $('#hiddenAnswer').val(n) ;

   $('#label-7a').show() ;
  $('#label-7a').text('A + B + C  = ') ;


 
  var question = 'Find the value of A + B + C  using these equations '+ '<br>' + 
  'A + B = ' + p + '<br>' + ' 2A + C = ' + q + '<br>' + ' C + 2B =  ' + r;
  

  var photo = "images/silverPagoda.jpg" ;
  $("#picture").attr("src",photo);  
  var location = "Silver Pagoda" ;
  var description = "The Silver Pagoda is a very beautiful temple It is next to the Royal Palace. It is very popular with tourists and locals. Inside the pagoda is a golden Buddha made from 90kg of gold. "  ; 

  var title = "Question 7" ;
 
  $('#location-7').text(location).show() ;
 
  $('#description-7').text(description).show() ;
  
  $('#title-7').text(title).show() ;
  $('#question-7').html(question).show() ;
   
  MathJax.Hub.Queue(["Typeset", MathJax.Hub, "question-7"]);



}

  if (place == 8) 
      { 
  hideAll() ;     
  $('#puzzle-8').show() ;
  $('#question-8').show() ;
  $('#answer-8').show() ;
  $('#feedback-8').show() ;
   $('#comment-8').show() ;
 
var m = getRandomInt(11,20) ;
var n = getRandomInt(3,10) ;
m = parseInt(m) ;
n = parseInt(n) ;
    makeCubes()  ;
   $('[id^=words]').show() ;
   $('#cubeNumbers').show() ;
   $('#cubes').show() ;
 //  $('[id^=puzzle]').show() ;
  // $('[id^=answer]').show() ;
// $('[id^=place]').hide() ;
// alert('Place = ' +place) ;

$('#hiddenAnswerX').val(m) ;
$('#hiddenAnswerY').val(n) ;
x = m*m*m + n*n*n ;
y = m*m*m - n*n*n ;

console.log(8,m,n);
// alert(m + ' ' + n1 + ' * ' + n2) ;
  
  $('#label-8a').text(' m = ').show() ;
  $('#label-8b').text(' n = ').show() ;

  $('#answer-8').show() ;
  
  var solved = false ;
  var question = 'Find m and n using the equations  ' + '<br>'
  + '$m^3 + n^3 = $' + x + '<br>'
  + '$m^3 - n^3 = $' + y ;

  var photo = "images/royalPalace.jpg" ;
  $("#picture").attr("src",photo);  
  var location = "The Royal Palace" ;
  var description = 'It is the most famous place in Phnom Penh and it is where the King of Cambodia lives. The Royal Palace is open to visitors on most days of the year.'  ;  
  var title = "Question 8" ;
 
  $('#location-8').text(location).show() ;
  $('#description-8').text(description).show() ;
  $('#title-8').text(title).show() ;
  $('#question-8').html(question).show() ;

  MathJax.Hub.Queue(["Typeset", MathJax.Hub, "question-8"]);
}


  if (place == 9) 
      { 
  hideAll() ;     
  $('#puzzle-9').show() ;
  $('#question-9').show() ;
  $('#answer-9').show() ;
  $('#feedback-9').show() ;
   $('#comment-9').show() ;

var divisible = true ;
var match = true ;

while (match == true | divisible == true)  
 {
var aPrime = false
while (aPrime == false)
{
var a = getRandomInt(2,11) ;
aPrime = isPrime(a) ;
}

var aPrime = false
while (aPrime == false)
{
var b = getRandomInt(a,19) ;
aPrime = isPrime(b) ;
}


var aPrime = false
while (aPrime == false)
{
var c = getRandomInt(b,31) ;
aPrime = isPrime(c) ;
}

var numerator = b*c + a*c + a*b ;
var denominator = a*b*c ;

if (denominator % numerator != 0){divisible = false ;}
if (a != b & a != c & b != c) {match = false ;}

}

a=  parseInt(a) ;
b = parseInt(b) ;
c = parseInt(c) ;

var numerator = b*c + a*c + a*b ;
var denominator = a*b*c ;

numerator = parseInt(numerator) ;
denominator = parseInt(denominator) ;

makePrimes(100)  ;

   $('[id^=words]').show() ;
   $('#primeNumbers').show() ;
   $('#primes').show() ;
 //  $('[id^=puzzle]').show() ;
  // $('[id^=answer]').show() ;
// $('[id^=place]').hide() ;
// alert('Place = ' +place) ;

$('#hiddenAnswerA').val(a) ;
$('#hiddenAnswerB').val(b) ;
$('#hiddenAnswerC').val(c) ;

console.log(9,a,b,c);

// alert(m + ' ' + n1 + ' * ' + n2) ;
  
  $('#label-9a').text(' a = ').show() ;
  $('#label-9b').text(' b = ').show() ;
  $('#label-9c').text(' c = ').show() ;

  $('#answer-9').show() ;
  
  var solved = false ;
  var question = 'Find a, b and c.    ' + '<br>'
  + '$ \\frac{1}{a} + \\frac{1}{b} + \\frac{1}{c}  = $' + 
 '$ \\frac{' + numerator + '}{' + denominator + '}$' + 
  '<br> a,b and c are all prime numbers.';

  var photo = "images/nationalMuseum.jpg" ;
  $("#picture").attr("src",photo);  
  var location = "The National Museum" ;
  var description = 'If you want to learn about the history of Cambodia, this is the place to go!'  ;  
  var title = "Question 9" ;
 
  $('#location-9').text(location).show() ;
  $('#description-9').text(description).show() ;
  $('#title-9').text(title).show() ;
  $('#question-9').html(question).show() ;

  MathJax.Hub.Queue(["Typeset", MathJax.Hub, "question-9"]);


}



// place 10 - the finish

 if (place == 10) 
      { 
  hideAll() ;     
  $('#puzzle-ten').show() ;
  $('#question-ten').show() ;
  $('#answer-ten').show() ;
  $('#feedback-ten').show() ;
   $('#comment-10').show() ;


   $('[id^=words]').show() ;


// $('[id^=place]').hide() ;
// alert('Place now = ' +place) ;


var answerP =  $('#input-tena').val() ;
var answerQ =  $('#input-tenb').val() ;
var answerR =  $('#input-tenc').val() ;



var secretWord = $('#codeWord').val() ;

var h1 = secretWord.substr(0,1) ;
var h2 = secretWord.substr(1,1) ;
var h3 = secretWord.substr(2,1) ;

$('#hiddenAnswerP').val(h1) ;
$('#hiddenAnswerQ').val(h2) ;
$('#hiddenAnswerR').val(h3) ;

console.log(10,secretWord,h1,h2,h3) ;

// alert('Hiddens ' + h1 + ' ' + h2 + ' ' + h3) ;

var numbers = [] ;
numbers = encodeWord(secretWord) ;  // get coded lettes for the chosen word

// alert('My numbers = ' + numbers + 'My word ' + secretWord) ;

numberP = numbers[0] ;
numberQ = numbers[1] ;
numberR = numbers[2] ; 

// alert('Codes are ' + numbers) ;

  $('#label-tena').text(numberP).show() ;
  $('#label-tenb').text(numberQ).show() ;
  $('#label-tenc').text(numberR).show() ;




  $('#answer-10').show() ;
  
  var solved = false ;
  var question =  "To finish the game you need to break the code."
  + 'Here is what you need to do.'
  + '<br>' 
  + 'To break the code you need to raise each number to the power of 3, '
  + "Then you divide your answer by 33 and find out what the remainder is."
  + "<br>"
  + 'for example if the number is 5 then you have to calculate '
  + '5 x 5 x 5 = 125 +  then calculate the remainder when you divide by 33' 
  + "125 $ \\div $ 33  = 99 + <b>26</b> remainder."
  + "<br>" 
  + "After that change the remainder into  number using "
   + " using 1 = A, 2 = B, 3 = C etc. "
  + "So 26 = Z and the number 5 is the code for Z" ;




 

  var photo = "images/watPhnom.jpg" ;
  $("#picture").attr("src",photo);  
  var location = "Wat Phnom ";
  var description = 'Wat Phnom is the oldest pagoda in Phnom Penh it on top of the only hill in the city.'
  + '<br>'
 +  'Many people visit Wat Phnom. At Khmer New Year people go there to pray at the pagoda and to celebrate the New Year with singing and dancing.';
  $('#location-ten').text(location).show() ;
  $('#description-ten').text(description).show() ;
  $('#title-ten').text(title).show() ;
  $('#question-ten').html(question).show() ;

  MathJax.Hub.Queue(["Typeset", MathJax.Hub, "question-ten"]);
}


})
      
})

</script>




<script type="text/javascript">

     $('#restart').on('click', function(){

var n = $('#escapeKey').text() ;
// alert('Student ID ' + studentID) ;

// $('#place1').show() ;
   var escapeCode = 0 ;
   for (var x = 1 ; x <= 10 ; x++)
    {if (solved[x] == 1) {escapeCode = escapeCode + Math.pow(2,x) ; }}

  $('#escapeKey').text('0') ;

//  alert('Escape code on restart = ' + escapeCode + '  ' + solved) ;

$('#restart').hide() ;
$('[id^=place]').show() ;

    });



</script>



<script type="text/javascript">

     $('#escapeKey').on('click', function(){

var n = $('#escapeKey').text() ;
alert('Trying to escape' + solved) ;
var tempSolved = solved ;
location.reload(false);  // from cache
var q = $('#escapeKey').text() ;

var url = "race/racev2023.php?q="+q ;
alert('url  = ' + url) ;
window.location.href = url ;



   })



</script>
<script>
function calculate(){
    "use strict";
    var s= prompt('Enter problem');
    if(/[^0-9()*+\/ .-]+/.test(s)) throw Error('bad input...');
    try{
        var ans= eval(s);
    }
    catch(er){
        alert(er.message);
    }
    alert(ans);
}
</script>



<script>
   $(document).ready(function () {
    $('#calc').on('click', function(){
// calculate();
var expr = $('#expression').val() ;

 $.ajax({
    dataType: 'text',
    type: 'post',
    async: false,
    url: 'evaluate.php',
    data: {expr:expr},
    
    success: function(response){

    console.log(response);
    $('#ans').val(response) ;
    $('#expression').val('') ;
    alert(response) ;

        }, // success

      error: function(xhr, textStatus, errorThrown){
                        alert('request student data failed');
                          $('#errorMessage').text(response) ;
                      } // failure
                }); //ajax



    })

    })

  </script>

 