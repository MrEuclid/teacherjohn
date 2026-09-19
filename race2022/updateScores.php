<?php

// load team 

 include "../connectTempleDB.php";

// have fixed collation on mobile network

/*
$team = 'jgt24' ;
$score = 5 ;
$timer = '43:12' ;
$grade = 'G11' ;
$question = 'Graction -5';
$questionID = 'q5';
*/


$team = $_POST["teamName"] ;
$score = $_POST['score'] ;
$timer = $_POST['timer'] ;
// $grade = $_POST['grade'] ;
$question = $_POST['question'];
$questionID = $_POST['questionID'];


$data = [] ;

$output = $team . "*" . $question . "*" . $score . "*" . $timer;


	$query = "INSERT INTO mathsCompetitionResultsG7 

	(teamName, question,points,seconds) 

	values ( '$team', '$question', '$score', '$timer') "  ;


	if(mysqli_query($dbServer, $query)){
		$output =  "Records added successfully.";
	} else{
		$output =  "ERROR: Could not to execute query. " . mysqli_error($dbServer);
	}
	

 // echo "<br>Team = " . $team . "<br>" ;
 // echo "<br>Query = " . $query . "<br>" ;

echo $output;
exit() ;
?>