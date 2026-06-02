<!DOCTYPE html>
<html lang="en">

  <head>
 
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../javaScript/bootStrap/bootstrap-3.3.7-dist/css/bootstrap.min.css">
  <script src="../javaScript/jQuery/jquery-3.3.1.min.js"></script>
  <script src="../javaScript/bootStrap/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>


  <script src="../javaScript/plotly/math.min.js"></script>
 <script src="../javaScript/plotly/plotly-latest.min.js"></script>

<link rel="stylesheet" href="css/phoneStyles.css">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>Phone game - v2</title>
<style>
    h1 {display:inline ; font-size:18pt ; color:blue ;}
</style>


  </head>
  <body>
  <div id = 'myDiv'></div>


  <div class  = "container-fluid">
  <div class = "row">
    <div class = "col-md-12 c">

    <a href = "index.php"><button  class="btn btn-primary btn-lg">New</button></a>
    <h1>The Phone Gamev2</h1>
    <a href = "../index.php"><button  class="btn btn-danger btn-lg">Quit</button></a>
</div></div>
  <div class = "row">
    <div class = "col-md-12 c">
 

 </div></div>

 <!-- choosing or making a team buttons div = logIn-->
<div id = "logIn"> 
<div class = "row">
    <div class = "col-md-12 c">
      <br><br>
    <button  class="btn btn-success btn-lg" id = "oldTeam">Same team as before</button>
     <button  class="btn btn-info btn-lg" id = "newTeam">Make a new team</button>
     <br><br>
</div></div>
</div> <!-- login -->

 <div id = "teamRegistration"> 
Registration goes here
<div class = "row">
    <div class = "col-md-12 c">
<?php include "includes/enterTeamDetails.html" ; ?>
 <!-- login enter new team name and player school IDs-->
</div></div>
</div>



<div id = "chooseOldTeam">
<div class = "row">
<div class = "col-md-12 c">
<?php include "includes/chooseOldTeam.php" ; ?>
<!-- form for choosing old team  -->
</div></div>
</div> 




<!-- shows data for a team -- div = gameData -->
<div id = "gameData">
<div class = "row">
    <div class = "col-md-12 c">



  <div id = "updateRound"></div>
  <div id = "aliens"><aliens</div>
<input id = "ourTeam" type = "text" value="" readonly = "TRUE">
</div></div>

<div class = "row">
    <div class = "col-md-12 c">
<label>ID</label>
<input id = "ourTeamID" type = "text" value="ID" readonly = "TRUE">

<label>Round</label>
<input id = "currentRound" type = "text" readonly = "TRUE" value = "0">

<label>Aliens</label>
<input id = "aliensArriving" type = "text" readonly = "TRUE">

<label>Phones</label>
<input id = "stock" type = "text" readonly = "TRUE">

<label>Rooms</label>
<input id = "rooms" type = "text" readonly = "TRUE">

</div></div>

<div class = "row">
    <div class = "col-md-12 c">

<label id = "roomPrice" ></label>
<label id = "wholesalePrice" ></label>
<label id = "phoneLimit" ></label>
<label>SP</label>
<label id = "currentSellingPrice" ></label>
</div></div>

<div class = "row">
    <div class = "col-md-12 c">

<label id = "capital" ></label> + 
<label id = "income" ></label> - 
<label id = "expenditure" ></label> = 
<label id = "balance"></label>
<button id = "getBalanceUpdate" >Get balance</button>
</div></div>

</div> <!-- game data -->



<!-- displays the total money for a team -->
<div class = "row">
<div class = "col-md-12 c">

<div id = "totalMoney">
   <span>   <label></label><p id = "yourMoney"></p></span>
  </div>

</div></div>



<div id ="topMenu"> 
<div class = "row">
    <div class = "col-md-12 c">
<?php include "includes/topMenu.html" ; ?>
<!-- top menu lists the main options for a player -->
</div></div>
</div> 





<div id = "wholesaler">
<div class = "row">
<div class = "col-md-12 c">
</div></div>
</div>

<!-- stats-->


<div id = "stats">
<div class = "row">
<div class = "col-md-12 c">

<?php include "includes/statsMenu.html" ; ?>
<div id = "myData"></div>
<div id = "charts"></div>
<div id = "leaderBoard">
<p id = "leaderBoardData"></p>


</div></div>
</div>
<!-- form for stats -->

<div id = "orderForm">
<div class = "row">
<div class = "col-md-12 c">


