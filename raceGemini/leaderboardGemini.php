<?php
// --- DATABASE CONFIGURATION ---

require_once '../connectTeacherJohn.php';

// --- HANDLE CSV DOWNLOAD REQUEST ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'download_csv') {
    $classSelect = $_POST['class_select'];
    
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=MathsComp_Results_' . $classSelect . '_' . date('Y-m-d') . '.csv');
    
    $output = fopen('php://output', 'w');
    fputcsv($output, array('Rank', 'Team Name', 'Class', 'Total Points', 'Elapsed Time (MM:SS)'));
    
    if ($classSelect === 'ALL') {
        $sql = "SELECT t.teamName, t.classCode, COALESCE(SUM(r.points), 0) as totalPoints, COALESCE(MAX(r.elapsedTime), 0) as finalTime 
                FROM teams t LEFT JOIN results r ON t.teamName = r.teamName 
                GROUP BY t.teamName, t.classCode 
                ORDER BY t.classCode ASC, totalPoints DESC, finalTime ASC";
        $stmt = $conn->prepare($sql);
    } else {
        $sql = "SELECT t.teamName, t.classCode, COALESCE(SUM(r.points), 0) as totalPoints, COALESCE(MAX(r.elapsedTime), 0) as finalTime 
                FROM teams t LEFT JOIN results r ON t.teamName = r.teamName 
                WHERE t.classCode = ? 
                GROUP BY t.teamName, t.classCode 
                ORDER BY totalPoints DESC, finalTime ASC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $classSelect);
    }
    
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $rank = 1;
        while ($row = $result->fetch_assoc()) {
            $seconds = $row['finalTime'];
            $formattedTime = sprintf('%02d:%02d', floor($seconds / 60), $seconds % 60);
            fputcsv($output, array($rank, $row['teamName'], $row['classCode'], $row['totalPoints'], $formattedTime));
            $rank++;
        }
    }
    fclose($output);
    exit(); 
}

$message = "";

// --- HANDLE "CLEAR DATABASE" REQUEST (NOW BY CLASS) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'clear') {
    $teacherPassword = $_POST['teacherPassword'] ?? '';
    $classToClear = $_POST['class_clear'] ?? 'ALL';
    
    if (strtolower(trim($teacherPassword)) === 'pythagoras') {
        if ($classToClear === 'ALL') {
            // Wipe everything
            $conn->query("SET FOREIGN_KEY_CHECKS = 0;");
            $conn->query("TRUNCATE TABLE results;");
            $conn->query("TRUNCATE TABLE teams;");
            $conn->query("SET FOREIGN_KEY_CHECKS = 1;");
            $message = "<div class='alert alert-success'>Entire database successfully cleared!</div>";
        } else {
            // Wipe ONLY the selected class. 
            // The ON DELETE CASCADE in the database automatically deletes their scores in the results table!
            $stmt = $conn->prepare("DELETE FROM teams WHERE classCode = ?");
            $stmt->bind_param("s", $classToClear);
            $stmt->execute();
            $message = "<div class='alert alert-success'>Data for class <strong>{$classToClear}</strong> successfully cleared!</div>";
        }
    } else {
        $message = "<div class='alert alert-danger'>Incorrect password. Data was NOT cleared.</div>";
    }
}

// --- FETCH LEADERBOARD DATA (WITH FILTER) ---
$viewClass = $_GET['view_class'] ?? 'ALL';

