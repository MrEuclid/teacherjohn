<?php

// load team 

 include "../connectTempleDB.php";

// $team = "delta";
// $game = 2 ;

 $team = $_POST['team'];
 $game = $_POST['game'];

$query = "SELECT teamName 
			FROM customers 
			WHERE game = '$game' 
			AND teamName <> '$team' 
			ORDER BY teamName";

//  echo "<br>" . $query . "<br>";

$result = mysqli_query($dbServer,$query);

$output = [];
$i = 0;
// $n = mysqli_num_rows($result);
// echo " rows " . $n ;
while ($data = mysqli_fetch_assoc($result))
{
	$output[$i] = $data["teamName"];
	$i++;

}


echo json_encode($output);


exit() ;
?>