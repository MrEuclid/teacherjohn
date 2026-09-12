<?php
  include "../connectTemple.php" ; 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
 
 <!-- checking -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Load jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="utf-8">
    
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>Certificates</title>

<style type="text/css">

    /* Custom font */
        body { font-family: 'Inter', sans-serif; }
        /* Style for the CSV download button */
        #downloadCsvBtn {
            transition: all 0.15s ease-in-out;
        }
        #downloadCsvBtn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

img  {width:50px; height:50px;}

input {background-color: lightgreen; color:black; font-size: 1.2em; font-weight: bold;}

.book {
    width:100%;
    display:block;
    margin-bottom: 1em;
    color: white;
    font-weight: bold;
}
</style>


  </head>
  <body>
  
    <div class  = "container-fluid">

      <div class = "row">
        <div class = "col- text-center">

<h2> 

<a href = "https://teacherjohn.org/index.php" target = "_blank" >
 <button type="button" class="btn btn-success">
  Home
</button></a>
Certificate file maker
</h2>
</div></div>
<div id = "getData">
<div class = "row">

 <div class = "col-4">

    <label for="browser">Choose the class</label>
<input list="currentClasses" name="currentClass" id="currentClass">
<datalist id="currentClasses">
  <option value="Type in the class"></option>
</datalist>
</div>

<div class = "col-4">
    <label for="grade">Choose the Certificate</label>
<input list="certificates" name="certificate" id="certificate">
<datalist id="certificates">
  <option value="Type in the title"></option>
    </datalist>
</div>
<div class = "col-4 text-center" >
<br>
<button id = "show" class = "btn btn-success">Show</button>
</div>

</div>


<div class = "row">
    <div class = "col-7">
  <select id = "classList" multiple>
      
  </select>   
</div>
    <div class = "col-5 align-top">
  <button class = " btn btn-success dtn-sm" id = "shift">Make file</button> 
    </div>
</div>

</div> <!-- getData -->
<!--
<div class = "row">
    <div class = "col-">
  <p class = "text-center-info" id = "message"></p>      
    </div>
</div>
-->

<div id = "sendData">
  <div class="max-w-4xl mx-auto">
        <header class="text-center mb-8">
            <h1 class="text-4xl font-extrabold text-blue-800">Student Data Processor</h1>
            <p class="text-gray-500 mt-2">View the parsed data and download it as a CSV file.</p>
        </header>

        <!-- Control Button -->
        <div class="mb-6 flex justify-center">
            <button id="downloadCsvBtn" 
                    class="bg-green-600 text-white font-bold py-3 px-6 rounded-lg shadow-xl hover:bg-green-700 focus:outline-none focus:ring-4 focus:ring-green-300 transition duration-150 ease-in-out">
                Download Table as CSV
            </button>
        </div>
        
        <!-- Data Table Container -->
        <div class="bg-white p-6 rounded-xl shadow-2xl overflow-x-auto">
            <table id="dataTable" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-blue-50">
                    <tr>
                        <th class="px-6 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tl-lg">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tr-lg">Grade</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tr-lg">Certificate</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tr-lg">Photo</th>

                    </tr>
                </thead>
                <tbody id="tableBody" class="bg-white divide-y divide-gray-200">
                    <!-- Table rows will be inserted here by JavaScript -->
                </tbody>
            </table>
        </div>

        <!-- Hidden Data Area for reference -->
        <div id="originalArray" class="hidden"></div>
    </div>
</div> <!-- sendData -->
</div> <!-- container -->


</body>
</html>

<script>
       $(document).ready(function(){

        // initial show/hide 
  
  $('#shift').hide();
  $('#getData').show();
    $('#sendData').hide();

  })

</script>


<script type="text/javascript">
$(window).on('load',function(){

// load grades G10A etc

let options = '';

 $.ajax({
            method:"post",
            url:"ajax/getGrades.php",
           
                success:function(res){
                    console.log("Grades",res);
                    let data =JSON.parse(res);
                    console.log("Parsed data",data);
                  //  alert(data.length);
                    for (let i =0 ; i < data.length; i++)
                        { options += '<option value="' + data[i].Grade + '" />';}
                       document.getElementById('currentClasses').innerHTML = options;
                    
                            } ,
  error: function (jqXHR, textStatus, errorThrown) { 
        alert("AJAX error  getting  class data"); }  // end error
 });  // end ajax 
            })
        

