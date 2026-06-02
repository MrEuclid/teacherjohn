$(document).ready(function(){
    $("#acceptTeam").on('click', function(){
 
        teamName = selectedTeam;
        $('#chooseOldTeam').hide() ;
        $('#topMenu').show() ;
      //  $('#teamList').hide() ;
$('#currentRound').val(1) ; // 1st round
$('#ourTeam').val(teamName); // store team name
$('#ourTeamID')
// show team members
roundNumber = $('#currentRound').val() ;

 $.ajax({    //create an ajax request to saveResponse.php
        type: "POST",
        url: "/phoneGame/getBalance.php",            // find out team balance 
        dataType: "json",   //expect json to be returned   
        data: {teamName:teamName,roundNumber:roundNumber},  // data to submit           
        success: function(response){                    
       console.log("response = ",response) ;
       var capital = parseInt(response["capital"]);
      // alert(capital);
       var income = parseInt(response["income"]);
       var expenditure = parseInt(response["expenditure"]);
       var teamID = response["ourTeamID"] ;
       balance = capital + (income - expenditure) ;
        n = numberWithCommas(balance) ;
      console.log("balance now = ",balance,capital,income,expenditure) ;
       $('#yourMoney').text('$' + n.toString());
       $('ourTeamID').val(teamID)

  
        }

    });


    });
});