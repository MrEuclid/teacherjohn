<?php
// Allow cross-origin requests
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Set up for POST requests only
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed. Use POST.']);
    exit();
}

// 1. Read the raw JSON data from the request body
$json_data = file_get_contents("php://input");
$data = json_decode($json_data, true);
<?php
// Set headers to allow cross-origin requests (CORS) and JSON content
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

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
// Check for valid data structure (an array of student IDs)
if (empty($data) || !isset($data['student_ids']) || !is_array($data['student_ids'])) {
    http_response_code(400); 
    echo json_encode([
        'success' => false,
        'error' => 'Invalid or missing student_ids array in request body.'
    ]);
    exit();
}

// 2. Database connection for scrabbleResults (assuming same credentials as makeFullLeaderBoard.php)
$server = 'localhost' ;
$username = 'teacherj_euclid';
$password = 'puthisastra2024' ;
$database = 'teacherj_temple' ;

$connTemple = mysqli_connect($server, $username, $password, $database);

if (!$connTemple) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Database connection failed: ' . mysqli_connect_error()]);
    exit();
}

// 3. Prepare the list of IDs for the SQL query
$id_list = [];
foreach ($data['student_ids'] as $id) {
    // Sanitize each ID to prevent SQL injection
    $id_list[] = "'" . mysqli_real_escape_string($connTemple, trim($id)) . "'";
}

if (empty($id_list)) {
    echo json_encode(['success' => true, 'message' => 'No IDs provided to delete.']);
    mysqli_close($connTemple);
    exit();
}

// Create a comma-separated string of quoted IDs: 'id1', 'id2', 'id3'
$id_string = implode(', ', $id_list);

// 4. Execute the DELETE query
// IMPORTANT: This uses the studentID column which you successfully made the PRIMARY KEY.
$query = "DELETE FROM scrabbleResults WHERE studentID IN ($id_string)";

if (mysqli_query($connTemple, $query)) {
    $rows_deleted = mysqli_affected_rows($connTemple);
    $response = [
        'success' => true,
        'message' => "Successfully deleted $rows_deleted records from scrabbleResults.",
        'count' => $rows_deleted
    ];
} else {
    http_response_code(500);
    $response = [
        'success' => false,
        'error' => 'Database DELETE query failed: ' . mysqli_error($connTemple)
    ];
}

mysqli_close($connTemple);
echo json_encode($response);
?>