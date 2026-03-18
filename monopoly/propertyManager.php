<?php

// load team 

 include "../connectTempleDB.php";



$query = "SELECT allTitles.*, team
FROM allTitles
JOIN propertyRegister
ON allTitles.id = propertyRegister.id

ORDER BY allTitles.id";

//  echo "<br>" . $query . "<br>";

$result = mysqli_query($dbServer,$query);

$output = [];
$i = 0;
// $n = mysqli_num_rows($result);
// echo " rows " . $n ;
while ($data = mysqli_fetch_assoc($result))
{
	$output[$i] = $data["title"];
	$i++;

}


echo json_encode($output);


exit() ;
?>