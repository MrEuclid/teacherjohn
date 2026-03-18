<?php


 include "../connectTempleDB.php";



 // $gameID = '11A-3';

$gID = $_REQUEST['gameID'];

$gameID = trim($gID);

$bank = 'bank-' . $gameID ;
$output = [];
$output[0] = $bank;
$cnt = 1;

$query = "SELECT concat(studentsPIO.studentID,' ', familyName,' ',firstName) as person 
			FROM mBooksRegistration
			JOIN studentsPIO 
			ON studentsPIO.studentId = mBooksRegistration.playerID
			WHERE gameID = '$gameID'
		ORDER BY studentsPIO.studentID ";
// echo "<br>" . $query . "<br>";

$result = mysqli_query($dbServer,$query);

while ($data = mysqli_fetch_assoc($result))
{
$output[$cnt] = $data['person'];
$cnt++;
}

echo json_encode($output);



exit() ;
?>
