<?php

// load team 

 include "../connectTempleDB.php";

// $studentID = "bank11B-1";

 $studentID = $_REQUEST['studentID'];

$query = "SELECT name,linkedAccount,sum(linkedAmount)  as total FROM `mbooksJournal` 
JOIN mbooksCOABank on mbooksCOABank.code = mbooksJournal.linkedAccount
AND studentID = '$studentID'
GROUP BY linkedAccount" ;

//  echo "<br>" . $query . "<br>";

include "print_query_data_plain.php";


/*
$result = mysqli_query($dbServer,$query);

$data = mysqli_fetch_row($result);

echo $data[0];
*/
exit() ;
?>
