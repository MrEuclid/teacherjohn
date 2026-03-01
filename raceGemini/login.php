<?php
session_save_path(sys_get_temp_dir());
session_start();

require_once '../connectTeacherJohn.php';
$error_message = "";
$competition_duration = 45 * 60; // 45 minutes in seconds

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $teamName = trim($_POST['teamName']);
    $classCode = trim($_POST['classCode']);
    $currentTime = time();

    if (empty($teamName) || empty($classCode)) {
        $error_message = "Please enter a team name and select a class.";
    } else {
        $stmt = $conn->prepare("SELECT classCode, startTime FROM teams WHERE teamName = ?");
        $stmt->bind_param("s", $teamName);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $elapsed = $currentTime - $row['startTime'];

            if ($elapsed > $competition_duration) {
                $error_message = "Sorry, your 45-minute competition window has expired.";
            } else {
                $_SESSION['teamName'] = $teamName;
                $_SESSION['classCode'] = $row['classCode'];
                $_SESSION['startTime'] = $row['startTime'];
                header("Location: indexMathsSeniorComp.php");
                exit();
            }
        } else {
            $insert_stmt = $conn->prepare("INSERT INTO teams (teamName, classCode, startTime) VALUES (?, ?, ?)");
            $insert_stmt->bind_param("ssi", $teamName, $classCode, $currentTime);
            
            if ($insert_stmt->execute()) {
                $_SESSION['teamName'] = $teamName;
                $_SESSION['classCode'] = $classCode;
                $_SESSION['startTime'] = $currentTime;
                header("Location: indexMathsSeniorComp.php");
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

        <form method="POST" action="login.php">
            <div class="mb-3">
                <label for="teamName" class="form-label">Team Name</label>
                <input type="text" class="form-control" id="teamName" name="teamName" placeholder="Enter unique team name" required>
            </div>
            
            <div class="mb-4">
                <label for="classCode" class="form-label">Select Class</label>
                <select class="form-select" id="classCode" name="classCode" required>
                    <option value="" disabled selected>Choose your class...</option>
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
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"></script>
</body>
</html>