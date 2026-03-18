<?php



 include "../connectTempleDB.php";
// generate 3 teams for 6 games

// remove all costomers except the bank 
 $query = "TRUNCATE customers ";
 mysqli_query($dbServer,$query);

 $query = "TRUNCATE transactions";
 mysqli_query($dbServer,$query);

 $query = "TRUNCATE messages";
 mysqli_query($dbServer,$query);

  $query = "TRUNCATE propertyRegister";
 mysqli_query($dbServer,$query);

echo "All tables cleared";

exit();


?>