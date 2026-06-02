<?php
include "../connectTempleDB.php" ;
$query = "SELECT studentID,count(word) AS words, 
sum(mark) AS total  FROM `translateResults` 
GROUP BY studentID
ORDER BY total DESC" ;

$result = mysqli_query($dbServer,$query) ;
$output = [];

while ($data = mysqli_fetch_assoc($result))
{
$output[] = $data ;
}

echo json_encode($output) ;
mysqli_close($dbServer) ;
?>
