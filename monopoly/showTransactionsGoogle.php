<html>
  <head>


  <style>
  #gameID {margin:2em;}
 
  </style>
      <title>Visualization</title>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript">
  
    // Load the Visualization API and the piechart package.
  google.charts.load("current", {
        packages : [ "corechart","table" ]
    });
      


     function drawDashboard() {

      var cssClassNames = {'headerRow': 'bigAndBold', 'tableCell': 'content'};
 
      var jsonData = $.ajax({
          url: "transactionData.php",
          dataType: "json",
          async: false
          }).responseText;
  // Sample data
   var data = new google.visualization.DataTable(jsonData);
 

  // Create a dashboard
  var dashboard = new google.visualization.Dashboard(document.getElementById('dashboard'));

  // Create a category filter for Product
  var categoryFilterGame = new google.visualization.ControlWrapper({
    controlType: 'CategoryFilter',
    containerId: 'gameID',
    options: {
      filterColumnLabel: 'gameID',
      ui: {
        label: 'Filter by gameID:',
        multiselect: true,
        'width':300,
      }
    }
  });

  

  // Create a table view
  var table = new google.visualization.Table(document.getElementById('chart_table'));

  // Create a chart view (pie chart in this example)
  var chartTable = new google.visualization.ChartWrapper({
    chartType: 'Table',
    containerId: 'chart_table',
    options: {
      'title': 'Accounts',
    
      'width': 800,
    
    }
  });


 

  // Bind the filter to the data table
  // categoryFilter.setDataTable(data);

  // Bind the data table to both table and chart views
  dashboard.bind(categoryFilterGame, chartTable);

  // Draw the dashboard
  dashboard.draw(data);
}

    </script>

  </head>

  <body>
   <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.charts.load('current', {packages: ['table', 'corechart', 'controls']});
      google.charts.setOnLoadCallback(drawDashboard);
    </script>
</head>
<body>
  <h1>Monopoly Accounts</h1>
  <div id="dashboard">
  <div id="gameID"></div>
  <div id = "chart_table"></div>
  </div>
</body>
</html>
