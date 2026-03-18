 <?php
 include "../connectTempleDB.php";

 // view transactions and the property register

 $game = $_POST['game'];


	$query = "SELECT * FROM propertyRegister WHERE game = '$game' ORDER BY square ASC";	



include "print_query_data_plain.php" ;

exit();
?>