<?php
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

// ===================================================================
// 2. SYNCHRONIZATION LOGIC
// ===================================================================

foreach ($students_array as $student) {
    $studentId = $student['Student_ID'];
    // Ensure all required fields exist for non-deleted records
    $familyName = $student['Family_name'] ?? '';
    $firstName = $student['First_name'] ?? '';
    $grade = $student['Grade'] ?? '';
    $goneStatus = $student['Gone'] ?? 'N';

    if ($goneStatus == 'Y') {
        // --- A. DELETE Logic: If student is marked as 'Gone' ---
        $delete_sql = "DELETE FROM certificates WHERE StudentID = ? ";
        $stmt = $dbServer->prepare($delete_sql);
        
        if ($stmt) {
            $stmt->bind_param("i", $studentId); // 'i' for integer Student_ID
            $stmt->execute();
            $deleted_rows = $stmt->affected_rows;
            $stmt->close();
            
            if ($deleted_rows > 0) {
                $results[] = "Student ID $studentId: **DELETED** from certificates table (Gone = 'Y').";
            } else {
                 $results[] = "Student ID $studentId: Marked as Gone, but not found in certificates (0 rows deleted).";
            }
        } else {
            $results[] = "Error preparing DELETE statement for $studentId: " . $dbServer->error;
        }
        
    } else {
        // --- B. UPDATE/INSERT Logic: If student is NOT marked as 'Gone' ---
        
        // 1. Explicitly check if the record exists
        $check_sql = "SELECT COUNT(*) FROM certificates WHERE StudentID = ?";
        $stmt_check = $dbServer->prepare($check_sql);
        
        if ($stmt_check) {
            $stmt_check->bind_param("i", $studentId);
            $stmt_check->execute();
            $stmt_check->bind_result($count);
            $stmt_check->fetch();
            $stmt_check->close();
            
            if ($count > 0) {
                // --- B1. UPDATE Logic: Record exists in Certificates
                $update_sql = "UPDATE certificates SET 
                                    familyName = ?, 
                                    firstName = ?, 
                                    grade = ? 
                                WHERE StudentID = ?";
                $stmt = $dbServer->prepare($update_sql);

                if ($stmt) {
                    $stmt->bind_param("sssi", $familyName, $firstName, $grade, $studentId);
                    $stmt->execute();
                    $updated_rows = $stmt->affected_rows;
                    $stmt->close();
                    
                    // affected_rows = 0 means data was identical, 
                    // but the logic here confirms the ID exists and we attempted update.
                    $results[] = "Student ID $studentId: **UPDATED** successfully (or data unchanged).";
                } else {
                     $results[] = "Error preparing UPDATE statement for $studentId: " . $dbServer->error;
                }

            } else {
                // --- B2. INSERT Logic: Record does NOT exist in Certificates
                // Note: Providing placeholder values for 'email' and 'photo'
                $insert_sql = "INSERT INTO certificates 
                                (StudentID, familyName, firstName, grade, email, photo) 
                                VALUES (?, ?, ?, ?, 'placeholder@example.com', 'default.jpg')";
                $stmt = $dbServer->prepare($insert_sql);
                
                if ($stmt) {
                    $stmt->bind_param("isss", $studentId, $familyName, $firstName, $grade);
                    if ($stmt->execute()) {
                        $results[] = "Student ID $studentId: **INSERTED** as a new record.";
                    } else {
                        $results[] = "Error INSERTING Student ID $studentId: " . $stmt->error;
                    }
                    $stmt->close();
                } else {
                    $results[] = "Error preparing INSERT statement for $studentId: " . $dbServer->error;
                }
            }
        } else {
            $results[] = "Error preparing existence CHECK statement for $studentId: " . $dbServer->error;
        }
    }
}

// 3. Output the results of the synchronization
echo "<h2>Certificate Table Synchronization Report</h2>";
echo "<pre>";
echo implode("\n", $results);
echo "</pre>";

// 4. Close the database connection
$dbServer->close();

?>
