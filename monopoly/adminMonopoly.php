<!DOCTYPE html>
<html lang="en">
  <head>
 

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"></script>

  <script type="text/x-mathjax-config">
    MathJax.Hub.Config({
      extensions: ["tex2jax.js"],
      jax: ["input/TeX","output/HTML-CSS"],
      tex2jax: {inlineMath: [["$","$"],["\\(","\\)"]]}
    });
  </script>   
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.7/MathJax.js"></script>
  


    <meta charset="utf-8">
    
    <meta name="description" content="">
    <meta name="keywords" content="">
<title>Administer Monopoly</title>

<style type="text/css">

h1 {display: inline-block; font-size:2em; font-weight:bolder; color:green; text-align:center;}

input {
    margin-bottom:1em; 
    background-color: lightgreen; 
    text-align: center;
    height: 2em;
    width: 20em;
    color:black;
}

.menu {
  color:white;
  background-color: blue;
  font-weight: bold;
  margin-right: 1em;
  margin-bottom: 1em;
  height:60px;
  width:auto;
}

label {inset-block: font-weight:bolder; color:blue; font-size: 2em; font-weight: bolder;}
p {display:inline-block;}

#submit {background-color: black; color: white;}


#home,#cancel {display: inline-block; background-color: green; color: yellow;font-size:1em ; font-weight:bolder; width:5em;}

#gameID {width:auto;}

  </style>

  </head>
  <body>
      <div class  = "container-fluid">
      
      <div class = "row">
        <div class = "col- text-center">
        <div id = "heading">
          <a href = "../index.php"><button id = "home">Home</button></a>
   <h1>Monopoly Administration</h1>
</div> <!-- heading -->
</div></div>
<div id = "login">
   <div class = "row">
        <div class = "col- text-center">
    <label>User name</label>
    <br>
    <input id = "user">
    <br>
     <label>Password</label>
    <br>
    <input id = "password">
      <br>
    <button id = "submit">Submit</button>
</div> <!-- heading -->
</div></div>
</div> <!-- login -->
   <div class = "row">
        <div class = "col- text-center">

</div></div>
<div id = "chooseGame">

  <div class = "row">
  <div class = "col- text-center">
    <labell>Game number </label>
    <input type = "number" id = "gameID" value="0">

  </div></div>
</div> <!-- choose game -->
<div id = "actions">
<div class = "row">
  <div class = "col- text-center">
<button class = "menu" id = "customers">View customers</button>
<button class = "menu" id = "clearOne">Clear game</button>
<button class = "menu" id = "viewTransactions">View game transactions</button>
<button class = "menu" id = "viewProperty">View property register</button>
<button class = "menu" id = "clearAll">Clear data</button>

<button class = "menu" id = "teams">Edit transactions</button>
<button class = "menu" id = "oneGame">Make one game</button>
<button class = "menu" id = "oneGameComp">Make one competiton game</button>
<a href = "wealthVisual.html" target = "_blank">
<button class = "menu" id = "leader">Leaderboard</button></a>
<!--
<button class = "menu" id = "leaderBoard">Leaderboard</button>
-->

  </div></div>
<div class = "row">
  <div class = "col- text-center">
<div id = "output">
</div></div>
</div> <!--actions -->

</div> <!-- container -->
</body>
</html>

<script type="text/javascript">
  
    $(document).ready(function(){
  })

</script>

<script type="text/javascript">
  
    $(document).ready(function(){
    $('#customers').on('click', function()

{
game = $('#gameID').val();
   alert(this.id + " " + game);
   $.ajax({
 url: "viewCustomers.php",
  type: "POST",
  data: {game:game},
 
  dataType:'text',
    success : function(data) {   
   //   console.log("data",data);
   //   gifted = JSON.parse(data);
     
$('#output').html(data);
      
  
    },
    error : function(request,error)
    {
        alert("Request: "+JSON.stringify(request));
    }
});

  })
  })

</script>

<script type="text/javascript">
  
    $(document).ready(function(){
    $('#clearOne').on('click', function()

{
game = $('#gameID').val();


  // alert(this.id + " " + game);

   let proceed = false;
  let text = "This will delete all player data for game" + game;
  if (confirm(text) == true) {
    text = "You pressed OK!";
    proceed = true;
  } else {
    text = "You canceled!";
  }
if (proceed ==  true){
   $.ajax({
 url: "clearGame.php",
  type: "POST",
  data: {game:game},
 
  dataType:'text',
    success : function(data) {   
   //   console.log("data",data);
   //   gifted = JSON.parse(data);
     
$('#output').html(data);
      
  
    },
    error : function(request,error)
    {
        alert("Request: "+JSON.stringify(request));
    }
});
}
  })
  })

