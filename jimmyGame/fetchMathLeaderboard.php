<?php
require_once "../connectTeacherJohn.php";

$level = isset($_GET['level']) ? $_GET['level'] : 'all';

$sql = "SELECT 
    user AS team, 
    level, 
    SUM(4*difficulty) AS score, 
    IFNULL(ROUND((MAX(UNIX_TIMESTAMP(submission_time)) - MIN(UNIX_TIMESTAMP(submission_time)))/60, 2), 0.00) AS timeElapsed 
FROM jimmy ";

// Check if level is 'all' or a valid integer string (including '0')
if ($level !== 'all') {
    $cleanLevel = $dbServer->real_escape_string($level);
    $sql .= " WHERE level = '$cleanLevel' ";
}

$sql .= " GROUP BY user, level ORDER BY score DESC, timeElapsed ASC";

$result = $dbServer->query($sql);
$data = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($data);
?>