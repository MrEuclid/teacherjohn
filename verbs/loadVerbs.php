<?php
require_once "../connectTeacherJohn.php";

// Pulls the entire list of verbs randomized
$query = "SELECT * FROM irregularVerbs ORDER BY RAND()";
$result = $dbServer->query($query);

$output = [];
// Using MYSQLI_NUM ensures we just get the raw values without column names
while ($data = $result->fetch_array(MYSQLI_NUM)) {
    $output[] = $data;
}

echo json_encode($output);
?>