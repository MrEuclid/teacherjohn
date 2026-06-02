<?php 
include "../connectTempleDB.php" ;

$query = "SELECT price FROM phoneSellingPriceLevels ORDER BY price ";
$result = mysqli_query($dbServer,$query);
$prices = [] ;
$i = 0;
while ($data = mysqli_fetch_row($result))
{
	
	$prices[$i] = $data[0];
    $i++ ;
}

echo json_encode($prices);
mysqli_close($dbServer);

?>
