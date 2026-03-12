<?php 
 $question = isset($_POST['question']) ? $_POST['question'] : '';
// line intersecting a parabola at AB, find the length of AB
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Stats - Donuts</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/11.8.0/math.min.js"></script>

  <script type="text/x-mathjax-config">
    MathJax.Hub.Config({
      extensions: ["tex2jax.js"],
      jax: ["input/TeX","output/HTML-CSS"],
      tex2jax: {inlineMath: [["$","$"],["\\(","\\)"]]}
    });
  </script>   
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.7/MathJax.js"></script>
  <script src="javascript/utilities.js"></script>
  
  <style>
    #summary {text-align: center;}
    p {font-size: 1.2em;}
    [id^=solution]  {text-align: center; margin-bottom:1em;}
    [id^=check] {margin-bottom:1em;}
    [id^=equation] {margin-bottom:1em;}
    label {font-weight: bold; color:black;}
    input {
      text-align: center; 
      background-color: lightgreen; 
      font-size: 1.2em; 
      font-weight: bold;
      margin-right: 2em;
      width: 5em;
    }
    /* Provide minimum dimensions so charts render properly in Bootstrap columns */
    #chart_div, #chart2_div {
      min-height: 250px;
      width: 100%;
    }
    #dashboard_div {
      padding: 20px;
      background: #f8f9fa;
      border-radius: 8px;
      margin-bottom: 20px;
    }
  </style>
</head>

