<?php

// ============================================================================
// File: list_users.php
// Description: A PHP script to list users from a database with links to edit them.
//
// Instructions:
// 1. Update the database connection variables below.
// 2. Ensure your 'users' table has columns 'id', 'name', and 'email'.
// 3. Save this file and access it in your browser, e.g.,
//    http://localhost/list_users.php
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

// --- 2. Fetch all users from the database ---
$sql = "SELECT mBooksRegistration.id, playerID, concat(familyName,' ',firstName) AS playerName,gameID 
FROM mBooksRegistration
JOIN studentsPIO 
ON mBooksRegistration.playerID = studentsPIO.studentID ";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game List</title>
    <!-- Tailwind CSS CDN for easy styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Optional custom styles */
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-2xl">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Player Listv2</h1>

        <?php if ($result->num_rows > 0): ?>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-lg overflow-hidden">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Player ID</th>

                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">playerName</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Game ID</th>

                            <th class="px-6 py-3 text-right text-xs font-bold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($row["id"]); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo htmlspecialchars($row["playerID"]); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo htmlspecialchars($row["playerName"]); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($row["gameID"]); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="editPlayerv2.php?id=<?php echo htmlspecialchars($row["id"]); ?>" class="text-blue-600 hover:text-blue-900">Edit</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-center text-gray-500">No player found in the database.</p>
        <?php endif; ?>
    </div>

</body>
</html>
