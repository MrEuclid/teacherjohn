<?php

// load team 

 include "../connectTempleDB.php";

//$studentID = 1581;

 $studentID = $_POST['studentID'];

$output = [];
$i = 0;
 $query = "SELECT sum(amount) as linkedAmount,'101' AS linkedAccount,'cash' as linkedName FROM mbooksJournal 
 			WHERE studentID = '$studentID'
 			GROUP BY studentID";

$result = mysqli_query($dbServer,$query);
$data = mysqli_fetch_assoc($result);
$output[$i] = $data;

$query = "SELECT 
sum(linkedAmount) as linkedAmount, linkedAccount,mbooksCOA.name  as linkedName FROM `mbooksJournal` 
JOIN mbooksCOA ON code = linkedAccount
WHERE studentID = '$studentID'
GROUP BY  linkedAccount
HAVING substr(linkedAccount,1,1) <= 3 ";
// echo "<br>" . $query . "<br>";



$result = mysqli_query($dbServer,$query);

while ($data = mysqli_fetch_assoc($result))
{
	$i++;
	$output[$i] = $data;
	
}

echo json_encode($output);
exit() ;
?>