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




$query = "SELECT DISTINCT word  FROM spellingWords2 ORDER BY word " ;
$result = mysqli_query($dbServer,$query);

$output = [] ;
$i = 0 ;
while ($data = mysqli_fetch_assoc($result))

{
    $output[$i] = $data["word"]  ;
    $i++ ;

}

 echo json_encode($output) ;
// echo $output ;
//print_r($output) ;

mysqli_close($dbServer) ;
?>
