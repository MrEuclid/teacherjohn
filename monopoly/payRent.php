<?php

// buy a property and update the property register

 include "../connectTempleDB.php";

 $id = $_POST['id'];
 $title = $_POST['title'] ;

 $team = $_POST['team']   ; 
 $game = $_POST['game']; 

 $owner = $_POST['owner']  ;

 $rent = $_POST['rent'] ;

 $details = "Rent "  . $title . " to " . $owner . "  " . $team . " for " . $rent;
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
			
			VALUES ('$team', '$owner', '-$rent', '$details', '$game') ";

 mysqli_query($dbServer,$query);
 // echo "<br>" . $query . "<br>";

// two updates to transaction one for payer and the other for payee

//$temp = $team;  // temp = alpha
//$team = $otherParty; // team = beta
//$otherParty = $temp; // other = alpha
//$money = $price;

// increase account  by amount team = beta , otherParty = alpha

$query = "INSERT INTO transactions (team,otherParty,amount,details,game) 
			
			VALUES ('$owner', '$team', '$rent', '$details','$game') ";

 mysqli_query($dbServer,$query);

// echo "<br>" . $query . "<br>";

$msg = "Rent paid " . $details;
echo $msg;


exit() ;
?>
