<?php
// 1. Define a local folder for sessions
$session_path = __DIR__ . '/sessions';

// 2. Create the folder if it doesn't exist yet
if (!is_dir($session_path)) {
    mkdir($session_path, 0777, true);
}

// 3. Tell PHP to use this new folder
session_save_path($session_path);

// 4. NOW start the session
session_start();

// If the team has already registered, send them straight back to the dashboard
if (isset($_SESSION['team_name'])) {
    header("Location: dashboard.php");
    exit();
}

// ... (The rest of your index.php code remains exactly the same below this)

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['team_name'])) {
    
    // Save the team name safely
    $_SESSION['team_name'] = htmlspecialchars(trim($_POST['team_name']));
    
    // Initialize their progress: Puzzles 1 through 10 are set to 0 (unsolved)
    $_SESSION['solved'] = array(
        1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 
        6 => 0, 7 => 0, 8 => 0, 9 => 0, 10 => 0
    );
    
    // Send them to the game dashboard
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Race to Wat Phnom - Start</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
  <style>
      body {
          background-color: #f8f9fa;
      }
      .start-card {
          background: white;
          border-radius: 15px;
          padding: 40px;
          box-shadow: 0 10px 30px rgba(0,0,0,0.1);
          margin-top: 10vh;
      }
  </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6 text-center">
            
            <div class="start-card">
                <img src="images/watPhnom.jpg" alt="Wat Phnom" style="max-width: 100%; height: auto; border-radius: 10px; margin-bottom: 20px;" onerror="this.style.display='none'">
                
                <h1 class="fw-bold text-primary mb-3">Race to Wat Phnom</h1>
                <p class="text-muted fs-5 mb-4">Solve the puzzles, crack the codes, and be the first team to reach the top of the hill!</p>
                
                <form method="POST" action="index.php">
                    <div class="mb-4">
                        <label for="team_name" class="form-label fs-4 fw-bold">Enter Your Team Name:</label>
                        <input type="text" class="form-control form-control-lg text-center fw-bold" id="team_name" name="team_name" placeholder="e.g. The Codebreakers" required autocomplete="off" style="border: 2px solid #0d6efd;">
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg px-5 fw-bold w-100" style="height: 60px; font-size: 1.5rem;">Start the Race!</button>
                </form>
            </div>

        </div>
    </div>
</div>

</body>
</html>