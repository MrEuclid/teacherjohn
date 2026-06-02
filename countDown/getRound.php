<?php
include "../connectTempleDB.php" ;

// updated from the Teacher page

$query = "SELECT currentRound , alienArrivals FROM phoneRounds ORDER BY roundID DESC LIMIT 1 " ;
$result = mysqli_query($dbServer,$query) ;
$data = mysqli_fetch_row($result) ;
$round = $data[0];
$aliens = $data[1] ;

echo $round . "*" . $data[1] ;
mysqli_close($dbServer) ;

?>