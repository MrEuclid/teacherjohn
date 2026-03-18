
<!DOCTYPE html>
<html lang="en">
  <head>
 

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../bootstrap-5.0.2-dist/css/bootstrap.min.css">
  <script src="../javaScript/jQuery/jquery-3.3.1.min.js"></script>
  <script src="../bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<title>MBooks Bank</title>

<style type="text/css">
  body {
    display: none;
}

h1 {display: inline-block; font-size:2em; font-weight:bolder; color:green; text-align:center;}


#topline {text-align: center;}
input {
    
    background-color: lightgreen; 
    text-align: center;
    height:2em;
    width: 8em;
    color:black;
    font-weight: bold;
    margin:1em;
   
}

#note {

 
    text-align: left;
    height:2em;
    width: 24em;
 
}

#assets,#liabilities ,#equity, #income, #expenses, #profit,#value
  {
    font-weight: bolder;
    color:green;
    font-size: 1em;

  }

.accountValue {font-size: 1.2em; font-weight: bold;}
.subLabel {font-size: 1.4em; font-weight: bolder;}

.highlight {color:white; background-color:blue;}

label {font-weight:bolder; color:black; font-size:1.2em;}

p {display:inline-block; font-size: 1em;margin:right:1em}

 .positive {color:green;}
  .negative {color:red;}
  .zeto {color:black;}

#submitAccount {background-color: lightblue; color: black; width: 4em;}

#error {color:red;}

.head {font-size: 1em; font-weight: bold;}

#transactions {color:black; font-size: 1em ; margin:1em;}

td,th {border-color: blue; border-width: 0.2em;}
th {text-align: center;}

#transactionStr {color:blue; font-weight: bolder; font-size: 1.2em; margin:2em;}

#coa {margin-top:1em;}

#toggle {margin-top:1em;}

  </style>

  </head>
  <body>

      <div class  = "container-fluid">
     

   <a href = "makeGridv2.php" target = "_blank" >Leader board</a>
&nbsp; &nbsp; 
<p id = "person">X</p>
<p id = "gameID">0</p>
<p id = "studentID">9999</p>
<p id = "otherParty">Y</p>
<p id = "transID"></p>
  <div id = "topLine">
    <div class = "row text-center">
  <div class = "col- ">
<p id = "who"></p>
<label class = "head">Assets</label>
<p id = "assets">$0</p>
<label class = "head">Liabilities</label>
<p id = "liabilities">$0</p>

<label class = "head">Income</label>
<p id = "income">$0</p>
<label class = "head">Expenses</label>
<p id = "expenses">$0</p>


<label class = "head">Money</label>
<p id = "money">$0</p>
</div></div>



</div> <!-- topLine -->


<div id = "loginForm">
<div class = "row">
  <div class = "col- text-center">
   <h3 id = "header">mBooks Bank Login</h3>
</div></div>

<div class = "row text-center">
  <div class = "col- ">
  <img src = "images/hundredDollar.jpg">
</div></div>




<div class = "row">

  <div class = "col- text-center">
  <input type="text" id="student" list="studentList" placeholder="Bank ID">
<datalist id="studentList"></datalist>

    <button id = "submit" class = "btn btn-info btn-lg">Register</button>
  </div></div>
</div> <!--  loginform -->


      <div id = "menu">

     <div class = "row text-center">
  <div class = "col- ">
   <h1>Bank Accounts</h1>
  </div></div>

  <div class = "row text-center">
   <div class = "col-12 text-center">
      <button id = "Btn_receive">Get money</button>
      <button id = "Btn_pay">Pay money</button>
     <button  id = "showTransactions">Transactions</button>
     <!--
         <button  id = "showStatements">My Value</button>
           <button  id = "showProfitLoss">Profit / Loss</button>  
      -->
     <a href = "https://pio-students.net/index.php"> <button id = "quit">Quit</button></a>
</div></div>

</div> <!-- menu -->

<div id = "dataEntry">

  <div class = "row justify-content-center">
        <div class = "col-4 "></div>
    <div class = "col-8 text-left">
      <label>Note</label><input id = "note" type = "text">
    </div></div>

     <div class = "row justify-content-center">
        <div class = "col-4 "></div>
    <div class = "col-8 text-left">
        <label>Player</label>
          <select id="players" >
    <option>Choose the player</option>
