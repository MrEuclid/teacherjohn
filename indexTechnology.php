<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Temple of Technology</title>
  
  <!-- CSS Dependencies -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/templeStyles.css">
  <link rel="stylesheet" href="css/newTempleStyles.css">

  <style>
    body {
      background-color: #f8f9fa;
    }

    .header-section {
      padding: 20px 0;
      margin-bottom: 20px;
      border-bottom: 2px solid #eaeaea;
    }

    /* App Dashboard Flex Grid */
    .app-grid {
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
      justify-content: center;
      margin-bottom: 40px;
    }

    /* Modernized App Button */
    .app-btn {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      background-color: orange;
      color: black;
      font-weight: bolder;
      text-decoration: none;
      padding: 15px;
      border-radius: 12px;
      width: 130px;
      height: 130px;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
      border: none;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .app-btn:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 15px rgba(0,0,0,0.2);
      color: black;
    }

    .app-btn img {
      width: 50px;
      height: 50px;
      margin-bottom: 12px;
      object-fit: contain;
    }

    /* Secondary Action Buttons */
    .action-links {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      justify-content: center;
    }
  </style>
</head>
<body>
  
  <div class="container-fluid">
    
    <!-- Header -->
    <div class="row header-section">
      <div class="col-12 text-center">
        <a href="index.php" class="btn btn-success btn-lg px-5 shadow-sm">Home</a>
      </div>
    </div>

    <!-- Main App Buttons -->
    <div class="row">
      <div class="col-12">
        <div class="app-grid">
          <a href="https://webmail.pio-students.net" target="_blank" class="app-btn">
            <img src="images/roundcube_logo.png" alt="Email"> Email
          </a>    
          <a href="https://lunapic.com" target="_blank" class="app-btn">
            <img src="images/lunapic.png" alt="Lunapic"> Lunapic
          </a>   
          <a href="https://pixlr.com" target="_blank" class="app-btn">
            <img src="images/x-icon.svg" alt="Pixlr-X"> Pixlr-X
          </a> 
          <a href="https://scratch.mit.edu/" target="_blank" class="app-btn">
            <img src="images/cat.png" alt="Scratch"> Scratch
          </a> 
          <a href="https://appinventor.mit.edu/" target="_blank" class="app-btn">
            <img src="images/mit.png" alt="App Inventor"> App Inventor
          </a> 
          <a href="https://code.org/" target="_blank" class="app-btn">
            <img src="images/code.svg" alt="CodeAI"> CodeAI
          </a> 
          <a href="https://posit.cloud/" target="_blank" class="app-btn">
            <img src="images/rstudio.jpeg" alt="Posit Cloud"> Posit Cloud
          </a> 
          <a href="/monopoly/mBooks/mbooksv2.php" target="_blank" class="app-btn">
            <img src="monopoly/images/accountsImage.jpeg" alt="MBooks"> MBooks
          </a>
          <a href="https://microbit.org/" target="_blank" class="app-btn">
            <img src="images/microbit.png" alt="Microbit"> Microbit
          </a> 
          <a href="https://teachablemachine.withgoogle.com/" target="_blank" class="app-btn">
            <img src="images/tm.png" alt="ML"> ML
          </a> 
          <a href="https://pio-students.net/remote/indexRemote.php" target="_blank" class="app-btn">
            <img src="images/arduino.png" alt="Sensors"> Sensors
          </a> 
          <a href="https://pio-students.net/arduino/index.php" target="_blank" class="app-btn">
            <img src="images/arduino.png" alt="Arduino"> Arduino
          </a> 
          <a href="https://trinket.io" target="_blank" class="app-btn">
            <img src="images/python.jpeg" alt="Python"> Python
          </a> 
          <a href="https://www.microsoft.com/en-us/microsoft-365/free-office-online-for-the-web" target="_blank" class="app-btn">
            <img src="images/ms365.svg" alt="Office 365"> Office 365
          </a> 
          <a href="https://canva.com" target="_blank" class="app-btn">
            <img src="images/canva.svg" alt="Canva"> Canva
          </a> 
        </div>
      </div>
    </div>

    <!-- Secondary Database and Tools Links -->
    <div class="row mb-5">
      <div class="col-12 action-links">
        <a href="https://pio-students.net/photocertificates/viewStudents.html" target="_blank" class="btn btn-info text-white shadow-sm">View class</a>
        <a href="https://pio-students.net/certificates/studentLogin.php" target="_blank" class="btn btn-secondary shadow-sm">Certificates Database</a>
        <a href="https://pio-students.net/certificates/photoviewer.php" target="_blank" class="btn btn-secondary shadow-sm">Certificates Photos</a>
        <a href="https://pio-students.net/certificates/onePDFOutput.html" target="_blank" class="btn btn-secondary shadow-sm">Certificates</a>
        <a href="https://pio-students.net/certificates/synchCertificates.php" target="_blank" class="btn btn-secondary shadow-sm">Synch Table</a>
        <a href="teachableMachine/machineLearning.html" target="_blank" class="btn btn-secondary shadow-sm">Machine Learning</a>
        <a href="teachableMachine/arduinoInterface.html" target="_blank" class="btn btn-secondary shadow-sm">Arduino Interface</a>
        <a href="teachableMachine/flash.html" target="_blank" class="btn btn-secondary shadow-sm">Flash</a>
        <a href="teachableMachine/team.html" target="_blank" class="btn btn-secondary shadow-sm">Team Access</a>
      </div>
    </div>

  </div>

  <!-- Scripts -->
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
  <script type="text/javascript" src="javaScript/mathJax/MathJax-2.7.7/MathJax.js"></script>

</body>
</html>