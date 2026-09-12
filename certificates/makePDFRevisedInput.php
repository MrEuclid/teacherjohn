<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Batch Certificate Generator (Stabilized)</title>
    <!-- Using Bootstrap 5 for modern styles and utility classes -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <!-- IMPORTANT: Using the core libraries directly for stability -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding:0;
            background-color: #f4f4f9;
        }

           .bordered-section {
            border-top: 2em solid lightgreen;
            border-bottom: 2em solid lightgreen;
            border-left: 2em solid lightgreen;
            border-right: 2em solid lightgreen;
            padding: 2em; /* Inner padding for content */
            margin: 2em; /* Space between the page edge and the bordered section */
            background-color: white; /* Content background */
        }
        .title-container {
            display: flex; /* Use flexbox for alignment */
            align-items: center; /* Vertically align items in the middle */
           justify-content: space-between;
            /* Vertically align all items in the middle */
            align-items: center;
            /* Remove default gap to ensure max edge closeness */
            gap: 0;
            
        }
        .header-image {
            height: 120px; /* Set a consistent height for both images */
            width: auto; /* Maintain aspect ratio */
            border-radius: 20%;
        }
        .blue-title {
            color: blue;
            margin: 0; /* Remove default margin from h1 */
        }

        /* Responsive adjustments for smaller screens if needed */
        @media (max-width: 768px) {
            .bordered-section {
                border-width: 2em; /* Smaller borders on small screens */
                margin: 1em;
            }
            .title-container {
                flex-direction: column; /* Stack items vertically on small screens */
                text-align: center;
            }
        }

        hr {
                margin-top: 5em; /* Adds 20 pixels of padding above the hr */
                margin-bottom: 20px; /* Adds 20 pixels of padding below the hr */
                border: none; /* Optional: Resets default hr border for cleaner styling */
                height: 3px; /* Optional: Sets a specific height for the visual line */
                background-color: blue; /* Optional: Styles the visual line */
}


        .name {font-size: 1.2em ; font-weight: bold; height: 5em;}

        pre  {
            font-family: sans-serif;
            font-size: 1.2em;
        }

        #words {font-style: italic; font-size: 1.1em;}

        #currentDate {font-weight: bold; color:black; font-size:1.2em;}

        #motto {text-align: center; font-size: 1.4em; color:blue; font-weight: bold;}
        .controls {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #cce5ff;
            border-radius: 8px;
            background-color: #e6f2ff;
            box-shadow: 0 4px 12px rgba(0, 70, 140, 0.1);
        }
        
    </style>

