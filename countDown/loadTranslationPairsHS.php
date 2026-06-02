<?php


include "../connectTempleDB.php" ;

$level = 3 ; // primary only
$items = 6 ;

 //$level = $_POST['level'] ;
 //$unit = $_POST['unit'] ;

 // need to parse the unit to check for S1,S2 and all or 1..8

 //$unit = trim($unit);

 //$level = 6 ;
 //$unit = 2 ;

// uses level -2 -> level


$query = "SELECT *   FROM translate WHERE level <= '$level' 

ORDER BY RAND()  LIMIT 6 " ;



$translateArray = [];

// echo "<br>" . $query . "<br>" ;

$result = mysqli_query($dbServer,$query) ;
$i = 0 ;
while ($data = mysqli_fetch_assoc($result))
{
$translateArray[$i][0] = $data['id'] ;
$translateArray[$i][1] = $data['khmer'] ;
$translateArray[$i][2] = $data['word'] ;

$i = $i + 1 ;
}
 
 echo json_encode($translateArray);
  $dbServer->close();



?>  