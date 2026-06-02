<?php
include "../connectTempleDB.php" ;

// updated from the Teacher page

$query = "SELECT currentRound , alienArrivals FROM phoneRounds ORDER BY currentRound DESC LIMIT 1 " ;
$result = mysqli_query($dbServer,$query) ;
$data = mysqli_fetch_assoc($result) ;

echo json_encode($data) ;
mysqli_close($dbServer) ;

?>