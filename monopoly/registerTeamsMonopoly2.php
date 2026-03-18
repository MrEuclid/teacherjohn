<!DOCTYPE html>
<html lang="en">
  <head>
 
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../bootstrap-5.0.2-dist/css/bootstrap.min.css">
  <script src="../javaScript/jQuery/jquery-3.3.1.min.js"></script>
  <script src="../bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
  <script src = "monopolyFunctions.js">
    
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
 <button id = "submit" >Submit</button></div>
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
  
    $(document).ready(function(){
 $('#register').hide();
  $('#login').hide();


hello();
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
playerLimit = 3 ; // maximum teams per game
$('#teamCount').val(teamCount);
$('#register').hide();
// $('#login').hide();

properties = getProperties();
teams = getCustomers();
titles = getTitles();
airports= getAirports();
utilities =  getUtilities();
cards = getCards();

console.log("properties2",properties);

console.log("titles2",titles);
   })

</script>
