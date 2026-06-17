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

  if(countSelect) {
    countSelect.addEventListener("change", (e) => {
      maxPins = parseInt(e.target.value);
      clearMapData(); 
    });
  }

  if(resetBtn) {
    resetBtn.addEventListener("click", clearMapData);
  }

  map.addListener("click", (mapsMouseEvent) => {
    if (studentPins.length < maxPins) {
      const clickedLocation = mapsMouseEvent.latLng;
      
      // Prompt the student for a specific location name
      let placeName = prompt(`Enter a name for location ${studentPins.length + 1}:`);
      
      // Fallback if they click cancel or submit an empty string
      if (!placeName || placeName.trim() === "") {
        placeName = `Location ${studentPins.length + 1}`; 
      } else {
        placeName = placeName.trim();
      }
          
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
    const matrixDiv = document.getElementById("matrix-output");
    if(matrixDiv) matrixDiv.innerHTML = "";
  }
}

function generateDistanceMatrix() {
  const matrixDiv = document.getElementById("matrix-output");
  if(!matrixDiv) return;
  
  const total = studentPins.length; 
  
  let html = `<h4>Distance Matrix (${total}x${total} Kilometers)</h4>`;
  // Added an ID to the table so the copy function can target it easily
  html += "<table id='distance-table' border='1' style='border-collapse: collapse; width: 100%; text-align: center; margin-bottom: 15px;'>";
  
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
  html += "<p style='color: #2e7d32; font-weight: bold;'>Data captured! Solved!</p>";
  
  // Appended the copy button
  html += `<button onclick="copyTableToClipboard()" style="padding: 8px 16px; font-size: 14px; cursor: pointer; border-radius: 4px; border: 1px solid #ccc; background-color: #fff; font-weight: bold;">Copy Table to Clipboard</button>`;
  
  matrixDiv.innerHTML = html;
}

// New function to handle clipboard copying formatted cleanly for spreadsheets
window.copyTableToClipboard = function() {
  const table = document.getElementById("distance-table");
  if (!table) return;
  
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