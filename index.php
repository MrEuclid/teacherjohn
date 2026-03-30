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
            <a href="/monopoly/adminMonopoly.php" target="_blank"><button class="btn btn-warning">Monopoly Admin</button></a>
            <a href="/monopoly/indexMonopoly.php" target="_blank"><button class="btn btn-warning">Monopoly login</button></a>
            <a href="/askTheAudience/indexTeacher.php" target="_blank"><button class="btn btn-info">Teacher</button></a> 
            <a href="/askTheAudience/indexStudent.php" target="_blank"><button class="btn btn-info">What do you know?</button></a> 
            <a href="/teacher.html" target="_blank"><button class="btn btn-info">Leaderboards</button></a>
            <a href="/certificates/indexCertificates.php"><button class="btn btn-info">TechnologyCertificates</button></a>
            <a href="https://docs.google.com/spreadsheets/d/1lEj53GVNF-46u-Jsn2Kl7CsHeh7zxI8XkQgVSfC71AE/edit?usp=sharing" target="_blank"><button class="btn btn-info">Timetable</button></a>
            <a href="https://docs.google.com/spreadsheets/d/1fE6w8fj-6yYWTG6xwaVyxTRCtX9l5U5lObbbLZO-jDM/edit?usp=sharing" target="_blank"><button class="btn btn-info">Tournament results</button></a>
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

  <a href = "words/indexWords.php"><button class = "btn btm sm btn-info">Word game</button></a>

  <a href = "translate/translatev2.html">
    <button class = "btn btm sm btn-info">Translation HS</button></a>
 <a href="/greenLight/greenLightApp.html"><button class="btn btn-success">Greenlight app</button></a> 
 
<a href="/escape/escape.html">
    <button class="btn btn-success">Cats & Tigers</button></a>
 
 
    <div class="row mt-3">
        <div class="col-12 text-center">
            <a href="indexTechnology.php"><button class="btn btn-success">Web apps</button></a>
            <a href="indexEbooks.html"><button class="btn btn-warning">eBooks</button></a>
            <a href="https://lichess.org" target="_blank"><button class="btn btn-info">Li-chess</button></a>
            <a href="https://chess.com" target="_blank"><button class="btn btn-info">chess.com</button></a>
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