<?php // $game = $_GET['game']; ?>

<!DOCTYPE html>
<html lang="en">
  <head>
 

  <meta name="viewport" content="width=device-width, initial-scale=1">


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"></script>


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


#teams {margin-top:1em; margin-bottom: 1em; color:black; width:auto;}

#detail {width:200px;background-color: lightyellow; color:black;}

#theMessage {
              background-color: white; 
              color: black; 
              text-align: left;
              width:60em; 
              size:140;
              margin:2em;
            }

  #balance, #realty, #worth 
  {font-weight: bolder; 
    font-size: 1.2em;
    margin-right:1em;
  }

  label {font-weight: bolder; font-size: 1.2em; margin:0.5em;}
  select {width: 240px; height; 80px; background-color: lightyellow; color: black; font-size: 1.2em;}

  .highlight_row {color:blue;}
  #cash {width:120px; height:40px; margin-top: 2em;}

   .props {
   border: 1px solid black;
   height: auto;
   width: 120px;
   background-color: white;
   color:black;
   font-size: 1.2em;
}

  .bank {
   border: 1px solid black;
   height: auto;
   width: 120px;
   background-color: blue;
   color:yellow;
   font-size: 1.2em;
}

  .team1 {
   border: 1px solid black;
   height: auto;
   width: 120px;
   background-color: yellow;
   color:green;
   font-size: 1.2em;
}
  .team2 {
   border: 1px solid black;
   height: auto;
   width: 120px;
   background-color: green;
   color:white;
   font-size: 1.2em;
}
  .team3 {
   border: 1px solid black;
   height: auto;
   width: 120px;
   background-color: red;
   color:white;
   font-size: 1.2em;
}
  .team4 {
   border: 1px solid black;
   height: auto;
   width: 120px;
   background-color: orange;
   color:black;
   font-size: 1.2em;
}


#rowData {
    font-weight: bolder;
    color:blue;
    text-align: center;
    font-size: 1.2em;
}
#myOptions {background-color: orange; color: white; margin-bottom: 1em;}

.pay {background-color: red; color: yellow;}
.buy {background-color: green; color: white;}
.own {background-color: lightblue; color: black;}

#worth {margin-right: 0em; color:blue;}


}
  </style>

  </head>
  <body>
      <div class  = "container-fluid">
<p id = "counter"></p>

<div class = "row">
  <div class = "col- text-center">
    <a id = "linkTransactions" href = "">Download transactions</a>
<a href = "indexMonopoly.php"><button id = "home">Log out</button></a>
<button id = "register">Register</button>
<button id = "login">Log in</button>
    <a id = "linkRegister" href = "">Download register</a>    
      <div class = "row">
        <div class = "col- text-center">
        <div id = "heading">
   <h3 id = "header">PIO Bank Customer Login</h3>
</div> <!-- heading -->
</div></div>


<div id = "loginForm">
  <fieldset>
<div class = "row">
  <div class = "col- text-center"><label>Team name</label>
 <br><input id = "teamName" type = "text" autocomplete="new-password"></div>
</div> <!-- row -->

<div class = "row">
  <div class = "col- text-center"><label>Game number</label>
 <br><input id = "gameNumber" type = "number" autocomplete="new-password"></div>
</div> <!-- row -->

<div class = "row">
  <div class = "col- text-center"><label>Password</label>
    <br>
 <input id = "password" type = "text" autocomplete="new-password"></div>
</div> <!-- row -->


<div class = "row text-center">
  <div class = "col- ">
 <button type = "button" id = "send" class="btn btn-success">Send</button>
</div>
</div> <!-- row -->


<div class = "row text-center">
  <div class = "col- ">

</fieldset>
</div> <!-- row -->


</div> <!-- form -->


    <div class = "row text-center">
  <div class = "col- ">
    <p id = "balance"></p><p id = "realty"></p><p id = "worth"></p>
    <p id = "msgCnt"></p>
    <br>
    <button  id = "changeLink" class="btn btn-warning">
     <a  href="#" onclick='goToPage(event)'>Change name</a>
     </button>
</div></div>
  <div class = "row text-center">
  <div class = "col- ">
<p id = "rowData"></p><button id = "myOptions"></button>
<button id = "buyHouse"></button>
<button id = "mortgageLand">Mortgage</button>
<button id = "sellLand">Sell to bank</button>
<button id = "cancelBuy">Cancel</button>
<button id = "cancelSell">Cancel</button>

</div></div>

<div id = "houseBuilding">
  <div class = "row text-center">
  <div class = "col- ">

    <label id = "cityName">Buy houses</label>
    <label id = "cost"></label>
    <input type = "number" id = "building" min="0" max="5">
    <button id = "build">Build</button>
</div></div>
</div> <!-- house building -->
<div id = "userOptions">

 
  <div class = "row text-center">
  <div class = "col- ">
    <button type="button" id = "payments" class="btn btn-primary">Fees and Taxes</button>
    <!--
      <button id = "bank">Pay bank</button>
    -->
      <button type="button" id = "viewTransactions" class="btn btn-primary">View transactions</button>
      <button type="button" id = "viewRealEstate" class="btn btn-primary">Real estate</button>
      <!--
      <button type="button" id = "manageRealEstate" class="btn btn-primary">Manage properties</button>  
    -->
       <button type="button" id = "readMessages" class="btn btn-primary">Read messages</button>
       <button type="button" id = "newMessage" class="btn btn-primary">Make a new message</button>
  </div></div>
