<?php 
 $question = isset($_POST['question']) ? $_POST['question'] : 'Mastermind hard';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mastermind Hard</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"></script>
  <script src="javascript/utilities.js"></script>

  <style>
    .game-container { text-align: center; margin-top: 10px; }
    h3 { color: #dc3545; font-weight: bolder; }
    h5 { color: #6c757d; margin-bottom: 20px; }

    /* Grid and Status indicators */
    [id^=grid] {
      width: 2.5em; 
      height: 2.5em; 
      background-color: white;
      color: black;
      font-weight: bolder;
      font-size: 1.2em;
      text-align: center;
      margin: 4px;
      border: 2px solid #ccc;
      border-radius: 4px;
    }

    /* Score Boxes for Hard Mode */
    .score-box {
      width: 2.5em; 
      height: 2.5em; 
      font-weight: bolder;
      font-size: 1.2em;
      text-align: center;
      margin: 4px;
      border: 2px solid #ccc;
      border-radius: 4px;
      background-color: #f8f9fa;
    }
    .bull-box { color: #198754; } /* Green text for Bulls */
    .cow-box { color: #fd7e14; }  /* Orange text for Cows */

    /* Numpad */
    [id^=key] {
      background-color: #e9ecef; 
      color: #000; 
      font-size: 1.2em; 
      font-weight: bolder;
      border: 2px solid #adb5bd;
      border-radius: 50%;
      height: 2.5em;
      width: 2.5em;
      margin: 5px;
      transition: all 0.1s;
    }
    [id^=key]:hover:not(:disabled) {
      background-color: #ced4da;
    }
    
    /* Action Buttons */
    .action-btn { font-weight: bold; width: 80px; margin: 5px; }

    /* Legend */
    .legend-box {
      font-size: 0.9em; font-weight: bold; color: white;
      padding: 5px 10px; border-radius: 5px; margin: 0 5px;
      display: inline-block;
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 game-container">
        
        <h3>Mastermind: HARD</h3>
        <h5>Find the 4-digit code. Digits are 1-9. No duplicates.</h5>

        <div class="mb-3">
          <button id="send" class="btn btn-success action-btn" disabled>Check</button>
          <button id="clear" class="btn btn-warning action-btn text-dark">Clear</button> 
          <button id="retry" class="btn btn-danger action-btn">New</button>
        </div>

        <div id="victory" class="fs-4 fw-bold text-success mb-2"></div>

        <div id="playingArea" class="mb-4">
          
          <div class="d-flex justify-content-center align-items-center mb-1">
             <div style="width: 170px;"></div> <div class="ms-3 d-flex" style="width: 90px; justify-content: space-around;">
                 <span class="text-success fw-bold">Bulls</span>
                 <span class="text-warning fw-bold text-dark">Cows</span>
             </div>
          </div>

          <div class="d-flex justify-content-center align-items-center">
            <div>
                <input id="grid11" readonly><input id="grid12" readonly><input id="grid13" readonly><input id="grid14" readonly>
            </div>
            <div class="ms-3">
                <input id="bulls1" class="score-box bull-box" readonly placeholder="-"><input id="cows1" class="score-box cow-box" readonly placeholder="-">
            </div>
          </div>
          <div class="d-flex justify-content-center align-items-center">
            <div>
                <input id="grid21" readonly><input id="grid22" readonly><input id="grid23" readonly><input id="grid24" readonly>
            </div>
            <div class="ms-3">
                <input id="bulls2" class="score-box bull-box" readonly placeholder="-"><input id="cows2" class="score-box cow-box" readonly placeholder="-">
            </div>
          </div>
          <div class="d-flex justify-content-center align-items-center">
            <div>
                <input id="grid31" readonly><input id="grid32" readonly><input id="grid33" readonly><input id="grid34" readonly>
            </div>
            <div class="ms-3">
                <input id="bulls3" class="score-box bull-box" readonly placeholder="-"><input id="cows3" class="score-box cow-box" readonly placeholder="-">
            </div>
          </div>
          <div class="d-flex justify-content-center align-items-center">
            <div>
                <input id="grid41" readonly><input id="grid42" readonly><input id="grid43" readonly><input id="grid44" readonly>
            </div>
            <div class="ms-3">
                <input id="bulls4" class="score-box bull-box" readonly placeholder="-"><input id="cows4" class="score-box cow-box" readonly placeholder="-">
            </div>
          </div>
          <div class="d-flex justify-content-center align-items-center">
            <div>
                <input id="grid51" readonly><input id="grid52" readonly><input id="grid53" readonly><input id="grid54" readonly>
            </div>
            <div class="ms-3">
                <input id="bulls5" class="score-box bull-box" readonly placeholder="-"><input id="cows5" class="score-box cow-box" readonly placeholder="-">
            </div>
          </div>
        </div>

        <div id="numPad" class="mb-4">
          <div>
            <button id="key7">7</button><button id="key8">8</button><button id="key9">9</button> 
          </div>
          <div>
            <button id="key4">4</button><button id="key5">5</button><button id="key6">6</button> 
          </div>
          <div>
            <button id="key1">1</button><button id="key2">2</button><button id="key3">3</button> 
          </div>
        </div>

        <div class="d-flex justify-content-center flex-wrap mt-3">
          <div class="legend-box bg-success">Bull = Right Num & Pos</div>
          <div class="legend-box bg-warning text-dark">Cow = Right Num, Wrong Pos</div>
        </div>

      </div>
    </div>
  </div>

  <script type="text/javascript">
    // Game Variables
    var questionID = '<?php echo $question; ?>';
    var secret = [];
    var turnNumber = 1;
    var target = "";
    var maxTurns = 5;

    // --- GAME ENGINE FUNCTIONS ---

    // Generate a 4-digit code with unique numbers from 1-9
    function makeNumber() {
      let numbers = [];
      while (numbers.length < 4) {
        let digit = Math.floor(Math.random() * 9) + 1;
        if (numbers.indexOf(digit) === -1) {
          numbers.push(digit);
        }
      }
      return numbers;
    }

    // Check if the current row has 4 distinct numbers filled in
    function checkNumbers(row) {
      let good = true;
      let temp = [];
      for (let i = 1; i <= 4; i++) {
        let digit = $('#grid' + row + i).val();
        if (digit === "") { good = false; break; }
        if (temp.indexOf(digit) !== -1) { good = false; break; }
        temp.push(digit);
      }
      return good;
    }

    // Initialize or Reset the Board
    function initGame() {
      secret = makeNumber();
      console.log("Secret Code: ", secret); // For debugging
      turnNumber = 1;
      target = "grid11";

      // Reset Grid
      $('[id^=grid]').val('')
                     .css({"background-color":"#fff","color":"#000"})
                     .prop('disabled', true);
                     
      // Reset Score Boxes
      $('[id^=bulls], [id^=cows]').val('');

      // Enable first row
      $('#grid11, #grid12, #grid13, #grid14').css({"background-color":"#e9ecef"});
      $('#grid11').css({"background-color":"#0d6efd", "color":"#fff"}); // Highlight first box

      // Reset UI elements
      $('#send').prop('disabled', true);
      $('[id^=key]').prop('disabled', false);
      $('#victory').text('');
      $('#playingArea').css("pointer-events", "auto");
    }

    // --- EVENT LISTENERS ---

    $(document).ready(function() {
      
      // Start Game
      initGame();

      // Numpad Clicks
      $('[id^=key]').click(function() {
        let clicked = this.id;
        let digit = parseInt(clicked.substring(3, 4));

        // Write digit to target and visually lock it
        $('#' + target).val(digit).css({"background-color":"#fff", "color":"#000"});

        // Find next column
        let row = parseInt(target.substr(4, 1));
        let column = parseInt(target.substr(5, 1));
        let nextColumn = column + 1;

        if (nextColumn <= 4) {
          target = 'grid' + row + nextColumn;
          $('#' + target).css({"background-color":"#0d6efd", "color":"#fff"}); // Highlight next box
        } else {
          // Row is full, validate it
          if (checkNumbers(row)) {
            $('#send').prop('disabled', false).removeClass('btn-secondary').addClass('btn-success');
          }
        }
      });

      // Clear Button Clicks
      $('#clear').click(function() {
        let row = turnNumber;
        for (let i = 1; i <= 4; i++) {
          $('#grid' + row + i).val('').css({"background-color":"#e9ecef", "color":"#000"});
        }
        $('[id^=key]').prop('disabled', false); // re-enable all keys
        target = 'grid' + row + 1;
        $('#' + target).css({"background-color":"#0d6efd", "color":"#fff"});
        $('#send').prop('disabled', true);
      });

      // New Game (Retry) Clicks
      $('#retry').click(function() {
        initGame();
      });

      // Allow users to click a specific grid box in the current row to edit it
      $('[id^=grid]').click(function() {
        let id = this.id;
        let row = parseInt(id.substr(4, 1));
        
        // Only allow clicking in the active turn row
        if (row === turnNumber) {
          // Reset the old target's color
          $('#' + target).css({"background-color":"#e9ecef", "color":"#000"});
          
          target = id;
          $('#' + id).val('').css({"background-color":"#0d6efd", "color":"#fff"});
          $('#send').prop('disabled', true); // Must re-verify when they edit
        }
      });

      // Check Button Clicks
      $('#send').click(function() {
        let row = turnNumber;
        let temp = [];

        // Gather user input
        for (let i = 0; i < 4; i++) {
          temp.push(parseInt($('#grid' + row + (i + 1)).val()));
        }

        let bulls = 0;
        let cows = 0;

        // Grade the submission (Hard Mode logic)
        for (let i = 0; i < 4; i++) {
          let t = secret.indexOf(temp[i]);

          if (secret[i] === temp[i]) {
            bulls++; 
          } else if (t !== -1) {
            cows++;
          }
        }

        // Display Bulls and Cows for this row
        $('#bulls' + row).val(bulls);
        $('#cows' + row).val(cows);

        // Win Condition
        if (bulls === 4) {
          $('#victory').html('⭐ Code Cracked! ⭐');
          $('#playingArea').css("pointer-events", "none"); // Lock board
          $('#send').prop('disabled', true);
          
          // Trigger the dashboard win logic
          if (typeof handleCorrectAnswer === "function") {
            handleCorrectAnswer();
          } else if (typeof processWin === "function") {
            processWin(questionID);
          } else {
            alert("Congratulations! You cracked the code!");
          }
          return;
        }

        // Advance to next turn
        turnNumber++;

        // Lose Condition
        if (turnNumber > maxTurns) {
          $('#victory').html('<span class="text-danger">Out of turns! The code was ' + secret.join('') + '</span>');
          $('#playingArea').css("pointer-events", "none");
          $('#send').prop('disabled', true);
        } else {
          // Prep next row
          $('#grid' + turnNumber + '1, #grid' + turnNumber + '2, #grid' + turnNumber + '3, #grid' + turnNumber + '4').css({"background-color":"#e9ecef"}).prop('disabled', false);
          target = 'grid' + turnNumber + '1';
          $('#' + target).css({"background-color":"#0d6efd", "color":"#fff"});
          
          $('#send').prop('disabled', true);
          $('[id^=key]').prop('disabled', false); // Re-enable keypad for the new row
        }
      });

    });
  </script>
</body>
</html>