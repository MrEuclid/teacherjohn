<?php

// load team 

 include "../connectTempleDB.php";


 $id = $_POST['id'];
 $amount = $_POST['amount'];
 $linkedAccount = $_POST['linkedAccount'];
$linkedAmount = $_POST['linkedAmount'];
$notes = $_POST['notes'];
/*
 $id = 1;
 $oldTeam = '11A-3';
 $newTeam = '11A-' ;
*/


$query = "UPDATE  mbooksJournal
SET amount = '$amount',
		linkedAccount = '$linkedAccount' ,
		linkedAmount = '$linkedAmount' ,
		notes = '$notes'
WHERE id = '$id'  "  ;
 echo "<br>" . $query . "<br>";
mysqli_query($dbServer,$query);


exit() ;
?>