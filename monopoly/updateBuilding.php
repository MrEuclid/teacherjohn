<?php

// process the purchase of houses and hotels

 include "../connectTempleDB.php";
/*
 $id = 	2;
$team = "john";
$game = 13;
$houses = 1;
$hotel = 0;
$title = "Tokyo";

*/

$id = 	$_POST['id'];
$team = $_POST['team'];
$game = $_POST['game'];
$houses = $_POST['houses'];
$hotel = $_POST['hotel'];
$title = $_POST['title'];
$price = $_POST['money'];

$details = "Buying houses on " . $title;


$owner = 'bank_' . $game;


$query = "UPDATE propertyRegister 
					SET houses = '$houses',
						hotel = '$hotel'
						
					WHERE square = '$id' AND game = '$game'  ";

mysqli_query($dbServer,$query);

// echo "<br>" . $query . "<br>";

// owner  transaction

// bank transaction


$money = -$price;

$query = "INSERT INTO transactions (team,otherParty,amount,details,game) 
			
			VALUES ('$team', '$owner', '-$price', '$details', '$game') ";

 mysqli_query($dbServer,$query);
 // echo "<br>" . $query . "<br>";

// two updates to transaction one for payer and the other for payee

//$temp = $team;  // temp = alpha
//$team = $otherParty; // team = beta
//$otherParty = $temp; // other = alpha
//$money = $price;

// increase account  by amount team = beta , otherParty = alpha

$query = "INSERT INTO transactions (team,otherParty,amount,details,game) 
			
			VALUES ('$owner', '$team', '$price', '$details','$game') ";

 mysqli_query($dbServer,$query);

// echo "<br>" . $query . "<br>";


$msg = "Purchase completed and register updated" . $details;
echo $msg;


exit() ;
?>