</select>
    </div></div> 

 <div class = "row justify-content-center">
   <div class = "col-4 "></div>
    <div class = "col-8 text-left">
      <label>Amount</label><input id = "amount" type = "number" min="100" max = "15000">
    </div></div>

 <div class = "row justify-content-center">
    <div class = "col-4 "></div>
    <div class = "col-4 text-left">
             <select id="accounts" >
    <option>Choose the account</option>
</select>
</div>


    <div class = "col-4 text-left">

<button type = "submit" id = "submitAccount" >Go</button>
  </div></div>


 <div class = "row justify-content-center">
    <div class = "col-12 text-center">
      <p id = "error"></p>
  </div></div>

</div> <!-- data entry -->



  <div id = "performance">

   <div class = "row text-left">
 <div class = "col-4 text-left">
      <h2 class = "stmtHeading">Income</h2>
    </div>
     <div class = "col-4 text-left">
    <h2 class = "stmtHeading">Expenses</h2>
    </div> 
     <div class = "col-4 text-left">
    <h2 class = "stmtHeading">Profit</h2>
    </div> </div>

      <div class = "row">
 <div class = "col-2 text-left">
      <h3 id = "receiveRentHeading" class = "subLabel">Receive rent</h3>
    </div>
     <div class = "col-2 text-left">
      <p id = "receiveRentValue" class = accountValue></p>
    </div> 
 <div class = "col-2 text-left">
      <h3 id = "payRentHeading" class = "subLabel">Pay rent</h3>
    </div>
     <div class = "col-4 text-left">
      <p id = "payRentValue" class = accountValue></p>
    </div> </div>


  <div class = "row">
     <div class = "col-2 text-left">
      <h2 id = "passGoHeading" class = "subLabel">Pass Go</h2>
    </div>
     <div class = "col-2 text-left">
         <h3 id = "passGoValue" class = "accountValue"></h3></div>
             <div class = "col-2 text-left">
      <h2 id = "taxHeading" class = "subLabel">Tax</h2>
    </div>
     <div class = "col-2 text-left">
         <h3 id = "taxValue" class = "accountValue"></h3>
    </div></div>

      <div class = "row">
     <div class = "col-2 text-left">
      <h2 id = "otherIncomeHeading" class = "subLabel">Other income</h2>
    </div>
     <div class = "col-2 text-left">
         <h3 id = "otherIncomeValue" class = "accountValue"></h3></div>
             <div class = "col-2 text-left">
      <h2 id = "otherExpensesHeading" class = "subLabel">Other expense</h2>
    </div>
     <div class = "col-2 text-left">
         <h3 id = "otherExpensesValue" class = "accountValue"></h3>
    </div></div>

  <div class = "row">
     <div class = "col-2 text-left">
      <h2 id = "totalIncomeHeading" class = "total">Total</h2>
    </div>
     <div class = "col-4 text-left">
         <h3 id = "totalIncome" class = "accountValue"></h3>
    </div>

  <div class = "col-2 text-left">
         <h3 id = "totalExpenses" class = "accountValue"></h3>
    </div>

      <div class = "col-2 text-left">
         <h3 id = "profitTotal" class = "accountValue"></h3>
    </div></div>


</div> <!-- performance -->
<div id = "reverseTransaction">
   <div class = "row justify-content-center">
    <div class = "col-12 text-center">
     <p id = "transactionStr"></p>
     <button id = "reverse" class = "btn btn-sm btn-info">Reverse</button>
  </div></div>
</div>

   <div class = "row justify-content-center">
    <div class = "col-12 text-center">
      <p id = "transactions"></p>
  </div></div>
  
    
  <div class = "row">
  <div class = "col- text-center">
    <h1 id = "toggle" class = "text-center">Chart of Accounts</h1>
    </div></div>

  <div id = "coa"></div>
