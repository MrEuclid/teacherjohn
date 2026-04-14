<?php 
$question = $_POST['question'];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">

  <!-- Bootstrap CSS -->
  

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../bootstrap-5.0.2-dist/css/bootstrap.min.css">
  <script src="../javaScript/jQuery/jquery-3.3.1.min.js"></script>
  <script src="../bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>

  <style>
 h1 {color: blue; font-size: 2em; text-align: center; font-weight:bolder;}

h2 {color: green; font-size: 1.2em; text-align: center; }

li {text-align: left;}
  </style>

</head>

<body>
    <div class  = "container-fluid">

         <div class = "row">
        
        <div class = "col- text-center">
  <h1>4 Colour Game </h1>
  <div>
    <canvas id="canvas" width = "300" height = "300" style="border: solid 1px; margin: 10px;"></canvas>
  </div>
  <!--
  <a href = "4color.php"><button id = "restart">Restart</button></a>
-->
  <!--
    <label id = "howMany">Choose number of columns (2 - 20) </label>

  -->
  <input type = "text" id = "cols" min="2" max = "20" value="12" hidden="TRUE">
  <button id="draw"> Draw </button>

  <button  id = "check">Check</button>
  <!-- <button id="test"> Test </button> -->

</div></div>

<div class = "row">
        
        <div class = "col- text-center">
<h2>Rules</h2>
<p id = "message">
  <ul>
    <li>Colour all of the rectangles.</li>
    <li>You can only use 4 colours.</li>
    <li>If the sides of two rectangles touch, the recatangles must be different colors.</li>
    <li>Rectangle that only meet a t point can be the same color.</li>
  </ul>
</p>
<p id = "report"></p>
</div></div>
</div>

</body>
</html>
<script>
$(document).ready(function(){

    //columnNum = 6 ;  // set numberof columns

    question = '<?php echo $question; ?>' ;
points = parseInt(question.substr(-1));
console.log(question,points);
// alert(question + ' ' + points);
    green = '#32a852';
    red = '#e8090d' ;
    blue = '#1a20d9' ;
    white = '#FFFFFF' ;

  //  var colors = ['#FFFFFF','#6495ED', '#FF8C00', '#90EE90', '#800080', '#FF6347', '#FAEBD7'] ;
    colors = [white, green, red,blue] ;


    //source: https://stackoverflow.com/questions/9880279/how-do-i-add-a-simple-onclick-event-handler-to-a-canvas-element
    // For Click events
    elem = document.getElementById('canvas');
    elemLeft = elem.offsetLeft ;
    elemTop = elem.offsetTop ;
    context = elem.getContext('2d');
    elements = [];  // stores elements
    rectangles = [] ;// store rectangle number, top left coordinates, width and height

    $('#check').hide() ;
    $('#cols').show() ;
    $('#howMany').show() ;


})

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

