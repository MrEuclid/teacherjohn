<?php

// load team 

 include "../connectTempleDB.php";



$query = "SELECT id,title ,price  FROM properties
UNION SELECT id,title ,price FROM utilities
UNION SELECT id,title ,price FROM airports
ORDER BY id;";

//  echo "<br>" . $query . "<br>";

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