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

<title>CountdownNumber</title>

<style>



button.bigWriting {padding: 2px ; width: 160px ; margin-bottom: 5px ;
  margin-top: 2px;vertical-align: top; margin-left: 5px ; margin-right: 5px ;
 // background-color: orange; 
  font-size: 18pt ; font-weight: bolder;color: white ;}

button.small {padding: 2px ; width: 80px ; height: 80px ;margin-bottom: 5px ;margin-top: 2px; 
  font-size: 24pt ; color:black ; background-color: lightblue ;vertical-align: top;}

button.large {padding: 2px ; width: 120px ; height:120px ; margin-bottom: 5px ;margin-top: 2px; 
  font-size: 24pt ; color:green ; background-color: lightyellow ; vertical-align: top;}

button.large1 {padding: 2px ; width: 120px ; height:120px ; 
vertical-align: top;
  margin-bottom: 5px ;margin-top: 2px; 
  font-size: 24pt ; color:blue ; background-color: lightyellow ;}

button.large2 {padding: 2px ; width: 120px ; height:120px ; 
  vertical-align: top;
  margin-bottom: 5px ;margin-top: 2px; 
  font-size: 24pt ; color:black ; background-color: lightgrey ;}

#operation+, #operation*,#operation-, #operation/
 {padding: 2px ; width: 120px ; 
vertical-align: top;
  margin-bottom: 5px ;margin-top: 2px; font-size: 18pt ; font-weight: bolder ;  lightblue ;}

#guess ,#teamName {
    background-color:lightgreen ; 
    color:black ;
    font-size:24pt ;
    width: 120ps ;
    height:60px ;
    text-align:center ;
  }

.round {
    background-color: #1164e0;
    border: none;
    color: white;
    padding: 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 24pt;
    margin: 4px 2px;
    font-weight:bolder ;

border-radius: 20;}

.alphabet {
    background-color: green;
    border: none;
    color: yellow;
    padding: 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 32px;
    margin: 2px 2px;
    font-weight:bolder ;

border-radius: 20;}



.square {
   
    display: inline-block;
    margin: 0;
    padding: 2px 2px;

    
    text-rendering: auto;
    text-align: center;
    text-transform: none;
    text-decoration: none;
    text-indent: 0;
    text-shadow: none;
    letter-spacing: normal;
    word-spacing: normal;
    font-weight: bolder ;
    font-family: sans-serif;
    height: 50px ;
    width: 50px ;
    border: 1px outset buttonface; }


    
.rectangle {
    
    display: inline-block;
    margin: 0;
    padding: 2px 2px;
    font-size: 2em;
    color: black;
    background-color: lightgreen;
    
    text-rendering: auto;
    text-align: center;
    text-transform: none;
    text-decoration: none;
    text-indent: 0;
    text-shadow: none;
    letter-spacing: normal;
    word-spacing: normal;
    font-weight: bolder ;
    font-family: sans-serif;
    height: 50px ;
    width: 100px ;
    border: 1px outset buttonface; }


   .circle { 
            width: 60px; 
            height: 60px; 
            margin:5px ;
            padding: 10px 16px; 
            border-radius: 20px; 
            background-color:green ;
            color:yellow ;
            font-size:24pt ;
            font-weight:bolder ;
            text-align: center; }



.menu {
    font-size: 24pt;
}

h1 {
font-weight: bolder; 
   font-size: 24pt; 
   
   color:green;
}

h2 {
font-weight: bolder; 
   font-size: 20pt; 
   
   color:blue;

}

h3 {
font-weight: bolder; 
   font-size: 16pt; 
   
   color:green;
}

h4 {
font-weight: bold; 
   font-size: 14pt; 
   
   color:orange;
}

[id^=level] {
background-color: lavender;
color:black ;
font-weight: bolder;
font-size: 12pt ;
text-align: center;
width : 120px ;
height: 90px ;

}

p {
font-weight: bold;
font-style: italic;
font-size: medium;
}

#clear {background-color: blue; color: yellow; font-size: 1.2em; text-align: center; width: 120px; height: 40px;}

#calculate{

background-color:cornflowerblue; 
}





button.bigWriting {padding: 2px ; width: 160px ; margin-bottom: 5px ;
margin-top: 2px;vertical-align: top; margin-left: 5px ; margin-right: 5px ;
// background-color: orange; 
font-size: 18pt ; font-weight: bolder;color: white ;}

button.small {padding: 2px ; width: 80px ; height: 80px ;margin-bottom: 5px ;margin-top: 2px; 
font-size: 24pt ; color:black ; background-color: lightblue ;vertical-align: top;}