<script type="text/javascript">
  
  function regionReport(rectangles)

  {
    // finds the neighbours for each region

    for (var i = 0; i < rectangles.length ; i++)
    {
//console.log(i,rectangles[i]);
      neighbours = [] ;
    for (var j = 0 ; j < rectangles.length  ; j++)
      {
      var foundTop = isR1OnTopOfR2(rectangles[i],rectangles[j]);  // is rect2 on top of rect1
      if (foundTop) {neighbours.push(j) ;}

      var foundBottom = isR1BeneathR2(rectangles[i],rectangles[j]);  // is rect2 on top of rect1
      if (foundBottom) {neighbours.push(j) ;}

      var foundLeft = isR1LeftOfR2(rectangles[i],rectangles[j]);  // is rect2 on top of rect1
      if (foundLeft) {neighbours.push(j) ;}

      var foundRight = isR1RightOfR2(rectangles[i],rectangles[j]);  // is rect2 on top of rect1
      if (foundRight) {neighbours.push(j) ;}

      
    } // j

  //   alert('i = ' + i  + ' has    ' + neighbours); 
      rectangles[i]["contacts"] = neighbours ;

      console.log('check showed ',i,j,rectangles[i],rectangles[j],neighbours);
  } // i
}  // function
</script>

  <script type="text/javascript">
    

    function isR1OnTopOfR2(r1,r2)

      {

// is r2 touching the top of r1
// requires that the base of r2 touches the top of r1
// need to be on the same y = left line

        var topTouch = false ;
        var check1 = false ;
        var check2 = false ;
      

        var x1 = r1.left ;
        var x2 = r2.left ;
        var y1 = r1.top ;
        var y2 = r2.top ;
        var w1 = r1.width ;
        var w2 = r2.width ;
        var h1 = r1.height ;
        var h2 = r2.height ;

        bottomLeftX1 = x1 ;
        bottomLeftY1 = y1 + h1 ;
        bottomRightX1 = x1 + w1 ;
        bottomRightY1 = y1 + h1 ;

     



check1 = (bottomLeftY1 == y2);  // same y value 
check2 = (bottomLeftX1 >  (x2 - w2)) && (bottomLeftX1 < (x2 + w2) ) ; // on line not just one vertex




if (check1 && check2 )
{topTouch = true ;}



return topTouch ;


}




    function isR1BeneathR2(rect1,rect2)

      {

// same as onTop but swap r1 and r2
       
        var temp = rect1 ;
        var r1 = rect2 ; 
        var r2 = temp ;



        var bottomTouch = false ;
        var check1 = false ;
        var check2 = false ;
     

        var x1 = r1.left ;
        var x2 = r2.left ;
        var y1 = r1.top ;
        var y2 = r2.top ;
        var w1 = r1.width ;
        var w2 = r2.width ;
        var h1 = r1.height ;
        var h2 = r2.height ;

        bottomLeftX1 = x1 ;
        bottomLeftY1 = y1 + h1 ;
        bottomRightX1 = x1 + w1 ;
        bottomRightY1 = y1 + h1 ;

     



check1 = (bottomLeftY1 == y2);  // same y value 
check2 = (bottomLeftX1 >  (x2 - w2)) && (bottomLeftX1 < (x2 + w2) ) ; // 




if (check1 && check2 )
{bottomTouch = true ;}



return bottomTouch ;


}


    function isR1LeftOfR2(r1,r2)

      {

     

        var leftTouch = false ;
        var check1 = false ;
        var check2 = false ;
     

        var x1 = r1.left ;
        var x2 = r2.left ;
        var y1 = r1.top ;
        var y2 = r2.top ;
        var w1 = r1.width ;
        var w2 = r2.width ;
        var h1 = r1.height ;
        var h2 = r2.height ;

        topRightX1 = x1 + w1 ;
        toprightY1 = y1  ;
        bottomRightX1 = x1 + w1 ;
        bottomRightY1 = y1 + h1 ;


check1 = (topRightX1 == x2);  // same y value 
check2 = (bottomRightY1 <  (y2 + h2 + h1)) && (bottomRightY1 > y2)  ; // h2 + h1 = height r1 + height r2 

// check2 = true ;

if (check1 && check2 )
{leftTouch = true ;}



return leftTouch ;


}



    function isR1RightOfR2(r1,r2)

      {


        var rightTouch = false ;
        var check1 = false ;
        var check2 = false ;
   

        var x1 = r1.left ;
        var x2 = r2.left ;
        var y1 = r1.top ;
        var y2 = r2.top ;
        var w1 = r1.width ;
        var w2 = r2.width ;
        var h1 = r1.height ;
        var h2 = r2.height ;

        topLeftX1 = x1  ;
        topLeftY1 = y1  ;
        bottomLeftX1 = x1  ;
        bottomLeftY1 = y1 + h1 ;


check1 = (topLeftX1 == x2 + w2);  // same y value 
check2 = (bottomLeftY1 <  (y2 + h2 + h1)) && (bottomLeftY1 > y2)  ; // h2 + h1 = height r1 + height r2 

// check2 = true ;

if (check1 && check2 )
{rightTouch = true ;}



return rightTouch ;


}

  </script>

  <script>
    //Variables for creating paddocks

    // Add event listener for `click` events.
  

  
    var green = '#32a852';
    var red = '#e8090d' ;
    var blue = '#1a20d9' ;
    var white = '#FFFFFF' ;
  
