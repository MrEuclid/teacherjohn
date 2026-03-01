<?php
include "../connectTeacherJohn.php" ;
$query = "SELECT concat(Family_name , ' ' , First_name) AS student,
sum(case when mark = 1 then 1 else 0 end) AS correct,
sum(case when mark = 0 then 1 else 0 end) AS wrong,
round(100*sum(case when mark = 1 then 1 else 0 end)/count(mark),0) AS percent
FROM translateResults
JOIN Students_2023
ON translateResults.studentID = Students_2023.studentID
GROUP BY translateResults.studentID
ORDER BY  correct DESC , percent DESC " ;

/*
echo "<br>" ;
echo $query ;
echo "<br>" ;
*/


$result = mysqli_query($dbServer,$query) ;
$n = mysqli_num_rows($result);
// echo $n;
$output = [] ;
$i = 0 ;

while ($data = mysqli_fetch_assoc($result))
{



$output[$i][0] = $data["student"] ;

$output[$i][1] = $data["correct"] ;
$output[$i][2] = $data["wrong"] ;
$output[$i][3] = $data["percent"] ;


$i++ ;


}
// echo $i;
echo json_encode($output) ;
mysqli_close($dbServer) ;

?>
