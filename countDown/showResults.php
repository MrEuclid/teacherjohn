<?php
include "../connectTempleDB.php" ;
$query = "SELECT team,count(word) AS words, sum(LENGTH(word)) AS total  FROM `countDownResults` 
GROUP BY team
ORDER BY total DESC" ;

$result = mysqli_query($dbServer,$query) ;
$output = []

while ($data = mysqli_fetch_assoc($result))
{
$output[] = $data ;
}

echo json_encode($output) ;
mysqli_close($dbServer) ;
?>
