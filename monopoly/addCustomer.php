<?php



 include "../connectTempleDB.php";




$team = $_POST["teamName"] ;
$email = $_POST['email'] ;
$password = $_POST['password'] ;
$accountNumber = $_POST['accountNumber'];
$game = $_POST['game'];


/*
$team = "alpha";
$email = "abc@google.com";
$password = "123456";
$accountNumber = '12-1234-4321-03';

$game = 3; 

*/

$amount = 15000 ; // startup grant 
$otherParty = "bank_" . $game;
$details = "start up capital";



	$query = "INSERT INTO customers

	(teamName, email,password,accountNumber,game)

	values ( '$team', '$email', '$password', '$accountNumber','$game') "  ;
	mysqli_query($dbServer,$query);

//echo "<br>" . $query . "<br>";

$query = "INSERT INTO transactions (team,otherParty,amount,details,game) 
			
			VALUES ('$team', '$otherParty', '$amount', '$details','$game') ";

mysqli_query($dbServer,$query);

//echo "<br>" . $query . "<br>";

$otherParty = $team;
$team = "bank_".$game;
$amount  = -$amount;


$query = "INSERT INTO transactions (team,otherParty,amount,details,game) 
			
			VALUES ('$team', '$otherParty', '$amount', '$details','$game') ";

mysqli_query($dbServer,$query);

// echo "<br>" . $query . "<br>";
// do transactions for startup money - including bank_?
	
//  echo "<br>Team = " . $team . "<br>" ;
// echo "<br>Query = " . $query . "<br>" ;


// send email 

$msg = "Your PIO Bank account for " . $team . " is ready to use.";
$msg = $msg . "Your account number is " . $accountNumber . "\r\n";
$msg = $msg . "You will be playing in game number " . $game . "\r\n";
$msg = $msg . "Thank you for banking with PIO - The Best Bank for Business.";
$msg = $msg . "\r\n". " John Thompson - Customer Services Manager";
$msg = $msg . "\r\n". "Avoid being scammed. Never share your password with others. " ;

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail($email,"New account",$msg);

 echo $msg;

 
exit() ;
?>