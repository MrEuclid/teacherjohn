<?php 
include "../connectTeacherJohn.php" ;


$studentID = $_POST['studentID'] ;
$guess = $_POST['guess'] ;
$mark = $_POST['mark'] ;
$wordID = $_POST['wordID'] ;
$eword = $_POST['englishWord'] ;
$kword = $_POST['khmerWord'] ;

/*

$studentID = 5001 ;
$eword = 'hope' ;
$kword = 'ហើរ';
$guess = 'vb';
$mark = 0 ;
$wordID = 24;

*/

$query = "INSERT INTO translateResults 
                (studentID,kword,eword,guess,wordID,mark) 
                VALUES ('$studentID' , '$kword', '$eword','$guess', '$wordID','$mark') " ;

// echo "<br>" . $query  . "<br>" ;

echo "updated";                                                                                                                                     
$result = mysqli_query($dbServer,$query);
mysqli_close($dbServer) ;
?>