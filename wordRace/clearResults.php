<?php
require_once "../connectTeacherJohn.php";

$password = isset($_POST['password']) ? $_POST['password'] : '';

// Secure backend check
if ($password === 'pythagoras') {
    // TRUNCATE empties the table completely and resets any auto-increment IDs
    $query = "TRUNCATE TABLE countDownResults";
    
    if ($dbServer->query($query) === TRUE) {
        echo "Success";
    } else {
        echo "Error";
    }
} else {
    echo "Unauthorized";
}
?>