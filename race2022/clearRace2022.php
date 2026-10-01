<?php
include "../connectTempleDB.php" ;



$query = "TRUNCATE TABLE mathsCompetitionResultsG7" ;
$result = mysqli_query($dbServer,$query) ;

echo "Results cleared" ;

$query = "TRUNCATE TABLE mathsCompetitionTeamsG7" ;
$result = mysqli_query($dbServer,$query) ;

echo "Teams cleared" ;

mysqli_close($dbServer) ;
?>
