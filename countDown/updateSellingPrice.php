<?php include "../connectTempleDB.php" ;

$data = [] ;


$sellingPrice= $_POST['price'] ;
$roundNumber = $_POST['roundNumber'] ;
$ID = $_POST['teamID'] ;

/*
$sellingPrice= 750 ;
$roundNumber = 1;
$ID = 49 ;

*/

// check whether a price has been set for this round by this team

$query = "SELECT count(*) AS N  FROM phoneSetSellingPrice WHERE roundNumber = ? AND teamID = ?"; // SQL with parameters
$stmt = mysqli_prepare($dbServer,$query) ; 
mysqli_stmt_bind_param($stmt, 'ii',$roundNumber,$ID);

mysqli_stmt_execute($stmt);
 
$getResult = mysqli_stmt_get_result($stmt);
$rows = mysqli_fetch_assoc($getResult);

$nRows = $rows['N'] ;
if (empty($nRows)) {$nRows = 0 ;}

// echo "Rows = " .$nRows . "<br>"  ;;

if ($nRows == 0  )

{
    // insert a new row 
    $query = "INSERT  INTO phoneSetSellingPrice (teamID,roundNumber,sellingPrice) VALUES (?,?,?) " ;
    $stmt = mysqli_prepare($dbServer,$query) ;
    mysqli_stmt_bind_param($stmt, 'iii',$ID,$roundNumber,$sellingPrice);
    mysqli_stmt_execute($stmt);
}

else

{
    // update row for this round and teamID
    $query = "UPDATE phoneSetSellingPrice SET sellingPrice = ? WHERE (teamID = ? AND roundNumber = ?) " ; 
    $stmt = mysqli_prepare($dbServer,$query) ;
    mysqli_stmt_bind_param($stmt, 'iii',$sellingPrice,$ID,$roundNumber);
    mysqli_stmt_execute($stmt);
}


echo json_encode($sellingPrice) ;



mysqli_close($dbServer) ;

?>