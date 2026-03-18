<?php

// load team 

 include "../connectTempleDB.php";

// $id = $_POST["square"];
 // $id = 7 ;

$query = "SELECT * FROM properties ORDER BY id ";



// echo "<br>" . $query . "<br>";

$result = mysqli_query($dbServer,$query);

$output = [];
$i = 0;
// $n = mysqli_num_rows($result);
// echo " rows " . $n ;
while ($data = mysqli_fetch_assoc($result))
{
	$output[$i] = $data;
	$i++;

}


echo json_encode($output);


exit() ;
?>