<?php 
include "../connectTempleDB.php" ;

$team = $_POST['team'] ;
 $word = $_POST['word'] ;

/*
$team = 'alpha' ;
$word = 'hope' ;
*/

$query = "INSERT INTO countDownResults (team,word) VALUES ('$team' , '$word') " ;

echo $query ;
$result = mysqli_query($dbServer,$query);
mysqli_close($dbServer) ;
?>