<?php

// load team 

 include "../connectTempleDB.php";

// have fixed collation on mobile network



// new version


 $team = $_POST["team"] ;
// $grade = $_POST['grade'] ;

/*
 $team = "me and them too2";
 $grade = "junior" ;
*/

$data = [] ;
$query = "SELECT teamName FROM mathsCompetitionTeams WHERE teamName = '$team' " ;

 // echo "<br>" . $query . "<br>" ;

$result = mysqli_query($dbServer,$query);

$n = mysqli_num_rows($result);

$data[0] = $team ;


// $team = $team . "*" .random_int(100, 999); 
// echo "<br>Team = " . $team . "<br>" ;
// print_r($data);

//m$grade = 'G10';


	
	$query = "INSERT INTO mathsCompetitionTeams (teamName) values ( '$team') "  ;


	if(mysqli_query($dbServer, $query)){
	//	echo "Records added successfully.";
	} else{
	//	echo "ERROR: Could not able to execute $sql. " . mysqli_error($dbServer);
	}
	



$q = "SELECT teamName FROM mathsCompetitionTeams WHERE teamName = '$team' " ;
$r = mysqli_query($dbServer,$q);


$data = mysqli_fetch_row($r);
$team = $data[0] ;

 // echo "<br>Team = " . $team . "<br>" ;


$output =  $team  ;

echo $output;
exit() ;
?>
