<?php
// make pie

  include "../connectTeacherJohn.php";
$output = [];
  $query = "SELECT round(mark,0) as m  FROM  psmarks WHERE mark <= 10
ORDER BY RAND() LIMIT 50; ";
//echo "<br>" . $query . "<br>" ;
 include "make_json_from_query.php";

?>
