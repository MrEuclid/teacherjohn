<html>
  <head>


 
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
  <script src="javaScript/jQuery/jquery-3.3.1.min.js"></script>
  <script src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    <meta charset="utf-8">

  <style>
  #gameID {margin:2em;}
  .customHeader {text-align: center; color:white;background-color: blue; font-size: 1.2em; font-weight: bold;}
.customTableCell {text-align: left; font-size: 1em;}
 label {font-weight: bolder; font-size: 1.2em;}
 input {
  text-align: center;
  background-color: lightblue;
  color: black;
  font-size: 1.2em;
}

#newTeam {background-color: lightgreen; color:blue; font-weight: bolder;}
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
          url: "teamData.php",
          dataType: "json",
          async: false
          }).responseText;
  // Sample data
   var data = new google.visualization.DataTable(jsonData);
 
var formatter = new google.visualization.NumberFormat(
    {pattern: '####'});
  
  
 // formatter.format(view,0);

  formatter.format(data,1);  
  // Create a dashboard
  var dashboard = new google.visualization.Dashboard(document.getElementById('dashboard'));

  // Create a category filter for Product
  var categoryFilterGame = new google.visualization.ControlWrapper({
    controlType: 'CategoryFilter',
    containerId: 'gameIDTeams',
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
  var table = new google.visualization.Table(document.getElementById('chart_table_teams'));

  // Create a chart view (pie chart in this example)
  var chartTable = new google.visualization.ChartWrapper({
    chartType: 'Table',
    containerId: 'chart_table_teams',
    options: {
      'title': 'Teams',
      'cssClassNames': {
        headerCell: 'customHeader',
        tableCell: 'customTableCell'
      },
    
      'width': 1200,
    
    }
  });

 google.visualization.events.addListener(chartTable, 'select', function() {
        // Get the selection from the ChartWrapper.
        const selection = chartTable.getChart().getSelection(); 

        if (selection.length > 0) {
          // Get the row index from the selection.
          const selectedRowIndex = selection[0].row;

          // Get the underlying DataTable from the ChartWrapper.
          const dataTable = chartTable.getDataTable();  

          // Get the number of columns to iterate through.
          const numberOfColumns = dataTable.getNumberOfColumns();
          const rowValues = [];

          // Loop through the columns to get the value of each cell in the selected row.
          for (let i = 0; i < numberOfColumns; i++) {
            const cellValue = dataTable.getValue(selectedRowIndex, i);
            rowValues.push(cellValue);
          }

          // Log the values to the console.
          console.log("Selected Row Values:", rowValues);

          // You can also display the values in an alert or on the page.
      //    alert('You clicked on row with values: ' + rowValues.join(', ') + ' - id - ' + rowValues[0]);

          let id = rowValues[0];
          $('#rowID').val(id);

          let student = rowValues[2];
          let oldTeam = rowValues[3];

          $('#studentName').text(student);
          $('#oldTeam').val(oldTeam);
          let l = oldTeam.length;
          let newTeam = oldTeam.substr(0,l-1);
          $('#newTeam').val(newTeam);

          if(id && oldTeam &&newTeam) {$('#changeTeam').show(); }

        }
      });

  // Bind the data table to both table and chart views
  dashboard.bind(categoryFilterGame, chartTable);

  // Draw the dashboard
  dashboard.draw(data);
}

    </script>

   <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.charts.load('current', {packages: ['table', 'corechart', 'controls']});
      google.charts.setOnLoadCallback(drawDashboard);
    </script>
</head>
<body>

  <div class  = "container-fluid">
<div class = "row">
  <div class = "col-12 text-center">
  <label id = "studentName">Student </label>
  <input id = "rowID" readonly="Y">
  <input id = "oldTeam" readonly="Y">
  <input id = "newTeam"  placeholder="Game ID">
  <button id = "changeTeam">Change</button>
</div></div>

<div class = "row">
  <div class = "col-12">
    <p class="h1 text-center">Team Lists</p>
  </div></div>
  <div class = "row">
    <div class = "col-12">
  <div id="dashboard">
  <div id="gameIDTeams"></div>
  <div id = "chart_table_teams"></div>
  </div>
</div>

</div> <!-- container -->
</body>
</html>


  <script type="text/javascript">
  
    $(document).ready(function(){
      $('#changeTeam').hide();

  })

  </script>


  <script type="text/javascript">
  
    $(document).ready(function(){
    $('#changeTeam').on('click', function()

{

  let id = $('#rowID').val();
  let oldTeam = $('#oldTeam').val();
  let newTeam = $('#newTeam').val();

console.log(id,oldTeam,newTeam);

  $.ajax({
        url: 'updateTeam.php', // Replace with your actual URL
        method: 'post',
        data: {id:id,oldTeam:oldTeam,newTeam:newTeam},
        dataType: 'text', // Expect JSON data from the server
        success: function(data) {
           alert(data);
        }, // success
        error: function(xhr, status, error) {
            console.error("Error fetching student data:", error);
        } // error
    }); // ajax

 

});
});
</script>
