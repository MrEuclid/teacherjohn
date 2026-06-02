<?php 

include "../connectTempleDB.php" ;

// $wordLength = $_POST['wordLength'] ;
 $wordLength = 5 ;

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



$query = "SELECT DISTINCT UPPER(word) AS word  FROM 5Letters  WHERE CHAR_LENGTH(word) = '$wordLength' ORDER BY word " ;
$result = mysqli_query($dbServer,$query);

// echo "<br>" . $query . "<br>" ;

$output = [] ;
$i = 0 ;
while ($data = mysqli_fetch_assoc($result))

{
    $word = $data["word"]  ;
   if (uniqueCharacters($word))
    {
        $output[$i] = $word  ;
        $i++ ;
       // echo $i . ' ' . $word .'<br>' ;
    }

}

 echo json_encode($output) ;


mysqli_close($dbServer) ;
?>
