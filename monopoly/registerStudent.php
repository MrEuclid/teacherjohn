<?php


 include "../connectTempleDB.php";

 $playerID = $_REQUEST['playerID'];
 $gameID = $_REQUEST['gameID'];

// $playerID = 4936;
// $gameID = '11B-2';

 // put values in to mBooksRegistration
 // but only if studentID not there

 // $query = "SELECT * FROM mBooksRegistration 
 // 	WHERE playerID = '$playerID' AND  gameID = '$gameID' ";
 
 // if student id thee that is enough so don't add recird
  $query = "SELECT * FROM mBooksRegistration 
 	WHERE playerID = '$playerID'  ";
 	$result = mysqli_query($dbServer,$query);

 $n = mysqli_num_rows($result);
// echo "Rows = " . $n ;

 if ($n == 0)
 {
 	$query = "INSERT INTO mBooksRegistration (playerID , gameID) 
 				VALUEs 
 				(
 					'$playerID', '$gameID' 
 				)" ;
 
// echo "<br>" . $query . "<br>";
mysqli_query($dbServer,$query);
echo "Y";
}
else 
{
	echo "N";
}


exit() ;
?>
