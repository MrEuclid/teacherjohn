<?php 
$question = $_POST['question'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>


  <title>Make 1</title>
  <meta charset="utf-8">
  <link rel = "stylesheet" href  = "css/pioStudentsStyles.css">

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


  <style type="text/css">

body {font-size:16pt  ;}
    
.square {
    
    display: inline-block;
    margin: 0;
    padding: 2px 2px;

    
    text-rendering: auto;
    text-align: center;
    text-transform: none;
    text-decoration: none;
    text-indent: 0;
    text-shadow: none;
    letter-spacing: normal;
    word-spacing: normal;
    font-weight: bolder ;
    font-family: sans-serif;
    height: 50px ;
    width: 50px ;
    border: 1px outset buttonface; }


   .circle { 
            width: 75px; 
            height: 75px; 
            padding: 10px 16px; 
            border-radius: 25px; 
           
            text-align: center; }


#light1,#light2, #light3, #light4 , #light5, #light6, #light7, #light8

{background-color: red ;
color :white;
font-size: 12pt ;}

[id^=addend] {font-family: monospace;
        font-size: 1.2em ;
        font-family: sans-serif;
        font-weight: bolder;
        color:yellow ;
        background-color:blue;
        }

[id^=key] {margin:5px ; background-color:green ; color:white; font-weight: bold; font-size:1.2em;}

#operand {color: black ; font-size: 2em ; font-weight: bolder}

#check {color: blue ; font-size: 18pt ; font-weight: bolder ; background-color:yellow;}

  </style>
</head>
  <body>
    <div class = "container h-100">


      <div class = "row">
      <div class = "col-sm-12 c">
      
           </div> <!-- column -->
           </div> <!-- row -->

  <div class = "row">
    <div class = "col-sm-12 c">
        <p>Make each row, column and diagonal add up to 1 </p>
    </div></div>


<div class = "row align-items-center h-100 c">

  <div class="col-4 c">
     <button id = "addend1" class = "operand circle"  ></button>
    </div>    


  <div class="col-4 c">
    <button id = "addend2" class = "operand circle"  ></button>
    </div>  

    <div class="col-4 c">
      <button id = "addend3" class = "operand circle"  ></button>
       </div>    

</div>

<div class = "row align-items-center h-100 c" readonly = "true">

    <div class="col-4 c">
      <button id = "addend4" class = "operand circle"  ></button>
      </div>    
  
  
    <div class="col-4 c">
       <button id = "addend5"  class = "operand circle" ></button>
      </div>  
  
      <div class="col-4 c">
        <button id = "addend6" class = "operand circle"  ></button>
         </div>    
  
  </div>

  <div class = "row align-items-center h-100 c" readonly = "true">

    <div class="col-4 c">
      <button id = "addend7" class = "operand circle"  ></button>
      </div>    
  
  
    <div class="col-4 c">
      <button id = "addend8" class = "operand circle"  ></button>
      </div>  
  
      <div class="col-4 c">
        <button id = "addend9" class = "operand circle"  ></button>
         </div>    
  
  </div>

  <div class = "row">
    <div class = "col-sm-12 c">

        <button id = "key-1">1</button>
        <button id = "key-2">2</button>
         <button id = "key-3">3</button>

         <button id = "key-4">4</button>
         <button id = "key-5">5</button>
          <button id = "key-6">6</button>

        <button id = "key-7">7</button>
         <button id = "key-8">8</button>
          <button id = "key-9">9</button>
      </div></div>




    </div>

<input hidden = "true" id = "test">

</body>
</html>


<script type="text/javascript">
  
function gcd(a, b) {
    if (b) {
        return gcd(b, a % b);
    } else {
        return Math.abs(a);
    }
}

</script>

<script>

  // returns a random integer between min and max
  function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

  // gcd of a,b - recursive method
   var gcd = function(a, b) {
  if (!b) {
    return a;
  }

  return gcd(b, a % b);
}

</script>



<script>

    function makeFractions(n)
    {

    numbers = [] ;
        prop = {};


        prop = {     
  transform:0 , 
  numerator: 0 ,
  denominator: 0 ,
        
};

numbers[0] = prop ;
   prop = {};


        for (var j = 1 ; j <= 9 ; j++)
        {
            

           var numerator = parseInt(n + j) ;
           var denominator = 3*(5 + n) ;
           var common = gcd(numerator,denominator);
           var denom = denominator / common;
           var num = numerator / common ;

          prop.transform = n;
          prop.numerator = num;
          prop.denominator = denom ;
          console.log("Fractions",j,n,num,denom)
          
        numbers.push(prop);
   // console.log(numbers);
       prop = {};

        }

      console.log(numbers[5]);
    


return numbers;


    }

</script>


<script type="text/javascript">
    
    function renderFractions(a)
    {


for (var i = 1 ; i <= 9 ;i++)
{
        var key = "key-" + i ;
        var numerator = a[i].numerator;
        var denominator = a[i].denominator;
     
       var  term = '$ \\frac{ ' + numerator + '} {' + denominator + '} $' ;
      $('#key-'+i).html(term);
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, key]);
/*
for (var i = 1 ; i <= 9 ;i++)
   {
        var key = 'key-' + i ;
        var num = a[i[.numerator;
        var denpm = api].denominator;

        $('#key'+i).html("$ x ^ 2 \\frac[3][5] $");
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, key]);
    }

*/
}
}
</script>

<script type="text/javascript">

function check15()
{

  s = [] ;
  for (var i = 1 ; i <= 9 ; i++)
  {
    s[i] = mapped[i] ;

  }

  

  return s;
}


</script>

