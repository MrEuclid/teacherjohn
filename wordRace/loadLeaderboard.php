<?php
require_once "../connectTeacherJohn.php";

// This query ensures we only calculate unique words per team,
// sums up all the letters for the total score, and sorts by highest score!
$query = "SELECT team, 
                 COUNT(word) as word_count, 
                 SUM(CHAR_LENGTH(word)) as total_score 
          FROM (SELECT DISTINCT team, word FROM countDownResults) as unique_words 
          GROUP BY team 
          ORDER BY total_score DESC, word_count ASC";
          
$result = $dbServer->query($query);

$leaderboard = [];
while ($row = $result->fetch_assoc()) {
    $leaderboard[] = $row;
}

echo json_encode($leaderboard);
?>