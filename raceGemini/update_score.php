<?php
session_save_path(sys_get_temp_dir());
session_start();

require_once '../connectTeacherJohn.php';

// Ensure the request is coming via POST and the user is logged in
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['teamName'])) {
    
    $teamName = $_POST['teamName'];
    $points = (int)$_POST['points'];
    $elapsedTime = (int)$_POST['elapsedTime'];
    $questionTitle = $_POST['questionTitle']; // e.g., 'q1', 'q12'
    
    $competition_duration = 45 * 60; // 45 minutes

    // 1. SECURITY CHECK: Verify they are still within their 45-minute window
    $stmt = $dbServer->prepare("SELECT startTime FROM teams WHERE teamName = ?");
    $stmt->bind_param("s", $teamName);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $realElapsed = time() - $row['startTime'];

        // Add a 10-second grace period just in case of slow internet
        if ($realElapsed > ($competition_duration + 10)) {
            echo "Error: Time limit expired.";
            exit();
        }
    } else {
        echo "Error: Team not found.";
        exit();
    }

    // 2. CHECK FOR DUPLICATES: Prevent submitting the same question twice
    $check_stmt = $dbServer->prepare("SELECT id FROM results WHERE teamName = ? AND questionTitle = ?");
    $check_stmt->bind_param("ss", $teamName, $questionTitle);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        echo "Notice: Question already answered.";
        exit();
    }

    // 3. LOG THE SCORE: Insert the points into the results table
    $insert_stmt = $dbServer->prepare("INSERT INTO results (teamName, questionTitle, points, elapsedTime) VALUES (?, ?, ?, ?)");
    $insert_stmt->bind_param("ssii", $teamName, $questionTitle, $points, $elapsedTime);
    
    if ($insert_stmt->execute()) {
        echo "Success: Score logged!";
    } else {
        echo "Error: Could not save score.";
    }

} else {
    echo "Error: Invalid request.";
}
?>