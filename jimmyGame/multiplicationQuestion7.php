<?php

// echo "Level = " . $level ;


if ($level == 0 AND $difficulty == 1){
$limitXLower = 2 ;
$limitXUpper = 5 ;
$limitYLower = 5 ;
$limitYUpper = 9 ;
}

if ($level == 0 AND $difficulty ==2){
$limitXLower = 2 ;
$limitXUpper = 6 ;
$limitYLower = 2 ;
$limitYUpper = 6 ;
}

if ($level == 0 AND $difficulty == 3){
$limitXLower = 2 ;
$limitXUpper = 9 ;
$limitYLower = 6 ;
$limitYUpper = 9 ;
}



if ($level == 1 AND $difficulty == 1){
$limitXLower = 2 ;
$limitXUpper = 5 ;
$limitYLower = 5 ;
$limitYUpper = 9 ;
}

if ($level == 1 AND $difficulty ==2){
$limitXLower = 5 ;
$limitXUpper = 9 ;
$limitYLower = 5 ;
$limitYUpper = 9 ;
}

if ($level == 1 AND $difficulty == 3){
$limitXLower = 11 ;
$limitXUpper = 99 ;
$limitYLower = 2 ;
$limitYUpper = 9 ;
}

// level 2


if ($level == 2 AND $difficulty == 1){
$limitXLower = 11 ;
$limitXUpper = 99 ;
$limitYLower = 2 ;
$limitYUpper = 9 ;
}

if ($level == 2 AND $difficulty ==2){
$limitXLower = 11 ;
$limitXUpper = 99 ;
$limitYLower = 11 ;
$limitYUpper = 49 ;
}

if ($level == 2 AND $difficulty == 3){
$limitXLower = 111 ;
$limitXUpper = 999 ;
$limitYLower = 11 ;
$limitYUpper = 99 ;
}

//


if ($level == 3 AND $difficulty == 1){
$limitXLower = 11 ;
$limitXUpper = 99 ;
$limitYLower = 11 ;
$limitYUpper = 99 ;
}

if ($level == 3 AND $difficulty ==2){
$limitXLower = 111 ;
$limitXUpper = 999 ;
$limitYLower = 11 ;
$limitYUpper = 99 ;
}

if ($level == 3 AND $difficulty == 3){
$limitXLower = 1111 ;
$limitXUpper = 9999 ;
$limitYLower = 11 ;
$limitYUpper = 99 ;
}

 
  
$found = "FALSE" ;
// make sure there are no carries
if ($difficulty == 1)

{
$x = random_int($limitXLower, $limitXUpper) ;
$y = random_int($limitYLower, $limitYUpper) ;

}  // if

$found = "FALSE" ;
if ($difficulty == 2)
{while ($found == "FALSE")  
{

$x = random_int($limitXLower, $limitXUpper) ;
$y = random_int($limitYLower, $limitYUpper) ;

if ($x > $y  AND $y % 10 <> 0) {$found = "TRUE" ;} 
ELSE {$found = "FALSE" ;}
} // while
}  // if

$found = "FALSE" ;
if ($difficulty == 3)
{while ($found == "FALSE")  
{

$x = random_int($limitXLower, $limitXUpper) ;
$y = random_int($limitYLower, $limitYUpper) ;

if ($x > $y  AND $y % 10 <> 0) {$found = "TRUE" ;} ELSE {$found = "FALSE" ;}
} // while
}  // if
$sum = $x * $y ;



  $q = '\begin{align} ' . $x .
  ' &
   \\\\ 
\underline{  \times  ' . $y . '} & 

    \end{align}' ;

echo $q ;

?>