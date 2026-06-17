// Global array to store the coordinate data of the dropped pins
let studentPins = [];

// The Haversine formula to calculate straight-line distance in kilometers
function getDistanceFromLatLonInKm(lat1, lon1, lat2, lon2) {
  const R = 6371; // Radius of the Earth in km
  const dLat = deg2rad(lat2 - lat1);  
  const dLon = deg2rad(lon2 - lon1); 
  const a = 
    Math.sin(dLat/2) * Math.sin(dLat/2) +
    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * Math.sin(dLon/2) * Math.sin(dLon/2); 
  const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
  return R * c; // Distance in km
}

function deg2rad(deg) {
  return deg * (Math.PI/180);
}

async function initMap() {
  // Center exactly on Phnom Penh
  const position = { lat: 11.5564, lng: 104.9282 };

  const { Map } = await google.maps.importLibrary("maps");
  const { Marker } = await google.maps.importLibrary("marker");

  const map = new Map(document.getElementById("map"), {
    zoom: 13,
    center: position,
    renderingType: 'VECTOR'
  });

  // Listen for clicks on the map
  map.addListener("click", (mapsMouseEvent) => {
    // Only allow 5 pins
    if (studentPins.length < 5) {
      const clickedLocation = mapsMouseEvent.latLng;
      
      // Drop the pin on the map
      new Marker({
        position: clickedLocation,
        map: map,
        title: `Pin ${studentPins.length + 1}`
      });
      
      // Save the coordinates
      studentPins.push(clickedLocation);

      // Once 5 pins are placed, run the matrix math
      if (studentPins.length === 5) {
        generateDistanceMatrix();
      }
    }
  });
}

function generateDistanceMatrix() {
  const matrixDiv = document.getElementById("matrix-output");
  
  // Start building an HTML table to display the results
  let html = "<h4>Distance Matrix (Kilometers)</h4>";
  html += "<table border='1' style='border-collapse: collapse; width: 100%; text-align: center; margin-bottom: 15px;'>";
  
  // Create Header Row
  html += "<tr style='background-color: #f2f2f2;'><th>Location</th>";
  for (let i = 0; i < 5; i++) {
    html += `<th>Pin ${i + 1}</th>`;
  }
  html += "</tr>";

  // Create Data Rows by calculating distances between every combination
  for (let i = 0; i < 5; i++) {
    html += `<tr><th style='background-color: #f2f2f2;'>Pin ${i + 1}</th>`;
    for (let j = 0; j < 5; j++) {
      if (i === j) {
        html += "<td>0.00</td>"; // Distance to itself is 0
      } else {
        const lat1 = studentPins[i].lat();
        const lon1 = studentPins[i].lng();
        const lat2 = studentPins[j].lat();
        const lon2 = studentPins[j].lng();
        
        const dist = getDistanceFromLatLonInKm(lat1, lon1, lat2, lon2);
        html += `<td>${dist.toFixed(2)}</td>`; // Round to 2 decimal places
      }
    }
    html += "</tr>";
  }
  html += "</table>";
  
  // Success message
  html += "<p style='color: #2e7d32; font-weight: bold;'>Data fully captured! Well done. You can now copy this into your Google Sheet to calculate the ride-hailing costs.</p>";
  
  // Inject the table into the HTML page
  matrixDiv.innerHTML = html;
}