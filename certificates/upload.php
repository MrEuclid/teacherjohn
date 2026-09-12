<?php
// Database configuration
$servername = "localhost"; // usually "localhost"
$username = "your_db_username"; // your MySQL username
$password = "your_db_password"; // your MySQL password
$dbname = "your_db_name"; // your database name

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data
    $studentID = $_POST['studentID'];
    $email = $_POST['email'];

    // 1. Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("<p class='error'>Invalid email format.</p>");
    }

    // 2. Check if student ID exists in the 'certificates' table
    $sql_check = "SELECT id FROM certificates WHERE studentID = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $studentID);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows === 0) {
        die("<p class='error'>Student ID not found. Please check your ID and try again.</p>");
    }

    // 3. Handle photo upload
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {

        $uploadDir = 'images/';
        // Create the images directory if it doesn't exist
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Get file extension
        $fileExtension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        
        // Generate a unique filename based on Student ID and date
        $uniqueFilename = $studentID . '_' . date('Ymd_His') . '.' . $fileExtension;
        $uploadFile = $uploadDir . $uniqueFilename;

        // Move the uploaded file
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
            
            // 4. Update the database with the photo link and email
            $photoLink = $uploadFile;
            $sql_update = "UPDATE certificates SET photo = ?, email = ? WHERE studentID = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("sss", $photoLink, $email, $studentID);
            
            if ($stmt_update->execute()) {
                echo "<p class='success'>Record updated successfully! Your photo has been uploaded.</p>";
            } else {
                echo "<p class='error'>Error updating record: " . $conn->error . "</p>";
            }
            $stmt_update->close();
            
        } else {
            echo "<p class='error'>Possible file upload attack! Please try again.</p>";
        }
    } else {
        echo "<p class='error'>No file uploaded or an error occurred.</p>";
    }
}

$conn->close();
?>