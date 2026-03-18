<!DOCTYPE html>
<html lang="en">
  <head>
 
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../bootstrap-5.0.2-dist/css/bootstrap.min.css">
  <script src="../javaScript/jQuery/jquery-3.3.1.min.js"></script>
  <script src="../bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    
  <script type="text/x-mathjax-config">
    MathJax.Hub.Config({
      extensions: ["tex2jax.js"],
      jax: ["input/TeX","output/HTML-CSS"],
      tex2jax: {inlineMath: [["$","$"],["\\(","\\)"]]}
    });
  </script>   
  
   <script type="text/javascript">
    MathJax.Hub.Queue(["Typeset",MathJax.Hub]);
  </script>


    <meta charset="utf-8">
    
    <meta name="description" content="">
    <meta name="keywords" content="">
<title>Registration PIO Bank</title>

<style type="text/css">

h1 {display: inline-block; font-size:2em; font-weight:bolder; color:green; text-align:center;}

input {
    margin-bottom:1em; 
    background-color: lightblue; 
    text-align: center;
    height:2em;
    width: 20em;
    color:black;
}

label {inset-block: font-weight:bolder; color:black;}
p {display:inline-block;}

#submit {background-color: black; color: white;}


#home,#cancel {display: inline-block; background-color: green; color: yellow;font-size:1em ; font-weight:bolder; width:5em;}

#teamCount {background-color: lightcoral; color: black;,text-align: center; width:6em;}

  </style>

  </head>
  <body>
      <div class  = "container-fluid">
      
      <div class = "row">
        <div class = "col- text-center">
        <div id = "heading">
   <h1>Welcome to PIO Bank</h1>
</div> <!-- heading -->
</div></div>

<div id = "newCustomer">
<div class = "row">
  <div class = "col- text-center">
<a href = "indexMonopoly.php"><button id = "home">Home</button></a>
<button id = "register">Register</button>
<!--
<button id = "login">Log in</button>
-->
<input id = "teamCount" readonly>
  </div></div>

<div class = "row">
  <div class = "col- text-center">
    <h2>Register your team</h2>
  </div></div>

<div id = "output"></div>

<div class = "row">
  <div class = "col- text-center">
<div id = "customerForm">
<div class = "row">
  <div class = "col- align-self-end"><label>Team name</label>
 <br><input id = "teamName" type = "text" placeholder="Team name"></div>
</div> <!-- row -->


<div class = "row">
  <div class = "col- align-self-end"><label>Email</label>
 <br><input id = "email" type = "emial" placeholder="Your email address"></div>
</div> <!-- row -->

<div class = "row">
  <div class = "col- align-self-end"><label>Password</label>
<br><input id = "password" type = "text" placeholder="password"></div>
</div> <!-- row -->

<div class = "row">
  <div class = "col- align-self-end"><label>Retype Password</label>
<br><input id = "retypePassword" type = "text" placeholder="retype"></div>
</div> <!-- row -->

<div class = "row text-center">
  <div class = "col- ">
 <button id = "submit" >Submit</button>
<input id = "teamPosition" readonly>
</div>
</div> <!-- row -->

</div> <!-- form -->
 </div></div>

<div id = "customerLogin"></div>


<div class = "row text-center">
  <div class = "col- ">
<div id = "message"></div>
</div> <!-- row -->
</div> <!-- container -->
  </body>
</html>

<script type="text/javascript">
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
</script>

<script type="text/javascript">
function getProperties()
{

     $.ajax({
  url: "getProperties.php",
  type: "POST",
 
  dataType:'text',
    success : function(data) {   
   //   console.log("data",data);
      properties = JSON.parse(data);
     
   
      
  
    },
    error : function(request,error)
    {
        alert("Request: "+JSON.stringify(request));
    }
});
 

}
</script>





<script type="text/javascript">
    
  function getAirports()  

{
    

}
</script>

<script type="text/javascript">
    
function getUtilities()
{

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
}

</script>

<script type="text/javascript">
    function getCards()
    {


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

    }
</script>


<script type="text/javascript">
  
  function processGifted(team,game,land)
  {

console.log("gifting",team,game,land);
/*
     $.ajax({
  url: "updatePropertyRegister.php",
  type: "POST",
 data:{team:team,game:game,data:land}.
  dataType:'text',
    success : function(data) {   
  //    console.log("data",data);
    alert(data);
      
   //   console.log(cards);
      
  
    },
    error : function(request,error)
    {
        alert("Request: "+JSON.stringify(request));
    }
});

*/ 
  }
</script>

<script type="text/javascript">
  
    $(document).ready(function(){
 $('#register').hide();
  $('#login').hide();

})
</script>

<script type="text/javascript">
  
    $(document).ready(function(){
// $("#test").on('click', function()
 //{
  // load teams and emails

data = [];
teams = [];
emals = [];
teamCnt = 0 ; // track teams per game 

properties = [];
utilities = [];
airports = [];
cards = [] ; // Chance and Community Chest
titles = [] ; // list of properties ordered by square
available = []; // not yet allocated 
gifted = []; // iniital allocation for each team


// alert("Loading");
teamCount = 0 ; // number of teams
gameNumber = 0; // assign to each team
teamLimit = 3 ; // maximum teams per game
gifts = 6; // gifted properties per team
$('#teamCount').val(teamCount);
$('#register').hide();
// $('#login').hide();


   $.ajax({
  url: "getTitles.php",
  type: "POST",
  async:false,
  dataType:'text',
    success : function(data) { 
alert("Making gifts");
    for (let i =  1; i <= 6; i++)
    {
        gifted[i] = [];"gifted"
    // one for each game 
      console.log("data",data);
      titles[i]= JSON.parse(data);
      available[i] = titles[i].slice(); // properties not yet sold; new lot for each game
      shuffle(available[i]);
      console.log("available shuffled",i,available[i]);
      for (let j = 1; j <= teamLimit*gifts; j++)
      {
        
        gifted[i][j] = available[i][j];
      }

console.log("gifted",i,gifted[i]);
} // i 
  
    },
    error : function(request,error)
    {
        alert("Request: "+JSON.stringify(request));
    }
});



   })
