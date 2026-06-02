<?php
include "../connectTempleDB.php" ;
$query = "SELECT team,count(word) AS words, sum(LENGTH(word)) AS total  FROM `countDownResults` 
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
