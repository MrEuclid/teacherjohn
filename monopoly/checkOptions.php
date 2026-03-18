<?php

// choices when clicking on a property in the register

 include "../connectTempleDB.php";


 $team = $_POST["team"];
 $square = $_POST['square'];
 $game = $_POST['game'];

/*

 $team = "alpha";
 $game = 8;
 $square = 7;

*/

$query = "SELECT square as id ,title,team FROM propertyRegister 
			WHERE square = '$square' AND  game = '$game' ORDER BY square" ;
// echo "<br>" .$query . "<br>" ;

$result = mysqli_query($dbServer,$query);
$output = [];
$state = "?";
$n = mysqli_num_rows($result);
while ($data = mysqli_fetch_row($result))
{
  $owner = $data[2];
  $title = $data[1];
  $id = $data[0];
}


 //echo  "data ". $owner . " " . $title . " " . $id . "<br>";
if ($team == $owner){$state = "Owned";}
if ($owner == "bank_" . $game ){$state = "Available";}
if ($team <> $owner AND $owner <> "bank_" . $game){$state = "Pay";}
// echo "<br>" . $square . " " . $data["title"] . " owned by " . $owner . " option " . $state . "<br>";

// echo $team . "-" . $owner . "-" . $state;
// echo "<br>" . $n . "<br>";


$query = "SELECT id,price,rent,title FROM everyPlace WHERE id = '$square' ";
$result = mysqli_query($dbServer,$query);
$data = mysqli_fetch_row($result);
$id = $data[0];
$price = $data[1];
$rent = $data[2];
$title2 = $data[3] ;
//print_r($data);


if ($state == "Available")
{

	$string = "Buy" . " " . $id . " " .$title . " for $" . $price . " from " . $owner;
}

if ($state == "Pay")
{

	$string = "Pay $" . $rent . " to " . $owner . " for " . + $id . " " . $title;
}
if ($state == "Owned")
{
	$string = "You own "  . $id . " " . $title ;
}

//$string = str_replace("\r", "", $string);

// $string = str_replace("\n", "", $string);

echo $string;



?>
