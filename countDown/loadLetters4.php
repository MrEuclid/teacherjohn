<?php

function gcd($x, $y) {
   if ($y == 0)
     return $x;
   return gcd($y, $x%$y);
 }

$letters = [] ;
$start = rand(0,18) ;
$step = rand(1,2) ;
$start = 5 ;
$step = 1 ;
$index = $start ;
$base = 19 ;

$vowels = ["A","E","I","O","U"] ;
$consonants = ["B","C","D","F","G","H","J","K","L","M","N","P","Q","R","S","T","V","X","Y","Z"] ;

/*
echo "<br> Vowels" ;
print_r($vowels) ;
echo "<br>" ;
*/

/*
echo "<br> Consonants" ;
print_r($consonants) ;
echo "<br>" ;
*/

// choose one vowel at random and remove it
$chosen = rand(0,4) ;
// unset($vowels[$chosen]) ;
$vowels2 = array_values($vowels);

/*
echo "<br> Vowels 2 " ;
print_r($vowels2) ;
echo "<br>" ;
*/

$letters = [] ;
for ($i = 0 ; $i <= 4; $i++)
{
array_push($letters,$vowels2[$i]) ;
}

/*
echo "Letters " ;
print_r($letters) ;
echo "<br>" ;
*/

$n = 0 ;

while ($n <> 1)
{
$start = rand(0,$base) ;
$step = rand(1,$base) ;
$start = 4 ;
$step = 3; 
$n = gcd($base,$step) ;
}

$index = $start ;

/*
echo "<br>" ;
echo "start " . $start. "step " .$step . "<br>" ;
echo $index . "<br>" ;
*/

for ($i = 0 ; $i < 10 ; $i++)  // add 10 letters
{
array_push($vowels2,$consonants[$index]) ;
$index = $index + $step ;
$index = $index % $base ;

/*
echo "<br>" ;
echo $i . " " . $index . '-- ' . $consonants[$index] . "<br>" ;
print_r($vowels2) . "<br>" ;
*/

}



sort($vowels2) ;

/*
echo "Output<br>" ;
print_r($vowels2) ;
echo "<br>" ;
*/


echo json_encode($vowels2) ;
?>