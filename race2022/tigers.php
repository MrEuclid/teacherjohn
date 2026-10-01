
<?php 
$question = $_POST['question'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
 
  <meta name="viewport" content="width=device-width, initial-scale=1">
 

    <title>Escape 7</title>



  <style>
 



.c {text-align: center;
margin-right: auto;
margin-left: auto;
margin: 0 ;} 


body {background-color:white;}




  }






input {text-align: center ; 
height: 25px ; width: 25px ;
  font-size: 12pt ; 
  color:white ; background-color: red ;}



p {color: blue ; font-size: 14pt ;}

input {height: 35px ; width: 35px ; background-color: yellow ; color:black; 
  font-size: 11pt ; font-family: sans-serif;
  text-align: center; size: 8}

button.small {height: 40px ; width: 80px ; background-color:orange ; color:white; 
  font-size: 12pt ; font-family: sans-serif;
  text-align: center; }

button.code {height: 40px ; width: 100px ; background-color:black ; color:white; 
  font-size: 12pt ; font-family: sans-serif;
  text-align: center; }

label {height: 40px ; width: 40px ; 
  font-size: 14pt ; font-family: sans-serif;
  text-align: center; }

#answerTop, #answerBottom , #answerLeft, #answerRight {text-align: center ; 
height: 25px ;
 width: 75px ;
font-size: 12pt ; 
  color:white ; background-color: red ;}

  
.gaol  {width:60px ; height:60px ;  padding:1px;
   border:1px solid #021a40;
   background-color:black;}

img {width:60px ; height:60px ;  
   }

#light1,#light2,#light3,#light4 {border:2pt solid black;}

#clear {background-color: grey ; color:white; height:40px ; width: 80px}

#wrapper {position: relative; 
}  
 


  </style>


   
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
 

</head>
<body>
  
   <div class = "container-fluid">


<div class = "row">
  <div class = "col- c">
    <h1 id = "title" >Free the Tiger</h1>
  </div>
</div>

<div class = "row">
  <div class = "col-sm-12 c">
  

   </div></div>


 
 <div class = "row">
  <div class = "col-sm-12 c">
       <input readonly="true" id = "operand1Top">   
      <label>&times</label> 
 <input readonly="true" id = "operand2Top">  
 <label>+</label> 
 <input readonly="true" id = "operand3Top">
 
 <label>=</label> 
  <input class = "answer" readonly="true" id = "answerTop">  
  
  </div></div>  

<div class = "row">
   <div class = "col-sm-4 c">
     
   <input readonly="true" id = "operand1Left">   
      <label>-</label> 
 <input readonly="true" id = "operand2Left">  
 <label>&times</label> 
 <input readonly="true" id = "operand3Left">
 
 <label>=</label> 
  <input  class = "answer" readonly="true" id = "answerLeft"> 
</div>

  <div class = "col-sm-4 c">

  <img id = "cat" class = "gaol" src = "images/tiger.jpg" > 
 <br><br>
    </div>

    <div class = "col-sm-4 c"> 
       <input readonly="true" id = "operand1Right">   
      <label>+</label> 
 <input readonly="true" id = "operand2Right">  
 <label>&times</label> 
 <input readonly="true" id = "operand3Right">
 
 <label>=</label> 
  <input  class = "answer" readonly="true" id = "answerRight"> 
  </div>

      <div class = "row">
  <div class = "col-sm-12 c">

      <input readonly="true" id = "operand1Bottom">   
      <label>&times</label> 
 <input readonly="true" id = "operand2Bottom">  
 <label>-</label> 
 <input readonly="true" id = "operand3Bottom">
 
 <label>=</label> 
  <input  class = "answer" readonly="true" id = "answerBottom"> 
</div></div>

     <div class = "row">
  <div class = "col-sm-12 c">
<span>
  <button id = "clear">Clear</button>
<button id = "key1" class = "small">2</button> 
<button id = "key2" class = "small">3</button> 
<button id = "key3" class = "small">4</button> 

<button id = "key4" class = "small">5</button> 
<button id = "key5" class = "small">6</button> 
<button id = "key6"  class = "small">7</button> 

