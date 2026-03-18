<?php




// constraints
$teamLimit = 3;
$gifts = 6;
$maxGames = 36; // 6 classes, 6 games each
$pointer = 0; 

 include "../connectTempleDB.php";
// generate 3 teams for 6 games
$amount = 15000;
$details = "Startup cash";
// remove all costomers except the bank 
 $query = "DELETE FROM customers WHERE substr(teamName,1,4) <> 'bank' ";
 mysqli_query($dbServer,$query);

 $query = "TRUNCATE transactions";
 mysqli_query($dbServer,$query);

 $query = "TRUNCATE messages";
 mysqli_query($dbServer,$query);

  $query = "TRUNCATE propertyRegister";
 mysqli_query($dbServer,$query);

 $query = "INSERT INTO transactions SELECT * FROM transactionsOriginal";
 mysqli_query($dbServer,$query);
include "makeGiftsAll.php" ; // make new gift list
echo $gifts[5][1] . $gifts[5][0];
echo "<br>";
for ($game = 1; $game <= 36 ; $game++)  // 6 games aat each class 9a,9b,10a,10b,11,12
{


	echo $game . " game " . "<br>";
	// creates a 2d array gifts[i][square][title]
	
	for ($team = 1 ; $team <= 3; $team++)
	{
		 $index = ($game - 1)*3 + $team ;
		
		 $teamName = 'team' . $game . $team ;
		 echo $index . " " . $game . " " . $team . " " . $teamName . "<br>" ;
		
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
						'$game' , '$teamName','$other','$amount','$details') ";
		 echo "<br>" . $query . "<br>";
		mysqli_query($dbServer,$query);
		// game,team, otherParty, aount, details
		$amt = - $amount;

		// reverse entry 
		$query = "INSERT INTO transactions (game,team,otherParty,amount,details)
				VALUES(
						'$game' , '$other','$teamName','$amt','$details') ";
		 echo "<br>" . $query . "<br>";

		mysqli_query($dbServer,$query);
		
	
		for ($j = 1; $j <= 6; $j++)
		{
			
			echo $pointer . " " . $gifts[$pointer][0] . " " . $gifts[$pointer][1] . "<br>";
			// write to property register
			$price = 0;
			$move = 0;
			$comment = "gift" ;
			$square = $gifts[$pointer][0];
			$title = $gifts[$pointer][1];

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

	

	}  // teams
	echo "<br> " . $game . " " . $team . "<br>";
}  // games


?>