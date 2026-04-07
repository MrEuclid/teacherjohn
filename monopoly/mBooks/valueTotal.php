<?php

// load team 
include "../../connectTeacherJohn.php";

// Make sure to include our new helper function at the top
include "make_json_from_query.php"; 

// $studentID = '3524'; 
$studentID =  $_REQUEST['studentID'];
$cnt = 0;

// 1. Create the temporary table and execute it immediately
$tempQuery = "CREATE TEMPORARY TABLE transList as 
SELECT  id, studentID, linkedAccount, amount as cash,
(case when substr(linkedAccount,1,1) = '1' AND linkedAccount <> '101' then linkedAmount else 0 end) as realEstate,
case when substr(linkedAccount,1,1) = '2' then linkedAmount else 0 end as liabilities,
case when substr(linkedAccount,1,1) = '4' then linkedAmount else 0 end as income,
case when substr(linkedAccount,1,1) = '5' then linkedAmount else 0 end as expenses,
(case when substr(linkedAccount,1,1) = '4' then linkedAmount else 0 end) - 
(case when substr(linkedAccount,1,1) = '5' then linkedAmount else 0 end) as profit
FROM mbooksJournal WHERE studentID = '$studentID'
ORDER BY id;";

mysqli_query($dbServer, $tempQuery);


// 2. Prepare the final SELECT query for the chart data
// (I used the last SELECT query from your original script, which calculates the running totals)
$chartQuery = "SELECT 
    @cnt := @cnt + 1 AS `row`, 
    @running_total := @running_total + (m.cash + m.realEstate - m.liabilities) AS value, 
    @cash_total := @cash_total + m.cash AS cash, 
    @real_total := @real_total + m.realEstate AS property 
FROM 
    transList m
CROSS JOIN 
    (SELECT @running_total := 0, @cnt := 0, @cash_total := 0, @real_total := 0) AS init 
ORDER BY 
    m.studentID, m.id;";


// 3. Call the new function and echo the result
echo getGoogleChartsJson($dbServer, $chartQuery);

exit();
?>
