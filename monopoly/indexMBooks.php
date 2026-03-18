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
<title>REgistration PIO Bank</title>

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


#home,#cancel {display: inline-block; background-color: yellow; color: black;font-size:1em ; font-weight:bolder; width:5em;}

#picture {margin: 2em;}

  </style>

  </head>
  <body>
      <div class  = "container-fluid">
      
      <div class = "row">
        <div class = "col- text-center">
        <div id = "heading">
   <h1>Welcome to the M_Books</h1>
</div> <!-- heading -->
</div></div>


<div class = "row">
  <div class = "col- text-center">
<a href = "../index.php"><button id = "home">Home</button></a>

<a href = "mbooks.php">
<button id = "login">Log in</button>
</a>
  </div></div>

        <div class = "row">
        <div class = "col- text-center">
   <h3>Use MBooks</h3>
        </div></div>

      <div class = "row">
        <div class = "col- text-center">
    <img id = "picture" src = "monopoly.png" width="auto">
        </div></div>


        <div class = "row">
        <div class = "col- text-center">
   <h4></h4>
        </div></div>

        <div class = "row">
        <div class = "col- text-center">
  
  </div></div>
</div>
</body>
</html>



<script type="text/javascript">
  
    $(document).ready(function(){
    $('#register').on('click', function()

{

   
   //    $('#output').load("registerTeamsMonopoly.php");

  })
  })


</script>

<script type="text/javascript">
  
    $(document).ready(function(){
    $('#login').on('click', function()

{

 // $('#output').load("pioBankPortal.php");

  })
  })


</script>
