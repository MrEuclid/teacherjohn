<?php 

include "../connectTempleDB.php" ;


/*
$server = 'localhost' ;
$username = 'euclid';
$password = 'pythagoras' ;
$database = 'euclid_temple' ;
$dbServer =mysqli_connect ($server,$database,$password);
mysqli_select_db($dbServer,$database)or die("Unable to select database: " . mysqli_error()) ;

*/
// trying this

$level = 2 ;

// $level = $_POST['level'];

if ($level == 1) {$lower = 1 ; $upper = 1;}
if ($level == 2) {$lower = 1 ; $upper = 2;}
if ($level == 3) {$lower = 2 ; $upper = 3;}
if ($level == 4) {$lower = 3 ; $upper = 4;}

$query = "SELECT DISTINCT word ,khmer, id
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

    $i++ ;

}

 echo json_encode($output) ;
// echo $output ;
//print_r($output) ;

mysqli_close($dbServer) ;
?>
