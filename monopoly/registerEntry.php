<?php

// load team 

 include "../connectTempleDB.php";

 $site = $_POST['site'];
 $game = $_POST['game'];

//  $site = "Shanghai";
//  $game = 1; 

$query = "SELECT square,title,team FROM propertyRegister
WHERE title = '$site' AND  game = '$game' ";


 // echo "<br>" . $query . "<br>";

$result = mysqli_query($dbServer,$query);

$output = [];
$i = 0;
// $n = mysqli_num_rows($result);
// echo " rows " . $n ;
while ($data = mysqli_fetch_assoc($result))
{
	$output[$i] = $data;
	//echo $i . $output[$i];
	$i++;

}


echo json_encode($output);


exit() ;
?>