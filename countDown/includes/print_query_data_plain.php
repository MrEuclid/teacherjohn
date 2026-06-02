<style> 
.c {text-align:center ;}
th {font-size:12pt;}
td {text-align:center ; border:3 ;}
table {border:2 ; align:center ;}
</style>


<?php
// echo $query ;



$result = mysqli_query($dbServer,$query) ;
// $result = mysqli_fetch_row($data);
$rows = mysqli_num_rows($result) ;
$cols = mysqli_field_count($dbServer) ;
$col_name = mysqli_fetch_fields($result) ;
?>
<div class = "row">
<div class = "col-md-12 c">

<?php 

echo "<table>" ;

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

  echo "<td>" . $data[$j]  . "</td>";
  

}
  
echo "</tr>" ;
}


echo "</table>" ;

?>

</div></div>