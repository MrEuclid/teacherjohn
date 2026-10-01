<?php

// load team 

 include "../connectTempleDB.php";

 $studentID = $_POST['studentID'] ;
 $puzzleNumber = $_POST['puzzle'] ;
// $date = date('d-m-Y');

// $studentID = 4936;
// $puzzleNumber = 7;

$query = "INSERT INTO crossnumberScores (studentID,question)
VALUES
('$studentID','$puzzleNumber') ";

///echo "<br>" . $query . "<br>" ;

 $result = mysqli_query($dbServer,$query);
echo "Solved!";

exit() ;
?>