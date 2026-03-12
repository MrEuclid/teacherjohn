<?php 
 $question = isset($_POST['question']) ? $_POST['question'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Stats - Column Chart</title>
  
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
    [id^=equation] {margin-bottom:1em; font-weight: bold; font-size: 1.2em; color: black;}
    label {font-weight: bold; color:black;}
    input {
      text-align: center; 
      background-color: lightgreen; 
      font-size: 1.2em; 
      font-weight: bold;
      width: 5em;
    }
    .google-visualization-table-td {
      text-align: center !important;
    }
    /* Prevent chart from collapsing when loaded via AJAX */
    #table {
      min-height: 400px;
      width: 100%;
      margin-bottom: 20px;
    }
  </style>
</head>

<body>
  <div class="container-fluid mt-4">

    <div class="row justify-content-center">
      <div class="col-12 text-center">
        <h3>Use the graph to answer these questions.</h3>
        <p>It shows the marks of G4 students in an English test.</p>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-12 col-md-10">
        <div id="table"></div>
      </div>
    </div>

    <div class="row justify-content-center align-items-center mt-3">
      <div class="col-3 text-end"><div id="ex1"></div></div>
      <div class="col-4 text-end"><label id="equation1">How many students sat the test?</label></div>
      <div class="col-2"><input id="solution1"></div>
      <div class="col-3"><button id="check1" class="btn btn-primary btn-sm">Check 1</button></div>
    </div>

    <div class="row justify-content-center align-items-center mt-3">
      <div class="col-3 text-end"><div id="ex2"></div></div>
      <div class="col-4 text-end"><label id="equation2">What percentage scored 10?</label></div>
      <div class="col-2 d-flex align-items-center">
        <input id="solution2" class="me-1"> <span class="fs-5 fw-bold">%</span>
      </div>
      <div class="col-3"><button id="check2" class="btn btn-primary btn-sm">Check 2</button></div>
    </div>

    <div class="row justify-content-center align-items-center mt-3">
      <div class="col-3 text-end"><div id="ex3"></div></div>
      <div class="col-4 text-end"><label id="equation3">What percentage of students score < 5?</label></div>
      <div class="col-2 d-flex align-items-center">
        <input id="solution3" class="me-1"> <span class="fs-5 fw-bold">%</span>
      </div>
      <div class="col-3"><button id="check3" class="btn btn-primary btn-sm">Check 3</button></div>
    </div>

    <div class="row justify-content-center align-items-center mt-3">
      <div class="col-3 text-end"><div id="ex4"></div></div>
      <div class="col-4 text-end"><label id="equation4">What was the average mark (2 dp)?</label></div>
      <div class="col-2"><input id="solution4"></div>
      <div class="col-3"><button id="check4" class="btn btn-primary btn-sm">Check 4</button></div>
    </div>

  </div> <script type="text/javascript">
    // Global tracking variables
    var points = 0;
    var answer = [];
    var dt; // DataTable instance
    var questionID = '<?php echo $question; ?>';

    // Fallback rounding function in case utilities.js doesn't load it
    function fallbackRound2DP(num) {
      return Math.round((num + Number.EPSILON) * 100) / 100;
    }

    // 1. BULLETPROOF GOOGLE CHARTS LOADER
    function loadGoogleCharts() {
      if (typeof google === 'object' && google.visualization && google.visualization.ColumnChart) {
        drawTable();
      } else if (typeof google === 'object' && google.charts) {
        google.charts.load('current', {'packages':['corechart', 'table']});
        google.charts.setOnLoadCallback(drawTable);
      } else {
        $.getScript('https://www.gstatic.com/charts/loader.js')
          .done(function() {
            google.charts.load('current', {'packages':['corechart', 'table']});
            google.charts.setOnLoadCallback(drawTable);
          })
          .fail(function() {
            document.getElementById('table').innerHTML = "<p class='text-danger text-center'>Failed to load Google Charts.</p>";
          });
      }
    }

    // 2. FETCH DATA AND DRAW CHART
    function drawTable() {
      // NOTE: If this fails in the dashboard, change the url to an absolute path 
      // (e.g., "/mathscomp/columnChartData.php")
      var rawData = $.ajax({
        url: "columnChartData.php",
        dataType: "json",
        async: false
      }).responseText;

      if (!rawData) {
        document.getElementById('table').innerHTML = "<p class='text-danger text-center'>Error: Could not load chart data from columnChartData.php.</p>";
        return;
      }
    
      dt = new google.visualization.DataTable(rawData);
      var view = new google.visualization.DataView(dt);
      
      view.setColumns([0, 1, { 
          calc: "stringify",
          sourceColumn: 1,
          type: "string",
          role: "annotation" 
      }]);
      
      var options = {
        title: "English marks",
        width: '100%',
        height: 400,
        vAxis: { format:'##', title:'N' },
        hAxis: { 
            title:'Score',
            format:'##',
            viewWindow: { min: 0, max: 11 },
            ticks: [1,2,3,4,5,6,7,8,9,10] 
        },
        bar: {groupWidth: "95%"},
        legend: { position: "none" }
      };

      var chart = new google.visualization.ColumnChart(document.getElementById('table'));
      chart.draw(view, options);

      // Pre-calculate answers once the data is loaded
      calculateAnswers();
    }

    // Utility to convert DataTable to 2D Array
    function dataTableTo2DArray(dataTable) {
      const numRows = dataTable.getNumberOfRows();
      const numCols = dataTable.getNumberOfColumns();
      const twoDimArray = [];

      const headers = [];
      for (let i = 0; i < numCols; i++) {
        headers.push(dataTable.getColumnLabel(i));
      }
      twoDimArray.push(headers);

      for (let i = 0; i < numRows; i++) {
        const row = [];
        for (let j = 0; j < numCols; j++) {
          row.push(dataTable.getValue(i, j));
        }
        twoDimArray.push(row);
      }
      return twoDimArray;
    }

    // 3. CALCULATION LOGIC
    function calculateAnswers() {
      let arr = dataTableTo2DArray(dt);
      
      // Q1: How many sat the test?
      let sum = 0;
      for (let i = 1; i < arr.length; i++) {
        sum += parseInt(arr[i][1]);
      }
      answer[1] = sum;

      // Q2: Percentage scoring 10
      // Safely find the score of 10 instead of relying on array index bounds
      let count10 = 0;
      for (let i = 1; i < arr.length; i++) {
        if (parseInt(arr[i][0]) === 10) {
            count10 = parseInt(arr[i][1]);
        }
      }
      answer[2] = (100 * count10 / sum);

      // Q3: Percentage < 5
      let sumLess5 = 0;
      for (let i = 1; i < arr.length; i++) {
        if (parseInt(arr[i][0]) < 5) {
          sumLess5 += parseInt(arr[i][1]);
        }
      }
      answer[3] = (100 * sumLess5 / sum);

      // Q4: Average mark (2 dp)
      let totalScore = 0;
      for (let i = 1; i < arr.length; i++) {
        totalScore += parseInt(arr[i][1]) * parseInt(arr[i][0]);
      }
      let avg = totalScore / sum;
      
      // Use round2DP from utilities.js if it exists, otherwise use fallback
      answer[4] = typeof round2DP === "function" ? round2DP(avg) : fallbackRound2DP(avg);
      checkAnswer[4];
      console.log("Answers calculated: ", answer);
    }

    // 4. CLICK HANDLERS
    $(document).ready(function() {
      
      // Kick off the chart drawing process
      loadGoogleCharts();

      $('[id^=check]').on('click', function() {
        var clicked = this.id;
        var qNumber = clicked.slice(-1);
        var guess = $('#solution' + qNumber).val();

        if (guess == answer[qNumber]) {
          $('#solution' + qNumber).prop('disabled', true).css({"background-color":"lightgreen", "color":"black"});
          $('#' + clicked).hide();
          points += 2;
          
          if (points == 8) {
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