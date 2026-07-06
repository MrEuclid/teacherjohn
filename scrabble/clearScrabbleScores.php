<?php
// Set the content type header for JSON response
header('Content-Type: application/json');

// NOTE: This API is set to only allow POST requests for security (less likely to be accessed accidentally)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed. Use POST.']);
    exit();
}

include "../connectTeacherJohn.php"; // Ensure this connects and provides $dbServer

// Query to set the score for ALL students to 0
// NOTE: If you want to delete the records entirely, use: "DELETE FROM scrabbleResults"
$query = "TRUNCATE TABLE scrabbleResults"; 

if (mysqli_query($dbServer, $query)) {
    // Success response
    $response = [
        'success' => true,
        'message' => 'All scores have been reset to 0.',
        'rows_affected' => mysqli_affected_rows($dbServer)
    ];
} else {
    // Database query failed
    http_response_code(500);
    $response = [
        'success' => false,
        'error' => 'Failed to clear scores: ' . mysqli_error($dbServer)
    ];
}

echo json_encode($response);
mysqli_close($dbServer);
?>