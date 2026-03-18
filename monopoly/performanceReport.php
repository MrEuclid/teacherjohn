<?php

// load team 

 include "../connectTempleDB.php";

 $studentID = 1338;

 //$studentID = $_POST['studentID'];

$output = [];
$i = 0;

$query = "SELECT 
sum(linkedAmount) as linkedAmount, linkedAccount,mbooksCOA.name  as linkedName FROM `mbooksJournal` 
JOIN mbooksCOA ON code = linkedAccount
WHERE studentID = '$studentID'
GROUP BY  linkedAccount
HAVING substr(linkedAccount,1,1) > 3 ";
// echo "<br>" . $query . "<br>";



$result = mysqli_query($dbServer,$query);

while ($data = mysqli_fetch_assoc($result))
{
	
	$output[$i] = $data;
	$i++;
}

echo json_encode($output);
exit() ;
?>