<body>
  <div class="container-fluid mt-4">
    
    <div class="row justify-content-center">
      <div class="col-12 text-center">
        <h3>Use the table and pie chart to answer these questions.</h3>
        <p>The graph and table show how many donuts were eaten by the people.</p>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-12">
        <div id="dashboard_div">
          <div class="row">
            <div class="col-md-6">
              <div id="filter_div" class="mb-3"></div>
              <div id="chart_div"></div>
            </div>
            <div class="col-md-6">
              <div id="gender_div" class="mb-3"></div>
              <div id="chart2_div"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row justify-content-center align-items-center mt-3">
      <div class="col-3 text-end"><div id="ex1"></div></div>
      <div class="col-4 text-end"><label id="equation1">How many people ate donuts?</label></div>
      <div class="col-2"><input id="solution1"></div>
      <div class="col-3"><button id="check1" class="btn btn-primary btn-sm">Check 1</button></div>
    </div>

    <div class="row justify-content-center align-items-center mt-3">
      <div class="col-3 text-end"><div id="ex2"></div></div>
      <div class="col-4 text-end"><label id="equation2">How many donuts did the youngest person eat?</label></div>
      <div class="col-2"><input id="solution2"></div>
      <div class="col-3"><button id="check2" class="btn btn-primary btn-sm">Check 2</button></div>
    </div>

    <div class="row justify-content-center align-items-center mt-3">
      <div class="col-3 text-end"><div id="ex3"></div></div>
      <div class="col-4 text-end"><label id="equation3">How many donuts were eaten by females?</label></div>
      <div class="col-2"><input id="solution3"></div>
      <div class="col-3"><button id="check3" class="btn btn-primary btn-sm">Check 3</button></div>
    </div>

    <div class="row justify-content-center align-items-center mt-3">
      <div class="col-3 text-end"><div id="ex4"></div></div>
      <div class="col-4 text-end"><label id="equation4">How many donuts by people aged 18 and older?</label></div>
      <div class="col-2"><input id="solution4"></div>
      <div class="col-3"><button id="check4" class="btn btn-primary btn-sm">Check 4</button></div>
    </div>

  </div> <script type="text/javascript">
    // Global variables accessible by both Google Charts and jQuery
    var d = [];
    var answer = [];
    var points = 0;
    var questionID = '<?php echo $question; ?>';

    // Fallback in case utilities.js is missing randomInteger
    function getRandInt(min, max) {
      return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    // AJAX-friendly initialization block
   // AJAX-friendly initialization block
    function initCharts() {
      google.charts.load('current', {'packages':['corechart', 'controls', 'table']});
      google.charts.setOnLoadCallback(drawDashboard);
    }

    // Detect environment: Dashboard vs Standalone
    if (typeof google !== 'undefined' && google.charts) {
      // 1. Dashboard Mode: Google is already loaded by the parent file
      initCharts();
    } else {
      // 2. Standalone Mode: Google is missing, so we dynamically inject the script
      var script = document.createElement('script');
      script.type = 'text/javascript';
      script.src = 'https://www.gstatic.com/charts/loader.js';
      script.onload = function() {
          // Once the script finishes downloading, initialize the charts
          initCharts(); 
      };
      document.head.appendChild(script);
    }

    function drawDashboard() {
      var limit = 8; // Array length is 8 to hold 7 people + header
      var names = [
        ['', ''], // Placeholder for index 0
        ['Dara', 'Female'],
        ['Liza', 'Female'],
        ['Reaksa', 'Male'],
        ['Dabin', 'Male'],
        ['Lina', 'Female'],
        ['Mara', 'Male'],
        ['Sophea', 'Female']
      ];

      d[0] = ['Name', 'Donuts eaten', 'Age', 'Gender'];
      for (var i = 1; i < limit; i++) {
        // Use randomInteger from your utilities.js, or the fallback
        let randDonuts = typeof randomInteger === "function" ? randomInteger(1,10) : getRandInt(1,10);
        let randAge = typeof randomInteger === "function" ? randomInteger(5,25) : getRandInt(5,25);
        d[i] = [names[i][0], randDonuts, randAge, names[i][1]];
      }

      var data = google.visualization.arrayToDataTable(d);
      var dashboard = new google.visualization.Dashboard(document.getElementById('dashboard_div'));

      var donutRangeSlider = new google.visualization.ControlWrapper({
        'controlType': 'NumberRangeFilter',
        'containerId': 'filter_div',
        'options': { 'filterColumnLabel': 'Donuts eaten' }
      });

      var genderSelector = new google.visualization.ControlWrapper({
        'controlType': 'CategoryFilter',
        'containerId': 'gender_div',
        'options': { 'filterColumnLabel': 'Gender' }
      });

      var pieChart = new google.visualization.ChartWrapper({
        'chartType': 'PieChart',
        'containerId': 'chart_div',
        'options': {
          'width': '100%',
          'height': '100%',
          'pieSliceText': 'value',
          'legend': 'right',
          'title': "Donuts Eaten by Person"
        }
      });

      var tableChart = new google.visualization.ChartWrapper({
        'chartType': 'Table',
        'containerId': 'chart2_div',
        'options': {
          'width': '100%',
          'height': '100%'
        }
      });

      dashboard.bind([donutRangeSlider, genderSelector], [pieChart, tableChart]);
      dashboard.draw(data);

      // Pre-calculate the answers immediately after generating the random data
      calculateAnswers();
    }

    function calculateAnswers() {
      // Q1: How many people ate donuts?
      answer[1] = d.length - 1;

      // Q2: How many donuts did the youngest person eat?
      // Use slice to copy the array so we don't accidentally mutate the chart data!
      let dataCopy = d.slice(1); 
      let sortedByAge = dataCopy.sort((a, b) => a[2] - b[2]);
      answer[2] = sortedByAge[0][1];

      // Q3: How many donuts were eaten by females?
      let femaleDonuts = 0;
      for(let i = 1; i < d.length; i++) {
        if(d[i][3] === 'Female') { femaleDonuts += d[i][1]; }
      }
      answer[3] = femaleDonuts; 

      // Q4: How many donuts by people aged 18 and older?
      let adultDonuts = 0;
      for(let i = 1; i < d.length; i++) {
        if(d[i][2] >= 18) { adultDonuts += d[i][1]; }
      }
      answer[4] = adultDonuts;
    }

    $(document).ready(function() {
      $('[id^=check]').on('click', function() {
        var clicked = this.id;
        var qNumber = clicked.slice(-1);
        var guess = $('#solution' + qNumber).val();

        if (guess == answer[qNumber]) {
          $('#solution' + qNumber).prop('disabled', true).css({"background-color":"lightgreen","color":"black"});
          $('#' + clicked).hide();
          
          points += 2;
          
          if (points == 8) {
            // Updated to use the correct function name from indexMathsComp.php
            if (typeof handleCorrectAnswer === "function") {
              handleCorrectAnswer();
            } else if (typeof processWin === "function") {
              processWin(questionID);
            } else {
              alert("Great job! You answered all questions correctly.");
            }
          }
        } else {
          alert("Keep trying!");
        }
      });
    });
  </script>
</body>
</html>