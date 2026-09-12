<?php
 date_default_timezone_set("Asia/Phnom_Penh");

$date = date("Y-m-d") ;
$date_minus_30 = date('Y-m-d', strtotime('-30 days'));
$today  = date("Y-m-d") ;
$year_month = date("Y-m") ;
$month = date('n') ;
$year = DATE("Y") ; 
$current_year = date('Y');

IF ($month > 9) {$current_year++ ;}
$months = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);
$month_names = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
$month = DATE("m") ;
$changeover = $today ; // initialise
// retrieve changeover date from database

$query = "SELECT ID, Date FROM Changeover_date WHERE YEAR(Date) = '$year' AND Date >= '$today' " ;
$result = mysqli_query($dbServer,$query) ;
$data = mysqli_fetch_row($result) ;
$id = $data[0] ;
$changeover = $data[1] ;
// echo $query ;
// next changeover
$nextid = $id++ ;
$query = "SELECT Date FROM Changeover_date  WHERE ID = '$nextid' " ;
$result = mysqli_query($dbServer,$query) ;
$data = mysqli_fetch_row($result) ;
$next_changeover = $data[0] ;

// previouschangeover
$previousid = $id - 1 ;
$query = "SELECT Date FROM Changeover_date  WHERE ID = '$previousid' " ;
$result = mysqli_query($dbServer,$query) ;
$data = mysqli_fetch_row($result) ;
$previous_changeover = $data[0] ;





// get test date 

$testday = 20 ;  // after the 20th of the month

$today = DATE('Y-m-d') ;
$testdate = date("Y-m-t", strtotime($today));
// echo date("Y-m-t", strtotime($today));echo " for date = " . $today ;
// English tests are at the end of the month 
// test for day
$day = DATE('d') ;
;

IF ($day > $testday)
{$testdate = date("Y-m-t", strtotime($today)) ; }
ELSE
{ $testdate = date("Y-m-t", strtotime('last day of previous month'));
 } 
 
// echo "The date you want is ". $testdate ;


?>
