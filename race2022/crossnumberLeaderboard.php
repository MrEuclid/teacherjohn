<?php

// load numbers of puzzles already  solved

 include "../connectTempleDB.php";



// $studentID = 4936;
// $puzzleNumber = 1;

$output = [];
$cnt = 0;

$query = "SELECT studentsPIO.studentID,familyName,firstName,grade, count(question) as N FROM `studentsPIO` 
JOIN crossnumberScores
ON studentsPIO.studentID = crossnumberScores.studentID
GROUP BY crossnumberScores.studentID
ORDER BY count(question) DESC; ";

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