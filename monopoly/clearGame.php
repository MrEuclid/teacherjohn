<?php

$game = $_POST['game'];

 include "../connectTempleDB.php";
// generate 3 teams for 6 games

// remove all costomers except the bank 
 $query = "DELETE FROM customers WHERE game = '$game' ";
 mysqli_query($dbServer,$query);

 $query = "DELETE FROM transactions WHERE game = '$game' ";
 mysqli_query($dbServer,$query);

 $query = "DELETE FROM messages WHERE game = '$game' ";
 mysqli_query($dbServer,$query);

  $query ="DELETE FROM propertyRegister WHERE game = '$game' ";
 mysqli_query($dbServer,$query);

echo "Tables cleared for game " . $game;

exit();


?>