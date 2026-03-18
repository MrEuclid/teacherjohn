<?php

// load team 

 include "../connectTempleDB.php";

// $studentID = 12345;

 
$output = [];
$cnt = 0;

$query = "SELECT studentID
			FROM studentsPIO
		
			WHERE grade > 'G11' ";
// echo "<br>" . $query . "<br>";

$result = mysqli_query($dbServer,$query);

while ($data = mysqli_fetch_row($result))
{
$output[$cnt] = $data[0];
$cnt++;
}


echo json_encode($output);



exit() ;
?>