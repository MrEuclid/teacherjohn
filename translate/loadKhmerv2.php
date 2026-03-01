<?php 

include "../connectTeacherJohn.php" ;


/*
$server = 'localhost' ;
$username = 'euclid';
$password = 'pythagoras' ;
$database = 'euclid_temple' ;
$dbServer =mysqli_connect ($server,$database,$password);
mysqli_select_db($dbServer,$database)or die("Unable to select database: " . mysqli_error()) ;

*/
// trying this

 $level = 11 ;

 $level = $_POST['level'];

if ($level == 1) {$lower = 1 ; $upper = 1;}
if ($level == 2) {$lower = 1 ; $upper = 2;}
if ($level == 3) {$lower = 1;  $upper = 3;}
if ($level == 4) {$lower = 1 ; $upper = 4;}
if ($level == 5) {$lower = 2 ; $upper = 5;}
if ($level == 6) {$lower = 2 ; $upper = 6;}
if ($level == 7) {$lower = 3 ; $upper = 7;}
if ($level == 8) {$lower = 4 ; $upper = 8;}
if ($level == 9) {$lower = 5 ; $upper = 9;}
if ($level == 10) {$lower = 6 ; $upper = 10;}
if ($level == 11) {$lower = 7 ; $upper = 11;}
if ($level == 12) {$lower = 8 ; $upper = 12;}

$query = "SELECT DISTINCT word ,khmer, id,level
FROM translate 
WHERE level >= '$lower' AND level <= '$upper'
ORDER BY RAND() 
LIMIT 1 " ;
$result = mysqli_query($dbServer,$query);

/*
echo "<br>" ;
echo $query ;
echo "<br>" ;
*/

$output = [] ;
$i = 0 ;
while ($data = mysqli_fetch_assoc($result))

{
    $output[$i][0] = $data["word"]  ;
    $output[$i][1] = $data["khmer"]  ;
    $output[$i][2] = $data["id"]  ;
    $output[$i][3] = $data["level"]  ;
    $i++ ;

}

 echo json_encode($output) ;
// echo $output ;
//print_r($output) ;

mysqli_close($dbServer) ;
?>
