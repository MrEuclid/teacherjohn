<?php

// load team 

 include "../connectTempleDB.php";

// $studentID = '5627';

$studentID = $_REQUEST['studentID'];

$cnt = 0;
$output = []; 

//    m.studentID,
 //   m.id,

$query = " SELECT
	@cnt := @cnt + 1 as row,
 
    @running_total := @running_total + m.amount AS cash
   
FROM
    mbooksJournal m,
    (SELECT @running_total := 0) AS initial_total,
    (SELECT @cnt := 0) as cnt
    WHERE studentID = '$studentID'
    AND  m.linkedAccount = '101'
ORDER BY
    m.studentID, m.id;" ;
    
include "make_json_from_query.php";
    
 

exit() ;
?>