<div id = "chart_div"></div>
 
 
<!--
  <div id = "statements">


   <div class = "row text-left">
 <div class = "col-4 text-left">
      <h2 class = "stmtHeading">Assets</h2>
    </div>
     <div class = "col-4 text-left">
    <h2 class = "stmtHeading">Liabilities</h2>
    </div> 
     <div class = "col-4 text-left">
    <h2 class = "stmtHeading">Value</h2>
    </div> 
  </div>

      <div class = "row">
 <div class = "col-2 text-left">
      <h3 id = "cashHeading" class = "subLabel">Cash</h3>
    </div>
     <div class = "col-2 text-left">
      <p id = "cashValue" class = accountValue></p>
    </div> 
 <div class = "col-2 text-left">
      <h3 id = "loansHeading" class = "subLabel">Loans</h3>
    </div>
     <div class = "col-4 text-left">
      <p id = "loansValue" class = accountValue></p>
    </div> </div>


  <div class = "row">
     <div class = "col-2 text-left">
      <h2 id = "landHeading" class = "subLabel">Land</h2>
    </div>
     <div class = "col-2 text-left">
         <h3 id = "landValue" class = "accountValue"></h3>
    </div></div>

      <div class = "row">
     <div class = "col-2 text-left">
      <h2 id = "buildingHeading" class = "subLabel">Buildings</h2>
    </div>
     <div class = "col-2 text-left">
         <h3 id = "buildingsValue" class = "accountValue"></h3>
    </div></div>

  <div class = "row">
     <div class = "col-2 text-left">
      <h2 id = "totalHeading" class = "total">Total</h2>
    </div>
     <div class = "col-4 text-left">
         <h3 id = "totalAssets" class = "accountValue"></h3>
    </div>

  <div class = "col-2 text-left">
         <h3 id = "totalLiabilities" class = "accountValue"></h3>
    </div>

      <div class = "col-2 text-left">
         <h3 id = "equityTotal" class = "accountValue"></h3>
    </div>
  </div>


</div> 
-->
</div> <!-- container -->
  </body>
</html>

<script type="text/javascript">
     $(document).ready(function(){
        $('body').show();
        $('#topLine').show(); 
        $('#menu').show();
        $('#reverseTransaction').hide();
        $('#who').hide();
        $('#toggle').hide();

//populate the data lists

$(document).ready(function() {
    // Example: Fetching data from a server-side script
    $.ajax({
        url: 'getBank.php', // Replace with your actual URL
        method: 'GET',
        dataType: 'json', // Expect JSON data from the server
        success: function(data) {
            var datalist = $('#studentList');
            datalist.empty(); // Clear existing options
            console.log("Student list");
console.log("data",data);
            // Append new options based on the received data
            $.each(data, function(index, value) {
                datalist.append('<option value="' + value + '">');
        //         console.log(index,value);
            }); // function each
        }, // success
        error: function(xhr, status, error) {
            console.error("Error fetching student data:", error);
        } // error
    }); // ajax

 

 
});
})
</script>

<script type="text/javascript">
  
  function formatCurrency(number)

  {
 let dollars = Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'USD',
      minimumFractionDigits: 0,
      maximumfractionDigits: 0,
    maximumSignificantDigits: 12,
});



// console.log("$s ",dollars.format(number));

if (Math.abs(number) > 0)
  {  return dollars.format(number);}
     else {return '-' ;}
  }
</script>

