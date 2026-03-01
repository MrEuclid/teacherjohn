<?php 
$question = isset($_POST['question']) ? $_POST['question'] : 'Knapsack code';
?>

<!DOCTYPE html>
<html lang="en">

  <head>
 
 
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.com/libraries/mathjs"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/7.5.1/math.min.js"></script>

 <link rel="stylesheet" href="raceGeminiStyles.css">

<script src="javascript/utilities.js"></script>
    
  <script type="text/x-mathjax-config">
    MathJax.Hub.Config({
      extensions: ["tex2jax.js"],
      jax: ["input/TeX","output/HTML-CSS"],
      tex2jax: {inlineMath: [["$","$"],["\\(","\\)"]]}
    });
  </script>   
  
   <script type="text/javascript">
    MathJax.Hub.Queue(["Typeset",MathJax.Hub]);
  </script>

  <script type="text/javascript" src="../javaScript/mathJax/MathJax-2.7.7/MathJax.js"></script>

<link rel="stylesheet" href="../css/templeStyles.css">
<link rel="stylesheet" href="../css/newTempleStyles.css">
<link rel="stylesheet" href="race2024.css">

 <script type="text/x-mathjax-config">
    MathJax.Hub.Config({
      extensions: ["tex2jax.js"],
      jax: ["input/TeX","output/HTML-CSS"],
      tex2jax: {inlineMath: [["$","$"],["\\(","\\)"]]}
    });
  </script>   
  
   <script type="text/javascript">
    MathJax.Hub.Queue(["Typeset",MathJax.Hub]);
  </script>
  
  <script type="text/javascript" src="../MathJax-2.7.5/MathJax.js"></script>

<title>Code</title>

<style>

#code {font-size: 2em ; color:red;}
</style>


</head>
<body>

    <div class  = "container-fluid">

    <div class = "row">
      <div class = "col-sm-12 c">

    <h1>Find the code</h1>
  <p>
  I have chosen a code from five of these numbers, 
  [2,3,5,7,11,13,17,19,23]. I then changed each number to a letter, 2 = B, 3 = C, 5 = E, 7 = G, ... .

</p>
  
</div></div>


 <div class = "row">
      <div class = "col- c">

<p>My numbers add up to </p> <p id = "code">
    <p>, can you find my code?</p>

</div></div>


 <div class = "row">
      <div class = "col- 12 c">

        <label>Code  = </label><input id = "solution1">
         <button id = "check1" >Check</button>

</div></div>


</div>

</body>
</html>

<script>
// 1. GLOBAL VARIABLES (Must be defined cleanly)
var answer = [];
var correct = 0;
var points = 0;
// Global variables for canvas

</script>
<script type="text/javascript">

     function makePrimes(max) {
  // Create an array to store if a number is prime
  const isPrime = new Array(max + 1).fill(true);

  isPrime[0] = isPrime[1] = false;

  for (let i = 2; i * i <= max; i++) {
    if (isPrime[i]) {
      // If the number is prime, mark its multiples as composite (not prime)
      for (let j = i * i; j <= max; j += i) {
        isPrime[j] = false;
      }
    }
  }

  // Collect prime numbers from the isPrime array
  const primes = [];
  for (let i = 2; i <= max; i++) {
    if (isPrime[i]) {
      primes.push(i);
    }
  }

  return primes;
}
</script>

<script type="text/javascript">
    

      function randomInteger(min, max) { // min and max included 
  return Math.floor(Math.random() * (max - min + 1) + min);
}
</script>


<script type="text/javascript">
    
function shuffle(array) {
  let currentIndex = array.length;

  // While there remain elements to shuffle...
  while (currentIndex != 0) {

    // Pick a remaining element...
    let randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex--;

    // And swap it with the current element.
    [array[currentIndex], array[randomIndex]] = [
      array[randomIndex], array[currentIndex]];
  }
}

// Used like so
//let arr = [2, 11, 37, 42];
//shuffle(arr);
//console.log(arr);
</script>
<script>
function fillArrayWithAlphabet() {
  const alphabetArray = [];
  // Use char codes to generate letters from A to Z.
  // 'A'.charCodeAt(0) gets the Unicode value of 'A'.
  // We then increment this value in the loop.
  for (let i = 'A'.charCodeAt(0); i <= 'Z'.charCodeAt(0); i++) {
    // String.fromCharCode(i) converts the Unicode value back to a character.
    alphabetArray.push(String.fromCharCode(i));
  }
  return alphabetArray;
}


</script>

<script type="text/javascript">
  
    $(document).ready(function(){
   
    question = '<?php echo $question; ?>' ;
// points = question.substr(-1);
// calculate points on exit
// $('#cancel').text("Exit");

numbers = [];
c = "";
cd = [];
alphaArray =  [];
max = 23;
code = 0;
numbers = makePrimes(23);
// alert(numbers);
shuffle(numbers);
// alert(numbers);
alphaArray = fillArrayWithAlphabet();
console.log("alphabet",alphaArray);
// Example usage:
const myArray = fillArrayWithAlphabet();
console.log(myArray); // Output: ['A', 'B', 'C', ..., 'Z']
var code = 0;
for (var i = 0; i <= 4 ; i++)
{
    code +=numbers[i];
    //console.log(i,numbers[i]);
    c = String.fromCharCode(parseInt(64 + numbers[i]));
    cd[i] = c;
    console.log(i,c, numbers[i],cd[i]);
}
$('#code').text(code);
codeValue = parseInt(code);
console.log(code,codeValue);
//console.log("1",cd);
cd.sort();
//console.log("2",cd);
c = "";
for (var i = 0 ; i <= 4 ; i++)

{
    c += cd[i];
}

answer[1] = c;
checkAnswer(1);
console.log(answer);
  })
