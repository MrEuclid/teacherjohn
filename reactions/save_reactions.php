<?php
// Force JSON output and hide HTML errors
header('Content-Type: application/json');
ini_set('display_errors', 0); 
error_reporting(E_ALL);

try {
    // This file connects to the DB and gives us the $dbServer mysqli object
    include "../connectTeacherJohn.php"; 
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Connection setup failed."]);
    exit();
}

// Get the raw POST data from the JavaScript fetch()
$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);

// Validate input
if (isset($data['session_id']) && isset($data['mode']) && isset($data['reaction_time_ms'])) {
    
    $sessionId = $data['session_id'];
    $mode = (int)$data['mode'];
    $reactionTimeMs = (int)$data['reaction_time_ms'];

    try {
        // Prepare the SQL statement using your existing $dbServer mysqli object
        // We use ? as placeholders in mysqli instead of :names
        $stmt = $dbServer->prepare("INSERT INTO reaction_population (session_id, mode, reaction_time_ms) VALUES (?, ?, ?)");
        
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $dbServer->error);
        }

        // "sii" means: String (session_id), Integer (mode), Integer (reaction_time_ms)
        $stmt->bind_param("sii", $sessionId, $mode, $reactionTimeMs);
        
        if ($stmt->execute()) {
            http_response_code(200);
            echo json_encode(["status" => "success"]);
        } else {
            throw new Exception("Execute failed: " . $stmt->error);
        }
        
        $stmt->close();

    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
} else {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Invalid data provided."]);
}
?>