<script type="text/javascript">
     $(document).ready(function(){
formatter = new Intl.NumberFormat('en-US', {
  style: 'currency',
  currency: 'USD',


  trailingZeroDisplay: 'stripIfInteger', // This is probably what most people
                                          // want. It will only stop printing
                                          // the fraction when the input
                                          // amount is a round number (int)
                                          // already. If that's not what you
                                          // need, have a look at the options
                                          // below.
  //minimumFractionDigits: 0, // This suffices for whole numbers, but will
                              // print 2500.10 as $2,500.1
  //maximumFractionDigits: 0, // Causes 2500.99 to be printed as $2,501
});

     $('#menu').hide();
     $('#dataEntry').hide();
     $('#student').focus();
     $('#showStatements').hide();
     $('#showTransactions').hide();
     $('#statements').hide();
     $('#transactions').hide();
     $('#performance').hide();
  

    payFlag = false;
    receiveFlag = false;

  

  })
  </script>



  <script>

    function analysis(studentID)
    {

let stats = [];
      $.ajax({
  url: "analysis.php",
  type: "POST",
  data:{studentID:studentID},
  dataType:'text',
    success : function(data) {   
    //alert(message + " to " + recipient);

      stats = JSON.parse(data);
      console.log(stats);
      
let csh = formatCurrency(stats.cash);
$('#cash').text(csh);

let assts = formatCurrency(stats.assets);
$('#assets').text(assts);

let liabilities = formatCurrency(stats.liabilities);
$('#liabilities').text(liabilities);

equity = stats.assets - stats.liabilities;

 let eqty= formatCurrency(equity);
$('#equity').text(eqty);

let income= formatCurrency(stats.income);
$('#income').text(income);

let expenses = formatCurrency(stats.expenses);
$('#expenses').text(expenses);

let profit = stats.income - stats.expenses;

let prof = formatCurrency(profit);
$('#profit').text(prof);

let worth =  parseInt(equity) ;
// alert(worth);
let wrth = formatCurrency(worth);
$('#value').text(wrth);


return stats;
    }, // success
    error : function(request,error)
    {
        alert("Stats errort: " +JSON.stringify(request));
    } // error
});  // ajax

    }
  </script>


<script type="text/javascript">
  
    $(document).ready(function(){
    $('[id^=Btn_]').on('click', function()

{
  clicked = this.id;
$('#dataEntry').show();
$('#transactions').hide();
$('#statements').hide();
$('#performance').hide();
action = clicked.substring(4);
// alert(this.id + ' ' + action);
$('#note').val('');
$('#amount').val('');

  if (action == 'pay')
  {payFlag = true;
  receiveFlag = false;
   $('#Btn_pay').css({"background-color":"lightgreen" , "color":"blue"});
      $('#Btn_receive').css({"background-color":"lightgrey" , "color":"black"});

}

 if (action == 'receive')
  {payFlag = false;
  receiveFlag = true;
   $('#Btn_receive').css({"background-color":"lightgreen" , "color":"blue"});
      $('#Btn_pay').css({"background-color":"lightgrey" , "color":"black"});

}

 
$('#accounts').empty();
$.ajax({
  url: 'loadCOABank.php',
  type: "POST",
  data:{action:action},
  dataType:'text',

})  // parameters
.done(function (response) { 

 coa = JSON.parse(response);

 console.log(coa);
var l = coa.length;
$('#accounts').append($('<option></option>').text('Choose the account'));
for (var i = 0 ; i < l ; i++)
{
    $('#accounts').append($('<option></option>').text(coa[i]["name"]  + '*' + coa[i]["code"]));

console.log(i,coa[i]);
}

})  //done
.fail(function (jqXHR, textStatus, errorThrown) { 
alert("Failure coa " + jqXHR + ' ' + textStatus + ' error ' + errorThrown) ;

})  // fail



  $('#dataEntry').show();


 $('#note').focus();
})
  })
</script>



<script type="text/javascript">
 $(document).ready(function() {
  $('#submit').on('click', function() {
      $('#toggle').show();
    studentID = $('#student').val();
    $('#studentID').text(studentID);
  // alert(studentID);

    $('#gameID').load('getGameID.php',{studentID:studentID},
    function(responseTxt, statusTxt, xhr) {
       if(statusTxt == "success"){
  // This code will execute only after the content from 'yourUrl.html'
  // has been successfully loaded and inserted into '#yourElement'.
  // Place the "something else" code here.
  let x = $('#gameID').text();
  console.log('Content loaded, now doing something else...',x);

    gameID = x;
  // Make an AJAX call to the server-side script
  $.getJSON('getOtherPerson.php',{gameID:gameID}, function(data) {
    // 'data' is the JSON array returned from the server
    console.log("People",data);
    // Clear any existing options, keeping the default one if needed
    $('#players').empty().append('<option value="">-- Select a player --</option>');
    let l = data.length;
    console.log("Length",l);

  

for (var i = 0 ; i < l ; i++)
{
    $('#players').append($('<option></option>').text(data[i]));

console.log(i,data[i]);
}
    // Loop through the JSON data and append options to the dropdown
 /*
    $.each(data, function(index, item) {
      $('#players').append($('<option>', {
        value: item.id, // The value for the option
        text: item.name  // The display text for the option

      }));

    });
    */
  })
  .fail(function(jqXHR, textStatus, errorThrown) {
    // Handle any errors here
    console.error("Error fetching player data: " + textStatus, errorThrown);
    alert("Failed to load options. Please try again.");
  });
  
  
}
  
 if(statusTxt == "error"){
        // Code to execute if the load fails
        console.log("Error loading content: " + xhr.status + ": " + xhr.statusText);
    }
  
  
});
    
    
    
    
    gameID = $('#gameID').text();
    console.log(studentID,gameID);
    $('#who').text(studentID);

 $('#person').load('getRegisteredStudent.php', {studentID:studentID});
   person =  $('#person').text();
    console.log("Person ",person);
    // Check student registration
    
    $('#who').text(studentID);
$('#loginForm').hide();
$('#showStatements').show();
$('#showTransactions').show();
$('#menu').show();
$('#reports').show();


    
    });
})


