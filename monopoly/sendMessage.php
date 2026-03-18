<?php

// load team 

 include "../connectTempleDB.php";

/*
$recipient= "alpha" ;
 $sender = "beta";
 $message = "I owe you rent for Mexico City and New York";
 $game = 1 ;
*/

 $recipient = 	$_POST['recipient'] ;
 $sender = 		$_POST['sender'] ;
 $game = 		$_POST['game'] ;
 $message = 	$_POST['message'] ;
      
$query = "INSERT INTO messages (team,game,sender, message)
	values ( '$recipient', '$game', '$sender', '$message') "  ;

// echo "<br>" . $query . "<br>";
$msg = "Got it! " . $message . " " . $recipient . " " . $sender;

mysqli_query($dbServer, $query);
echo $msg;


exit() ;
?>