<html>
  <head>
    <title>Visualization</title>
    <style>
      #gameID { margin: 2em; }
      .customHeader { text-align: center; color: white; background-color: blue; }
      .customTableCell { text-align: left; }
    </style>

    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
      // Load the Visualization API and the required packages.
      google.charts.load("current", { packages: ["corechart", "table", "controls"] });
      google.charts.setOnLoadCallback(initDashboard);

      // Declare these globally so they aren't destroyed and recreated on every refresh
      var dashboard;
      var categoryFilterGame;
      var chartTable;
      var formatter;

      function initDashboard() {
        // 1. Create the dashboard
        dashboard = new google.visualization.Dashboard(document.getElementById('dashboard'));

        // 2. Create the category filter
        categoryFilterGame = new google.visualization.ControlWrapper({
          controlType: 'CategoryFilter',
          containerId: 'gameID',
          options: {
            filterColumnLabel: 'gameID',
            ui: {
              label: 'Filter by gameID:',
              multiselect: true,
              width: 300,
            }
          }
        });

        // 3. Create the table view
        chartTable = new google.visualization.ChartWrapper({
          chartType: 'Table',
          containerId: 'chart_table',
          options: {
            title: 'Accounts',
            cssClassNames: {
              headerCell: 'customHeader',
              tableCell: 'customTableCell'
            },
            width: 1200,
          }
        });

        // 4. Initialize the number formatter
        formatter = new google.visualization.NumberFormat({ pattern: '####' });

        // 5. Bind the filter to the table
        dashboard.bind(categoryFilterGame, chartTable);

        // 6. Fetch initial data and draw the dashboard immediately
        fetchDataAndDraw();

        // 7. Set Interval to auto-refresh every 2 minutes
        setInterval(fetchDataAndDraw, 120000);
      }
function fetchDataAndDraw() {
        // Asynchronous AJAX call
        $.ajax({
          url: "accountData.php",
          dataType: "json",
          success: function(jsonData) {
            // Convert the fetched JSON into a Google DataTable
            var data = new google.visualization.DataTable(jsonData);

            // Format the second column (index 1)
            formatter.format(data, 1);

            // --- NEW CODE: Capture and preserve the sorting state ---
            var chart = chartTable.getChart();
            if (chart) {
              var sortInfo = chart.getSortInfo();
              
              // If the user has actively sorted a column (column is not -1)
              if (sortInfo && sortInfo.column !== -1) {
                
                // 1. Sort the underlying data to match the user's choice
                data.sort([{column: sortInfo.column, desc: !sortInfo.ascending}]);
                
                // 2. Tell the chart options to keep displaying the little sort arrow
                chartTable.setOption('sortColumn', sortInfo.column);
                chartTable.setOption('sortAscending', sortInfo.ascending);
              }
            }
            // --------------------------------------------------------

            // Redraw the dashboard with the fresh data.
            dashboard.draw(data);
          },
          error: function(err) {
            console.error("Error fetching background data for dashboard update: ", err);
          }
        });
      }    </script>
  </head>

  <body>
    <div id="dashboard">
      <div id="gameID"></div>
      <div id="chart_table"></div>
    </div>
  </body>
</html>