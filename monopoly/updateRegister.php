<?php

// load team 

 include "../connectTempleDB.php";
  
 
 	$action = $_POST['action'];
 	$square = $_POST['square'];
 	$title = $_POST['site'];
 	$game = $_POST['game'];
	$team = $_POST['team'];
	$purchasePrice = $_POST['amount'];
 	$comment = $_POST['comment'];


 /*
$action = "Buying";
$square = 31 ;
$title= "Toronto";
$game = 1; 
$team = 'alpha';
$purchasePrice  = 3000;
$comment = 'purchase';
	*/	
//echo $title;

$found = "";

$query = "SELECT * FROM propertyRegister 
WHERE team = '$team' AND game = '$game'  AND title = '$title' ";
$result = mysqli_query($dbServer,$query);
$n = mysqli_num_rows($result);
// echo $n . "<br>";

if ($n == 0){$found = "N";} else {$found = "Y";}
// update the register with a new entry 
// echo $n . "found  " .$found . "<br>";
IF($action == "Buying" and $found == "N")
{
$query = "INSERT INTO propertyRegister
						(square,title, purchasePrice,team,game,comment)
						VALUES (
												'$square',
												'$title',
												'$purchasePrice',
												'$team',
												'$game',
												'$comment'
								)" ;



// echo "<br>" . $query . "<br>";

 $result = mysqli_query($dbServer,$query);
echo "Purchase-OK";

}

IF($action == "Buying" and $found == "Y")
{
	echo "Purchase-NO";
}
/*
IF($action == "Selling")
{
// delete from the property register as the property has been returned to the bank
$query = "DELETE FROM  propertyRegister
						WHERE game = '$game' AND square = '$square'" ;



 //echo "<br>" . $query . "<br>";

 $result = mysqli_query($dbServer,$query);
echo "DeletedO-OK";

}
*/
exit() ;
?>