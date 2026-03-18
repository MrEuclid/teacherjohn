<?php

// load bank coa

 include "../connectTempleDB.php";

  $action = $_POST['action'];

// $action = 'receive';


if ($action == 'all')
{
	$query = "SELECT name,code FROM mbooksCOABank
			
			WHERE substr(code,3,1) <> '0' ";}

if ($action == 'pay')

{
	$query = "SELECT name,code 
				FROM mbooksCOABank
				WHERE substr(code,3,1) <> 0
		
				AND substr(code,1,1) IN (1,2,5)" ;

}

if ($action == 'receive')

{
	$query = "SELECT name,code 
				FROM mbooksCOABank
				WHERE substr(code,3,1) <> 0
				
				AND substr(code,1,1) IN (1,4)  " ;

}
//   echo "<br>" . $query . "<br>";

$result = mysqli_query($dbServer,$query);
$output = [];
$i = 0 ;

while($data = mysqli_fetch_assoc($result))
{
	$output[$i] = $data;
	$i++;
}



echo json_encode($output);


exit() ;
?>
