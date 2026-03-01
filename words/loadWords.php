<?php
include "../connectTeacherJohn.php" ;



// phpinfo() ;

 $level = $_POST['level'] ;



 // $level = 5 ;

$query = "SELECT distinct word  FROM spellingWords WHERE level = '$level' 
AND LENGTH(word) > 2 AND LENGTH(word) <= 12 
ORDER BY LENGTH(word), RAND() " ;

$result = mysqli_query($dbServer,$query) ;
$i = 0 ;
while ($data = mysqli_fetch_assoc($result))
{
$wordsArray[$i] = $data['word'] ;
$i = $i + 1 ;

}
 
 echo json_encode($wordsArray);
  $dbServer->close();



?>  