<button id = "key7" class = "small">8</button> 
<button id = "key8" class = "small">9</button> 

<button id = "key9" class = "small">10</button> 
<button id = "key10" class = "small">11</button> 

<button id = "key11" class = "small">12</button> 
<button id = "key12" class = "small">13</button> 



</span>
  </div></div>

     <div class = "row">
  <div class = "col-sm-12 c">

<br>
<button id = "light1" class = "code">----</button>
<button id = "light2" class = "code">----</button>
<button id = "light3" class = "code">----</button>
<button id = "light4" class = "code">----</button>

 </div></div>

    <div class = "row">
  <div class = "col-sm-12 c">

<div id = "score"></p>

 </div></div>

<div id = "wrapper">
    <div id="b" style="position:absolute;"><img id = "cat2" src = "images/tiger.jpg" ></div>
</div>

</div>
</body>
</html>

<script type="text/javascript">
  function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

</script>

<script type="text/javascript">
function shuffle(arra1) {
    var ctr = arra1.length, temp, index;

// While there are elements in the array
    while (ctr > 1) {
// Pick a random index
        index = Math.floor(Math.random() * ctr);
// Decrease ctr by 1
        ctr--;
// And swap the last element with it
        temp = arra1[ctr];
        arra1[ctr] = arra1[index];
        arra1[index] = temp;
    }
    return arra1;
}

</script>
<script type="text/javascript">
  function getData(counter,level)
// populate keys and answers
  {
    
  var multiplier = counter*5;
  var limit = multiplier*level ;

 // limit = 3 ;

  var a = getRandomInt(2,limit) ;
  var b = getRandomInt(2,limit) ;
  var c = getRandomInt(2,limit) ;

  var d = getRandomInt(2,limit) ; 
  var e = getRandomInt(2,limit) ;
  var f = getRandomInt(2,limit) ;
 
  var g = getRandomInt(2,limit) ;
  var h = getRandomInt(2,limit) ;
  var i = getRandomInt(2,limit) ;

  var j = getRandomInt(2,limit) ;
  var k = getRandomInt(2,limit) ;
  var l = getRandomInt(2,limit) ;




  var data = new Array(12) ;


 data[0] = a ;
 data[1] = b ;
 data[2] = c ; 

 data[3] = d ;
 data[4] = e ;
 data[5] = f ;

 data[6] = g ;
 data[7] = h ;
 data[8] = i ;

 data[9] = j ;
 data[10] = k ;
 data[11] = l ;

//  alert('data 1 - ' + data);

  return data ;  
  }
</script>


<script type="text/javascript">
function moveIt() {
    $("#b").animate({left: "+=700"}, 2000);
    $("#b").animate({left: "-=700"}, 1000);
}

</script>



<script type="text/javascript">

  $(document).ready(function () {


question = '<?php echo $question; ?>' ;
points = question.substr(-1);

$(":input").hide() ;

$('#b').hide() ;

$("[id^=l]").show() ;
counter = 1 ;
$('[id^=key]').hide() ;
$('#clear').hide() ;
$('[id^=operand]').val('') ;

shapes = [] ;
shapes[1] = "&#10004;"  ; // tick
shapes[2] = "&#9733;"  ; // star
shapes[3] = "&#10084;"  ; // heart 
shapes[4] = "&#9889;"  ; // lightning


colors = [] ;
colors[1] = "black" ;
colors[2] = "green" ;
colors[3] = "blue" ;
colors[4] = "red" ;
colors[5] = "orange" ;
colors[6] = "pink" ;
colors[8] = "teal" ;
colors[0] = "cyan" ;

$('[id^=light]').prop("disabled", true);


for (i = 1 ; i <= 360*6 ; i++)
{rotateImage(i) ;
  rotateImage(-i)}

for (i = 1 ; i <= 360*6 ; i++)
{rotateImage(i) ;
  rotateImage(-i)}
})

