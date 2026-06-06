<?php

// 1. Set the response header immediately for robustness
header('Content-Type: application/json');

// 2. Read the raw JSON data from the request body
$json_data = file_get_contents("php://input");
$data = json_decode($json_data, true);

// Check if decoding was successful and data exists
if (empty($data) || !isset($data['student_id']) || !isset($data['current_score'])) {
    http_response_code(400); // Set HTTP status code to Bad Request
    echo json_encode([
        'success' => false,
        'error' => 'Invalid or missing data in request body.'
    ]);
    exit();
}

include "../connectTeacherJohn.php"; // Make sure this connection is successful and stored in $dbServer



// 3. Extract and sanitize variables
// CRITICAL: Use mysqli_real_escape_string to prevent SQL Injection security risks!
$team = mysqli_real_escape_string($dbServer, $data['student_id']);
$score = mysqli_real_escape_string($dbServer, $data['current_score']);

// 4. Execute the query
$query = "SELECT * FROM scrabbleResults WHERE studentID = '$team' ";
$result = mysqli_query($dbServer,$query);
$n = mysqli_num_rows($result);
if ($n >= 1)
{
	$query = "UPDATE scrabbleResults SET score = '$score' WHERE studentID = '$team'";}
else {
	$query = "INSERT INTO scrabbleResults (studentID,score) VALUES ('$team','$score')";
}
if (mysqli_query($dbServer, $query)) {
    // Success response
    $response = [
        'success' => true,
        'message' => "Score ($score) successfully logged for student $team.",
        'student_id' => $team
    ];
} else {
    // Failure response (e.g., database error)
    http_response_code(500);
    $response = [
        'success' => false,
        'error' => 'Database query failed: ' . mysqli_error($dbServer)
    ];
}

echo json_encode($response);

// Close the connection
mysqli_close($dbServer);
?>