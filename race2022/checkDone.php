<?php

// load team 

 include "../connectTempleDB.php";

  $team = $_POST['team'];
 // $grade = $_POST['grade'];
// $team = "xyz*12";
// $grade = "G10" ;
  // split on asterisk
 // echo "Team was =  " . $team . "<br>";
$table = "mathsCompetitionResultsG7" ;


$output = [] ;
$i = 0;


$query = "SELECT question FROM " . $table .
			" WHERE  teamName =  '$team' "   ;

// echo "<br>" . $query. "<br>";

$result = mysqli_query($dbServer,$query) ;

WHILE ($data = mysqli_fetch_row($result))
{
	$output[$i] = $data[0];
	$i++;
}

// echo  $query ;

echo json_encode($output);

exit() ;
?>
