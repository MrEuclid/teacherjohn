   <?php
   include "../connectTempleDB.php";

 
   $game = $_POST['game'];

 // $game = 26;

 $query = "SELECT * FROM transactions WHERE  game = '$game' 

 ORDER BY team,date DESC"; 

 include "print_query_data_plain.php";
exit();
 ?>
   