<?php


// echo "Level = fixed " . $level ;


if ($level == 0 AND $difficulty == 1){
$limitXLower = 1 ;
$limitXUpper = 9 ;
$limitYLower = 1 ;
$limitYUpper = 9 ;
}

if ($level == 0 AND $difficulty ==2){
$limitXLower = 11 ;
$limitXUpper = 49 ;
$limitYLower = 11 ;
$limitYUpper = 49 ;
}

if ($level == 0 AND $difficulty == 3){
$limitXLower = 49 ;
$limitXUpper = 99 ;
$limitYLower = 49 ;
$limitYUpper = 99 ;
}





if ($level == 1 AND $difficulty == 1){
$limitXLower = 11 ;
$limitXUpper = 20 ;
$limitYLower = 1 ;
$limitYUpper = 9 ;
}

if ($level == 1 AND $difficulty ==2){
$limitXLower = 11 ;
$limitXUpper = 49 ;
$limitYLower = 11 ;
$limitYUpper = 49 ;
}

if ($level == 1 AND $difficulty == 3){
$limitXLower = 111 ;
$limitXUpper = 999 ;
$limitYLower = 111 ;
$limitYUpper = 999 ;
}


if ($level == 2 AND $difficulty == 1){
$limitXLower = 11 ;
$limitXUpper = 99 ;
$limitYLower = 11 ;
$limitYUpper = 99 ;
}

if ($level == 2 AND $difficulty ==2){
$limitXLower = 111 ;
$limitXUpper = 999 ;
$limitYLower = 111 ;
$limitYUpper = 999 ;
}

if ($level == 2 AND $difficulty == 3){
$limitXLower = 1111 ;
$limitXUpper = 9999 ;
$limitYLower = 1111 ;
$limitYUpper = 9999 ;
}




if ($level == 3 AND $difficulty == 1){
$limitXLower = 1111 ;
$limitXUpper = 9999 ;
$limitYLower = 1111 ;
$limitYUpper = 9999 ;
}

if ($level == 3 AND $difficulty ==2){
$limitXLower = 555 ;
$limitXUpper = 999 ;
$limitYLower = 555 ;
$limitYUpper = 999 ;
}

if ($level == 3 AND $difficulty == 3){
$limitXLower = 6999 ;
$limitXUpper = 9999 ;
$limitYLower = 8111 ;
$limitYUpper = 9999 ;
}


$x = random_int($limitXLower,$limitXUpper) ;
$y = random_int($limitYLower, $limitYUpper) ;  
  
$found = "FALSE" ;
// make sure there are no carries

$x = random_int($limitXLower,$limitXUpper) ;
$y = random_int($limitYLower, $limitYUpper) ;  


  // if
$sum = $x + $y ;




  $q = '\begin{align} ' . $x .
  ' &
   \\\\ 
\underline{  +  ' . $y . '} & 

    \end{align}' ;

echo $q ;

?>

