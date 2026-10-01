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


  <style>



[id^=grid] {
  width:2em ; 
  height:2em ; 
  margin:0.1em ; 
  background-color: lightblue;
   color:black;
  font-weight: bolder;
  font-size: 1em;
  display: inline;
  text-align: center;
  margin: 2px ;
  background-color: white;
  color: black;
  
  }

  [id^=bulls] 
  {
  width:2em ; 
  height:2em ; 
  margin:0.1em ; 
  background-color: green;
  color:white;
  font-weight: bolder;
  font-size: 1em;
  display: inline;
  text-align: center;
  margin: 2px ;


 
  }

 [id^=cows]
  {

 width:2em ; 
  height:2em ; 
  margin:0.1em ; 
  background-color: orange;
  color:black;
  font-weight: bolder;
  font-size: 1em;
  display: inline;
  text-align: center;
  margin: 2px ;

 
  }

  h1 {color: green; font-size: 3em; text-align: center; }


  [id^=key] {
      background-color: lightgrey; 
      color: black; 
      font-size: 1em; 
      font-weight: bolder;
      text-align: center;
      border-radius: 50%;
      height: 3em;
      width: 3em;
      margin: 2px;
    }

  #send {

    height: 3em;
    width: 5em;
    font-size: 1em;
    background-color: lightgreen;
    color: red;
    vertical-align: middle;
    margin: 10px;

  }

    #clear {

    height: 3em;
    width: 5em;
    font-size: 1em;
    background-color: lightblue;
    color: red;
    vertical-align: middle;
    margin: 10px;

  }

  .info {width: auto ; height: 50px; font-size: 1em; color: white; }

  #bullTurn {background-color: green;}
  #cowTurn {background-color: orange;}

  </style>

</head>

<body>

  <div class  = "container-fluid">

    <div class = "row">
  <div class = "col- text-center">

     <h1>Mastermind</h1>

  </div></div>

  <div class = "row">
        <div class = "col- text-center">
        <button  id = "send">Send</button>  <button  id = "clear">Clear</button> 
    </div></div>

  <div class = "row">
    <div class = "col- text-center">
<div id = "secret"></div>
</div></div>

  <div class = "row">
    <div class = "col- text-center">
<p id = "victory"></p>
</div></div>

<!-- grid is y ,x  i.e row,column -->
<div id = "playingArea">
  <div class = "row">
    <div class = "col- text-center">
<input  id = "grid11"><input  id = "grid12"><input  id = "grid13"><input  id = "grid14">
<input id = "bulls1"><input id = "cows1">

</div></div>

  <div class = "row">

<div class = "col- text-center">
  <input  id = "grid21"><input  id = "grid22"><input  id = "grid23"><input  id = "grid24">
  <input id = "bulls2"><input id = "cows2">

  </div></div>

    <div class = "row">

  <div class = "col- text-center">
    <input  id = "grid31"><input  id = "grid32"><input  id = "grid33"><input  id = "grid34">
    <input id = "bulls3"><input id = "cows3">
  
    </div></div>

      <div class = "row">

    <div class = "col- text-center">
      <input  id = "grid41"><input  id = "grid42"><input  id = "grid43"><input  id = "grid44">
      <input id = "bulls4"><input id = "cows4">
   
      </div></div>
  <div class = "row">
      <div class = "col- text-center">
        <input  id = "grid51"><input  id = "grid52"><input  id = "grid53"><input  id = "grid54">
        <input id = "bulls5"><input id = "cows5">
     
        </div></div>
  <div class = "row">
        <div class = "col- text-center">
          <input  id = "grid61"><input  id = "grid62"><input  id = "grid63"><input  id = "grid64">
          <input id = "bulls6"><input id = "cows6">
          
          </div></div>
  <div class = "row">
          <div class = "col- text-center">
            <input  id = "grid71"><input  id = "grid72"><input  id = "grid73"><input  id = "grid74">
            <input id = "bulls7"><input id = "cows7">
      
            </div></div>

        <div class = "row">
          <div class = "col- text-center">
            <input  id = "grid81"><input  id = "grid82"><input  id = "grid83"><input  id = "grid84">
            <input id = "bulls8"><input id = "cows8">
      
            </div></div>

          <div class = "row">
          <div class = "col- text-center">
            <input  id = "grid91"><input  id = "grid92"><input  id = "grid93"><input  id = "grid94">
            <input id = "bulls9"><input id = "cows9">
      
            </div></div>



