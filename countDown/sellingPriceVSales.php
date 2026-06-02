<?php // new version

include "../connectTempleDB.php" ;
// compare sellinn price with sales 
// phoneSales
// phonesetSellingPrice
// for one team

// $teamID = $_POST['teamID'] ;
$teamID = 49 ;
$query = "SELECT sum(numberSold) AS sales,sellingPrice
FROM
phoneSales
JOIN phoneTeams
ON phoneTeams.teamID = phoneSales.teamID
GROUP BY sellingPrice
ORDER BY sellingprice" ;

$output = [] ;
$i = 0 ;
$result = mysqli_query($dbServer,$query) ;
while ($data = mysqli_fetch_assoc($result))

{

$output[$i] = $data ;
$i++ ;
}

echo json_encode($output) ;

mysqli_close($dbServer) ;

?>