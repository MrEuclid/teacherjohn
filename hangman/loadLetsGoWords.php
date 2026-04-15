<?php 

include "../connectTeacherJohn.php" ;

 $wordLength = $_POST['wordLength'] ;
// $wordLength = 5 ;


function uniqueCharacters($str)
{
     
    // If at any time we encounter 2
    // same characters, return false
    for($i = 0; $i < strlen($str); $i++)
    {
        for($j = $i + 1; $j < strlen($str); $j++)
        {
            if($str[$i] == $str[$j])
            {
                return false;
            }
        }
    }
     
    // If no duplicate characters
    // encountered, return true
    return true;
}

$noDupLetters = false ;
while (!$noDupLetters)
{
$query = "SELECT DISTINCT UPPER(word) AS word  FROM spellingWords 
WHERE  CHAR_LENGTH(word) = '$wordLength' 
AND word NOT IN ('SPAIN', 'EGYPT', 'KOREA', 'PARIS','ITALY')
ORDER BY RAND() LIMIT 1";

// echo "<br>" . $query . "<br>" ;
$result = mysqli_query($dbServer,$query);
$data = mysqli_fetch_row($result);
$output = $data[0];
$output = trim($output);

$noDupLetters = uniqueCharacters($output);
// echo $output . " " . $noDupLetters . "<br>";

}
 echo $output ;


mysqli_close($dbServer) ;
?>