</script>

<script>

$(document).ready(function(){

// load sites into dropdown
let action = 'all' ;
$.ajax({
  url: 'loadCOA.php',
  type: "POST",
  data:{action:action},
  dataType:'text',

})  // parameters
.done(function (response) { 

 coa = JSON.parse(response);

 console.log(coa);
var l = coa.length;

for (var i = 0 ; i < l ; i++)
{
    $('#accounts').append($('<option></option>').text(coa[i]["name"]  + '*' + coa[i]["code"]));

console.log(i,coa[i]);
}

})  //done
.fail(function (jqXHR, textStatus, errorThrown) { 
alert("Failure coa " + jqXHR + ' ' + textStatus + ' error ' + errorThrown) ;

})  // fail

})
</script>

<script type="text/javascript">
  function writeTransaction(studentID,comment,amount,accountCode,linked)

  {

      $.ajax({
  url: "writeToJournal.php",
  type: "POST",
  data:{studentID:studentID,
        comment:comment,
        amount:amount,
        accountCode:accountCode,
        linked:linked
      },
  dataType:'text',
    success : function(data) {   
  //  alert(data);

   let n = data;
  // alert(data);

 return  data;

    }, // success
    error : function(request,error)
    {
        alert("Request: " +JSON.stringify(request));
    } // error
});  // ajax

 
  }
</script>

<script>

  function checkDataEntry(comment,amount,accountCode,otherPerson)

  {

    $('#error').empty();
    allCorrect = false;
    errorComment = "";
    errorAmount = "";
    errorAccount = "";
    errorPerson = "";
    message = "";
    
    if (comment.length < 2)
      {
        errorComment = "You need a note. ";
      }

       if (otherPerson.length < 2 | otherPerson == '-- Select a player --')
      {
        errorPerson = "You need to choose a player. ";
      }

  if (amount == 0)
  {
    errorAmount = "The amount cannot be 0. ";
  }

  if (amount > 1000000)
    {errorAmount = "Too much money! "; }
const isNumeric = (string) => Number.isFinite(+string);  // +string coerces to number
  if (!isNumeric(accountCode))
  {
    errorAccount = "You need an account number";
  }

  message = errorComment  + errorAmount  + errorAccount + errorPerson;

  return message;
}
</script>

