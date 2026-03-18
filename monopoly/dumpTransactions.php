<?php 



 // $team = "john" ;
// $game = 13;

// echo $team . $game ;

// $team = $_POST['team'];
 $game = $_GET['game'];

$file = $game  . "_transactions.xls";

 header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment;Filename=".$file);


?>

<head>
<title>Export to Excel</title>

</head>
<body>

<?php

 include "../connectTempleDB.php";
$query = "SELECT * FROM transactions WHERE  game = '$game' ";
 
 // echo "<br>" . $query . "<br>";

  include "print_query_data_plain.php" ;


?>

</body>
</html>



