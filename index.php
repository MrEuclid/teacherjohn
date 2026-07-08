<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Teacher John home</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="raceGeminiStyles.css">
    
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/7.5.1/math.min.js"></script>

    <script type="text/x-mathjax-config">
        MathJax.Hub.Config({
            extensions: ["tex2jax.js"],
            jax: ["input/TeX","output/HTML-CSS"],
            tex2jax: {inlineMath: [["$","$"],["\\(","\\)"]]}
        });
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.7/MathJax.js?config=TeX-MML-AM_CHTML"></script>

    <style>
        body { background-color: #f8f9fa; }
        .c { text-align: center; padding: 15px; }
        .mara { width: 22%; height: auto; margin: 1%; transition: transform 0.2s; }
        .mara:hover { transform: scale(1.05); }
        button { margin: 0.25em; font-weight: 500; }
        h1 { margin: 20px 0; font-weight: bold; }
        #message { 
            max-width: 800px; 
            margin: 20px auto; 
            padding: 15px; 
            background: #fff; 
            border-radius: 8px; 
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>
  
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 c">
            <a href="/g11/quizMaster.php" target="_blank"><button class="btn btn-warning">Quiz Master</button></a>
            <a href="/g11/projector.html" target="_blank"><button class="btn btn-warning">Projector</button></a>
            <a href="/g11/leaderboard.html" target="_blank"><button class="btn btn-warning">Board</button></a> 
            <a href="/g11/g11_final.html" target="_blank"><button class="btn btn-info">What do you know?</button></a> 
            <a href="/teacher.html" target="_blank"><button class="btn btn-info">Leaderboards</button></a>
            <a href="https://docs.google.com/spreadsheets/d/1lEj53GVNF-46u-Jsn2Kl7CsHeh7zxI8XkQgVSfC71AE/edit?usp=sharing" target="_blank"><button class="btn btn-info">Timetable</button></a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-center">
            <h1>
                <img id="pio1" src="images/PioLogo.png" width="50" height="50">
                The Teacher John Site
                <img id="pio2" src="images/PioLogo.png" width="50" height="50">
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12 text-center">

  
 
   <a href = "factors/factorGameJSv2.php" target = "_blank"><button title = "Factors Game v2" class = "btn btn-info">Factor Game v2</button></a>
<a href = "scrabble/scrabbleComp2.html" target ="_blank"><button class = "btn btn-primary">Word Builder</button></a>
 <a href = "countDown/countDownWords.html" target = "_blank">
        <button class = "btn btn-info" title = "Spelling contests">Word race</button> </a>
<a href = "https://share.streamlit.io/?utm_source=streamlit&utm_medium=referral&utm_campaign=main&utm_content=-ss-streamlit-io-topright" target = "_blank">
        <button class = "btn btn-danger" title = "Streamlit">Streamlit</button> </a>

<a href = "maps/mapsIndex.html" target = "_blank">
        <button class = "btn btn-warning" title = "TSP map">Map</button> </a>
<a href = "maps/map.html" target = "_blank">
        <button class = "btn btn-warning" title = "TSP map">Map KH</button> </a>

 <div class="col-12 text-center">
            <a href="indexTechnology.php"><button class="btn btn-success">Web apps</button></a>
            <a href="indexEbooks.html"><button class="btn btn-warning">eBooks</button></a>
            <a href="https://lichess.org" target="_blank"><button class="btn btn-info">Li-chess</button></a>
            <a href="https://chess.com" target="_blank"><button class="btn btn-info">chess.com</button></a>
         <a href="https://docs.google.com/document/d/1CtWquQGC3F4kTp12L1owJOodMQ0Dp-aD-eGPK-V30sY/edit?usp=sharing" target="_blank"><button class="btn btn-info">Smart Maths</button></a>
<a href = "https://nrich.maths.org/problems/crossing-bridge" target = "_blank"><button class="btn btn-info">Cross the Bridge</button></a>

      
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-sm-12 c">
            <a href="indexReading.php"><img src="images/books.png" class="mara"></a>  
            <a href="indexNewEnglish.php"><img src="images/english.png" class="mara"></a>
            <a href="indexNewMaths.php"><img src="images/math.png" class="mara"></a>
            <a href="indexPuzzles.php"><img src="images/john.png" class="mara"></a> 
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12 c">
            <h2>Study - Learn - Achieve</h2>
            <h4>
                <img src="images/connectedCambodia.png" height="50">
                Supported by ConnectEd Cambodia and Temple Christian College
                <img src="images/templeChristian.png" height="50">
            </h4>
            <div id="message">
                “ConnectEd Cambodia and Temple Christian College are proud to support the work of PIO. It is so encouraging to see the way in which the technology that we have donated is being integrated into the school, and opening up fresh educational opportunities for the students.”
            </div>
        </div>
    </div>
</div>

<script> 
$(document).ready(function(){
    // Restoring your original PioLogo animation
    $('#pio1,#pio2').animate({marginTop: '50px'}).animate({marginTop: '0px'});
    
    $('#pio1,#pio2').click(function(){
        $(this).animate({marginTop: '500px'}).animate({marginTop: '0px'});
    });
});
</script> 
</body>
</html>