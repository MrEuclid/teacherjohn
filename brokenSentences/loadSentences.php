<?php
// loadSentences.php
require_once "../connectTeacherJohn.php"; 

$level = isset($_POST['level']) ? intval($_POST['level']) : 2;
$unit = isset($_POST['unit']) ? $_POST['unit'] : '1';

// Determine how many sentences to pull
if ($level <= 4) { $limit = 4; }
elseif ($level == 5) { $limit = 6; }
else { $limit = 8; }

// Build the secure query based on the selected unit(s)
if ($unit === 'S1') {
    // Units 1 through 4
    $query = "SELECT partA, partB FROM brokenSentences WHERE level = ? AND unit IN ('1','2','3','4') ORDER BY RAND() LIMIT ?";
    $stmt = $dbServer->prepare($query);
    $stmt->bind_param("ii", $level, $limit);
} elseif ($unit === 'S2') {
    // Units 5 through 8
    $query = "SELECT partA, partB FROM brokenSentences WHERE level = ? AND unit IN ('5','6','7','8') ORDER BY RAND() LIMIT ?";
    $stmt = $dbServer->prepare($query);
    $stmt->bind_param("ii", $level, $limit);
} elseif ($unit === 'S12') {
    // All Units
    $query = "SELECT partA, partB FROM brokenSentences WHERE level = ? ORDER BY RAND() LIMIT ?";
    $stmt = $dbServer->prepare($query);
    $stmt->bind_param("ii", $level, $limit);
} else {
    // Single specific unit
    $query = "SELECT partA, partB FROM brokenSentences WHERE level = ? AND unit = ? ORDER BY RAND() LIMIT ?";
    $stmt = $dbServer->prepare($query);
    $stmt->bind_param("isi", $level, $unit, $limit);
}

$stmt->execute();
$result = $stmt->get_result();

$sentencesArray = [];
while ($row = $result->fetch_assoc()) {
    $sentencesArray[] = [
        'partA' => $row['partA'],
        'partB' => $row['partB']
    ];
}

echo json_encode($sentencesArray);
?>