<script>
    $(document).ready(function(){


   question = '<?php echo $question; ?>' ;
    points = question.substr(-1);


        var n = getRandomInt(0,4);
        numb = makeFractions(n);
   //     alert(numb[3].denominator);

mapped = [] ; // mapping of fractions to integers 1 + transform -> 9 + transform 
        renderFractions(numb);

      //  console.log("numbers3",n,numb[3].denominator);
        mapped = [] ; // mapping of fractions to integers 
        keys = [] ;
        for (var i = 1; i <= 9 ; i++)
        {
            keys[i] = i ;
            mapped[i] = 0 ;
        }

    focused = 'x' ;
    $('#test').val("0");
    
   clickedAddend = false;

      var t = $('#test').val(clickedAddend);
 //  alert("Test value " + t +  clickedAddend);

    n = 3 ;
    sum = n*(n*n+1)/2 ;

    addendNumber = 5 ;
    keyNumber = 5 ;

    // set 5 

  // $('#addend5').val(5).prop('disabled','true') ; 
   $('#addend5').html('$ \\frac{1}{3} $').prop('disabled','true') ;
   MathJax.Hub.Queue(["Typeset", MathJax.Hub, 'addend5']);
   $('#key-5').prop('disabled','true').css({"background-color":"pink","color":"red"}) ; 
   mapped[5] = 5;
   lastChanged = 0 ; // last input changed 
  
    })

</script>

<script>
$(document).ready(function(){
  $("[id^=addend]").focus(function(){
    $(this).css("background-color", "yellow");
  });
  $("[id^=addend]").blur(function(){
    $(this).css("background-color", "blue");
    clickedAddend = true;
    focused = this.id;
      $('#' + focused).text('') ;
console.log("last click input",clickedAddend);
  });
});
</script>




<script>
    $(document).ready(function(){
$("[id^=addend]").on('blur', function() {

    focused = this.id ;
    addendNumber = focused.slice(-1);
  console.log("input focus",focused, addendNumber) ;



})
    })
</script>


<script>
    $(document).ready(function(){
$("[id^=addend]").on('click', function() {

   var focused = this.id ;
   addendNumber = focused.slice(-1);

   $(this).focus() ;  // safari doesn't focus on click and therefore doesn't blur 
  
  $(this).css("background-color", "yellow");
   // find mapping 

clickedAddend = true;

   var m = mapped[addendNumber];
 // alert(addendNumber + ' maps to ' + m);
   if (m > 0)
    {
      $('#key-' + m).prop('disabled', false).css({"background-color":"green","color":"white"});
   
    }
    // change state of number key for value 
    target = focused ;
      $('#' + focused).text('') ;

})
    })
</script>

<script>
$(document).ready(function(){

    $("[id^=key-]").click(function(){

     
  //   alert(t + ' ' + clickedAddend);
       
    clicked = $(this).attr("id"); // get id of the key 
    keyNumber = parseInt(clicked.substr(4));  // remove key-
    
// alert(clicked + " " + keyNumber);
var n = keyNumber ;
console.log(n,numb[n].numerator,numb[n].denominator ) ;
var numerator = numb[n].numerator;
var denominator = numb[n].denominator;

// $('#'+target).html(term) ;
// key = target ;
// MathJax.Hub.Queue(["Typeset", MathJax.Hub, key]);
   // $('#'+target).val(clickedNumber) ;
  //  alert("focused is now " + target) ;

 
// alert(clickedAddend);

   
  // alert("Before if t =  " + t + ' lastClick =  ' + clickedAddend);
    
      if (clickedAddend ==  true)
      { 
        mapped[addendNumber] = keyNumber;
        console.log("addend ",addendNumber,"key",keyNumber);
        console.log("mapped",mapped) ;
        var key = 'addend' + addendNumber ;
var  term = '$ \\frac{ ' + numerator + '} {' + denominator + '} $' ;

  // alert(term)
      $('#addend'+addendNumber).html(term);
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, key]);
        //$('#'+focused).val(clickedNumber);  // update input box
     
         
 // alert("Test value when reset " + t);
clickedAddend = false ;

   //    alert(clickedNumber + focused) ;
   // var n = focused.charAt(focused.length-1); // get position of focused ID
  
     //   console.log("Update = ",clickedNumber);
    //    console.log("key",clicked,clickedNumber,focused,lastChar);
        $('#key-'+n).prop('disabled', true).css({"background-color":"pink","color":"red"}) ;
     
      }
    
var s = [];
s  = check15() ;

var row1 = s[1] + s[2] + s[3];
  var row2 = s[4] + s[5] + s[6]  ;
  var row3 = s[7] + s[8] + s[9];
  var col1 = s[1] + s[4] + s[7] ;
  var col2 = s[2] + s[5] + s[8];
  var col3 = s[3] + s[6] + s[9] ;
  var diag1 = s[1] + s[5] + s[9];
  var diag2 = s[7] + s[5] + s[3] ;
console.log(s) ;
console.log(row1,row2,row3,col1,col2,col3,diag1,diag2) ;
if (row1 == sum & row2 == sum & row3 == sum & col1 == sum & col2 == sum  & col3 == sum & diag1 == sum & diag2 ==sum)

{



     var pts = parseInt($('#total').text());
     pts = parseInt(pts);
     points = parseInt(points) ;
     console.log("points",pts);
     pts = parseInt(pts + points);
     console.log("points",pts);
     $('#total').text(pts);
    alert("You have solved the puzzle!");
    $('#menu').show();
  
processWin(questionID);
    
     $('#play').empty().show();
     $('#q8').prop('disabled',true).css({"background-color":"blue","color":"yellow"});
      
 


}

})
})

</script>



