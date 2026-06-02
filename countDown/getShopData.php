<?php // new version

include "../connectTempleDB.php" ;

$round = $_POST['currentRound'] ;

// $round = 1 ;

$query = "SELECT * FROM phoneSetSellingPrice WHERE roundNumber = ?" ;
$stmt = mysqli_prepare($dbServer,$query) ;

mysqli_stmt_bind_param($stmt,'i',$round) ;
mysqli_stmt_execute($stmt);

$data = [] ;

$getResult = mysqli_stmt_get_result($stmt);

while ($row = mysqli_fetch_assoc($getResult))
    {
        $data[] = $row ;
    }

echo json_encode($data) ;

?>