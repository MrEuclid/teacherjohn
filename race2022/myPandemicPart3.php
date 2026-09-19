<!DOCTYPE html>
<html lang="en">
  <head>
<title>Pandemic part 3</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../javaScript/bootStrap/bootstrap-3.3.7-dist/css/bootstrap.min.css">
  <script src="../javaScript/jQuery/jquery-3.3.1.min.js"></script>
  <script src="//javaScript/bootStrap/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
  <link rel = "stylesheet" href  = "css/rsaStyles.css">
    
<script type="text/x-mathjax-config">
  MathJax.Hub.Config({
    extensions: ["tex2jax.js"],
    jax: ["input/TeX","output/HTML-CSS"],
    tex2jax: {inlineMath: [["$","$"],["\\(","\\)"]]}
  });
</script>
<script type="text/javascript" src="MathJax-2.7.5/MathJax.js"></script>

<!-- scripts for functions used in the app -->


 

<script type="text/javascript">
  function makeButtons(n)

  {
for (var i = 0 ; i < n ;i++)
{


   var r = '<div id =bPan-' + i + '>+</div>'
 $("#grid").append(r); 
  



 if ((i+1)  % 64 == 0  & i > 0 ) { $("#grid").append('<br>'); }



}
}
</script>


<script type="text/javascript">
  function displayButtons(data)

  {
 // console.log('cloned = ',data);
  // styles the grid based on the people array
  n = data.length;
  var S = 0 ;
  var I= 0 ;
  var R = 0 ;

for (var i = 0 ; i < n ;i++)
{

var condition = data[i].person.status;
//alert(i + ' condition ' + condition);

if (condition == "S")
{
  S++ ;
$('#bPan-'+i).css({"background-color":"blue"});
}

if (condition == "I")
{
  I++ ;
$('#bPan-'+i).css({"background-color":"red"});
}

if (condition == "R")
{
  R++ ;
$('#bPan-'+i).css({"background-color":"green"});
}


var d =data[i].person.socialDistance;
d = parseInt(d);
var space = d + 'px';
$('#bPan-'+i).css(
      {"margin-left":space,
      "margin-right":space, 
      "margin-top" :space,
      "margin-bottom": space});

} // loop

$('#susceptibleID').text(S);
$('#infectedID').text(I);
$('#recoveredID').text(R);
} // function
</script>

<script type="text/javascript">
// returns a random integer between min and max
  function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}
</script>



<script>
$(document).ready(function(){

crowd = 5;
// susceptible = crowd ;
infected = 0 ;
recovered = 0 ;
timeBeforeImmunity = 1000 ;
susceptible = 0 ;
time = 0 ;



// use array peopleto hold the crowd
people = [] ;

// person has the status and characteristics of each person



for (var i = 0 ; i < crowd ; i++)
{
  // make the crowd

person = {
            "status": "S",
            "timeInfected": i ,
            "timeRecovered": i,
            "socialDistance": i+2
          } ;

  people.push(person) ;
// console.log('Adding ',i,person)
 //console.log(' who ', i , people[i]);
}

makeButtons(crowd);
var clones = people.slice() ;
// var clones  = people.map((x) => x);

displayButtons(clones) ;
$('#grid').show() ;
$('#start').show() ;
$('#newCycle').hide() ;

})

</script>

<script>
      $(document).ready(function(){
    $('#start').on('click', function()
  {

time = 0 ;
// make one infection
alert('Starting') ;
var n = getRandomInt(0,crowd-1);
people[n].person.status = "I";

clones = people.slice() ;
displayButtons(clones) ;

//console.log('add infected ',clones);


// alert('time = ' + time);
//$('#start').hide() ;
$('#newCycle').show() ;



})
})
</script>


<script>
      $(document).ready(function(){
    $('#newCycle').on('click', function()
  {

alert('New cycle');
// spreading the infecton
// simple case is that it must be an uninfected person
time++ ;
var l = crowd ;
var clones = people.slice() ;
var victimPool = [] ;

var temp = people.filter(function(p) {return p.status == "S" ; });
 alert('Temp = ' + temp +  ' l = ' + temp.length) ;
// candidate for infection must be "S" and not infected in this round
alert('Number of possible victims = ' + temp.length);

})
})
</script>


<style>

  [id^=bPan-] {width: 1px ; height: 1px;  color:white; background-color: blue; display: inline;}

  </style>

</head>

<body>
  <div class  = "container-fluid">

<div class = "row">
<div class = "col-sm-12 ">
  <h2 class = "c">Pandemic Question new</h2>
  <p>There is a crowd  of people at a meeting. When a person herars a joke they want to share it with another people. They do that once every 10 minutes, but stop doing that after they have told the joke 3 times. They are then recovered from the joke telling.</p>
  <p>How long will it take before everyone hears the joke? Are there some people who will not hear the joke?</p>
</div></div>


<div class = "row">
<div class = "col-sm-12 ">
  <h3 class =  "c">Spreading the joke. </h3> 
</div></div>


<div class = "row">
<div class = "col-sm-12 c">
  <button id = "newCycle">Spread the joke</button> <button id = "start">Start the joke</button> 
  <label>Susceptible</label><label id = "susceptibleID"></label>
  <label>Infected</label><label id = "infectedID"></label>
   <label>Recovered</label><label id = "recoveredID"></label>
</div></div>

<div class = "row">
<div class = "col-sm-2 c ">
  <h3 class = "c" >Results</h3>
  <p id = "results"></p>
</div>


<div class = "col-sm-10 c ">
    <h3 class = "c" >Crowd</h3>
  <p id = "grid"></p>
</div></div>


</div>
</body>
</html>