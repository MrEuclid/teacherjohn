<?php
include "../connectTempleDB.php" ;



$query = "TRUNCATE TABLE crossnumberScores " ;
$result = mysqli_query($dbServer,$query) ;

echo "Results cleared" ;


mysqli_close($dbServer) ;
?>