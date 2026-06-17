// 1. Initialize the map viewport centered near Phnom Penh, Cambodia
const map = L.map('map').setView([11.5564, 104.9282], 13);

// 2. Map tile configuration using the slash-protected URL
L.tileLayer('https://openstreetmap.de{z}/{x}/{y}.png', {
    maxZoom: 18,
    minZoom: 0,
    attribution: '© OpenStreetMap contributors'
}).addTo(map);

let markers = [];
let locationNames = []; // Keep track of the text labels separately

// 3. Click handler for building the TSP Matrix
map.on('click', function(e) {
    if (markers.length >= 15) { // Capped at 15 for readable screen layout
        alert("Maximum limit of 15 locations reached for demonstration purposes.");
        return;
    }

    // Prompt window allows typing custom names
    let pinName = prompt(`Enter a label for Location #${markers.length + 1}:`);
    
    // Set a quick abbreviation if they leave it empty
    if (!pinName || pinName.trim() === "") {
        pinName = `L${markers.length + 1}`;
    } else {
        pinName = pinName.trim();
    }

    // Drop the pin on screen
    const marker = L.marker(e.latlng).addTo(map);
    markers.push(marker);
    locationNames.push(pinName);

    // Bind custom text to the marker popup map object
    marker.bindPopup(`<strong>${pinName}</strong>`).openPopup();

    // Rebuild the data visualization matrix table
    generateDistanceMatrix();
});

// 4. TSP MULTI-POINT DISTANCE MATRIX GENERATOR
function generateDistanceMatrix() {
    const container = document.getElementById('matrix-container');
    const outputText = document.getElementById('distance-output');
    
    if (markers.length === 0) {
        container.innerHTML = '';
        outputText.innerText = "Click the map to drop locations and build your distance matrix.";
        return;
    }

    outputText.innerHTML = `Registered Nodes: <strong>${markers.length}</strong>. You can drag-select the table data text below to copy it directly into spreadsheet software.`;

    // Start building the HTML table layout string
    let tableHtml = '<table><thead><tr><th>From \\ To</th>';
    
    // Create column header row with location names
    for (let j = 0; j < locationNames.length; j++) {
        tableHtml += `<th>${locationNames[j]}</th>`;
    }
    tableHtml += '</tr></thead><tbody>';

    // Nested loops to compute cross-distance combinations (Row i vs Column j)
    for (let i = 0; i < markers.length; i++) {
        tableHtml += `<tr><td style="font-weight:bold; background-color:#e9ecef;">${locationNames[i]}</td>`;
        
        for (let j = 0; j < markers.length; j++) {
            if (i === j) {
                // Distance to self is always 0
                tableHtml += '<td class="zero-cell">0.00</td>';
            } else {
                const posA = markers[i].getLatLng();
                const posB = markers[j].getLatLng();
                
                // Leaflet native distance computation (converted to kilometers)
                const distanceInKm = (posA.distanceTo(posB) / 1000).toFixed(2);
                
                tableHtml += `<td class="highlight-cell">${distanceInKm}</td>`;
            }
        }
        tableHtml += '</tr>';
    }
    
    tableHtml += '</tbody></table>';
    container.innerHTML = tableHtml;
}

// 5. Global application reset engine linked to the UI clear button
window.resetMap = function() {
    markers.forEach(m => map.removeLayer(m));
    markers = [];
    locationNames = [];
    generateDistanceMatrix();
};
