<?php
session_save_path(__DIR__ . '/sessions');
session_start();

// Boot them back to start if they haven't registered
if (!isset($_SESSION['team_name'])) {
    header("Location: index.php");
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
// Node 1 is always unlocked. Others require the previous one to be solved.
// Helper function to check if a node should be clickable
function getPuzzleState($num, $solvedArray) {
    // If they already solved it, mark it completed
    if ($solvedArray[$num] == 1) {
        return 'completed';
    }

    // Special logic for the final puzzle (Node 10)
    if ($num == 10) {
        $solvedCount = 0;
        // Count how many of puzzles 1-9 are solved
        for ($i = 1; $i <= 9; $i++) {
            if ($solvedArray[$i] == 1) {
                $solvedCount++;
            }
        }
        // Unlock only if all 9 are done
        return ($solvedCount == 9) ? 'unlocked' : 'locked';
    }

    // For puzzles 1 through 9, if it's not completed, it's always unlocked!
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
            max-width: 800px; /* Match your image width */
            margin: 0 auto;
            /* Replace with an actual drawing or image of the Wat Phnom path */
            background-image: url('images/watPhnomMap.jpg'); 
            background-size: cover;
            aspect-ratio: 4/5; 
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
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
            transform: translate(-50%, -50%); /* Centers the pin exactly on the coordinates */
            transition: all 0.2s;
            text-decoration: none;
        }

        /* The three states */
        .locked {
            background-color: #94a3b8; /* Gray */
            color: white;
            cursor: not-allowed;
            opacity: 0.8;
        }
        
        .unlocked {
            background-color: #3b82f6; /* Blue */
            color: white;
            border: 4px solid #bfdbfe;
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.6);
            animation: pulse 2s infinite;
        }

        .completed {
            background-color: #10b981; /* Green */
            color: white;
            border: 2px solid white;
        }

        @keyframes pulse {
            0% { transform: translate(-50%, -50%) scale(1); }
            50% { transform: translate(-50%, -50%) scale(1.1); }
            100% { transform: translate(-50%, -50%) scale(1); }
        }
    </style>
</head>
<body class="bg-slate-100 p-6">

    <div class="max-w-4xl mx-auto mb-8 text-center">
        <h1 class="text-4xl font-black text-indigo-900">Team: <?php echo $team; ?></h1>
        <p class="text-lg text-slate-600 font-bold mt-2">Follow the path to the top. Next puzzle unlocked!</p>
    </div>

    <div class="map-container">
     
        
        <?php $state1 = getPuzzleState(1, $solved); ?>
        <a href="hanoi_1.php" class="map-pin <?php echo $state1; ?>" style="bottom: 10%; left: 20%;" title="Tower of Hanoi">1</a>

        <?php $state2 = getPuzzleState(2, $solved); ?>
        <a href="puzzle_2.php" class="map-pin <?php echo $state2; ?>" style="bottom: 25%; left: 50%;" title="Logic Lab">2</a>

        <?php $state3 = getPuzzleState(3, $solved); ?>
        <a href="puzzle_3.php" class="map-pin <?php echo $state3; ?>" style="bottom: 40%; left: 80%;" title="4 Colour Map">3</a>

        <?php $state10 = getPuzzleState(10, $solved); ?>
        <a href="<?php echo $state10 === 'locked' ? '#' : 'puzzle_10.php'; ?>" 
           class="map-pin <?php echo $state10; ?>" 
           style="top: 5%; left: 50%;"
           title="Wat Phnom Finale"
           onclick="<?php echo $state10 === 'locked' ? 'alert(\'You must complete Puzzles 1-9 to unlock Wat Phnom!\'); return false;' : ''; ?>">
           10
        </a>

    

        </div>

</body>
</html>