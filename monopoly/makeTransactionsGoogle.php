<html>
  <head>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../bootstrap-5.0.2-dist/css/bootstrap.min.css">
  <script src="../javaScript/jQuery/jquery-3.3.1.min.js"></script>
  <script src="../bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    <meta charset="utf-8">

  <style>
  #gameIDTransactions, #nameTransactions  {display: inline-block; margin: 1em;}
.customHeader {text-align: center; color:white;background-color: blue;}
.customTableCell {text-align: left;}

input {
    background-color: lightyellow;
     color: black; 
     font-weight:bold; 
     font-size: 1.2em;
     margin-right: 1em;
     margin-bottom: 1em;
     text-align: center;

   }

  label  {color:blue ; font-weight: bolder; font-size:1.2em;}

 
  </style>
      <title>Visualization transactions</title>
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
 console.log("Transactions",data);

   var formatter = new google.visualization.NumberFormat(
    {pattern: '####'});
  
  
 // formatter.format(view,0);

  formatter.format(data,2);  
    
   //  view.setColumns([0,1,2,3,4]);

  // Create a dashboard
  var dashboard = new google.visualization.Dashboard(document.getElementById('dashboardTransactions'));

  // Create a category filter for Product
  var categoryFilterGame = new google.visualization.ControlWrapper({
    controlType: 'CategoryFilter',
    containerId: 'gameIDTransactions',
    options: {
      filterColumnLabel: 'gameID',
      ui: {
        label: 'Filter by gameID:',
        multiselect: true,
        'width':300,
      }
    }
  });

// replace name with student
    var categoryFilterName = new google.visualization.ControlWrapper({
    controlType: 'CategoryFilter',
    containerId: 'nameTransactions',
    options: {
      filterColumnLabel: 'student',
      ui: {
        label: 'Filter by studentID:',
        multiselect: true,
        'width':300,
      }
    }
  });

  // Create a table view
  var table = new google.visualization.Table(document.getElementById('chart_table_transactions'));

  // Create a chart view (pie chart in this example)
  var chartTable = new google.visualization.ChartWrapper({
    chartType: 'Table',
    containerId: 'chart_table_transactions',
    options: {
      'title': 'Accounts',
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
    //     alert('You clicked on row with values: ' + rowValues.join(', ') + ' - id - ' + rowValues[0]);


         $('#transID').text(rowValues[0]);
        $('#transGameID').text(rowValues[1]);
         $('#transStudentID').text(rowValues[2]);

         $('#transAmount').val(rowValues[3]);
         $('#transAccount').val(rowValues[4]);
         $('#transLinkedAmount').val(rowValues[5]);
          $('#transNotes').val(rowValues[6]);



        }
      });


 

  // Bind the filter to the data table
  // categoryFilter.setDataTable(data);

  // Bind the data table to both table and chart views

   dashboard.bind(categoryFilterGame,categoryFilterName);
  dashboard.bind([categoryFilterGame,categoryFilterName],chartTable);

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

    <div class  = "container-fluid">



<div class = "row">  
<div class = "col-12 text-center">
  <h1>Transactions</h1>
</div></div>

<div class = "row">  
<div class = "col-1"><label>ID</label></div>
<div class = "col-1"><label>Game ID</label></div>
<div class = "col-1"><label>Student ID</label></div>

<div class = "col-2"><label>Amount</label></div>
<div class = "col-2"><label>Account</label></div>
<div class = "col-2"><label>Linked amount</label></div>
<div class = "col-3"><label>Notes</label></div>

</div>

<div class = "row">  
<div class = "col-1"><label id = "transID"></label></div>
<div class = "col-1"><label id = "transGameID"></label></div>
<div class = "col-1"><label  id = "transStudentID"></label></div>

<div class = "col-2"><input id = "transAmount"></div>
<div class = "col-2"><input id = "transAccount"></div>
<div class = "col-2"><input id = "transLinkedAmount"></div>
<div class = "col-3"><input id = "transNotes"></div>

</div>

<div class= "row">
  <div class = "col-12 text-center"><button id = "update" class= "btn btn-lg btn-success">Update</button>
  </div></div>


<div clas s= "row">
  <div class = "col-12">
  <div id="dashboardTransactions">
  <div id="gameIDTransactions"></div>
  <div id ="nameTransactions"></div>
  <div id = "chart_table_transactions"></div>
  </div>  <!-- dashboard -->

</div></div> <!-- row -->
</div> <!-- container -->
</body>
</html>

<script>

    $(document).ready(function(){
    $('#update').on('click', function()

{
  alert(this.id);

  let id = $('#transID').text();
  let amount = $('#transAmount').val();
  let linkedAccount = $('#transAccount').val();
  let linkedAmount = $('#transLinkedAmount').val();
   let notes = $('#transNotes').val();

   // ajax 

     $.ajax({
        url: 'updateTransaction.php', // Replace with your actual URL
        method: 'POST',
        data:{id:id,
              amount:amount,
              linkedAccount:linkedAccount,
              linkedAmount:linkedAmount,
              notes:notes},
        dataType: 'text', // Expect text data from the server
        success: function(data) {
           
        console.log("Response",data);
            
        }, // success
        error: function(xhr, status, error) {
            console.error("Error updating transaction", error);
            alert(error);
        } // error
   }); // ajax



});
});

</script>