</div> <!-- user options -->
  <div id = "makePayment">
   <div class = "row text-center">
  <div class = "col- ">
    <h3>Pay tax or fees</h3>
    <h4>Do not use for rent or buying cities</h4>

    <select id="teams">

        <option value="" disabled selected>Select team to be paid</option>
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
<input id = "amt" type = "number" min = "10" max = "10000">
  </div></div>

         <div class = "row text-center">
  <div class = "col- ">
       <label>Details</label><br>
<input id = "details" type = "text" size  = "100" >
  </div></div>

     <div class = "row text-center">
  <div class = "col- ">
    <button type = "button" id = "pay" class="btn btn-success">Pay money</button>
  </div></div>
  </div> <!-- make payment -->

       <div class = "row text-center">
  <div class = "col- ">

<div id = "makeMessage">
      <div class = "row text-center">
  <div class = "col- ">
  <h4>New message</h4>
</div></div>
  <label>To:</label>
  <select id = "mailList">
       <option value="" disabled selected>Select recipient</option>
  </select>
  <input id = "theMessage" type = "text">
  <button id = "transmit">Send</button>
</div> <!-- messageOutput -->
  
</div></div>

     <div class = "row">
  <div class = "col- d-flex 
                        align-items-center 
                        justify-content-center ">

<div id = "messageOutput"></div> <!-- messageOutput -->
  
</div></div>

    <div class = "row">
  <div class = "col- d-flex 
                        align-items-center 
                        justify-content-center ">

<div id = "propertyOutput"></div> <!-- propertyOutput -->
  
</div></div>


     <div class = "row text-center">
  <div class = "col- d-flex 
                        align-items-center 
                        justify-content-center">

<div id = "transactionOutput"></div> <!-- trnsactionOutput -->
  <div id = "registerOutput">
    <h3>Property Management</h3>
    <label>Property</label>
    <br>
     <input id = "land" list="realEstate" >
    <datalist id = "realEstate"></datalist>
    <br>
    <label>Person</label>
    <br>
    <select id = "customerList"></select>
    <br>
    <label>The team is ...</label>
    <br>
    <select id = "action"></select><br>
    <label>$</label>
    <input id = "cash" type = "text"><br>

    <button type = "button" id = "updateRegister" class="btn btn-success">Process</button>
    <br>
    <p id = "entry"></p>
  </div> <!-- register management -->
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
        $('#makeMessage').hide();
        $('#msgCnt').hide(); // stores value only 
        $('#messageOutput').hide();
        $('#transactionOutput').hide();
        $('#propertyOutput').hide();
        $('#registerOutput').hide();
        $('#teamName').val('');
        $('#gameNumber').val('');
        $('#password').val('');
        $('#changeLink').hide();
        $('#myOptions').hide();
        $('#rowData').hide();
       // $('#payments').hide();
        $('#buyHouse').hide();
        $('#mortgageLand').hide();
        $('#houseBuilding').hide();
        $("#buyHouse").hide();
        $('#sellLand').hide();
        $('#cancelSell').hide();
        $('#cancelBuy').hide();
        $('#linkTransactions').hide();
         $('#linkRegister').hide();
       
creditLimit = 0 ;
game = 0;
currentPlayer = "";
players = [];
titles = [];
// load properties, airports, utilities & chanceCommunityChest
properties = [];
clickedItem = [];
clickedData = [];
// fill properties array
colors = [];
colors['brown'] = 2;
colors['lightblue'] = 3;
colors['lightblue'] = 3;
colors['purple'] = 3;
colors['orange'] = 3;
colors['red'] = 3;
colors['yellow'] = 3;
colors['green'] = 3;
colors['blue'] = 2;
rowData = [];
housingCosts = [];
notCities = [5,12,15,25,28,35]; // used for rent calculations

                       // Creates the link element.

// Sets the href attribute to a particular link.



// make a priceTable for each game
// access for rents, house prices etc
// set reents using that table
console.log(colors);
actions = ["Buying","Selling","Houses & hotels","Mortgaging", "Unmortgaging"];
})
</script>

