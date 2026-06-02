<?php
// Set headers for CORS and JSON response
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$response = [
    'success' => false,
    'message' => 'An unknown error occurred.',
];

// --- 1. Database Connection ---
$server = 'localhost' ;
$username = 'teacherj_euclid';
$password = 'puthisastra2024' ;
$database = 'teacherj_temple' ; // Assuming the scores/game state are in 'teacherj_temple'

$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn) {
    $response['message'] = 'Database connection failed: ' . mysqli_connect_error();
    echo json_encode($response);
    exit;
}

// --- 2. Get Data from POST Request ---
$input = file_get_contents('php://input');
$data = json_decode($input, true);

$student_id = isset($data['student_id']) ? $data['student_id'] : null;

if (empty($student_id)) {
    $response['message'] = 'Invalid or missing student ID.';
    $conn->close();
    echo json_encode($response);
    exit;
}

// --- 3. Prepare and Execute SQL Deletion ---
// NOTE: Assuming your table is named 'scrabbleResults2' (or whatever table holds the saved state)
$student_id_safe = mysqli_real_escape_string($conn, $student_id);

// Delete the record for this student from the score/game state table
$query = "DELETE FROM scrabbleResults WHERE studentID = '{$student_id_safe}'";

if (mysqli_query($conn, $query)) {
    $deleted_count = mysqli_affected_rows($conn);
    
    $response['success'] = true;
    $response['deleted_count'] = $deleted_count;
    $response['message'] = "Successfully deleted {$deleted_count} records for student ID {$student_id}.";

} else {
    $response['message'] = 'Database deletion query failed: ' . mysqli_error($conn);
}

// --- 4. Clean up and Output ---
$conn->close();
echo json_encode($response);

?>