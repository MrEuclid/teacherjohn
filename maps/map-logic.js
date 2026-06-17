// 1. Initialize the map viewport centered near Phnom Penh, Cambodia
const map = L.map('map').setView([11.5564, 104.9282], 13);

// 2. FORCES ENGLISH LABELS AT ALL ZOOM LEVELS (OpenStreetMap International Fork)
L.tileLayer('https://osmf.de{z}/{x}/{y}.png', {
    maxZoom: 18,
    minZoom: 0,
    attribution: '© OpenStreetMap contributors'
}).addTo(map);

let markers = [];
let polyline = null;

// 3. Click handler for chaining infinite custom pins
map.on('click', function(e) {
    if (markers.length >= 20) {
        alert("Maximum limit of 20 pins reached. Please clear the map to start over.");
        return;
    }

    // Ask your student to name the location (Supports English, Khmer, Emojis, etc.)
    let pinName = prompt("Enter a name for this location (e.g. School, Wat Phnom, ផ្សារធំថ្មី):");
    
    // Fallback default name if they click cancel or leave it blank
    if (!pinName || pinName.trim() === "") {
        pinName = `Pin #${markers.length + 1}`;
    }

    // Drop an open-source marker pin at the clicked location
    const marker = L.marker(e.latlng).addTo(map);
    markers.push(marker);

    // Bind the student's custom label to the pin popup
    marker.bindPopup(`<strong>${pinName}</strong>`).openPopup();

    // Calculate total consecutive tracking path distance
    if (markers.length >= 2) {
        const currentCoordinates = markers.map(m => m.getLatLng());

        // Update or draw the path line
        if (polyline) {
            polyline.setLatLngs(currentCoordinates);
        } else {
            polyline = L.polyline(currentCoordinates, {color: 'red', weight: 4}).addTo(map);
        }

        // NEW MATHEMATICAL LOGIC: Loop through all dropped pins to get the true grand total sum
        let absoluteTotalMeters = 0;
        for (let i = 0; i < markers.length - 1; i++) {
            const pointA = markers[i].getLatLng();
            const pointB = markers[i + 1].getLatLng();
            absoluteTotalMeters += pointA.distanceTo(pointB);
        }
        
        const totalKm = (absoluteTotalMeters / 1000).toFixed(2);
        const totalMiles = (totalKm * 0.621371).toFixed(2);

        document.getElementById('distance-output').innerHTML = 
            `Pins Placed: <strong>${markers.length}</strong> | Total Cumulative Distance: <strong>${totalKm} km</strong> (${totalMiles} miles)`;
    } else {
        document.getElementById('distance-output').innerHTML = `First Location Dropped: <strong>${pinName}</strong>. Click another spot to begin measuring!`;
    }
});

// 4. Global application reset engine linked to UI button
window.resetMap = function() {
    markers.forEach(m => map.removeLayer(m));
    if (polyline) map.removeLayer(polyline);
    markers = [];
    polyline = null;
    document.getElementById('distance-output').innerText = "Click places on the map to find the total distance.";
};
