<?php // new version

include "../connectTempleDB.php" ;
// calculate team balance over all rounds 0,..,10

  $teamName = $_POST['teamName'];

 //$teamName = 'PIO25' ;

 $query = "SELECT teamID FROM phoneTeams WHERE teamName = '$teamName' " ;
 $result = mysqli_query($dbServer,$query) ;
 $data = mysqli_fetch_row($result) ;
 $teamID = $data[0] ;

 // add aliens and current round 
$query = "SELECT  currentRound,alienArrivals FROM phoneRounds ORDER BY currentRound DESC LIMIT 1" ;
$result = mysqli_query($dbServer,$query);
$data = mysqli_fetch_row($result) ;
$currentRound = $data[0] ;
$aliens = $data[1] ;


 
 // load constants

 $query = "SELECT * FROM phoneConstants" ;
 $result = mysqli_query($dbServer,$query) ;
 $data = mysqli_fetch_assoc($result) ;

  // print_r($data) ;

 $startingCapital = $data['startingCapital'] ;
 $phoneCost = $data['wholesalePrice'] ;
 $roomCost = $data['roomPrice'] ;

 // get phones

$query = "SELECT sum(numberBought) AS phonesBought FROM phonePurchases WHERE item = 'phone' AND teamID = '$teamID' " ;
$result = mysqli_query($dbServer,$query) ;
$data = mysqli_fetch_assoc($result) ;

$phonesBought = $data['phonesBought'] ;

// echo "<br>" . print_r($data) . "<br>" ;

$query = "SELECT count(*) AS N,sum(numberSold) AS phonesSold FROM phoneSales WHERE item = 'phone' AND teamID = '$teamID'" ;
$result = mysqli_query($dbServer,$query) ;
$data = mysqli_fetch_assoc($result) ;

$n = $data['N'] ;
$phonesSold = $data['phonesSold'] ;

if ($n == 0) {$phonesSold = 0 ;}

// get rooms

$query = "SELECT sum(numberBought) AS roomsBought FROM phonePurchases WHERE item = 'room' AND teamID = '$teamID'" ;
$result = mysqli_query($dbServer,$query) ;
$data = mysqli_fetch_assoc($result) ;

$roomsBought = $data['roomsBought'] ;


/*
echo "<br>" . $query . "<br>" ;
 echo "<br>" . print_r($data) . "<br>" ;
*/

$query = "SELECT count(*) AS N, sum(numberSold) AS roomsSold FROM phoneSales WHERE item = 'room' AND teamID = '$teamID'" ;
$result = mysqli_query($dbServer,$query) ;
$data = mysqli_fetch_assoc($result) ;

$roomsSold = $data['roomsSold'] ;
$n = $data['N'] ;
if ($n == 0 ) {$roomsSold = 0 ;}

/*
echo "<br>" . $query . "<br>" ;
echo "<br>" . print_r($data) . "<br>Sold = " .$roomsSold;
*/

$phones = $phonesBought - $phonesSold ;
$rooms = $roomsBought - $roomsSold ;
// income 

$query = "SELECT item, sum(numberSold) AS quantity, sum(numberSold*sellingPrice) AS value

 FROM phoneSales WHERE teamID = '$teamID'
 GROUP BY item ";
$result = mysqli_query($dbServer,$query);

/*
echo "<br>" ;    
echo $query ;
echo "<br>" ;
*/

$totalSales = 0 ;
while ($data = mysqli_fetch_assoc($result))
{

// echo "<br>" ;    
// echo "<br>" ;  

$item = $data['item'] ;
$value = $data['value'] ;
$quantity = $data['quantity'] ;

$totalSales = $totalSales +  $value  ;
// echo $item . "-" . $quantity . "-" . $value . "-" . $totalPurchases ;
}


$query = "SELECT item, sum(numberBought) AS quantity 

 FROM phonePurchases WHERE teamID = '$teamID'
 GROUP BY item ";
$result = mysqli_query($dbServer,$query);

/*
echo "<br>" ;    
echo $query ;
echo "<br>" ;
*/



$totalPurchases = 0 ;
while ($data = mysqli_fetch_assoc($result))
{
// echo "<br>" ;  
$item = $data['item'] ;
$quantity = $data['quantity'] ;
if ($item == 'phone') {$value = $phoneCost;}
if ($item == 'room') {$value = $roomCost;}
$totalPurchases = $totalPurchases +  $value * $quantity ;
// echo $item . "-" . $quantity . "-" . $value . "-" . $totalPurchases ;
// echo "<br>" ;
}

$balance = $startingCapital + ($totalSales - $totalPurchases) ;
$output = [] ;
$output['currentRound'] = $currentRound ;
$output['aliens'] = $aliens ;
$output['ourTeamID'] = $teamID ; // update ourTeamID box
$output['income'] = $totalSales ;
$output["expenditure"] = $totalPurchases ;
$output['capital'] = $startingCapital;
$output['phones'] = $phones ;
$output['rooms'] = $rooms ;
$output['balance'] = $balance ;


echo json_encode($output) ;
mysqli_close($dbServer) ;


?>