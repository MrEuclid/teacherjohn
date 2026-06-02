<!DOCTYPE html>
<html lang="en">

  <head>
 
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../javaScript/bootStrap/bootstrap-3.3.7-dist/css/bootstrap.min.css">
  <script src="../javaScript/jQuery/jquery-3.3.1.min.js"></script>
  <script src="../javaScript/bootStrap/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>


  <script src="../javaScript/plotly/math.min.js"></script>
 <script src="../javaScript/plotly/plotly-latest.min.js"></script>

<link rel="stylesheet" href="css/phoneStyles.css">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>Phone game - v2</title>
<style>
    h1 {display:inline ; font-size:18pt ; color:blue ;}
</style>


  </head>
  <body>


<script type="text/javascript">

  
$(document).ready(function(){
alert('chart');
  var data = [
  {
    x:['a','b','c'] ,
    y:[2,7,3],
    type: 'bar'
  }

  ] ;

  Plotly.newPlot('myDiv',data) ;
})
</script>

  <div id = 'myDiv'></div>
</body>
</html>