</script>

<script type="text/javascript">
     $(document).ready(function(){
  $('#chooseGame').hide();
 $('#actions').hide();
  $('#login').show();
 $('#new').hide();
})
</script>

<script type="text/javascript">
  
    $(document).ready(function(){
    $('#submit').on('click', function()

{

let guess = $('#password').val();
if ( guess =="archimedes")
  {
    $('#actions').show();
    $('#login').hide();
      $('#chooseGame').show();
}
  
});
})

</script>

<script type="text/javascript">
  
    $(document).ready(function(){
    $('#oneGame').on('click', function()

{

   
   $.ajax({
 url: "makeOneGame.php",
  type: "POST",
 
  dataType:'text',
    success : function(data) {   
   //   console.log("data",data);
   //   gifted = JSON.parse(data);
     
 alert(data);
      
  
    },
    error : function(request,error)
    {
        alert("Request: "+JSON.stringify(request));
    }
});

  })
  })


</script>


<script type="text/javascript">
  
    $(document).ready(function(){
    $('#oneGameComp').on('click', function()

{

   
   $.ajax({
 url: "makeOneGameFourTeamsNoGifts.php",
  type: "POST",
 
  dataType:'text',
    success : function(data) {   
   //   console.log("data",data);
   //   gifted = JSON.parse(data);
     
 alert(data);
      
  
    },
    error : function(request,error)
    {
        alert("Request: "+JSON.stringify(request));
    }
});

  })
  })


</script>

<script type="text/javascript">
  
    $(document).ready(function(){
    $('#setup').on('click', function()

{
 let proceed = false;
  let text = "This will delete all player data and set up 6 new games - continue?";
  if (confirm(text) == true) {
    text = "You pressed OK!";
    proceed = true;
  } else {
    text = "You canceled!";
  }
if (proceed ==  true){
   $('#new').show();
     $.ajax({
 url: "makeTeams.php",
  type: "POST",
 
  dataType:'text',
    success : function(data) {   
   //   console.log("data",data);
      gifted = JSON.parse(data);
     
 
      
  
    },
    error : function(request,error)
    {
        alert("Request: "+JSON.stringify(request));
    }
});
 } // proceed

 else {alert("Cancelled");}

  })
  })


</script>


<script type="text/javascript">
  
    $(document).ready(function(){
    $('#clearAll').on('click', function()

{
 let proceed = false;
  let text = "This will clear ALL data - continue?";
  if (confirm(text) == true) {
    text = "You pressed OK!";
    proceed = true;
  } else {
    text = "You canceled!";
  }
if (proceed == true){
   $('#new').show();
     $.ajax({
  url: "clearTables.php",
  type: "POST",
 
  dataType:'text',
    success : function(data) {   
   //   console.log("data",data);
      let message = JSON.parse(data);
     
 alert(message);
      
  
    },
    error : function(request,error)
    {
        alert("Request: "+JSON.stringify(request));
    }
});
 } // proceed

 else {alert("Cancelled");}

  })
  })


</script>

<script type="text/javascript">
  
    $(document).ready(function(){
    $('#clearOne').on('click', function()

    {

     gameID = $('')
})
  })


</script>

<script type="text/javascript">
  
    $(document).ready(function(){
    $('#leaderBoard').on('click', function()

   {

    alert(this.id);
   $.ajax({
 url: "wealth.php",
  type: "POST",
 
  dataType:'text',
    success : function(data) {   
      console.log("data",data);

$('#output').html(data);
      
  
    },
    error : function(request,error)
    {
        alert("Request: "+JSON.stringify(request));
    }
});

  })
  
})
</script>


<script type="text/javascript">
  
    $(document).ready(function(){
    $('#viewTransactions').on('click', function()

   {

   // alert(this.id);
    game = $('#gameID').val();
   $.ajax({
 url: "viewGameTransactions.php",
  type: "POST",
 data: {game:game},
  dataType:'text',
    success : function(data) {   
      console.log("data",data);

$('#output').html(data);
      
  
    },
    error : function(request,error)
    {
        alert("Request: "+JSON.stringify(request));
    }
});

  })
  
})
</script>


<script type="text/javascript">
  
    $(document).ready(function(){
    $('#viewProperty').on('click', function()

   {

   // alert(this.id);
    game = $('#gameID').val();
   $.ajax({
 url: "viewProperty.php",
  type: "POST",
 data: {game:game},
  dataType:'text',
    success : function(data) {   
      console.log("data",data);

$('#output').html(data);
      
  
    },
    error : function(request,error)
    {
        alert("Request: "+JSON.stringify(request));
    }
});

  })
  
})
</script>

