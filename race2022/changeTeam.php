<?php $team = $_GET['team']; 
	 $game = $_GET['game'];
echo $game  . "  " . $team ; 
?>

<OCTYPE html>
<html lang="en">
  <head>
 
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../bootstrap-5.0.2-dist/css/bootstrap.min.css">
  <script src="../javaScript/jQuery/jquery-3.3.1.min.js"></script>
  <script src="../bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="keywords" content="">

<title>changeTEam</title>

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




#submit, #home,#cancel {display: inline-block; background-color: green; color: yellow;font-size:1em ; font-weight:bolder; width:5em;}

#picture {margin: 2em;}

  </style>

  </head>
  <body>
      <div class  = "container-fluid">
      
      <div class = "row">
        <div class = "col- text-center">
        <div id = "heading">
          <a href = "../index.php"><button id = "home">Home</button></a>
   <h1>Make a new team name</h1>
</div> <!-- heading -->
</div></div>


<div id = "changeCredentials">
<!--
<form action = "changeData.php" method = "POST">
 -->

 <div class = "row">
  <div class = "col- text-center"><label><? echo $team; ?></label>
 <input name = "team" type = "text" value = <?php echo $team ; ?>  hidden>
</div>
</div> <!-- row -->

<div class = "row">
  <div class = "col- text-center"><label>New team name</label>
 <br><input id = "teamNew" type = "text" autocomplete="new-password" name="teamNew" value = ""></div>
</div> <!-- row -->

<div class = "row">
  <div class = "col- text-center"><label>New email</label>
 <br><input id = "email" type = "text" autocomplete="new-password" name="email" value = ""></div>
</div> <!-- row -->

<div class = "row">
  <div class = "col- text-center"><label>New Password</label>
    <br>
 <input id = "password" value = "" type = "text" autocomplete="new-password" name = "password"></div>
</div> <!-- row -->

<input name = "game" type = "text" value = <?echo $game ; ?> hidden>

<div class = "row text-center">
  <div class = "col- ">
 <button id = "submitBtn"  >Submit</button>
</div>
</div> <!-- row -->
<!-- </form> -->
</div> <!-- credentials -->
<div id = "output"></div>
</div>  <!-- container -->

</body>
</html>

<script type="text/javascript">


 $(document).ready(function(){
     $('#submitBtn').on('click', function(){
    alert(this.id);
    game = '<?php echo $game; ?>';
    teamNew = $('#teamNew').val();
    email = $('#email').val();
    password = $('#password').val();

  //  $('#heading').hide();
  //  $('#changeCredentials').hide();

    console.log(teamNew.substring(0,4) ,game,teamNew,password,email);
     let test = $('#teamNew').val();
     if (teamNew.substring(0,4) == 'team')
          {
            alert("Choose a NEW name");
             $("#teamNew").val('').css({"background-color":"pink"});
           }
     else {
    $.ajax({
        url: 'changeData.php',
        type: 'POST',
        data: {game:game ,team:teamNew, password:password,email:email} ,
        dataType:'text',
        success: function (response) {
            alert("success " + JSON.stringify(response));
            $('#output').text(success);
        },
         error : function(request,error)
    {
        alert("Request: error" );
    } // error
    }); // ajax
}  // else
     });
   
   });


</script>

/*

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

*/