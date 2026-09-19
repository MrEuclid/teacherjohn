<?php

// load team 

 include "../connectTempleDB.php";

$studentID = $_POST['studentID'] ;

// $studentID = 4936;

$query = "SELECT * FROM studentsPIO WHERE studentID = '$studentID' ";
$result = mysqli_query($dbServer,$query);

$n = mysqli_num_rows($result);
// echo $n;
$result = mysqli_query($dbServer,$query);
if ($n == 1) 
{

	$data = mysqli_fetch_row($result);
	$output = $data[0] . ' ' . $data[1] . ' ' . $data[2] . '  ' . $data[3];
}

else
{

	$output = 'ID not found';
}

echo $output;
exit() ;
?>