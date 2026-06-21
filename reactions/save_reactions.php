<?php
// save_reaction.php

include "../connectTeacherJohn.php";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Database connection failed."]);
    exit();
}

// Get the raw POST data
$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);

// Validate input
if (isset($data['session_id']) && isset($data['mode']) && isset($data['reaction_time_ms'])) {
    
    $sessionId = htmlspecialchars($data['session_id']);
    $mode = (int)$data['mode'];
    $reactionTimeMs = (int)$data['reaction_time_ms'];

    try {
        $stmt = $pdo->prepare("INSERT INTO reaction_population (session_id, mode, reaction_time_ms) VALUES (:session_id, :mode, :reaction_time_ms)");
        
        $stmt->bindParam(':session_id', $sessionId);
        $stmt->bindParam(':mode', $mode);
        $stmt->bindParam(':reaction_time_ms', $reactionTimeMs);
        
        $stmt->execute();

        http_response_code(200);
        echo json_encode(["status" => "success"]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "Failed to save data."]);
    }
} else {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Invalid data provided."]);
}
?>