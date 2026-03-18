<?php

// load team 

 include "../connectTempleDB.php";

// $studentID = 12345;

 $studentID = $_REQUEST['studentID'];

$query = "SELECT sum(linkedAmountmount) FROM `mbooksJournal` WHERE studentID = '$studentID' 
AND 
substr(linkedAccount,1,1) = 1 ";
// echo "<br>" . $query . "<br>";

$result = mysqli_query($dbServer,$query);

$data = mysqli_fetch_row($result);

echo $data[0];

exit() ;
?>