if ($viewClass === 'ALL') {
    $sql = "SELECT t.teamName, t.classCode, COALESCE(SUM(r.points), 0) as totalPoints, COALESCE(MAX(r.elapsedTime), 0) as finalTime 
            FROM teams t LEFT JOIN results r ON t.teamName = r.teamName 
            GROUP BY t.teamName, t.classCode 
            ORDER BY t.classCode ASC, totalPoints DESC, finalTime ASC";
    $stmt = $conn->prepare($sql);
} else {
    $sql = "SELECT t.teamName, t.classCode, COALESCE(SUM(r.points), 0) as totalPoints, COALESCE(MAX(r.elapsedTime), 0) as finalTime 
            FROM teams t LEFT JOIN results r ON t.teamName = r.teamName 
            WHERE t.classCode = ?
            GROUP BY t.teamName, t.classCode 
            ORDER BY totalPoints DESC, finalTime ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $viewClass);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Teacher Leaderboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
    <style>
        body { background-color: #f4f6f9; padding-top: 30px; padding-bottom: 50px; }
        .leaderboard-card { box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 10px; background: white; padding: 20px; }
        .teacher-zone { border: 2px solid #6c757d; padding: 20px; border-radius: 10px; margin-top: 40px; background-color: #ffffff; box-shadow: 0 4px 12px rgba(0,0,0,0.05);}
        .danger-zone { border-top: 2px dashed #dc3545; padding-top: 20px; margin-top: 20px;}
    </style>
</head>
<body>

<div class="container">
    <?php echo $message; ?>

    <div class="leaderboard-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary fw-bold m-0">🏆 Live Leaderboard</h2>
            
            <form method="GET" action="leaderboardGemini.php" class="d-flex align-items-center m-0">
                <label class="me-2 fw-bold text-muted">Viewing:</label>
                <select name="view_class" class="form-select me-2" onchange="this.form.submit()">
                    <option value="ALL" <?php if($viewClass == 'ALL') echo 'selected'; ?>>All Classes</option>
                    <option value="10A" <?php if($viewClass == '10A') echo 'selected'; ?>>10A</option>
                    <option value="10B" <?php if($viewClass == '10B') echo 'selected'; ?>>10B</option>
                    <option value="11A" <?php if($viewClass == '11A') echo 'selected'; ?>>11A</option>
                    <option value="11B" <?php if($viewClass == '11B') echo 'selected'; ?>>11B</option>
                    <option value="12A" <?php if($viewClass == '12A') echo 'selected'; ?>>12A</option>
                    <option value="12B" <?php if($viewClass == '12B') echo 'selected'; ?>>12B</option>
                </select>
                <a href="leaderboardGemini.php?view_class=<?php echo htmlspecialchars($viewClass); ?>" class="btn btn-outline-primary">🔄 Refresh</a>
            </form>
        </div>
        
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Rank</th>
                    <th>Team Name</th>
                    <th>Class</th>
                    <th>Points</th>
                    <th>Elapsed Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $rank = 1;
                    while ($row = $result->fetch_assoc()) {
                        $seconds = $row['finalTime'];
                        $formattedTime = sprintf('%02d:%02d', floor($seconds / 60), $seconds % 60);
                        $rowClass = ($rank === 1 && $row['totalPoints'] > 0) ? "table-warning fw-bold" : "";
                        
                        echo "<tr class='{$rowClass}'>";
                        echo "<td>#{$rank}</td>";
                        echo "<td>" . htmlspecialchars($row['teamName']) . "</td>";
                        echo "<td>{$row['classCode']}</td>";
                        echo "<td class='fs-5'>{$row['totalPoints']}</td>";
                        echo "<td>{$formattedTime}</td>";
                        echo "</tr>";
                        $rank++;
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center py-4'>No teams have started the competition for this class.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="teacher-zone">
        <h3 class="mb-4">🛠️ Teacher Tools</h3>
        
        <h5 class="text-success">📥 Export Results</h5>
        <p class="text-muted small">Download a CSV spreadsheet of the final standings.</p>
        <form method="POST" action="leaderboardGemini.php" target="_blank" class="d-flex align-items-center mb-4">
            <input type="hidden" name="action" value="download_csv">
            <select name="class_select" class="form-select w-25 me-3" required>
                <option value="ALL">All Classes</option>
                <option value="10A">10A</option>
                <option value="10B">10B</option>
                <option value="11A">11A</option>
                <option value="11B">11B</option>
                <option value="12A">12A</option>
                <option value="12B">12B</option>
            </select>
            <button type="submit" class="btn btn-success">Download CSV</button>
        </form>

        <div class="danger-zone">
            <h5 class="text-danger">⚠️ Danger Zone: Clear Database</h5>
            <p class="text-muted small">Select a class to wipe their teams and scores to prepare for the next period.</p>
            <form method="POST" action="leaderboardGemini.php" class="d-flex align-items-center" onsubmit="return confirm('Are you sure you want to delete this data? Did you download the CSV first?');">
                <input type="hidden" name="action" value="clear">
                
                <select name="class_clear" class="form-select w-25 me-3 border-danger" required>
                    <option value="" disabled selected>Select class to clear...</option>
                    <option value="ALL" class="fw-bold text-danger">ALL CLASSES (Wipe Entire Database)</option>
                    <option value="10A">10A</option>
                    <option value="10B">10B</option>
                    <option value="11A">11A</option>
                    <option value="11B">11B</option>
                    <option value="12A">12A</option>
                    <option value="12B">12B</option>
                </select>

                <input type="password" name="teacherPassword" class="form-control w-25 me-3 border-danger" placeholder="Enter Password" required>
                <button type="submit" class="btn btn-danger">Wipe Data</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"></script>
</body>
</html>