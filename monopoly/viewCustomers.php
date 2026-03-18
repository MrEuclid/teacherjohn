 <?php
 include "../connectTempleDB.php";

 $game = $_POST['game'];

 if ($game > 0)
{
	$query = "SELECT * FROM customers WHERE game = '$game' ORDER BY teamName ASC";	
}
else
{
	$query = "SELECT * FROM customers ORDER BY game DESC, teamName ASC";
}
// $result - mysqli_query($dbServer,$query);
// echo "<br>" . $query . "<br>";

include "print_query_data_plain.php" ;

exit();
?>