<?php

// load team 

 include "../connectTempleDB.php";

// gets the name of the student to dispaly on the page
 $studentID = $_REQUEST['studentID'];

 //  $studentID = 'bank11A-3';
// echo substr($studentID,0,4);

if (substr($studentID,0,4) == 'bank')
{
	$name = $studentID;
//	echo "Bank account ";
}

else

{

$query = "SELECT familyName,firstName
			FROM studentsPIO
			WHERE studentID = '$studentID' ";
// echo "<br>" . $query . "<br>";

$result = mysqli_query($dbServer,$query);

$data = mysqli_fetch_row($result);
$name = $data[0] . " " . $data[1];
}
echo $name ;

exit() ;
?>
