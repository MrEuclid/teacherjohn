// 1. Initialize the map viewport centered near Phnom Penh, Cambodia
const map = L.map('map').setView([11.5564, 104.9282], 13);

// 2. Open-source multi-lingual tiles (Forces English labels over Cambodia)
L.tileLayer('https://stadiamaps.com{z}/{x}/{y}{r}.png?api_key=', {
    maxZoom: 20,
    attribution: '© Stadia Maps, © OpenStreetMap contributors'
}).addTo(map);

// Track an unlimited number of user pins and line segments
let markers = [];
let polyline = null;
let totalDistanceInMeters = 0;

// 3. Click handler for chaining infinite pins
map.on('click', function(e) {
    // Drop a pin marker at the clicked location
    const marker = L.marker(e.latlng).addTo(map);
    markers.push(marker);

    // Give each pin a popup showing what number it is
    marker.bindPopup(`<strong>Pin #${markers.length}</strong>`).openPopup();

    // If we have 2 or more pins, start calculating the cumulative path
    if (markers.length >= 2) {
        // Gather all coordinates from the dropped pins
        const currentCoordinates = markers.map(m => m.getLatLng());

        // Update or create the visual path line on the map
        if (polyline) {
            polyline.setLatLngs(currentCoordinates);
        } else {
            polyline = L.polyline(currentCoordinates, {color: 'red', weight: 4}).addTo(map);
        }

        // Calculate distance from the *last* pin to the *newly added* pin
        const lastIndex = markers.length - 1;
        const p1 = markers[lastIndex - 1].getLatLng();
        const p2 = markers[lastIndex].getLatLng();
        
        // Add the new segment distance to the total sum
        totalDistanceInMeters += p1.distanceTo(p2);
        
        const totalKm = (totalDistanceInMeters / 1000).toFixed(2);
        const totalMiles = (totalKm * 0.621371).toFixed(2);

        // Update display panel text dynamically
        document.getElementById('distance-output').innerHTML = 
            `Pins: <strong>${markers.length}</strong> | Total Distance: <strong>${totalKm} km</strong> (${totalMiles} miles)`;
    } else {
        // Message when only the first single pin is dropped
        document.getElementById('distance-output').innerText = "First pin dropped! Click somewhere else to find the distance.";
    }
});

// 4. Reset engine to wipe all active elements from the UI dashboard
window.resetMap = function() {
    markers.forEach(m => map.removeLayer(m));
    if (polyline) map.removeLayer(polyline);
    markers = [];
    polyline = null;
    totalDistanceInMeters = 0;
    document.getElementById('distance-output').innerText = "Click places on the map to find the total distance.";
};