<script type="text/javascript">
  
    $(document).ready(function(){
    $('#send').on('click', function()

{
  target = this.id;
  console.log(target);
  team = $('#teamName').val();
  pwd = $('#password').val();
  gameNumber = $('#gameNumber').val();
 // alert(team + " " + pwd + " " + gameNumber);


  $.ajax({
  url: "checkLogin.php",
  type: "POST",
  data:{team:team, password:pwd,game:gameNumber},
  dataType:'text',
    success : function(data) {   
 
 
   dataJ = JSON.parse(data);
   l = dataJ.length;
  
   // console.log("response",data)    ; 
     console.log("response",dataJ,dataJ[0].id)    ; 
     if (dataJ[0] == "Error")
      { 
      //alert(data + " " + data == 1)   ; 
       }
      if (dataJ[0] != "Error")
      {
        game = dataJ[0].game;
       console.log("substring",team.substring(0,4));
   if (team.substring(0,4) =='bank' | team.substring(0,4) != 'team') 
      {
        $('#changeLink').hide();
        $('#userOptions').show();
      }

       if (team.substring(0,4) == 'team') 
      {
        $('#changeLink').show();
        $('#userOptions').hide();  
    
      }

        let teamLC = team.toLowerCase();
          alert("Logged into your game." + " " + team.substring(0,5)+ " " + team + " " + game);
         if (teamLC.substring(0,5) == 'bank_')

          {
            $('#payments').show().text("Fees, Taxes & Go"); // different for players
            creditLimit = 2000; // stops banker cheating

          }
         else {
         
    // $('#payments').hide();
         }
        $('#header').append(' ' + team + ' game# ' + game );
        currentPlayer = team;
        // $('#userOptions').show();
         $('#loginForm').hide();

          $.ajax({
  url: "getPlayers.php",
  type: "POST",
  data:{team:team,game:game},
  dataType:'text',
    success : function(data) {   
      console.log("data",data);
      people = JSON.parse(data);
      players = [];
      let l = people.length;
      for (let i = 0 ; i < l ; i++)
      {
      players.push(people[i]);
      console.log(people[i]);
      }
     // players.push("bank_" + game);
      players.sort();
     console.log("players" , game , players);
// alert(players);
     // populate drop down list

     $('#teams').empty();
      $('#teams').append(' <option disabled selected>Select the team to be paid</option>');
      
$.each(players, function(i, p) {
    $('#teams').append($('<option></option>').val(p).html(p));
});``


// get properties and titles

// get titles 

         $.ajax({
  url: "getProperties.php",
  type: "POST",

  dataType:'text',
    success : function(data) {   
    //alert(message + " to " + recipient);

      properties = JSON.parse(data);
   console.log("props 1",properties[1]);

    }, // success
    error : function(request,error)
    {
        alert("Request: "+JSON.stringify(request));
    } // error
});  // ajax

// get housing costs for cities


         $.ajax({
  url: "getHousingCosts.php",
  type: "POST",

  dataType:'text',
    success : function(data) {   
    //alert(message + " to " + recipient);

      housingCosts = JSON.parse(data);
    

    }, // success
    error : function(request,error)
    {
        alert("Request: "+JSON.stringify(request));
    } // error
});  // ajax
// get titles 

         $.ajax({
  url: "getTitles.php",
  type: "POST",

  dataType:'text',
    success : function(data) {   
    //alert(message + " to " + recipient);

      titles = JSON.parse(data);
    //  alert(titles);

    }, // success
    error : function(request,error)
    {
        alert("Request: "+JSON.stringify(request));
    } // error
});  // ajax


 $('#mailList').empty();
     $('#mailList').append(' <option disabled selected>Select the recipient</option>');
$.each(players, function(i, p) {
    $('#mailList').append($('<option></option>').val(p).html(p));
});``// for messages
    },
    error : function(request,error)
    {
        alert("Request: "+JSON.stringify(request));
    }
});



            setInterval(function() {
        $("#balance").load("getBalance.php",{team:team, game:game}); 
        $("#realty").load("getRealty.php",{team:team, game:game}); 
        $("#worth").load("getWorth.php",{team:team, game:game}); 
        $("#msgCnt").load("countMessages.php",{team:team, game:game});  
        $('#linkTransactions').attr("href", "https://pio-students.net/monopoly/dumpTransactions.php?game=" + game); 
        $('#linkRegister').attr("href", "https://pio-students.net/monopoly/dumpRegister.php?game=" + game); 
        $('#linkTransactions').show();
        $('#linkRegister').show();
        let mcnt = $('#msgCnt').text(); 
    //    $('#messages').text(mcnt) ;   
    }, 5000);  // update every 10 seconds



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



function goToPage(event) {
    event.preventDefault();
    window.location="changeTeam.php?team=" + team + "&game=" +game;
}

</script>

<script type="text/javascript">

  
    $(document).ready(function(){
    $('#readMessages').on('click', function()

{
 //alert(team + "  " + game);
  $('#messageOutput').toggle();

  $( this ).toggleClass( "btn btn btn-dark" );
 // $('#messageOutput').show();
  $('#messageOutput').load("viewMessages.php",{team:team,game:game});

  })
  })
</script>

<script type="text/javascript">

  
    $(document).ready(function(){
    $('#viewTransactions').on('click', function()

{
   $( this ).toggleClass( "btn btn btn-dark" );
  $('#transactionOutput').toggle();
  $('#transactionOutput').load("viewTransactions.php",{team:team,game:game});

  })
  })
</script>

<script type="text/javascript">

  
    $(document).ready(function(){
    $('#transactionOutput').on('click', function()

{

 

    $.ajax({
  url: "dumpTransactions.php",
  type: "POST",
  data:{team:team,game:game},
  dataType:'text',
    success : function(e) {  
      alert("Transactions downloaded" + game + team);

    }, // success
    error : function(request,error)
    {
        alert("Request: "+JSON.stringify(request));
    } // error
});  // ajax



})
})
</script>



<script type="text/javascript">

  
    $(document).ready(function(){
    $('#viewRealEstate').on('click', function()

{
  $("#buyHouse").hide();
   $( this ).toggleClass( "btn btn btn-dark" );
  $('#propertyOutput').toggle();
 // $('#propertyOutput').load("viewRealEstate.php",{team:team,game:game});
 $('#propertyOutput').empty();
  $.ajax({
  url: "viewRealEstateJSON.php",
  type: "POST",
  data:{team:team,game:game},
  dataType:'',
    success : function(data) {  
    console.log("jsonProps" , data);
  let myTable = createTableFromJSON(data) ;
$('#propertyOutput').append(myTable);

console.log("rowData 537",rowData);
    let propRegisterclicked =   $('#rowData').text();
    console.log("copied",propRegisterclicked);
    }, // success
    error : function(request,error)
    {
        alert("Request: "+JSON.stringify(request));
    } // error
});  // ajax


  })
  })
</script>
<script type="text/javascript">

  
    $(document).ready(function(){
    $('#payments').on('click', function()

{
  $( this ).toggleClass( "btn btn btn-dark" );
  $('#makePayment').toggle();
  $('#teams').empty();
      $('#teams').append(' <option disabled selected>Select the team to be paid</option>');
      
$.each(players, function(i, p) {
    $('#teams').append($('<option></option>').val(p).html(p));
});``


  })
  })
</script>

<script type="text/javascript">

  
    $(document).ready(function(){
    $('#manageRealEstate').on('click', function()

{
//  alert(this.id);
    $( this ).toggleClass( "btn btn btn-dark" );
  $('#registerOutput').toggle();

 $('#realEstate').empty();
  //   $('#realEstate').append(' <option disabled selected>Select the property</option>');
$.each(titles, function(i, p) {
    $('#realEstate').append($('<option>').val(p).html(p));
});``// for real estate title


 $('#customerList').empty();
     $('#customerList').append(' <option disabled selected>Select the customer</option>');
$.each(players, function(i, p) {
    $('#customerList').append($('<option></option>').val(p).html(p));
});``// for customers


 $('#action').empty();
     $('#action').append(' <option disabled selected>Select the action</option>');
$.each(actions, function(i, p) {
    $('#action').append($('<option></option>').val(p).html(p));
});``// for buy, sell mortgage

  })
  })
</script>

<script type="text/javascript">

  
    $(document).ready(function(){
    $('#newMessage').on('click', function()

{

  $('#makeMessage').toggle();
  $( this ).toggleClass( "btn btn btn-dark" );
 $('#mailList').empty();
 $('#theMessage').val('');
     $('#mailList').append(' <option disabled selected>Select the recipient</option>');
$.each(players, function(i, p) {
    $('#mailList').append($('<option></option>').val(p).html(p));
});``// for messages

  })
  })
</script>

<script type="text/javascript">

  
    $(document).ready(function(){
    $('#transmit').on('click', function()

{

let message = $("#theMessage").val() ;
let recipient = $('#mailList :selected').text();

let index = players.indexOf(recipient);

if ($("#theMessage").val() > "" &  index > -1)
{
         $.ajax({
  url: "sendMessage.php",
  type: "POST",
  data:{
          recipient:recipient,
          sender:team,
          game:game,
          message:message},
  dataType:'text',
    success : function(data) {   
    alert(message + " to " + recipient);

    }, // success
    error : function(request,error)
    {
        alert("Request: "+JSON.stringify(request));
    } // error
});  // ajax

  $('#makeMessage').toggle();
}  // if 
else 
{
 if (index == -1)
  {alert("Please choose a recipient");}

if (message.length == 0)
 {alert("Please add a message");}
}

  })
  })
</script>

<script type="text/javascript">

  
    $(document).ready(function(){
    $('#pay').on('click', function()

{

// validate fields 

amt = $('#amt').val();
amt = parseInt(amt);
let balance = $('#balance').text().replace("$", "").replace(",","").replace("\n\n", "");
// alert($('#balance').text() + ' ' + parseInt(balance));
 let newBalance = parseInt(balance) - amt;
 // let newBalance = parseInt(balance) - amt;
 //alert(newBalance);
 console.log(amt,balance,newBalance);
 if (newBalance < 0) 
 {
  alert('You only have ' + balance); 
  $('#amt').val('');
}

payee = $('#payee').val();
details = $('#details').val();
proceed = false;
if (amt > 0 & payee > ""  & details >" " & newBalance >= 0){proceed = true}
if (team.substring(0,4) == 'bank' & amt > creditLimit)
  {proceed = false;
    alert("The banker cannot make payments over $" + creditLimit);}
if (proceed){
if (confirm("Make a payment of $" + amt+ " to team " + payee + "?" + " team = " + team + " game = " + game) == true) {
 // alert("Your payment has been made.");
  $('#amt').val("");
  $('#payee').val("");
  $('#details').val("");
  $("#teams").find("option:selected").prop('selected',false);

  $('#payments').toggleClass( "btn btn btn-dark" );
          $.ajax({
  url: "payMoney.php",
  type: "POST",
  data:{
          team:team,
          game:game,
          amount:amt,
          payee:payee,
          details:details
        },
  dataType:'text',
    success : function(d) {   
     alert("Received " + d);
  $('#makePayment').hide();
    },
    error : function(request,error)
    {
        alert("Request: "+JSON.stringify(request));
    }
});





} else {
 alert("Your payment is cancelled!");
}

}
else 
{alert("Please complete the payment form or exit");
}


  })
  })
</script>

<script type="text/javascript">

// for dropdown list of payees
  $(document).ready(function(){
  $('#teams').change(function() {
    //Use $option (with the "$") to see that the variable is a jQuery object
    var $option = $(this).find('option:selected');
    //Added with the EDIT
    var value = $option.val();//to get content of "value" attrib
    var txt = $option.text();//to get <option>Text</option> content
// alert(txt);
    $('#payee').val(txt);
});
})
</script>



<script type="text/javascript">

// for dropdown list of payees
  $(document).ready(function(){
  $('#process').change(function() {
    //Use $option (with the "$") to see that the variable is a jQuery object
    var $option = $(this).find('option:selected');
    //Added with the EDIT
    var value = $option.val();//to get content of "value" attrib
    var txt = $option.text();//to get <option>Text</option> content
 
    $('#payee').val(txt);
});
})
</script>


<script type="text/javascript">
  
  function processRequest(action,team,game,square,site,amount)

  {

 // team is the team buying the property, not  the bank
    if (action == "Buying") {
     //  alert("Update " + action + " " + team + " " + game + " " + site + " " + amount);
       // check balance 
        let comment = "purchase";
       // get id and price during query 
           $.ajax({
  url: "updateRegister.php",
  type: "POST",
  data: {action:action,team:team,game:game,square:square,site:site,amount:amount,comment:comment},
  dataType:'text',
    success : function(data) {   
     // register = JSON.parse(data);
      register = data;
      console.log(register);
      console.log("data",data);
      alert(data);
    $('#entry').text(data);



    }, // success
    error : function(request,error)
    {
        alert("Request: buying error "+JSON.stringify(request));
    } // error

});  // ajax

    } // if buying

  // bank is buying property from a selelr

    if (action == "Selling") {
     //  alert("Update  " + action + " " + team + " " + game + " " + site + " " + amount);
        let comment = selling;
       // get id and price during query 
           $.ajax({
  url: "updateRegister.php",
  type: "POST",
  data: {action:action,team:team,game:game,square:square,site:site,amount:amount,comment:comment},
  dataType:'text',
    success : function(data) {   
     // register = JSON.parse(data);
        register = data;
      console.log(register);
      let i= 0;
      index = -1;
        $.each(register, function(i, p) {
          if (register[i].title == site){index = i;}
        });``// fregister
if (index == -1){msg = site + " not found.";}
// let index2 = register.findIndex(item => item.title == site);
    console.log("site ",site,index);
    msg = "Processed";
$('#entry').text(msg);



    }, // success
    error : function(request,error)
    {
        alert("Request: selling  error "+JSON.stringify(request));
        msg = "Not processed";
        $('#entry').text(msg);
    } // error

});  // ajax

    } // if selling

  }
</script>
 
<script type="text/javascript">

// for dropdown list of payees
  $(document).ready(function(){
  $('#updateRegister').on('click', function() {
    //Use $option (with the "$") to see that the variable is a jQuery object
site = $('#land').val();
person = $('#customerList option:selected' ).text();
action =  $('#action option:selected' ).text();
amt = $('#cash').val();
// alert("site = " + site + " person " + person + " action " + action + " $" + amt);
let msg = "site = " + site + " person " + person + " action " + action + " $" + amt ;
// get property register entry
//$('#entry').load('registerEntry.php',{game:game,site:site});

console.log("register parameters",msg);
         $.ajax({
 url: "getRegister.php",
  type: "POST",
  data: {game:game},
  dataType:'text',
    success : function(data) {   
      register = JSON.parse(data);
      console.log("register",register);
      let i= 0;
      index = -1;
        $.each(register, function(i, p) {
          if (register[i].title == site)
            {index = i;}
        });``// fregister
if (index == -1)
  {
    msg = site + " not found.";
    // get price 
    $.each(properties, function(i, p) {
          if (properties[i].title == site)
            {
              square = properties[i].id;
               price = properties[i].price;
              $('#cash').val(price);

              msg += " " + square +  " "  +  price;
              alert(msg);
            }
        });  // fregister
console.log("processrequest",action,person,game,square,site,amt);

// slow it down 

 
            setTimeout(function() {
    processRequest(action,person,game,square,site,amt);
    //    $('#messages').text(mcnt) ;   
    }, 2000);  // update every 10 seconds

}
// let index2 = register.findIndex(item => item.title == site);
    console.log("site ",site,index);
$('#entry').text(msg);



    }, // success
    error : function(request,error)
    {
        alert("Request: "+JSON.stringify(request));
    } // error

});  // ajax



});
})
</script> 



<script type="text/javascript">
    $(document).ready(function(){
    $('#build').on('click', function()
    {
      let houses = 0 ; // for writing to register
      let hotel = 0 ; // for writing to register
      let balance = $('#balance').text();
      let city =  $('#cityName').text();
      let funds = Number(balance.replace(/[^0-9\.]+/g,""));
      let number = parseInt($('#building').val());
      let ownedHouses = parseInt(clickedItem.houses);
      let planned = parseInt(ownedHouses + number);
   //   alert(planned);
      if (planned <= 5)
     {
       let unitCost = parseInt($('#cost').text());
       
       

       let totalCost = unitCost*number;
       alert("cost = " + totalCost + " v balance = " + funds);
       if (totalCost <= funds)
       {
        //update register with new rent and house/hotel numbers
        // get new rent based on the number of houses / hotels
  
  if (planned <= 5)
      {
  
      let index = housingCosts.map(i => i.title).indexOf(city);
      let  element = housingCosts[index];
      let id = element.id
     
      if (planned == 1 ){
        newRent = element.house1;
        houses = 1; 
        hotel = 0;
      }
       if (planned == 2 )
        {
          newRent = element.house2;
          houses = 2; 
          hotel = 0;
        }

      if (planned == 3 )
        {
          newRent = element.house3;
          houses = 3; 
          hotel = 0;
        }

        if (planned == 4 )
        {
          newRent = element.house4;
          houses = 4; 
          hotel = 0;
        }

        if (planned == 5 )
        {
        
          newRent = element.hotel;
          houses = 0; 
          hotel = 1;
      //    alert(5 + " " + element.hotel);
        }
      console.log("housing rent ",team,game,houses,hotel,newRent,element);
      //$('#cost').text(element.buyHouse);
      //  alert("Updating the register with ajax");


        $('#houseBuilding').hide();


       $.ajax({
  url: "updateBuilding.php",
  type: "POST",
  data:{
          id:id,
          title:city,
          team:team,
          game:game,
          houses:houses,
          hotel:hotel,
          money:totalCost
        },
  dataType:'text',
    success : function(d) {   
   alert(d);
 console.log("Received " , d)
    },
    error : function(request,error)
    {
        alert("Request: "+JSON.stringify(request));
    }
});







       }
}
       else {alert("You don't have enough money to build " + number + " houses!");}
     }
     else {alert(number + " is too many! ");}
    })
  })

</script>

<script type="text/javascript">
  function calculateBuildCost(team,game,data,money)
  {
    console.log("buying houses",team,game,money,data);
     
       console.log("house building",clickedItem);
    

  }
</script>
<script>
  
    $(document).ready(function(){
    $('#buyHouse').on('click', function()
    {
     // alert("Please see Teacher John so you can buy houses. " + clickedItem.title);
      $('#buyHouse').hide();
      // check funds 
     $('#houseBuilding').show();
      //  alert("You own " + clickedItem.houses + " houses and " + clickedItem.hotel + " hotel");
          let city = clickedItem.title;
          let index = housingCosts.map(i => i.title).indexOf(city);
      let  element = housingCosts[index];
      console.log("housing 1",element,element.title,element.house);
      $('#cost').text(element.buyHouse);
         $('#cityName').text(city);
         $('#building').val(1);

   //  calculateBuildCost(team,game,clickedItem);
    });
    })

</script>


<script>
  
    $(document).ready(function(){
    $('#rowData').on('click', function()
    {
        console.log($('#rowData').text());
    });
    })

</script>

<script type="text/javascript">
  function buyLand(id,title,team,owner,price,game)

  {
    // alert("buying " + id + title + team + "  " + owner);
let details = title;
          $.ajax({
  url: "buyProperty.php",
  type: "POST",
  data:{
          id:id,
          title:title,
          team:team,
          seller:owner,
          price:price,
          game:game
        },
  dataType:'text',
    success : function(d) {   
     alert("Received " + d);
     $("#myOptions").hide();
 console.log("Received " , d)
    },
    error : function(request,error)
    {
        alert("Request: "+JSON.stringify(request));
    }
});

// slow it down 

 
            setTimeout(function() {
    let n =0 ;
    let clr = clickedItem.color;
   // alert("clr new",clr);
    n = countColor(team,clickedData,clr);
   ;
    let target = colors[clr];
  //  alert(n + "found for " + clr + " v " + target);
    if (n == parseInt(target - 1)) 
      {
         let hotel = clickedItem.hotels;
         if (hotel != 1)
        {$("#buyHouse").show().text('Buy house?');}
         $('#counter').load("countSet.php");
     //   alert("Your account has been updated.");
  }
    //    $('#messages').text(mcnt) ;   
    }, 2000);  // update every 10 seconds

// add delay to avoid asynchronous change
 

  }
</script>


<script type="text/javascript">
  function sellLand(id,title,team,price,game)

  {

let details = title;
          $.ajax({
  url: "sellProperty.php",
  type: "POST",
  data:{
          id:id,
          title:title,
          team:team,
          price:price,
          game:game
        },
  dataType:'text',
    success : function(d) {   
     alert("Received " + d);
     $("#myOptions").hide();
 console.log("Received " , d)
    },
    error : function(request,error)
    {
        alert("Request: "+JSON.stringify(request));
    }
});

// slow it down 

 
            setTimeout(function() {
    let n =0 ;
    let clr = clickedItem.color;
   // alert("clr new",clr);
    n = countColor(team,clickedData,clr);
   
    let target = colors[clr];
  //  alert(n + "found for " + clr + " v " + target);
    if (n == parseInt(target - 1)) 
      {
         let hotel = clickedItem.hotels;
         if (hotel != 1)
        {$("#buyHouse").show().text('Buy house?');}
         $('#counter').load("countSet.php");
     //   alert("Your account has been updated.");
  }
    //    $('#messages').text(mcnt) ;   
    }, 2000);  // update every 10 seconds

// add delay to avoid asynchronous change
 

  }
</script>


<script>
  

  function calculateRent(owner,game,city,clr,houses,hotel,rent)

{

 // alert("checking rent " + owner + city + clr + rent + houses + " " + hotel);
  // housing costs comes from the properties table
  let index = housingCosts.map(i => i.title).indexOf(city);
      let  element = housingCosts[index];
      let id = element.id;
      // clicked data comes fromthe row clicked
      let cnt =   countColor(owner,clickedData,clr);
      // cnt < colors[clr] then rent is unchanged
if (cnt < colors[clr]) {newRent = rent;}
if (cnt == colors[clr])
{
  if (houses == 0 & hotel == 0) {newRent = rent*2;}
  if (houses == 1){newRent = element.house1;}
  if (houses == 2){newRent = element.house2;}
  if (houses == 3){newRent = element.house3;}
  if (houses == 4){newRent = element.house4;}
  if (hotel == 1){newRent = element.hotel;}


}
      
  alert("Rent for " + city + " is now " + newRent);


      return newRent ;
}
</script>

<script type="text/javascript">
  function  payRent(id,city,team,owner,rent,game)
     {
   // alert("renting  " + id + city + team + "  " + owner + rent + game);

          $.ajax({
  url: "payRent.php",
  type: "POST",
  data:{
          id:id,
          title:city,
          team:team,
          owner:owner,
          rent:rent,
          game:game
        },
  dataType:'text',
    success : function(d) {   
     alert("Paid rent " + d);
 console.log("Paid " , d)
    },
    error : function(request,error)
    {
        alert("Request: "+JSON.stringify(request));
    }
});

  }

</script>

<script type="text/javascript">
      $(document).ready(function(){
    $('#sellLand').on('click', function()
    {
      let city = clickedItem.title;
        let index = housingCosts.map(i => i.title).indexOf(city);
      let  element = housingCosts[index];
      let price = clickedItem.purchasePrice;
      let id = clickedItem.square ;
      let sellMessage = "Sell " + clickedItem.title + " to the bank for $" + price + "?";
    //  alert(this.id + clickedItem.square + clickedItem.title + team + element.price);
 if (confirm(sellMessage) == true)
            {
              // alert("You are selling  " + city + " for $" + price + " " + id);
               sellLand(id,city,team,price,game)
         }

    });
  })
</script>

<script type="text/javascript">
      $(document).ready(function(){
    $('#cancelSell').on('click', function()
    {
     // alert(this.id);
      $("#myOptions").hide();
      $("#sellLand").hide();
      $("#cancelSell").hide();
    });
  })
</script>

<script type="text/javascript">
        $(document).ready(function(){
    $('#cancelBuy').on('click', function()
    {
      // alert(this.id);
       $("#myOptions").hide();
       $('#buyHouse').hide();
       $('#cancelBuy').hide();
    });
  })
</script>

<script>
  
  function countColor(team,data,clr)
  {

    // counts a color in the propertyRegister for a team
    cnt = 0 ;

console.log(data);
    for (let i = 0 ; i < data.length; i++)
{
  console.log("checking clr ",i,data[i].color,data[i].team);
  if (data[i].color == clr & data[i].team == team)
    {cnt++;}
    }
  

    return cnt;
  }
</script>

<script type="text/javascript">
  
 function  checkOwner(id,city,team)
  {
   // alert("Checking owner record " + clickedItem.color);
    let n =0 ;
   let clr = clickedItem.color;
    // check property register to find how many other sof the same color owned by team
   // console.log("data register 1",clickedData[1].color,clickedData[1].team);
    n = countColor(team,clickedData,clr);
 //   alert(n+ clr + colors);
    let target = colors[clr];
    console.log("target",target);
    alert(n + " found for " + clr + " v " + target);
    $('#counter').load("countSet.php");
    let t = parseInt(target);
    if (n == t) 
    {
       let hotel = clickedItem.hotels;
       if (hotel != 1)
      {
        $("#buyHouse").show().text('Buy house?');
        $('#cancelBuy').show().text('Cancel');
      }
      // and some other things
     // alert("You own a set.");
    // set rents

     let city = clickedItem.title;
          let index = housingCosts.map(i => i.title).indexOf(city);
      let  element = housingCosts[index];
      console.log("housing 1",element,element.title,element.rent);
      alert("new rent = " + element.rent*2);
// ajax to do whole set
      
    }
 
    
  }
</script>


<script>
  
    $(document).ready(function(){
    $('#myOptions').on('click', function()
    {
        let t = this.id;
    
        let detail = $('#myOptions').text();
         let m = detail.replace(/(\r\n|\n|\r)/gm, "");
        let d = m.split(' ');
        
        // need to parse message 
        let action = d[0]; 
       // alert("Do " + action);
        console.log(d,d[0]);
        
        let balance = $('#balance').text();
        let bal = Number(balance.replace(/[^0-9\.]+/g,""));
    
        if (action == "Buy")
          {
            let id = d[1];
            let city = d[2];
            let price = d[4]; // strip $
            price = price.substring(1);
            // check balance 
         
          //  let diff = parseInt(bal - price);
          //  alert(balance + " " + bal + " " + diff);
            if (bal < price) {alert("You don't have enough money!" + bal +  " " + price);}
            let owner = d[6];
            let buyMessage = id + " Buy  " + city + " from " + owner  + 
                " for " + price + "?" + " " + team + " " + game;
          if (bal >= price)
           {
            if (confirm(buyMessage) == true)
            {
              // alert("You, " + owner + " selling " + city);
              buyLand(id,city,team,owner,price,game);
            }
          }

          }

          if (m.substring(0,3) == "Pay")
          {
            // alert(id + " Pay  " + owner + " " + money + " for " + city);
            let owner = d[3];
            let id = d[5];
            let city = d[6];
            let  rent= d[1]; // strip $
            let clr = clickedItem.color;
            let houses = clickedItem.houses;
            let hotel = clickedItem.hotel;
             rent = rent.substring(1);
             newRent = rent;
           // let cnt =   countColor(owner,clickedData,clr);
             let location = notCities.indexOf(parseInt(id));
         //    alert(id + " " + location);
             if (location == -1){newRent = calculateRent(owner,game,city,clr,houses,hotel,rent);}
            else {newRent = rent;}
          //  alert("count owner " + owner + " " + clr + " " + cnt + " target " + colors[clr]);
         
           
           $('#myOptions').hide();
            let rentMessage = id + " Pay  " + newRent + " to " +  owner  + 
                " for " + city + "?" + " " + team + " " + game;
           
            if (bal < newRent) {alert("You don't have enough money!");}
      if (bal >= rent)
        {
            if (confirm(rentMessage) == true)
            {
              // alert("You, " + owner + " selling " + city);
              payRent(id,city,team,owner,newRent,game);
              $('#myOptions').hide();
              $('#cancelSell').hide();
              $('#sellLand').hide();
            }
          }
          }

           if (m.substring(0,3) == "You")
          {
            

            let id = d[2];
            let city = d[3];
            let owner = team;
            let clr = clickedItem.color;
             let cnt =   countColor(owner,clickedData,clr);
           alert(id + " " + city + " " +  "Owned by " + team + " clr " + clr + " " + cnt + " v " + colors[clr]);
        //   checkOwner(id,city,team);
 if (cnt == colors[clr])
            {

              checkOwner(id,city,team);
            }

          else
          {
           // alert(  " Not a set");
            $("#buyHouse").hide();
            $('#sellLand').show().text('Sell to bank?');
            $('#cancelSell').show().text('Cancel');
      }

}
    });
    })

</script>


<script type="text/javascript">

 function createTableFromJSON(jsonArray) {
  // Parse the JSON string
  let data = JSON.parse(jsonArray);

  // Create the table element
  let table = $('<table>');

  // Create table header row (optional)
  let headerRow = $('<tr>');
  for (let key in data[0]) {
    headerRow.append($('<th>').text(key));
  }
  table.append(headerRow);

  // Loop through each object in the array
  $.each(data, function(index, item) {
    let  row = $('<tr>');
   // row.addClass("props");
    let tn = -1;
    let t = data[index].team;
    tn = players.indexOf(t);
     console.log("items",t,tn,t.substring(0,5),t.substring(0,5) == "bank_",players);
    if (t.substring(0,5) == "bank_"){ row.addClass("bank");}
    if (tn == 0){row.addClass("team1");}
   if (tn == 1) {row.addClass("team2");}
   if (tn == 2) {row.addClass("team3");}
   if (tn == 3) {row.addClass("team4");}
    // Add each value as a table cell
    for (var key in item) {
      row.append($('<td>').text(item[key]));
 if (data[index].team.substring(0,4) == "bank_")
 {console.log("bank");}
    }

    // Make the row clickable with an index reference
    row.click(function() {
      // You can access the data object using the index here
      console.log("Row clicked:", index, item);
      clickedItem = item;
      clickedData = data ;
    //   alert(item.square + " " + item.color);
      // Perform your desired action on row click
      rowData.push(index); // relates to property index
      let title = data[index].title;
      let square = data[index].square;
      let mortgaged = data[index].mortgaged;
      let rent = data[index].rent;
      let team = data[index].team;
      let clr = data[index].color;
      $('#rowData').text(clr + " " +square + " "  + team + " " + title + " " + mortgaged + " " + rent);
      $('#myOptions').load("checkOptions.php", {team:currentPlayer,game:game,square:square}).show();
      let action = $('#myOptions').text();
        let act = action.replace(/(\r\n|\n|\r)/gm, "");
        let a = act.substring(0,3);
      console.log("action",act,a,a == "Pay", a == "Buy", a == "You");
      alert("Choosing  " + title);
      if (act.substring(0,3) == 'Pay')
        { $('#myOptions').css({"background-color":"red","color":"yellow"});}
      if (act.substring(0,3) == 'Buy')
         { $('#myOptions').css({"background-color":"green","color":"white"});}
      if (act.substring(0,3) == 'You')
        { $('#myOptions').css({"background-color":"lightblue","color":"black"});}
  // now check availalbe options 

  //    $('#myOptions')load("checkOptions",{team:team,game:game,square:square});

    });

    table.append(row);
  });

  return table;
}

</script>

