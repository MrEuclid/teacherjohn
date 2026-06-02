$(document).ready(function(){
    $("#teamList").change(function(){
        selectedTeam = $(this).children("option:selected").val();
     //   alert("You have selected the team - " + selectedTeam);
        teamName = selectedTeam;
        $('#viewTeam').empty()  ;
// show team members
 $.ajax({    //create an ajax request to saveResponse.php
        type: "POST",
        url: "/phoneGame/getPlayers.php",            // find out team balance 
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