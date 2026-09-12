<?php
include "../../connect_db_euclid_pio.php" ; 


$query = "SELECT max(Year) FROM New_ID_Year_Grade";
$result = mysqli_query($dbServer,$query);
$data = mysqli_fetch_row($result);
$year = $data[0];




// echo "<br>" ;
// get class for previous year 
 $grade = $_POST['currentClass'];
 






 // $grade = 'G12A';

$query = "SELECT 	Student_ID, 
					Family_name as familyName,
					First_name as firstName,,
					Grade as grade,
					'$certicate' as certificate,
					 email,
					 photo

  FROM New_Students
JOIN New_ID_Year_Grade
ON New_Students.ID = New_ID_Year_Grade.Student_ID
JOIN certificates on New_Studnets.ID = certificate.studentID
WHERE Gone = 'N' 
AND Grade = '$grade'
AND Year  = '$year' 
ORDER BY Student_ID " ;

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