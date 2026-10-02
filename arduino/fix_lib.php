<?php
// FILE: arduino/fix_lib.php
// PURPOSE: Download library via User's Browser (Client-Side) and save to Server

// 1. PHP: Handle the save request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = file_get_contents('php://input');
    
    // Create folder
    if (!file_exists('js')) { mkdir('js', 0755, true); }
    
    // Save file
    $bytes = file_put_contents('js/avrgirl-arduino-global.js', $data);
    
    if ($bytes > 300000) { // Should be ~340KB
        echo "SUCCESS";
    } else {
        echo "FAIL: File too small (" . $bytes . " bytes)";
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library Fixer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light container py-5 text-center">

    <div class="card shadow mx-auto" style="max-width: 600px;">
        <div class="card-body">
            <h2 class="mb-4">Browser Bridge Installer</h2>
            <p class="text-muted">Since the server can't download the file, we will use your computer's internet connection to fetch it.</p>
            
            <button id="btn-fix" class="btn btn-primary btn-lg w-100" onclick="startBridge()">
                <i class="bi bi-cloud-download"></i> Download & Install Library
            </button>

            <div id="status" class="mt-3 text-start bg-dark text-light p-3 rounded font-monospace d-none"></div>
        </div>
    </div>

<script>
async function startBridge() {
    const log = document.getElementById('status');
    const btn = document.getElementById('btn-fix');
    
    // 1. Setup UI
    log.classList.remove('d-none');
    log.innerHTML = "1. Browser is fetching library from GitHub...<br>";
    btn.disabled = true;

    try {
        // 2. Browser downloads the file (Client-Side)
        // We use the Official Demo Link which is CORS enabled
        const response = await fetch('https://noopkat.github.io/avrgirl-arduino/javascripts/avrgirl-arduino-global.js');
        
        if (!response.ok) throw new Error("Browser could not reach GitHub.");
        
        const text = await response.text();
        log.innerHTML += "2. Download successful (" + Math.round(text.length/1024) + " KB).<br>";
        log.innerHTML += "3. Sending file to your server...<br>";

        // 3. Browser sends file to PHP (Server-Side)
        const saveResponse = await fetch('fix_lib.php', {
            method: 'POST',
            body: text
        });

        const result = await saveResponse.text();

        if (result === "SUCCESS") {
            log.innerHTML += "<span class='text-success fw-bold'>4. SUCCESS! File saved to server.</span><br>";
            log.innerHTML += "<br><a href='index.php' class='btn btn-success btn-sm'>Open Dashboard</a>";
        } else {
            log.innerHTML += "<span class='text-danger'>4. ERROR: " + result + "</span>";
        }

    } catch (err) {
        log.innerHTML += "<span class='text-danger'>ERROR: " + err.message + "</span>";
    }
    
    btn.disabled = false;
}
</script>
</body>
</html>