</script>
<script type="text/javascript">
  function rotateImage(degree) {

  $('#cat').css({"background-color":colors[counter % 8]}) ;  
  $('#cat').animate({  transform: degree }, {
    step: function(now,fx) {
        $('#cat').css({
            '-webkit-transform':'rotate('+now+'deg)', 
            '-moz-transform':'rotate('+now+'deg)',
            'transform':'rotate('+now+'deg)'
        });
    }
    });
}
</script>

<script type="text/javascript">

  $(document).ready(function () {



//$('#l1,#l2').on("click", function(event) {
   
 //$('[id^=light').css({"background-color":"black" , "color":"white"}) ;
 // $('[id^=light').html('----') ;
  //  var level =  $(this).attr("id"); 
 //  alert('Level = ' + level) ;
    level = 1 ;  // adjust for grade
    level = parseInt(level) ;
 //  alert('Level = ' + level) ;

$(":input").show() ;

$('[id^=operand]').val('') ;
     var data1 = new Array(8) ;



$('[id^=key]').prop("disabled", true);

topUnlocked = false ;
bottomUnlocked = false ;
leftUnlocked = false ;
rightUnlocked = false ;
$('#clear').hide() ;
$('#cat').show() ;
counter = counter + 1 ;
data1 = getData(counter,level) ;

// alert(data) ;


$('[id^=key]').show() ;



     $('[id^=answer]').css({"color":"yellow", "background-color":"red", "text-align":"center"}) ;
       $('[id^=operand]').css({"color":"red", "background-color":"yellow", "text-align":"center"}) ;

    a = 0 ;
    b = 0 ;
    c = 0 ; 
$('#answerTop').hide() ;
$('#answerottom').hide() ;
$('#answerLeft').hide() ;
$('#answerRight').hide() ;


// sum = c  f ;
var answerTop = data1[0] * data1[1] + data1[2];
// diff = g - e ;
var answerBottom = data1[3] * data1[4] - data1[5] ;
// if (answerSub < 0 ) {answerSub = -answerSub ;}
// mult = a*b ;
var answerLeft = data1[6] - (data1[7] * data1[8]) ;
// div = uses d , h 
var answerRight = data1[9] + (data1[10] * data1[11]) ;
// alert('Answer right ' + answerRight) ;

data2 = shuffle(data1) ;

// alert('data 2 - ' + data2)
for (var i = 1 ; i <= 12 ; i++)
  {$('#key'+i).text(data2[i-1]) ;}



    $('#answerTop').val(answerTop) ;
    $('#answerBottom').val(answerBottom) ;
    $('#answerLeft').val(answerLeft) ;
    $('#answerRight').val(answerRight) ;
     $('[id^=answer]').css({"color":"yellow", "background-color":"red", "text-align":"center"}) ;

 //   a = 0 ;
 //   b = 0 ;
 //  c = 0 ;

$('#answerTop').show() ;
$('#answerBottom').show() ;
$('#answerLeft').show() ;
$('#answerRight').show() ;



  })


</script>




  
<script type="text/javascript">

  $(document).ready(function () {
 $('[id^=operand]').on("click", function(event) {

// alert($(this).attr("id"));
$('[id^=key]').prop("disabled", false);
 inputID = $(this).attr("id");
//  alert('Ínput ID ' + inputID) ;
$(this).css({"color":"white","background-color":"lightblue"}) ;

 })
})


