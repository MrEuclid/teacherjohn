<?php
// get_quiz.php
// This tells the browser we are sending JSON data, not HTML
header('Content-Type: application/json');

// Get the gameID from the URL (e.g., get_quiz.php?gameID=105)
$gameID = isset($_GET['gameID']) ? intval($_GET['gameID']) : 0;

include "../conenctTeacherjohn.php"
// Database connection details (using 'euclid_test' from your SQL file)
$server = 'localhost';
$username = 'euclid_test';
$password = 'pythagoras1950'; 
$database = 'euclid_test';


try {
    // Connect to the database
    $pdo = new PDO("mysql:host=$server;dbname=$database;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch all questions for the selected gameID, sorted by their original questionID
    $stmt = $pdo->prepare("SELECT * FROM askAudienceQuestions WHERE gameID = ? ORDER BY questionID ASC");
    $stmt->execute([$gameID]);
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($questions) > 0) {
        // Format the output to exactly match your original JSON file structure!
        // This ensures you don't have to rewrite your JavaScript.
        $response = [
            [
                "type" => "table",
                "name" => "askAudienceQuestions",
                "data" => $questions
            ]
        ];
        
        echo json_encode($response);
    } else {
        echo json_encode(["error" => "No questions found for this game ID."]);
    }
} catch (PDOException $e) {
    echo json_encode(["error" => "Database connection failed: " . $e->getMessage()]);
}
?>