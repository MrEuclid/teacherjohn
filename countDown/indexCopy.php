<!DOCTYPE html>
<html lang="en">

  <head>
 
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../javaScript/bootStrap/bootstrap-3.3.7-dist/css/bootstrap.min.css">
  <script src="../javaScript/jQuery/jquery-3.3.1.min.js"></script>
  <script src="../javaScript/bootStrap/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="css/phoneStyles.css">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>Phone game - v2</title>


  </head>
  <body>

<div class  = "container-fluid">

  <div class = "row">
    <div class = "col-md-12 c">
<h1>The Phone Gamev2</h1>


<a href = "index.php"><button  class="btn btn-primary btn-lg">New</button></a>
<input id = "ourTeam" type = "text" value="" readonly = "TRUE">
<a href = "../index.php"><button  class="btn btn-danger btn-lg">Quit</button></a>
<span><div id = "updateRound">0-0</div><div id = "aliens"><aliens</div>
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

<!-- displays the total money for a team -->
<div class = "row">
<div class = "col-md-12 c">

<div id = "totalMoney">
   <span>   <label></label><p id = "yourMoney"></p></span></div>

</div></div>
<!--
<div id ="round0Menu"> 
<div class = "row">
    <div class = "col-md-12 c">
    <?php include "includes/round0Menu.html" ; ?>
</div></div>
</div>

set price only -->


<div id ="topMenu"> 
<div class = "row">
    <div class = "col-md-12 c">
<?php include "includes/topMenu.html" ; ?>
<!-- top menu lists the main options for a player -->
</div></div>
</div> 

<div id = "logInStart"> 
<div class = "row">
    <div class = "col-md-12 c">
<?php include "includes/logInStart.html"; ?>
<!-- logInStart  to select team menus -->
</div></div>
</div> 


<div id = "logIn"> 
<div class = "row">
    <div class = "col-md-12 c">
<?php include "includes/logIn.html" ; ?>
 <!-- login enter new team name and player school IDs-->
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
</div>

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

<div id = "chooseOldTeam">
<div class = "row">
<div class = "col-md-12 c">
<?php include "includes/chooseOldTeam.html" ; ?>


<!-- form for choosing old team  -->
</div></div>
</div> 

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

function topMenuDisplay()

{
var round = parseInt($('#currentRound').val());
$('#topMenu').show() ;

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

    
setInterval(function(){//setInterval() method execute on every interval until called clearInterval()
  $('#updateRound').load("getRound.php");
  var roundInfo = $('#updateRound').text() ;
  var data = roundInfo.split("*") ;
  var round = data[0] ;
  var aliens = data[1] ;
// console.log("update2",data,roundInfo,round,aliens) ;
var current =  $('#currentRound').val() ;
  if (current != round & round > 1) 
  {
    topMenuDisplay() ;
  }
  
  $('#currentRound').val(round) ;
  $('#aliensArriving').val(aliens) ;
  // console.log("Updating round") ;
  //load() method fetch data from getRound.php page
 }, 5000); // set to 5 seconds

 // console.log("Updating round") ;
    
    $('#logInStart').show() ;
    $('#logIn').hide() ;
    $('#topMenu').hide();
    $('#round0Menu').hide() ;
    $('#wholesaler').hide() ;
    $('#stats').hide() ;
    $('#setPrice').hide() ;
  
    $('#totalMoney').show() ;
    $('#yourMoney').show() ;
    $('#orderForm').hide() ;
    $('#chooseOldTeam').hide();

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

      $.ajax({    //create an ajax request
        type: "POST",
        url: "getBalance.php",            // find out team balance 
        dataType: "json",   //expect json to be returned   
        data: {teamName:teamName},  // data to submit           
        success: function(response){                    
       console.log("response old team = ",response) ;
       var capital = parseInt(response["capital"]);
      // alert(capital);
       var income = parseInt(response["income"]);
       var expenditure = parseInt(response["expenditure"]);
       var ourTeamID = parseInt(response["ourTeamID"]) ;
       var stock = parseInt(response["phones"]) ;
       var rooms = parseInt(response["rooms"]) ;
       balance = capital + (income - expenditure) ;
       n = numberWithCommas(balance) ;
       console.log(ourTeamID,"balance now = ",balance,capital,income,expenditure) ;
       $('#yourMoney').text('$' + balance);
       $('#ourTeamID').val(ourTeamID) ;
       $('#stock').val(stock) ;
       $('#rooms').val(rooms) ;
       $('#capital').text(capital) ;
       $('#income').text(income) ;
       $('#expenditure').text(expenditure) ;
       $('#balance').text(balance) ;

  
        }

    });     



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
        
     })
   })

</script>

<script type="text/javascript">
$(document).ready(function(){
     $('#backFromStats').on('click', function(){

        alert('Leaving stats')
        $('#stats').hide();
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
       // $('#logInStart').show() ;
        topMenuDisplay() ;
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
        $('#logInStart').hide() ;
   
// set up team with 10000, 5000 to buy room and 5000 to buy 10 phones

 
     })
   })
   
