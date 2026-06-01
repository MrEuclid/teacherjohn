<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Teacher Admin | Team Leaderboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body { background-color: #1a1d20; color: #e9ecef; padding: 40px 0; font-family: 'Segoe UI', sans-serif; }
        .card { background-color: #212529; border: 1px solid #373b3e; border-radius: 15px; }
        .table { color: #dee2e6; margin-bottom: 0; }
        .table thead th { background-color: #2c3034; color: #0dcaf0; text-transform: uppercase; padding: 20px; }
        .gold { color: #ffd700; }
        .silver { color: #c0c0c0; }
        .bronze { color: #cd7f32; }
        .score-val { font-family: monospace; font-size: 1.6rem; color: #0dcaf0; font-weight: bold; }
        .controls-bar { background: rgba(33, 37, 41, 0.95); padding: 20px; border-radius: 15px; margin-bottom: 30px; border: 1px solid #373b3e; }
    </style>
</head>
<body>

<div class="container-fluid px-5">
    <div class="controls-bar d-flex justify-content-between align-items-center shadow">
        <div>
            <h1 class="m-0 fw-bold">🏆 Team Rankings</h1>
            <p class="text-muted m-0" id="statusUpdate">Loading results...</p>
        </div>
        
        <div class="d-flex gap-3">
            <div class="input-group">
                <label class="input-group-text bg-dark text-info border-secondary fw-bold">Grade Level</label>
              <select id="levelFilter" class="form-select bg-dark text-white border-secondary fw-bold" style="width: 200px;">
    <option value="all">All Grades</option>
    <option value="0">Grade 2</option>
    <option value="1">Grade 3-4</option>
    <option value="2">Grade 5</option>
    <option value="3">Grade 6</option>
</select>
            </div>
            <button id="exportCsv" class="btn btn-success fw-bold px-4">📥 Export CSV</button>
            <button id="deleteLevel" class="btn btn-outline-danger fw-bold px-4">🗑️ Clear Data</button>
        </div>
    </div>

    <div class="card shadow-lg">
        <div class="table-responsive">
            <table class="table table-dark table-hover align-middle text-center" id="resultsTable">
                <thead>
                    <tr>
                        <th style="width: 10%;">Rank</th>
                        <th class="text-start ps-5" style="width: 40%;">Team Name</th>
                        <th style="width: 15%;">Class</th>
                        <th style="width: 15%;">Score</th>
                        <th style="width: 20%;">Time</th>
                    </tr>
                </thead>
                <tbody id="leaderboardBody"></tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    let currentLevel = "all";
function refreshLeaderboard() {
        console.log("STEP 1: refreshLeaderboard() triggered. Current level: ", currentLevel);

        $.ajax({
            url: 'fetchMathLeaderboard.php',
            data: { level: currentLevel },
            dataType: 'json',
            cache: false,
            success: function(data) {
                console.log("STEP 2: AJAX Success! Raw data type:", typeof data);
               console.log("STEP 3: Data content:", JSON.stringify(data));

                // Bulletproof JSON parsing just in case PHP missed the header
                if (typeof data === "string") {
                    try {
                        data = JSON.parse(data);
                        console.log("STEP 4: Successfully forced JSON parse.");
                    } catch (e) {
                        console.error("STEP 4 ERROR: Failed to parse string into JSON:", e);
                        return;
                    }
                }

                // Verify the HTML table exists before trying to write to it
                let body = $('#leaderboardBody');
                if (body.length === 0) {
                    console.error("STEP 5 CRITICAL ERROR: Could not find <tbody id='leaderboardBody'> in your HTML! Check your table tags.");
                    return;
                }

                body.empty();

                if (!data || data.length === 0) {
                    console.log("STEP 6: Data is empty array. Showing 'No results'.");
                    body.append('<tr><td colspan="5" class="py-5 text-muted fs-4">No results for this level.</td></tr>');
                    $('#statusUpdate').text("Last Update: " + new Date().toLocaleTimeString());
                    return;
                }

                console.log("STEP 6: Iterating through data to build table...");
                data.forEach((row, index) => {
                    let rank = index + 1;
                    let rankDisplay = rank;
                    if (rank === 1) rankDisplay = "<span class='gold fs-2'>🥇</span>";
                    else if (rank === 2) rankDisplay = "<span class='silver fs-3'>🥈</span>";
                    else if (rank === 3) rankDisplay = "<span class='bronze fs-4'>🥉</span>";

// Translate the database level explicitly back to the correct Grade text
let dbLevel = parseInt(row.level);
let gradeName = "";

if (dbLevel === 0) {
    gradeName = "Grade 2";
} else if (dbLevel === 1) {
    gradeName = "Grade 3-4";
} else if (dbLevel === 2) {
    gradeName = "Grade 5";
} else if (dbLevel === 3) {
    gradeName = "Grade 6";
} else {
    gradeName = "Grade " + dbLevel; // Fallback just in case
}
                    body.append(`
                        <tr>
                            <td>${rankDisplay}</td>
                            <td class="text-start ps-5 fw-bold fs-4">${row.team}</td>
                            <td><span class="badge bg-secondary fs-6">${gradeName}</span></td>
                            <td class="score-val">${row.score}</td>
                            // New line (using text-white)
<td class="text-white fw-bold">${row.timeElapsed} mins</td>
                        </tr>
                    `);
                });
                
                $('#statusUpdate').text("Last Update: " + new Date().toLocaleTimeString()).removeClass("text-danger");
                console.log("STEP 7: Table build complete!");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("AJAX Error:", textStatus, errorThrown);
                console.log("Raw Server Response:", jqXHR.responseText);
                $('#statusUpdate').text("⚠️ Data parse error. Check Developer Console (F12).").addClass("text-danger");
            }
        });
    }
    $('#levelFilter').change(function() {
        currentLevel = $(this).val();
        refreshLeaderboard();
    });

    $('#deleteLevel').click(function() {
        if (currentLevel === "all") {
            alert("Select a specific Grade first.");
            return;
        }

        if (confirm("Permanently clear results for Grade " + (parseInt(currentLevel) + 2) + "?")) {
            let password = prompt("Enter teacher password (pythagoras):");
            if (password === "pythagoras") {
                $.post('deleteLevel.php', { level: currentLevel, pass: password }, function(res) {
                    alert(res);
                    refreshLeaderboard();
                });
            } else if (password !== null) {
                alert("Incorrect password.");
            }
        }
    });

    $('#exportCsv').click(function() {
        let csv = ["Rank,Team Name,Grade,Score,Time"];
        $('#leaderboardBody tr').each(function() {
            let rowData = [];
            $(this).find('td').each(function() {
                rowData.push('"' + $(this).text().replace(/[🥇🥈🥉]/g, '').trim() + '"');
            });
            csv.push(rowData.join(","));
        });
        let blob = new Blob([csv.join("\n")], { type: 'text/csv;charset=utf-8;' });
        let link = document.createElement("a");
        link.href = URL.createObjectURL(blob);
        link.download = "Math_Results_Grade_" + (parseInt(currentLevel) + 2) + ".csv";
        link.click();
    });

    refreshLeaderboard();
    setInterval(refreshLeaderboard, 20000);
});
</script>
</body>
</html>