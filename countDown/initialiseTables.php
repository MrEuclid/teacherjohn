<?php

include "../connectTempleDB.php" ;

$rounds = 10 ;
$phones = 3 ;
$teams = 12 ;

$query = "TRUNCATE phoneTeams";
$result = mysqli_query($dbServer,$query) ;

echo "<br>" . $query . "<br>" ;

for ($i = 1 ; $i <= 12 ; $i++)
{
	$teamName = 'PIO' . $i ;
	$query = "INSERT INTO phoneTeams (teamName) VALUES  ('$teamName')" ;
	mysqli_query($dbServer,$query);
}

$query = "TRUNCATE phonePlayers";
$result = mysqli_query($dbServer,$query) ;



$query = "TRUNCATE phonePurchases";
$result = mysqli_query($dbServer,$query) ;

echo "<br>" . $query . "<br>" ;

// set purchases to zero 

for ($roundNumber = 1 ; $roundNumber <= $rounds ; $roundNumber++)
{
	for ($teamID = 1 ; $teamID <= $teams ; $teamID++)
{
		for ($phoneID = 1 ; $phoneID <= $phones ; $phoneID++)
{
			$numberBought = 0;

$query = "INSERT INTO phonePurchases (roundNumber,teamID,phoneID,numberBought)
VALUES  ('$roundNumber', '$teamID', '$phoneID','$numberBought')" ;
mysqli_query($dbServer,$query);

echo "<br>" . $query . "<br>" ;

}
}
}

$query = "TRUNCATE phoneSales";
$result = mysqli_query($dbServer,$query) ;

// set purchases to zero 

for ($roundNumber = 1 ; $roundNumber <= $rounds ; $roundNumber++)
{
	for ($teamID = 1 ; $teamID <= $teams ; $teamID++)
{
		for ($phoneID = 1 ; $phoneID <= $phones ; $phoneID++)
{
			$numberSold = 0;
			$sellingPrice = 0 ;

$query = "INSERT INTO phoneSales(roundNumber,teamID,phoneID,numberSold, sellingPrice)
VALUES  ('$roundNumber', '$teamID', '$phoneID','$numberSold', '$sellingPrice')" ;
mysqli_query($dbServer,$query);

echo "<br>" . $query . "<br>" ;
}
}
}

?>