</script>


<!-- clear registration form -->
<script type="text/javascript" scr = "javascript/indexCancelRegistration.js">

$(document).ready(function(){
     $('#clearRegistration').on('click', function(){
        
     
        $('#team').val('') ;
        $('[id^=player]').val('') ;


     })
   })

</script>

<!-- cancel registration form -->
<script type="text/javascript" scr = "javascript/indexCancelRegistration.js">

$(document).ready(function(){
     $('#cancelRegistration').on('click', function(){
        
      //  alert('Cancelling registration')
        $('#team').val('') ;
        $('[id^=player]').val('') ;
        $('#logIn').hide() ;
        $('#logInStart').show() ;


     })
   })

</script>

<!-- use old team -->
<script type="text/javascript" >

$(document).ready(function(){
    $('#oldTeam').on('click', function(){

 // alert("Staying with the same team");
$('#acceptTeam').hide() ;
$('#cancelTeam').hide() ;
 $('#logInStart').show();
 $('#chooseOldTeam').show() ;
 $('#teamList').empty() ; // avoid duplicated entries of process is cancelled and revisited
 $('#teamList').append('<option value="" selected >Choose your team</option>') ;
    
$.ajax({    //create an ajax request to saveResponse.php
       type: "POST",
       url: "getTeamLists.php",            // find out team balance 
       dataType: "json",   //expect json to be returned   
               
       success: function(response){                    
      console.log("response = ",response) ;
  

var mySelect = $('#teamList');

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
    $("#teamList").on('change',function(){
        selectedTeam = $(this).children("option:selected").val();
      
     console.log("team",selectedTeam) ;
     $('#acceptTeam').show() ;
      $('#cancelTeam').show() ;
        teamName = selectedTeam;
        $('#viewTeam').empty()  ;
// show team members
 $.ajax({    //create an ajax request to saveResponse.php
        type: "POST",
        url: "getPlayers.php",            // find out team balance 
        dataType: "json",   //expect json to be returned   
        data: {teamName:teamName},  // data to submit           
        success: function(response){                    
       console.log("response = ",response) ;
        
for (let i = 0 ; i < response.length; i++ )
        $('#viewTeam').append(response[i][0] + ' ' + response[i][1] + ' ' + response[i][2] + '<br>');
  
        }
   
    });

    });
});

</script>

<!-- accept team -->
<script type="text/javascript">
$(document).ready(function(){
    $('#acceptTeam').on('click', function(){
 
// alert("Clicked" + teamName) ;
 
        teamName = selectedTeam;
        $('#chooseOldTeam').hide() ;
        topMenuDisplay() ;
        $('#teamList').hide() ;
        $('#logInStart').hide() ;
$('#currentRound').val(1) ; // 1st round
$('#ourTeam').val(teamName); // store team name



roundNumber = $('#currentRound').val() ;

 $.ajax({    //create an ajax request
        type: "POST",
        url: "getBalance.php",            // find out team balance 
        dataType: "json",   //expect json to be returned   
        data: {teamName:teamName},  // data to submit           
        success: function(response){                    
       console.log("response old team = ",response) ;
       var capital = parseInt(response["capital"]);
      // alert(capital);
       var income = parseInt(response["income"]);
       var expenditure = parseInt(response["expenditure"]);
       var ourTeamID = parseInt(response["ourTeamID"]) ;
       var stock = parseInt(response["phones"]) ;
       var rooms = parseInt(response["rooms"]) ;
       balance = capital + (income - expenditure) ;
       n = numberWithCommas(balance) ;
       console.log(ourTeamID,"balance now = ",balance,capital,income,expenditure) ;
       $('#yourMoney').text('$' + balance);
       $('#ourTeamID').val(ourTeamID) ;
       $('#stock').val(stock) ;
       $('#rooms').val(rooms) ;

  
        }

    });


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

alert('Getting leaderboard') ;
$('#leaderBoard').show() ;
    $('leaderBoardData').text('') ;


      $.ajax({    //create an ajax request
        type: "POST",
        url: "allBalances.php",            // find out team balance 
        dataType: "json",   //expect json to be returned   
        // data: {teamName:teamName},  // data to submit           
        success: function(output)
        
        {  
          console.log("response all balances = ",output) ;
          for (let item of output) {   //ES2015 don't need counter

                     
      
       teamName = item['teamName']  ;
       
       teamID = item['teamID']  ;
       totalSales =  item['income']  ;
       totalPurchased = item["expenditure"]  ;
       startingCapital =  item['capital'] ;
       phones =  item['phones']  ;
       ro0ms =  item['rooms']  ;
       balance = item['balance']  ;
       phonesBought =  item['phonesBought']  ;
       phonesSold =  item['phonesSold']  ;
       rommsBought =  item['roomsBought']  ;
       roomsSold =  item['roomsSold'] ;
      
        $('#leaderBoardData').append(teamName + ' $' + balance + ' sales = '  + phonesSold + '<br>') ;
        }

  
        }

    });    
  }); 
}); 

    </script>