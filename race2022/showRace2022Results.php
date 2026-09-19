<?php
include "../connectTempleDB.php" ;

$query = "SELECT teamName,sum(mark) AS total,
count(question) AS questions,
min(seconds) AS minutes FROM `mathsCompetitionResults` 
GROUP BY teamName 
ORDER BY total DESC , min(seconds) DESC" ;



// substrring_index is like split or explode
$query = "SELECT SUBSTRING_INDEX(teamName, '*', 1) as teamName,count(question) as questions,
max(points) AS total , min(seconds) as minutes
FROM `mathsCompetitionResultsG7`
GROUP BY    SUBSTRING_INDEX(teamName, '*', 1)
ORDER BY total DESC ,questions DESC, min(seconds) DESC" ;
//echo $query ;

$result = mysqli_query($dbServer,$query) ;
$output = [] ;
$i = 0 ;
while ($data = mysqli_fetch_assoc($result))
{


$output[$i] = $data ;

$i++ ;


}

echo json_encode($output) ;
mysqli_close($dbServer) ;
?>
