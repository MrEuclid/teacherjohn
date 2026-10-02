<?php
// FILE: arduino/get_lib.php
// PURPOSE: Force-download the correct browser library from unpkg.com

$url = "https://unpkg.com/avrgirl-arduino@5.2.0/dist/avrgirl-arduino-global.js";
$dest = "js/avrgirl-arduino-global.js";

// Ensure folder exists
if (!file_exists("js")) { mkdir("js", 0755, true); }

echo "<h3>Library Downloader</h3>";
echo "Downloading from: $url <br><br>";

// Try downloading using CURL (Best for servers)
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow redirects
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
$data = curl_exec($ch);
$error = curl_error($ch);
curl_close($ch);

if ($data && strlen($data) > 100000) { // Must be big (100KB+)
    file_put_contents($dest, $data);
    echo "<h2 style='color:green'>SUCCESS!</h2>";
    echo "Saved <b>$dest</b> (" . round(strlen($data)/1024) . " KB).<br>";
    echo "<a href='index.php'>Open Dashboard</a>";
} else {
    echo "<h2 style='color:red'>FAILED</h2>";
    echo "Error: $error <br>";
    echo "Data received: " . strlen($data) . " bytes (Too small).";
}
?>