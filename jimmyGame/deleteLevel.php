<?php
require_once "../connectTeacherJohn.php";

$level = isset($_POST['level']) ? $_POST['level'] : null;
$pass = isset($_POST['pass']) ? $_POST['pass'] : null;

// Explicitly check that $level is not null (so '0' is allowed)
if ($level !== null && $pass === 'pythagoras') {
    $cleanLevel = $dbServer->real_escape_string($level);
    $gradeDisplay = (int)$cleanLevel + 2;
    
    $sql = "DELETE FROM jimmy WHERE level = '$cleanLevel'";
    
    if ($dbServer->query($sql)) {
        echo "Successfully cleared all data for Grade $gradeDisplay.";
    } else {
        echo "Database error occurred.";
    }
} else {
    echo "Authorization failed: Incorrect password or level not selected.";
}
?>