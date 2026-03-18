<?php

// load team 

 include "../connectTempleDB.php";
/*
$team = "alpha" ;
$game = 1 ;
$amount = 500;
$details = "rent Mexico still owing";
$payee = "gamma";

*/
$team = $_POST['team'];
$game = $_POST['game'];
$payee = $_POST['payee'];
$details = $_POST['details'];
$amount = $_POST['amount'];
$otherParty = $payee;
// alpha to beta team = alpha
// reduce my account by amount 
$money = -$amount;
$query = "INSERT INTO transactions (team,otherParty,amount,details,game) 
			
			VALUES ('$team', '$otherParty', '$money', '$details', '$game') ";

mysqli_query($dbServer,$query);

// echo "<br>" . $query . "<br>";

// two updates to transaction one for payer and the other for payee

$temp = $team;  // temp = alpha
$team = $otherParty; // team = beta
$otherParty = $temp; // other = alpha
$money = $amount;

// increase account  by amount team = beta , otherParty = alpha

$query = "INSERT INTO transactions (team,otherParty,amount,details,game) 
			
			VALUES ('$team', '$otherParty', '$money', '$details','$game') ";

mysqli_query($dbServer,$query);

//echo "<br>" . $query . "<br>";

$msg = "Got it " . $team . " " . $amount . " " . $payee . " "  . $details;
echo $msg;


exit() ;
?>