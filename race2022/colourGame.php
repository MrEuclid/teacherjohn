<?php 
$question = $_POST['question'];
?>

<!DOCTYPE html>
<!-- new version up to 4 shades of each colour 0%, 25%,50%, 100% -->
<head>

  
<title>Colour game</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="../bootstrap-5.0.2-dist/css/bootstrap.min.css">
  <script src="../javaScript/jQuery/jquery-3.3.1.min.js"></script>
  <script src="../bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    

    <style type="text/css">

hr {

height: 2px;

background-color:#555;

margin-top: 20px;

margin-bottom: 20px;

width: 75%;

}

.c {
     text-align: center;
     margin-right: auto;
     margin-left: auto;
     margin: 0 ;
   } 

   h1
   { 
     color:blue; 
   } 
 h2 
   { 
     color:green; 
   } 

 h4 
   {
     color:orange ;
   }

   [id^=btn] {width:160px; height:40px ; 
                      background-color: lightblue; color:white; 
                      font-size: 12pt; font-weight: bolder;
                      margin:10px ; }
   #model {width:240px; height:160px ;}
   #palette {margin:20px ; padding:5px ; width:160px ; height:40px ; 
    font-size:14pt ; font-weight: bolder; color:white;}

#clear {margin: 10px ;}

#btnRed,#btnGreen, #btnBlue {background-color: white;} 
  </style>

  </head>

  <body>
<hr>
    <div class = "container-fluid">
      <div class = "row">
        <div class = "col-xs-12 c">
          <h1>
          Make the Colour
  
          </h1>
        </div></div>
     


<div id = "main">
 

            <div class = "row">
          <div class = "col-xs-12 c">
            <button id = "model"></button>
          </div></div>

          <div class = "row">
            <div class = "col-xs-12 c">
             <button id = "palette">Check</button>
            </div></div>

            <div class = "row">
              <div class = "col-xs-12 c">
                <button id = "btnRed100"></button>
                <button id = "btnGreen100"></button>
                <button id = "btnBlue100"></button>
              </div></div>

              <div class = "row">
                <div class = "col-xs-12 c">
                  <button id = "btnRed75"></button>
                  <button id = "btnGreen75"></button>
                  <button id = "btnBlue75"></button>
                </div></div>

              <div class = "row">
                <div class = "col-xs-12 c">
                  <button id = "btnRed50"></button>
                  <button id = "btnGreen50"></button>
                  <button id = "btnBlue50"></button>
                </div></div>

                <div class = "row">
                  <div class = "col-xs-12 c">
                    <button id = "btnRed25"></button>
                    <button id = "btnGreen25"></button>
                    <button id = "btnBlue25"></button>
                  </div></div>

                  <div class = "row">
                    <div class = "col-xs-12 c">
                      <button id = "btnRed0"></button>
                      <button id = "btnGreen0"></button>
                      <button id = "btnBlue0"></button>
                    </div></div>

                 
                    <hr>
                    

                    <div class = "row">
                      <div class = "col-xs-12 c">
                        <button id = "btnRed"></button>
                        <button id = "btnGreen"></button>
                        <button id = "btnBlue"></button>
                      </div></div>
</div> <!-- main -->
  </div> <!-- container -->

  </body>
  </html>

 

  <script type="text/javascript">
    $(document).ready(function(){


      question = '<?php echo $question; ?>' ;
points = question.substr(-1);

  $('#btnRed').prop('disabled',true);   
  $('#btnGreen').prop('disabled',true); 
  $('#btnBlue').prop('disabled',true);  
    
// colour the buttons 

for (i = 0; i <= 100 ; i = i+25)
{
  colorRed = 'rgb(' + i + '%,0%,0%)';
 

  colorGreen = 'rgb(0%,' + i + '%,0%)';
 

  colorBlue = 'rgb(0%,0%,' + i + '%)';
 
  
  $('#btnRed' + i).css({'background-color': colorRed}) ;
  $('#btnRed' + i).text(i + '%') ;

  $('#btnGreen' + i).css({'background-color': colorGreen}) ;
  $('#btnGreen' + i).text(i + '%') ;

  $('#btnBlue' + i).css({'background-color': colorBlue}) ;
  $('#btnBlue' + i).text(i + '%') ;
 
}

  
    $('#gameLevels').show() ;
    $('#main').hide() ;
    $('#scoreButtons').hide() ;

        })
    </script>

<script type="text/javascript">
  function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

