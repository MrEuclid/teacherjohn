<?php
include "../connectTeacherJohn.php";

$query = "SELECT concat(Family_name , ' ' , First_name) AS student,
          sum(case when mark = 1 then 1 else 0 end) AS correct,
          sum(case when mark = 0 then 1 else 0 end) AS wrong,
          round(100*sum(case when mark = 1 then 1 else 0 end)/count(mark),0) AS percent
          FROM translateResults
          JOIN Students_2023 ON translateResults.studentID = Students_2023.studentID
          GROUP BY translateResults.studentID
          ORDER BY correct DESC, percent DESC";

$result = mysqli_query($dbServer, $query);
$output = [];

if ($result) {
    while ($data = mysqli_fetch_assoc($result)) {
        // We push the associative array directly into the output
        $output[] = $data; 
    }
}

header('Content-Type: application/json');
echo json_encode($output);

mysqli_close($dbServer);
?>