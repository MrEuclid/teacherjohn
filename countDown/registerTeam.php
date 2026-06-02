<?php
include "../connectTempleDB.php" ;


$errorMessage = "";  // error message
$team = "" ;  // team list

$teamName = $_POST['teamName'] ; 
$player1 = $_POST['player1'] ; 
$player2 = $_POST['player2'] ; 
$player3 = $_POST['player3'] ; 


/*
$teamName = "alpha" ;
$player1 = 1798;
$player2 = 1799 ;
$player3 = 1800 ;

*/

if ($player1 == $player2 || $player1 == $player2)
 	{
		$errorMessage = $errorMessage . $player1 . " is duplicated " . "<br>" ;
 		$team = "";
 	}

  if ($player2 == $player1 || $player2 == $player3)
 	{
 		$errorMessage = $errorMessage . $player2 . " is duplicated " . "<br>" ;
 		$team = "";
 	}

   if ($player3 == $player1 || $player3 == $player2)
 	{
 		$errorMessage = $errorMessage . $player3 . " is duplicated " . "<br>" ;
 		$team = "";
 	}






// error checking
// look for teamname

$query = "SELECT * FROM phoneTeams WHERE teamName = '$teamName' " ;
$result = mysqli_query($dbServer,$query) ;
$n = mysqli_num_rows($result) ;
if ($n <> 0) {$errorMessage = "Team name " . $teamName . " is already used" ;}  // changed for testing
else {
	$team = $teamName  . "<br>" ; }
// check 3 players 

if ($player1 > "")
{
$query = "select concat(Family_name,' ',First_name) from pioStudents where ID = '$player1' " ;

$result = mysqli_query($dbServer,$query) ;
$n = mysqli_num_rows($result) ;
if ($n <> 1) 
	{
		$errorMessage = $errorMessage . "<br>" . $player1 .  " is an incorrect student ID" . "<br>"; 
 		$team = "";
 	}
else 
	{
		//$result = mysqli_query($dbServer,$query) ;
		$data = mysqli_fetch_row($result);
		$person = $data[0] ;
		$team = $team . $person . " * " ;
	}
}



if ($player2 > "")
{
$query = "select concat(Family_name,' ',First_name) from pioStudents where ID = '$player2' " ;
$result = mysqli_query($dbServer,$query) ;
$n = mysqli_num_rows($result) ;
if ($n <> 1) 
	{
		$errorMessage = $errorMessage . "<br>" . $player2 .  " is an incorrect student ID " . "<br>";  
 		$team = "";
 	}
else 
	{
		//$result = mysqli_query($dbServer,$query) ;
		$data = mysqli_fetch_row($result);
		$person = $data[0] ;
		$team = $team . $person . " * " ;
	}

}



if ($player3 > "")
{
$query = "select concat(Family_name,' ',First_name) from pioStudents where ID = '$player3' " ;
$result = mysqli_query($dbServer,$query) ;
$n = mysqli_num_rows($result) ;
if ($n <> 1) 
	{
		$errorMessage = $errorMessage . "<br>" . $player3 .  " is an incorrect student ID" . "<br>"; 
 		$team = "";
 	}
else 
	{
		//$result = mysqli_query($dbServer,$query) ;
		$data = mysqli_fetch_row($result);
		$person = $data[0] ;
		$team = $team . $person . "<br>" ;
	}

}

$data2 = "*" ;



if ($errorMessage <> "")
	{$data2 = "Error <br>" . $errorMessage;}   // use Error to check when $data2 is returned

else {
	$data2 = $team ;

//	echo $errorMessage . $team  . $data2;




	
	
    // no errors so write to the database
    // add team, players, buy room and phones update sales and purchase tables
    // teams
// if ($errorMessage <>'')
// {
	$stmt = $dbServer-> prepare("INSERT 
	INTO  phoneTeams (teamName)
	VALUES (?) ") ;



$stmt -> bind_param('s',$team) ;
$team = $teamName;

$stmt -> execute() ;


$query = "SELECT * FROM phoneTeams" ;
$result = mysqli_query($dbServer,$query) ;
while ($data = mysqli_fetch_assoc($result) )
		{
	//	print_r($data);    
		}  
 
	//	echo "<br>.$query. <br>" ;

$query = "SELECT teamID FROM phoneTeams WHERE teamName = '$teamName' " ;
$result = mysqli_query($dbServer,$query) ;
$data = mysqli_fetch_row($result) ;
$teamID = $data[0] ;

// echo "<br>.$query. <br>" ;
// echo "Team ID" . $teamID . "<br>" ;



		$stmt = $dbServer-> prepare("INSERT INTO  phonePlayers (playerID,teamID) VALUES (?,?) ") ;
		$stmt -> bind_param('ii',$playerID,$teamIDCode) ;  // bind

	
//	echo $player1 . "-" . $player2. "-" . $player3 . " Players" . "<br>";

    // next add players to phonePlayers
    if ($player1 <> '')
        {
			//echo "Processing 1" ;

			$playerID = $player1 ;
			$teamIDCode = $teamID ;
		
			$stmt -> execute() ;
          
        }

    if ($player2 <> '')
        {
			//echo "Processing 2" ;

			$playerID = $player2 ;
			$teamIDCode = $teamID ;
		
			$stmt -> execute() ;
        }

    if ($player3 <> '')
        {
		//	echo "Processing 3" ;

			$playerID = $player1 ;
			$teamIDCode = $teamID ;
		
			$stmt -> execute() ;
        }

		$query = "SELECT * FROM phonePlayers" ;
		$result = mysqli_query($dbServer,$query) ;
		while ($data = mysqli_fetch_assoc($result) )
		{
	//	print_r($data);    
		}    
        
    // now pay for the room
    // need to avoid sql injection by escaping
  
// now buy 10 phones using prepared statements


$stmt = $dbServer-> prepare("INSERT INTO phonePurchases (roundNumber,teamID,item,numberBought)  VALUES (?,?,?,?) ") ;
$stmt -> bind_param('iisi',$round,$teamID,$item,$number) ;  

// prepare, bind set parameters and execute in that order

$item = "room" ;
$round = 1 ;
$number = 1 ;
$teamID = $teamID ;

$stmt -> execute() ;


// now phones 

$item = "phone" ;
$round = 1 ;
$number = 10 ;
$teamID = $teamID ;

$stmt -> execute() ;

$output = [] ;
$output[0] = $teamName ;
$output[1] = $teamID ;
echo json_encode($teamID);

	}  // else - $error is ""
mysqli_close($dbServer) ;


?>