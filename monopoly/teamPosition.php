<?php

// load team 

 include "../connectTempleDB.php";

// $team = "alpha" ;
// $game = 1 ;


 $game = $_POST['game'];


$query = "SELECT count(*) as N FROM customers
WHERE substr(teamName,1,5) <> 'bank_'  AND game = '$game' ";


$result = mysqli_query($dbServer,$query);
//echo "<br>" . $query . "<br>";
$data = mysqli_fetch_row($result);
//print_($data);
$n = $data[0];

echo $n ;


exit() ;
?>