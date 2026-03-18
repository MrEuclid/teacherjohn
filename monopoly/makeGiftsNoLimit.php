<?php

// load team 

 include "../connectTempleDB.php";
 $limit = 18; // teamLimit * gifts = 3 x 6 
 // empty gifts 
 $query = "TRUNCATE TABLE gifts";
  mysqli_query($dbServer,$query);
$output = [];
$gifts = [];
$i = 0;

//for ($games = 1; $games <= 36; $games++) 

//{
$query = "SELECT id,title ,rent,price FROM properties
UNION SELECT id,title,price,rent FROM utilities
UNION SELECT id,title,price,rent FROM airports
ORDER BY RAND() " ; 

// echo "<br>" . $query . "<br>";

$result = mysqli_query($dbServer,$query);

while ($data = mysqli_fetch_assoc($result))
{
	$output[$i] = $data["id"] . "-". $data["title"];
	$gifts[$i][0] = $data["id"];
	$gifts[$i][1] = $data["title"];
	$id = $data["id"];
	$title = $data["title"];
	echo $i . " " . $id  . " " . $title . " " . "<br>";
	$i++;
 
}

 // print_r($output);

//}
  // print_r($gifts);
?>