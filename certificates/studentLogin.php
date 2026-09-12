<?php
// Define a message variable to display status to the user
$message = "";

// Database configuration
// IMPORTANT: Replace these with your actual database credentials

// include "../connectTempleDB.php";
/*

$server = 'localhost' ;
$username = 'teacherj_euclid';
$password = 'puthisastra2024' ;
$database = 'teacherj_temple' ;
*/
$servername = "localhost";
$username = 'teacherj_euclid';
$password = "puthisastra2024";
$dbname = "teacherj_temple";

// $servername = $dbServer;
// Check if the form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // --- 1. Get and sanitize user input ---
    $studentID = isset($_POST['studentID']) ? trim($_POST['studentID']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';

    // --- 2. Input validation ---
    if (empty($studentID) || empty($email) || empty($_FILES['photo']['name'])) {
        $message = "<p style='color:red;'>All fields are required.</p>";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "<p style='color:red;'>Invalid email format.</p>";
    } else {

        // --- 3. Establish database connection ---
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            $message = "<p style='color:red;'>Connection to database failed: " . $conn->connect_error . "</p>";
        } else {
            // --- 4. Check if Student ID exists in the 'certificates' table ---
            $sql_check = "SELECT studentID FROM certificates WHERE studentID = ?";
            $stmt_check = $conn->prepare($sql_check);
            $stmt_check->bind_param("s", $studentID);
            $stmt_check->execute();
            $result_check = $stmt_check->get_result();

            if ($result_check->num_rows > 0) {
                // Student ID exists, proceed with upload
                
                $uploadDir = 'images/';
                // Create the images directory if it doesn't exist
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                $file_tmp_name = $_FILES['photo']['tmp_name'];
                $file_extension = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
                
                // --- 5. Generate a unique filename based on studentID and date/time ---
                $uniqueFilename = $studentID . '_' . date('Ymd_His') . '.' . $file_extension;
                $uploadFile = $uploadDir . $uniqueFilename;

                // --- 6. Move the uploaded file to the 'images' directory ---
                if (move_uploaded_file($file_tmp_name, $uploadFile)) {
                    
                    // --- 7. Update the database record with the photo link and email ---
                    $sql_update = "UPDATE certificates SET photo = ?, email = ? WHERE studentID = ?";
                    $stmt_update = $conn->prepare($sql_update);
                    $stmt_update->bind_param("sss", $uploadFile, $email, $studentID);
                    
                    if ($stmt_update->execute()) {
                        $message = "<p style='color:green;'>Record updated successfully! Your photo and email have been saved.</p>";
                    } else {
                        $message = "<p style='color:red;'>Error updating record: " . $conn->error . "</p>";
                    }
                    $stmt_update->close();
                    
                } else {
                    $message = "<p style='color:red;'>File upload failed. Possible file upload attack!</p>";
                }
            } else {
                $message = "<p style='color:red;'>Student ID not found. Please check your ID and try again.</p>";
            }

            $stmt_check->close();
            $conn->close();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Photo & Email Uploader</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }
        h2 {
            margin-top: 0;
            color: #333;
        }
        .message {
            margin: 15px 0;
            font-size: 1em;
            font-weight: bold;
        }
        form div {
            margin-bottom: 20px;
            text-align: left;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
        }
        input[type="text"], input[type="email"], input[type="file"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus, input[type="email"]:focus {
            border-color: #4CAF50;
            outline: none;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1em;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }
        button:hover {
            background-color: #45a049;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Upload Student Photo and Email</h2>
        <div class="message"><?php echo $message; ?></div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div>
                <label for="studentID">Student ID:</label>
                <input type="text" id="studentID" name="studentID" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="photo">Select Photo to Upload:</label>
                <input type="file" id="photo" name="photo" required>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
