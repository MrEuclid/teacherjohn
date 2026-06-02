<?php

include "../connectTempleDB.php" ;

 // $studentID = 1013 ;

 $studentID = $_REQUEST['studentID'] ;

$query = "SELECT * FROM smc2024 WHERE studentID = '$studentID'" ;

/*
echo "<br>" ;
echo $query ;
echo "<br>" ;
*/


$result = mysqli_query($dbServer,$query);
$n = mysqli_num_rows($result) ;
$data = [];

if ($n == 0)
{
    $data["message"] = "error" ;
}
else
{
$data = mysqli_fetch_assoc($result);
$data["message"] = "ok" ;
}



// print_r($data) ;
 


 echo json_encode($data) ;


mysqli_close($dbServer) ;
?>