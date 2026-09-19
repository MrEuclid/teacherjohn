<?php
include "../connectTempleDB.php" ;
/*
$query = "SELECT teamName,max(points) AS total,
count(question) AS questions,
min(seconds) AS minutes FROM `G10AmathsCompetitionResults` 
GROUP BY teamName 
ORDER BY total DESC , min(seconds) DESC" ;
*/

$query = "SELECT teamName,count(question) as questions,
sum(
    SUBSTRING_INDEX(
        SUBSTRING_INDEX(question, '-', 2), '-', -1))         
                    AS total,  min(seconds) as minutes
FROM `G10AmathsCompetitionResults`
GROUP BY    teamName
ORDER BY total DESC ,questions DESC, seconds DESC" ;

    

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
