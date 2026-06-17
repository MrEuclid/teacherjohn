// Global arrays and variables
let studentPins = [];
let markerObjects = []; // Stores the visual pins so we can clear them later
let maxPins = 5; // Default value matching the HTML dropdown

// The Haversine formula
function getDistanceFromLatLonInKm(lat1, lon1, lat2, lon2) {
  const R = 6371; 
  const dLat = deg2rad(lat2 - lat1);  
  const dLon = deg2rad(lon2 - lon1); 
  const a = 
    Math.sin(dLat/2) * Math.sin(dLat/2) +
    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * Math.sin(dLon/2) * Math.sin(dLon/2); 
  const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
  return R * c; 
}

function deg2rad(deg) {
  return deg * (Math.PI/180);
}

async function initMap() {
  const position = { lat: 11.5564, lng: 104.9282 }; // Phnom Penh

  const { Map } = await google.maps.importLibrary("maps");
  const { Marker } = await google.maps.importLibrary("marker");

  const map = new Map(document.getElementById("map"), {
    zoom: 13,
    center: position,
    renderingType: 'VECTOR'
  });

  // UI Event Listeners
  const countSelect = document.getElementById("pinCount");
  const resetBtn = document.getElementById("resetMap");

  // Update max pins when dropdown changes
  countSelect.addEventListener("change", (e) => {
    maxPins = parseInt(e.target.value);
    clearMapData(); // Reset the map automatically when changing difficulty
  });

  // Clear map manually
  resetBtn.addEventListener("click", clearMapData);

  // Map Click Listener
  map.addListener("click", (mapsMouseEvent) => {
    if (studentPins.length < maxPins) {
      const clickedLocation = mapsMouseEvent.latLng;
      
      // Create and store the visual marker
      const newMarker = new Marker({
        position: clickedLocation,
        map: map,
        title: `Pin ${studentPins.length + 1}`
      });
      
      markerObjects.push(newMarker);
      studentPins.push(clickedLocation);

      // Check if we hit the limit
      if (studentPins.length === maxPins) {
        generateDistanceMatrix();
      }
    }
  });

  // Helper function to clear all data and visual pins
  function clearMapData() {
    // Remove markers from the map by setting their map reference to null
    markerObjects.forEach(marker => marker.setMap(null));
    
    // Empty the arrays
    markerObjects = [];
    studentPins = [];
    
    // Clear the HTML table
    document.getElementById("matrix-output").innerHTML = "";
  }
}

// Generate the dynamic table
function generateDistanceMatrix() {
  const matrixDiv = document.getElementById("matrix-output");
  const total = studentPins.length; // Will be between 2 and 6
  
  let html = `<h4>Distance Matrix (${total}x${total} Kilometers)</h4>`;
  html += "<table border='1' style='border-collapse: collapse; width: 100%; text-align: center; margin-bottom: 15px;'>";
  
  // Dynamic Header Row
  html += "<tr style='background-color: #f2f2f2;'><th>Location</th>";
  for (let i = 0; i < total; i++) {
    html += `<th>Pin ${i + 1}</th>`;
  }
  html += "</tr>";

  // Dynamic Data Rows
  for (let i = 0; i < total; i++) {
    html += `<tr><th style='background-color: #f2f2f2;'>Pin ${i + 1}</th>`;
    for (let j = 0; j < total; j++) {
      if (i === j) {
        html += "<td>0.00</td>"; 
      } else {
        const lat1 = studentPins[i].lat();
        const lon1 = studentPins[i].lng();
        const lat2 = studentPins[j].lat();
        const lon2 = studentPins[j].lng();
        
        const dist = getDistanceFromLatLonInKm(lat1, lon1, lat2, lon2);
        html += `<td>${dist.toFixed(2)}</td>`; 
      }
    }
    html += "</tr>";
  }
  html += "</table>";
  html += "<p style='color: #2e7d32; font-weight: bold;'>Data captured! Copy this matrix to calculate your costs.</p>";
  
  matrixDiv.innerHTML = html;
}