<?php

// load team 

 include "../connectTempleDB.php";

// $studentID = 4936;

 $studentID = $_POST['studentID'];


$query = "SELECT * 
			FROM `mbooksJournal` 
WHERE studentID = '$studentID' ORDER BY id DESC";
// echo "<br>" . $query . "<br>";

$output = [];
$i = 0;

$result = mysqli_query($dbServer,$query);

while ($data = mysqli_fetch_assoc($result))
{
	$output[$i] = $data;
	$i++;
}

echo json_encode($output);
exit() ;
?>