<?php
// Set the content type to application/json
header('Content-Type: application/json');

// Define database connection credentials
// IMPORTANT: You must replace these with your actual database details.

$servername = "localhost";
$username = "teacherj_euclid";
$password = "puthisastra2024";
$dbname = "teacherj_temple";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Connection failed: " . $conn->connect_error]);
    exit();
}

// SQL query to retrieve all student data from the 'certificates' table
// The 'photo' and 'grade' columns are included for display and filtering
$sql = "SELECT studentID,photo, familyName, firstName, grade FROM certificates WHERE photo IS NOT NULL AND photo != ''";

// Check if a grade filter was provided in the URL query string
if (isset($_GET['grade']) && $_GET['grade'] !== 'all') {
    // Sanitize the input to prevent SQL injection
    $grade = $conn->real_escape_string($_GET['grade']);
    $sql .= " AND grade = '$grade'";
}

// Order the results by familyName for a cleaner list
$sql .= " ORDER BY familyName, firstName";

$result = $conn->query($sql);

$records = [];
if ($result->num_rows > 0) {
    // Fetch all rows into an associative array
    while($row = $result->fetch_assoc()) {
        $records[] = $row;
    }
}

// Close the database connection
$conn->close();

// Return the records as a JSON array
echo json_encode($records);
?>
