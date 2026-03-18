<?php

// load team 

 include "../connectTempleDB.php";

$query = "SELECT * FROM  mbooksJournal";

$result = mysqli_query($dbServer,$query);
$n1 = mysqli_num_rows($result);
 //echo $n1;

 /*
 $studentID = 4936;
 

 $note = 'rent dubai';
 $amount = 80   ;   
  $linkedAccount = 401   ;
  $linkedAmount = 80 ;
*/
 $date = date("Y-m-d");
 $studentID = $_POST['studentID'];
 $note = $_POST['comment'];
 $amount = $_POST['amount']   ;   
  $linkedAccount = $_POST['accountCode']   ;
  $linkedAmount = $_POST['linked']  ;


 $query = "INSERT INTO mbooksJournal
 	(date,studentID,amount,linkedAccount,linkedAmount,notes)
VALUES
(
'$date',
'$studentID',
'$amount',
'$linkedAccount',
'$linkedAmount',
'$note'
)";

// echo "<br>" . $query . "<br>";

$result = mysqli_query($dbServer,$query);


$query = "SELECT * FROM  mbooksJournal";

$result = mysqli_query($dbServer,$query);
$n2 = mysqli_num_rows($result);

$n = $n2 - $n1;  // =1 if row added else = 0
// echo $n2;
echo $n;

exit() ;

?>