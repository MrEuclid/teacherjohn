<?php include "../connectTempleDB.php" ;

$data = [] ;

$purchasedItem = $_POST['itemBought'] ;
$roundNumber = $_POST['roundNumber'] ;
$ID = $_POST['teamID'] ;
$numberBought = $_POST['quantity']; 


/*
$purchasedItem = 'phone';
$roundNumber = 0 ;
$ID = 49 ;
$numberBought = 2; 
*/

$data[0] = $purchasedItem ;
$data[1] = $roundNumber ;
$data[2] = $ID;
$data[3] = $numberBought ;

$stmt = $dbServer-> prepare("INSERT INTO phonePurchases (roundNumber,teamID,item,numberBought)  VALUES (?,?,?,?) ") ;
$stmt -> bind_param('iisi',$round,$teamID,$item,$number) ;  

// prepare, bind set parameters and execute in that order

$round = $roundNumber ;
$teamID = $ID ;
$item = $purchasedItem ;
$number = $numberBought ;


$stmt -> execute() ;

echo json_encode($data) ;

mysqli_close($dbServer) ;

?>