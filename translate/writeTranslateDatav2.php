<?php 
include "../connectTeacherJohn.php";

$studentID = $_POST['studentID'];
$kword = $_POST['khmerWord'];
$eword = $_POST['englishWord'];
$guess = $_POST['guess'];
$wordID = $_POST['wordID'];
$mark = $_POST['mark'];

$query = "INSERT INTO translateResults (studentID, kword, eword, guess, wordID, mark) VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $dbServer->prepare($query);
// "ssssii" means: String, String, String, String, Integer, Integer
$stmt->bind_param("ssssii", $studentID, $kword, $eword, $guess, $wordID, $mark);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "error";
}

$stmt->close();
mysqli_close($dbServer);
?>