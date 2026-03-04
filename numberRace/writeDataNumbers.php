<?php 
include "../connectTeacherJohn.php" ;



$team = $_POST['team'] ;
$puzzle = $_POST['puzzle'] ;
$score = $_POST['score'] ;


/*
$team = 'alpha' ;
$target = '25' ;
$puzzle = '*2*12*4*17*' ;
$score = 10 ;
*/

$query = "INSERT INTO countDownNumberResults (team,puzzle,score) VALUES ('$team' ,  '$puzzle','$score') " ;

echo $query ;
$result = mysqli_query($dbServer,$query);
mysqli_close($dbServer) ;
?>