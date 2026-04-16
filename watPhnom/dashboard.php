<?php
// 1. Use the local session workaround
$session_path = __DIR__ . '/sessions';
if (!is_dir($session_path)) {
    mkdir($session_path, 0777, true);
}
session_save_path($session_path);
session_start();

// 2. Security Check: Are they logged in?
if (!isset($_SESSION['team_name']) || empty($_SESSION['team_name'])) {
    // Kick them back to the start if no team name is found
    header("Location: index.php");
    exit();
}

$team_name = htmlspecialchars($_SESSION['team_name']);
$solved_data = $_SESSION['solved'];

// 3. Game Logic: Figure out what is unlocked
$puzzle1_solved = ($solved_data[1] == 1);

// Check if puzzles 1 through 9 are all solved to unlock 10
$all_1_to_9_solved = true;
for ($i = 1; $i <= 9; $i++) {
    if ($solved_data[$i] == 0) {
        $all_1_to_9_solved = false;
        break;
    }
}

// Calculate total score for the progress bar
$total_solved = array_sum($solved_data);
$progress_percent = ($total_solved / 10) * 100;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard - Race to Wat Phnom</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
  <style>
      body { background-color: #f0f2f5; }
      .puzzle-btn {
          height: 120px;
          border-radius: 15px;
          transition: transform 0.2s;
          display: flex;
          flex-direction: column;
          justify-content: center;
          align-items: center;
          text-decoration: none !important;
      }
      .puzzle-btn:hover:not(.disabled) {
          transform: translateY(-5px);
          box-shadow: 0 10px 20px rgba(0,0,0,0.15) !important;
      }
      .btn-locked {
          background-color: #e9ecef;
          color: #adb5bd;
          border: 2px dashed #ced4da;
          cursor: not-allowed;
      }
  </style>
</head>
<body>

<div class="container py-5">
    
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h1 class="fw-bold text-primary">Team: <span class="text-dark"><?php echo $team_name; ?></span></h1>
            <p class="fs-5 text-muted">Solve puzzles to reach the top of Wat Phnom!</p>
            
            <div class="progress mt-3 mx-auto" style="height: 25px; max-width: 600px; border-radius: 15px; background-color: #e9ecef;">
                <div class="progress-bar bg-success progress-bar-striped progress-bar-animated fs-6 fw-bold" role="progressbar" style="width: <?php echo $progress_percent; ?>%;">
                    <?php echo $total_solved; ?> / 10 Solved
                </div>
            </div>
        </div>
    </div>

    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-4 justify-content-center mt-3">
        
        <?php for ($i = 1; $i <= 10; $i++): ?>
            <?php
            // Default State: Locked
            $status = 'locked';
            $btn_class = 'btn-locked disabled';
            $icon = '🔒';
            $link = '#';

            // Check if solved
            if ($solved_data[$i] == 1) {
                $status = 'completed';
                $btn_class = 'btn-success text-white';
                $icon = '✅';
                $link = 'puzzle_' . $i . '.php'; // Allow them to revisit
            } else {
                // Unlocking Logic
                if ($i == 1) {
                    $status = 'unlocked';
                    $btn_class = 'btn-primary text-white';
                    $icon = '▶️';
                    $link = 'puzzle_1.php';
                } elseif ($i >= 2 && $i <= 9 && $puzzle1_solved) {
                    $status = 'unlocked';
                    $btn_class = 'btn-primary text-white';
                    $icon = '▶️';
                    $link = 'puzzle_' . $i . '.php';
                } elseif ($i == 10 && $all_1_to_9_solved) {
                    $status = 'unlocked';
                    $btn_class = 'btn-warning text-dark fw-bold border-warning';
                    $icon = '🏆';
                    $link = 'puzzle_10.php';
                }
            }
            ?>

            <div class="col">
                <a href="<?php echo $link; ?>" class="puzzle-btn shadow-sm <?php echo $btn_class; ?>">
                    <span class="fs-1 mb-2"><?php echo $icon; ?></span>
                    <span class="fs-5 fw-bold">Puzzle <?php echo $i; ?></span>
                </a>
            </div>

        <?php endfor; ?>

    </div>
    
    <div class="row mt-5">
        <div class="col-12 text-center">
            <a href="index.php?reset=1" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to reset your team data? This will delete all progress!');">Restart Entire Game (Testing Only)</a>
        </div>
    </div>

</div>

</body>
</html>