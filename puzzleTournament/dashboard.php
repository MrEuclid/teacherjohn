<?php
session_save_path(__DIR__ . '/sessions');
session_start();

// Boot them back to start if they haven't registered
if (!isset($_SESSION['team_name'])) {
    header("Location: index.php");
    exit();
}

// Catch the Switch Team / Logout Request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['switch_team'])) {
    // Unset all session variables
    $_SESSION = array();
    // Destroy the session completely
    session_destroy();
    // Send them back to the start page
    header("Location: index.php");
    exit();
}

// Catch the Reset Request (Your existing code)
// ...
// Catch the Reset Request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reset_tournament'])) {
    $_SESSION['solved'] = array(
        1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 
        6 => 0, 7 => 0, 8 => 0, 9 => 0
    );
    // Refresh the page to clear the POST data
    header("Location: dashboard.php");
    exit();
}

// Catch the victory POST from Hanoi or any other puzzle
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['puzzle_solved'])) {
    $puzzle_num = (int)$_POST['puzzle_solved'];
    $_SESSION['solved'][$puzzle_num] = 1; 
}

$solved = $_SESSION['solved'];
$team = htmlspecialchars($_SESSION['team_name']);

// Helper function to check if a node should be clickable
function getPuzzleState($num, $solvedArray) {
    // If they already solved it, mark it completed
    if ($solvedArray[$num] == 1) {
        return 'completed';
    }

    // Special logic for the final puzzle (Node 9)
    if ($num == 9) {
        $solvedCount = 0;
        for ($i = 1; $i <= 8; $i++) {
            if ($solvedArray[$i] == 1) {
                $solvedCount++;
            }
        }
       return ($solvedCount == 8) ? 'unlocked' : 'locked';
    }

    // Puzzles 1-9 are always unlocked if not completed
    return 'unlocked';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Map Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* The container holding your map image */
        .map-container {
            position: relative;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            background-image: url('images/watPhnomMap.jpg'); 
            background-size: cover;
            background-color: #e2e8f0; 
            aspect-ratio: 4/5; 
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            border: 4px solid #cbd5e1;
        }

        /* Base styles for the image thumbnails */
        .map-pin {
            position: absolute;
            width: 60px; /* Slightly larger to show off the images */
            height: 60px;
            border-radius: 50%;
            background-size: cover;
            background-position: center;
            transform: translate(-50%, -50%);
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            
            /* Optional: Keeps the numbers visible over the image, remove if you only want the picture */
            color: white;
            font-weight: bold;
            font-size: 1.5rem;
            text-shadow: 0px 2px 4px rgba(0,0,0,0.8);
        }

        /* The three states utilizing CSS Filters */
        .locked {
            filter: grayscale(100%) brightness(60%);
            border: 3px solid #64748b;
            cursor: not-allowed;
        }
        
        .unlocked {
            filter: grayscale(0%) brightness(100%);
            border: 4px solid #3b82f6; /* Blue border to indicate active */
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.8);
            animation: pulse 2s infinite;
            z-index: 10;
        }

      .completed {
    background-color: #10b981; /* Green */
    color: yellow;
    border: 2px solid white;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    cursor: default; /* Tells the browser not to show the 'clickable' finger pointer */
}

        /* Make the finale pin stand out more */
        .finale-pin {
            width: 85px;
            height: 85px;
        }

        @keyframes pulse {
            0% { transform: translate(-50%, -50%) scale(1); }
            50% { transform: translate(-50%, -50%) scale(1.1); }
            100% { transform: translate(-50%, -50%) scale(1); }
        }
    </style>
