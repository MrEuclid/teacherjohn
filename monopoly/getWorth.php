<?php

// load team 

 include "../connectTempleDB.php";

// $team = "alpha" ;
// $game = 1 ;

 $team = $_POST['team'];
 $game = $_POST['game'];


$query = "SELECT sum(amount) FROM transactions 
			WHERE team = '$team'
			AND game = '$game'
			GROUP BY team ";


$result = mysqli_query($dbServer,$query);
//echo "<br>" . $query . "<br>";
$data = mysqli_fetch_row($result);
//print_($data);
$balance = $data[0];

$query = "SELECT sum(purchasePrice) FROM propertyRegister
			WHERE team = '$team'
			AND game = '$game'
			GROUP BY team ";


$result = mysqli_query($dbServer,$query);
//echo "<br>" . $query . "<br>";
$data = mysqli_fetch_row($result);
//print_($data);
$realty = $data[0];


$worth = $balance + $realty;

echo '$' . number_format($worth) ;


exit() ;
?>