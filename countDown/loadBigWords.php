<?php
 $wordLength = 8 ;


include "../connectTeacherJohn.php" ;
$query = "SELECT DISTINCT word FROM spellingWords2
WHERE LENGTH(word) >= '$wordLength' ORDER BY word  " ;

//echo $query ;

$result = mysqli_query($dbServer,$query) ;
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
