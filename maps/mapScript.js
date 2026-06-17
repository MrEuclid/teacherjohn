// This function runs automatically once the Google Maps API finishes loading
async function initMap() {
  // Define coordinate position (Example: New York City)
  const position = { lat: 40.7128, lng: -74.0060 };

  // Request the required map libraries via the window instance
  const { Map } = await google.maps.importLibrary("maps");
  const { Marker } = await google.maps.importLibrary("marker");

  // Generate the interactive map object centered on your coordinates
  const map = new Map(document.getElementById("map"), {
    zoom: 12,
    center: position,
    renderingType: 'VECTOR' // Modern vector engine for optimal speed/tilt tools
  });

  // Attach a basic marker pinpoint on the designated coordinates
  const marker = new Marker({
    map: map,
    position: position,
    title: "New York City Center"
  });
}
