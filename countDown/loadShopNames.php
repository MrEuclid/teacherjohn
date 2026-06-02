<?php

include "../connectTempleDB.php" ;
// SHOP NAME
// price
// stock
// income - initially 0 

//$teamName = 'PIO1';

 // $round = $_POST['roundNumber'];
// teamID and teamName
$query = "SELECT * FROM phoneTeams ORDER BY teamID";
$result = mysqli_query($dbServer,$query) ;
$i = 0; 

$team = [];

while ($data = mysqli_fetch_row($result))
	{
		$team[$i] = $data  ;  // name
		$i++ ;
	}

echo json_encode($team);

?>