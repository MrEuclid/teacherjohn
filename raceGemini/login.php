<?php
session_save_path(sys_get_temp_dir());
session_start();


// --- NEW: Logout Logic ---
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_unset();    // Clear all session variables
    session_destroy();  // Destroy the session completely
    header("Location: login.php?cleared=1"); // Redirect to a clean URL
    exit();
}
// -------------------------

require_once '../connectTeacherJohn.php'; 
// ... rest of your code ...




mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    $dbServer = new mysqli($server, $username, $password, $database);
    $dbServer->set_charset("utf8mb4");
} catch (Exception $e) {
    error_log($e->getMessage());
    exit("Database connection failed. Please contact the administrator.");
}

$error_message = "";
$competition_duration = 45 * 60; // 45 minutes in seconds

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $teamName = trim($_POST['teamName']);
    $classCode = trim($_POST['classCode']);
    $currentTime = time();

    if (empty($teamName) || empty($classCode)) {
        $error_message = "Please enter a team name and select a class.";
    } else {
        $stmt = $dbServer->prepare("SELECT classCode, startTime FROM teams WHERE teamName = ?");
        $stmt->bind_param("s", $teamName);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $elapsed = $currentTime - $row['startTime'];

            if ($elapsed > $competition_duration) {
                $error_message = "Sorry, your 60-minutes is over.";
            } else {
                $_SESSION['teamName'] = $teamName;
                $_SESSION['classCode'] = $row['classCode'];
                $_SESSION['startTime'] = $row['startTime'];
                header("Location: indexMathsComp.php");
                exit();
            }
        } else {
            $insert_stmt = $dbServer->prepare("INSERT INTO teams (teamName, classCode, startTime) VALUES (?, ?, ?)");
            $insert_stmt->bind_param("ssi", $teamName, $classCode, $currentTime);
            
            if ($insert_stmt->execute()) {
                $_SESSION['teamName'] = $teamName;
                $_SESSION['classCode'] = $classCode;
                $_SESSION['startTime'] = $currentTime;
                header("Location: indexMathsComp.php");
                exit();
            } else {
                $error_message = "An error occurred setting up your team. Try a different name.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Maths Competition - Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
    <style>
        body { background-color: #f4f6f9; display: flex; align-items: center; justify-content: center; height: 100vh; }
        .login-card { max-width: 400px; width: 100%; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 10px; }
        .card-header { background-color: #0d6efd; color: white; border-radius: 10px 10px 0 0 !important; text-align: center; font-weight: bold; font-size: 1.2rem;}
    </style>
</head>
<body>

<div class="card login-card">
    <div class="card-header py-3">
        Mathematics Competition
    </div>
    <div class="card-body p-4">
        
        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
<?php if (isset($_GET['kicked']) && $_GET['kicked'] == 1): ?>
    <div class="alert alert-danger fw-bold text-center mt-3 shadow-sm" role="alert">
        ⚠️ Warning: You left the competition window! Your session was interrupted. Please log in again to continue.
    </div>
<?php endif; ?>

<?php if (isset($_GET['cleared']) && $_GET['cleared'] == 1): ?>
    <div class="alert alert-success fw-bold text-center mt-3 shadow-sm" role="alert">
        ✅ Session cleared! You can now start fresh with a new team.
    </div>
<?php endif; ?>
        <form method="POST" action="login.php">
            <div class="mb-3">
                <label for="teamName" class="form-label">Team Name</label>
                <input type="text" class="form-control" id="teamName" name="teamName" placeholder="Enter unique team name" required>
            </div>
            
            <div class="mb-4">
                <label for="classCode" class="form-label">Select Class</label>
              <select name="classCode" class="form-select w-25 me-3 border-danger" required>
    <option value="" disabled selected>Select class</option>
  
    
    <option value="7A">7A</option>
    <option value="7B">7B</option>
    <option value="7C">7C</option>
    <option value="8A">8A</option>
    <option value="8B">8B</option>
    <option value="8C">8C</option>
    <option value="9A">9A</option>
    <option value="9B">9B</option>
    <option value="9C">9C</option>

    <option value="10A">10A</option>
    <option value="10B">10B</option>
    <option value="11A">11A</option>
    <option value="11B">11B</option>
    <option value="12A">12A</option>
    <option value="12B">12B</option>
</select>
            </div>
            
            <button type="submit" class="btn btn-primary w-100 fs-5">Start Competition</button>
        </form>

<div class="text-center mt-4">
        <a href="login.php?action=logout" class="text-muted text-decoration-none">
            <small>🔄 Reset Session (Click here if you are on a shared computer and need to start over)</small>
        </a>
    </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"></script>
</body>
</html>