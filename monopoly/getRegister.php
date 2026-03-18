<?php

// load team 

 include "../connectTempleDB.php";

// $team = "delta";
// $game = 1 ;


  $game = $_POST['game'];

$query = "SELECT * FROM propertyRegister WHERE game = '$game'
ORDER BY id ";


//  echo "<br>" . $query . "<br>";

$result = mysqli_query($dbServer,$query);

$output = [];
$i = 0;
// $n = mysqli_num_rows($result);
// echo " rows " . $n ;
while ($data = mysqli_fetch_assoc($result))
{
	$output[$i] = $data;
//	echo $i . $output[$i];
	$i++;

}

echo json_encode($output);


exit() ;
?>