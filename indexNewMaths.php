<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Maths</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="raceGeminiStyles.css">
    
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/7.5.1/math.min.js"></script>

    <style type="text/css">
        body { background-color: #f0f2f5; }
        
        .header-section { margin-top: 20px; margin-bottom: 30px; }
        
        /* Uniform Button Container */
        .math-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        /* Fixed Size Buttons */
        .shape {
            width: 180px;
            height: 160px;
            margin: 0 !important;
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            font-weight: bold;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border: none;
            padding: 10px;
        }

        .shape:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            filter: brightness(1.1);
        }

        .shape img {
            height: 65px;
            width: auto;
            margin-bottom: 12px;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
        }

        .footer-text { margin-top: 50px; color: #6c757d; }
    </style>
</head>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/header.php'); ?>

    <div class="container-fluid">
        <div class="header-section text-center">
            <h1 class="display-6 fw-bold text-primary">The PIO Temple of Learning</h1>
            <h2 class="text-secondary h4">New Maths Apps</h2>
        </div>

        <div class="math-grid">
            <a href="benny/equationsG6v7.php"><button class="btn btn-success shape"><img src="images/equationGame.png"><br>Equations</button></a>
            <a href="grade6Maths/grade6MathsRevision.html"><button class="btn btn-success shape"><img src="images/g6maths.png"><br>G6 Revision</button></a>
            <a href="travelGame/indexTravelGameG7.html"><button class="btn btn-success shape"><img src="images/travel9.png"><br>Travel G7</button></a>
            <a href="travelGame/indexTravelGameG9.html"><button class="btn btn-success shape"><img src="images/travel9.png"><br>Travel G9</button></a>
            <a href="indexSecondaryMathsTests.php"><button class="btn btn-success shape"><img src="images/g9Tests.png"><br>Tests G9</button></a>
            <a href="jimmyGame/jimmyMath.html"><button class="btn btn-success shape"><img src="images/jimmyNew180120.png"><br>Jimmy Gemini</button></a>
            <a href="changeMoneyGeneric.html"><button class="btn btn-success shape"><img src="images/money.png"><br>Change Money</button></a>
            <a href="decimalFractionPercent.php"><button class="btn btn-success shape"><img src="images/percent.png"><br>Percent</button></a>
            <a href="dragons/dragons.html"><button class="btn btn-success shape"><img src="images/dragons.png"><br>Dragons</button></a>
            <a href="escape/escape.html"><button class="btn btn-success shape"><img src="images/cat.png"><br>Escape</button></a>
            <a href="greenLight/greenLightApp.html" target="_blank"><button class="btn btn-success shape"><img src="images/lightsEasy.png"><br>Green Light</button></a>
            <a href="functionMachine/functionMachine.html"><button class="btn btn-success shape"><img src="functionMachine/fm.png"><br>Func. Machine</button></a>
            <a href="fractionsG6.html"><button class="btn btn-success shape"><img src="images/fractions.png"><br>Fractions</button></a>
            <a href="numberRace/countDownNumbersLoad.html"><button class="btn btn-success shape"><img src="images/numberRace.png"><br>Number Race</button></a>
        </div>

        <div class="footer-text text-center">
            <h3>Study - Learn - Achieve</h3>
        </div>
    </div>
</body>
</html>