<?php include "orderForm.php" ; ?>
</div></div>
</div>
<!-- form for buying phones -->



<div id = "setPrice">
<div class = "row">
<div class = "col-sm-12 c">
<?php include "includes/sellingPrices.html" ?>
</div></div>
</div>



<div id = "graphics">
<div class = "row">
<div class = "col-sm-12 c">
<?php include "includes/graphics.html" ; ?>
</div></div>
</div>



</div> <!-- container -->
</body>
</html>

<script type="text/javascript">

function barGraph(xData,yData)
{

console.log("Function",xData,yData)  ;
var data = [
  {
    x:xData ,
    y:yData ,
    type: 'bar',
  
  }

  ] ;

  var layout = {
  title: 'Team Balances'
 
};

  Plotly.newPlot('myDiv',data,layout) ;

}

</script>

<script type="text/javascript">

function topMenuDisplay()

{
var round = parseInt($('#currentRound').val());
$('#topMenu').show() ;

}

</script>

<script type="text/javascript">

function updateTeamData(teamName)
{
response = [] ;


 $.ajax({    //create an ajax request
        type: "POST",
        url: "getBalance.php",            // find out team balance 
        dataType: "json",   //expect json to be returned   
        data: {teamName:teamName},  // data to submit           
        success: function(response){                    
       console.log("response old team = ",response) ;
        currentRound = parseInt(response['currentRound']);
        aliens = parseInt(response['aliens']);
       capital = parseInt(response["capital"]);
      // alert(capital);
       income = parseInt(response["income"]);
       expenditure = parseInt(response["expenditure"]);
        ourTeamID = parseInt(response["ourTeamID"]) ;
        stock = parseInt(response["phones"]) ;
       rooms = parseInt(response["rooms"]) ;
       balance = capital + (income - expenditure) ;
       n = numberWithCommas(balance) ;
       console.log(ourTeamID,"balance now = ",balance,capital,income,expenditure) ;

  
        }

    });

    $( document ).ajaxStop(function() {  // gets ajax in sync with the  program flow 
  
      $('#yourMoney').text('$' + balance);
       $('#ourTeamID').val(ourTeamID) ;
       $('#stock').val(stock) ;
       $('#rooms').val(rooms) ;
       $('#aliensArriving').val(aliens);
       $('#currentRound').val(currentRound) ;
       $('#capital').text(capital) ;
       $('#income').text(income) ;
       $('#expenditure').text(expenditure) ;
       $('#balance').text(balance) ;
});

}

</script>

<script type="text/javascript">

function numberWithCommas(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}

</script>

<script type = "text/javascript">