</head>
<body class="bg-slate-100 p-6 relative min-h-screen">

 <div class="absolute top-4 right-4 md:top-8 md:right-8 flex flex-col gap-2 z-50">
        
        <form method="POST" action="dashboard.php" onsubmit="return confirm('Are you sure you want to reset all progress? This will lock all completed puzzles.');">
            <input type="hidden" name="reset_tournament" value="1">
            <button type="submit" class="w-full bg-rose-100 hover:bg-rose-200 text-rose-700 font-bold py-2 px-4 rounded-lg text-sm transition-colors border border-rose-200 shadow-sm flex items-center justify-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                Reset Progress
            </button>
        </form>

        <form method="POST" action="dashboard.php" onsubmit="return confirm('Are you sure you want to switch teams? You will need to enter a new team name.');">
            <input type="hidden" name="switch_team" value="1">
            <button type="submit" class="w-full bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold py-2 px-4 rounded-lg text-sm transition-colors border border-slate-300 shadow-sm flex items-center justify-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Switch Team
            </button>
        </form>
        
    </div>

    <div class="max-w-4xl mx-auto mb-8 text-center pt-8 md:pt-0">
        <h1 class="text-4xl font-black text-indigo-900">Team: <?php echo $team; ?></h1>
        <p class="text-lg text-slate-600 font-bold mt-2">Solve all 9 challenges to unlock the finale!</p>
    </div>

    <div class="map-container">
        
        <?php $state1 = getPuzzleState(1, $solved); ?>
        <a href="hanoi_1.php" class="map-pin <?php echo $state1; ?>" 
        style="bottom: 10%; left: 20%; background-image: url('images/moto.jpg');" title="Tower of Hanoi">
        
        1</a>

        <?php $state2 = getPuzzleState(2, $solved); ?>
        <a href="4Objects.php" class="map-pin <?php echo $state2; ?>" 
        style="bottom: 20%; left: 30%; background-image: url('images/aeonMall.jpg');" title="Logic Lab">2</a>

        <?php $state3 = getPuzzleState(3, $solved); ?>
        <a href="4color.php" class="map-pin <?php echo $state3; ?>" 
        style="bottom: 30%; left: 40%; background-image: url('images/sisowatQuay.jpg');" title="4 Colour Map">3</a>

        <?php $state4 = getPuzzleState(4, $solved); ?>
        <a href="lightsOut.php" class="map-pin <?php echo $state4; ?>" 
        style="bottom: 40%; left: 50%; background-image: url('images/silverPagoda.jpg');" title="Find the number">4</a>

        <?php $state5 = getPuzzleState(5, $solved); ?>
        <a href="miniSudoku.php" class="map-pin <?php echo $state5; ?>" 
        style="bottom: 50%; left: 60%; background-image: url('images/phsar_thmei.jpg');" title="Solve the sudoku">5</a>


        <?php $state6 = getPuzzleState(6, $solved); ?>
        <a href="sevenSegment.php" class="map-pin <?php echo $state6; ?>" 
        style="bottom: 60%; left: 50%; background-image: url('images/wat_ounalom.jpg');" title="Turn the lights on">6</a>

        <?php $state7 = getPuzzleState(7, $solved); ?>
        <a href="pentominoes.php" class="map-pin <?php echo $state7; ?>" 
        style="bottom: 70%; left: 40%; background-image: url('images/independenceMonument.jpg');" title="Solve it">7</a>

        <?php $state8 = getPuzzleState(8, $solved); ?>
        <a href="5Colours.php" class="map-pin <?php echo $state8; ?>" 
        style="bottom: 80%; left: 50%; background-image: url('images/watPhnom.jpg');" title="5 colour puzzle">8</a>
  
  
        <?php $state9 = getPuzzleState(9, $solved); ?>
        <a href="<?php echo $state9 === 'locked' ? '#' : 'hanoi_2.php'; ?>" 
           class="map-pin finale-pin <?php echo $state9; ?>" 
           style="top: 5%; left: 50%; background-image: url('images/buddha.jpg');"
           title="Wat Phnom Finale"
           onclick="<?php echo $state9 === 'locked' ? 'alert(\'You must complete Puzzles 1-8 to unlock Wat Phnom!\'); return false;' : ''; ?>">
           9
        </a>

    </div>

</body>
</html>