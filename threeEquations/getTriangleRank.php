<?php 
include "../connectTempleDB.php" ;

 $team = $_POST['team'] ;


/*
$team = 'alpha' ;
$score =  5 ;
*/


echo $query ;
$result = mysqli_query($dbServer,$query);
mysqli_close($dbServer) ;
?>