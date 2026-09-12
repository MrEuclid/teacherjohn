<?php
include "../../connect_db_euclid_pio.php" ; 


// echo $current_year. "  " . $year;
// echo "<br>" ;

// grades for the current year

$query = "SELECT max(Year) FROM New_ID_Year_Grade";
$result = mysqli_query($dbServer,$query);

while($data = mysqli_fetch_row($result))
{
	$year = $data[0];
}

$query = "SELECT DISTINCT Grade  FROM New_ID_Year_Grade 

WHERE Year = '$year'
AND School = 'PIOHS'
AND Grade IN ('G9A','G9B','G10A','G10B','G11A','G11B','G12A','G12B')
ORDER BY School DESC, Grade" ;

// echo "<br>" . $query . "<br>" ;

$result = mysqli_query($dbServer,$query);

$cnt = 0;
$output = [];

WHILE ($data = mysqli_fetch_assoc($result))
{
$output[$cnt] = $data;
$cnt++ ;
}

echo json_encode($output);

mysqli_close($dbServer);

?>