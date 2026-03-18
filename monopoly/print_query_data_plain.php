<?php
/*
 echo "<br>" ;
 echo "<br>" ;
 echo $query ;
 echo "<br>" ;
 echo "<br>" ;
*/

$result = mysqli_query($dbServer,$query) ;
// $result = mysqli_fetch_row($data);
$rows = mysqli_num_rows($result) ;
$cols = mysqli_field_count($dbServer) ;
$col_name = mysqli_fetch_fields($result) ;

?>

<table border = "1" width = "90%" align = "center">
<?php	

echo "<tr>" ;


for ($i = 0 ; $i < $cols ; $i++)
  {
$fieldinfo=mysqli_fetch_field_direct($result,$i);
$fieldname = $fieldinfo->name ;

echo "<th align=\"center\">" ;
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
  IF (is_numeric($data[$j])) 
  {echo "<td class  = \"number\">" . $data[$j]  . "</td>";}
  ELSE
  { echo "<td class  = \"left\">" . $data[$j]  . "</td>";}
}
  
echo "</tr>" ;
}


echo "</table>" ;
?>