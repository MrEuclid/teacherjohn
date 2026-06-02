<?php 
include "../connectTeacherJohn.php" ;

/*
$studentID = $_POST['studentID'] ;
$guess = $_POST['guess'] ;
$mark = $_POST['mark'] ;
$wordID = $_POST['wordID'] ;
$eword = $_POST['englishWord'] ;
$kword = $_POST['khmerWord'] ;



*/
$studentID = 4338 ;
$eword = 'hope' ;
$kword = 'ហើរ';
$guess = 'vb';
$mark = 1 ;
$wordID = 299;



$query = "INSERT INTO translateResults 
                (studentID,kword,eword,guess,wordID,mark) 
                VALUES ('$studentID' , '$kword', '$eword','$guess', '$wordID','$mark') " ;

// echo $query ;

echo "updated";                                                                                                                                     
$result = mysqli_query($dbServer,$query);
mysqli_close($dbServer) ;
?>