<?php

// load team 

 include "../connectTempleDB.php";

//$studentID = 'bank11B-2';

 $studentID = $_REQUEST['studentID'];

$query = "SELECT sum(ABS(linkedAmount)) FROM `mbooksJournal` WHERE studentID = '$studentID' 
AND  substr(linkedAccount,1,1) = 5";
// echo "<br>" . $query . "<br>";

$result = mysqli_query($dbServer,$query);

$data = mysqli_fetch_row($result);

echo $data[0];

exit() ;
?>
