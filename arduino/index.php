<?php
// FILE: arduino/index.php
$lessons = [
    'reaction' => ['title' => '1. Reaction Timer', 'hex' => 'hex/reaction.hex', 'unit' => 'Time (ms)'],
    'dht11'    => ['title' => '2. DHT11 Climate', 'hex' => 'hex/dht11.hex', 'unit' => 'Temp/Hum'],
    'cooling'  => ['title' => '3. Newton\'s Cooling', 'hex' => 'hex/ds18.hex', 'unit' => 'Temp (°C)'],
    'fruit'    => ['title' => '4. Soda Battery - A3', 'hex' => 'hex/fruit.hex', 'unit' => 'Voltage (V)'],
    'capacitor'=> ['title' => '5. Capacitor Discharge', 'hex' => 'hex/cap.hex', 'unit' => 'Voltage (V)'],
    'light'    => ['title' => '6. Light Levels', 'hex' => 'hex/light.hex', 'unit' => 'Brightness (%)'],
    'pendulum' => ['title' => '7. Fruit battery - A3', 'hex' => 'hex/banana.hex', 'unit' => 'Distance (cm)']
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Science Lab Station</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.plot.ly/plotly-2.24.1.min.js"></script>
    <style>
        body { background: #f0f2f5; padding: 20px; font-family: 'Segoe UI', sans-serif; }
        .card { border-radius: 12px; border: none; box-shadow: 0 4px 10px rgba(0,0,0,0.08); }
        .flash-card { transition: transform 0.2s; border-top: 4px solid #0d6efd; }
        .flash-card:hover { transform: translateY(-3px); }
        #terminal { background: #1a1a1a; color: #00ff41; height: 400px; overflow-y: auto; padding: 15px; font-family: 'Consolas', monospace; border-radius: 12px 0 0 12px; font-size: 0.85rem; }
        #graph-container { background: #fff; height: 400px; border: 1px solid #ddd; border-radius: 0 12px 12px 0; }
        #heartbeat { display: none; color: #2ecc71; margin-left: 10px; }
        .beat { animation: flash 0.6s ease-out; }
        @keyframes flash { 0% { opacity: 1; transform: scale(1.3); } 100% { opacity: 0.5; transform: scale(1); } }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4 px-2">
        <div>
            <h2 class="fw-bold text-primary mb-0">Science Lab Station</h2>
            <p class="text-muted small mb-0"><span id="save-status">Ready to log data</span></p>
        </div>
        <div class="d-flex align-items-center">
            <button id="btnRecover" class="btn btn-warning btn-sm fw-bold me-3 d-none"><i class="bi bi-clock-history"></i> Recover Past Data</button>
            <i id="heartbeat" class="bi bi-shield-fill-check h4 mb-0"></i>
        </div>
    </div>

    <div class="row mb-4">
        <?php foreach ($lessons as $key => $l): ?>
        <div class="col-md-2 mb-3" style="flex: 0 0 auto; width: 14.28%;"> <div class="card p-3 flash-card h-100">
                <h6 class="fw-bold mb-2" style="font-size: 0.85rem;"><?php echo $l['title']; ?></h6>
                <button class="btn btn-xs btn-outline-primary flash-btn" 
                        data-hex="<?php echo $l['hex']; ?>" 
                        data-unit="<?php echo $l['unit']; ?>"
                        style="font-size: 0.75rem;">Flash HEX</button>
                <div class="small mt-2 text-muted flash-msg" style="font-size: 0.7rem;">Status: Ready</div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="card p-3 bg-dark mb-4 shadow">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex gap-2">
                <button id="btnConnect" class="btn btn-primary fw-bold px-5">CONNECT ARDUINO</button>
                <button id="btnExport" class="btn btn-success px-4">EXPORT CSV</button>
            </div>
            <button id="btnClear" class="btn btn-outline-danger btn-sm">WIPE SESSION</button>
        </div>
    </div>

    <div class="row g-0 card flex-row overflow-hidden shadow">
        <div class="col-md-3">
            <div id="terminal">--- Waiting for connection ---<br></div>
        </div>
        <div class="col-md-9">
            <div id="graph-container"></div>
        </div>
    </div>
</div>

<script src="js/avrgirl-arduino-global.js"></script>
<script>
let collectedData = [];
let trialCount = 0;
let port, reader;

// Plotly Initialization
function initPlot(labels = ['Value 1', 'Value 2']) {
    const traces = labels.map(l => ({ name: l, x: [], y: [], type: 'scatter', mode: 'lines+markers', line: {shape: 'spline'} }));
    Plotly.newPlot('graph-container', traces, { margin: { t: 30, b: 40, l: 50, r: 20 }, legend: { orientation: 'h', y: 1.1 } });
}
initPlot();

// Auto-Save Logic
function autoSave() {
    const hb = document.getElementById('heartbeat');
    const ss = document.getElementById('save-status');
    const now = new Date().toLocaleTimeString();
    
    localStorage.setItem('lab_backup', JSON.stringify(collectedData));
    localStorage.setItem('lab_ts', now);
    
    hb.style.display = 'block';
    hb.classList.remove('beat');
    void hb.offsetWidth; // Trigger reflow
    hb.classList.add('beat');
    ss.innerText = "Auto-Saved: " + now;
}

// Page Load: Check for backups
window.onload = () => {
    const saved = localStorage.getItem('lab_backup');
    const ts = localStorage.getItem('lab_ts');
    if (saved) {
        const btn = document.getElementById('btnRecover');
        btn.classList.remove('d-none');
        btn.onclick = () => {
            collectedData = JSON.parse(saved);
            trialCount = collectedData.length;
            
            // Try to guess graph type from first data point
            const sample = collectedData[0].slice(2);
            initPlot(sample.length > 1 ? ['Humidity (%)', 'Temp (°C)'] : ['Sensor Value']);
            
            collectedData.forEach(row => {
                const vals = row.slice(2);
                vals.forEach((v, i) => { if(i < 2) Plotly.extendTraces('graph-container', { x: [[row[0]]], y: [[v]] }, [i]); });
            });
            
            document.getElementById('save-status').innerText = "Recovered backup from " + ts;
            btn.classList.add('d-none');
            terminal.innerHTML += `<span class="text-warning">--- Session Recovered (${trialCount} points) ---</span><br>`;
        };
    }
};

// SERIAL CONNECTION LOGIC
document.getElementById('btnConnect').onclick = async function() {
    if (port) { location.reload(); return; }

    try {
        // 1. Request & Open Port
        port = await navigator.serial.requestPort();
        await port.open({ baudRate: 9600 });
        
        // 2. Update UI
        this.innerText = "DISCONNECT";
        this.className = "btn btn-danger fw-bold px-5";
        terminal.innerHTML += "<b class='text-white'>[SYSTEM] Port Open. Waiting for Arduino...</b><br>";

        // 3. Set up stream
        const decoder = new TextDecoderStream();
        port.readable.pipeTo(decoder.writable);
        reader = decoder.readable.getReader();

        let lineBuffer = "";
        
        // 4. Read Loop
        while (true) {
            const { value, done } = await reader.read();
            if (done) break;
            
            lineBuffer += value;
            if (lineBuffer.includes('\n')) {
                let lines = lineBuffer.split('\n');
                lineBuffer = lines.pop(); // Keep partial line
                
                lines.forEach(line => {
                    let clean = line.trim();
                    
                    // Handle DEBUG messages
                    if (clean.startsWith("DEBUG")) {
                        terminal.innerHTML += `<span class="text-muted">${clean}</span><br>`;
                        terminal.scrollTop = terminal.scrollHeight;
                    } 
                    // Handle Data (comma separated numbers)
                    else if (clean && !isNaN(clean.split(',')[0])) {
                        trialCount++;
                        let vals = clean.split(',').map(v => parseFloat(v));
                        collectedData.push([trialCount, new Date().toLocaleTimeString(), ...vals]);
                        
                        autoSave();

                        terminal.innerHTML += `<span class="text-info">#${trialCount}:</span> ${clean}<br>`;
                        terminal.scrollTop = terminal.scrollHeight;
                        
                        // Update Graph
                        vals.forEach((v, i) => { 
                            if (i < 2) Plotly.extendTraces('graph-container', { x: [[trialCount]], y: [[v]] }, [i]); 
                        });
                    }
                });
            }
        }
    } catch (e) { 
        console.error(e);
        terminal.innerHTML += `<span class="text-danger">[ERROR] ${e}</span><br>`;
    }
};

// Reset Button
document.getElementById('btnClear').onclick = () => {
    if(confirm("This will delete all saved data. Are you sure?")) {
        localStorage.clear();
        location.reload();
    }
};

// Export CSV
document.getElementById('btnExport').onclick = () => {
    if(collectedData.length === 0) return alert("No data to export!");
    let csv = "Trial,Time,V1,V2\n" + collectedData.map(e => e.join(",")).join("\n");
    let blob = new Blob([csv], { type: 'text/csv' });
    let a = document.createElement('a');
    a.href = URL.createObjectURL(blob);
    a.download = 'lab_data_' + new Date().toLocaleDateString() + '.csv';
    a.click();
};

// Flashing Logic
document.querySelectorAll('.flash-btn').forEach(btn => {
    btn.onclick = async function() {
        let hex = this.getAttribute('data-hex');
        let unit = this.getAttribute('data-unit');
        let msg = this.nextElementSibling;
        
        msg.innerText = "Status: Flashing...";
        
        // Reset graph for new lesson type
        initPlot(unit === 'Temp/Hum' ? ['Humidity (%)', 'Temp (°C)'] : [unit]);
        
        try {
            let res = await fetch(hex);
            let buf = await res.arrayBuffer();
            let avr = new AvrgirlArduino({ board: 'uno' });
            avr.flash(buf, (err) => { 
                msg.innerText = err ? "Status: Flash Error" : "Status: Success! Connect now.";
            });
        } catch(e) { 
            msg.innerText = "Status: File Error"; 
            console.error(e);
        }
    };
});
</script>
</body>
</html>