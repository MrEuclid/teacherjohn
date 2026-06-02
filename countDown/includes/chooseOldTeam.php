<?php
include "../connectTempleDB.php" ;

?>

<select  id = "teamList">
  <option value="" disabled selected>Select a team</option>



<?php

$query = "SELECT teamName FROM phoneTeams ORDER BY teamName" ;
$result = mysqli_query($dbServer,$query);
$teams = [] ;
$i = 0;
while ($data = mysqli_fetch_row($result))
{
	
	$teams[$i] = $data[0] ;
    $name = $data[0] ;
	$i++ ;
    echo "<option value=" .  $name .   ">" . $name . "</option>" ;
   
}
?>
</select>
 <p id = "viewTeam"></p>
 <br>


<div class = "row">
    <div class = "col-md-12 c">
 <button id = "acceptTeam">Accept</button>
 <button id = "cancelTeam">Cancel</button>

</div></div>

