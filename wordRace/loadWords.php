<?php 
require_once "../connectTeacherJohn.php";

$query = "SELECT DISTINCT word FROM spellingWords2 ORDER BY word";
$result = $dbServer->query($query);

$output = [];
while ($row = $result->fetch_assoc()) {
    $output[] = strtolower(trim($row["word"]));
}

echo json_encode($output);
?>