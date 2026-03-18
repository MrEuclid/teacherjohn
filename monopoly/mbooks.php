
<!DOCTYPE html>
<html lang="en">
  <head>
 

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../bootstrap-5.0.2-dist/css/bootstrap.min.css">
  <script src="../javaScript/jQuery/jquery-3.3.1.min.js"></script>
  <script src="../bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    


    <meta charset="utf-8">
    
    <meta name="description" content="">
    <meta name="keywords" content="">
<title>MBooks</title>

<style type="text/css">
  body {
    display: none;
}

h1 {display: inline-block; font-size:2em; font-weight:bolder; color:green; text-align:center;}

button {margin:1.5em;}

#topline {text-align: center;}
input {
    
    background-color: lightyellow; 
    text-align: center;
    height:2em;
    width: 6em;
    color:black;
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

button {background-color: lightblue; font-size: 1.2em; font-weight: bolder; text-align: center;}

label {inset-block: font-weight:bolder; color:black;}

p {display:inline-block; font-size: 1em;margin:right:1em}

#submit {background-color: grey; color: black;}

#submitAccount {background-color: green; color: black; width: 4em;}

#error {color:red;}

.head {font-size: 1em; font-weight: bold;}

#transactions {color:black; font-size: 1em ;}

body {background-color:white;}
  </style>

  </head>
  <body>
      <div class  = "container-fluid">
<a href = "makeGrid.php" target = "_blank" >Leader board</a>

  <div id = "topLine">
    <div class = "row text-center">
  <div class = "col- ">
<p id = "who"></p>
<label class = "head">Assets</label>
<p id = "assets"></p>
<label class = "head">Liabilities</label>
<p id = "liabilities"></p>
<label class = "head">Capital</label>
<p id = "equity"></p>
<label class = "head">Income</label>
<p id = "income"></p>
<label class = "head">Expenses</label>
<p id = "expenses"></p>
<label class = "head">Profit</label>
<p id = "profit"></p>
</div></div>
<!--
<label class = "head">Worth</label>
<p id = "value"></p> -->
</div> <!-- topLine -->


<div id = "loginForm">
<div class = "row">
  <div class = "col- text-center">
   <h3 id = "header">MBooks Login</h3>
</div></div>

<div class = "row text-center">
  <div class = "col- ">
  <img src = "images/accountsImage.jpeg">
</div></div>


<div class = "row">
  <div class = "col- text-center"><label>School ID</label>
 <br><input id = "student" type = "number" >
 <button type = "button" id = "sendID" >Send</button>
</div></div> 
</div> <!--  loginform -->



 

      <div id = "menu">

     <div class = "row text-center">
  <div class = "col- ">
   <h1> Monopoly Accounts</h1>
  </div></div>

  <div class = "row text-center">
   <div class = "col-12 text-center">
      <button id = "Btn_receive">Get money</button>
      <button id = "Btn_pay">Pay money</button>
     <button  id = "showTransactions">Transactions</button>
         <button  id = "showStatements">My Value</button>
           <button  id = "showProfitLoss">Profit / Loss</button>  
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
      <label>Amount</label><input id = "amount" type = "number" min="100" max = "15000">
    </div></div>

 <div class = "row justify-content-center">
    <div class = "col-4 "></div>
    <div class = "col-8 text-left">
             <select id="accounts" >
    <option>Choose the account</option>
</select>
</div></div>

 <div class = "row justify-content-center">
  <div class = "col-5 "></div>
    <div class = "col-7 text-left">

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




   <div class = "row justify-content-center">
    <div class = "col-12 text-center">
      <p id = "transactions"></p>
  </div></div>
 
 

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


</div> <!-- statementss -->

</div> <!-- container -->
  </body>
</html>

<script type="text/javascript">
     $(document).ready(function(){
        $('body').show();
$('#menu').show();


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
  url: 'loadCOA.php',
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
  
    $(document).ready(function(){
    $('#sendID').on('click', function()

{
  target = this.id;

  studentID = $('#student').val();
 // alert(schoolID);

      $.ajax({
  url: "getStudent.php",
  type: "POST",
  data:{studentID:studentID},
  dataType:'text',
    success : function(data) {   
    //alert(message + " to " + recipient);

      person = JSON.parse(data);
      console.log(person);
if (person.n == 0)
  {
    alert("Incorrect ID");
    $('#student').val("");
    $('#student').focus();

}
else
{
student = person.Family_name + " " + person.First_name;
$('#who').text(studentID);
$('#loginForm').hide();
$('#showStatements').show();
$('#showTransactions').show();
$('#menu').show();
$('#reports').show();


//let data = analysis(studentID);

}

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

  function checkDataEntry(comment,amount,accountCode)

  {

    $('#error').empty();
    allCorrect = false;
    errorComment = "";
    errorAmount = "";
    errorAccount = "";
    message = "";
    
    if (comment.length < 2)
      {
        errorComment = "You need a note. ";
      }

  if (amount == 0)
  {
    errorAmount = "The amount cannot be 0. ";
  }

  if (amount > 30000)
    {errorAmount = "Too much money!"; }
const isNumeric = (string) => Number.isFinite(+string);  // +string coerces to number
  if (!isNumeric(accountCode))
  {
    errorAccount = "You need an account number";
  }

  message = errorComment  + errorAmount  + errorAccount;

  return message;
}
</script>

<script type="text/javascript">
  
    $(document).ready(function(){
    $('#submitAccount').on('click', function()
{
let linked= 0 ; // money to linked account
console.log("flags",receiveFlag,payFlag);
let comment = $('#note').val();
  studentID = $('#who').text();
  amount = $('#amount').val();
  acc = $("#accounts :selected").text();
let a = acc.split("*");
let accountName = a[0]; 
let accountCode = a[1];

let message = checkDataEntry(comment,amount,accountCode);
console.log("message = ",message);
if (message.length > 0)
  {$('#error').html(message);}

else 
{
  linked = amount ; // linked account
  if (payFlag == true)
    { amount = -amount;}

    if (receiveFlag == true)
    { amount = amount;
// selling an asset then linked = -qmount
  if (accountCode.substring(0,1) == 1)  {linked = -amount;}
} // if receive 
} //else
console.log(studentID,comment,amount,accountCode,linked);

let transactionStr = formatCurrency(amount) + ' ' +
                      acc + ' ' +
                      comment ;
  
  if (message.length == 0)
{
  $('#transactions').prepend(transactionStr + "<br>");
$('#note').val('');
$('#amount').val('');
$('#dataEntry').hide();
$('#transactions').show();
alert("Updating journal " + transactionStr);
let updated = writeTransaction(studentID,comment,amount,accountCode,linked);
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
let cash = results[0].cash;
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

let income = results[0].income;
let expenses = results[0].expenses;
let profit = income - expenses;
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


<script>

  function convertJSONToTable(jsonData) {
  // Body of the function
    let headers = Object.keys(jsonData[0]);
    let table = '<table><thead><tr>';
headers.forEach(header => table += `<th>${header}</th>`);
table += '</tr></thead><tbody>';

jsonData.forEach(row => {
  table += '<tr>';
  headers.forEach(header => table += `<td>${row[header]}</td>`);
  table += '</tr>';
});
table += '</tbody></table>';


  document.getElementById('transactions').innerHTML = table + "<br>Copy with ctrl + A then ctrl + C<br>";
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



