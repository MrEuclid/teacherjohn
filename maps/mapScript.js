// Global arrays and variables
let studentPins = []; 
let markerObjects = []; 
let maxPins = 5; 

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

  const countSelect = document.getElementById("pinCount");
  const resetBtn = document.getElementById("resetMap");

  countSelect.addEventListener("change", (e) => {
    maxPins = parseInt(e.target.value);
    clearMapData(); 
  });

  resetBtn.addEventListener("click", clearMapData);

  map.addListener("click", (mapsMouseEvent) => {
    if (studentPins.length < maxPins) {
      const clickedLocation = mapsMouseEvent.latLng;
      // Reverting to the clean, non-billing "Pin" label system
      const placeName = `Pin ${studentPins.length + 1}`;
          
      const newMarker = new Marker({
        position: clickedLocation,
        map: map,
        title: placeName 
      });
          
      markerObjects.push(newMarker);
          
      studentPins.push({
        latLng: clickedLocation,
        title: placeName
      });

      if (studentPins.length === maxPins) {
        generateDistanceMatrix();
      }
    }
  });

  function clearMapData() {
    markerObjects.forEach(marker => marker.setMap(null));
    markerObjects = [];
    studentPins = [];
    document.getElementById("matrix-output").innerHTML = "";
  }
}

function generateDistanceMatrix() {
  const matrixDiv = document.getElementById("matrix-output");
  const total = studentPins.length; 
  
  let html = `<h4>Distance Matrix (${total}x${total} Kilometers)</h4>`;
  html += "<table border='1' style='border-collapse: collapse; width: 100%; text-align: center; margin-bottom: 15px;'>";
  
  html += "<tr style='background-color: #f2f2f2;'><th>Location</th>";
  for (let i = 0; i < total; i++) {
    html += `<th>${studentPins[i].title}</th>`;
  }
  html += "</tr>";

  for (let i = 0; i < total; i++) {
    html += `<tr><th style='background-color: #f2f2f2;'>${studentPins[i].title}</th>`;
    for (let j = 0; j < total; j++) {
      if (i === j) {
        html += "<td>0.00</td>"; 
      } else {
        const lat1 = studentPins[i].latLng.lat();
        const lon1 = studentPins[i].latLng.lng();
        const lat2 = studentPins[j].latLng.lat();
        const lon2 = studentPins[j].latLng.lng();
        
        const dist = getDistanceFromLatLonInKm(lat1, lon1, lat2, lon2);
        html += `<td>${dist.toFixed(2)}</td>`; 
      }
    }
    html += "</tr>";
  }
  html += "</table>";
  html += "<p style='color: #2e7d32; font-weight: bold;'>Data captured! Copy this matrix to your spreadsheet to calculate the ride-hailing costs.</p>";
  
  matrixDiv.innerHTML = html;
}