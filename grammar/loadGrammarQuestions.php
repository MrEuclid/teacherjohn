<?php
require_once "../connectTeacherJohn.php";

// Safely grab the level from the POST request (defaults to '2' if missing)
$level = isset($_POST['level']) ? $_POST['level'] : '2';

// Secure Prepared Statement to prevent SQL injection
// We bind $level as a string ("s") since it is being compared to a substring
$query = "SELECT * FROM grammar_test_content 
          WHERE substr(test_id,2,1) = ? 
          AND test_id NOT IN (select test_id FROM comprehension_text) 
          AND test_id NOT LIKE '%ompre%' 
          ORDER BY RAND()";

$stmt = $dbServer->prepare($query);
$stmt->bind_param("s", $level);
$stmt->execute();
$result = $stmt->get_result();

$myData = [];
// Use MYSQLI_NUM to return a simple numbered array matching your old code's structure
while ($row = $result->fetch_array(MYSQLI_NUM)) {
    $myData[] = $row;
}

echo json_encode($myData);
?>