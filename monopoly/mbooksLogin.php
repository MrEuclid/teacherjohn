
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

h1 {display: inline-block; font-size:2em; font-weight:bolder; color:green; text-align:center;}

button {margin:1.5em;}

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
    width: 12em;
  
}

#assets,#liabilities ,#equity, #income, #expenses, #profit,#value
  {
    font-weight: bolder;
    color:green;
    font-size: 1em;

  }



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
  <div id = "topLine">
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
<label class = "head">Worth</label>
<p id = "value"></p>
</div> <!-- topLine -->

<div id = "reportMenu"></div>
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
      <button id = "reports">Reports</button>
      <button id = "quit">Quit</button>
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
      <label>Amount</label><input id = "amount" type = "number" min="100">
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

 <div class = "row justify-content-center">
    <div class = "col-12 text-center">
      <p id = "transactions"></p>
  </div></div>


</div> <!-- data entry -->

</div> <!-- container -->
  </body>
</html>



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



console.log("$s ",dollars.format(number));

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

let equity= formatCurrency(stats.equity);
$('#equity').text(equity);

let income= formatCurrency(stats.income);
$('#income').text(income);

let expenses = formatCurrency(stats.expenses);
$('#expenses').text(expenses);

let profit = stats.income - stats.expenses;

let prof = formatCurrency(profit);
$('#profit').text(prof);

let worth = parseInt(profit) + parseInt(stats.equity) ;
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
    $('#reports').on('click', function()

{

  $("#loginForm").hide();
  $("#menu").hide();
  $('#dataEntry').hide();
  let url = "mBooksReportIndex.php" + "?studentID=" + studentID;
  $('#reportMenu').load(url);

})
})

</script>
<script type="text/javascript">
  
    $(document).ready(function(){
    $('[id^=Btn_]').on('click', function()

{
  clicked = this.id;
$('#dataEntry').show();
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


$('#menu').show();

let data = analysis(studentID);

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
//$('#transactions').show();
alert("Updating journal " + transactionStr);
let updated = writeTransaction(studentID,comment,amount,accountCode,linked);
let data = analysis(studentID);
console.log(data);
//  $('#Btn_pay').css({"background-color":"lightgreen" , "color":"blue"});
  $('[id^=Btn]').css({"background-color":"lightgrey" , "color":"black"});

}

  })
  })

</script>