4
  //  var colors = ['#FFFFFF','#6495ED', '#FF8C00', '#90EE90', '#800080', '#FF6347', '#FAEBD7'] ;
    var colors = [ white, green, red,blue] ;


    //source: https://stackoverflow.com/questions/9880279/how-do-i-add-a-simple-onclick-event-handler-to-a-canvas-element
    // For Click events
    var elem = document.getElementById('canvas')
    var elemLeft = elem.offsetLeft
    var elemTop = elem.offsetTop
    var context = elem.getContext('2d')
    var elements = [];  // stores elements
    var rectangles = [] ;// store rectangle number, top left coordinates, width and height



    elem.addEventListener('click', function(event) {
      var x = event.pageX - elemLeft,
        y = event.pageY - elemTop;
      var touchHorizontal = false ;
      var touchVertical = false ;
      elements.forEach(function(element) {
        if (y > element.top && y < element.top + element.height && x > element.left && x < element.left + element.width) {

          for(var i = 0; i < colors.length; i++){
            if (element.colour == colors[i]){
              element.colour = colors[((i + 1) % colors.length)];
              var N = element.rectangleNumber;
              console.log('i x y topXY width height ',i,x,y,
                element.top,element.left,element.width,element.height,element.rectangleNumber,element.colour);

          //    alert('N = ' + N);
              break;
            }
          }



          context.moveTo(element.left,element.top);

          context.beginPath();
          context.lineTo((element.left + element.width), element.top);
          context.lineTo((element.left + element.width), (element.top + element.height));
          context.lineTo(element.left, (element.top + element.height));
          context.lineTo((element.left),element.top)
          context.closePath();

          context.fillStyle = element.colour;
          context.fill();
          context.stroke();
        }
      });

    }, false);

    $("#draw").on("click", function() {
      var canvas = document.getElementById("canvas");
      var ctx = canvas.getContext("2d");

      columnNum = parseInt($('#cols').val()) ;
  

      $('#check').show() ;
      $('#draw').hide() ;
      $('#cols').hide() ;
      $('#howMany').hide() ;


      var width = document.getElementById("canvas").width; //  canvas width
      width *= 1;
      var height = document.getElementById("canvas").height;  // canvas height
      height *= 1;
      console.log('canvas width and height + columns',width,height,columnNum) ;
      var columnWidth = width / columnNum;  // 
   //   alert('width + height ' + width + ' ' + height + '  ' + columnNum) ;
   // initialise rectangle parameters
    var  rectangleNumber = 0;

      
      for (var i = 0; i < columnNum; i++) {
        var filled = 0;  // amount of rectangle filled ?




        while (filled < height) {
          do {
            var h = Math.ceil(Math.random() * 10)  ; // h is between 1 and 10 
          //  h = i + 1; // for testing purposes
            h *= 50;  ; // times 50 
         
         
   

          }  // filled < height
          
          while (h > (height - filled))  // work down the column adding rectangles if ther eis space to do so.

          
           //   alert('h = ' + h) ;
        //  console.log('i h',i,h)
          ctx.moveTo((columnWidth * i), filled);
          ctx.beginPath();

          ctx.lineTo((columnWidth * (i + 1)), filled);
          ctx.lineTo((columnWidth * (i + 1)), (filled + h));
          ctx.lineTo((columnWidth * i), (filled + h));
          ctx.lineTo((columnWidth * i), filled)
          ctx.closePath();
          ctx.stroke();
          
          ctx.fillStyle = blue ;
   
          elements.push({
            rectangleNumber,
            colour: white,
            width: columnWidth,
            height: h,
            top: filled,
            contacts : [] ,
            left: (columnWidth * i)
          });
         // console.log('elements',elements);
          filled += h;  // increase filled by h
          rectangleNumber++ ;
            
        }  // end of while 
      }  // end of for loop


      // add neighbours for each element


      

      rectangles = elements.slice();
      console.log('Rectangles') ;

      // find neighbours of rectangles[0] 
      for (var i = 0 ;i < rectangles.length -1; i++)
     { 

      for (var j = i ; j < rectangles.length - 1 ; j++)
      {
      var foundTop = isR1OnTopOfR2(rectangles[i],rectangles[j]);
      var foundBottom = isR1BeneathR2(rectangles[i],rectangles[j]);
      var foundLeft = isR1LeftOfR2(rectangles[i],rectangles[j]);
      var foundRight = isR1RightOfR2(rectangles[i],rectangles[j]);



     console.log('check showed ',i,j,rectangles[i]["colour"],rectangles[j]["colour"],foundTop,foundBottom,foundLeft,foundRight);
    }
  }

    })




  </script>

  <script type="text/javascript">
  
       $("#check").on("click", function() {

        alert('Checking answer ');  // report on colour of neighbours
        $('#report').empty() ;

        var paddocks = elements.length ;
        $('#report').append('There are ' + paddocks + ' regions' + '<br>');
        $('#report').append('Here is their status' + '<br>');

        var regions = elements.slice() ;

        regionReport(regions);
          var uniqueCount = 0 ;

        for (var i = 0 ; i < regions.length; i++)
        {
          var id = regions[i].rectangleNumber;
          var hue = regions[i].colour; // colour of the region being checked
          var touching = '' ;
          var contactColours = [] ; // colours of touching regions
        
          for (var j = 0 ; j < regions[i].contacts.length ; j++)
          {
            var neighbour = regions[i].contacts[j];
            touching = touching + neighbour + ' * ';

            var touchedColour = regions[neighbour].colour ;
            contactColours.push(touchedColour);
          //  alert('Contact colours ' + contactColours);
            touching = touching + ' = ' + touchedColour + '**';
          }  // j loop
          var unique = contactColours.indexOf(hue) ;  // look for colour of region in array of neighbours colours
          if (unique < 0) 
            {
              unique = true; // if not found index = -1 and unique = true
              uniqueCount++ ;
            } 
            else 
              {
                unique = false;

              }  
        
           $('#report').append('id '+ id + ' colour ' + hue + 'contact ' + touching + ' unique ' + unique + '<br>');
          
        } // i loop

        if (uniqueCount == paddocks) 
          {
     //       alert('You win!' + uniqueCount + '/' + paddocks ) ;
      //      alert("You have solved it!");
// alert("Processing win " + questionID + " with " + points + " pts");
processWin(questionID);
    console.log("processing ",questionID);
      
          } 
        else {alert('Keep trying ' + uniqueCount + '/' + paddocks ); }
        

       })

  </script>

</div>
</body>

</html>
<script type="text/javascript">
  
  $(document).ready(function(){
  $('#retry').on('click', function()
{

  $('#menu').hide() ;
  $('#play').show() ;

 $('#play').load("4color.php",{question: value}) ;

})
})


</script>  