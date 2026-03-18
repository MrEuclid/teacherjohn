<?php

// load team 

 include "../connectTempleDB.php";

//  $studentID = '5627';

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

mysqli_query($dbServer,$query);

 $query = "SELECT * FROM transList WHERE studentID = '$studentID' ";

// include "print_query_data_plain.php";

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

 //include "print_query_data_plain.php";


$query = " SELECT
    @cnt := @cnt + 1 as row,
 
    @running_total := @running_total + 
    (m.cash + m.realEstate  - m.liabilities  ) AS value,
    @cash_total  := @cash_total + m.cash  AS cash,
    @real_total := @real_total + m.realEstate as property
FROM
    transList  m,
    (SELECT @running_total := 0) AS initial_total,
    (SELECT @cnt := 0) as cnt,
    (SELECT @cash_total  := 0) AS cash,
     (SELECT @real_total  := 0) AS real_estate
 
ORDER BY
    m.studentID, m.id;" ;


    
include "make_json_from_query.php";
    
    
 // include "make_json_from_query.php";
    


exit() ;
?>