// })
</script>






<script type="text/javascript">
    

      function randomInteger(min, max) { // min and max included 
  return Math.floor(Math.random() * (max - min + 1) + min);
}
</script>



<script type="text/javascript">
    function checkPasswords(p1,p2) {
let matched = false;
let result = false; 
if (p1.length < 6){alert("The password must have at least 6 characters"); }
if (p1 == p2 & p1.length > 5)
{
    matched = true;
}

if (matched == true)
{
    result = true;
  
} 
 else
{
     alert("Passwords do not match.");
  //  $('#password').css("background-color","pink");
  //   $('#retypePassword').css("background-color","pink").val("");
     result = false;
}
console.log("check",p1,p2,result);
 return result;

}

</script>

<script type="text/javascript">
  
    $(document).ready(function(){
    $(":input").on('click', function()

{
let clicked = this.id;

$('#' + clicked).focus();

})
})

</script>


<script type="text/javascript">
  
 
  
    $(document).ready(function(){
    $('#submit').on('click', function()

{
  let formComplete = false;
  // checking submitted data for a new customer

    let team = $('#teamName').val();
    let mail = $('#email').val();
    let password = $('#password').val();
    let retypePassword = $('#retypePassword').val();
    console.log(teamName,email,password,retypePassword);
console.log(teams);
let checkTeam = false;
let checkEmail = false;
let checkPassword = false;
var index = teams.findIndex(obj => obj.teamName== team);

// alert(team + " " + index);
 if (index > -1)
        {result = false;  
        alert("That team name is taken.")} 
        else {result = true;}  // if found false

if (team.length < 3)
    {
        alert("choose a name with 3 or more letters.");
        result = false;
    }
checkTeam = result;
// alert("Team " + result);


var index = teams.findIndex(obj => obj.email== mail);

// alert(mail + " " + index);
 if (index > -1)
        {result = false;  
        alert("That email is taken.")} 
        else {result = true;}  // if found false

//  check for @
index = mail.indexOf("@");

if (index == -1 )
    {
  alert("email address is incorrect") ;
  result = false; 
    }
checkEmail = result;
// alert("Email " + result);


checkEmail = result;
let p1 = $('#password').val();
let p2 = $('#retypePassword').val();
checkPassword =  checkPasswords(p1,p2);
if (checkTeam){$('#teamName').css("background-color","lightgreen").prop('disabled',true);}
else {$('#teamName').css("background-color","pink").val("");}

if (checkEmail){$('#email').css("background-color","lightgreen").prop('disabled',true);}
else {$('#email').css("background-color","pink").val("");}

if (checkPassword){
    $('#password').css("background-color","black").prop('disabled',true);
    $('#retypePassword').css("background-color","black").prop('disabled',true);
}
else {
   $('#password').css("background-color","pink").val("");
    $('#retypePassword').css("background-color","pink").val("");
    }
 //  if (checkMail == true){errorEmail = false;} else {$('#email').val('Please enter a correct email');}
   console.log("check team",checkEmail);


formComplete = checkTeam & checkEmail & checkPassword;


console.log("checks",checkTeam,checkEmail,checkPassword,formComplete);

if (formComplete)
//add ajax to check for unique team name and email
{

// if correct - generate a/c number 12-abcd-pqrs-00

    let part1 = randomInteger(1000,9999);
    let part2 = randomInteger(1000,9999);

    let acNumber = "12-" + part1 + "-" + part2 + "-00" ;
 // generate game number 
 let currentTeams = $('#teamCount').val();
 // get position in the list of teams in this game
 // count teams for game
 let realEstate = [];
 let game = parseInt(Math.floor(currentTeams/teamLimit) + 1);
 $('#teamPosition').load('teamPosition.php',{game:game});
 let teamPosition = $('#teamPosition').val();
 teamPosition = parseInt(teamPosition + 1);
 alert('Team position =' + teamPosition + "game " + game);
 for (let i = 1*teamPosition; i < gifts*teamPosition; i++ )
 {
    realEstate[i] = gifted[game][i];
}
alert("game " + game + ' ' + team +  ' teamPosition' + teamPosition);

console.log("Account",team,mail,p1,acNumber, game,realEstate);

 


$.ajax({
  url: "addCustomer.php",
  type: "POST",
  data:{teamName:team,email:mail,password:p1,accountNumber:acNumber,game:game},
  dataType:'text',
    success : function(d) {              
   
    $('#message').text(d);
  $('#login').show();
  $('#register').hide();
 
    },
    error : function(request,error)
    {
        alert("Request: "+JSON.stringify(request));
    }
});
// generate email 

    //makeAccountNumber(teamName);
   // sendEmail(email);
   // updateDatabase(data);

}

else {
            alert("errors in registration form") ;  
        }
  })
  })


</script>






