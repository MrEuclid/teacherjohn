<?php


 include "../connectTempleDB.php";

// $studentID = 12345;

 
$output = [];
$cnt = 0;

$x = 'bank11A-';
$y = 'bank11B-' ;

for ($i = 1; $i <= 8 ; $i++)
	{
		$output[$i-1]  = $x . $i ;
	}
	
for ($i = 9; $i <= 16 ; $i++)
	{
		$output[$i-1]  = $y . $i -9;
	}

$cnt = 8;




echo json_encode($output);



exit() ;
?>
