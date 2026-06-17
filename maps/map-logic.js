// 1. Initialize the map viewport centered near Phnom Penh, Cambodia
const map = L.map('map').setView([11.5564, 104.9282], 13);

// 2. FIXED TILE LAYER: Bypasses string stripping bugs & forces English globally
L.tileLayer('https://tile.openstreetmap.de/{z}/{x}/{y}.png', {
    maxZoom: 18,
    minZoom: 0,
    attribution: '© OpenStreetMap contributors'
}).addTo(map);

let markers = [];
let polyline = null;

// 3. Click handler for chaining infinite custom labeled pins
map.on('click', function(e) {
    if (markers.length >= 30) {
        alert("Maximum limit of 30 pins reached. Please clear the map to start over.");
        return;
    }

    // Prompt window allows typing names in English, Khmer, or emojis
    let pinName = prompt("Enter a name for this location (e.g. School, Wat Phnom, Airport):");
    
    // Fallback default naming tracker
    if (!pinName || pinName.trim() === "") {
        pinName = `Location #${markers.length + 1}`;
    }

    // Drop an open-source marker pin at the precise click location
    const marker = L.marker(e.latlng).addTo(map);
    markers.push(marker);

    // Bind the user's customized name to the pop-up dialogue box
    marker.bindPopup(`<strong>${pinName}</strong>`).openPopup();

    // 4. MATRIX MATHEMATICS LAYER: Loop through all dropped coordinates to get the absolute total
    if (markers.length >= 2) {
        // Collect active coordinate tracking points
        const currentCoordinates = markers.map(m => m.getLatLng());

        // Update the visual path line on screen
        if (polyline) {
            polyline.setLatLngs(currentCoordinates);
        } else {
            polyline = L.polyline(currentCoordinates, {color: 'darkred', weight: 4}).addTo(map);
        }

        // Loop calculation through the entire sequential index chain
        let grandTotalMeters = 0;
        for (let i = 0; i < markers.length - 1; i++) {
            const pointA = markers[i].getLatLng();
            const pointB = markers[i + 1].getLatLng();
            grandTotalMeters += pointA.distanceTo(pointB);
        }
        
        // Formatter math
        const totalKm = (grandTotalMeters / 1000).toFixed(2);
        const totalMiles = (totalKm * 0.621371).toFixed(2);

        // Print final statistics array results to screen dashboard
        document.getElementById('distance-output').innerHTML = 
            `Total Pins: <strong>${markers.length}</strong> | Total Path Distance: <strong>${totalKm} km</strong> (${totalMiles} miles)`;
    } else {
        document.getElementById('distance-output').innerHTML = `First Location Dropped: <strong>${pinName}</strong>. Click your next spot to track distance!`;
    }
});

// 5. Global application reset engine linked to UI button
window.resetMap = function() {
    markers.forEach(m => map.removeLayer(m));
    if (polyline) map.removeLayer(polyline);
    markers = [];
    polyline = null;
    document.getElementById('distance-output').innerText = "Click places on the map to find the total distance.";
};
