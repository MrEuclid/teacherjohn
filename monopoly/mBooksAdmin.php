<!DOCTYPE html>
<html lang="en">
  <head>
 

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../bootstrap-5.0.2-dist/css/bootstrap.min.css">
  <script src="../javaScript/jQuery/jquery-3.3.1.min.js"></script>
  <script src="../bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    

    <meta charset="utf-8">
    
    <meta name="description" content="">
    <meta name="keywords" content="">
<title>MBooks Admin</title>
<style>
.

</style>


</head>

<body>
 
<div class  = "container-fluid">

<div class = "row">
<div class = "col-2" >
<button id = "summary" class="btn btn-lg btn-info btn-block">Summary</button></div>

<div class = "col-2" >
<button  id = "transactionList" class="btn btn-lg btn-warning btn-block">Transactions</button></div>

<div class = "col-2" >
<button id = "cashflow" class="btn btn-lg btn-primary btn-block">Cash</button></div>

<div class = "col-2" >
<button id = "realEstate"  class="btn btn-lg btn-success btn-block">Real estate</button>
</div>

<div class = "col-2" >
<button id = "audit"  class="btn btn-lg btn-warning btn-block">Audit</button>
</div>

<div class = "col-2" >
<button  class="btn btn-lg btn-info btn-block">
<a href = "makeTeamListGoogle.php" target =  "_blank">Teams</button></a>
</div>
</button>
</div>

</div>

<div id = "now"></div>
<div class = "row">
  <div class = "col- text-center">
<div id = "grid"></div>
</div>
</div>

<div id = "now"></div>
<div class = "row">
  <div class = "col- text-center">
<div id = "transactions"></div>
</div>
</div>

      </div>

</body>
</html>




<script>
$(document).ready(function() {

 $('#grid').load('makeGridGoogle.php'); // Replace with your content source
$('#grid').show();
$('#transactions').hide();

 });
</script>

<script>
$(document).ready(function() {
     $('#summary').on('click', function()
{
 $('#grid').load('makeGridGoogle.php'); // Replace with your content source
$('#grid').show();
$('#transactions').hide();

  });
});
</script>

<script>
$(document).ready(function() {
      $('#transactionList').on('click', function()
{

$('#grid').hide();
$('#transactions').show();

$('#transactions').load('makeTransactionsGoogle.php'); // Replace with your content source

 });
});
</script>





