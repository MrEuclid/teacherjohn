<?php 
 $question = isset($_POST['question']) ? $_POST['question'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Stats - Histogram</title>
  
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
  .google-visualization-table-td {
    text-align: center !important;
  }
  /* Prevent chart from collapsing when loaded into Flexbox */
  #table {
    min-height: 350px;
    width: 100%;
    margin-bottom: 20px;
  }
</style>
</head>

<body>
  <div class="container-fluid mt-4">
    <div class="row justify-content-center">
      <div class="col-12 text-center">
        <h3>Use the chart to answer these questions.</h3>
        <p>The chart shows the id number and exam scores for 15 students.</p>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-12 col-md-10">
        <div id="table"></div>
      </div>
    </div>

    <div class="row justify-content-center align-items-center mt-3">
      <div class="col-3 text-end"><div id="ex1"></div></div>
      <div class="col-4 text-end"><label id="equation1">What was the highest mark in Khmer (KH)?</label></div>
      <div class="col-2"><input id="solution1"></div>
      <div class="col-3"><button id="check1" class="btn btn-primary btn-sm">Check 1</button></div>
    </div>

    <div class="row justify-content-center align-items-center mt-3">
      <div class="col-3 text-end"><div id="ex2"></div></div>
      <div class="col-4 text-end"><label id="equation2">How many students got 50 or more in English (EN)?</label></div>
      <div class="col-2"><input id="solution2"></div>
      <div class="col-3 "><button id="check2" class="btn btn-primary btn-sm">Check 2</button></div>
    </div>

    <div class="row justify-content-center align-items-center mt-3">
      <div class="col-3 text-end"><div id="ex3"></div></div>
      <div class="col-4 text-end"><label id="equation3">What was the ID of the student with the highest percent_total?</label></div>
      <div class="col-2"><input id="solution3"></div>
      <div class="col-3"><button id="check3" class="btn btn-primary btn-sm">Check 3</button></div>
    </div>

    <div class="row justify-content-center align-items-center mt-3">
      <div class="col-3 text-end"><div id="ex4"></div></div>
      <div class="col-4 text-end"><label id="equation4">What was the median (middle mark) for Maths (MAT)?</label></div>
      <div class="col-2"><input id="solution4"></div>
      <div class="col-3"><button id="check4" class="btn btn-primary btn-sm">Check 4</button></div>
    </div>

  </div> <script type="text/javascript">
    // Global tracking variables
    var points = 0;
    var answer = [];
    var dt; // DataTable instance
    var questionID = '<?php echo $question; ?>';

    // 1. BULLETPROOF GOOGLE CHARTS LOADER
    function loadGoogleCharts() {
      // State A: Library and packages are fully loaded (Subsequent Dashboard clicks)
      if (typeof google === 'object' && google.visualization && google.visualization.Histogram) {
        drawTable();
      } 
      // State B: Loader is present, but packages aren't loaded yet (First Dashboard click)
      else if (typeof google === 'object' && google.charts) {
        google.charts.load('current', {'packages':['corechart', 'table']});
        google.charts.setOnLoadCallback(drawTable);
      } 
      // State C: Nothing is loaded at all (Standalone Mode)
      else {
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
      // (e.g., "/mathscomp/questions/histogramData.php")
      var rawData = $.ajax({
        url: "histogramData.php", 
        dataType: "json",
        async: false
      }).responseText;
      
      // Safety check: Did the data actually load?
      if (!rawData) {
        console.error("Data fetch failed. Check the URL path to histogramData.php");
        document.getElementById('table').innerHTML = "<p class='text-danger text-center'>Error: Could not load chart data from histogramData.php.</p>";
        return;
      }
    
      dt = new google.visualization.DataTable(rawData);
      var view = new google.visualization.DataView(dt);
      
      var formatter = new google.visualization.NumberFormat({pattern: '####'});
      var formatter2 = new google.visualization.NumberFormat({pattern: '0.0%'});
      formatter2.format(dt, 0);
      formatter.format(dt, 0);  
      view.setColumns([0]);

      const options = {
        height: 300,
        width: '100%',
        histogram: { bucketSize: 1 },
        title: 'Student Marks'
      };

      var table = new google.visualization.Histogram(document.getElementById('table'));
      table.draw(view, options);

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
      let nrows = dt.getNumberOfRows();
      
      // Q1: Highest Khmer mark (column index 2)
      let maxKhmer = 0;
      for (var n = 1; n <= nrows ; n++) {
        if (arr[n][2] >= maxKhmer){ maxKhmer = arr[n][2]; }
      }
      answer[1] = maxKhmer;

      // Q2: 50 or more in English (column index 1)
      let sumEnglish = 0;
      for (var n = 1; n <= nrows ; n++) {
        if (arr[n][1] >= 50){ sumEnglish++; }
      }
      answer[2] = sumEnglish; 

      // Q3: ID of the top student (column index 4 for percent_total, ID is column 0)
      let maxPercent = 0;
      let topID = 0;
      for (var n = 1; n <= nrows ; n++) {
        if (arr[n][4] >= maxPercent) {
          maxPercent = arr[n][4]; 
          topID = arr[n][0];
        }
      }
      answer[3] = topID; 

      // Q4: Maths median (column index 3)
      let m = [];
      for (var n = 1; n <= nrows ; n++) {
        m.push(arr[n][3]);
      }
      
      let sortedMaths = m.slice().sort(function(a, b){return a - b});
      let l = sortedMaths.length;
      let median = 0;
      
      if (l % 2 == 1) {
        let index = Math.ceil(l/2);
        median = sortedMaths[index-1]; 
      } else {
        let index = (l/2) - 1; 
        let next = index + 1;
        median = (sortedMaths[index] + sortedMaths[next]) / 2;
      }
      answer[4] = median;  
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