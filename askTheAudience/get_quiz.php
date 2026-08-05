<?php
// get_quiz.php
header('Content-Type: application/json');

// Get the gameID from the URL (e.g., get_quiz.php?gameID=105)
$gameID = isset($_GET['gameID']) ? intval($_GET['gameID']) : 0;

// Include your existing MySQLi database connection file
// Make sure this path is correct based on where get_quiz.php is saved!
include "../connectTeacherJohn.php"; 

try {
    // We use $dbServer which was created inside connectTeacherJohn.php
    $stmt = $dbServer->prepare("SELECT * FROM askAudienceQuestions WHERE gameID = ? AND gameID < '105' ORDER BY questionID ASC");
    
    // Bind the gameID as an integer ("i")
    $stmt->bind_param("i", $gameID);
    $stmt->execute();
    
    // Get the results
    $result = $stmt->get_result();
    $questions = $result->fetch_all(MYSQLI_ASSOC);

    if (count($questions) > 0) {
        // Format the output exactly like your old JSON file
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

    // Clean up
    $stmt->close();

} catch (Exception $e) {
    // Catch any MySQLi errors
    echo json_encode(["error" => "Database query failed: " . $e->getMessage()]);
}
?>