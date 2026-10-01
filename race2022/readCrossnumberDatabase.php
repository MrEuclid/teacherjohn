<?php

// load numbers of puzzles already  solved

 include "../connectTempleDB.php";

$studentID = $_POST['studentID'] ;

// $studentID = 4936;
// $puzzleNumber = 1;

$output = [];
$cnt = 0;

$query = "SELECT question FROM crossnumberScores WHERE studentID = '$studentID' ";

// echo "<br>" . $query . "<br>" ;

$result = mysqli_query($dbServer,$query);

while ($data = mysqli_fetch_assoc($result))
{

	$output[$cnt] =  $data ;
	$cnt++ ;

}



echo json_encode($output);
exit() ;
?>