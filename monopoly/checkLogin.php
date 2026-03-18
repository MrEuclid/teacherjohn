<?php

// load team 

 include "../connectTempleDB.php";


 $team = $_POST["team"];
 $password = $_POST['password'];
 $game = $_POST['game'];

/*
 $team = "alpha";
 $password = "alpha";
 $game = 4;
 
*/
$output = [];
$query = "SELECT * FROM customers
			 WHERE teamName = '$team' 
			 AND password = '$password' 
			 AND game = '$game' ";
// echo "<br>" . $query . "<br>";

$result = mysqli_query($dbServer,$query);
$n = mysqli_num_rows($result);
if ($n == 1)
{$data = mysqli_fetch_assoc($result);
	$output[0] = $data;}
else {$output[0] = ["Error"];}

echo json_encode($output);


exit() ;
?>