function updateBalance(itemBought,quantity) 
{
var funds = $('#yourMoney').text() ;
  funds = parseInt(funds.substr(1)) ;

  console.log("Input",funds,itemBought,quantity) ;
var itemCost = 0 ;

if (itemBought == 'room') {
  itemCost =  parseInt($('#roomPrice').text()) ;
  var rooms = parseInt($('#rooms').val()) ;
  rooms = rooms + quantity ;
  $('#rooms').val(rooms) ;
  }
if (itemBought == 'phone') {
  itemCost =   parseInt($('#wholesalePrice').text()) ;
  var phones = parseInt($('#phones').text()) ;
  phones = phones + quantity ;
  $('#phones').val(phones) ;
  }
console.log("Output",itemBought, itemCost,quantity, itemCost*quantity) ;
  funds = funds - itemCost * quantity ;
  $('#yourMoney').text('$' + funds) ;
  console.log("Output",funds,itemCost,quantity) ;
}
</script>

 
<!-- on load -->
<script type="text/javascript">

  
$(document).ready(function(){
  
/*
setInterval(function(){//setInterval() method execute on every interval until called clearInterval()
  $('#updateRound').load("getRound.php");
  var roundInfo = $('#updateRound').text() ;
  var data = roundInfo.split("*") ;
  var round = data[0] ;
  var aliens = data[1] ;
// console.log("update2",data,roundInfo,round,aliens) ;
var current =  $('#currentRound').val() ;
teamName = $('#teamName').val() ;
  if (current != round && round > 1 && teamName === "")
  {
   // topMenuDisplay() ;
  }

  $('#currentRound').val(round) ;
  $('#aliensArriving').val(aliens) ;
  // console.log("Updating round") ;
  //load() method fetch data from getRound.php page
 }, 5000); // set to 5 seconds
*/
 // console.log("Updating round") ;

    $('#updateRound').hide() ;
    $('#logIn').show() ;
    $('#gameData').hide() ;
    $('#teamRegistration').hide() ;
    $('#chooseOldTeam').hide();
    $('#topMenu').hide();
    $('#wholesaler').hide() ;
    $('#stats').hide() ;
    $('#setPrice').hide() ;
    $('#roundData').hide() ;
  
    $('#totalMoney').show() ;
    $('#yourMoney').hide() ;
    $('#orderForm').hide() ;
  

    roundNumber = 0 ;
    rooms = 0 ;
    stock = 0 ;
    income = 0 ;
    expenditure = 0 ;
    purchases = 0 ;
    sales = 0 ;
    sellingPrice = 0 ;
    balance = 0 ;

    $('#yourMoney').text(balance) ;
    $('#currentRound').text(roundNumber) ; // round 0
    $('#ourTeam').text('') ; // team none
    $('#rooms').val(rooms) ; // rooms = 0 
    $('#stock').val(stock) ; // no stock yet
    $('#currentSellingPrice').text(sellingPrice) ;

    // load constants - starting capital, wholesale price, limit per room, number of rounds

    $.ajax({    //create an ajax request to load game constants and store as global variables
        type: "POST",
        url: "loadConstants.php",            // find out team balance 
        dataType: "json",   //expect json to be returned   
                  
        success: function(response){ 
            console.log("Constants",response) ;                   
        
        startingCapital = response["startingCapital"];
        phoneLimit = response["phoneLimit"] ;
        wholesalePrice = response["wholesalePrice"] ;
        numberRounds = response["numberRounds"] ;
        roomPrice = response["roomPrice"] ;
        phoneLimit = response['phoneLimit'] ;
        balance = startingCapital  ;

        n = numberWithCommas(balance) ;
       $('#yourMoney').text('$' + n.toString());
       $('#roomPrice').text(roomPrice) ;
       $('#wholesalePrice').text(wholesalePrice) ;
       $('#phoneLimit').text(phoneLimit) ;

  
        }

    });
})
</script>

<script type="text/javascript">

$(document).ready(function(){
     $('#getBalanceUpdate').on('click', function(){

var teamName = $('#ourTeam').val() ;
updateTeamData(teamName) ;


     })
   })

</script>


<!-- click on newTeam -->
<script type="text/javascript">

$(document).ready(function(){
     $('#reports').on('click', function(){

        $('#stats').show();
        $('#topMenu').hide() ;



     })
   })

</script>
<script type="text/javascript">

 

</script>

<script type="text/javascript">
$(document).ready(function(){
     $('#myDataPage').on('click', function(){

       var teamID = $('#ourTeamID').val() ;
       console.log("Our team",teamID) ;

      $('#myData').load("myData.php",{teamID:teamID}) ;

      
      var data = [
  {
    x:['a','b','c'] ,
    y:[2,7,3],
    type: 'bar'
  }

  ] ;

  Plotly.newPlot('myDiv',data) ;
lea

        
     })
   })

</script>

<script type="text/javascript">
$(document).ready(function(){
     $('#backFromStats').on('click', function(){

        alert('Leaving stats')
        $('#stats').hide();
        $('#myDiv').empty() ;
        $('#topMenu').show() ;
     })
   })

</script>

