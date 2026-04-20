<?php
session_save_path(__DIR__ . '/sessions');
session_start();

// Boot them back to start if they haven't registered
if (!isset($_SESSION['team_name'])) {
    header("Location: index.php");
    exit();
}

// Catch the Reset Request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reset_tournament'])) {
    $_SESSION['solved'] = array(
        1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 
        6 => 0, 7 => 0, 8 => 0, 9 => 0, 10 => 0
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

    // Special logic for the final puzzle (Node 10)
    if ($num == 10) {
        $solvedCount = 0;
        for ($i = 1; $i <= 9; $i++) {
            if ($solvedArray[$i] == 1) {
                $solvedCount++;
            }
        }
        return ($solvedCount == 9) ? 'unlocked' : 'locked';
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
            /* Replace with an actual drawing or image of the Wat Phnom path */
            background-image: url('images/watPhnomMap.jpg'); 
            background-size: cover;
            background-color: #e2e8f0; /* Fallback color */
            aspect-ratio: 4/5; 
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            border: 4px solid #cbd5e1;
        }

        /* Base styles for the map pins */
        .map-pin {
            position: absolute;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.25rem;
            transform: translate(-50%, -50%);
            transition: all 0.2s;
            text-decoration: none;
        }

        /* The three states */
        .locked {
            background-color: #94a3b8; /* Gray */
            color: white;
            cursor: not-allowed;
            opacity: 0.8;
            border: 2px solid #64748b;
        }
        
        .unlocked {
            background-color: #3b82f6; /* Blue */
            color: white;
            border: 4px solid #bfdbfe;
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.6);
            animation: pulse 2s infinite;
            z-index: 10;
        }

        .completed {
            background-color: #10b981; /* Green */
            color: white;
            border: 2px solid white;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        @keyframes pulse {
            0% { transform: translate(-50%, -50%) scale(1); }
            50% { transform: translate(-50%, -50%) scale(1.1); }
            100% { transform: translate(-50%, -50%) scale(1); }
        }
    </style>
</head>
<body class="bg-slate-100 p-6 relative min-h-screen">

    <form method="POST" action="dashboard.php" class="absolute top-4 right-4 md:top-8 md:right-8" onsubmit="return confirm('Are you sure you want to reset all progress? This will lock all completed puzzles.');">
        <input type="hidden" name="reset_tournament" value="1">
        <button type="submit" class="bg-rose-100 hover:bg-rose-200 text-rose-700 font-bold py-2 px-4 rounded-lg text-sm transition-colors border border-rose-200 shadow-sm flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
            Reset Progress
        </button>
    </form>

    <div class="max-w-4xl mx-auto mb-8 text-center pt-8 md:pt-0">
        <h1 class="text-4xl font-black text-indigo-900">Team: <?php echo $team; ?></h1>
        <p class="text-lg text-slate-600 font-bold mt-2">Solve all 9 challenges to unlock the finale!</p>
    </div>

    <div class="map-container">
        
        <?php $state1 = getPuzzleState(1, $solved); ?>
        <a href="hanoi_1.php" class="map-pin <?php echo $state1; ?>" style="bottom: 10%; left: 20%;" title="Tower of Hanoi">1</a>

        <?php $state2 = getPuzzleState(2, $solved); ?>
        <a href="puzzle_2.php" class="map-pin <?php echo $state2; ?>" style="bottom: 25%; left: 50%;" title="Logic Lab">2</a>

        <?php $state3 = getPuzzleState(3, $solved); ?>
        <a href="puzzle_3.php" class="map-pin <?php echo $state3; ?>" style="bottom: 40%; left: 80%;" title="4 Colour Map">3</a>

        <?php $state4 = getPuzzleState(4, $solved); ?>
        <a href="puzzle_4.php" class="map-pin <?php echo $state4; ?>" style="bottom: 55%; left: 60%;" title="Gridlock">4</a>

        <?php $state10 = getPuzzleState(10, $solved); ?>
        <a href="<?php echo $state10 === 'locked' ? '#' : 'puzzle_10.php'; ?>" 
           class="map-pin <?php echo $state10; ?>" 
           style="top: 5%; left: 50%; width: 65px; height: 65px; font-size: 1.5rem;"
           title="Wat Phnom Finale"
           onclick="<?php echo $state10 === 'locked' ? 'alert(\'You must complete Puzzles 1-9 to unlock Wat Phnom!\'); return false;' : ''; ?>">
           10
        </a>

    </div>

</body>
</html>