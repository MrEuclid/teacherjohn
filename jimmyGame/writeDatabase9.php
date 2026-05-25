<?php
// writeDatabase.php
require_once "../connectTeacherJohn.php"; // Or connectTempleDB.php depending on your setup

// Safely grab POST variables
$operation  = isset($_POST['operation']) ? $_POST['operation'] : '';
$difficulty = isset($_POST['difficulty']) ? intval($_POST['difficulty']) : 1;
$userID     = isset($_POST['userName']) ? trim($_POST['userName']) : '';
$level      = isset($_POST['level']) ? intval($_POST['level']) : 1;

if (empty($userID) || empty($operation)) {
    echo "Error: Missing data";
    exit();
}

// 1. Check how many entries exist for this specific combination
$countQuery = "SELECT COUNT(*) as attempts FROM jimmy WHERE operation = ? AND difficulty = ? AND level = ? AND user = ?";
$stmtCount = $dbServer->prepare($countQuery);
$stmtCount->bind_param("siis", $operation, $difficulty, $level, $userID);
$stmtCount->execute();
$resultCount = $stmtCount->get_result();
$row = $resultCount->fetch_assoc();
$n = $row['attempts'];
$stmtCount->close();

// 2. Insert new record if under the limit (limit was 4 in your original code)
if ($n < 4) {
    $insertQuery = "INSERT INTO jimmy (user, operation, difficulty, level) VALUES (?, ?, ?, ?)";
    $stmtInsert = $dbServer->prepare($insertQuery);
    $stmtInsert->bind_param("ssii", $userID, $operation, $difficulty, $level);
    
    if ($stmtInsert->execute()) {
        echo $n + 1; // Return the new count
    } else {
        echo "Error inserting data";
    }
    $stmtInsert->close();
} else {
    echo $n; // Return max count
}

exit();
?>