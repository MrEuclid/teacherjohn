
<html>


  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../bootstrap-5.0.2-dist/css/bootstrap.min.css">
  <script src="../javaScript/jQuery/jquery-3.3.1.min.js"></script>
  <script src="../bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>

<head>
<style>
	button {text-align: center; width:auto; background-color:white; color:black;}
	h1,h2 {text-align: center;}
	h1 {color:blie;}
</style>
</head>
  <body>
      <div class  = "container-fluid">
      
      <div class = "row">
        <div class = "col- text-center">
	<h1>Your user details have been changed</h1>
	<h3>Log back in with your new user name and password</h3>
<br></br>
<h2>
<button>
<a href = "indexMonopoly.php">Home</a>
</button>
</h2>
</div></div></div>
</body>
</html>


<?php

// load team 

 include "../connectTempleDB.php";
 // phpinfo() ;


 $team = $_POST['team'];
 $game = $_POST['game'];
 $email = $_POST['email'];
 $teamNew = $_POST['teamNew'];
 $pwdNew = $_POST['password'];

/*
 $team = "team81";
 $teamNew = "81team";
 $game = 8;
 $email = "technology@pio-students.net";
 $pwdNew = 'gamma';

*/
echo $teamNew . "  " . $pwdNew. " " . $email . " from " . $team . " " . $game  . "<br>" ;

 // get account number before team changes

 $query = "SELECT accountNumber FROM customers WHERE teamName = '$team' AND game = '$game' ";
 $result = mysqli_query($dbServer,$query);
 $data = mysqli_fetch_row($result);
 $accountNumber = $data[0];

 // send email

 echo "ACC " . $accountNumber . "<br>";

$msg = "";
$msg = "Your PIO Bank account for " . $teamNew . " is ready to use.";
$msg = $msg . "Your account number is " .  $accountNumber  . "\r\n";
$msg = $msg . "You will be playing in game number " . $game . "\r\n";
$msg = $msg . "You have been given $15,000 " .  "\r\n";
$msg = $msg . "The bank has also given you some cities " . "\r\n";
$msg = $msg . "Good luck and thank you for banking with PIO.".  "\r\n";
$msg = $msg . "\r\n". "The Best Bank for Business ";
$msg = $msg . "\r\n". "John Thompson - Customer Services Manager";


// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail($email,"New account",$msg);

echo "<br>";
 echo $msg;
echo "<br>";

// change property register 
$query = "UPDATE propertyRegister  SET team = '$teamNew'
WHERE team = '$team' AND game = '$game' ";

// echo "<br>" . $query  . "<br>" ;
mysqli_query($dbServer,$query);

// change customers

$query = "UPDATE customers SET teamName = '$teamNew', password = '$pwdNew', email = '$email'
WHERE teamName = '$team'  AND game = '$game' ";

echo "<br>" . $query  . "<br>" ;
 mysqli_query($dbServer,$query);

// update transactions

$query = "UPDATE transactions  SET team = '$teamNew'
WHERE team = '$team' AND game = '$game' ";

//echo "<br>" . $query  . "<br>" ;
mysqli_query($dbServer,$query);
$query = "UPDATE transactions  SET otherParty = '$teamNew'
WHERE otherParty  = '$team' AND game = '$game' ";

//echo "<br>" . $query  . "<br>" ;
 mysqli_query($dbServer,$query);


// update messages

$query = "UPDATE messages  SET team = '$teamNew'
WHERE team = '$team' AND game = '$game' ";

// echo "<br>" . $query  . "<br>" ;
 mysqli_query($dbServer,$query);

$query = "UPDATE messages  SET sender = '$teamNew'
WHERE sender  = '$team' AND game = '$game' ";

// echo "<br>" . $query  . "<br>" ;
 mysqli_query($dbServer,$query);



 // echo "<br>" . $query  . "<br>" ;
// send email 


?>

