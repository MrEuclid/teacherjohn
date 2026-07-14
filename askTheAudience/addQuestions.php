<?php
include "../connectTeacherJohn.php"; 


$title = $_POST['title'];
$questionText = "";
 $questions =$_POST['questionsData']; // questionData is JSON array


// $title = "Complex equations6";
//  $questionText = " <strong>    z1 = 4 +i, z2 = 3-i </strong>and $ \frac{z1}{z2} $  ";

// write to  game
// escape ' by repeating it'
$query = "INSERT INTO gameTitles 
          (title,words) 
          VALUES 
            ('$title',
              '$questionText'
            )" ;

echo "<br>" . $query . "<br>";
mysqli_query($dbServer,$query);

$query = "SELECT max(id) FROM gameTitles";
$result = mysqli_query($dbServer,$query);
$data = mysqli_fetch_row($result);
print_r($data);
$n = $data[0];
echo "n = " . $n . "<br>" ;

// update askAudienceQuestions

// fields id,ganeID, questionID,question,optiona,optionB,optionC,optionD,optionE,answer,currentQuestion
// currentQuestion set to 1
// answer is a number from 1 to 5

// read $questions 

// print_r($questions);
$cnt = 0;
$gameID = $n  ; // one more than the last one added
foreach ($questions as $q)
{
print_r($q);

$question =  addslashes($questions[$cnt]['question']);
$optionA =  addslashes($questions[$cnt]['options']['A']);
$optionB =  addslashes($questions[$cnt]['options']['B']);
$optionC =  addslashes($questions[$cnt]['options']['C']);
$optionD =  addslashes($questions[$cnt]['options']['D']);
$optionE =  addslashes($questions[$cnt]['options']['E']);
$answer =   addslashes($questions[$cnt]['correctAnswer']);
$answer = ord($answer) - 64 ;  // change answer to 1 to 5 
$currentQuestion = 1 ;
$questionID = $cnt+1;
// now write to askAudienceQuestions

$query = "INSERT INTO askAudienceQuestions 
            (gameID,questionID,question,optiona,optionb,optionc,optiond,optione,answer,currentQuestion)
            VALUES
            ('$gameID','$questionID', '$question','$optionA','$optionB','$optionC','$optionD','$optionE','$answer','$currentQuestion')";
      mysqli_query($dbServer,$query);      
echo "<br>" . $cnt . " " . $query . "<br>";
$cnt++;
}
?>
