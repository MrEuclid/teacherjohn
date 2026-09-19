<?php 
$question = $_POST['question'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
<meta name="description" content="">
<meta name="keywords" content="">
<title>Sort Fractions</title>


  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../bootstrap-5.0.2-dist/css/bootstrap.min.css">
  <script src="../javaScript/jQuery/jquery-3.3.1.min.js"></script>
  <script src="../bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    
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

<script src="../javaScript/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
<script src="../javaScript/touchPunch/punch.js"></script> 
    


  <script>
  $( function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
// $('#sortable li').addClass('ui-state-default');
  } );
  </script>


  



  <script>
  $( function() {
    $( "#sortable4" ).sortable();
    $( "#sortable4" ).disableSelection();
// $('#sortable li').addClass('ui-state-default');
  } );
  </script>


  <link rel = "stylesheet" href  = "../css/pioStudentsStyles.css">



<style type="text/css">

    #exit {margin: 10px ;}

    
  .c {text-align:center ; }
  .r {text-align:right ; }
  .l {text-align:left ; }

  [id^=sortable] 
    { 
      list-style-type: none; 
      margin: 0; 
      padding: 0; 
      width: 600px; 
      margin-left: auto ; 
      margin-right: auto ; 
      width: auto;
      }
      
  #sortable li 
    { 
    margin: 3px 3px 3px 0; 
    padding: 5px; 
    float: left; 
    width: auto;
    width:100px;
    height: 80px; 
    font-size: 2em; 
    text-align: center; 
    font-weight: bold;  
    line-height: 2em; /* sets vertical height */
    background-color: blue;
    color: white;
    font-weight: bolder;
    }

    #sortable4 li 
    { 
    margin: 3px 3px 3px 0; 
    padding: 5px; 
    float: left; 
    width: auto;
    width:100px;
    height: 80px; 
    font-size: 1.5em; 
    text-align: center; 
    font-weight: bold;  
    line-height: 2em; /* sets vertical height */
    background-color: blue;
    color: white;
    font-weight: bolder;
    }

 .wrapper 
    {
        text-align: center;
    }
    .wrapper ul {
        display: inline-block;
        margin: 0;
        padding: 0;
        /* For IE, the outcast */
        zoom:1;
        *display: inline;
    }
    .wrapper li {
        float: left;
        left: 300px ;
        padding: 2px 5px;
        border-left: : 0px solid black;
    }



h1 {color: blue; font-size: 2em; text-align: center; font-weight: bolder;}
h2 {color: green ; font-size: 1.5em}


    .limitStyle 
      {font-size: 12pt ; font-weight: bolder; 
        background-color: lightblue ; 
        color: black ; 
        width : 60px ; 
        text-align: center;
      }

table {
  border-collapse: collapse; 
    margin: 0 auto; /* or margin: 0 auto 0 auto */
}

table, th, td {
  border: 1px solid black;
}

td {width: 9% ;  background-color: lightgreen ; color: black ; font-size: 12pt ; text-align: center; padding: 5px ; }

#xStart, #yStart {font-size: 14pt ; font-weight: bolder; color: black ;}

label 
  {
    font-size: 1em ; 
    font-weight: bolder ; 
    color: white ; 
    
    margin:10px ;
  }

[id^=coeff] 
  {
    margin: 10px; 
    width:3em; 
    text-align: center ;
  }

  #showAnswer {font-size: 2em ; font-weight: bolder; color: red;}



[id^=q] 

{  
color:white;
font-weight: bolder;
height:120px ;
width: 200px ;
font-size: 2em ;
text-align: center;
background-size: 100%;
margin-top: 10px ;
margin-bottom: 10px ;
}

[id^=check] {margin-top: 20px ; }

[id^=value] 
  {
    margin: 10px ; 
    background-color: lightblue ; 
    color: black ; 
    font-size: bold; 
    font-size: 1em 
  }
  


  </style>

  </head>
  <body>

<div class  = "container-fluid">

 <div class = "row">
    <div class = "col- ">
 <h1>Sort the fractions from smallest to biggest</h1>
