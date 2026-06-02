
<label>How many do you want to buy?</label>
<br>
<label id = "message"></label>
<br>

<input id = "numberPhones" type = "number" min="0" max = "">
<button id = "submitBuy">Buy</button>
<button id = "cancelBuy">Cancel</button>



<!--
<script type="text/javascript">
  
   $(document).ready(function(){
     $('#buy').on('click', function(){

    
  max = '<?php echo $max ; ?>' ;
  alert('Max is now ' + max) ;
  
  $('#numberPhones').attr({"max":max})
  $('#numberPhones').val(max) ;

	$('#message').text('You can buy ' + max + ' ' + phone[index]) ;

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
var phoneID = index ;  // just need index , not name
var quantity = numberChosen ;

  $.ajax({    //create an ajax request to saveResponse.php
        type: "POST",
        url: "purchasePhones.php",             // buy phones of a specifictype tp sell later
        dataType: "json",     
        data: {teamName:teamName, phoneID:phoneID,quantity:quantity,roundNumber:roundNumber },  // data to submit           
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
$('#phone1').hide() ;

  $.ajax({    //create an ajax request to saveResponse.php
        type: "POST",
        url: "getBalance.php",            // find out team balance 
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

 
     })
   })
   
</script>


<script type="text/javascript">
  
   $(document).ready(function(){
     $('#cancel').on('click', function(){

     	$('#orderForm').hide();

   })
   })

  </script>

  -->

