<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../../connectDB.php'; // Ensure this points to your database connection script

$query = "SELECT * FROM ebooks ORDER BY title ASC";

if ($result = $conn->query($query)) {
    $books = [];
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
    echo json_encode($books);
} else {
    echo json_encode(['error' => 'Database error: ' . $conn->error]);
}
?>