</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4 text-primary">Batch Certificate PDF Generator</h1>

        <div class="controls">
            <p class="mb-3">
                <span class="text-danger fw-bold">Note:</span> If you see "NO PHOTO" in the generated PDF, it means the photo link in the CSV is either empty or not a public URL (e.g., `images/3354...` are usually not accessible by the PDF renderer).
            </p>
            <div class="input-group">
                <input type="file" class="form-control" id="csvFile" accept=".csv">
                <button class="btn btn-primary" id="generatePdfBtn" disabled>
                    <i class="fas fa-file-pdf"></i> Generate Combined PDF
                </button>
            </div>
            <div class="mt-3">
                <small class="text-muted">Status: <span id="statusMessage" class="text-dark">Please upload a CSV file.</span></small>
            </div>
        </div>
    </div>

    <!-- Loading message box -->
    <div id="loading-message">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <p class="mt-2" id="loadingText">Processing certificates...</p>
    </div>

    <!-- The old hidden content-wrapper is no longer needed but kept for completeness, though it's removed below. -->
    
    <script>
        // Ensure the jsPDF library is accessible
        const { jsPDF } = window.jspdf;
        
        $(document).ready(function() {
            const PLACEHOLDER_IMG_URL = "https://placehold.co/8x80/f8d7da/721c24?text=NO+PHOTO";

            const today = new Date();

let day = today.getDate();
let month = today.getMonth() + 1; // Months are zero-based, so add 1
let year = today.getFullYear();

// Add leading zeros if day or month is a single digit
if (day < 10) {
  day = '0' + day;
}
if (month < 10) {
  month = '0' + month;
}

const formattedDate = `${day}/${month}/${year}`;
console.log(formattedDate);

            // --- UI/Event Handlers ---
            $('#csvFile').on('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    $('#generatePdfBtn').prop('disabled', false).text('Generate Combined PDF');
                    $('#statusMessage').text(`File selected: ${file.name}. Ready to generate.`);
                } else {
                    $('#generatePdfBtn').prop('disabled', true).text('Generate Combined PDF');
                    $('#statusMessage').text('Please upload a CSV file.');
                }
            });

            $('#generatePdfBtn').on('click', async function() {
                const file = $('#csvFile')[0].files[0];
                if (!file) {
                    $('#statusMessage').text('Please select a CSV file first.');
                    return;
                }

                $(this).prop('disabled', true).text('Reading File...');
                $('#loadingText').text('Reading file...');
                $('#loading-message').show();

                const reader = new FileReader();

                reader.onload = async function(e) {
                    let studentRecords = [];
                    try {
                        const csvString = e.target.result;
                        const { records } = parseCSV(csvString);
                        studentRecords = records; 
                         console.log("Records",records) ;
                        if (studentRecords.length === 0) {
                            throw new Error("No data records found in the CSV file.");
                        }
                       
                        await generateBatchPDF(studentRecords);

                        $('#statusMessage').text(`Successfully generated PDF for ${studentRecords.length} certificates.`);
                        $('#generatePdfBtn').prop('disabled', false).text('Generate Combined PDF');

                    } catch (error) {
                        console.error("PDF Generation failed:", error);
                        // The error 'Unable to find element in cloned iframe' is often suppressed with this method, 
                        // but if another error occurs, we handle it gracefully.
                        $('#statusMessage').html(`<span class="text-danger">Error: ${error.message}. Check console for details.</span>`);
                        $('#generatePdfBtn').prop('disabled', false).text('Generate Combined PDF');
                    } finally {
                        $('#loading-message').hide();
                    }
                };

                reader.onerror = function() {
                    $('#loading-message').hide();
                    console.error("Error reading file.");
                    $('#statusMessage').html('<span class="text-danger">Error reading file.</span>');
                    $('#generatePdfBtn').prop('disabled', false).text('Generate Combined PDF');
                };

                reader.readAsText(file);
            });

            // --- Core PDF Generation Logic ---

            function getPhotoUrl(record) {
                let photoUrl = record.Photo ? record.Photo.trim() : '';
                
                // If it's a local path or empty, use the public placeholder.
                // Assuming any path that doesn't start with http/https is a local path
                if (!photoUrl || !photoUrl.startsWith('http')) {
                    return PLACEHOLDER_IMG_URL;
                }
                return photoUrl;
            }

            function renderCertificateHTML(record) {
                const photoUrl = getPhotoUrl(record);
                
                return `

    <div class="bordered-section">
        <div class="title-container">
            <img src="images/PIOLogo.png" alt="PIO Logo" class="header-image">
            <h1 class="blue-title">Certificate of Achievement</h1>
            <img src="${record.Photo}" alt="Your Photo" class="header-image">
        </div>
          <p id = "course" class = "mt-8 text-center h2 textsuccessinfo">
            Introduction to Accounting
        </p>
<p class= "text-center h5">Awarded to </p>
        <p id = "student" class="mt-8 text-center h1 text-info">
            ${record.Name}&nbsp; ${record.Grade}
        </p>


<p class = "text-center" id = "words">
    Who has  successfully completed 10 hours of classes and shown these skills. 
</p>
<ul>
<li>Understand basic accounting concepts including assets, liabilities, income, expenditure, profit and net worth.</li>
<li> Handle cash transactions accurately.</li>
<li> Work in a group to do business transactions.</li>
<li> Use an online accounting system.</li>
 <li> Make a simple report showing financial performance and financial position.</li>
</ul>
      

    <div class = "row h-25">
            <div class = "col-4 text-center"><hr></div>
            <div class = "col-4 text-center"></div>
            <div class = "col-4 text-center"><hr></div>
            
            </div>


<div class="row">
    <div class="col-4 text-">
        <p class = "name text-center">Mean Malyda </p>
    </div>
    <div class = "col-4"></div>
 <div class = "col-4 text-center">
    <p class = "name" >John Thompson</p></div>
</div>
  
 
 <div class = "mb-8">

 <p class = "text-center" id = "currentDate">Awarded by the People Improvement Organization (PIO) on </p>   
 </div>   

  <div class="col-12 text-center text-primary">
        <p id="motto" class="h4 text-success">Study - Learn - Achieve</p>

 
               `;
            }

            function waitForImage(imgElement) {
                return new Promise((resolve) => {
                    if (imgElement.complete && imgElement.naturalWidth !== 0) {
                        resolve();
                        return;
                    }
                    // Resolve promise on load OR error to prevent infinite waiting
                    imgElement.onload = resolve;
                    imgElement.onerror = resolve; 
                });
            }

            /**
             * Generates the combined PDF using the stable html2canvas -> jsPDF method.
             */
            async function generateBatchPDF(records) {
                
                // Initialize jsPDF for Landscape Letter size (11x8.5 inches)
                const pdf = new jsPDF('l', 'in', 'letter'); 
                const imgWidth = 11; 
                const imgHeight = 8.5; 

                for (let i = 0; i < records.length; i++) {
                    const record = records[i];
                    $('#loadingText').text(`Capturing Certificate ${i + 1} of ${records.length} for ${record.Name}...`);
                    
                    // a. CRITICAL STEP: Create a temporary element in the DOM for capture
                    const tempDiv = document.createElement('div');
                    tempDiv.className = 'certificate-template';
                    tempDiv.innerHTML = renderCertificateHTML(record);
                    
                    // Append the element to the body, where html2canvas can easily find it
                    document.body.appendChild(tempDiv); 

                    // b. Wait for the image to load/fail
                    const imageElement = tempDiv.querySelector('.certificate-photo');
                    if (imageElement) {
                        await waitForImage(imageElement);
                    }
                    
                    // c. Convert temporary element to Canvas image
                    const canvas = await html2canvas(tempDiv, {
                        scale: 2, 
                        useCORS: true, 
                        allowTaint: true,
                    });
                    
                    // d. Remove the temporary element immediately after capture
                    document.body.removeChild(tempDiv);
                    
                    // e. Convert canvas to image data URL
                    const imgData = canvas.toDataURL('image/jpeg', 1.0);

                    // f. Add to PDF
                    if (i > 0) {
                        pdf.addPage(); // Add a new page before adding the image, except for the first one
                    }
                    // Add the image to the entire page (0, 0 position, full dimensions)
                    pdf.addImage(imgData, 'JPEG', 0, 0, imgWidth, imgHeight); 
                }

                // --- 3. Save the Final Combined PDF ---
                $('#loadingText').text('Saving final PDF...');
                
                const filename = `${records[0].Grade}_${records[0].Certificate}_Certificates.pdf`;
                pdf.save(filename); 
            }

            // --- CSV Parser Function ---
            function parseCSV(csvString) {
                const records = [];
                const lines = csvString.split(/[\r\n]+/).filter(line => line.trim().length > 0);
                
                if (lines.length === 0) return { records: [], headers: [] };
                
                const headers = lines[0].split(',').map(header => header.trim().replace(/^"|"$/g, ''));
                
                for (let i = 1; i < lines.length; i++) {
                    const line = lines[i].trim();
                    if (line.length > 0) {
                        // Simple split by comma, works with your provided CSV structure
                        const values = line.split(',').map(value => value.trim().replace(/^"|"$/g, ''));
                        
                        if (values.length >= headers.length) {
                            const record = {};
                            for (let j = 0; j < headers.length; j++) {
                                record[headers[j]] = values[j] || '';
                            }
                            records.push(record);
                        }
                    }
                }
                return { records, headers };
            }
        });
    </script>
</body>
</html>
