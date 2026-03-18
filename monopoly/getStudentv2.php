<?php


 include "../connectTempleDB.php";

// $studentID = 12345;

 
$output = [];
$cnt = 0;


$query = "SELECT studentsPIO.studentID
			FROM studentsPIO
			JOIN mBooksRegistration 
			ON studentsPIO.studentId = mBooksRegistration.playerID
		ORDER BY studentsPIO.studentID; ";
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