<script type="text/javascript">
  
    $(document).ready(function(){
    $('#submitAccount').on('click', function()
{
let linked= 0 ; // money to linked account
console.log("flags",receiveFlag,payFlag);
let comment =  $('#note').val();
  studentID = $('#who').text();
  amount = $('#amount').val();
  acc = $("#accounts :selected").text();
let a = acc.split("*");
let accountName = a[0]; 
let accountCode = a[1];
let otherParty = $("#players :selected").text();
console.log("pay",payFlag,"get",receiveFlag);
comment += ' ' + otherParty
$('#otherParty').text(otherParty);
let message = checkDataEntry(comment,amount,accountCode,otherParty);
console.log("message = ",message);
if (message.length > 0)
  {$('#error').html(message);}

else 
{
  linkedAmount = amount ; // linked account
  if (payFlag)  
    { linkedAmount = -amount;}          
  


    if (receiveFlag)
    { linkedAmount = amount;
// startup loans to players
 // if (accountCode.substring(0,1) == 1)  {linked = amount;}
} // if receive 
} //else
console.log(studentID,comment,amount,accountCode,linkedAmount);

let transactionStr = formatCurrency(amount) + ' ' +
                      acc + ' ' +
                      comment + ' ' + otherParty;
  
  if (message.length == 0)
{
  $('#transactions').prepend(transactionStr + "<br>");
$('#note').val('');
$('#amount').val('');
$('#dataEntry').hide();
$('#transactions').show();
$('#players').val('');
alert("Updating journal " + transactionStr);
let updated = writeTransaction(studentID,comment,amount,accountCode,linkedAmount);
// let data = analysis(studentID);

//  $('#Btn_pay').css({"background-color":"lightgreen" , "color":"blue"});
  $('[id^=Btn]').css({"background-color":"lightgrey" , "color":"black"});

}

  })
  })

</script>
<!--
<script type="text/javascript">
  
    $(document).ready(function(){
    $('#showTransactions').on('click', function()
{

     $.ajax({
  url: "writeToJournal.php",
  type: "POST",
  data:{studentID:studentID,
        comment:comment,
        amount:amount,
        accountCode:accountCode,
        linked:linked
      },
  dataType:'text',
    success : function(data) {   
  //  alert(data);

   let n = data;
  // alert(data);

 return  data;

    }, // success
    error : function(request,error)
    {
        alert("Request: " +JSON.stringify(request));
    } // error
});  // ajax
})
  })

</script>

-->
<script type="text/javascript">
  
    $(document).ready(function(){
    $('#showProfitLoss').on('click', function()
{

$('#performance').show();
$('#transactions').hide();
$('#statements').hide();$("#dataEntry").hide();


     $.ajax({
  url: "analysis.php",
  type: "POST",
  data:{studentID:studentID,
  dataType:'json',     
      },
 
    success : function(data) {   
  //  alert(data);

 
 // console.log(data);

let results = JSON.parse(data);
console.log(results[0]);
let income = results[0].income;
let receive_rent = results[0].receive_rent;
let pass_go = results[0].pass_go;
let other_income = results[0].other_income;

$('#incomeValue').text(formatCurrency(income));
$('#receiveRentValue').text(formatCurrency(receive_rent));
$('#passGoValue').text(formatCurrency(pass_go));
$('#otherIncomeValue').text(formatCurrency(other_income));
$('#totalIncome').text(formatCurrency(income));

$('#income').text(formatCurrency(income));

let expenses = results[0].expenses;
let pay_rent = results[0].pay_rent;
let tax = results[0].tax;;
let other_expenses = results[0].other_expenses;


$('#payRentValue').text(formatCurrency(pay_rent));
$('#taxValue').text(formatCurrency(tax));
$('#otherExpensesValue').text(formatCurrency(other_expenses));
$('#totalExpenses').text(formatCurrency(expenses));

let profit = income - expenses;

$('#profitTotal').text(formatCurrency(profit));

$('#income').text(formatCurrency(income));
$('#expenses').text(formatCurrency(expenses));
$('#profit').text(formatCurrency(profit));


    }, // success
    error : function(request,error)
    {
        alert("Request: " +JSON.stringify(request));
    } // error
});  // ajax
})
  })

</script>


<!-- statements - financial position -->

