<?php
include "../../connectTempleDB.php" ; 

$cnt = 0;
$output = [];

// echo $current_year. "  " . $year;
// echo "<br>" ;

// grades for the current year

$query = "SELECT title,objectives  FROM certificateTitles  ";
$result = mysqli_query($dbServer,$query);

while($data = mysqli_fetch_assoc($result))
{
	$output[$cnt] = $data;
	$cnt++;
}


echo json_encode($output);

mysqli_close($dbServer);

?>