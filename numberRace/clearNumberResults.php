<?php
include "../connectTeacherJohn.php" ;



$query = "TRUNCATE TABLE countDownNumberResults " ;
$result = mysqli_query($dbServer,$query) ;

echo "Results cleared" ;

mysqli_close($dbServer) ;
?>