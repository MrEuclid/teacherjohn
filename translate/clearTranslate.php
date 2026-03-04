<?php
include "../connectTeacherJohn.php";

$pass = isset($_POST['pass']) ? $_POST['pass'] : null;

if ($pass === 'pythagoras') {
    $query = "TRUNCATE TABLE translateResults";
    
    if (mysqli_query($dbServer, $query)) {
        echo "Success: All translation results have been cleared.";
    } else {
        echo "Database Error: Could not clear results.";
    }
} else {
    echo "Authorization failed: Incorrect password.";
}

mysqli_close($dbServer);
?>