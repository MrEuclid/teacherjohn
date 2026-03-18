
<?php

// includes gameID and sorts by htat before sorting by value
// clists transactions
// filter by gameID

 include "../connectTempleDB.php";

 // $studentID = 1338;
 $output =[];



$query = "SELECT mBooksRegistration.id, playerID, concat(familyName,' ',firstName) AS playerName,gameID 
FROM mBooksRegistration
JOIN studentsPIO 
ON mBooksRegistration.playerID = studentsPIO.studentID " ;

// echo "<br>" . $query . "<br>";
// $result = mysqli_query($dbServer,$query);
// include "print_query_data_plain.php" ;

include "make_json_from_query.php";

?>