</div></div>

 


  <div class = "row">
   <div class = "col- c">
     
 <div class = "wrapper ">
   <ul id="sortable">
   <li id = "answer0" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"><label id = "answerLabel0">A</label></span></li>
   <li id = "answer1" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"><label id = "answerLabel1">B</label></span></li>
   <li id = "answer2" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"><label id = "answerLabel2">C</label></span></li>
   <li id = "answer3" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"><label id = "answerLabel3">D</label></span></li>
   <li id = "answer4" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"><label id = "answerLabel4">E</label></span></li>
   <li id = "answer5" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"><label id = "answerLabel5">F</label></span></li>

</ul>
</div>  <!-- wrapper -->

  </div></div>
  
  <div class = "row">
   <div class = "col- c">
     <button  id = "check1" class="btn btn-primary btn-lg">Check</button>
   </div></div>


</div> <!-- container -->
  </body>
</html>



  <script type="text/javascript">

    $(document).ready(function(){
      
      data = [] ; 

    question = '<?php echo $question; ?>' ;
    points = question.substr(-1);
    finished = false ;  // flag for when level is complete

      
    })

</script>

<script>



// swap on basis of decimal value data[i][2] for each index i
function bubbleSort(a,index,tdata) {
    var swapped;

 //  alert(' bubble ' + a + ' ' + index + ' data ' + tdata);
    do {
        swapped = false;
        for (var i=0; i < a.length-1; i++) {
            if (tdata[a[i]][index] > tdata[a[i+1]][index]) {
                var temp = a[i];
                a[i] = a[i+1];
                a[i+1] = temp;
                swapped = true;
            }
        }
    } while (swapped);

  //   alert(' bubble ' + a + ' ' + index);
 
    
    return a ;
  }


</script>

<script type="text/javascript">

// returns a random integer between min and max
  function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

</script>

<script>
  // gcd of a,b - recursive method
   var gcd = function(a, b) {
  if (!b) {
    return a;
  }

  return gcd(b, a % b);
}


</script>

<script type="text/javascript">
  
  function makeRandomList(l,nOptions) 

  {
  
  // receives length of the data array
 var randomList = []; // indexes of questions
var originalList = [] ; // indexes from 0 to l-1



var n = nOptions;

for (var i = 0; i < l; i++)
  {
    originalList.push(i);  // has the indexes of the data array
  }

//alert(' original list ' + originalList);
// select n randomly chosen indexes and place in randomOrder

for (var i = 0 ; i < n ; i++)    // make randomList of length equal to the number of questions required
{
  var indexLast = originalList.length-1 ;
  var position = getRandomInt(0,indexLast-1); // choose randomly from original
  randomList.push(originalList[position]); // put into the randomList

  // reduce original list by removing element at position
   originalList.splice(position, 1);
}

return randomList ;

}
    



</script>





  <script type="text/javascript">

    $(document).ready(function(){



  numberOptions = 6 ; // number of elements to be sorted
  copySort = $('#sortable').html() ;  // copy the html for the sortable buttons
  list = [2,3,5,7,11,13,17,19] ; // used to generate options
  var l = list.length ;
  data = [] ;

// fill the data array 

for (var i = 0 ; i < l; i++)
  {
    for (var j = i+1 ; j < l ; j++)
      {
        var t  = [list[i],list[j],list[i]/list[j]];  // numerator, denominator and value
       // alert('Adding ' + t);
        data.push(t);  // build data array 
      }  
  }

//alert('Here is the data ' + data);
var dataLength = data.length ;
randomOrder = [] ;
randomOrder  = makeRandomList(dataLength,numberOptions);

// make a random list of the data elements that will be used to make the question
// copy the random list
sortedList = randomOrder.slice(0);

// do this because JS sorts as string not number
sortedList.sort(function(a, b) {
  return a - b;
});

buttonList = randomOrder.slice(0);
myData = data.slice(0) ;
buttonList = bubbleSort(buttonList,2,myData) ;  // sorts list on the value of num / denom


sortedIDs = $( "#sortable" ).sortable( "toArray" ); // array ids of the of sortable buttonn 

values  = [] ; // array of values as dispalyed
// populate choices
choices  = sortedList.slice(0) ; // stores choices to be ordered by the student
for (var i = 0 ; i < numberOptions ; i++)
  { 
    var num = data[choices[i]][0] ;
    var denom = data[choices[i]][1] ; 
    var value = num/denom ;
    var index = sortedList.indexOf(buttonList[i]); 
    values.push(index) ;
    var target = 'answerLabel' + i ;
    var frac = '$ \\frac{' + num + '}{' + denom + '} $'  ; // + data[choices[i]][2] ;
    $('#answerLabel'+i).html(frac);
    // render fractions because page is already loaded
    MathJax.Hub.Queue(["Typeset", MathJax.Hub, "target"]);
  }



 

// end of questionNUmber = 1

}) // end of click question 

