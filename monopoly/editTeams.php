<?php

// ============================================================================
// File: edit_user.php
// Description: A self-contained PHP script to edit a user record in a database.
//
// Instructions:
// 1. Update the database connection variables below.
// 2. Ensure you have a 'users' table with columns 'id', 'name', and 'email'.
// 3. To test, access the script with a user ID in the URL, e.g.,
//    http://localhost/edit_user.php?id=1
// ============================================================================

// --- 1. Database Connection Configuration ---
$servername = "localhost";
$username = "teacherj_euclid";
$password = "puthisastra2024";
$dbname = "teacherj_temple"; // Change to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// --- 2. Initialize variables for form data and messages ---
$user_id = null;
$name = '';
$email = '';
$message = '';

// Check if a user ID is provided in the URL (e.g., edit_user.php?id=5)
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
} else {
    // If no ID is provided, exit or redirect
    $message = "No user ID specified.";
}

// --- 3. Handle form submission (Update logic) ---
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    // Sanitize and validate input
    $user_id_to_update = htmlspecialchars($_POST['id']);
    $new_name = htmlspecialchars($_POST['name']);
    $new_email = htmlspecialchars($_POST['email']);

    // Prepare and bind a safe SQL statement to prevent SQL injeidction
    $stmt = $conn->prepare("UPDATE mBooksRegistration SET playerID = ?, gameID  = ? WHERE id = ?");
    $stmt->bind_param("ssi", $new_name, $new_email, $user_id_to_update);

    // Execute the update
    if ($stmt->execute()) {
        $message = "Record updated successfully!";
    } else {
        $message = "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

// --- 4. Fetch the user's current data from the database ---
if ($user_id) {
    // Prepare and execute a SELECT statement to get the user's data
    $stmt = $conn->prepare("SELECT playerID, gameID FROM mBooksRegistration WHERE playerID = ? LIMIT 1");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the data and populate variables for the form
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $email = $row['email'];
    } else {
        $message = "User not found.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <!-- Tailwind CSS CDN for easy styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Optional custom styles */
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Edit User</h1>

        <!-- Display status messages -->
        <?php if (!empty($message)): ?>
            <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded-md mb-4" role="alert">
                <span class="block sm:inline"><?php echo $message; ?></span>
            </div>
        <?php endif; ?>

        <!-- Only show the form if a user was found -->
        <?php if ($user_id && $name && $email): ?>
            <form action="edit_user.php?id=<?php echo $user_id; ?>" method="post" class="space-y-4">
                <!-- Hidden input field to pass the user ID -->
                <input type="numeric" name="id" value="<?php echo $user_id; ?>">

                <div>
                    <label for="name" class="block text-gray-700 font-medium mb-1">Name</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div>
                    <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200">
                    Update Record
                </button>
            </form>
        <?php endif; ?>
    </div>

</body>
</html>
