<?php
include "../connectTeacherJohn.php" ;

// Grab the password sent from the frontend
$pass = isset($_POST['pass']) ? $_POST['pass'] : null;

// Only execute the deletion if the password is correct
if ($pass === 'pythagoras') {
    
    $query = "TRUNCATE TABLE countDownNumberResults";
    
    if (mysqli_query($dbServer, $query)) {
        echo "Success: All Number Race results have been cleared.";
    } else {
        echo "Database Error: Could not clear results.";
    }

} else {
    // If the password was wrong or missing
    echo "Authorization failed: Incorrect password.";
}

mysqli_close($dbServer) ;
?>