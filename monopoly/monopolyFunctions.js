function hello()

{
    alert("Hi");
}

  function shuffle(array) {
  let currentIndex = array.length;

  // While there remain elements to shuffle...
  while (currentIndex != 0) {

    // Pick a remaining element...
    let randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex--;

    // And swap it with the current element.
    [array[currentIndex], array[randomIndex]] = [
      array[randomIndex], array[currentIndex]];
  }
}

function getProperties()
{

properties = [];
// returns an array of all properties
     $.ajax({
  url: "getProperties.php",
  type: "POST",
 
  dataType:'text',
    success : function(data) {   
      console.log("data",data);
      properties = JSON.parse(data);

    },
    error : function(request,error)
    {
        alert("Request: "+JSON.stringify(request));
    }
});
 
 return properties;

}
    
    function getCustomers()

    {
teams = [];
// returns an array of all registered teams
        $.ajax({
  url: "loadCustomers.php",
  type: "POST",
  dataType:'json',
    success : function(data) {              
     //   jData = JSON.stringify(data);
      //  alert("data "+ data[1]["teamName"]);
        console.log(data);
 //      var target = "delta";
 //      var index = -1;
// var index = data.findIndex(obj => obj.teamName== target);
teams  = data.slice();
console.log("Teams",teams);

let l = teams.length;
$('#teamCount').val(l);  // display team count

    },
    error : function(request,error)
    {
        alert("Request: "+JSON.stringify(request));
    }
});

return teams;
    }

    
    function getTitles()
    {
titles = [];
// formatted as square + name e.g 2 + Tokyo
    $.ajax({
  url: "getTitles.php",
  type: "POST",
 
  dataType:'text',
    success : function(data) { 

    for (let i =  1; i <= 4; i++)
    {
    // one for each game 
      console.log("data",data);
     titles[i]= JSON.parse(data);
      available[i] = titles[i].slice(); // properties not yet sold;
      shuffle(available[i]);
      console.log("available shuffled",available[i]);
      
} // i 
  
    },
    error : function(request,error)
    {
        alert("Request: "+JSON.stringify(request));
    }
});
return titles;
    }

    
  function getAirports()  

{
	airports = [];
    $.ajax({
  url: "getAirports.php",
  type: "POST",
 
  dataType:'text',
    success : function(data) {   
   //   console.log("data",data);
      airports = JSON.parse(data);
      
    //  console.log(airports);
      
  
    },
    error : function(request,error)
    {
        alert("Request: "+JSON.stringify(request));
    }
});
return airports;
}

    
function getUtilities()
{

utilities = [];
    $.ajax({
  url: "getUtilities.php",
  type: "POST",
 
  dataType:'text',
    success : function(data) {   
   //   console.log("data",data);
      utilities = JSON.parse(data);
      
  //    console.log(utilities);
      
  
    },
    error : function(request,error)
    {
        alert("Request: "+JSON.stringify(request));
    }
});

return utilities;
}

    function getCards()
    {
cards =  [];

  $.ajax({
  url: "getCards.php",
  type: "POST",
 
  dataType:'text',
    success : function(data) {   
  //    console.log("data",data);
      cards = JSON.parse(data);
      
   //   console.log(cards);
 
  
    },
    error : function(request,error)
    {
        alert("Request: "+JSON.stringify(request));

    }
});

  return cards;

    }


      function randomInteger(min, max) { // min and max included 
  return Math.floor(Math.random() * (max - min + 1) + min);
}