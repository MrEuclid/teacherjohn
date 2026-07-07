<?php
// print_quiz.php

// Get the gameID from the URL (e.g., print_quiz.php?gameID=105)
$gameID = isset($_GET['gameID']) ? intval($_GET['gameID']) : 0;

// Include your existing MySQLi database connection file
include "../connectTeacherJohn.php"; 

$questions = [];

try {
    // FIXED: Replaced '105' with a '?' so bind_param has a place to inject the $gameID
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
            max-width: 800px; 
            margin: 20px auto; 
            line-height: 1.6; 
            padding: 20px;
        }
        .question-block { 
            margin-bottom: 30px; 
            page-break-inside: avoid; 
            border-bottom: 1px solid #ccc; 
            padding-bottom: 15px; 
        }
        .choices { 
            margin-left: 20px; 
            list-style-type: upper-alpha; 
        }
        .correct-answer { 
            font-weight: bold; 
            color: #2e7d32; 
            margin-top: 10px; 
            background: #e8f5e9; 
            padding: 8px; 
            display: inline-block;
            border-radius: 4px;
        }
        .error { color: red; font-weight: bold; }
        
        @media print {
            .no-print { display: none; }
            body { margin: 0; padding: 0; border: none; }
        }
    </style>
</head>
</head>
<body>

    <div class="no-print" style="text-align: right; margin-bottom: 20px;">
        <button onclick="window.print()" style="padding: 10px 20px; font-size: 16px; cursor: pointer;">🖨️ Save as PDF</button>
    </div>

    <h1>Quiz Answer Key (Game ID: <?php echo htmlspecialchars($gameID); ?>)</h1>

    <?php if (isset($errorMsg)): ?>
        <p class="error"><?php echo htmlspecialchars($errorMsg); ?></p>
        
    <?php elseif (count($questions) > 0): ?>
        <?php foreach ($questions as $index => $q): ?>
            <div class="question-block">
                <p><strong>Q<?php echo $index + 1; ?>.</strong> <?php echo $q['question']; ?></p>
                
                <ul class="choices">
                    <li><?php echo $q['optionA']; ?></li>
                    <li><?php echo $q['optionB']; ?></li>
                    <li><?php echo $q['optionC']; ?></li>
                    <li><?php echo $q['optionD']; ?></li>
                    <li><?php echo $q['optionE']; ?></li>
                </ul>
                
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