<?php 
include "../connectTempleDB.php" ; 

// $teamName = 'PIO1';
$teamName = $_POST['teamName'];  // load needs get
$query = "SELECT teamID FROM phoneTeams WHERE teamName = '$teamName' ";
$result = mysqli_query($dbServer,$query) ;
$data = mysqli_fetch_row($result);
$teamID = $data[0] ;

$phones = [] ;
$query = "SELECT phoneID,brand,wholesalePrice FROM phoneWholeSalePrices" ;
$result = mysqli_query($dbServer,$query);
$n = mysqli_num_rows($result);

$i = 0;
while ($data = mysqli_fetch_row($result))
{
  $i++ ;
  $phones[$i] = $data ;
  
}


// get inventory
$query = "SELECT teamID FROM phoneTeams WHERE teamName = '$teamName' ";
$result = mysqli_query($dbServer,$query) ;
$data = mysqli_fetch_row($result);
$teamID = $data[0] ;

 // get table


$query = "SELECT 
phonePurchases.phoneID,brand,
sum(numberBought) AS purchases,
sum(numberSold) AS sales,

(sum(numberBought) - sum(numberSold)) AS inventory

FROM 
phoneWholeSalePrices
 JOIN
 phoneSales
 ON 
 phoneWholeSalePrices.phoneID = phoneSales.phoneID
 JOIN phonePurchases
 ON
 phoneWholeSalePrices.phoneID = phonePurchases.phoneID
 AND phoneSales.teamID = '$teamID'
 GROUP BY brand " ;

$result = mysqli_query($dbServer,$query);
$i = 0;
$stock = [] ;
while ($data = mysqli_fetch_row($result))
{
  //print_r($data);
 // $output[$i] = array($data[0],$data[1],$data[2], $data[3]);
  $stock[$i] = $data ;
 $i++ ;
}

print_r($stock) ;

?>



<div class = "row">
  <div class = "col-md-12 c">
<h2>Set the selling prices for your phones</h2>
<p>This is the price that you will sell the phone for 
  <strong>in this round only</strong>.
  You can change the price in later rounds. </p>
</div></div>
<div class = "row">
  <div class = "col-md-12 c">
<label>Set your price for this round</label>
</div></div>

<div class = "row">
  <div class = "col-md-3 c">
    <h3>Phone</h3>
    <div class = "col-md-3 c">
    <h3>Wholesale price</h3>
    <div class = "col-md-3 c">
    <h3>Selling price</h3>
    <div class = "col-md-3 c">
    <h3>Quantity</h3>
<?php
for ($i = 1 ; $i <= n; $i++)
{


}

?>
<br>

<input id = "sellingPricePhone" type = "number" min="0" max = "1500"> 
    </div>

<div class = "row">
  <div class = "col-md-12 c">
<label id = "message">How many phones do you want to sell?</label>
<br>

<input id = "numberPhones" type = "number" min="0" max = "100"> <!-- need to set from inventory -->
<button id = "sell">Set</button>
<button id = "cancel">Cancel</button>

</div></div>
<script type="text/javascript">
  
   $(document).ready(function(){  	

	$('#message').text('You can sell ' + max + ' ' + phone[index]) ;

  alert("Getting inventory") ;

// find out how many phones the team hasof each type
// that will control the display
  $.ajax({    //create an ajax request to saveResponse.php
        type: "POST",
        url: "/phoneGame/getInventory.php",             // buy phones of a specifi type tp sell later
        dataType: "json",     
        data: {teamName:teamName},  // data to submit           
        success: function(response){                    

      console.log("response = ",response) ;
      alert('Got data');

  
          
      
        }  // success

    });  // ajax



	})

</script>

<script type="text/javascript">
  
   $(document).ready(function(){
     $('#sell').on('click', function(){

		var numberChosen = parseInt($('#numberPhones').val());
		console.log("Team is", teamName);

		if (numberChosen > max ) 
			{alert("Too many") ;}
		else 
			{
		//		alert("OK for round# " + roundNumber + ' team ' + teamName + ' phone = ' +item);

// AJAX call to update
// team purchases of phone
// need round number

var round = roundNumber ;
var phone = index ;  // just need index , not name
var quantity = numberChosen

  $.ajax({    //create an ajax request to saveResponse.php
        type: "POST",
        url: "/phoneGame/purchasePhones.php",             // buy phones of a specifi type tp sell later
        dataType: "json",     
        data: {teamName:teamName, phone:phone,quantity:quantity,roundNumber:roundNumber },  // data to submit           
        success: function(response){                    

  		console.log("response = ",response) ;
       var capital = parseInt(response["capital"]);
     //  alert(capital);
       var income = parseInt(response["income"]);
       var expenditure = parseInt(response["expenditure"]);
       balance = capital + (income - expenditure) ;
        n = numberWithCommas(balance)
     	console.log("balance after purchase = ",balance,capital,income,expenditure) ;
       $('#yourMoney').text('$' + n.toString());

  
          
      
        }  // success

    });  // ajax


	} // else		

$('#orderForm').hide() ;
$('[id^=phone').show() ;  // put buttons back
$('#sellPhones').attr("disabled",false);

/*
  $.ajax({    //create an ajax request to saveResponse.php
        type: "POST",
        url: "/phoneGame/getBalance.php",            // find out team balance 
        dataType: "json",   //expect json to be returned   
        data: {teamName:teamName,roundNumber:roundNumber},  // data to submit           
        success: function(response){                    
  
       console.log("response = ",response) ;
       var capital = parseInt(response["capital"]);
     //  alert(capital);
       var income = parseInt(response["income"]);
       var expenditure = parseInt(response["expenditure"]);
       balance = capital + (income - expenditure) ;
        n = numberWithCommas(balance)
     	console.log("balance now = ",balance,capital,income,expenditure) ;
       $('#yourMoney').text('$' + n.toString());

  
        }

    });
*/
 
     })
   })
   
</script>


<script type="text/javascript">
  
   $(document).ready(function(){
     $('#cancel').on('click', function(){

     	$('#setPrice').hide();

   })
   })



