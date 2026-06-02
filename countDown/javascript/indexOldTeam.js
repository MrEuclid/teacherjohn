
  
  $(document).ready(function(){
    $('#oldTeam').on('click', function(){

alert("Staying with the same team");
 $('#logInStart').hide();
 $('#chooseOldTeam').show() ;

// $('#enterSchoolID').load("getTeamLists.php").show() ;
    
$.ajax({    //create an ajax request to saveResponse.php
       type: "POST",
       url: "/phoneGame/getTeamLists.php",            // find out team balance 
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

