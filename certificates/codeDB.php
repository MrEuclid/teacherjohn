
// NOTE: This file assumes 'connect_db_euclid_pio.php' exists and establishes
// the database connection via a global variable named $dbServer.
include "../connect_db_euclid_pio.php";

$year = date("Y") ;
$month = date("m") ;
$day = date("d");
 
if ($month > 9) 
  {
    $y = $year ; // keeps real year
    $year = $year + 1; 

  } 


// make $students_array

$query = "SELECT Student_ID,Family_name,First_name,Grade,Gone
            FROM New_Students 
            INNER JOIN New_ID_Year_Grade 
            ON New_Students.ID = New_ID_Year_Grade.Student_ID 
            AND School = 'PIOHS' 
            AND Grade IN ('G9A','G9B','G10A','G10B','G11A','G11B','G12A','G12B')
            AND Year = '$year'
            ORDER BY Student_ID ";

echo "<br>" . $query . "<br>";

$result = mysqli_query($dbServer,$query);

$students_array = [];
$cnt = 0;

while ($data = mysqli_fetch_assoc($result))
{
    $students_array[$cnt] = $data ;
    $cnt++;
}

// print_r($students_array);

// Check connection
if ($dbServer->connect_error) {
    die("Connection failed: " . $dbServer->connect_error);
}


// Optional: Set character set
mysqli_query($dbServer, "SET NAMES 'utf8'");

// 4. Close the database connection
$dbServer->close();

// now connect to certificates in the templeDB

include "../connectTempleDB.php";


$server = 'localhost' ;
$username = 'teacherj_euclid';
$password = 'puthisastra2024' ;
$database = 'teacherj_temple' ;
// $dbServer =mysqli_connect ($server,$database,$password);
$dbServer = mysqli_connect($server,$username,$password,$database);
mysqli_select_db($dbServer,$database)or die("Unable to select database: " . mysqli_error()) ;
$results = [];
