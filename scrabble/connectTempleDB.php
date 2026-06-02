<?php


$server = 'localhost' ;
$username = 'teacherj_euclid';
$password = 'puthisastra2024' ;
$database = 'teacherj_temple' ;
// $dbServer =mysqli_connect ($server,$database,$password);
$dbServer = mysqli_connect($server,$username,$password,$database);
mysqli_select_db($dbServer,$database)or die("Unable to select database: " . mysqli_error()) ;


?>


