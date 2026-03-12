<?php 

 $question = isset($_POST['question']) ? $_POST['question'] : '';
// line intersecting a parabola at AB, find the length of AB
?>

<!DOCTYPE html>


  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/11.8.0/math.min.js"></script>

  <script type="text/x-mathjax-config">
    MathJax.Hub.Config({
      extensions: ["tex2jax.js"],
      jax: ["input/TeX","output/HTML-CSS"],
      tex2jax: {inlineMath: [["$","$"],["\\(","\\)"]]}
    });
  </script>   
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.7/MathJax.js"></script>


  <script src="javascript/utilities.js"></script>
<title>Birthdays</title>

<style>

h1 {
font-weight: bolder; 
   font-size: 24pt; 
   
   color:green;
}

h2 {
font-weight: bolder; 
   font-size: 20pt; 
   
   color:blue;

}

h3 {
font-weight: bolder; 
   font-size: 16pt; 
   
   color:blue;
}

h4 {
font-weight: bold; 
   font-size: 14pt; 
   
   color:orange;
}



p {
font-weight: bold;
font-style: italic;
font-size: medium;
}


#message {font-size: 10pt ; font-style: italic;color: black ; text-align: justify;}

#answer {
            text-align: center;
            background-color: lightblue;
            font-size: 1.2em;
            font-weight: bolder;
}


h4 {
            text-align: center;
            
            font-size: 1.2em;
            font-weight: bold;
            color: black;
}

input {
    display: inline-block; 
    background-color: lightyellow; 
    text-align: center; 
    font-size: 1.2em; 
    font-weight: bolder;
    margin: 10px;
    width: 4em;
    height: 3em;
    text-transform: uppercase;


}

[id^=equation] {
    font-weight: bolder;
    color: black;
    font-size: 1.2em;
}

p.parameter  {
    display: inline-block;
    color: blue;
    font-size: 1em;
    font-weight: bolder;

}


</style>


</head>
<body>

    <div class  = "container-fluid">

        <div class = "row">
            <div class = "col-sm-12 c">
                <p id = "stars"></p>
                </div></div>

    <div class = "row">
      <div class = "col-sm-12 c">

    <h1>Birthdays</h1>


    <h4>There are 3 marks for each question.</h4>

    <p id = "intro"></p>
  
</div></div>


 <div class = "row">
      <div class = "col- c">
    <div id = "ex1">
<label id = "equation1"></label>
<input id = "solution1" maxlength="3" minlength="3">
<button id = "check1">Check 1</button>
</div>
</div></div>



 <div class = "row">
      <div class = "col- c">
    <div id = "ex2">
<label id = "equation2"></label>
<input id = "solution2" maxlength="3" minlength="3">
<button id = "check2">Check 2</button>
</div>
</div></div>



 <div class = "row">
      <div class = "col- c">
    <div id = "ex3">
<label id = "equation3"></label>
<input id = "solution3">
<button id = "check3">Check 3</button>
</div>
</div></div>


 <div class = "row">
      <div class = "col- c">
    <div id = "ex4">
<label id = "equation4"></label>
<input id = "solution4">
<button id = "check4">Check 4</button>
</div>
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

<script>
    function dateDiff(date1,date2)
    {
    // Calculating the time difference
// of two dates
let Difference_In_Time =
    date2.getTime() - date1.getTime();

// Calculating the no. of days between
// two dates
let Difference_In_Days =
    Math.round
        (Difference_In_Time / (1000 * 3600 * 24));

return Math.abs(Difference_In_Days);
}
</script>

<script type="text/javascript">
    
    function gcd(a, b) {
   
   a = Math.abs(a) ;
   b = Math.abs(b) ;

//alert('Now ' + a + ' ' + b);

    if (a == 0)
        return b;

    if (b == 0)
       return a ;  

    while (b != 0) 
    {
        if (a > b)
            a = a - b;
        else
            b = b - a;
    }

    return a;
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

</script>

<script type="text/javascript">
    
    function makeQuestion1()


    {

        const currentYear = new Date().getFullYear();
const marchFirst = new Date(currentYear, 2, 1);

const daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

// .getDay() returns a number 0-6
const dayIndex = marchFirst.getDay(); 
const dayName = daysOfWeek[dayIndex];
let firstMarch = dayName;
console.log(dayName);
        let question = "The 1st of March that year is a " + firstMarch + "." ;
        question += "<br>" ;
        question += "What day of the week is Sreynith's birthday?";
         let   expr = question;
        $('#equation1').html(expr);
        let day = days[sreynith.getDay()];
        day = day.toUpperCase().substr(0,3) 
        console.log(day);
        return day ;
    }
</script>

<script type="text/javascript">
    
    function makeQuestion2()


    {
         question = "What day of the week is Dara's birthday?";
         let   expr = question;
        $('#equation2').html(expr);

         let day = days[dara.getDay()];
        console.log(day);
        return day ;
    }
</script>


<script type="text/javascript">
    
    function makeQuestion3()

    {
        
        question = "How many days between Sreynith's birthday and Dara's birthday?" ;
         let   expr = question;
        $('#equation3').html(expr);
        x = dateDiff(sreynith,dara);
        console.log("diff",x);
        return x;

    }
</script>


<script>

    function makeQuestion4()


    {
        let birthYear = parseInt(2000 + randomInteger(10,15));

        question = "Dara was born in " + birthYear + ".";
        question += "How old will he on his birthday next year?";
         let   expr = question;
        $('#equation4').html(expr);

        let age = thisYear - birthYear; 
        console.log("Age",age);

        return parseInt(age + 1);


    }
</script>

<script type="text/javascript">
  
    $(document).ready(function(){
   
    question = '<?php echo $question; ?>' ;
// points = question.substr(-1);
// calculate points on exit
// $('#cancel').text("Exit");

answer = [];
months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
console.log(days);
dStart = new Date();
thisYear = dStart.getFullYear();
firstMarch = days[dStart.getDate(thisYear,2,1)]; // March = 2
let m = randomInteger(3,6);
let d =randomInteger(1,28);
sreynith= new Date();

sreynith.setFullYear(thisYear,m,d);
let z = sreynith.getDay();
console.log(sreynith,z,days[z]);

m = randomInteger(7,11);
d =randomInteger(1,28);
dara = new Date();

dara.setFullYear(thisYear,m,d);

console.log(dara,days[dara.getDay()]);

let x = dateDiff(sreynith,dara);
console.log(x);
words = "This year is " + thisYear + ".";
words += "Sreynith's birthday is on " + months[sreynith.getMonth()] + ' ' + sreynith.getDate();
words += " and Dara's is on  " + months[dara.getMonth()] + ' ' + dara.getDate() + ".";
console.log(words);

$('#intro').text(words);

answer[1] = makeQuestion1() ;
answer[2] = makeQuestion2() ;
answer[3] = makeQuestion3() ;
answer[4] = makeQuestion4() ;

answer[1] = answer[1].toUpperCase();
answer[1] = answer[1].substr(0,3);

answer[2] = answer[2].toUpperCase();
answer[2] = answer[2].substr(0,3);

console.log(answer);
checkAnswer(4);
//correct = 0 ; // number correct;
//points = 0 ;


  })


</script>