</script>
 
  <script type="text/javascript">
    $(document).ready(function(){
   

   level = 4;
    clicks = 0 ; 
 


 
    $('#playingLevel').text(level) ;
    $('#gameLevels').hide() ;
    $('#main').show() ;

    x = getRandomInt(1,level) ;
    y = getRandomInt(1,level) ;
    z = getRandomInt(1,level) ;

     rM = x*100/level;
     gM = y*100/level;
     bM=  z*100/level;
/*
     if (rM < 0 ) {rM = 0 ;}
     if (gM < 0 ) {gM = 0 ;}
     if (bM < 0 ) {bM = 0 ;}

*/ 

     // P palette

     rP = 0 ;
     gP = 0 ;
     bP = 0 ;

     colorM = "rgb(" + rM + "%,"  + gM + "%," + bM + "%)";
     colorP = "rgb(" + rP + "%,"  + gP + "%," + bP + "%)";

     $('#model').css({'background-color': colorM }) ;
     $('#palette').css({'background-color': colorP }) ;   




     $('#answer').text(colorM);
     
     $('#palette').text('Check') ;  
         })
      
   </script>

<script type="text/javascript">
  $(document).ready(function(){
      $('[id^=btn]').on("click", function(event) {

        colorP = "rgb(" + rP + "%,"  + gP + "%," + bP + "%)";
        

        var t = this.id ;

        if (t != 'btnRed' | t != 'btnGreen' | t != 'btnBlue')
        {$('[id^=btn]').prop('disabled',false);}

        $('#btnRed').prop('disabled',true);   
  $('#btnGreen').prop('disabled',true); 
  $('#btnBlue').prop('disabled',true); 
        var bid = this.id ;
        $('#'+bid).prop('disabled',true);

        var cid = bid.substr(3,1) ;
        if (cid == 'R')
        {
          rP = bid.substr(6,3);
      var cR = 'rgb(' + rP + '%,0%,0%)';
      $('#btnRed').css({'background-color':cR});
      $('#btnRed').text(rP + '%');
 
         // alert(bid + ' ' + cid + ' ' + rP) ;
        }

        if (cid == 'G')
        {
          gP = bid.substr(8,3);
          var cG  = 'rgb(0%,' + gP + '%,0%)';
          $('#btnGreen').css({'background-color':cG}) ;
          $('#btnGreen').text(gP + '%');
         // alert(bid + ' ' + cid + ' ' + gP) ;
        }

        if (cid == 'B')
        {
          bP = bid.substr(7,3);
          cB = 'rgb(0%,0%,' + bP + '%)';
          $('#btnBlue').css({'background-color':cB});
          $('#btnBlue').text(bP + '%');
         // alert(bid + ' ' + cid + ' ' + bP) ;
        }



     

        colorP = "rgb(" + rP + "%,"  + gP + "%," + bP + "%)";
        
        $('#palette').css({'background-color': colorP }) ; 

        clicks++ ;
        $('#score').text(clicks);


      })
    })

</script>

<script type="text/javascript">
  $(document).ready(function(){
     $('#clear').on("click", function(event) {

     clicks = 0 ;
      $('#score').text(clicks) ;

      rP = 0 ;
      gP = 0 ;
      bP = 0 ;

      colorP = "rgb(" + rP + "%,"  + gP + "%," + bP + "%)";
        
        $('#palette').css({'background-color': colorP }) ; 
        
       })
     })
 </script>

<script type="text/javascript">
  $(document).ready(function(){
     $('#palette').on("click", function(event) {
         

         console.log("Checking",colorP,colorM);

         if (colorP == colorM)
         {



      processWin(questionID);

      /*
             var pts = parseInt($('#total').text());
     
     console.log("points",pts);
     pts = pts + parseInt(points);
     console.log("points now ",pts);
     $('#total').text(pts);

    $('#menu').show();
  
alert("You have found the colour!");
     $('#play').empty().show();
     $('#q17').prop('disabled',true).css({"background-color":"blue","color":"yellow"});

     var t = team.split("*");
    var teamName = t[1];
    var grade = t[0] ;
    var score = $('#total').text() ;
    var timer = $('#timer').text() ;

     console.log("output",teamName,score,timer,grade,question,questionID);
    updateDatabase(teamName,score,timer,question,grade,questionID);

     */

         }
         else 
         {
             alert('Keep trying.') ;
         }

       })
     })
 </script>

