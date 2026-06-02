<?php
// Set the response header immediately for robustness
header('Content-Type: application/json');

// 1. Read the raw JSON data from the request body (same as before)
$json_data = file_get_contents("php://input");
$data = json_decode($json_data, true);

// Check if decoding was successful and data exists (same as before)
if (empty($data) || !isset($data['student_id']) || !isset($data['current_score']) || !isset($data['saved_game'])) {
    http_response_code(400); 
    echo json_encode([
        'success' => false,
        'error' => 'Invalid or missing data in request body.'
    ]);
    exit();
}

include "connectTempleDB.php"; 

// 2. Extract and sanitize variables (same as before)
$team = mysqli_real_escape_string($dbServer, $data['student_id']);
$score = mysqli_real_escape_string($dbServer, $data['current_score']);
$saved_game = mysqli_real_escape_string($dbServer, $data['saved_game']); 

// 3. Execute the new UPSERT query
$query = "
    INSERT INTO scrabbleResults (studentID, score, savedGame) 
    VALUES ('$team', '$score', '$saved_game')
    ON DUPLICATE KEY UPDATE 
        score = VALUES(score), 
        savedGame = VALUES(savedGame)
";

if (mysqli_query($dbServer, $query)) {
    // Success response
    $response = [
        'success' => true,
        'message' => "Score ($score) and game state logged successfully for student $team (Upsert completed).",
        'student_id' => $team
    ];
} else {
    // Failure response
    http_response_code(500);
    $response = [
        'success' => false,
        'error' => 'Database query failed: ' . mysqli_error($dbServer)
    ];
}

echo json_encode($response);
mysqli_close($dbServer);
?>