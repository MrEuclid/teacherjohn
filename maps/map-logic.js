// 1. Initialize the map viewport centered near Phnom Penh, Cambodia
var map = L.map('map').setView([11.5564, 104.9282], 13);

// 2. Load free OpenStreetMap tiles with explicit directory paths to avoid string errors
L.tileLayer('https://openstreetmap.org{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '© OpenStreetMap contributors'
}).addTo(map);

var markers = [];
var locationNames = [];

// 3. Core Mathematical Spherical Haversine Equation Solver
function getDistance(lat1, lon1, lat2, lon2) {
    var R = 6371; // Earth's radius in km
    var dLat = (lat2 - lat1) * Math.PI / 180;
    var dLon = (lon2 - lon1) * Math.PI / 180;
    var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) * 
            Math.sin(dLon / 2) * Math.sin(dLon / 2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    var totalDistance = R * c;
    return totalDistance.toFixed(2);
}

// 4. TSP MULTI-POINT DISTANCE MATRIX GENERATOR
function generateDistanceMatrix() {
    var container = document.getElementById('matrix-container');
    var outputText = document.getElementById('distance-output');
    
    if (markers.length === 0) {
        container.innerHTML = "";
        outputText.innerText = "Click the map to drop locations and build your distance matrix.";
        return;
    }

    outputText.innerHTML = "Registered Nodes: <strong>" + markers.length + "</strong>. Highlight and copy the text matrix below to paste it into Excel.";

    // Start building the HTML table layout string
    var tableHtml = "<table><thead><tr><th>From \\ To</th>";
    
    // Create column header row with location names
    for (var j = 0; j < locationNames.length; j++) {
        tableHtml += "<th>" + locationNames[j] + "</th>";
    }
    tableHtml += "</tr></thead><tbody>";

    // Nested loops to compute cross-distance combinations (Row i vs Column m)
    for (var i = 0; i < markers.length; i++) {
        tableHtml += "<tr><td style='font-weight:bold; background-color:#e9ecef;'>" + locationNames[i] + "</td>";
        
        for (var m = 0; m < markers.length; m++) {
            if (i === m) {
                // Distance to self is always 0
                tableHtml += "<td class='zero-cell'>0.00</td>";
            } else {
                var posA = markers[i].getLatLng();
                var posB = markers[m].getLatLng();
                
                // Calculate distance using the Haversine calculator function
                var resultKm = getDistance(posA.lat, posA.lng, posB.lat, posB.lng);
                
                tableHtml += "<td class='highlight-cell'>" + resultKm + "</td>";
            }
        }
        tableHtml += "</tr>";
    }
    
    tableHtml += "</tbody></table>";
    container.innerHTML = tableHtml;
}

// 5. Interactive Click-to-Pin Router
function handleMapClick(e) {
    if (markers.length >= 15) {
        alert("Maximum limit of 15 locations reached for demonstration purposes.");
        return;
    }

    // Prompt window allows typing custom names (Supports English, Khmer, or whatever you choose)
    var pinName = prompt("Enter a label name for Location #" + (markers.length + 1) + ":");
    
    // Set a quick abbreviation if they leave it empty
    if (!pinName || pinName.trim() === "") {
        pinName = "L" + (markers.length + 1);
    } else {
        pinName = pinName.trim();
    }

    // Drop the pin on screen
    var marker = L.marker(e.latlng).addTo(map);
    markers.push(marker);
    locationNames.push(pinName);

    // Bind custom text to the marker popup map object
    marker.bindPopup("<strong>" + pinName + "</strong>").openPopup();

    // Rebuild the data visualization matrix table
    generateDistanceMatrix();
}

// 6. Global application reset engine linked to the UI clear button
function resetMap() {
    for (var k = 0; k < markers.length; k++) {
        map.removeLayer(markers[k]);
    }
    markers = [];
    locationNames = [];
    generateDistanceMatrix();
}

// Attach the interaction listener directly to the map instance
map.on('click', handleMapClick);
