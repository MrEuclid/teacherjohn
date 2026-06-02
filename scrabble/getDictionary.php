<?php
// Set headers to allow cross-origin requests (if your HTML is on a different domain/port)
// and to indicate the response is JSON.
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); 

// 1. Define the path to your word list file
$wordlist_file = 'wordList.csv'; 

// Check if the file exists
if (!file_exists($wordlist_file)) {
    http_response_code(404);
    echo json_encode(['error' => 'Word list file not found.']);
    exit;
}

// 2. Read the file content
$content = file_get_contents($wordlist_file);

// 3. Convert content to an array of words
// - Explode by newline character (\n)
// - Filter out empty lines (e.g., from a trailing newline)
// - Use array_map with trim() to remove any surrounding whitespace (like \r on Windows)
$words = array_filter(array_map('trim', explode("\n", $content)));

// 4. Output the array as a JSON string
echo json_encode($words);
?>