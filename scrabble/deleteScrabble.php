<?php
// Set headers to allow cross-origin requests (CORS) and JSON content
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
// Optional but sometimes necessary for complex requests
header('Access-Control-Max-Age: 86400'); 

// Handle preflight OPTIONS request from the browser
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$response = [
    'success' => false,
    'deleted_count' => 0,
    'message' => 'An unknown error occurred.',
];

// --- 1. Database Connection (Temple Database for scores) ---
$server = 'localhost' ;
$username = 'teacherj_euclid';
$password = 'puthisastra2024' ;
$database = 'teacherj_temple' ;

$connTemple = mysqli_connect($server, $username, $password, $database);
if (!$connTemple) {
    $response['message'] = 'Database connection failed: ' . mysqli_connect_error();
    echo json_encode($response);
    exit;
}

// --- 2. Get Data from POST Request ---
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!isset($data['studentIDs']) || !is_array($data['studentIDs']) || empty($data['studentIDs'])) {
    $response['message'] = 'Invalid or empty list of student IDs received.';
    $connTemple->close();
    echo json_encode($response);
    exit;
}

$studentIDs = $data['studentIDs'];

// --- 3. Prepare and Execute SQL Deletion ---

// Sanitize and quote the IDs for the SQL query
$sanitizedIDs = array_map(function($id) use ($connTemple) {
    // Escape and wrap in quotes for the SQL IN clause
    return "'" . mysqli_real_escape_string($connTemple, $id) . "'";
}, $studentIDs);

$idList = implode(',', $sanitizedIDs);

// Construct the DELETE query
$query = "DELETE FROM scrabbleResults WHERE studentID IN ($idList)";

if (mysqli_query($connTemple, $query)) {
    // Get the number of affected rows (deleted records)
    $deletedCount = mysqli_affected_rows($connTemple);
    
    $response['success'] = true;
    $response['deleted_count'] = $deletedCount;
    $response['message'] = "Successfully deleted {$deletedCount} records.";

} else {
    $response['message'] = 'Database deletion query failed: ' . mysqli_error($connTemple);
}

// --- 4. Clean up and Output ---
$connTemple->close();
echo json_encode($response);

?>