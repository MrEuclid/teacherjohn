
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
<title>Registration PIO Bank</title>

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
   <h1>Welcome to the PIO Bank</h1>
</div> <!-- heading -->
</div></div>


<div class = "row">
  <div class = "col- text-center">
<a href = "../index.php"><button id = "home">Home</button></a>
 <!-- 
<a href = "registerTeamsMonopoly.php">

<button id = "register">Register</button>
</a>
-->
<a href = "pioBankPortal.php">
<button id = "login">Log in</button>
</a>
  </div></div>

        <div class = "row">
        <div class = "col- text-center">
   <h3>Play Monopoly</h3>
        </div></div>

      <div class = "row">
        <div class = "col- text-center">
    <img id = "picture" src = "monopoly.png" width="auto">
        </div></div>


        <div class = "row">
        <div class = "col- text-center">
   <h4>Buy, sell and get rich!</h4>
        </div></div>

        <div class = "row">
        <div class = "col- text-center">
    <a href = "https://docs.google.com/document/d/1AwhausShZI5RxlrmdeO_Gw8KECGGKT7Ywtf0EXnAiUQ/edit?usp=sharing">
      <button>Financial report - Google Drive</button></a>

    <a href = "reportDocument.odt"><button>Financial report - LibreOffice</button></a>
     <a href = "properties.ods"><button>Real Estate</button></a>
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
