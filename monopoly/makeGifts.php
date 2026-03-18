<?php

// load team 

 include "../connectTempleDB.php";

 // empty gifts 
 $query = "TRUNCATE TABLE gifts";
  mysqli_query($dbServer,$query);

$limit = 18; // teamLimit * gifts = 3 x 6 

$query = "SELECT id,title FROM properties
UNION SELECT id,title FROM utilities
UNION SELECT id,title FROM airports
ORDER BY RAND() LIMIT  " . $limit ; 


// echo "<br>" . $query . "<br>";

$result = mysqli_query($dbServer,$query);
$n = mysqli_num_rows($result) ;

// echo "rows " .$n . "<br>";

$output = [];
$gifts = [];
$i = 0;
$n = mysqli_num_rows($result);
// echo " rows " . $n ;
while ($data = mysqli_fetch_assoc($result))
{
	$output[$i] = $data["id"] . "-". $data["title"];
	$gifts[$i][0] = $data["id"];
	$gifts[$i][1] = $data["title"];
	$id = $data["id"];
	$title = $data["title"];
	//echo $i . " " . $id  . " " . $title . " " . "<br>";
	$i++;
 // 
}
 //print_r($gifts);
// print_r($output);
// now put $gifts inot gifts table
$cnt = 0 ;
$l = count($gifts);
// echo $l;
for ($i = 0; $i < $l ; $i++) {

	//print_r($gifts[$i]);
 	// echo "<br>";
	

	$id = $gifts[$i][0];
 	$title = $gifts[$i][1];
	
//	echo $i . " " .  $id  . " " . $title . " " . "<br>";
 	$query = "INSERT INTO gifts (id,title) VALUES ('$id', '$title') ";
	mysqli_query($dbServer,$query);
 //	echo "<br>" . $query . "<br>";

 

 
 
}
	
// $query = "SELECT * FROM gifts ORDER BY id ";
 // include "print_query_data_plain.php";


?>