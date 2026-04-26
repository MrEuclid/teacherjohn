

$(document).ready(function(){

    $("[id^=key-]").click(function(){
    clicked = $(this).attr("id"); // get id of the key 
    clicked = clicked.substr(4);  // remove key-
  // alert('id = ' + clicked + ' key = ' + keys[clicked]) ; // show the number that was clicked
  //  alert('focused = ' + focused);
    amount = keys[clicked] ;
    
      if ( focused != "")
      { 
        var showing =  $('#'+focused).val();  // what is already in the input box
      
   if (amount == "C")
     {
      var l = showing.length ;
      if (l > 0)
      {
      showing = showing.slice(0,-1); 
      }  // reduce string by 1
      display = showing ; // amount = original amount
      $('#'+focused).val(display); 
     }

   if (amount == "AC")
     {

      showing = ""; // set string to ""  
      display = showing ; // amount = original amount
      $('#'+focused).val(display); 
     }

     if (amount != "C" && amount != "AC")
     {
      var display = showing + amount ;  // add the value of what has been clicked
       $('#'+focused).val(display);  // update input box 
     }

}
    


  

})
})



