
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<!DOCTYPE html>


<head>
    <title>Page Title</title>
    <meta http-equiv="refresh" content="10">
    
    
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../bootstrap-5.0.2-dist/css/bootstrap.min.css">
  <script src="../javaScript/jQuery/jquery-3.3.1.min.js"></script>
  <script src="../bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    

</head>

<body>
  <div class = "row text-center">
   <div class = "col-12 text-center">
<h1>Wealth Leader Board</h1>
</div></div>

  <div class = "row text-center">
   <div class = "col-12 text-center">
<div id = "grid"></div>
</div></div>

</body>


<script type="text/javascript">
  
    $(document).ready(function(){

$('#grid).load('analysis.php');



