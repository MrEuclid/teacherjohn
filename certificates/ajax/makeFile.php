<?php


 // include "../../connect_db_euclid_pio.php" ; 


$title = $_REQUEST['currentCertificate'];
$data = $_REQUEST['students'];  // delineated by -
$grade = $_REQUEST['grade'];



// $grade = 'G10';

// make json data from the ids
$output = [];
$cnt = 0 ;

// NOTE: Using mysqli_real_escape_string is highly recommended here for security 
// if you continue to use mysqli without prepared statements.
foreach ($data as $d)
{
	
	// explode it and use the parts to make an associative array

	$temp = explode("-",$d);

	$student= array(
    "ID" => $temp[0],
    "english" => $temp[1],
    "grade" => $temp[2],
    "certificate" => $title
);
	$output[$cnt] = $student ;

	$cnt++;
}

$output = json_encode($output);

// echo $output;

$words = $grade . '_' . $title . '.csv';
$csv_filename = $words;

//echo $words;

// --- 2. Decode the JSON data ---
$data = json_decode($output, true);

if (json_last_error() !== JSON_ERROR_NONE || !is_array($data) || empty($data)) {
    // If decoding fails, exit silently or output a generic error (if headers haven't been sent yet)
    exit;
}

// --- 3. Set CSV Headers for direct browser download ---

// Set the MIME type to indicate a CSV file
header('Content-Type: text/csv');

// Tell the browser to treat this as an attachment and suggest a filename
header('Content-Disposition: attachment; filename="' . $csv_filename . '"');

// Prevent caching
header('Pragma: no-cache');
header('Expires: 0');

// --- 4. Open the output stream and write data ---

// Use 'php://output' stream to write directly to the browser response body
$output = fopen('php://output', 'w');

if ($output === false) {
    // Cannot open output stream, exit
    exit;
}

// Extract headers (column names) from the first element
$headers = array_keys($data[0]);
fputcsv($output, $headers);

// Write the data rows
foreach ($data as $row) {
    fputcsv($output, $row);
}

// --- 5. Finalize and exit ---
fclose($output);
// Removed: echo $words;
exit; // Stop execution immediately after sending the file
?>
