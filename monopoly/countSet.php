<?php

// count properties owned of the same color

 include "../connectTempleDB.php";

    /* 
 $id = $_POST['id'];
 $team = $_POST['team']   ; 
 $game = $_POST['game']; 
  */



 $id = 4;

 $team = "john"   ; 
 $game = 13;   
 $color = "brown";

 // get color form properties for this id 
 // houses first 
$airports = [5,15,25,35];
$utilities = [12,28];

if (!in_array($id, $airports))
	{
		//echo "Not airport";
	}

if (!in_array($id, $utilities))
	{
		// echo "Not utility";
	}

$query = "SELECT  propertyRegister.square
            FROM propertyRegister 
            JOIN allTitles ON 
            propertyRegister.square = allTitles.id
            JOIN properties ON properties.id = allTitles.id
            WHERE  game = '$game'  
            AND color = '$color' 
            AND team = '$team' "; 
$result = mysqli_query($dbServer,$query);

// echo "<br>" . $query . "<br>" ;
$cnt = mysqli_num_rows($result);


// count other owned propertie sof the same color

echo $cnt;


exit() ;
?>
