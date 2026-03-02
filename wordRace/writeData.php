<?php 
require_once "../connectTeacherJohn.php";

$team = isset($_POST['team']) ? trim($_POST['team']) : '';
$word = isset($_POST['word']) ? strtolower(trim($_POST['word'])) : '';

if (!empty($team) && !empty($word)) {
    // Secure insertion to prevent SQL injection
    $query = "INSERT INTO countDownResults (team, word) VALUES (?, ?)";
    $stmt = $dbServer->prepare($query);
    $stmt->bind_param("ss", $team, $word);
    $stmt->execute();
    echo "Success";
} else {
    echo "Invalid input";
}
?>