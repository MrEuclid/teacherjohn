   <?php
   include "../connectTempleDB.php";

  $team = $_POST['team'];
  $game = $_POST['game'];



 $query = "SELECT square,title,purchasePrice,team,houses,hotel,mortgaged FROM propertyRegister WHERE  game = '$game' ORDER BY square,team "; 

 ?>
    <div class = "row">
        <div class = "col- text-center">
        
   <h3>Your real estate - Game <?php echo $game; ?></h3>
</div></div>


<?php
// echo $query ;
include "print_query_data_plain.php";
/*
$result = mysqli_query($dbServer,$query) ;
// $result = mysqli_fetch_row($data);
$rows = mysqli_num_rows($result) ;
$cols = mysqli_field_count($dbServer) ;
$col_name = mysqli_fetch_fields($result) ;

echo "<table class = \"center\" border = \"1\">" ;

echo "<tr>" ;


for ($i = 0 ; $i < $cols ; $i++)
  {
$fieldinfo=mysqli_fetch_field_direct($result,$i);
$fieldname = $fieldinfo->name ;

echo "<th>" ;
echo  $fieldname ;

}
echo "</th>" ;
echo "</tr>" ; 

// process rows
// echo $query . "<br>" ;
for ( $n = 0 ; $n < $rows ; $n++)

{  
$data = mysqli_fetch_row($result);
echo "<tr>" ;
for ($j = 0 ; $j < $cols ; $j++)
{
  IF ($j == 0) 
  {echo "<td id = \"$data[$j]\"."pr " . class  = \"number clickable\" >" . number_format($data[$j])  . "</td>";}
  ELSE
  { echo "<td class  = \"left\">" . $data[$j]  . "</td>";}
}
  
echo "</tr>" ;
}


echo "</table>" ;
*/

?>