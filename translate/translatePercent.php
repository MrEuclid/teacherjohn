<?php
include "../connectTeacherJohn.php";

$studentID = isset($_POST['studentID']) ? $_POST['studentID'] : '';

$query = "SELECT 
            round(100 * sum(case when mark = 1 then 1 else 0 end) / count(mark), 0) AS percent,
            count(mark) as total
          FROM translateResults 
          WHERE studentID = ?";

$stmt = $dbServer->prepare($query);
$stmt->bind_param("s", $studentID);
$stmt->execute();
$result = $stmt->get_result();

$data = $result->fetch_assoc();

if ($data['total'] > 0) {
    $response = $data['percent'] . "% (" . $data['total'] . " words)";
} else {
    $response = "0%";
}

header('Content-Type: application/json');
echo json_encode($response);

$stmt->close();
mysqli_close($dbServer);
?>