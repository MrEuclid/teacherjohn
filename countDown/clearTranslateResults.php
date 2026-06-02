<?php
include "../connectTempleDB.php" ;

// copy table
$query = "TRUNCATE TABLE translateResults " ;
$result = mysqli_query($dbServer,$query) ;



echo "Results cleared" ;

mysqli_close($dbServer) ;
?>