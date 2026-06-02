
   $(document).ready(function(){
     $('#registerTeam').on('click', function(){

$('#error').hide() ;
     //   alert('Registering team') ;
        $('#logIn').show() ;
        var teamName = $('#teamName').val() ;
        $('#currentRound').val(roundNumber);

        // limit to three players

        var player1 = $('#player1').val();
        var player2 = $('#player2').val();
        var player3 = $('#player3').val();

        var sent = teamName + '-' + player1 +'-' + player2 + '-' + player3;
        console.log("Registered ",teamName);
        console.log("Sending",sent);
    //    alert('Registering your registerTeam' + teamName );
   //    $('#team').load('teamDetails.php');
 
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
            $('#logIn').hide() ;
            $('#topMenu').show() ;
         
            $('#ourTeam').val(teamName);

            // hide input form
            // show game buttons
          }
        }

    });

$('#ourTeam').val(teamName) ;
// console.log("Your team ",teamName);
   
// set up team with 10000, 5000 to buy room and 5000 to buy 10 phones

 
     })
   })
   