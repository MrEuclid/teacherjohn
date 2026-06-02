<?php
// Set the content type header for JSON response
header('Content-Type: application/json');

include "connectTempleDB.php"; // Ensure this connects and provides $dbServer

// The query to select all results, ordered by score descending.
$query = "SELECT studentID, score FROM scrabbleResults ORDER BY score DESC";

$result = mysqli_query($dbServer, $query);

$scores = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $scores[] = $row;
    }
    
    // Success response
    $response = [
        'success' => true,
        'data' => $scores
    ];
    mysqli_free_result($result);
} else {
    // Database query failed
    http_response_code(500);
    $response = [
        'success' => false,
        'error' => 'Could not fetch scores: ' . mysqli_error($dbServer)
    ];
}

echo json_encode($response);
mysqli_close($dbServer);
?>