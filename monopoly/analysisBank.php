<?php

// calculate A,L,I,E,C , profit and worth

 include "../connectTempleDB.php";

  $studentID = 'bank11B-2';
 $output =[];

// $studentID = $_POST['studentID'];


$query = "SELECT mbooksJournal.studentID,
sum(COALESCE(case when linkedAccount = 101 then amount end,0)) as cash,
sum(COALESCE(case when substr(linkedAccount,1,1) = 1 then amount end,0)) as assets,
sum(COALESCE(case when substr(linkedAccount,1,1) = 2 then linkedAmount end,0)) as liabilities,
sum(COALESCE(case when substr(linkedAccount,1,1) = 4 then linkedAmount end,0)) as income,
sum(COALESCE(case when substr(linkedAccount,1,1) = 5 then linkedAmount end,0)) as expenses


FROM mbooksJournal

WHERE mbooksJournal.studentID = '$studentID'
GROUP BY mbooksJournal.studentID" ;

echo "<br>" . $query . "<br>";
$result = mysqli_query($dbServer,$query);
while ($data =  mysqli_fetch_assoc($result))
{
  $output[] = $data ;
}

echo json_encode($output);
 //echo $n1;


exit() ;

?>
