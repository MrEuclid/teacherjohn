<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array to CSV Converter</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
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
    </style>
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body class="bg-gray-50 min-h-screen p-4 sm:p-8">

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
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tl-lg">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">English Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tr-lg">Grade</th>
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

    <script>
        const studentDataRaw = [
            '1481-Chheang Makara-G12A', 
            '1483-Chun Chenly-G12A', 
            '1486-Heng Kimhong-G12A', 
            '1517-Yun Rachana Pich-G12A', 
            '1529-Kim Dalin-G12A', 
            '1538-Prak Sreylin-G12A', 
            '1544-Seng Sopheak-G12A', 
            '1557-Yorn Menghak-G12A', 
            '3354-Cham Udom-G12A', 
            '3547-Dy Sovan Khemra-G12A', 
            '3596-Moeun Srey Rachana-G12A', 
            '3838-Reth Srey Ty-G12A', 
            '4701-Sok Vann Sok Ly-G12A', 
            '4712-Yun Sovann-G12A', 
            '5067-Neang Seyha-G12A', 
            '5260-Morn Meas phallin-G12A', 
            '5555-Chomreoun Sreynith-G12A', 
            '5559-Chea Buntheoun-G12A', 
            '6291-Seng Tithsithika-G12A', 
            '6388-Houn Mey Srey Vichera-G12A', 
            '6481-Ear Kimleng-G12A', 
            '6552-Soeun Vireak-G12A', 
            '6553-Soeun Raksmey-G12A'
        ];

        let studentDataObjects = [];
        
        /**
         * Parses a raw array of strings (e.g., 'ID-Name-Grade') into structured objects.
         * @param {Array<string>} rawData - The raw array of delimited strings.
         * @returns {Array<Object>} The array of structured student objects.
         */
        function parseRawData(rawData) {
            return rawData.map(item => {
                const parts = item.split('-');
                if (parts.length === 3) {
                    return {
                        ID: parts[0].trim(),
                        Name: parts[1].trim(),
                        Grade: parts[2].trim()
                    };
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
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-900">${student.ID}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${student.Name}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-blue-600">${student.Grade}</td>
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
            const headers = ['ID', 'Name', 'Grade']; 
            
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
                downloadDataAsCsv(studentDataRaw, "g12a_student_list.csv");
            });
        });
    </script>
</body>
</html>
