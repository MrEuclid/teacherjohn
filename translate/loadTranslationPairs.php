<?php
// loadTranslationPairs.php
require_once "../connectTeacherJohn.php"; 

// Safely get the level from the POST request (default to 2 if missing)
$level = isset($_POST['level']) ? intval($_POST['level']) : 2;

// Determine how many items to return based on the grade level
$items = ($level <= 3) ? 4 : 6;

// Determine the difficulty bounds
// (Fixed the original bug where $level == 4 was repeated multiple times)
if ($level == 1) { 
    $lower = 1; $upper = 1; 
} elseif ($level == 2) { 
    $lower = 1; $upper = 2; 
} elseif ($level == 3) { 
    $lower = 1; $upper = 3; 
} else { 
    // For Grade 4 and above, it creates a sliding window of difficulty!
    // E.g., Grade 5 gets words from levels 3 to 7.
    $lower = max(1, $level - 2); 
    $upper = $level + 2; 
}

// Secure Prepared Statement to prevent SQL injection
$query = "SELECT id, khmer, word FROM translate WHERE level >= ? AND level <= ? ORDER BY RAND() LIMIT ?";
$stmt = $dbServer->prepare($query);
$stmt->bind_param("iii", $lower, $upper, $items);
$stmt->execute();
$result = $stmt->get_result();

$translateArray = [];
while ($row = $result->fetch_assoc()) {
    $translateArray[] = [$row['id'], $row['khmer'], $row['word']];
}

echo json_encode($translateArray);
?>