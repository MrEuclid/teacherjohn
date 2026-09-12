<?php
// Define variables to hold the status message and photo link
$message = "";
$photoLink = "";

include "../connectTempleDB.php"; // Include the database connection template

// Check if the form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get and sanitize the user's input
    $studentID = isset($_POST['studentID']) ? trim($_POST['studentID']) : '';

    // Validate that the student ID is not empty
    if (empty($studentID)) {
        $message = "<p class='message-error'>Please enter a Student ID.</p>";
    } else {
        // Create a database connection
      
        if ($dbServer->connect_error) {
            $message = "<p class='message-error'>Connection to database failed: " . $dbServer->connect_error . "</p>";
        } else {
            // Prepare a SQL query to prevent SQL injection
            $sql = "SELECT photo FROM certificates WHERE studentID = ?";
            $stmt = $dbServer->prepare($sql);
            $stmt->bind_param("s", $studentID);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if a record was found
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // Check if the photo field is not empty
                if (!empty($row['photo'])) {
                    $photoLink = htmlspecialchars($row['photo']);
                    $message = "<p class='message-success'>Photo found!</p>";
                } else {
                    $message = "<p class='message-info'>No photo linked to this Student ID yet.</p>";
                }
            } else {
                $message = "<p class='message-error'>Student ID not found.</p>";
            }

            // Close statement and connection
            $stmt->close();
            $dbServer->close();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Photo Viewer</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f3f4f6;
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
        input[type="text"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus {
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
        .message-success { color: #28a745; font-weight: bold; }
        .message-error { color: #dc3545; font-weight: bold; }
        .message-info { color: #007bff; font-weight: bold; }
        .photo-display {
            margin-top: 30px;
        }
        .photo-display img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Find Your Photo</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <label for="studentID">Enter Student ID:</label>
                <input type="text" id="studentID" name="studentID" required>
            </div>
            <button type="submit">View Photo</button>
        </form>

        <div class="photo-display">
            <?php echo $message; ?>
            <?php if (!empty($photoLink)): ?>
                <img src="<?php echo $photoLink; ?>" alt="Student Photo">
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