<script type="text/javascript">
  
    $(document).ready(function(){
    $('#showStatements').on('click', function()
{

$('#statements').show();
$('#transactions').hide();
$('#performance').hide();
$("#dataEntry").hide();


     $.ajax({
  url: "analysis.php",
  type: "POST",
  data:{studentID:studentID,
  dataType:'json',     
      },
 
    success : function(data) {   
  //  alert(data);

 
// console.log(data);

let results = JSON.parse(data);
console.log(results[0]);
let assets = results[0].assets;
 cash = results[0].cash;
let land = results[0].land;
let buildings = results[0].buildings;

$('#cashValue').text(formatCurrency(cash));
$('#landValue').text(formatCurrency(land));
$('#buildingsValue').text(formatCurrency(buildings));
$('#totalAssets').text(formatCurrency(assets));

$('#assets').text(formatCurrency(assets));

let loans = results[0].loans;
let liabilities = results[0].liabilities
$('#loansValue').text(formatCurrency(loans));
$('#totalLiabilities').text(formatCurrency(liabilities));

$('#liabilities').text(formatCurrency(assets));

let equity = assets - liabilities;
$('#equity').text(formatCurrency(equity));
$('#equityTotal').text(formatCurrency(equity));
 cash = results[0].cash;
let income = results[0].income;
let expenses = results[0].expenses;
let profit = income - expenses;
$('#income').text(formatCurrency(income));
$('#expenses').text(formatCurrency(expenses));
$('#profit').text(formatCurrency(profit));
$('#cash').text(formatCurrency(cash));

    }, // success
    error : function(request,error)
    {
        alert("Request: " +JSON.stringify(request));
    } // error
});  // ajax
})
  })

</script>


<script>

  function convertJSONToTable(jsonData) {
  // Body of the function
    let headers = Object.keys(jsonData[0]);
    table = '<table><thead><tr>'; 
headers.forEach(header => table += `<th>${header}</th>`);
table += '</tr></thead><tbody>';

jsonData.forEach(row => {
  table += '<tr>';
  headers.forEach(header => table += `<td>${row[header]}</td>`);
  table += '</tr>';
});
table += '</tbody></table>';
$('table').attr('id', 'transTable'); 

  document.getElementById('transactions').innerHTML = table ;
}

</script>



<script type="text/javascript">
  
    $(document).ready(function(){
    $('#showTransactions').on('click', function()

{
  
  $('#statements').hide();
$('#transactions').show();
$('#performance').hide();
$("#dataEntry").hide();
$('#reverseTransaction').hide();

 
// studentID = $('#studentID').text();

$.ajax({
  url: 'transactionReport.php',
  type: "POST",
  data:{studentID:studentID},
  dataType:'text',

})  // parameters
.done(function (data) { 
console.log("Transactions");
console.log(data);
let json  = JSON.parse(data);
convertJSONToTable(json);
console.log(json);

})  //done
.fail(function (jqXHR, textStatus, errorThrown) { 
alert("Failure transaction log " + jqXHR + ' ' + textStatus + ' error ' + errorThrown) ;

})  // fail

})
})

</script>

<script>
function formatDiv(value,$myDiv) {
 // var $myDiv = $('#money'); // Cache the jQuery object for efficiency
 
let csh = formatCurrency(value);
$myDiv.text(csh);
  // First, remove any existing styling classes to prevent conflicts
  $myDiv.removeClass('positive negative zero');

  if (value > 0) {
    $myDiv.addClass('positive');
  } else if (value < 0) {
    $myDiv.addClass('negative');
  } else {
    $myDiv.addClass('zero');
  }
}

</script>


<script>
$(document).ready(function() {
    studentID = $('#who').text();
    
    setInterval(function() {
    //    console.log("student who", studentID);
        $('#coa').load('showCOABank.php', {studentID: studentID});   // table of accounts
        $('#money').load('showCashBank.php', {studentID: studentID}, function() {
            // Get the text content of the loaded div
            var value = parseInt($(this).text(), 10);
            
            // Check if the parsed value is a number
            if (!isNaN(value)) {
                // The next section shows how to apply styles
                formatDiv(value,$('#money'));
            }
        }); // Closing parenthesis for .load()
        
        
         $('#assets').load('showAssetsBank.php', {studentID: studentID}, function() {
            // Get the text content of the loaded div
            var value = parseInt($(this).text(), 10);
            
            // Check if the parsed value is a number
            if (!isNaN(value)) {
                // The next section shows how to apply styles
                formatDiv(value,$('#assets'));
            }
        }); // Closing parenthesis for .load()
        
       $('#income').load('showIncomeBank.php', {studentID: studentID}, function() {
            // Get the text content of the loaded div
            var value = parseInt($(this).text(), 10);
            
            // Check if the parsed value is a number
            if (!isNaN(value)) {
                // The next section shows how to apply styles
                formatDiv(value,$('#income'));
            }
        }); // Closing parenthesis for .load()  
        
        $('#expenses').load('showExpensesBank.php', {studentID: studentID}, function() {
            // Get the text content of the loaded div
            var value = parseInt($(this).text(), 10);
            
            // Check if the parsed value is a number
            if (!isNaN(value)) {
                // The next section shows how to apply styles
                formatDiv(value,$('#expenses'));
            }
        }); // Closing parenthesis for .load()  
        
       $('#liabilities').load('showLiabilitiesBank.php', {studentID: studentID}, function() {
            // Get the text content of the loaded div
            var value = parseInt($(this).text(), 10);
            
            // Check if the parsed value is a number
            if (!isNaN(value)) {
                // The next section shows how to apply styles
                formatDiv(value,$('#liabilities'));
            }
        }); // Closing parenthesis for .load()    
        
        
        
    }, 20000); // Closing parenthesis for setInterval()
}); // Closing parenthesis for $(document).ready()
</script>


