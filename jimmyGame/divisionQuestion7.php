<?php
// echo "Level = " . $level ;


if ($level == 0 AND $difficulty == 1){
$limitXLower = 1 ;
$limitXUpper = 10 ;
$limitYLower = 2 ;
$limitYUpper = 10 ;
}

if ($level == 0 AND $difficucondblty ==2){
$limitXLower = 11 ;
$limitXUpper = 49 ;
$limitYLower = 2 ;
$limitYUpper = 7 ;
}

if ($level == 0 AND $difficulty == 3){
$limitXLower = 11 ;
$limitXUpper = 99 ;
$limitYLower = 2 ;
$limitYUpper = 9 ;
}



if ($level == 1 AND $difficulty == 1){
$limitXLower = 1 ;
$limitXUpper = 100 ;
$limitYLower = 2 ;
$limitYUpper = 10 ;
}

if ($level == 1 AND $difficulty ==2){
$limitXLower = 11 ;
$limitXUpper = 99 ;
$limitYLower = 2 ;
$limitYUpper = 9 ;
}

if ($level == 1 AND $difficulty == 3){
$limitXLower = 111 ;
$limitXUpper = 999 ;
$limitYLower = 2 ;
$limitYUpper = 5 ;
}


// level 2

if ($level == 2 AND $difficulty ==1){
$limitXLower = 111 ;
$limitXUpper = 999 ;
$limitYLower = 2 ;
$limitYUpper = 9 ;
}

if ($level == 2 AND $difficulty == 2){
$limitXLower = 1111 ;
$limitXUpper = 9999 ;
$limitYLower = 2 ;
$limitYUpper = 9 ;
}

if ($level == 2 AND $difficulty == 3){
$limitXLower = 1111 ;
$limitXUpper = 9999 ;
$limitYLower = 11 ;
$limitYUpper = 99 ;
}




// level 3


if ($level == 3 AND $difficulty ==1){
$limitXLower = 1111 ;
$limitXUpper = 9999 ;
$limitYLower = 11 ;
$limitYUpper = 99 ;
}

if ($level == 3 AND $difficulty == 2){
$limitXLower = 5555 ;
$limitXUpper = 9999 ;
$limitYLower = 11 ;
$limitYUpper = 99 ;
}

if ($level == 3 AND $difficulty == 3){
$limitXLower = 11111 ;
$limitXUpper = 55555 ;
$limitYLower = 21 ;
$limitYUpper = 99 ;
}





$x = random_int($limitXLower,$limitXUpper) ;
$y = random_int($limitYLower, $limitYUpper) ;   
$found = "FALSE" ;
// make sure there are no carries
if ($difficulty == 1){

 while ($found == "FALSE")
{
$x = random_int($limitXLower,$limitXUpper) ;
$y = random_int($limitYLower, $limitYUpper) ; 

if ($x > $y AND  $x % $y == 0) {$found = "TRUE" ;} 
ELSE {$found = "FALSE" ;}

}

} // if

$found = "FALSE" ;
if ($difficulty == 2)
{while ($found == "FALSE")  
{

$x = random_int($limitXLower,$limitXUpper) ;
$y = random_int($limitYLower, $limitYUpper) ; 

if ($x > $y AND  $x % $y == 0) {$found = "TRUE" ;} 
ELSE {$found = "FALSE" ;}
} // while
}  // if

$found = "FALSE" ;
if ($difficulty == 3)
{while ($found == "FALSE")  
{

$x = random_int($limitXLower,$limitXUpper) ;
$y = random_int($limitYLower, $limitYUpper) ; 

if ($x > $y  AND $x % $y == 0) {$found = "TRUE" ;} ELSE {$found = "FALSE" ;}
} // while
}  // if

$sum = $x / $y ;



  $q = '\begin{align} ' . $x .
  ' &
   \\\\ 
\underline{  \div  ' . $y . '} & 

    \end{align}' ;

echo $q ;





?>