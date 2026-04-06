<?php

// load team 

 include "../../connectTeacherJohn.php";


  $studentID = $_REQUEST['studentID'];

// $studentID = 4937;
 
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