</div> <!-- playing area -->

<div id = "numPad">
  <div class = "row">
   <div class = "col- text-center">
        <button   id = "key7">7</button>  <button id = "key8">8</button>  <button  id = "key9">9</button> 
    </div></div>

  <div class = "row">
       <div class = "col- text-center">
        <button class = "circle" id = "key4">4</button>  <button class = "circle" id = "key5">5</button>  <button class = "circle" id = "key6">6
        </button> 
    </div></div>

  <div class = "row">
       <div class = "col- text-center">
        <button class = "circle" id = "key1">1</button>  <button class = "circle" id = "key2">2</button>  <button class = "circle" id = "key3">3</button> 
    </div></div>

  <div class = "row">
       <div class = "col-6 text-center">
        <button class = "info" id = "bullTurn">Correct number</button>
      </div>

    
       <div class = "col-6 text-center">
        <button class = "info"  id = "cowTurn">Wrong position</button>
      </div></div>


</div>      


</div>
  </body>
  </html>


  <script type="text/javascript">
    

function checkNumbers(row)
// check that row has four distinct letters

{

 var  good = true ;
 temp = [] ;

 // put numbers into an array

 for (var i = 1; i <= 4 ; i++)
 {
  var id = 'grid' + row + i;
  var digit = $('#' + id).val();
  temp.push(digit);
 }

 var l = temp.leng;

 for (var i = 0; i < 4; i++)
 {
  for (var j = 0 ; j < 4 ; j++)
  {
    if (i != j && temp[i] == temp[j])
      good = false ;

  }
 }

console.log(temp,good);
return good ;

}

  </script>

  <script>

    function makeNumber()

    {
      var max = 9 ;
      var min = 1 ;
      var numbers = [] ;

 var digit = Math.floor(Math.random() * (max - min) + min);
 numbers.push(digit);

 for (var i = 0 ; i <= 3 ; i++)
 {
   var duplicate = true;
   digit = Math.floor(Math.random() * (max - min) + min);
   while (duplicate == true)

   {
    digit = Math.floor(Math.random() * (max - min) + min);
     var index = numbers.indexOf(digit) ;
     if (index != -1) {duplicate = true;} else {duplicate = false;}
   }
   numbers[i] = digit ;
 }


 return numbers ;
    }
  </script>

<script type="text/javascript">
  
  $(document).ready(function(){



$('#bullTurn,#cowTurn, #missTurn').prop('disabled',true);

question = '<?php echo $question; ?>' ;
points = question.substr(-1);



  $('input').attr('readonly', true);
  $('#secret').hide() ;
  $('#victory').hide() ;
  secret = [] ;
  $('[id^=turn]').show();
  secret = makeNumber();
  console.log("secret number made",secret) ;
  nString = '' ;
  turnNumber = 1 ;
  target = "" ; // clicked id
  
  for (var i = 0; i < secret.length; i++)
  {
    nString += secret[i];
  }

$('#secret').text(nString);
// $('[id^=grid]').prop('disabled',true).css({"background-color":"red","color":"green"}); // disable grid
$('[id^=grid' + turnNumber + ']').prop('disabled',false).css({"background-color":"white","color":"black"});
$('#grid11').focus().css({"background-color":"blue","color":"yellow"});
$('#send').prop('disabled',true);

  })

  </script>

<script type="text/javascript">
  
  $(document).ready(function(){
       $('[id^=key]').click(function(){

clicked = this.id ;
$('#' + clicked).prop('disabled',true);
var digit = parseInt(clicked.substring(3,4));
// alert(target);
// write to grid 
$('#' + target).val(digit).css({"background-color":"blue","color":"yellow"});

// move focus to next in row gridrc
    var row = parseInt(target.substr(4,1));
    var column = parseInt(target.substr(5,1));
    var nextColumn = parseInt(column + 1);

    target = 'grid' + row + nextColumn;
    console.log("moving right",target,row,column,nextColumn);

    if (nextColumn <=  4)
    {
      $('#grid' + row + nextColumn).focus().val('').css({"background-color":"blue","color":"yellow"});
    }
    else
      {
        var distinct = checkNumbers(row);

      if (distinct == true)
        {
          $('#send').prop('disabled',false);
          $('#send').focus().css({"background-color":"blue","color":"yellow"}) ;
      }


  }



  })
  })

