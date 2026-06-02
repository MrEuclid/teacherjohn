<?php 

include "../connectTempleDB.php" ;

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

$list = [] ;
$query = "SELECT DISTINCT UPPER(word) AS word  FROM spellingWords 
WHERE  CHAR_LENGTH(word) = '$wordLength' 
AND word NOT IN ('SPAIN', 'EGYPT', 'KOREA', 'PARIS','ITALY','KENYA')
ORDER BY UPPER(word) ";

// echo "<br>" . $query . "<br>" ;
$result = mysqli_query($dbServer,$query);
$data = mysqli_fetch_row($result);
$output = $data[0];
while ($data = mysqli_fetch_row($result))
{
$output = $data[0];
$output = trim($output);
$noDupLetters = uniqueCharacters($output);

if ($noDupLetters)
{
    $list[]  = $output ;
}
// echo $output . " " . $noDupLetters . "<br>";

}
 echo json_encode($list);


mysqli_close($dbServer) ;
?>
