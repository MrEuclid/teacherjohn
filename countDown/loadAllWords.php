<?php
include "../connectTempleDB.php" ;
$query = "SELECT word ,count(word) AS n FROM `countDownResults` 
GROUP BY word ORDER BY n " ;

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
