<?php
include "../connectTempleDB.php" ;

// copy table
//$query = "TRUNCATE TABLE copyCountDownResults " ;
//$result = mysqli_query($dbServer,$query) ;

//$query = "INSERT INTO copyCountDownResults SELECT * FROM countDownResults " ;
//$result = mysqli_query($dbServer,$query) ;

$query = "TRUNCATE TABLE countDownResults " ;
$result = mysqli_query($dbServer,$query) ;

echo "Results cleared" ;

mysqli_close($dbServer) ;
?>