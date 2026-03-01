<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Word Game - Select Grade</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    
    <style>
        body { background-color: #f4f6f9; padding-top: 40px; }
        .grade-btn { margin: 5px; min-width: 120px; font-weight: bold; font-size: 1.1rem; }
        .word-preview { font-family: monospace; font-size: 1.2rem; color: #198754; max-height: 200px; overflow-y: auto; }
        .play-btn { font-size: 1.5rem; font-weight: bold; border-radius: 50px; padding: 10px 40px; }
    </style>
</head>
<body>

<div class="container text-center">
    <div class="row mb-4 align-items-center">
        <div class="col-2 text-start">
            <a href="../index.php" class="btn btn-outline-dark">&larr; Back</a>
        </div>
        <div class="col-8">
            <h1 class="text-primary fw-bold text-uppercase tracking-wide">The Word Game</h1>
        </div>
        <div class="col-2 text-end">
            <a href="words4.php" class="btn btn-outline-info">&#x21bb; Reload</a>
        </div>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body py-4">
            <h4 class="mb-3 text-secondary">Select Your Grade Level</h4>
            <div class="d-flex flex-wrap justify-content-center">
                <button class="btn btn-success grade-btn" data-level="1">Grade 1</button>
                <button class="btn btn-danger grade-btn" data-level="2">Grade 2</button>
                <button class="btn btn-info grade-btn text-white" data-level="3">Grade 3</button>
                <button class="btn btn-warning grade-btn text-dark" data-level="4">Grade 4</button>
                <button class="btn btn-danger grade-btn" data-level="5">Grade 5</button>
                <button class="btn btn-primary grade-btn" data-level="6">Grade 6</button>
                <button class="btn btn-success grade-btn" data-level="7">Grade 7</button>
            </div>
        </div>
    </div>

    <div id="playArea" style="display: none;">
        <form method="POST" action="words4.php" class="mb-4">
            <input type="hidden" id="theWords" name="theWords" value="">
            <button type="submit" class="btn btn-success play-btn shadow">▶ PLAY NOW</button>
        </form>
        
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="text-muted">Words Loaded:</h5>
                <div id="wordPreview" class="word-preview mt-3"></div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $('.grade-btn').on("click", function() {
        // Visual feedback for selected button
        $('.grade-btn').removeClass('active border border-3 border-dark');
        $(this).addClass('active border border-3 border-dark');

        let gradeText = $(this).text();
        let level = gradeText.charAt(gradeText.length - 1); 
        level = parseInt(level) - 1; // Base on previous year as requested in original code

        // Fetch words
        $.ajax({
            url: 'loadWords.php',
            type: 'POST',
            data: {level: level},
            dataType: 'json',
            success: function(data) {
                if(data.length > 0) {
                    $('#theWords').val(JSON.stringify(data));  
                    $('#wordPreview').html(data.join(', '));
                    $('#playArea').fadeIn();
                } else {
                    $('#wordPreview').html("<span class='text-danger'>No words found for this level.</span>");
                    $('#playArea').fadeIn();
                }
            },
            error: function() {
                alert("Error loading words.");
            }
        });
    });
});
</script>
</body>
</html>