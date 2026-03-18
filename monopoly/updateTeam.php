<?php

// load team 

 include "../connectTempleDB.php";


 $id = $_POST['id'];
 $oldTeam = $_POST['oldTeam'];
 $newTeam = $_POST['newTeam'];

/*
 $id = 1;
 $oldTeam = '11A-3';
 $newTeam = '11A-' ;
*/

 if (strlen($newTeam) == 5)
{
$query = "UPDATE  mBooksRegistration
SET gameID = '$newTeam'
WHERE id = '$id'  "  ;
 echo "<br>" . $query . "<br>";
mysqli_query($dbServer,$query);

echo "Y";
}

else 
	{echo "N";}
exit() ;
?>