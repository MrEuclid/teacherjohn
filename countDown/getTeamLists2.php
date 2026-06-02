<?php
include "../connectTempleDB.php" ;

$query = "SELECT teamName FROM phoneTeams ORDER BY teamName" ;
$result = mysqli_query($dbServer,$query);
$teams = [] ;
$i = 0;
while ($data = mysqli_fetch_row($result))
{
	
	$teams[$i] = $data[0] ;
    $name = $data[0] ;
	$i++ ;
    echo "<option value=" .  $name .   ">" . $name . "</option>" ;
   
}

/// echo json_encode($teams);
mysqli_close($dbServer);

?>
