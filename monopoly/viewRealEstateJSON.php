   <?php
   include "../connectTempleDB.php";

 // $team = $_POST['team'];
 $game = $_POST['game'];

// $team = "alpha";
// $game = 1; 

  // make a list of all properties

/*
 $query = "SELECT square,propertyRegister.title,purchasePrice,team,houses,propertyRegister.hotel,mortgaged ,rent
            FROM propertyRegister 
            JOIN allTitles ON 
            propertyRegister.square = allTitles.id
            WHERE  game = '$game' 
            ORDER BY square,team "; 
*/
 
// add color field
            
$query = "SELECT color,square,propertyRegister.title,purchasePrice,team,houses,propertyRegister.hotel,mortgaged ,allTitles.rent
            FROM propertyRegister 
            JOIN allTitles ON 
            propertyRegister.square = allTitles.id
            JOIN properties ON properties.id = allTitles.id
            WHERE  game = '$game'  
              ORDER BY square,team "; 

$query = "SELECT allTitles.color,square,propertyRegister.title,purchasePrice,team,houses,propertyRegister.hotel,mortgaged ,allTitles.rent
            FROM propertyRegister 
            JOIN allTitles ON 
            propertyRegister.square = allTitles.id
     
            WHERE  game = '$game'
              ORDER BY square,team ";

 $result = mysqli_query($dbServer,$query);

$output = [];
$i = 0;
// $n = mysqli_num_rows($result);
// echo " rows " . $n ;
while ($data = mysqli_fetch_assoc($result))
{
  $output[$i] = $data;
//  echo $i . $output[$i];
  $i++;

}

echo json_encode($output);


?>