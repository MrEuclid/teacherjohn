<?php
include "../connectTeacherJohn.php" ;
$query = "SELECT team,count(team) AS equations, sum(score) AS total  FROM `countDownNumberResults` 
GROUP BY team
ORDER BY total DESC" ;

//echo $query ;

$result = mysqli_query($dbServer,$query) ;
$output = [] ;
$i = 0 ;
while ($data = mysqli_fetch_assoc($result))
{

//echo $i ;
$output[$i] = $data ;
//print_r($data) ;
$i++ ;


}

echo json_encode($output) ;
mysqli_close($dbServer) ;
?>
