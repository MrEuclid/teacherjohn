<?php 
session_save_path(sys_get_temp_dir());
session_start();

require_once '../connectTeacherJohn.php'; 
// Connect to the database

// Fetch all questions this team has already solved
$solved_questions = [];
$stmt = $dbServer->prepare("SELECT questionTitle FROM results WHERE teamName = ?");
$stmt->bind_param("s", $teamName);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $solved_questions[] = $row['questionTitle'];
}

// 1. SECURITY: Redirect to login if they haven't logged in
if (!isset($_SESSION['teamName'])) {
    header("Location: login.php");
    exit();
}

$teamName = $_SESSION['teamName'];
$classCode = $_SESSION['classCode']; // e.g., '10A'
$startTime = $_SESSION['startTime'];

// 2. EXTRACT GRADE: Strips all letters, turning '10A' -> '10', '7A' -> '7', or 'G8B' -> '8'
$grade = preg_replace('/[^0-9]/', '', $classCode);

// 3. CALCULATE TIMER: 45 minutes = 2700 seconds
$duration = 45 * 60;
$elapsed = time() - $startTime;
$timeRemaining = $duration - $elapsed;

// If time is up before they even load the page, lock it at 0
if ($timeRemaining < 0) {
    $timeRemaining = 0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Maths Competition - Dashboard</title>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script type="text/x-mathjax-config">
        MathJax.Hub.Config({
            extensions: ["tex2jax.js"],
            jax: ["input/TeX","output/HTML-CSS"],
            tex2jax: {inlineMath: [["$","$"],["\\(","\\)"]]}
        });
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.7/MathJax.js?config=TeX-MML-AM_CHTML"></script>
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
    <style>
        body { background-color: #f8f9fa; }
        #play {
            background: white; border: 2px solid #0d6efd;
            border-radius: 8px; min-height: 400px; padding: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .q-btn { margin: 5px; width: 100%; text-align: left; transition: all 0.2s; }
        .g10 { border-left: 5px solid #ffc107; }
        .g11 { border-left: 5px solid #0dcaf0; }
        .g12 { border-left: 5px solid #198754; }
        .stat-box {
            background: #212529; color: white; padding: 10px 20px;
            border-radius: 5px; margin-right: 10px; font-weight: bold;
        }
        .timer-box {
            background: #dc3545; color: white; padding: 10px 20px;
            border-radius: 5px; font-weight: bold; font-size: 1.2rem;
            min-width: 100px; text-align: center;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">Maths Comp - Class <?php echo $classCode; ?></span>
        <div class="d-flex align-items-center">
            <div class="stat-box">Team: <span id="teamName"><?php echo htmlspecialchars($teamName); ?></span></div>
            <div class="stat-box">Score: <span id="totalScore">0</span></div>
            <div class="timer-box" id="timerDisplay">--:--</div>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        
        <div class="col-md-7 mb-4">
            <h4 class="mb-3">Current Problem</h4>
            <div id="play" class="p-3">
                <div class="d-flex align-items-center justify-content-center" style="min-height: 350px;">
                    <div class="text-center">
                        <p class="text-muted fs-5">Welcome Team <?php echo htmlspecialchars($teamName); ?>!</p>
                        <p>Select a question from the menu to begin.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            
            <div class="card mb-3 border-dark">
                <div class="card-header bg-dark text-white py-2">Quick Calculator</div>
                <div class="card-body py-2">
                    <div class="input-group mb-2 mt-2">
                        <input type="text" id="calc-expr" class="form-control" placeholder="e.g. 4*12**2 - 1">
                        <button class="btn btn-secondary" id="btn-calc">Calculate</button>
                    </div>
                    <div id="calc-result" class="alert alert-light border text-center mb-2" style="min-height: 45px; font-size: 1.2rem; font-weight: bold; color: #0d6efd;">
                    </div>
                </div>
            </div>

            <?php include 'questions.html'; ?>
            
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Global tracking variables
    var activeQuestionId = "";
    var activeQuestionPoints = 0;

    // PHP to JS Variables
    var lockedGrade = "<?php echo $grade; ?>";
    var timeRemaining = <?php echo $timeRemaining; ?>;
    var competitionDuration = <?php echo $duration; ?>;
    console.log("Grade",lockedGrade);
    
    $(document).ready(function() {
        // 1. AUTO-FILTER QUESTIONS (Locks them into their grade)
        $('.q-btn').hide(); // Hide all
        
        // Grab the array of solved questions from PHP
        var solvedArray = <?php echo json_encode($solved_questions); ?>;
        
        // Loop through the array and lock the buttons immediately
        solvedArray.forEach(function(qId) {
            $('#' + qId)
                .prop('disabled', true)
                .addClass('btn-success text-white')
                .removeClass('btn-primary btn-light')
                .text('✅ Solved');
        });
        
        if(lockedGrade === "7") {
            $('.g7, .g7_g8').fadeIn();
        } else if(lockedGrade === "8") {
            $('.g8 ,.g7_g8 ,.g8_g9').fadeIn();
        } else if(lockedGrade === "9") {
            $('.g9, .g8_g9').fadeIn();
        } else if(lockedGrade === "10") {
            $('.g10, .g10_11').fadeIn();
        } else if(lockedGrade === "11") {
            $('.g11, .g10_11, .g11_12').fadeIn();
        } else if(lockedGrade === "12") {
            $('.g12, .g11_12').fadeIn();
        }

        // 2. THE COUNTDOWN TIMER
        function updateTimerDisplay() {
            var minutes = Math.floor(timeRemaining / 60);
            var seconds = timeRemaining % 60;
            if (seconds < 10) seconds = "0" + seconds;
            $('#timerDisplay').text(minutes + ":" + seconds);
            
            if (timeRemaining <= 0) {
                clearInterval(timerInterval);
                $('#timerDisplay').text("00:00");
                
                // THE KILL SWITCH
                $('.q-btn').prop('disabled', true); // Lock all buttons
                $('#play').html(`
                    <div class="text-center mt-5">
                        <h2 class="text-danger fw-bold">Time is Up!</h2>
                        <p class="text-muted">Your final score has been recorded.</p>
                        <p>Great effort, Team <?php echo htmlspecialchars($teamName); ?>.</p>
                    </div>
                `);
            }
        }
        
        var timerInterval = setInterval(function() {
            if (timeRemaining > 0) {
                timeRemaining--;
                updateTimerDisplay();
            }
        }, 1000);
        updateTimerDisplay(); // Call immediately on load

        // 3. LOAD QUESTION BUTTON CLICK
        $('.q-btn').click(function() {
            if (timeRemaining <= 0) return; // Failsafe: Prevent loading if time is up
            
            var fileToLoad = $(this).data('file');
            activeQuestionPoints = parseInt($(this).data('points'));
            activeQuestionId = $(this).attr('id');

            $('#play').load(fileToLoad, function(response, status, xhr) {
                if (status == "error") {
                    $('#play').html("<p class='text-danger'>Error loading question.</p>");
                }
            });

            $('.q-btn').removeClass('btn-primary').addClass('btn-light');
            $(this).removeClass('btn-light').addClass('btn-primary');
        });

        // 4. QUICK CALCULATOR LOGIC
        $('#btn-calc').click(function() {
            var expr = $('#calc-expr').val().trim();
            if (expr === "") { $('#calc-result').text(""); return; }
            try {
                if (/[^0-9()*+\-\/ .\^]+/.test(expr)) {
                    $('#calc-result').html('<span class="text-danger fs-6">Error: Invalid characters</span>');
                    return;
                }
                var safeExpr = expr.replace(/\^/g, '**');
                var result = new Function('return ' + safeExpr)();
                if (!isFinite(result)) {
                    $('#calc-result').html('<span class="text-danger fs-6">Math Error: Undefined</span>');
                } else {
                    $('#calc-result').text(Math.round(result * 10000) / 10000);
                }
            } catch (e) {
                $('#calc-result').html('<span class="text-danger fs-6">Syntax Error</span>');
            }
        });

        $('#calc-expr').keypress(function(e) {
            if(e.which == 13) { $('#btn-calc').click(); }
        });
    });

    // 5. TRIGGERED WHEN QUESTION IS SOLVED
    function handleCorrectAnswer() {
        if (timeRemaining <= 0) return; // Failsafe: No points awarded after time is up

        // Disable button
        $('#' + activeQuestionId)
            .prop('disabled', true)
            .addClass('btn-success')
            .removeClass('btn-primary btn-light')
            .text('✅ Solved');

        // Update UI Score
        var currentScore = parseInt($('#totalScore').text());
        var newScore = currentScore + activeQuestionPoints;
        $('#totalScore').text(newScore);

        // Calculate EXACT elapsed time (in seconds)
        var elapsedSeconds = competitionDuration - timeRemaining;

        // Send to Database
        var teamName = "<?php echo addslashes($teamName); ?>";
        updateDatabase(teamName, activeQuestionPoints, elapsedSeconds, activeQuestionId);
        
        // Clear Play Area
        $('#play').html(`
            <div class="text-center mt-5">
                <h3 class="text-success fw-bold">⭐ Correct! ⭐</h3>
                <p>Select another question from the menu.</p>
            </div>
        `);
    }

    // 6. DATABASE AJAX CALL
    function updateDatabase(team, pointsScored, elapsedTime, questionID) {
        $.ajax({
            type: 'POST',
            url: 'update_score.php',
            data: { 
                teamName: team, 
                points: pointsScored, 
                elapsedTime: elapsedTime,
                questionTitle: questionID 
            },
            success: function(response) {
                console.log("Score logged: ", response);
            }
        });
    }
</script>

</body>
</html>