button.large {padding: 2px ; width: 120px ; height:120px ; margin-bottom: 5px ;margin-top: 2px; 
font-size: 24pt ; color:green ; background-color: lightyellow ; vertical-align: top;}

button.large1 {padding: 2px ; width: 120px ; height:120px ; 
vertical-align: top;
margin-bottom: 5px ;margin-top: 2px; 
font-size: 24pt ; color:blue ; background-color: lightyellow ;}

button.large2 {padding: 2px ; width: 120px ; height:120px ; 
vertical-align: top;
margin-bottom: 5px ;margin-top: 2px; 
font-size: 24pt ; color:black ; background-color: lightgrey ;}

#operation+, #operation*,#operation-, #operation/
{padding: 2px ; width: 120px ; 
vertical-align: top;
margin-bottom: 5px ;margin-top: 2px; font-size: 18pt ; font-weight: bolder ;  lightblue ;}

#target {background-color: orange; color:lime ;}

#newGame, #quit {font-size: 18pt; font-weight: bolder;}




.medium {
    display: inline-block;
  
    margin: 0;
    padding: 10px 10px;

    
    text-rendering: auto;
    text-align: center;
    text-transform: none;
    text-decoration: none;
    text-indent: 0;
    text-shadow: none;
    letter-spacing: normal;
    word-spacing: normal;
    font-weight: bolder ;
    font-size: 14pt ;
    color:white ;
    font-family: sans-serif;
    height: 60px ;
    width: 100px ;
    border: 1px outset buttonface; }



#message {font-size: 10pt ; font-style: italic;color: black ; text-align: justify;}



h2 {color: green }
h1 {color: blue;}
h3 {color:orange;}


img {position: relative;}


</style>


</head>
<body>

    <div class  = "container-fluid">

        <div class = "row">
            <div class = "col-sm-12 c">
                <p id = "stars"></p>
                </div></div>

    <div class = "row">
      <div class = "col-sm-12 c">

    <h1> Make the Number </h1>
  
</div></div>


 <div class = "row">
      <div class = "col-sm-12 c">
<button class = 'round' id = "target">0</button>


</div></div>

<div id = "gameArea">

  <p id = "solution"></p>

    <div class = "row">
        <div class = "col-sm-12 c">
           <button id = "operand1" class="large1"></button>
           <button id = "op" class="large1"></button>
           <button id = "operand2" class="large1"></button>
           <button id = "go" class="large2">Go</button>
                
       </div></div>
        
     <div class = "row">
       <div class = "col-sm-12 c">
           <button id = "operation+" class = "small">+</button>
           <button id = "operation*" class = "small">$ \times $</button>
           <button id = "operation-" class = "small">-</button>
           <button id = "operationd" class = "small">$ \div $</button>  
       </div></div>
     
     <div class = "row">
       <div class = "col-sm-12 c">
           <button id = "number0" class = "large"></button>
           <button id = "number1" class = "large"></button>
           <button id = "number2" class = "large"></button>
           <button id = "number3" class = "large"></button>
       </div>
     </div>

<div class = "row">
    <div class = "col-sm-12 c">
<p id = "keypad">
    <button id = "clear" >Clear</button>
    <input id = "symbol" type = "text" readonly="true" hidden="true">
    <p id = "warning"></p>
</p>

</div> <!-- game area-->

</div></div>



</div>

</body>
</html>


<script type="text/javascript">

    $(document).ready(function(){
    
     // load words into an array
     // sorted in upper case
    
question = '<?php echo $question; ?>' ;
points = parseInt(question.substr(-1));
    data2 = [] ;
    wins = 0 ;
    
    
    })
    </script>


<script>
    function setUp(n)

    {
 // alert(n) ;
  
   $('#clear').show() ;
 

   console.log("arrived",n,data2) ;
   //data2[n][0],data2[n][1]) ;
answer = 0 ; // answer reached by player
equation = '' ; // string with calcs to evaluate
operation = '' ; // symbol of operator + - * /

$('#go').prop('disabled',true) ;
$('[id^=operand]').text('') ;
$('#symbol').val('') ;
$('#op').text('') ;


// p = "*2*7*13*14" ;
// target = 12 ;
 var p = data2[n][1] ; // puzzle
 console.log("p",p) ;
numbers = [] ;
// remove empty items
p = p.substring(0, p.length - 1);
p = p.substr(1) ;
numbers = p.split("*") ;
target = data2[n][0] ;
console.log("to be displayed",p,numbers,target) ; 
numbers.sort(function(a,b){return a - b})

original = [] ; // store a copy of the numbers array 
for (var i = 0 ; i < numbers.length; i++)
{
    original[i] = numbers[i] ;
 //   $('#solution').append(numbers[i] + ' - ') ;

}
original.sort(function(a,b){return a - b}) ;
// $('#solution').append('<br>') ;

numbers.sort(function(a,b){return a - b})
for (var i = 0 ; i < numbers.length; i++)
{
    var offset = parseInt(i) ;
    $('#number' + offset).text(numbers[i]).show() 

}

$('#target').html(target);

    }

