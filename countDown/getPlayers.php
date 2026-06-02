<?php 

include "../connectTempleDB.php" ;
// calculate team balance

// $teamName = 'PIO1';
$teamName = $_POST['teamName'];  // load needs get
 // $round = $_POST['roundNumber'];

$query = "SELECT teamID FROM phoneTeams WHERE teamName = '$teamName' ";
$result = mysqli_query($dbServer,$query) ;
$data = mysqli_fetch_row($result);
$teamID = $data[0] ;

$query = "SELECT Family_name, First_name,Grade 
FROM `pioStudents`
wHERE 
ID IN (SELECT playerID FROM phonePlayers WHERE teamID = '$teamID')" ;

$result = mysqli_query($dbServer,$query) ;
$players = [] ;
$i = 0 ;

while ($data = mysqli_fetch_assoc($result))
{
	$players[$i] = $data ;
	echo $data['Family_name'] . " " . $data['First_name'] . ' ' . $data['Grade']  . "<br>" ;
	$i++;
}

// echo $players);
mysqli_close($dbServer) ;