<?php include "../connectTempleDB.php" ;

$shops = $_POST['shops'] ;
$roundNumber = $_POST['roundNumber'] ;


// echo $l ;
$itemSold = "phone" ;

/*
$shops = array(
    [600, 0, 10, 48],
    [700, 0, 8, 49],
    [800, 0, 7, 50]


) ;

$roundNumber = 1 ;
*/


$l = sizeof($shops) ;
$data = $shops ;



for ($i = 0 ; $i < $l ; $i++)

{
$round = $roundNumber ;
$teamID = $shops[$i][3] ;
$item = $itemSold ;
$number = $shops[$i][2] ;
$sellingPrice = $shops[$i][0] ; 

$query = "INSERT INTO phoneSales (roundNumber,teamID,item,numberSold,sellingPrice)  
VALUES ('$round','$teamID','$item','$number','$sellingPrice') " ;
mysqli_query($dbServer,$query) ;

}
/*
echo "$i<br>" ;
echo $query ;
echo "<br>" ;
*/


// now update phoneRounds , currentRound and alienArrivals
$min = 100;
$max = $round*100 ;
$newRound = $round + 1 ;
$aliens = rand($min,$max) ; // aliens between $min and $max 
$query = "INSERT INTO phoneRounds ( currentRound, alienArrivals)
VALUES
('$newRound', '$aliens' )" ; 


 mysqli_query($dbServer,$query) ;
$data = [] ;
$data[0] = $newRound ;
$data[1] = $aliens; 
echo json_encode($data) ;

mysqli_close($dbServer) ;
?>