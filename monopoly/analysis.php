<?php

// calculate A,L,I,E,C , profit and worth

 include "../connectTempleDB.php";

 // $studentID = 1338;
 $output =[];

 $studentID = $_POST['studentID'];
/*
$query = "SELECT 
(sum(amount) + sum(case when linkedAccount IN (102,103)  then linkedAmount else 0 end)) as assets,
sum(case when substr(linkedAccount,1,1) = 2 then linkedAmount else 0 end) as liabilities,
sum(case when substr(linkedAccount,1,1) = 3 then linkedAmount else 0 end) as equity,
sum(case when substr(linkedAccount,1,1) = 4 then linkedAmount else 0 end) as income,
sum(case when substr(linkedAccount,1,1) = 5 then linkedAmount else 0 end) as expenses

FROM `mbooksJournal` 
WHERE studentID = '$studentID'
GROUP BY studentID;";
*/

$query = "SELECT studentsPIO.*,mbooksJournal.studentID,
sum(COALESCE(amount,0)) as cash,
sum(COALESCE(case when linkedAccount = 102 then linkedAmount end,0)) as land ,
sum(COALESCE(case when linkedAccount = 103 then linkedAmount end,0)) as buildings ,
sum(amount) + sum(COALESCE(case when substr(linkedAccount,1,1) = 1 then linkedAmount end,0)) as assets,

sum(COALESCE(case when linkedAccount = 201 then linkedAmount end,0)) as loans ,
sum(COALESCE(case when substr(linkedAccount,1,1) = 2 then linkedAmount end,0)) as liabilities,

sum(COALESCE(case when linkedAccount = 401 then linkedAmount end,0)) as receive_rent ,
sum(COALESCE(case when linkedAccount = 402 then linkedAmount end,0)) as pass_go ,
sum(COALESCE(case when linkedAccount = 403 then linkedAmount end,0)) as other_income ,
sum(COALESCE(case when substr(linkedAccount,1,1) = 4 then linkedAmount end,0)) as income,

sum(COALESCE(case when linkedAccount = 501 then linkedAmount end,0)) as pay_rent ,
sum(COALESCE(case when linkedAccount = 502 then linkedAmount end,0)) as tax ,
sum(COALESCE(case when linkedAccount = 503 then linkedAmount end,0)) as other_expenses ,
sum(COALESCE(case when substr(linkedAccount,1,1) = 5 then linkedAmount end,0)) as expenses


FROM mbooksJournal
JOIN studentsPIO 
ON studentsPIO.studentID = mbooksJournal.studentID 
AND mbooksJournal.studentID = '$studentID'
GROUP BY mbooksJournal.studentID" ;

$result = mysqli_query($dbServer,$query);
while ($data =  mysqli_fetch_assoc($result))
{
  $output[] = $data ;
}

echo json_encode($output);
 //echo $n1;


exit() ;

?>