
<?php

include "../connectTempleDB.php" ;
$query = "SELECT team,count(team) as games,sum(score) AS total, ROUND((max(time) - min(time))/100,2) AS timeTaken 
FROM `triangleResults` 

GROUP BY team
ORDER BY score DESC, time ASC" ;



$result = mysqli_query($dbServer,$query) ;
$output = [] ;
$i = 0 ;
while ($data = mysqli_fetch_assoc($result))
{


$output[$i] = $data ;
// print_r($data) ;
$i++ ;


}

echo json_encode($output) ;
mysqli_close($dbServer) ;
?>