<script type="text/javascript">
  
   $(document).ready(function(){

    $('#buyPhones').on('click', function(){

   // alert('Buy some phones for ' + teamName);
    $('#orderForm').show() ;
    $('#wholesale').show() ;
    $('#wholesaler').load("buyPhones.php",{teamName:teamName});
  var funds = $('#yourMoney').text() ;
  funds = parseInt(funds.substr(1)) ;

  var ownedPhones = parseInt($('#stock').val()) ; 
  var rooms = parseInt($('#rooms').val()) ;
  var phoneLimit = parseInt($('#phoneLimit').text()) ;
  var wholesalePrice = parseInt($('#wholesalePrice').text()) ;
  var roomPrice = parseInt($('#roomPrice').text()) ;
  console.log("numbers for team",funds,ownedPhones,rooms,wholesalePrice,roomPrice,phoneLimit) ;
  var maxPhones = rooms*phoneLimit ;  // 1 x 50 = 50
  var neededPhones = maxPhones - ownedPhones ; // = 50 - 1 = 49
  var affordablePhones = Math.floor(funds / wholesalePrice) ; // = 4500 / 500 = 9
 
  max = neededPhones ; // 49
  if (max > maxPhones ) {max = maxPhones ;} // max = 49 
  if (max > affordablePhones) {max = affordablePhones ;} // max = 9 
  if (max < 0 ) {max = 0 ;}

  console.log("buying",funds,ownedPhones,maxPhones,neededPhones,affordablePhones,max);


  $('#numberPhones').attr({"max":max})
  $('#numberPhones').val(max) ;

	$('#message').text('You can buy ' + max + ' phones') ;

  $('#numberPhones').on('change', function(){

    var numberChosen = parseInt($('#numberPhones').val());
    console.log("want",numberChosen);
	if (numberChosen > max)
    {
      $('#numberPhones').css({"background-color":"red","color":"yellow"}) ;
      alert("Too many") ;
      $('#submitBuy').attr("disabled",true) ;
    }
    else
    $('#numberPhones').css({"background-color":"white","color":"green"}) ;
      $('#submitBuy').attr("disabled",false) ;

    // ajax to update purchases   

})

 
      })
   })

 </script>

 <script type="text/javascript">
  
  $(document).ready(function(){
    $('#submitBuy').on('click', function(){

var quantity = $('#numberPhones').val() ;
var teamName = $('#ourTeam').val() ;
var teamID = $('#ourTeamID').val() ;
var roundNumber = $('#currentRound').val() ;
var itemBought = 'phone' ;
console.log("Buying phones ",quantity,teamName,teamID,roundNumber,itemBought) ;

$.ajax({ 
        type: "POST",
        url: "updatePurchases.php",          
        dataType: "json",   //expect json to be returned   
        data: {teamID:teamID,quantity:quantity,roundNumber:roundNumber,itemBought:itemBought} , // data to submit           
        success: function(response){                    
     // alert('Phne purchases updated' + response) ;
      console.log("processed",response) ;
   
    } // function 

}) ; // ajax

updateBalance(itemBought,quantity) ;
$('#orderForm').hide() ;


      })
   })

 </script>

 <script type="text/javascript">
  
  $(document).ready(function(){
    $('#cancelBuy').on('click', function(){

      $('#orderForm').hide() ;
      $('wholesale').hide() ;

    })
  })

  </script>

 <script type="text/javascript">
  
  $(document).ready(function(){
    $('#buyRoom').on('click', function(){

var quantity = 1 ;
var teamName = $('#ourTeam').val() ;
var teamID = $('#ourTeamID').val() ;
var roundNumber = $('#currentRound').val() ;
var itemBought = 'room' ;
var funds = $('#yourMoney').text() ;
  funds = parseInt(funds.substr(1)) ;
var roomCost = parseInt($('#roomPrice').text());
// need to get balance
console.log("Buying phones ",quantity,teamName,teamID,roundNumber,itemBought) ;
if (funds < roomCost) {alert('You cannot afford a room') ;}
else {
$.ajax({ 
        type: "POST",
        url: "updatePurchases.php",          
        dataType: "json",   //expect json to be returned   
        data: {teamID:teamID,quantity:quantity,roundNumber:roundNumber,itemBought:itemBought} , // data to submit           
        success: function(response){                    
     // alert('Phne purchases updated' + response) ;
      console.log("processed",response) ;
   
    } // function 

}) ; // ajax

updateBalance(itemBought,quantity) ;

}

      })
   })

 </script>

 <!-- setting price fromn list -->

 <script type="text/javascript" >

$(document).ready(function(){
    $('#setPriceButton').on('click', function(){
// alert('Setting price') ;

$('#submitPrice').hide() ;
$('#cancelPrice').hide() ;
 $('#setPrice').show() ;
 $('#priceList').empty() ; // avoid duplicated entries of process is cancelled and revisited
 $('#priceList').append('<option value="" selected >Choose your price</option>') ;
    
$.ajax({    //create an ajax request to saveResponse.php
       type: "POST",
       url: "getPrices.php",            // find out team balance 
       dataType: "json",   //expect json to be returned   
               
       success: function(response){                    
      console.log("response = ",response) ;
  

var mySelect = $('#priceList');

$.each(response, function(val,text) {
   mySelect.append(
       $('<option></option>').val(text).html(text)
   );
});
 
       } 

    

   });

  

    })
  })

</script>

<!-- use team list -->
<script type="text/javascript" >

// if doesn't work on iPad then add form for this action

