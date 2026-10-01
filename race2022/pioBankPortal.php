<?php // $grade = $_REQUEST['grade']; ?>

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
<title>PIO Bank Portal</title>

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

#submit {background-color: grey; color: black;}


#home,#cancel {display: inline-block; background-color: green; color: yellow;font-size:1em ; font-weight:bolder; width:5em;}


#teams {margin-top:2em; margin-bottom: 2em; color:black;}

#detail {width:200;background-color: lightyellow; color:black;}
  </style>

  </head>
  <body>
      <div class  = "container-fluid">

<div class = "row">
  <div class = "col- text-center">
<a href = "indexMonopoly.php"><button id = "home">Home</button></a>
<button id = "register">Register</button>
<button id = "login">Log in</button>
      
      <div class = "row">
        <div class = "col- text-center">
        <div id = "heading">
   <h3>PIO Bank Customer Login</h3>
</div> <!-- heading -->
</div></div>


<div id = "loginForm">
  <fieldset>
<div class = "row">
  <div class = "col- text-center"><label>Team name</label>
 <br><input id = "teamName" type = "text" placeholder="Team name"></div>
</div> <!-- row -->



<div class = "row">
  <div class = "col- text-center"><label>Password</label>
    <br>
 <input id = "password" type = "text" placeholder="password"></div>
</div> <!-- row -->


<div class = "row text-center">
  <div class = "col- ">
 <button id = "send">Send</button>
</div>
</div> <!-- row -->


<div class = "row text-center">
  <div class = "col- ">
<a href = "resetPassword.php">Forgot your password? </a>
</fieldset>
</div> <!-- row -->


</div> <!-- form -->



    <div class = "row text-center">
  <div class = "col- ">
    <p id = "balance"></p>
    <p id = "msgCnt"></p>
</div></div>
<div id = "userOptions">
  <div class = "row text-center">
  <div class = "col- ">
    <button id = "payments">Pay a team</button>
      <button id = "bank">Pay bank</button>
     <button id = "realEstate">Buy real estate</button>
      <button id = "view">View transactions</button>
       <button id = "messages">Messaging</button>
  </div></div>
</div> <!-- user options -->
  <div id = "makePayment">
   <div class = "row text-center">
  <div class = "col- ">
    <h3>Make a payment</h3>
    <?php

    ?>
    <select id="teams">

        <option dvalue="" disabled selected>Select team to be paid</option>
    </select>
</div></div>

     <div class = "row text-center">
  <div class = "col- ">
    <label>Team</label><br>
<input id = "payee" type = "text" readonly>
  </div></div>

       <div class = "row text-center">
  <div class = "col- ">
       <label>Amount</label><br>
<input id = "paid" type = "number" min = "10" max = "10000">
  </div></div>

         <div class = "row text-center">
  <div class = "col- ">
       <label>Details</label><br>
<input id = "details" type = "text" size  = "100" >
  </div></div>

     <div class = "row text-center">
  <div class = "col- ">
    <button id = "pay">Pay money</button>
  </div></div>
  </div> <!-- make payment -->

     <div class = "row text-center">
  <div class = "col- ">

<div id = "messageOutput">
  
   <div class = "row text-center">
  <div class = "col- ">
 
</div></div>
</div> <!-- messageOutput -->
</div></div>


<!-- load when the appropriate button is clicked -->

</div> <!-- container -->
  </body>
</html>



<script type="text/javascript">
     $(document).ready(function(){

        $('#register').hide();
        $('#login').hide();
        $('#userOptions').hide();
        $('#makePayment').hide();
        $('#msgCnt').hide(); // stores value only
        $('#messageOutput').hide();

game = 1;

players = [];

// load players of this game


 
   })

</script>



<script type="text/javascript">
  
    $(document).ready(function(){
    $('#send').on('click', function()

{
  target = this.id;
  console.log(target);
  team = $('#teamName').val();
  pwd = $('#password').val()
 // alert(team + " " + pwd);
game = 1;

  $.ajax({
  url: "checkLogin.php",
  type: "POST",
  data:{team:team, password:pwd},
  dataType:'text',
    success : function(data) {   

   // alert(data + " " + data == 1)   ;  
   d = parseInt(data) ;
    console.log("response",d, d == 1)    ; 
      if (data == 1)
      {
        alert("Logged into your account.");
         $('#userOptions').show();
         $('#loginForm').hide();

          $.ajax({
  url: "getPlayers.php",
  type: "POST",
  data:{game:game},
  dataType:'text',
    success : function(data) {   
      console.log("data",data);
      people = JSON.parse(data);
      let l = people.length;
      for (let i = 0 ; i < l ; i++)
      {


      players.push(people[i]);
      console.log(people[i]);
      }
     console.log(players[2]);

     // populate drop down list

    // $('#teams').empty();
      $('#teams').append($('<option></option>').val("Select the team"));
      
$.each(players, function(i, p) {
    $('#teams').append($('<option></option>').val(p).html(p));
});``

    },
    error : function(request,error)
    {
        alert("Request: "+JSON.stringify(request));
    }
});



            setInterval(function() {
        $("#balance").load("getBalance.php",{team:team, game:game}); 
        $("#msgCnt").load("countMessages.php",{team:team, game:game});  
        let mcnt = $('#msgCnt').text(); 
        $('#messages').text(mcnt) ;   
    }, 5000);  // update every 10 seconds

/*
    setInterval(function() {
        $("#msgCnt").load("countMessages.php",{team:team, game:game});  
        let mcnt = $('#msgCnt').text(); 
        $('#messages').text(mcnt) ;
    }, 10000);  // update every 10 seconds
*/

      }
else
  {alert("Error in team name or password");}

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
    $('#messages').on('click', function()

{
 // alert(team + "  " + game);
  $('#messageOutput').toggle();
 // $('#messageOutput').show();
  $('#messageOutput').load("viewMessages.php?team="+team + "&game=" + game);

  })
  })
</script>


<script type="text/javascript">

  
    $(document).ready(function(){
    $('#payments').on('click', function()

{

  $('#makePayment').toggle();


  })
  })
</script>

<script type="text/javascript">

  
    $(document).ready(function(){
    $('#pay').on('click', function()

{

// validate fields 


let text;
if (confirm("Make a payment of $" + x + " to team " + team + "?") == true) {
  alert("Your payment has been made.");
    $('#makePayment').toggle();
} else {
 alert("Your payment is canceled!");
}



  })
  })
</script>

<script type="text/javascript">

// for dropdown list of payees

  $('#teams').change(function() {
    //Use $option (with the "$") to see that the variable is a jQuery object
    var $option = $(this).find('option:selected');
    //Added with the EDIT
    var value = $option.val();//to get content of "value" attrib
    var txt = $option.text();//to get <option>Text</option> content
alert(txt);
    $('#payee').val(txt);
});
</script>

  

