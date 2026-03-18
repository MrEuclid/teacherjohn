<?php

// load team 

 include "../connectTempleDB.php";

// $studentID = 12345;

 $studentID = $_REQUEST['studentID'];

// $studentID = 1616;
 
$output = [];
$cnt = 0;

$query = "SELECT gameID
			FROM mBooksRegistration 
			WHERE playerID = '$studentID' ";
// echo "<br>" . $query . "<br>";

$result = mysqli_query($dbServer,$query);

$data = mysqli_fetch_row($result);


echo $data[0];



exit() ;
?>