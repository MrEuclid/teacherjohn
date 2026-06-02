<?php 
include "../connectTempleDB.php" ;


// teamiD

// selling nprice
// stock
// for this round
$roundNumber= $_POST['roundNumber'];

$myData = [] ;

//$roundNumber = 3 ; // for testing
//$teamID = 48 ; // for testing 
$query = "SELECT teamID FROM phoneSetSellingPrice WHERE roundNumber = '$roundNumber' ORDER BY teamID" ;
$resultq = mysqli_query($dbServer,$query) ;
$i = 0 ;
while ($dataq = mysqli_fetch_row($resultq))

{
	$teamID = $dataq[0] ;


$query = "SELECT count(*) AS N,sum(numberBought) AS bought 
FROM phonePurchases wHERE teamID = '$teamiD'
AND item = 'phone' " ;

$result = mysqli_query($dbServer,$query) ;
$data = mysqli_fetch_row($result);
$n = $data[0] ; 
$bought = $data[1] ;
if ($n == 0 ) {$bought = 0 ;}

$query = "SELECT count(*) AS N,sum(numberSold) AS sold
FROM phoneSales wHERE teamID = '$teamiD'
AND item = 'phone' " ;

$result = mysqli_query($dbServer,$query) ;
$data = mysqli_fetch_row($result);
$n = $data[0] ; 
$sale = $data[1] ;
if ($n == 0 ) {$sold = 0 ;}

$query = "SELECT sellingPrice FROM phoneSetSellingPrice 
WHERE teamID = '$teamID' AND roundNumber = '$roundNumber'" ;
$result = mysqli_query($dbServer,$query) ;
$data = mysqli_fetch_row($result);
$sellingPrice = $data[0] ;

$data = [] ;
$data['stock'] = $bought - $sold ;
$data['sellingPrice'] = $sellingPrice ;
$data['teamID'] = $teamID ;
//echo $i ;
// print_r($data) ;
$myData[] = $data ;

}

echo json_encode($myData) ;
?>