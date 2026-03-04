<?php
include "../connectTeacherJohn.php";

$level = isset($_POST['level']) ? intval($_POST['level']) : 2;
$items = ($level <= 3) ? 5 : 10; // Load 5 words for lower grades, 10 for higher

if ($level == 1) { $lower = 1; $upper = 1; } 
elseif ($level == 2) { $lower = 1; $upper = 2; } 
elseif ($level == 3) { $lower = 1; $upper = 3; } 
else { 
    $lower = max(1, $level - 2); 
    $upper = $level + 2; 
}

$query = "SELECT id, khmer, word FROM translate WHERE level >= ? AND level <= ? ORDER BY RAND() LIMIT ?";
$stmt = $dbServer->prepare($query);
$stmt->bind_param("iii", $lower, $upper, $items);
$stmt->execute();
$result = $stmt->get_result();

$output = [];
while ($row = $result->fetch_assoc()) {
    $output[] = $row;
}

header('Content-Type: application/json');
echo json_encode($output);

$stmt->close();
mysqli_close($dbServer);
?>