<script>
 $(document).ready(function() {   
  $(document).on('click', 'table td', function() {
  var cellText = $(this).text();
 // alert('You clicked on a cell with the value: ' + cellText);
  
  $('#reverseTransaction').show();
   var $row = $(this).closest('tr');
   
    $("#transactionStr").text('');
    $('#reverse').hide();
    // Find the closest parent <tr> to the clicked <td>
    var $row = $(this).closest('tr');
    //  var rowIndex = $row[0].rowIndex;
  
 
    // Select all the <td> elements within that row and change their CSS
   // $row.find('td').css('background-color', '#FFFFE0'); // A light yello
    
    // Find the first <td> within that row
    var $firstCell = $row.find('td').first(); 
    
    // Get the text content of the first cell
    var firstCellText = $firstCell.text(); // this is the id for the transaction being editied
    
    // 2. Remove the 'highlight' class from all other rows in the table
    //    .siblings() finds all sibling <tr> elements of the current row
    $row.siblings().find('td').removeClass('highlight');
    
    // 3. Add the 'highlight' class to all cells in the newly clicked row
    $row.find('td').addClass('highlight');

    console.log(firstCellText,);
$('#transID').text(firstCellText);  // put in hidden p
// Assuming '$row' is your selected jQuery object for the table row.
let rowValues = [];
 let rowValueStr = "";
$row.find('td').each(function() {
    let x = $(this).text();
  rowValues.push(x);
 // rowValueStr += (x + ' ') ;
//  console.log("X",x);
});

console.log(rowValues);
console.log("str",rowValueStr);
// id  amount linkedaccount notes
rowValueStr = rowValues[0] + '*' + rowValues[2] + '*' +  rowValues[3] + '*' +  rowValues[6]  ;

    $('#transactionStr').text(rowValueStr);
    $('#reverse').show();


  
});
});

</script>


<script>
    $(document).ready(function(){
    $('#reverse').on('click', function()
{
alert(this.id); 
let id = $('#transID').text();
id = parseInt(id);

   
      $.ajax({
  url: "reverseTransaction.php",
  type: "POST",
  data:{id:id},
  dataType:'text',
    success : function(data) {   
    alert(data);
    }, // success
    error : function(request,error)
    {
        alert("Request: " +JSON.stringify(request));
    } // error
});  // ajax

});
});

</script>

<script>
  
    // Load the Visualization API and the piechart package.
  google.charts.load("current", {
        packages : [ "corechart","table" ]
    });
      
studentID = $('#who').text();
// Function to fetch data and redraw the chart
function drawChart() {
    // Make an AJAX call to your PHP/Python script
    $.ajax({
        url: 'runningTotals.php', // Replace with your server-side script
        dataType: 'json',
        type: 'post',
        data: {studentID:studentID},
        success: function(jsonData) {
            // Create a new data table from the JSON data
            var data = new google.visualization.DataTable(jsonData);

            // Create and draw the chart
            var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
            
            var options = {
    title: 'Your Chart Title Here'
};
            chart.draw(data, options); // 'options' would be your chart's configuration
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error fetching data:', textStatus, errorThrown);
        }
    });
}

// Draw the chart for the first time
google.charts.setOnLoadCallback(drawChart);

// Set the interval to redraw the chart every 30 seconds
setInterval(drawChart, 30000);


</script>






