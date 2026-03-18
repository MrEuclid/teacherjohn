<?php

// load team 

 include "../connectTempleDB.php";


 $id = $_POST['id'];
 
 // $id = 133;

$query = "SELECT * FROM mbooksJournal WHERE id = '$id' ";

$result = mysqli_query($dbServer,$query);

$data = mysqli_fetch_assoc($result);
// print_r($data);

$studentID = $data['studentID'];
$newAmount = -$data['amount'];
$newLinkedAmount = -$data['linkedAmount'];
$date = $data['date'];
$linkedAccount = $data['linkedAccount'] ;
$note = 'Reverse -' .  $data['notes'];
// echo $newAmount . ' ' . $newLinkedAmount;

$query = "INSERT INTO mbooksJournal
(date,studentID,amount,linkedAccount,linkedAmount,notes)
VALUES
('$date','$studentID','$newAmount','$linkedAccount','$newLinkedAmount','$note')";
mysqli_query($dbServer,$query);
 echo  $query ;

exit() ;
?>
