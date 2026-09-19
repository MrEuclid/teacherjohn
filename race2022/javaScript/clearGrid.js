  
   $(document).ready(function(){

    $('#clear').on('click', function()
  {

// remove inputs and turn all lights red

$('#example').hide() ;
$('#grid').show() ;
$('#go').hide() ;
$('[id^=light]').css("background-color","red" );

$('.operand').val('') ;


     }) ;

  })