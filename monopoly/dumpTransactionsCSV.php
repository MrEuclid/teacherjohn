<?php 

 include "../connectTempleDB.php";

  $team = "beta" ;
 $game = 13;

// echo $team . $game ;

// $team = $_POST['team'];
// $game = $_POST['game'];

$file = $game . "_" . $team . "_transactions.xls";

 header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment;Filename=".$file);


?>

<head>
<title>Export to Excel</title>

</head>
<body>

<?php


$query = "SELECT * FROM transactions WHERE team = '$team' AND game = '$game' ";
 
 // echo "<br>" . $query . "<br>";

  include "print_query_data_plain.php" ;


?>

</body>
</html>



