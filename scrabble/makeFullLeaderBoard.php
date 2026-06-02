<?php
// Set the content type header for JSON response
header('Content-Type: application/json');
// Set headers to allow cross-origin requests (CORS) and JSON content
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Allow requests from any origin
header('Access-Control-Allow-Methods: GET, OPTIONS'); // Allow GET for data fetching
// --- 1. Database Connections ---

// PIO Database Connection (for student details)
$server = 'localhost' ;
$username = 'teacherj_admin';
$password = 'CNNHero2008' ;
$database = 'teacherj_pio' ;

$connPIO = mysqli_connect($server, $username, $password, $database);
if (!$connPIO) {
    echo json_encode(['error' => 'Failed to connect to PIO Database: ' . mysqli_connect_error()]);
    exit;
}

// Temple Database Connection (for scrabble scores)
$server = 'localhost' ;
$username = 'teacherj_euclid';
$password = 'puthisastra2024' ;
$database = 'teacherj_temple' ;

$connTemple = mysqli_connect($server, $username, $password, $database);
if (!$connTemple) {
    // Attempt to close PIO connection before exiting
    if ($connPIO) {
        $connPIO->close();
    }
    echo json_encode(['error' => 'Failed to connect to Temple Database: ' . mysqli_connect_error()]);
    exit;
}

// --- 2. Fetch and Index Student Data (PIO) ---
// We fetch student data and index it by Student_ID for fast lookup.
$query2 = "SELECT Student_ID, Family_name, First_name, Grade 
           FROM New_Students
           JOIN New_ID_Year_Grade 
           ON (New_Students.ID = New_ID_Year_Grade.Student_ID)
           WHERE Year = 2026 AND School = 'PIOHS'";

$result2 = mysqli_query($connPIO, $query2);

$indexedStudents = [];
if ($result2) {
    while ($data = mysqli_fetch_assoc($result2)) {
        // Use Student_ID as the key for O(1) lookup
        $indexedStudents[$data['Student_ID']] = $data;
    }
    mysqli_free_result($result2);
} else {
    $connTemple->close();
    $connPIO->close();
    echo json_encode(['error' => 'Query 2 failed: ' . mysqli_error($connPIO)]);
    exit;
}

// --- 3. Fetch Scrabble Scores (Temple) ---
$query1 = "SELECT studentID, score FROM scrabbleResults";

$result1 = mysqli_query($connTemple, $query1);

$finalOutput = [];
if ($result1) {
    // --- 4. Merge Data (Fast O(N) lookup) ---
    // Iterate through scores and use the index to find student data
    while ($arr1 = mysqli_fetch_assoc($result1)) {
        $studentID = $arr1['studentID'];

        // Check if student exists in the indexed list
        if (isset($indexedStudents[$studentID])) {
            $studentData = $indexedStudents[$studentID];
            
            // Merge score into student data
            $studentData['score'] = $arr1['score'];
            
            $finalOutput[] = $studentData;
        }
    }
    mysqli_free_result($result1);
} else {
    $connTemple->close();
    $connPIO->close();
    echo json_encode(['error' => 'Query 1 failed: ' . mysqli_error($connTemple)]);
    exit;
}


// --- 5. Clean up and Output ---
$connTemple->close();
$connPIO->close();

echo json_encode($finalOutput);

?>