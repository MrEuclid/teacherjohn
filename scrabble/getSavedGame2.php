<?php
// Set the response header immediately
header('Content-Type: application/json');

// 1. Read the raw JSON data (only contains student_id for loading)
$json_data = file_get_contents("php://input");
$data = json_decode($json_data, true);

if (empty($data) || !isset($data['student_id'])) {
    http_response_code(400); 
    echo json_encode(['success' => false, 'error' => 'Missing student_id in request.']);
    exit();
}

include "../connectTeacherJohn.php"; 

// 2. Extract and sanitize variables
$team = mysqli_real_escape_string($dbServer, $data['student_id']);

// 3. Query the database for the saved data and score
$query = "SELECT score, savedGame FROM scrabbleResults WHERE studentID = '$team'";

$result = mysqli_query($dbServer, $query);

if ($result && $row = mysqli_fetch_assoc($result)) {
    
    // Check if the savedGame field is not empty/null
    if (!empty($row['savedGame'])) {
        $response = [
            'success' => true,
            'score' => $row['score'],
            // Send the raw JSON string back to the client
            'saved_game_state' => $row['savedGame'] 
        ];
    } else {
        // Found studentID but no saved game data (e.g., first login)
        $response = [
            'success' => false,
            'error' => 'No saved game found for this student.',
            'score' => $row['score'],
            'saved_game_state' => null
        ];
    }
} else {
    // Student ID not found in the database
    $response = [
        'success' => false,
        'error' => 'Student ID not found in results table.'
    ];
}

echo json_encode($response);
mysqli_close($dbServer);
?>