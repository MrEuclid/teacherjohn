<?php

 $y = $_POST['expr'] ;



$z = eval('return '.$y.';');

echo $y . " = " . $z; 

exit() ;
?>