</script>


<script type="text/javascript">

    $(document).ready(function(){
    
 
  if (wins == 0)    
  {
     $( document ).ajaxComplete(function() {
  add();
  setUp(wins) ;
  console.log('complete load on ready ',data2) ;
});
} 
    var level = 5 ;
  
    
     $.ajax({
        url: 'loadEquations.php', // to be done
        type: 'POST',
        data: {level:level}, 
        datatype: 'json',
        
    })  // parameters
    .done(function (response) { 
    
  console.log(response) ;
   chosen = JSON.parse(response) ;
   
    })  //done
    .fail(function (jqXHR, textStatus, errorThrown) { 
    alert("Failure " + jqXHR + ' ' + textStatus + ' error ' + errorThrown) ;
    
    })  // fail

    function add(){
        for (var i = 0 ; i < chosen.length; i++)
    {
       
     
        a = chosen[i]["target"] ;
        b = chosen[i]["puzzle"] ;
        x = [a,b] ;
        data2.push(x) ;
     //   console.log("Looping",i,data2,data2[i],data2[i][0],data2[i][1]) ;
      
    }
    
   
   
    console.log("Added" ,data2)
    
    }
    queen = '&#9813;' ;
    
       cntMoves = 0 ;
       score = 0 ; 
       cancelled = 0 ; // counts cancelled moves
      
       target = 0 ;
       $('#target').text(target) ;
       $('#score').text(score) ;
      
   /* 
    $('#timer').hide() ;
   $('#score').hide() ;
   $('#gameArea').hide() ;
    $('#target').hide() ;
    $('#start').hide() ;
    $('#keypad').hide() ; 
     $('#stars').empty() ;
     $('#gameLevels').hide() ;
    
    */
    
    
    
     
    
    })
        </script>
    






<script>
  function writeNumbers()
  {
    numbers.sort(function(a,b){return a - b});
    $('[id^=number]').hide() ;
      for (var i = 0 ; i < numbers.length; i++)
      {
        $('#number' + i).text(numbers[i]).show() ;
      }
  }
</script>

<script>

    function writeData() {

  
var team = $('#teamName').val() ;
var score = 10  ;
var target = parseInt($('#target').text()) ;
var puzzle = '*' ;
original.sort(function(a,b){return a - b}) ;
for (var i = 0 ; i < original.length; i++)
{
  puzzle = puzzle + original[i] + '*' ;
}

puzzle = puzzle + 'TARGET ' + target ;
    $.ajax({
    url: 'writeDataNumbers.php', // to be done
    type: 'POST',
    data: {team:team,puzzle:puzzle,score:score}, 
    datatype: 'json'
})  // parameters
.done(function (response) { 

// console.log("writing",team,word) ;

})  //done
.fail(function (jqXHR, textStatus, errorThrown) { 
alert("Failure " + jqXHR + ' ' + textStatus + ' error ' + errorThrown) ;

})  // fail


    }  // function
</script>


<script>
$(document).ready(function(){
    $('#start').on('click', function(){

       // alert("Timer on") ;
        $('#keypad').show() ;
        $('#gameArea').show() ;
       $('#start').show() ;
        $('#score').show() ;

       
    })
    })
        </script>

<script type="text/javascript">
  
  $(document).ready(function(){
    $('[id^=operand]').on('click', function(){

   var id = this.id;
   var index = parseInt(id.substr(7)) ;
   var numberValue = parseFloat($('#operand'+index).text()) ;
   
   // find index of the value in numbers and push it back into number? button and sort
  numbers.push(numberValue) ;
  writeNumbers() ;

   $('#operand' + index).text('') ;
   $('#go').prop('diabled',true) ;

  
    })
    
    })     
</script>


<script type="text/javascript">
  
    $(document).ready(function(){
      $('[id^=number]').on('click', function(){
  
     var id = this.id;
     var index = parseInt(id.substr(6)) ;
     var numberValue = numbers[index] ;
   //  alert(id + ' ' + index + ' ' + numberValue) ;  
     var content1 = $('#operand1').text() ;
     var content2 = $('#operand2').text() ; 
     if (content1 == '')
     {$('#operand1').text(numberValue) ;}
     else 
     {$('#operand2').text(numberValue) ;}
      // hide button
      $('#number'+index).show() ;

      // take out of numbers
      numbers.splice(index,1) ;
        writeNumbers() ;
      

      if ($('#operand1').text()  != '' & $('#operand1').text() != '' & $('#symbol').val() != '')
 {$('#go').prop('disabled',false) ;}
 else 
 {
  $('#go').prop('disabled',true) ;
 }

    })    
  })     
 </script>



