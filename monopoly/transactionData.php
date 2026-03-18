
<?php

// includes gameID and sorts by htat before sorting by value
// clists transactions
// filter by gameID

 include "../connectTempleDB.php";

 // $studentID = 1338;
 $output =[];

 $query = "SELECT 
mbooksJournal.id,
gameID,mbooksJournal.studentID as student,
amount,
linkedAccount,
linkedAmount,
notes

FROM mbooksJournal


JOIN mBooksRegistration ON mbooksJournal.studentID = playerID

ORDER BY gameID, mbooksJournal.id DESC";

/*

$query = "SELECT 

mbooksJournal.id,
gameID,studentsPIO.studentID,concat(familyName,' ',firstName) as name,
amount,
linkedAccount,
linkedAmount,
notes

FROM mbooksJournal
JOIN studentsPIO 
ON studentsPIO.studentID = mbooksJournal.studentID 
JOIN mBooksRegistration ON studentsPIO.studentID = playerID

ORDER BY gameID, mbooksJournal.id DESC " ;
*/
// JOIN mBooksRegistration ON studentsPIO.studentID = playerID

// echo "<br>" . $query . "<br>";
// $result = mysqli_query($dbServer,$query);
// include "print_query_data_plain.php" ;

include "make_json_from_query.php";

?>

