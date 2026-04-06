<?php

// load team 

 include "../../connectTeacherJohn.php";

  //$studentID = '4937';

 $studentID = $_REQUEST['studentID'];

$cnt = 0;
$output = []; 

// $query = "SELECT sum(ABS(linkedAmount)) FROM `mbooksJournal` WHERE studentID = '$studentID' 
// AND  substr(linkedAccount,1,1) = 1";

//    m.studentID,
 //   m.id,

// create temporary table 
$query = "CREATE TEMPORARY TABLE transList as 
SELECT  id , studentID,linkedAccount, amount as cash,
(case when substr(linkedAccount,1,1) = 1 AND linkedAccount <> 101 then linkedAmount else 0 end ) as realEstate,
case when substr(linkedAccount,1,1) = 2 then linkedAmount else 0 end as liabilities,
case when substr(linkedAccount,1,1) = 4 then linkedAmount else 0 end as income,
case when substr(linkedAccount,1,1) = 5 then linkedAmount else 0 end as expenses,
(case when substr(linkedAccount,1,1) = 4 then linkedAmount else 0 end) - 
(case when substr(linkedAccount,1,1) = 5 then linkedAmount else 0 end)  as profit


FROM mbooksJournal WHERE studentID = '$studentID'
ORDER BY id ";
// echo "br>" . $query . "<br>" ;
mysqli_query($dbServer,$query);

 $query = "SELECT * FROM transList WHERE studentID = '$studentID' ";

 

$query = "SELECT
    t1.id,
    t1.cash,
    @running_total_cash := @running_total_cash + t1.cash AS cash,
    t1.realEstate,
    @running_total_realEstate := @running_total_realEstate + t1.realEstate AS realEstate,
    t1.liabilities,
    @running_total_liabilities := @running_total_liabilities + t1.liabilities AS liabilities,
    t1.profit,
    @running_total_profit := @running_total_profit + t1.profit AS profit
FROM
    transList AS t1,
    (SELECT @running_total_cash := 0, @running_total_realEstate := 0, @running_total_liabilities := 0, @runninng_total_profit) AS initial_vars

WHERE t1.studentID = '$studentID' 
ORDER BY
    t1.id " ;

 // echo "<br>" . $query . "<br>";




$query = " CREATE TEMPORARY TABLE transList as SELECT id , studentID,linkedAccount, amount as cash, (case when substr(linkedAccount,1,1) = 1 AND linkedAccount <> 101 then linkedAmount else 0 end ) as realEstate, case when substr(linkedAccount,1,1) = 2 then linkedAmount else 0 end as liabilities, case when substr(linkedAccount,1,1) = 4 then linkedAmount else 0 end as income, case when substr(linkedAccount,1,1) = 5 then linkedAmount else 0 end as expenses, (case when substr(linkedAccount,1,1) = 4 then linkedAmount else 0 end) - (case when substr(linkedAccount,1,1) = 5 then linkedAmount else 0 end) as profit FROM mbooksJournal WHERE studentID = '4937' ORDER BY id;

SELECT 
    t1.id, 
    t1.cash AS trans_cash, 
    @running_total_cash := @running_total_cash + t1.cash AS running_cash, 
    t1.realEstate AS trans_realEstate, 
    @running_total_realEstate := @running_total_realEstate + t1.realEstate AS running_realEstate, 
    t1.liabilities AS trans_liabilities, 
    @running_total_liabilities := @running_total_liabilities + t1.liabilities AS running_liabilities, 
    t1.profit AS trans_profit, 
    @running_total_profit := @running_total_profit + t1.profit AS running_profit 
FROM 
    transList AS t1, 
    (SELECT 
        @running_total_cash := 0, 
        @running_total_realEstate := 0, 
        @running_total_liabilities := 0, 
        @running_total_profit := 0  /* <-- Fixed here */
    ) AS initial_vars 
WHERE 
    t1.studentID = '4937' 
ORDER BY 
    t1.id;
SELECT 
    @cnt := @cnt + 1 AS `row`, 
    @running_total := @running_total + (m.cash + m.realEstate - m.liabilities) AS value, 
    @cash_total := @cash_total + m.cash AS cash, 
    @real_total := @real_total + m.realEstate AS property 
FROM 
    transList m
CROSS JOIN 
    (SELECT @running_total := 0, @cnt := 0, @cash_total := 0, @real_total := 0) AS init 
ORDER BY 
    m.studentID, m.id;" ;

// echo "<br>" . $query . "<br>";

 include "../../make_json_from_query.php";
    
    
  // include "../../print_query_data_plain.php";
    


exit() ;
?>