<script type="text/javascript">
  
    $(document).ready(function(){
      $('[id^= operation]').on('click', function(){

   // get plain symbol
   var id = this.id;
     var symbol  = id.substr(9) ; 
     if (symbol == 'd') {symbol = '/' ;}
     
     $('#symbol').val(symbol) ;
 // alert(id + '-> ' + symbol)
 
 // alert('OP clicked ') ;
  var op1 = $('#operand1').text() ;
  var op2 = $('#operand2').text() ;
 
 $('#clear').show() ;
  var operationID = this.id;
 var operation = $('#'+operationID).text() ;
 // alert(operationID + ' clicked' ) ;
  myOp = operationID[operationID.length -1];
 
 
  if (myOp == 'd') {myOp =  '$ \\div $'  ;}
  if (myOp == '*') {myOp =  '$ \\times $'  ;}
 
 
 $('#op').text(myOp) ;
 
 MathJax.Hub.Queue(["Typeset", MathJax.Hub, "op"]);


  // alert('op1 = ' + op1 + ' op2 ' + op2 + 'Clicked = ' + operationID) ;
 

 
  if ($('#operand1').text()  != '' & $('#operand1').text() != '' & $('#symbol').val() != '')
 {$('#go').prop('disabled',false) ;}
 else
 {
  $('#go').prop('disabled',true) ;
 }
 

 
 
 })
      
      })     
 </script>
 
 <script type="text/javascript">
   
    $(document).ready(function(){
      $('#clear').on('click', function(){

     

   $('#clear').show() ;

  answer = 0 ;

  for (var i = 0 ; i <= 3 ; i++)
  {
    
    numbers[i] = original[i] ;
    $('#number' +i ).text(original[i]).show() ;

  }
  original.sort(function(a,b){return a - b}) ;
 $('#operand1').text('') ;
 $('#operand2').text('') ;
 $('#op').text('') ;
 $('#symbol').val('') ;
 answer = 0 ;
 equation = '' ;

 $('#go').prop('disabled',true) ;


      })
      
      })     
 </script>


 
 
 <script type="text/javascript">
   
   $(document).ready(function(){
     $('#go').on('click', function(){

      var x = parseFloat($('#operand1').text()) ;
      var y = parseFloat($('#operand2').text()) ;
      var op = $('#symbol').val() ;



      console.log("numbers at start",numbers) ;
      if (op == 'a') {op = '+' ;}
      if (op == 's') {op = '-' ;}
      if (op == '\times ') {op = '*' ;}
      if (op == '\div ' ) {op = '/' ;}

      
      var expression = x+op+y ;
      console.log("expression ",expression) ;
      answer = eval(x + op + y) ;
      answer = parseFloat(answer) ; // allow for decimals
    //   alert(x + op + y + ' = ' + answer);
     
      numbers.push(answer) ;
      console.log("numbers + answer",numbers.length,numbers,answer,x,y,target, target == answer)
      // alert(' numbers = ' + numbers + ' length ' + numbers.length) ;

      if (numbers.length > 1)
      {$('#operand1').text('') ;
      $('#operand2').text('') ;
      $('#symbol').val('') ;
      $('#op').text('') ;

      writeNumbers() ;}

     if (numbers.length == 1)
      {
        guess = answer ;
        target = parseInt($('#target').text());
        console.log("numbers + answer",numbers.length,numbers,answer,x,y,target, target == answer)
       if (target == answer)
       {

/*
     var pts = parseInt($('#total').text());
     pts = parseInt(pts);
     points = parseInt(points) ;
     console.log("points",pts);
     pts = parseInt(pts + points);
     console.log("points",pts);
     $('#total').text(pts);
     */
    alert("You have solved the puzzle!");
    $('#menu').show();
  processWin(questionID);
    

     $('#play').empty().show();
     $('#q7').prop('disabled',true).css({"background-color":"blue","color":"yellow"});
      
 
  


         }
        else
        {
          alert('Keep trying') ;
          answer = 0 ;

for (var i = 0 ; i <= 3 ; i++)
{

  numbers[i] = original[i] ;
  $('#number' +i ).text(original[i]).show() ;

}

$('#operand1').text('') ;
$('#operand2').text('') ;
$('#op').text('') ;
$('#symbol').val('') ;
answer = 0 ;
equation = '' ;

$('#go').prop('disabled',true) ;


        }
      }
     
     })   
    })  
</script>

 
