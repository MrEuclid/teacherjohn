<?php
// print_quiz.php

// Get the gameID from the URL (e.g., print_quiz.php?gameID=105)
$gameID = isset($_GET['gameID']) ? intval($_GET['gameID']) : 0;

// Include your existing MySQLi database connection file
include "../connectTeacherJohn.php"; 

$questions = [];

try {
    $stmt = $dbServer->prepare("SELECT * FROM askAudienceQuestions WHERE gameID = ? ORDER BY questionID ASC");
    $stmt->bind_param("i", $gameID);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $questions = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

} catch (Exception $e) {
    $errorMsg = "Database query failed: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Answer Key - Game <?php echo $gameID; ?></title>
    
    <!-- 1. Configure MathJax to recognize single $ delimiters -->
    <script>
    window.MathJax = {
      tex: {
        inlineMath: [['$', '$'], ['\\(', '\\)']],
        displayMath: [['$$', '$$'], ['\\[', '\\]']]
      }
    };
    </script>
    
    <!-- 2. Load MathJax -->
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

    <style>
        body { 
            font-family: Arial, sans-serif; 
            max-width: 900px; /* Made slightly wider to fit more text on one line */
            margin: 20px auto; 
            line-height: 1.5; 
            padding: 20px;
        }
        .question-block { 
            margin-bottom: 15px; /* Reduced to save paper */
            page-break-inside: avoid; 
            border-bottom: 1px solid #ccc; 
            padding-bottom: 10px; /* Reduced to save paper */
        }
        .choices-inline { 
            margin: 10px 0; 
        }
        .choice-item {
            display: inline-block; /* Prevents a single choice from wrapping awkwardly */
            margin-right: 25px; /* Spacing between A, B, C, D, E */
            margin-bottom: 5px; /* Adds space if the screen is narrow and they stack to two lines */
        }
        .correct-answer { 
            font-weight: bold; 
            color: #2e7d32; 
            margin-top: 5px; 
            background: #e8f5e9; 
            padding: 5px 8px; 
            display: inline-block;
            border-radius: 4px;
            font-size: 14px; /* Slightly smaller to save space */
        }
        .error { color: red; font-weight: bold; }
        
        @media print {
            .no-print { display: none; }
            body { margin: 0; padding: 0; border: none; max-width: 100%; }
        }
    </style>
</head>
<body>

    <div class="no-print" style="text-align: right; margin-bottom: 20px;">
        <button onclick="window.print()" style="padding: 10px 20px; font-size: 16px; cursor: pointer;">🖨️ Save as PDF</button>
    </div>

    <h2>Quiz Answer Key (Game ID: <?php echo htmlspecialchars($gameID); ?>)</h2>

    <?php if (isset($errorMsg)): ?>
        <p class="error"><?php echo htmlspecialchars($errorMsg); ?></p>
        
    <?php elseif (count($questions) > 0): ?>
        <?php foreach ($questions as $index => $q): ?>
            <div class="question-block">
                <p style="margin: 0 0 5px 0;"><strong>Q<?php echo $index + 1; ?>.</strong> <?php echo $q['question']; ?></p>
                
                <!-- Changed from a vertical list to an inline div -->
                <div class="choices-inline">
                    <span class="choice-item"><strong>A)</strong> <?php echo $q['optionA']; ?></span>
                    <span class="choice-item"><strong>B)</strong> <?php echo $q['optionB']; ?></span>
                    <span class="choice-item"><strong>C)</strong> <?php echo $q['optionC']; ?></span>
                    <span class="choice-item"><strong>D)</strong> <?php echo $q['optionD']; ?></span>
                    <span class="choice-item"><strong>E)</strong> <?php echo $q['optionE']; ?></span>
                </div>
                
                <div class="correct-answer">
                    Correct Answer: <?php echo $q['answer']; ?>
                </div>
            </div>
        <?php endforeach; ?>
        
    <?php else: ?>
        <p>No questions found for this game ID.</p>
    <?php endif; ?>

</body>
</html>