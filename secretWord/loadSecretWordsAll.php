<?php 
require_once "../connectTeacherJohn.php";

$wordLength = 5;

// Your excellent ESL logic: only allow words with no duplicate letters
function uniqueCharacters($str) {
    for($i = 0; $i < strlen($str); $i++) {
        for($j = $i + 1; $j < strlen($str); $j++) {
            if($str[$i] == $str[$j]) {
                return false;
            }
        }
    }
    return true;
}

// Secure query for all 5-letter words
$query = "SELECT DISTINCT UPPER(word) AS word FROM 5Letters WHERE CHAR_LENGTH(word) = ? ORDER BY word";
$stmt = $dbServer->prepare($query);
$stmt->bind_param("i", $wordLength);
$stmt->execute();
$result = $stmt->get_result();

$allWords = [];
$targetWords = [];

while ($data = $result->fetch_assoc()) {
    $word = $data["word"];
    $allWords[] = $word; // Keep all words so students can guess them
    
    // Only put unique-letter words in the target pool
    if (uniqueCharacters($word)) {
        $targetWords[] = $word;
    }
}

// Send both arrays back to the game
echo json_encode([
    'allWords' => $allWords,
    'targetWords' => $targetWords
]);
?>