</script>



<script type="text/javascript">
$(window).on('load',function(){

let options = '';

// certificates data 

 $.ajax({
            method:"post",
            url:"ajax/getCertificate.php",
           
                success:function(res){
                //    console.log(res);
                    let data =JSON.parse(res);
               //     console.log(data);
                  //  alert(data.length);
                    for (let i =0 ; i < data.length; i++)
                        { options += '<option value="' + data[i].title + '" />';}
                       document.getElementById('certificates').innerHTML = options;
// check for U1 - U2 - U3 - U4 in newgrades
                            } ,
  error: function (jqXHR, textStatus, errorThrown) { 
        alert("AJAX error  getting certificate title data"); }  // end error
 });  // end ajax 
            })
        

</script>

<script>
       $(document).ready(function(){
     $('#show').on('click', function(){

// gets id family_name, first_name, certificate,email ,image
// from New_ID_Year_Grade, New_Students and Certificates 

let data =[];
let options = "";
person = [];

let currentClass = $('#currentClass').val();
let currentCertificate = $('#certificate').val();
console.log(currentClass,currentCertificate);
if (currentClass.length > 0  & currentCertificate.length > 0)
{
  let question= "Listing " + currentClass + " " + currentCertificate + ".";
  $('#classList').show();
  $('#shift').show();
  let t = currentClass + ' + ' + currentCertificate;
  $('#shift').text(t)
// ajax to update record
 var select = document.getElementById("classList"); 
 $.ajax({
            method:"post",
            url:"ajax/getClass.php",
        //    dataType:'json',
            data:{currentClass:currentClass},
            success:function(res)
            {
               //  console.log(res);
                data = JSON.parse(res);
              //   console.log(data);
               // alert(res + " is the class for " + chosenOldClass);

                 for (let i =0 ; i < data.length; i++)
                { 
// modified to include a JOIN with certiifcates and a family and first names separate

                person[i] =  data[i].studentID + '-' + data[i].english + '-'  + data[i].grade  + '-' + data[i].photo + '-' + currentCertificate;

                var opt = person[i];

                var el = document.createElement("option");
                el.text = opt;
                el.value = opt;

                select.add(el);
                console.log(i,el);
            //    $('#message').append(i + '-' + person[i] + "<br>");
                }

          $('#classList').attr('size', data.length)  ;
 
            }, // success
                
                
  error: function (jqXHR, textStatus, errorThrown) { 
        alert("AJAX error showing data"); }  // end error
 });  // end ajax 

  } 

  else 
  {
    alert("Please add a class and / or  certificate.");
  }
// 


})
 })
</script>
<script>
  function truncateStrings(arr, length) {
    // The map method iterates over every element and returns a new array
    // based on the return value of the function.
    return arr.map(element => {
        // slice(0, length) returns the characters from index 0 up to (but not including) the 'length' index.
        return element.slice(0, length);
    });
}

// --- 2. Run the function and display results ---

</script>


