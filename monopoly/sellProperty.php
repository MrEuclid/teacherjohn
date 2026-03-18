<?php

// sell a property and update the property register

 include "../connectTempleDB.php";

/*
 $id = 2;
 $team = "john";
 $game = 13 ;
 $price = 600;
 $otherParty = "bank_" . $game;
 $title = "Tokyo";

 */

 $id = $_POST['id'];
 $title = $_POST['title'] ;
 $team = $_POST['team']   ; 
 $game = $_POST['game']; 
 $otherParty = "bank_" . $game ;
 $price = $_POST['price'] ;



 $details = "Sell "  . $title . " owned by " . $team . " to " . $otherParty . " for " . $price;
 // echo $details;

// print_r($_POST);
// echo $team . "-" . $owner . " " . $price . " " . $title . " " . $game . " " . $id;
    /* 
 $id = 7;
 $title = "Taipei" ;
 $team = "alpha"   ; 
 $owner = "bank_8"  ;
 $price = 1400; 
 $details = "Purchase "  . $title . " by " . $team;
 $game = 8;     
   */


$query = "INSERT INTO transactions (team,otherParty,amount,details,game) 
			
			VALUES ('$team', '$otherParty', '$price', '$details', '$game') ";

 mysqli_query($dbServer,$query);
 // echo "<br>" . $query . "<br>";

// two updates to transaction one for payer and the other for payee

//$temp = $team;  // temp = alpha
//$team = $otherParty; // team = beta
//$otherParty = $temp; // other = alpha
//$money = $price;

// increase account  by amount team = beta , otherParty = alpha

$query = "INSERT INTO transactions (team,otherParty,amount,details,game) 
			
			VALUES ('$otherParty', '$team', '-$price', '$details','$game') ";

 mysqli_query($dbServer,$query);

// echo "<br>" . $query . "<br>";

 // now update register with purchasePrice,team,game,comment
$comment = "Owner sold to the bank";
 $query = "UPDATE  propertyRegister SET 
 					purchasePrice = '$price',
 					team = '$otherParty',
 			
 					comment = '$comment'
 			WHERE (square = '$id' AND game = '$game') ";

mysqli_query($dbServer,$query);
// echo "<br>" . $query . "<br>";
$msg = "Purchase completed and register updated" . $details;
echo $msg;


exit() ;
?>
