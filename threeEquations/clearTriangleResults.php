<?php
include "../connectTempleDB.php" ;

// copy table


$query = "TRUNCATE TABLE triangleResults" ;
$result = mysqli_query($dbServer,$query) ;

echo "Results backed up and cleared" ;

mysqli_close($dbServer) ;
?>