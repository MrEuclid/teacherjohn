<?php
// FILE: arduino/install_lib.php
// PURPOSE: Robustly download the Avrgirl library (Tries multiple sources)

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h3>Arduino Library Installer (Final Attempt)</h3>";

$targetPath = "js/avrgirl-arduino-global.js";

// Create folder if missing
if (!file_exists("js")) { mkdir("js", 0755, true); }

// LIST OF SOURCES TO TRY (In order of reliability)
$sources = [
    // Source 1: The v4.2.0 release from jsDelivr (Very reliable CDN)
    "https://cdn.jsdelivr.net/npm/avrgirl-arduino@4.2.0/dist/avrgirl-arduino-global.js",
    
    // Source 2: The raw file from the v4.2.0 tag on GitHub
    "https://raw.githubusercontent.com/noopkat/avrgirl-arduino/v4.2.0/dist/avrgirl-arduino-global.js",
    
    // Source 3: The unpkg CDN
    "https://unpkg.com/avrgirl-arduino@4.2.0/dist/avrgirl-arduino-global.js"
];

$success = false;

foreach ($sources as $url) {
    echo "<p>Trying source: <code>$url</code> ...</p>";
    
    $content = fetchUrl($url);
    
    // VALIDATION:
    // 1. Must be larger than 50KB (The real lib is ~300KB+)
    // 2. Must contain "function" or "var" (Basic JS check)
    if (strlen($content) > 50000 && (strpos($content, 'function') !== false)) {
        $bytes = file_put_contents($targetPath, $content);
        echo "<h2 style='color:green'>&#10004; SUCCESS!</h2>";
        echo "<p>Downloaded from: $url</p>";
        echo "<p>Saved <strong>$targetPath</strong> (" . round($bytes/1024) . " KB).</p>";
        echo "<p><strong><a href='index.php'>Click here to open your Dashboard</a></strong></p>";
        $success = true;
        break; // Stop looking, we found it
    } else {
        echo "<p style='color:orange'>&#10008; Failed. (File too small or invalid)</p>";
    }
}

if (!$success) {
    echo "<h2 style='color:red'>ALL DOWNLOADS FAILED</h2>";
    echo "<p>Please contact your system administrator. Your server may be blocking external downloads.</p>";
}

// --- HELPER FUNCTION ---
function fetchUrl($url) {
    // Try CURL first
    if (function_exists('curl_version')) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
        $data = curl_exec($ch);
        curl_close($ch);
        if ($data) return $data;
    }
    // Fallback to file_get_contents
    return @file_get_contents($url);
}
?>