$(document).ready(function(){
    $("#priceList").on('change',function(){
        selectedPrice = $(this).children("option:selected").val();
      
     console.log("price",selectedPrice) ;
     $('#submitPrice').show() ;
      $('#cancelPrice').show() ;
        price = selectedPrice;

   
    

    });
});

</script>

<!-- accept team -->
<script type="text/javascript">
$(document).ready(function(){
    $('#submitPrice').on('click', function(){
 
       price = selectedPrice;
       console.log("Accepted price",price,selectedPrice) ;
        $('#setPrice').hide() ;
        topMenuDisplay() ;
      
var roundNumber = parseInt($('#currentRound').val()) ;
var teamID = $('#ourTeamID').val();
console.log("Setting price",teamID,roundNumber,price) ;
$('#currentSellingPrice').text(price) ;
        // write price to table 
        $.ajax({    //create an ajax request 
          type: "POST",
          url: "updateSellingPrice.php",            // find out team balance 
          dataType: "json",   //expect json to be returned   
          data: {roundNumber:roundNumber,teamID:teamID, price:price},
               
       success: function(response){                    
      console.log("response sp = ",response) ;
   //    alert('Received selling price' + response) ;


}

});

    });
});

</script>

<!-- cancel team -->
<script type="text/javascript">

$(document).ready(function(){
    $("#cancelPrice").on('click', function(){
    
       
        $('#setPrice').hide() ;




    });
});
</script>

<!-- click on newTeam -->
<script type="text/javascript">

$(document).ready(function(){
     $('#newTeam').on('click', function(){

  // alert('Making a new team');
  $('#logInStart').hide();
  $('#logIn').show() ;
  alert("making a new team") ;
  $('#teamRegistration').show() ;

     })
   })

</script>

<!-- register team -->
<script type="text/javascript">


$(document).ready(function(){
     $('#registerTeam').on('click', function(){

$('#error').hide() ;
        alert('Registering team') ;
        $('#logIn').show() ;
       $('#logInStart').show() ;
       $('#teamRegistration').show() ;
        
        var teamName = $('#teamName').val() ;
        $('#currentRound').val(roundNumber);

        // limit to three players

        var player1 = $('#player1').val();
        var player2 = $('#player2').val();
        var player3 = $('#player3').val();

        var sent = teamName + '-' + player1 +'-' + player2 + '-' + player3;
        console.log("Registered ",teamName);
        console.log("Sending",sent);
        alert('Registering your registerTeam' + teamName );
        $('#team').load('teamDetails.php');
 
  $.ajax({    //create an ajax request to registerTeam.php
        type: "POST",
        url: "registerTeam.php",             
        dataType: "json",   //expect html to be returned   
        data: {teamName:teamName, player1:player1,player2:player2,player3:player3 },  // data to submit           
        success: function(response){                    
     // alert('Student is  ' + response) ;

        $('#team').html(response);
        console.log(response.substr(0,5)) ;

        if (response.substr(0,5) == 'Error') {alert('Wrong data ' + response);
        $('#error').html(response).show() ;
            // don't hide input 
          }
          else {
           // alert("Good to go ");
           console.log("Team",response) ;
           topMenuDisplay() ;
        $('#logIn').hide() ;
        $('#logInStart').hide() ;
           
            let id = response ;
            $('#ourTeam').val(teamName);
            $('#ourTeamID').val(id) ;
            $('#currentRound').val(0) ;
            $('#stock').val(10) ;
            $('#rooms').val(1) ;
          }
        }

       

    });

$('#ourTeam').val(teamName) ;
// console.log("Your team ",teamName);
topMenuDisplay() ;
        $('#logIn').hide() ;
        $('#logInStart').show() ;
   
// set up team with 10000, 5000 to buy room and 5000 to buy 10 phones

 
     })
   })
   
</script>


<!-- clear registration form -->
<script type="text/javascript" >

$(document).ready(function(){
     $('#clearRegistration').on('click', function(){
        
     
        $('#team').val('') ;
        $('[id^=player]').val('') ;


     })
   })

</script>

<!-- cancel registration form -->
<script type="text/javascript" >

$(document).ready(function(){
     $('#cancelRegistration').on('click', function(){
        
      //  alert('Cancelling registration')
        $('#team').val('') ;
        $('[id^=player]').val('') ;
        $('#logIn').show() ;
        $('#teamRegistration').hide() ;


     })
   })

</script>

<!-- use old team -->
<script type="text/javascript" >

