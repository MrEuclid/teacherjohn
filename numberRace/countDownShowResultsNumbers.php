<?php
include "../connectTeacherJohn.php" ;

$query = "SELECT team, count(team) AS equations, sum(score) AS total 
          FROM `countDownNumberResults` 
          GROUP BY team 
          ORDER BY total DESC";

$result = mysqli_query($dbServer, $query);
$output = [];

if ($result) {
    while ($data = mysqli_fetch_assoc($result)) {
        $output[] = $data;
    }
}

// Ensure the browser knows we are sending JSON
header('Content-Type: application/json');
echo json_encode($output);

mysqli_close($dbServer) ;
?>