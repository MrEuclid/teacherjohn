// 1. Initialize Map centered on Phnom Penh
const map = L.map('map').setView([11.5564, 104.9282], 13);

// 2. Add Standard OpenStreetMap tiles (Full detail, native languages)
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 18,
    attribution: '© OpenStreetMap contributors'
}).addTo(map);

let markers = [];
let locationNames = []; 

// 3. Map Click Handler (Diagnostic Geocoding)
map.on('click', async function(e) {
    if (markers.length >= 15) {
        alert("Maximum limit of 15 locations reached.");
        return;
    }

    const lat = e.latlng.lat;
    const lon = e.latlng.lng;
    let fetchedName = "Unknown Area"; 

    console.log(`📍 Clicked at Lat: ${lat}, Lon: ${lon}. Fetching data...`);

    try {
        const url = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lon}&accept-language=km&addressdetails=1&email=classroom_app@example.com`;
        
        const response = await fetch(url);
        console.log("🌐 Server Response Status:", response.status); 
        
        const data = await response.json();
        console.log("📦 Raw OpenStreetMap Data:", data); 
        
        if (data && !data.error) {
            if (data.name) {
                fetchedName = data.name;
            } else if (data.address) {
                 fetchedName = data.address.amenity || data.address.road || data.address.village || data.address.suburb || "Unknown Area";
            } else if (data.display_name) {
                fetchedName = data.display_name.split(',')[0].trim();
            }
        } else {
             console.warn("⚠️ API returned an error:", data.error);
        }
    } catch (error) {
        console.error("🛑 Geocoding fetch failed completely. Check your internet connection or browser security settings.", error);
    }

    let pinName = prompt(`Location found: ${fetchedName}\n\nEnter a label for Location #${markers.length + 1}:`, fetchedName);
    
    // FIXED: Explicitly check for null (Cancel button clicked)
    if (pinName === null) {
        return; // Exit the function immediately without dropping a pin
    }

    // Handle empty strings if they clicked OK but cleared the input
    if (pinName.trim() === "") {
        pinName = `L${markers.length + 1}`;
    } else {
        pinName = pinName.trim();
    }

    const marker = L.marker(e.latlng).addTo(map);
    markers.push(marker);
    locationNames.push(pinName);

    marker.bindPopup(`<strong>${pinName}</strong>`).openPopup();

    generateDistanceMatrix();
});

// 4. Matrix Generator
function generateDistanceMatrix() {
    const container = document.getElementById('matrix-container');
    const outputText = document.getElementById('distance-output');
    
    if (markers.length === 0) {
        container.innerHTML = '';
        outputText.innerText = "Click the map to drop locations and build your distance matrix.";
        return;
    }

    outputText.innerHTML = `Nodes captured! <strong>Solved!</strong>`;

    let tableHtml = '<table id="distance-table"><thead><tr><th>From \\ To</th>';
    
    for (let j = 0; j < locationNames.length; j++) {
        tableHtml += `<th>${locationNames[j]}</th>`;
    }
    tableHtml += '</tr></thead><tbody>';

    for (let i = 0; i < markers.length; i++) {
        tableHtml += `<tr><td style="font-weight:bold; background-color:#e9ecef;">${locationNames[i]}</td>`;
        
        for (let j = 0; j < markers.length; j++) {
            if (i === j) {
                tableHtml += '<td class="zero-cell">0.00</td>';
            } else {
                const posA = markers[i].getLatLng();
                const posB = markers[j].getLatLng();
                const distanceInKm = (posA.distanceTo(posB) / 1000).toFixed(2);
                
                tableHtml += `<td class="highlight-cell">${distanceInKm}</td>`;
            }
        }
        tableHtml += '</tr>';
    }
    
    tableHtml += '</tbody></table>';
    container.innerHTML = tableHtml;
}

// 5. Reset App
window.resetMap = function() {
    markers.forEach(m => map.removeLayer(m));
    markers = [];
    locationNames = [];
    generateDistanceMatrix();
};

// 6. Copy to Clipboard
window.copyTableToClipboard = function() {
    const table = document.getElementById("distance-table");
    if (!table) {
        alert("No data to copy yet!");
        return;
    }
    
    let tsv = "";
    for (let i = 0; i < table.rows.length; i++) {
        let rowData = [];
        for (let j = 0; j < table.rows[i].cells.length; j++) {
            rowData.push(table.rows[i].cells[j].innerText);
        }
        tsv += rowData.join("\t") + "\n";
    }
    
    navigator.clipboard.writeText(tsv).then(() => {
        alert("Table copied to clipboard! Well done!");
    }).catch(err => {
        alert("Failed to copy table. Please try selecting it manually.");
    });
};