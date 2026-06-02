<?php 
$teamName = $_REQUEST['teamName'] ;
?>

    <div class = "row">
        <div class = "col-md-12 c">
<h1>Buy phones @ Super-iPhone-Deals</h1>
</div></div>

   <div class = "row">
        <div class = "col-md-12 c">
    <button  class="btn btn-success btn-lg" id = "phone1"></button>
    <br>
    <button  class="btn btn-primary btn-lg" id = "submitOrder">Buy phones</button>
</div></div>
  


<script type="text/javascript">

  
   $(document).ready(function(){

// use AJAX to get these from the database

 
cost = wholesalePrice ;

console.log("phones price",wholesalePrice);
 
  $('#phone1').append('<br>' + '$' + cost + '<br>' + stock) ;

    });

</script>


<script type="text/javascript">
  
   $(document).ready(function(){
     $('#phone1').on('click', function(){

        var teamName = $('#ourTeam').val() ;

        $.ajax({    //create an ajax request to saveResponse.php
        type: "POST",
        url: "getBalance.php",            // find out team balance 
        dataType: "json",   //expect json to be returned   
        data: {teamName:teamName},  // data to submit           
        success: function(response){                    
       console.log("response balance = ",response) ;
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
       $('#yourMoney').text('$' + n.toString());
       $('#ourTeamID').val(ourTeamID) ;
       $('#stock').val(stock) ;
       $('#rooms').val(rooms) ;

       n = numberWithCommas(balance) ;
       $('#yourMoney').text('$' + n.toString());

  
        }

    });

let roundNumber = $('#currentRound').val() ;
let rooms = parseInt($('#rooms').val()) ;
let maxPhones = phoneLimit * rooms ;
let phones = parseInt($('#stock').val()) ;
let funds = balance
// alert('teamname ' + teamName + ' round = ' + roundNumber);

let needs = maxPhones - phones ; // limit - stock 
let canAfford = funds / wholesalePrice ;
console.log(maxPhones,phones,funds,canAfford) ;

// AJAX to get balance 


alert('You can buy ' + canAfford + ' phones' );

// display order form 

$('#orderForm').show() ;

 
     })
   })
   
</script>