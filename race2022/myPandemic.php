<!DOCTYPE html>
<html lang="en">
  <head>
<title>Pandemic</title>

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
for (var i = 1 ; i <= n ;i++)
{

   var r=$('<input/>').attr({
                      type: "button",
                      id: "bPan-"+i,
                      value: 'S'
                  });
                  $("#grid").append(r); 

if (i % 25 == 0) { $("#grid").append('<br>'); }



}
}
</script>


<script type="text/javascript">
  function displayButtons(n)

  {
for (var i = 1 ; i <= n ;i++)
{



// $('#grid').append('<button>S</button>');


}
}
</script>

<script type="text/javascript">
// returns a random integer between min and max
  function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}
</script>

<script>
$(document).ready(function(){

crowd = getRandomInt(500,1250);
$('#N').attr('value',crowd);
susceptible = crowd ;
infected = 0 ;
recovered = 0 ;
timeBeforeImmunity = 9999 ;

$('#susceptible').text(susceptible);
$('#infected').text(infected);
people = [] ;
a = ["X",0];
time = 0 ;
people[0] = a ;
for (var i = 0 ; i <= crowd ; i++)
{
  a = ["S",time] ;
  people.push(a) ;
}

makeButtons(crowd);
$('#grid').show() ;
$('#start').show() ;
$('#newCycle').hide() ;

// alert(people);

})

</script>

<script>
      $(document).ready(function(){
    $('#start').on('click', function()
  {

time = 0 ;
var victim = getRandomInt(1,crowd);
var target = '#bPan-'+victim ;
alert(victim + ' is infected  as ' + target);
people[victim][0] = "I";
people[victim][1] = 0 ; 
$(target).css({"background-color":"yellow"});
$(target).attr('value',"I");
infected = infected + 1 ;
susceptible = susceptible -1 ;
var percentSusceptible = Math.floor(100*susceptible/crowd);
var percentInfected = Math.floor(100*infected/crowd);
$('#results').append('t = ' + time+ '| % S = ' + percentSusceptible + '%' + 
  ' | % I = ' + percentInfected +'%<br>');

$('#susceptible').text(susceptible);
$('#infected').text(infected);




// alert('time = ' + time);
$('#start').hide() ;
$('#newCycle').show() ;


})
})
</script>


<script>
      $(document).ready(function(){
    $('#newCycle').on('click', function()
  {



time++ ;
// check for immunity 
// immune if time - people[i][1] >= time before immunity

for (var i = 1 ; i <= crowd; i++)
{
  if (time - people[i][1] >= timeBeforeImmunity) 
    {
        var target = '#bPan-'+i ;
        people[i][0] = "R" ; recovered++ ;
       $(target).css({"background-color":"blue"});
       $(target).attr('value',"R");

    }
  if (people[i][0] == "I" & people[i][0] != time ) // new infections are active in next cycle
  {
    var victim  = getRandomInt(1,crowd);
    // if victim is susceptile
    if (people[victim][0] == "S")  // otherwise do nothing
    {
      people[victim][0] = "I" ;
      people[victim][1] = time ;4
      var target = '#bPan-'+victim ;
     // alert(p + ' is infected  as ' + target);
      people[victim][0] = "I";
      people[victim][1] = time ;
      $(target).css({"background-color":"yellow"});
      infected = infected + 1 ;
      susceptible = susceptible -1 ;
    }
  }

}
// walk through the array, 
// with each infected person
// pick a random number
// look at that person to see when they are immune 
var percentSusceptible = Math.floor(100*susceptible/crowd);
var percentInfected = Math.floor(100*infected/crowd);
$('#results').append('t = ' + time+ '| % S = ' + percentSusceptible + '%' + 
  ' | % I = ' + percentInfected +'%<br>');

$('#susceptible').text(susceptible);
$('#infected').text(infected);



})
})
</script>


<style>

  input {text-align: center;font-size: 1em ;}
  label {margin-right: 10px ; margin-left: 10px ;}

  [id^=bPan-] {width: 10px ; height: 10px; margin: 2px 2px 2px 2px ; background-color: green; font-size: 0.5em}

  </style>

</head>

<body>
  <div class  = "container-fluid">

<div class = "row">
<div class = "col-sm-12 ">
  <h2 class = "c">Pandemic Question new</h2>
  <p>There is a crowd of people at a meeting. When a person herars a joke they want to share it with another people. They do that once every 10 minutes, The joke epidemic starts when one person makes up a very funny joke and shares it with someone else. Sometimes the joke will be told to someone who has already heard it.</p>
  <p>People keep telling the joke until there is no one who hasn't heard it.
  <p>How long will it take before everyone hears the joke? You can make a prediction using a geometric series. Do you think that your prediction would be 100% accurate? What could make it inaccurate?</p>
</div></div>


<div class = "row">
<div class = "col-sm-12 ">
  <h3 class =  "c">Spreading the joke. </h3> 
</div></div>


<div class = "row">
<div class = "col-sm-12 c">
  <button id = "newCycle">Spread the joke</button> <button id = "start">Start the joke</button> 
  <label>Susceptible</label><label id = "susceptible"></label>&nbsp; &nbsp;
  <label>Infected</label><label id = "infected"></label>
</div></div>

<div class = "row">
<div class = "col-sm-3 c ">
  <h3 class = "c" >Results</h3>
  <p id = "results"></p>
</div>


<div class = "col-sm-7 c ">
    <h3 class = "c" >Crowd</h3>
  <p id = "grid"></p>
</div>


<div class = "col-sm-2">
    <h3 class = "c" >Calculation</h3>
    <label>There are </label><input id = "N" readonly="true"><label> people at the meeting,</label>
  <p id = "calculation"></p>

</div></div>

</div>
</body>
</html>