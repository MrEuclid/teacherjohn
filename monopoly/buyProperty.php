<?php

// buy a property and update the property register

 include "../connectTempleDB.php";

 $id = $_POST['id'];
 $title = $_POST['title'] ;

 $team = $_POST['team']   ; 
 $game = $_POST['game']; 

 $owner = $_POST['seller']  ;

 $price = $_POST['price'] ;

 $details = "Purchase "  . $title . " by " . $team . " from " . $owner . " for " . $price;
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

 // now update register with purchasePrice,team,game,comment
$comment = "Purchase";
 $query = "UPDATE  propertyRegister SET 
 					purchasePrice = '$price',
 					team = '$team',
 					game = '$game',
 					comment = '$comment'
 			WHERE (square = '$id' AND game = '$game') ";

mysqli_query($dbServer,$query);
//  echo "<br>" . $query . "<br>";
$msg = "Purchase completed and register updated" . $details;
echo $msg;


exit() ;
?>
