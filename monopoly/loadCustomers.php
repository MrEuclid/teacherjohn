<?php
include "../connectTempleDB.php";


$query = "SELECT teamName,email FROM customers WHERE substr(teamName,1,5) <> 'bank_' ";
// echo "<br>" . $query . "<br>" ;
$result = mysqli_query($dbServer,$query);

$i = 0;
$output = [];
WHILE ($data = mysqli_fetch_assoc($result))
{
	$output[$i] = $data;
	$i++;
}

echo json_encode($output) ;

exit();
?>