</script>


<script type="text/javascript">
  
  $(document).ready(function(){
       $('[id^=grid]').click(function(){

           var id = this.id;

           // get x,y position

           var x = id.substring(4,5);

        //   alert(id + 'x = ' + x);

$('#' + id).val('').css({"background-color":"blue","color":"yellow"});
  })
  })

</script>

<script type="text/javascript">
  
  $(document).ready(function(){
       $('[id^=grid]').blur(function(){

        var id = this.id;
      
        target = this.id;
        $('#' + id).css({"background-color":"lightblue","color":"black"});
        //  alert(id + " is blurred " + target);
  })
  })

</script>

<script type="text/javascript">
  
  $(document).ready(function(){
       $('#clear').click(function(){

       var  row = turnNumber;

       for (var i = 1 ; i <= 4 ; i++)

       {
        $('#grid' + row + i).val('').css({"background-color":"lightblue","color":"black"});
        $('[id^=key]').prop('disabled',false);
        $('#grid' + turnNumber + 1).focus().css({"background-color":"blue","color":"yellow"});
        $('#send').prop('disabled',true).css({"background-color":"lightgreen","color":"red"});;
       }

       })
     })

   </script>

<script type="text/javascript">
  
  $(document).ready(function(){
       $('#send').click(function(){


     temp = [] ;
     row = turnNumber;

 // put numbers into an array

 for (var i = 0; i <= 3 ; i++)
 {
  var id = 'grid' + row + parseInt(i + 1);
  var digit = $('#' + id).val();
  temp[i] = digit;
 }

 console.log("secret",secret,"temp",temp);


 var cows = 0 ;
 var bulls = 0 ;
 var misses = 0 ;



 for (var i = 0 ; i <= 3 ; i++)

 {


  var offset = parseInt(i+1);  // rows have element 1..4
  var t = secret.indexOf(parseInt(temp[i]));
  if (secret[i] == temp[i]) 
    {
      bulls++; 
   //  $('#bulls' + i).text(bulls);
     // $('#grid' + turnNumber + offset).addClass('bull');

     if (bulls == 4)
     {
      $('#victory').text("You win!").show();
      $('#playingArea').hide();
      $('#numPad').hide() ;
      $('#send').hide();
      $('#clear').hide();
/*
     var pts = parseInt($('#total').text());
     
     console.log("points",pts);
     pts = parseInt(pts + points);
     console.log("points now ",pts);
     $('#total').text(pts);
*/
    $('#menu').show();
  
alert("You found " + nString);


questionID =   $('#q10').text();
points = 8;


    
alert(question +  " n " + points);

 console.log("processing ",questionID);
  

     $('#play').empty().show();
     $('#q10').prop('disabled',true).css({"background-color":"blue","color":"yellow"});
      processWin(questionID) ;
    

    
    
     }
    
   }
  if (t < 0) 
    {
      misses++; 
  //    $('#turn' + turnNumber + offset).css({"background-color":"black"});
  //    $('#grid' + turnNumber + offset).addClass('miss');
    }


  if (t  >= 0 & secret[i] != temp[i]) 
    {
      cows++; 

    //  $('#cows' + i).text(cows);
  //    $('#turn' + turnNumber + offset).css({"background-color":"orange"});
   //   $('#grid' + turnNumber + offset).addClass('cow');
    }
// $('#grid' + turnNumber + offset).prop('disabled',true);

console.log(i,offset,t,secret[i],temp[i]);
 $('#bulls' + row).val(bulls);
  $('#cows' + row).val(cows);
 }
// misses = parseInt(4 - (bulls + cows)) ;
// console.log(turnNumber,bulls,cows,misses);

 turnNumber++;



  $('[id^=grid]').prop('disabled',false).css({"background-color":"white","color":"black"}); // disable grid
  $('#grid' + turnNumber + 1).prop('disabled',false).focus().css({"background-color":"blue","color":"yellow"});
    var id = 'grid' + turnNumber + 1;
      //   alert(id);
        target = id;
        $('#' + id).css({"background-color":"lightblue","color":"black"});
$('#send').prop('disabled',true).css({"background-color":"lightgreen","color":"red"});

$('[id^=key]').prop('disabled',false);


       })

    })

  </script>




  