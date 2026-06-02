<?php
include "../connectTempleDB.php" ;

$query = "SELECT * FROM phoneConstants" ;
$result = mysqli_query($dbServer,$query);
$data = mysqli_fetch_assoc($result);
echo json_encode($data) ;

mysqli_close($dbServer) ;


?>