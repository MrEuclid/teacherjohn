<?php


// create a single game
// for n players and n gifts
// insert into tables, no deletion of previous games
// constraints
$teamLimit = 4;
$giftCount = 4;
$maxGames = 1; // single game
$pointer = 0; 
$n = 0; 
$bankInitial = 1000000;
 include "../connectTempleDB.php";
echo "<h1>" . " Game maker " , "</h1>";
$startup= 15000;
$details = "Startup cash";
// find the maximum existing game number
$query = "SELECT max(game) FROM customers";

// echo "<br>" . $query . "<br>";
$result = mysqli_query($dbServer,$query);
$n = mysqli_num_rows($result);


if ($n == 0){$game = 1;}
	else 
		{
			
			$data = mysqli_fetch_row($result);
			$game = $data[0] + 1 ;
		}

 echo "  Making game# ". $game;
// make bank customer;

$bank = "bank_" . $game;
$teamName = $bank;
$password = $bank;
$bankInitial = 1000000;
$email = "bank@pio-students.net";
$details = "funding";
$other = "Reserve_bank";
$acc = "12-0000-0000-" . $game;
$query = "INSERT INTO customers (game,teamName,password,accountNumber) 

			VALUES ('$game'	,'$bank', '$password','$acc' ) ";

//			 echo "<br>" . $query . "<br>";

	mysqli_query($dbServer,$query);

// make players 
$players = [];
 echo "<h2>Players</h2>";
for ($i = 1; $i <= $teamLimit; $i++)
{
	$players[$i] = "team-" . $game . $i;
}

 print_r($players);
 echo "<br>";


include "makeGiftsNoLimit.php" ; // make new gift list
// echo print_r($gifts);
 echo "<br>";
// echo $game . " game " . "<br>";
// add bank start up

$query = "INSERT INTO transactions (game,team,otherParty,amount,details)
	
	VALUES ('$game'	,
			'$teamName', 
			'$other',
			'$bankInitial',
			'$details' ) ";

			 echo "<br>" . $query . "<br>";

		mysqli_query($dbServer,$query);




	
// add startup $  to players
	
	for ($team = 1 ; $team <= $teamLimit; $team++)
	{
		 $index = ($game - 1)*3 + $team ;
		
		 $teamName = 'team' . $game . $team ;
	//	 echo $index . " " . $game . " " . $team . " " . $teamName . "<br>" ;
		
		$n1 = rand(1000,9999);
		$n2 = rand(1000,9999);
		$acc = "12-" . $n1 . "-" . $n2 . "-0" . $game;
		$query = "INSERT INTO customers (game,teamName,password,accountNumber) 

			VALUES ('$game'	,'$teamName', '$teamName','$acc' ) ";

			 echo "<br>" . $query . "<br>";

		mysqli_query($dbServer,$query);


		// now do transactions for startup cash
		$other = 'bank_' . $game ;
		$query = "INSERT INTO transactions (game,team,otherParty,amount,details)
				VALUES(
						'$game' , '$teamName','$other','$startup','$details') ";
		 echo "<br>" . $query . "<br>";
		mysqli_query($dbServer,$query);
		// game,team, otherParty, aount, details
		$amt = - $startup;

		// reverse entry 
		$query = "INSERT INTO transactions (game,team,otherParty,amount,details)
				VALUES(
						'$game' , '$other','$teamName','$amt','$details') ";
		 echo "<br>" . $query . "<br>";

		mysqli_query($dbServer,$query);
		
	
		for ($j = 1; $j <= $giftCount; $j++)
		{
			
		//	echo $pointer . " " . $gifts[$pointer][0] . " " . $gifts[$pointer][1] . "<br>";
			// write to property register
			$price = 0;
			// get price from everyTitle

			$move = 0;
			$comment = "gift" ;
			$square = $gifts[$pointer][0];
			$title = $gifts[$pointer][1];

			$query = "SELECT price FROM everyPlace WHERE id = '$square' ";
			$result = mysqli_query($dbServer,$query);
			$data = mysqli_fetch_row($result);
			$price = $data[0];

			$query = "INSERT INTO propertyRegister (team,game,square,title,purchasePrice,comment)
				VALUES(
						'$teamName',
						'$game' , 
						'$square',
						'$title',
						'$price',
						'$comment') ";
		 echo "<br>" . $query . "<br>";
		mysqli_query($dbServer,$query);
		$pointer ++;
		}
// add bank properties to the propertyRegister
// use this query

}

$output = [];
$cnt = 0;
$query2 = "SELECT  everyPlace.id, everyPlace.title , everyPlace.rent, everyPlace.price ,team,game 
			FROM everyPlace 
			LEFT JOIN propertyRegister 
			ON everyPlace.id = propertyRegister.square AND 
			game = '$game' AND  
			substr(team,1,4) <> 'team'";

	 echo "<br>" . $query2 . "<br>";

$result2 = mysqli_query($dbServer,$query2);
$n = mysqli_num_rows($result2);
echo "n = " . $n;
while ($data2 = mysqli_fetch_assoc($result2))
{
	$output[$cnt] = $data2;
	$teamName = "bank_" . $game ;
	$square = $data2["id"];
	$title = $data2["title"] ;
	$price = $data2["price"] ;
	$comment = "bank properties";

	$query3 = "INSERT INTO propertyRegister (team,game,square,title,purchasePrice,comment)
				VALUES(
						'$teamName',
						'$game' , 
						'$square',
						'$title',
						'$price',
						'$comment') ";
		 echo "<br>" . $query3 . "<br>";
// count occurence of  tilte

$query4 = "SELECT * FROM propertyRegister WHERE title = '$title' AND game = '$game' ";
$result4 = mysqli_query($dbServer,$query4);
$nTitle = mysqli_num_rows($result4);

if($nTitle == 0)
		{mysqli_query($dbServer,$query3);}
		else {echo "<br>duplicate<br>"; }	
	
	}
	echo "Game " . $game . " ready.";






?>
