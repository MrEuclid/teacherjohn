<?php 
//  $team = "beta" ;
// $game = 13;

 $game = $_GET['game'];
$file = $game . "_register.xls";

 header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment;Filename=".$file);
// property register for the game
 include "../connectTempleDB.php";


// echo $team . $game ;

// $team = $_POST['team'];





?>

<head>
<title>Export to Excel</title>

</head>
<body>

<?php


$query = "SELECT * FROM propertyRegister WHERE  game = '$game' ";
 
 // echo "<br>" . $query . "<br>";

  include "print_query_data_plain.php" ;


?>

</body>
</html>



