<?php 
 $question = isset($_POST['question']) ? $_POST['question'] : 'Countdown Challenge';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Make the Number</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"></script>
  <script src="javascript/utilities.js"></script>

  <style>
    .game-container { text-align: center; margin-top: 20px; }
    
    #target-box {
        background-color: #fd7e14;
        color: white;
        font-size: 3em;
        font-weight: bold;
        padding: 15px 40px;
        border-radius: 12px;
        display: inline-block;
        margin-bottom: 20px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .num-btn {
        width: 80px;
        height: 80px;
        font-size: 2em;
        font-weight: bold;
        margin: 10px;
        border-radius: 12px;
        background-color: #0d6efd;
        color: white;
        border: none;
        box-shadow: 0 4px 6px rgba(0,0,0,0.15);
        transition: transform 0.1s;
    }
    .num-btn:active { transform: scale(0.95); }
    .num-btn:disabled { background-color: #6c757d; opacity: 0.3; cursor: not-allowed; }

    .op-btn {
        width: 60px;
        height: 60px;
        font-size: 2em;
        font-weight: bold;
        margin: 5px;
        border-radius: 50%;
        background-color: #198754;
        color: white;
        border: none;
        box-shadow: 0 4px 6px rgba(0,0,0,0.15);
    }
    .op-btn:active { transform: scale(0.95); }

    .calc-slot {
        width: 80px;
        height: 80px;
        font-size: 2em;
        font-weight: bold;
        text-align: center;
        border: 3px dashed #adb5bd;
        border-radius: 12px;
        background-color: #f8f9fa;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin: 0 10px;
        vertical-align: middle;
    }
    .calc-op {
        font-size: 2em;
        font-weight: bold;
        color: #212529;
        margin: 0 5px;
        vertical-align: middle;
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 game-container">
        
        <h3 class="fw-bold text-primary mb-3">Make the Number</h3>
        
        <div id="target-box">0</div>

        <div class="mb-4 d-flex justify-content-center align-items-center" style="min-height: 100px;">
            <div id="slot1" class="calc-slot"></div>
            <div id="slotOp" class="calc-op">?</div>
            <div id="slot2" class="calc-slot"></div>
            <div class="calc-op">=</div>
            <div id="slotRes" class="calc-slot" style="border-style: solid; border-color: #0d6efd;"></div>
        </div>

        <div class="mb-4">
            <button class="op-btn" data-op="+">+</button>
            <button class="op-btn" data-op="-">-</button>
            <button class="op-btn" data-op="*">×</button>
            <button class="op-btn" data-op="/">÷</button>
        </div>

        <div id="numbers-area" class="mb-4">
            </div>

        <div>
            <button id="reset-btn" class="btn btn-warning btn-lg fw-bold px-4">Clear</button>
            <button id="new-btn" class="btn btn-danger btn-lg fw-bold px-4 ms-2">New Puzzle</button>
        </div>
        
        <div id="feedback" class="mt-4 fs-4 fw-bold"></div>

      </div>
    </div>
  </div>

  <script type="text/javascript">
    var questionID = '<?php echo $question; ?>';
    
    var originalNumbers = [];
    var currentNumbers = [];
    var target = 0;

    var selectedNum1 = null;
    var selectedOp = null;
    var selectedNum2 = null;

    // --- PUZZLE GENERATOR ---
    // Generates a random, mathematically solvable countdown puzzle
    function generatePuzzle() {
        let nums = [];
      for (let i = 0; i < 4; i++) {
            // Pick numbers heavily weighted towards 1-10, adding 75 and 100 for higher difficulty
            let r = Math.random();
            if (r < 0.70) nums.push(Math.floor(Math.random() * 10) + 1); // 70% chance of 1-10
            else if (r < 0.80) nums.push(25); // 10% chance
            else if (r < 0.90) nums.push(50); // 10% chance
            else if (r < 0.95) nums.push(75); // 5% chance
            else nums.push(100);              // 5% chance
        }
        
        let sim = [...nums];
        
        // Simulate a game to ensure a valid target is reachable
        while (sim.length > 1) {
            let i1 = Math.floor(Math.random() * sim.length);
            let n1 = sim.splice(i1, 1)[0];
            
            let i2 = Math.floor(Math.random() * sim.length);
            let n2 = sim.splice(i2, 1)[0];
            
            let validOps = ['+', '*'];
            if (n1 - n2 > 0) validOps.push('-');
            if (n2 - n1 > 0) { let t = n1; n1 = n2; n2 = t; validOps.push('-'); }
            if (n1 % n2 === 0 && n2 !== 1) validOps.push('/');
            if (n2 % n1 === 0 && n1 !== 1) { let t = n1; n1 = n2; n2 = t; validOps.push('/'); }
            
            let op = validOps[Math.floor(Math.random() * validOps.length)];
            let res = 0;
            if (op === '+') res = n1 + n2;
            if (op === '-') res = n1 - n2;
            if (op === '*') res = n1 * n2;
            if (op === '/') res = n1 / n2;
            
            sim.push(res);
        }
        
        let finalTarget = sim[0];
        
        // Ensure the target isn't too trivial (like 2)
        if (finalTarget < 10) {
            return generatePuzzle();
        }
        
        return { target: finalTarget, numbers: nums };
    }

    // --- UI UPDATERS ---
    function renderNumbers() {
        $('#numbers-area').empty();
        currentNumbers.forEach((num, index) => {
            if (num !== null) {
                $('#numbers-area').append(`<button class="num-btn" data-idx="${index}">${num}</button>`);
            }
        });
    }

    function resetCalculation() {
        selectedNum1 = null;
        selectedOp = null;
        selectedNum2 = null;
        $('#slot1').text('');
        $('#slotOp').text('?');
        $('#slot2').text('');
        $('#slotRes').text('');
    }

    function initGame() {
        let puzzle = generatePuzzle();
        target = puzzle.target;
        originalNumbers = [...puzzle.numbers];
        currentNumbers = [...puzzle.numbers];
        
        $('#target-box').text(target);
        $('#feedback').text('');
        resetCalculation();
        renderNumbers();
        
        // Re-enable everything
        $('.op-btn').prop('disabled', false);
        $('#numbers-area').css('pointer-events', 'auto');
    }

    // --- EVENT LISTENERS ---
    $(document).ready(function() {
        initGame();

        // Handle Number Clicks
        $('#numbers-area').on('click', '.num-btn', function() {
            let idx = $(this).data('idx');
            let val = currentNumbers[idx];

            if (selectedNum1 === null) {
                selectedNum1 = { idx: idx, val: val };
                $('#slot1').text(val);
                $(this).prop('disabled', true);
            } 
            else if (selectedOp !== null && selectedNum2 === null) {
                selectedNum2 = { idx: idx, val: val };
                $('#slot2').text(val);
                $(this).prop('disabled', true);

                // Auto Calculate
                let res = 0;
                let valid = true;
                
                if (selectedOp === '+') res = selectedNum1.val + selectedNum2.val;
                if (selectedOp === '-') res = selectedNum1.val - selectedNum2.val;
                if (selectedOp === '*') res = selectedNum1.val * selectedNum2.val;
                if (selectedOp === '/') {
                    if (selectedNum1.val % selectedNum2.val === 0) {
                        res = selectedNum1.val / selectedNum2.val;
                    } else {
                        valid = false;
                        $('#feedback').html('<span class="text-danger">Division must be a whole number!</span>');
                    }
                }

                if (valid) {
                    $('#slotRes').text(res);
                    
                    // Remove the two used numbers and add the result
                    currentNumbers[selectedNum1.idx] = null;
                    currentNumbers[selectedNum2.idx] = null;
                    currentNumbers.push(res);
                    
                    // Brief pause to let the user see the math, then rerender
                    setTimeout(function() {
                        renderNumbers();
                        resetCalculation();
                        $('#feedback').text('');
                        
                        // Check for WIN condition
                        if (res === target) {
                            $('#feedback').html('<span class="text-success fs-3">⭐ well done, solved ⭐</span>');
                            $('.op-btn').prop('disabled', true);
                            $('#numbers-area').css('pointer-events', 'none');
                            
                            if (typeof handleCorrectAnswer === "function") {
                                handleCorrectAnswer();
                            } else if (typeof processWin === "function") {
                                processWin(questionID);
                            } else {
                                setTimeout(() => alert("well done, solved"), 500);
                            }
                        }
                    }, 800);
                } else {
                    // Invalid math (fractional division), reset the slots
                    setTimeout(function() {
                        currentNumbers[selectedNum1.idx] = selectedNum1.val; // restore
                        currentNumbers[selectedNum2.idx] = selectedNum2.val; // restore
                        renderNumbers();
                        resetCalculation();
                        $('#feedback').text('');
                    }, 1000);
                }
            }
        });

        // Handle Operation Clicks
        $('.op-btn').click(function() {
            if (selectedNum1 !== null && selectedNum2 === null) {
                selectedOp = $(this).data('op');
                let displayOp = selectedOp === '*' ? '×' : (selectedOp === '/' ? '÷' : selectedOp);
                $('#slotOp').text(displayOp);
            }
        });

        // Reset the current puzzle
        $('#reset-btn').click(function() {
            currentNumbers = [...originalNumbers];
            resetCalculation();
            renderNumbers();
            $('#feedback').text('');
            $('.op-btn').prop('disabled', false);
            $('#numbers-area').css('pointer-events', 'auto');
        });

        // Generate a new puzzle
        $('#new-btn').click(function() {
            initGame();
        });
    });
  </script> 
</body>
</html>