$(document).ready(function(){
    $('#oldTeam').on('click', function(){

  alert("Staying with the same team");
$('#acceptTeam').hide() ;
$('#cancelTeam').hide() ;
 $('#logInStart').show();
 $('#chooseOldTeam').show() ;



    })
  })

</script>

<!-- use team list -->
<script type="text/javascript" >

// if doesn't work on iPad then make with php for this action

$(document).ready(function(){
    $("#teamList").on('change',function(){

    // selectedTeam = $(this).children("option:selected").val();
    teamName = $(this).val();
  
      teamLevel = 1 ; // start at the beginning
      console.log("Index",teamName,teamLevel);
    
  

      $('#acceptTeam').show() ;
      $('#cancelTeam').show() ;
      $('#viewTeam').text('') ;

      // list team members 
      
$('#viewTeam').load('getPlayers.php',{teamName:teamName}) ;
/*
      $.ajax({    //create an ajax request
        type: "POST",
        url: "getPlayers.php",            // find out team balance 
        dataType: "json",   //expect json to be returned   
        data: {teamName:teamName},  // data to submit           
        success: function(response){                    
        console.log("response team players = ",response) ;
        alert('response ' + response) ;
        let l = response.length ;
        for (var i = 0 ; i < l ; i++)
        {
          let who = response[i]['Family_name'] + ' ' + response[i]['First_name'] + ' ' + response[i]['Grade'] + '<br>' ;
          $('#viewTeam').append(who) ;
        }

  
        }

    });
*/
    });
});

</script>

<!-- accept team -->
<script type="text/javascript">
$(document).ready(function(){
    $('#acceptTeam').on('click', function(){
 
// alert("Clicked" + teamName) ;
 
      
        $('#chooseOldTeam').hide() ;
        topMenuDisplay() ;
        $('#teamList').hide() ;
        $('#logIn').hide() ;
       // $('#currentRound').val(1) ; // 1st round
        $('#ourTeam').val(teamName); // store team name
        $('#topMenu').show() ;
        $('#gameData').show() ;

updateTeamData(teamName) ;

    });
});

</script>

<!-- cancel team -->
<script type="text/javascript">

$(document).ready(function(){
    $("#cancelTeam").on('click', function(){
    
        teamName = "";
        $('#chooseOldTeam').hide() ;
        $('#logInStart').show() ;
     //   $('#teamList').hide() ;

// show team members

    });
});
</script>

<script type="text/javascript">

$(document).ready(function(){
     $('#leaderBoardButton').on('click', function(){

// alert('Getting leaderboard') ;


$('#leaderBoard').show() ;
    $('leaderBoardData').text('') ;
  plotX = [] ;
  plotY = [] ;


  data = [] ;

      $.ajax({    //create an ajax request
        type: "POST",
        url: "allBalances.php",            // find out team balance 
        dataType: "json",   //expect json to be returned   
        // data: {teamName:teamName},  // data to submit           
        success: function(item)
        
        {  
          console.log("response all balances = ",item[3]) ;
      
          for (i = 0 ; i < item.length; i++) {   

       teamName = item[i]['teamName']  ;
       teamID = item[i]['teamID']  ;
       plotX[i] = teamName ;
       totalSales =  item[i]['income']  ;
       totalPurchased = item[i]["expenditure"]  ;
       startingCapital =  item[i]['capital'] ;
       phones =  item[i]['phones']  ;
       rooms =  item[i]['rooms']  ;
       balance = item[i]['balance']  ;
        phones = parseInt(phones) ;
       plotY[i] = balance ;

     //  console.log("plot ongoing data",plotX,plotY)
       phonesBought =  item[i]['phonesBought']  ;
       phonesSold =  item[i]['phonesSold']  ;
       rommsBought =  item[i]['roomsBought']  ;
       roomsSold =  item[i]['roomsSold'] ;
       console.log("plot data now i",i,plotX[i],plotY[i]) ;
        $('#leaderBoardData').append(teamName + ' $' + balance + ' sales = '  + phonesSold + '<br>') ;
        }  // i loop
     

        }  // success

    });    

 x1 = ["alpha", "PIO100", "PIO120", "PIO23", "PIO231", "PIO24"];

 $( document ).ajaxStop(function() {  // gets ajax in sync with the  program flow - so only plt when array is full from ajax load
  
        console.log("XY3",plotX,plotY) ;
          barGraph(plotX,plotY) ;
});
 
 


  }); 
}); 

    </script>
