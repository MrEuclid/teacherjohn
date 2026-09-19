<?php

// load team 

include "../connectTempleDB.php";

// $team = $_POST["team"] ;
$team = 'elephants';

$data = [] ;
$query = "SELECT teamName FROM mathsCompetitionTeams WHERE teamName = '$team' " ;

 echo "<br>" . $query . "<br>" ;

$result = mysqli_query($dbServer,$query);

$n = mysqli_num_rows($result);

$data[0] = $team ;
$data[1] = $n ;

if ($n == 0)
{
	$query = "INSERT INTO mathsCompetitionTeams (team) values (" . $team . ") "  ;
	echo "<br>" . " asdf". $query . "<br>" ;
	mysqli_query($dbServer,$query);
	$data[2] = "new";
}

else

{
	$data[2] = "old";
}

echo $data[0] . "*"  . $data[1] . "*" . $data[2];
?>