</script>

  
<script type="text/javascript">

  $(document).ready(function () {

 $('[id^=key]').on("click", function(event) {

  var buttonValue = $(this).text() ;
// alert("Button value = " + buttonValue + 'input ID = ' + inputID) ;
  $('#clear').show() ;
$('[id^=key]').prop("disabled", true);
  $('#'+inputID).val(buttonValue) ;

  $('#'+inputID).css({"color":"black","background-color":"white","text-align":"center"}) ;

  $(this).hide() ;

  var id = inputID;
var lastChars = id.substr(8); // => "Tabs1"
// alert('Lastchars ' + lastChars) ;
var first = '#operand1' + lastChars ;
var second = '#operand2' + lastChars ;
var third = '#operand3' + lastChars ;


b = $(first).val() ;
c = $(second).val() ;
d = $(third).val() ;


b = parseInt(b) ;
c = parseInt(c) ;
d = parseInt(d) ;
/*
a = B+c+d ; 

  if (isNaN(a))
  {$('#answer'+lastChars).val("") ; }
  {$('#answer'+lastChars).val(a) ;} 

 */ 

  if (lastChars == 'Top')
{
  var answerID = '#answerTop'; 
  var guess = b * c + d ;
  var solution = $('#answerTop').val() ;
 // alert('Guess ' + guess + ' solution' + solution) ;   

 } 

   if (lastChars == 'Bottom')
{
  var answerID = '#answerBottom';
 var guess = b * c - d ;
  var solution = $('#answerBottom').val() ;
 // alert('Guess ' + guess + ' solution' + solution) ;   

 
  
 } 

    if (lastChars == 'Left')
{
  var answerID = '#answerLeft' ;
 
 var guess = b - c * d ;
  var solution = $('#answerLeft').val() ;
  
 } 

     if (lastChars == 'Right')
{
  var answerID = '#answerRight' ;	
   var guess = b + c * d ;
  var solution = $('#answerRight').val() ;
//  alert('Guess = ' + guess + ' solution ' + solution) ;
 } 


 
//  var solution = $(answerID).val() ;
  if (parseInt(guess) == parseInt(solution))
    {$(first,second,third,answerID).css({"color":"white", "background-color":"green","text-align":"center"}) ;
     
     $(answerID).css({"color":"white", "background-color":"green","text-align":"center"})

     if (lastChars == 'Top')  {topUnlocked = true ;
      $('#light2').html(shapes[4] + solution + shapes[4]).css({"background-color":"blue", "color":"yellow"}) ;}
     if (lastChars == 'Bottom')  {bottomUnlocked = true ;
      $('#light1').html(shapes[4]+solution+shapes[4]).css({"background-color":"blue", "color":"yellow"}) ;
     }
     if (lastChars == 'Left') {leftUnlocked = true ;
     $('#light4').html(shapes[4]+solution+shapes[4]).css({"background-color":"blue", "color":"yellow"}) ;}
     if (lastChars == 'Right')  {rightUnlocked = true ;
      $('#light3').html(shapes[4]+solution+shapes[4]).css({"background-color":"blue", "color":"yellow"}) ;
     }

finished =  (topUnlocked & bottomUnlocked & leftUnlocked & rightUnlocked) ;
// alert(finished) ;
     if (finished == 1)
{

$('#cat').hide() ;
alert('The tiger is free!') ;
$('#b').show() ;
$('<img src="images/tiger.jpg">').appendTo("#score"); 
$('#clear').hide() ;
$('[id^=light]').css({"background-color":"black" , "color":"white"}).text('----') ;
for (i = 1 ; i <= 360*6 ; i++)
{rotateImage(i) ;
  rotateImage(-i)}


$('#b').hide() ;

/*
var pts = parseInt($('#total').text());
     
console.log("points",pts);
pts = parseInt(pts + points);
console.log("points now ",pts);
$('#total').text(pts);
*/
    $('#menu').show();
  processWin(questionID);
    console.log("processing ",questionID);
     $('#play').empty().show();
     $('#q18').prop('disabled',true).css({"background-color":"blue","color":"yellow"});


}



   }
  else
  {
    $(first,second).css({"color":"white", "background-color":"red","text-align":"center"}) ;
  }

})

})


</script>

  


  
<script type="text/javascript">

  $(document).ready(function () {

 $('#clear').on("click", function(event) {

  alert('Resetting') ;

// $('[id^=operand').val('') ;

topUnlocked = false ;
bottomUnlocked = false ;
leftUnlocked = false ;
rightUnlocked = false ;
$('#clear').hide() ;

//$('#operandAdd1').val('999') ;
 $('[id^=operand]').val('').css({'background-color':'yellow'}) ;
$('[id^=answer]').css({"color":"yellow", "background-color":"red", "text-align":"center"}) ;
$('[id^=key]').prop("disabled", true);
$('[id^=key]').show() ;
$('[id^=light]').css({"background-color":"black" , "color":"white"}).text('----') ;
 })
})


</script>


