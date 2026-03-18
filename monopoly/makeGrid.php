
<html>
<head>
<meta http-equiv="refresh" content="5" >

</head>

<?php

// calculate A,L,I,E,C , profit and worth

 include "../connectTempleDB.php";

 // $studentID = 1338;
 $output =[];



$query = "SELECT studentsPIO.studentID,concat(familyName,' ',firstName) as name,
sum(amount) + sum(COALESCE(case when substr(linkedAccount,1,1) = 1 then linkedAmount end,0)) - 
sum(COALESCE(case when substr(linkedAccount,1,1) = 2 then linkedAmount end,0)) as value,


sum(amount) as cash,
sum(amount) + sum(COALESCE(case when substr(linkedAccount,1,1) = 1 then linkedAmount end,0)) as assets,
sum(COALESCE(case when substr(linkedAccount,1,1) = 2 then linkedAmount end,0)) as liabilities,



sum(COALESCE(case when substr(linkedAccount,1,1) = 4 then linkedAmount end,0)) as income,
sum(COALESCE(case when substr(linkedAccount,1,1) = 5 then linkedAmount end,0)) as expenses,
sum(COALESCE(case when substr(linkedAccount,1,1) = 4 then linkedAmount end,0)) - 
sum(COALESCE(case when substr(linkedAccount,1,1) = 5 then linkedAmount end,0)) as profit

FROM mbooksJournal
JOIN studentsPIO 
ON studentsPIO.studentID = mbooksJournal.studentID 
AND studentsPIO.studentID IN (SELECT studentID FROM studentsPIO WHERE grade = 'G11A')
GROUP BY mbooksJournal.studentID 
ORDER BY value DESC  , assets DESC, profit DESC" ;

// echo "<br>" . $query . "<br>";
$result = mysqli_query($dbServer,$query);
include "print_query_data_plain.php" ;


?>
<a href = "https://docs.google.com/spreadsheets/d/1LohhCf7kO_TvrtSqymSIl53SQ9b7zkpvjqVmE7YX5ns/edit?usp=sharing" target = "_blank">
Results </a>

<?
exit() ;

?>

</html>