<script>
       $(document).ready(function(){
     $('#shift').on('click', function(){
// console.log(person);

$('#getData').hide();
$('#sendData').show();
let currentClass = $('#currentClass').val();
let currentCertificate = $('#certificate').val();
var selectedValues = $('#classList').val(); // val gives selected values only
let l = selectedValues.length;



// console.log("current class",currentClass);
// --- 2. Run the function and display results ---
// const classIDs = truncateStrings(selectedValues, 4);

// console.log("Original Array:");
// console.log(selectedValues);




if (l > 0)
{
   
    
        let studentDataRaw = selectedValues;


        let studentDataObjects = [];
        
        /**
         * Parses a raw array of strings (e.g., 'ID-Name-Grade') into structured objects.
         * @param {Array<string>} rawData - The raw array of delimited strings.
         * @returns {Array<Object>} The array of structured student objects.
         */
        function parseRawData(rawData) {
            return rawData.map(item => {
                console.log("item",item);
                const parts = item.split('-');
                if (parts[3] != '')
                    { link = 'https://pio-students.net/certificates/' + parts[3].trim();}
                    else  {link = parts[3];}
                if (parts.length != 0) {
                    return {
                        ID: parts[0].trim(),
                        Name: parts[1].trim() ,
                        Grade: parts[2].trim(),
                        Photo: link,
                        Certificate:  parts[4].trim()

                     
                    }
                }
                return null;
            }).filter(item => item !== null);
        }

        /**
         * Converts structured data array to a CSV string.
         * @param {Array<Object>} data - The array of objects (must have same keys).
         * @param {Array<string>} headers - The column headers (must match object keys).
         * @returns {string} The CSV formatted string.
         */
        function convertToCsv(data, headers) {
            if (!data || data.length === 0) return '';
            
            // Generate the header row
            const csv = [
                headers.join(',')
            ];

            // Generate the data rows
            data.forEach(row => {
                const values = headers.map(header => {
                    const value = row[header] !== undefined ? row[header] : '';
                    // Escape double quotes and surround value with quotes for proper CSV formatting
                    return `"${value.toString().replace(/"/g, '""')}"`;
                });
                csv.push(values.join(','));
            });

            return csv.join('\n');
        }

        /**
         * 2. Render the structured data into the HTML table using jQuery.
         */
        function renderTable(data) {
            const $tableBody = $('#tableBody');
            $tableBody.empty(); // Clear existing rows

            $.each(data, (index, student) => {
                const row = `
                    <tr class="hover:bg-blue-50">
                        <td class="px-6 py-2 whitespace-nowrap text-sm font-mono text-gray-900">${student.ID}</td>
                        <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-900">${student.Name}</td>
                        <td class="px-6 py-2 whitespace-nowrap text-sm font-semibold text-blue-600">${student.Grade}</td>   
                        <td class="px-6 py-3 whitespace-nowrap text-sm font-semibold text-blue-600">${student.Certificate}</td>  
                      <td class="px-6 py-2 whitespace-nowrap text-sm font-semibold text-blue-600">${student.Photo}</td> 

                    </tr>
                `;
                $tableBody.append(row);
            });
        }

        // ------------------------------------------------------------------
        // THE MAIN REUSABLE FUNCTION
        // ------------------------------------------------------------------
        
        /**
         * Main reusable function to process raw array data, convert it to CSV, and trigger a download.
         * @param {Array<string>} rawArray - The array of strings containing delimited student data.
         * @param {string} filename - The name of the file to download (e.g., "my_report.csv").
         */
        function downloadDataAsCsv(rawArray, filename) {
            // Step 1: Parse the raw array into objects
            const structuredData = parseRawData(rawArray);
            
            if (structuredData.length === 0) {
                // Use a custom message box instead of alert()
                console.warn("Download failed: No valid data available to download.");
                return;
            }

            // Define headers based on the parsed object keys
            const headers = ['ID', 'Name','Grade','Certificate','Photo']; 
            
            // Step 2: Convert the structured data to a CSV string
            const csvString = convertToCsv(structuredData, headers);
            
            // Step 3: Trigger download using Blob
            const blob = new Blob([csvString], { type: 'text/csv;charset=utf-8;' });
            const link = document.createElement("a");
            const url = URL.createObjectURL(blob);
            
            link.setAttribute("href", url);
            link.setAttribute("download", filename);
            link.style.visibility = 'hidden';
            
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            
            URL.revokeObjectURL(url);
            console.log(`CSV download initiated: ${filename}`);
        }

        // --- Event Listeners and Initialization ---
        $(document).ready(function() {
            // 1. Initialize data parsing and storing the objects globally
            studentDataObjects = parseRawData(studentDataRaw);
            
            // 2. Render the table based on the structured data
            renderTable(studentDataObjects);
            
            // 3. Attach download handler to the button, calling the new function
            $('#downloadCsvBtn').on('click', () => {
                // Example of using the new function with the global array
              let currentClass = $('#currentClass').val();
              let currentCertificate = $('#certificate').val();

                downloadDataAsCsv(studentDataRaw, currentClass + "_" + currentCertificate + ".csv");
            });
        });
  

}

else {alert("Please select some students");}
})
 })
</script>



