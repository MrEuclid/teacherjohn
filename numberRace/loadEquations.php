<?php 
include "../connectTeacherJohn.php" ;

$level = $_POST['level'] ;
//$puzzle = $_POST['puzzle'] ;

// $level = 3 ;
$lower = $level - 1;
$upper = $level * 10 ;

$query = "SELECT target,puzzle FROM `countDownEquations` WHERE (target <= '$upper' AND target >= '$lower' ) GROUP BY target
 order by RAND() LIMIT 10 " ;


$result = mysqli_query($dbServer,$query) ;
$output = [] ;
$i = 0 ;
while ($data = mysqli_fetch_assoc($result))
{

//echo $i ;
$output[$i] = $data ;
//print_r($data) ;
$i++ ;


}

echo json_encode($output) ;
mysqli_close($dbServer) ;
?>