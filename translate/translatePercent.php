

<?php
include "../connectTempleTeacherJohn.php" ;

 $studentID = $_POST['studentID'];

// $studentID = 4429 ;
$query = " SELECT translateResults.studentID,
Family_name, First_name,Grade,
sum(case when mark = 1 then 1 end ) as correct,
count(mark) as total,
round(100*sum(case when mark = 1 then 1 end )/count(mark),0) AS percent
FROM `translateResults` 
JOIN Students_2023
ON Students_2023.studentID = translateResults.studentID
AND Students_2023.studentID = '$studentID' 
GROUP BY translateResults.studentID ";

// echo "<br>" . $query . "<br>" ;

$output = [] ;

$result = mysqli_query($dbServer,$query);

$data = mysqli_fetch_assoc($result); 
$output[0][1] = $data["percent"];
$output[0][1] = $data["total"];

echo json_encode($data["percent"] . "% from " .  $data["total"]);
exit();
?>
