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
$playerID = '';
$gameID = '';
$message = '';

// Check if a user ID is provided in the URL (e.g., edit_user.php?id=5)
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // need to get the 
} else {
    // If no ID is provided, exit or redirect
    $message = "No player ID specified.";
}

// --- 3. Handle form submission (Update logic) ---
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    // Sanitize and validate input
    $user_id_to_update = htmlspecialchars($_POST['id']);
    $new_player = htmlspecialchars($_POST['player']);
    $new_game = htmlspecialchars($_POST['game']);

    // Prepare and bind a safe SQL statement to prevent SQL injection
    $stmt = $conn->prepare("UPDATE mBooksRegistration SET playerID = ?, gameID = ? WHERE id = ?");
    $stmt->bind_param("ssi", $new_player, $new_game, $user_id_to_update);

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

    echo "User ID " . $user_id . "<br>" ;
    // Prepare and execute a SELECT statement to get the user's data
    $stmt = $conn->prepare("SELECT playerID, gameID FROM mBooksRegistration WHERE id = ? LIMIT 1");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the data and populate variables for the form
        $row = $result->fetch_assoc();
        $player = $row['playerID'];
        $game = $row['gameID'];

        $message = "Player " . $playerID . "Game " . $gameID  ;
    } else {
        $message = "Player not found.";
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
    <title>Edit Playerv2</title>
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
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Edit Playerv2</h1>

        <!-- Display status messages -->
        <?php if (!empty($message)): ?>
            <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded-md mb-4" role="alert">
                <span class="block sm:inline"><?php echo $message; ?></span>
            </div>
        <?php endif; ?>

        <!-- Only show the form if a user was found -->
        <?php if ($user_id && $player && $game): ?>
            <form action="editPlayerv2.php?id=<?php echo $user_id; ?>" method="post" class="space-y-4">
                <!-- Hidden input field to pass the user ID -->
                <input type="hidden" name="id" value="<?php echo $user_id; ?>">

                <div>
                    <label for="player" class="block text-gray-700 font-medium mb-1">Player</label>
                    <input type="text" id="player" name="player" value="<?php echo htmlspecialchars($player); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div>
                    <label for="game" class="block text-gray-700 font-medium mb-1">Game</label>
                    <input type="game" id="game" name="game" value="<?php echo htmlspecialchars($game); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200">
                    Update Record
                </button>
            </form>
        <?php endif; ?>

        <a href = "editTeamsv2.php">New edit</a>
    </div>

</body>
</html>
