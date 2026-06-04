<?php 
include "../connectTempleDB.php" ;

 $team = $_POST['team'] ;
 $score = $_POST['score'] ;

/*
$team = 'alpha' ;
$score =  5 ;
*/

$query = "INSERT INTO triangleResults (team,score) VALUES ('$team' , '$score') " ;

echo $query ;
$result = mysqli_query($dbServer,$query);
mysqli_close($dbServer) ;
?>