<?php
include "../connectTeacherJohn.php";

$studentID = isset($_POST['studentID']) ? $_POST['studentID'] : '';

$query = "SELECT * FROM Students_2023 WHERE studentID = ?";
$stmt = $dbServer->prepare($query);
$stmt->bind_param("s", $studentID);
$stmt->execute();
$result = $stmt->get_result();

$data = [];

if ($result->num_rows == 0) {
    $data["message"] = "error";
} else {
    $data = $result->fetch_assoc();
    $data["message"] = "ok";
}

header('Content-Type: application/json');
echo json_encode($data);

$stmt->close();
mysqli_close($dbServer);
?>