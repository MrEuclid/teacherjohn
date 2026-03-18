<?php

// load team 

 include "../connectTempleDB.php";


 $studentID = $_REQUEST['studentID'];
// $studentID = 4936;


$query = "SELECT familyName,firstName
			FROM school2025
			WHERE studentID = '$studentID' ";
// echo "<br>" . $query . "<br>";

$result = mysqli_query($dbServer,$query);

$data = mysqli_fetch_assoc($result);

$n = mysqli_num_rows($result);

if ($n == 1)
{echo json_encode($data);}
else 
{
	$data["n"] = 0;
	echo  json_encode($data);
}


exit() ;
?>