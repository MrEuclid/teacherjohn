<?php

if ($level == 0 AND $difficulty == 1){
$limitXLower = 11 ;
$limitXUpper = 20 ;
$limitYLower = 1 ;
$limitYUpper = 9 ;
}

if ($level == 0 AND $difficulty ==2){
$limitXLower = 11 ;
$limitXUpper = 29 ;
$limitYLower = 11 ;
$limitYUpper = 28 ;
}

if ($level == 0 AND $difficulty == 3){
$limitXLower = 51 ;
$limitXUpper = 99 ;
$limitYLower = 19 ;
$limitYUpper = 49 ;
}



// echo "Level = " . $level ;
if ($level == 1 AND $difficulty == 1){
$limitXLower = 11 ;
$limitXUpper = 20 ;
$limitYLower = 1 ;
$limitYUpper = 9 ;
}

if ($level == 1 AND $difficulty ==2){
$limitXLower = 51 ;
$limitXUpper = 99 ;
$limitYLower = 11 ;
$limitYUpper = 48 ;
}

if ($level == 1 AND $difficulty == 3){
$limitXLower = 511 ;
$limitXUpper = 999 ;
$limitYLower = 199 ;
$limitYUpper = 499 ;
}

// level 2

if ($level == 2 AND $difficulty == 1){
$limitXLower = 499 ;
$limitXUpper = 999 ;
$limitYLower = 11 ;
$limitYUpper = 399 ;
}

if ($level == 2 AND $difficulty ==2){
$limitXLower = 4999 ;
$limitXUpper = 9999 ;
$limitYLower = 999 ;
$limitYUpper = 3999 ;
}

if ($level == 2 AND $difficulty == 3){
$limitXLower = 7999 ;
$limitXUpper = 9999 ;
$limitYLower = 111 ;
$limitYUpper = 1999 ;
}


// level 3

if ($level == 3 AND $difficulty == 1){
$limitXLower = 499 ;
$limitXUpper = 999 ;
$limitYLower = 11 ;
$limitYUpper = 399 ;
}

if ($level == 3 AND $difficulty ==2){
$limitXLower = 4999 ;
$limitXUpper = 9999 ;
$limitYLower = 999 ;
$limitYUpper = 3999 ;
}

if ($level == 3 AND $difficulty == 3){
$limitXLower = 7999 ;
$limitXUpper = 9999 ;
$limitYLower = 1119 ;
$limitYUpper = 1999 ;
}

 
$found = "FALSE" ;


$x = random_int($limitXLower,$limitXUpper) ;
$y = random_int($limitYLower, $limitYUpper ) ;  

while ($found == "FALSE")
{
	$x = random_int($limitXLower,$limitXUpper) ;
	$y = random_int($limitYLower, $limitYUpper ) ; 
	if ($x > $y) {$found = "TRUE" ;} ELSE {$found = "FALSE" ;}
} // while
 
$sum = $x - $y ;



  $q = '\begin{align} ' . $x .
  ' &
   \\\\ 
\underline{  -  ' . $y . '} & 

    \end{align}' ;

echo $q ;

?>