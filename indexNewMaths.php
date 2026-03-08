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
        .btn {color: #ffffff !important; /* Forces white text, overriding other styles */}

        .header-section { margin-top: 20px; margin-bottom: 30px; }
        
        /* Uniform Button Container */
        .math-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        .footer-text { margin-top: 50px; color: #6c757d; }
    </style>
</head>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/header.php'); ?>


<div clas s= "row>">
<div class = "col-12 text-center">
  <button class = "btn btn-info btn-lg">G3 - G4</button>
   <button class = "btn btn-primary btn-lg">G5 - G6</button> 
    <button class = "btn btn-success btn-lg">G7 - G8</button> 
     <button class = "btn btn-warning btn-lg">G9 - G10</button>
    <button class = "btn btn-danger btn-lg">G11 - G12</button> 

  </div></div>

    <div class="container-fluid">
        <div class="header-section text-center">
            <h1 class="display-6 fw-bold text-primary">New Maths Apps</h1>
        </div>
<div class = "row text-center">
    <p class = "h2">G3 - G4</p>
</div>

<div class="math-grid">
   <a href="jimmyGame/jimmyMath.html"><button class="btn btn-info">Jimmy Gemini</button></a>
    <a href="pyramidGame/pyramids.html"><button class="btn btn-info">Pyramids</button></a>
</div>

<div class = "row text-center">
    <p class = "h2">G5 - G6</p>
</div>
<div class="math-grid">
       <a href="dragons/dragons.html"><button class="btn btn-primary ">Dragons</button></a>
        <a href="escape/escape.html"><button class="btn btn-primary">Escape</button></a>
     <a href="jimmyGame/jimmyMath.html"><button class="btn btn-primary">Jimmy Gemini</button></a>
      <a href="decimalFractionPercent.php"><button class="btn btn-primary">Percent</button></a>

</div>

<div class = "row text-center">
    <p class = "h2">G7 - G8</p>
    <div class="math-grid">
     <a href="crossNumber/crossNumberGemini"><button class="btn btn-success">Crossnumber</button></a>
    <a href="egyptian/egyptianFractions.php"><button class="btn btn-success">Egyptian fractions</button></a>
      <a href="escape/escape.html"><button class="btn btn-success">Escape</button></a>
       <a href="greenLight/greenLightApp.html" target="_blank"><button class="btn btn-success">Green Light</button></a>
           <a href="numberRace/countDownNumbersLoad.html"><button class="btn btn-success">Number Race</button></a>
</div>


</div>

<div class = "row text-center">
    <p class = "h2">G9 - G10</p>
    <div class="math-grid">
           <a href="crossNumber/crossNumberHarder"><button class="btn btn-warning">Crossnumber</button></a>
              <a href="crossNumber/crossNumberFractions"><button class="btn btn-success">Crossnumber fractions</button></a>
    <a href="egyptian/egyptianFractions.php"><button class="btn btn-warning">Egyptian fractions</button></a>
      <a href="escape/escape.html"><button class="btn btn-warning">Escape</button></a>
      <a href="functionMachine/functionMachine.html"><button class="btn btn-warning">Func. Machine</button></a>
       <a href="greenLight/greenLightApp.html" target="_blank"><button class="btn btn-warning">Green Light</button></a>
           <a href="numberRace/countDownNumbersLoad.html"><button class="btn btn-warning">Number Race</button></a>
</div>
</div>

<div class = "row text-center">
    <p class = "h2">G10 - G12</p>
</div>

        <div class="math-grid">
               <a href="crossNumber/crossNumberCalxulus"><button class="btn btn-danger">Crossnumber</button></a>
                     <a href="crossNumber/crossNumberFractionsHarder"><button class="btn btn-success">Crossnumber fractions</button></a>
        </div>

        <div class="footer-text text-center">
            <h3>Study - Learn - Achieve</h3>
        </div>
    </div>
</body>
</html>