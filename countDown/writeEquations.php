<?php 
include "../connectTempleDB.php" ;



$target = $_POST['target'] ;
$puzzle = $_POST['puzzle'] ;



/*
$team = 'alpha' ;
$target = '25' ;
$puzzle = '*2*12*4*17*' ;
$score = 10 ;
*/

$query = "INSERT INTO countDownEquations (target,puzzle) VALUES ('$target', '$puzzle') " ;

// echo $query ;
$result = mysqli_query($dbServer,$query);
mysqli_close($dbServer) ;
?>