<?php


include "../connectTempleDB.php" ;

$level = 2 ; // primary only
$items = 6 ;

 // $level = $_POST['level'] ;

 $items = 6 ;
 if ($level <= 3) {$items = 4 ;}
 
if ($level == 1) {$lower = 1 ; $upper = 1;}
if ($level == 2) {$lower = 1 ; $upper = 2;}
if ($level == 3) {$lower = 1;  $upper = 3;}
if ($level == 4) {$lower = 1 ; $upper = 4;}
if ($level == 4) {$lower = 2 ; $upper = 5;}
if ($level == 4) {$lower = 2 ; $upper = 6;}
if ($level == 4) {$lower = 3 ; $upper = 7;}
if ($level == 4) {$lower = 4 ; $upper = 8;}
if ($level == 4) {$lower = 5 ; $upper = 9;}
if ($level == 4) {$lower = 6 ; $upper = 10;}
if ($level == 4) {$lower = 7 ; $upper = 11;}
if ($level == 4) {$lower = 8 ; $upper = 12;}


$query = "SELECT *   FROM translate WHERE level >= '$lower' AND  level <= '$upper' 

ORDER BY RAND()  LIMIT 6 "  ;



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