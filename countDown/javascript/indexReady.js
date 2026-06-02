 
 
  
$(document).ready(function(){
    $('#logInStart').show() ;
    $('#logIn').hide() ;
    $('#topMenu').hide();
    $('#wholesaler').hide() ;
  
    $('#totalMoney').show() ;
    $('#yourMoney').show() ;
    $('#orderForm').hide() ;
    $('#chooseOldTeam').hide() ;
    $('#personalData').hide() ;

    roundNumber = 0 ;
    rooms = 0 ;
    stock = 0 ;
    income = 0 ;
    expenditure = 0 ;
    purchases = 0 ;
    sales = 0 ;
    balance = 0 ;
    $('#yourMoney').text(balance) ;
    $('#currentRound').val(roundNumber) ; // round 0
    $('#ourTeam').val('') ; // team none
    $('#rooms').val(rooms) ; // rooms = 0 
    $('#stock').val(stock) ; // no stock yet

    // load constants - starting capital, wholesale price, limit per room, number of rounds

    $.ajax({    //create an ajax request to load game constants and store as global variables
        type: "POST",
        url: "/phoneGame/loadConstants.php",            // find out team balance 
        dataType: "json",   //expect json to be returned   
                  
        success: function(response){ 
            console.log("Constants",response) ;                   
        
        startingCapital = response[1];
        phoneLimit = response[2] ;
        wholesalePrice = response[3] ;
        numberRounds = response[4] ;
        balance = startingCapital  ;

        n = numberWithCommas(balance) ;
       $('#yourMoney').text('$' + n.toString());

  
        }

    });
})