</script>

<script type="text/javascript">

  $(document).ready(function(){
  $('#check1').on("click", function(event) 

  {
 //   alert("Clicked check");
  sortedIDs = $( "#sortable" ).sortable( "toArray" );
// alert('Index of sorted buttons ' + sortedIDs + ' button list ' + buttonList);
moveable = [] ;
for (var i = 0 ; i < sortedIDs.length; i++)
{
  var x = parseInt(sortedIDs[i].substr(6))
  moveable.push(x);
}

// values is a global array with indexes of values
// alert(moveable + ' goal = ' + values);

var i = 0 ;
var passed = true ;
while (i < numberOptions & passed == true) 

{
  if (values[i] != moveable[i]) 
    {
      passed = false ; 
      alert('Not yet');
    }
  i++ ;
}

if (passed) 

{

  alert("You have sorted the number fractions!");
  alert("Processing win " + questionID);

console.log("processing ",questionID);

processWin(questionID);
/*
 var pts = parseInt($('#total').text());
     pts = parseInt(pts);
     points = parseInt(points) ;
     console.log("points",pts);
     pts = parseInt(pts + points);
     console.log("points",pts);
     $('#total').text(pts);

    $('#menu').show();
  

     $('#play').empty().show();
     $('#q5').prop('disabled',true).css({"background-color":"blue","color":"yellow"});
  */    

}
}) 

})


  </script>




  <script type="text/javascript">
    
    $(document).ready(function(){
  $('#check4').on("click", function(event) 

  {
 //   alert("Clicked check");
  sortedIDs4 = $( "#sortable4" ).sortable( "toArray" );
// alert('Index of sorted buttons ' + sortedIDs4 + ' button list ' + buttonList4);
moveable = [] ;

for (var i = 0 ; i < sortedIDs4.length; i++)
{
  var x = parseInt(sortedIDs4[i].substr(7)) ; // allow for 4 as a prefix e.g. 4answer0
  moveable.push(x);
}

// alert(moveable + ' goal = ' + values)
var i = 0 ;
var passed = true ;
while (i < numberOptions & passed == true) 
{
  if (values[i] != moveable[i]) 
    {
      passed = false ; 
      alert('Not yet');
    }
  i++ ;
}

if (passed) 
{
  


alert("You have sorted all of the fractions! ?????");



/*
 var pts = parseInt($('#total').text());
     pts = parseInt(pts);
     points = parseInt(points) ;
     console.log("points",pts);
     pts = parseInt(pts + points);
     console.log("points",pts);
     $('#total').text(pts);
alert("You have sorted the fraction!");
    $('#menu').show();

     $('#play').empty().show();
     $('#q5').prop('disabled',true).css({"background-color":"blue","color":"yellow"});

     var t = team.split("*");
    var teamName = t[1];
    var grade = t[0] ;
    var score = $('#total').text() ;
    var timer = $('#timer').text() ;

     console.log("output",teamName,score,timer,grade,question,questionID);
    updateDatabase(teamName,score,timer,question,grade,questionID);

*/ 

}

}) // end of click 

}) // end of click



  </script>

