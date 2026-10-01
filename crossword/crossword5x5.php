<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Crossword 5x5 PHP_Refactored</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
 <style>
  label { font-size: 1em; font-weight: bolder; color: blue; cursor: pointer; }
  #home, #retry, #check { font-size: 1.2em; font-weight: bolder; }
  
  [id^=grid] {
    width: 50px; height: 50px; 
    background-color: lightblue; color: black;
    font-size: 1.2em; text-align: center; font-weight: bolder;
    margin-right: 1px; margin-bottom: 1px; text-transform: uppercase;
  }
  
  [id^=puzzle] {
    color: black; background-color: pink; 
    font-weight: bolder; font-size: 1.2em; 
    width: 40px; height: 40px; margin-top: 10px; padding-bottom: 5px;
  }
  
  #message { text-align: center; font-size: 3vw; color: green; }
  img, input { display: inline-block; }
  input { width: 50px; height: 50px; text-align: center; text-transform: uppercase; }
  
  /* Safely scope the inline-block rule so it only affects the imported grid file */
  .grid-wrapper div { display: inline-block; }
  
  .c { text-align: center; }
  .clue-list label { display: block; margin-bottom: 5px; padding: 2px; text-align: left; }
  .clue-active { background-color: lightblue; }
</style>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script type="text/x-mathjax-config">
    MathJax.Hub.Config({
      extensions: ["tex2jax.js"], jax: ["input/TeX","output/HTML-CSS"],
      tex2jax: {inlineMath: [["$","$"],["\\(","\\)"]]}
    });
  </script>   
  <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.7/MathJax.js"></script>
</head>

<body>
  <div class="container-fluid">
  
    
    <div class="row text-center mb-3">
      <div class="col-sm-12 c">
        <a href="../index.php"><button id="home" class="btn btn-info btn-sm">Home</button></a>
        <button id="retry" class="btn btn-success btn-sm">Clear</button>
        <button id="check" class="btn btn-warning btn-sm">Check</button>
      </div>
    </div>

    <!-- Puzzle Selectors -->
    <div class="row text-center mb-3">
      <div class="col-sm c" id="puzzle-selector">
        <!-- Rendered dynamically or keep hardcoded buttons -->
        <script>
          for (let i = 1; i <= 16; i++) {
            document.write(`<button id="puzzle-${i}">${i}</button>`);
          }
        </script>
      </div>
    </div>

    <div class="row text-center"><div class="col-sm c"><p id="messageGame"></p></div></div>
<!-- Menu grid with safe centering wrapper -->
    <div class="row justify-content-center text-center">
      <div class="col-auto grid-wrapper">
        <?php include "crosswordGrid5x5.html"; ?>
      </div>
    </div>

    <div class="row justify-content-center mt-3">
      <div class="col-auto c">
        <h2 id="message1">Find the Correct Words</h2>
      </div>
    </div>
    
    <!-- Centered Clue Headers -->
    <div class="row justify-content-center mt-4">
      <div class="col-12 col-sm-6 col-md-4 text-center">
        <b>Across</b>
      </div>
      <div class="col-12 col-sm-6 col-md-4 text-center">
        <b>Down</b>
      </div>
    </div>

    <!-- Centered Clues List -->
    <div class="row justify-content-center clue-list">
      <div class="col-12 col-sm-6 col-md-4" id="clues-across">
        <!-- Across clues inject here -->
      </div>
      <div class="col-12 col-sm-6 col-md-4" id="clues-down">
        <!-- Down clues inject here -->
      </div>
    </div>
  <script>
    // --- 1. DATA STRUCTURE ---
    // Extracting the hardcoded lines and clues into a clean dictionary.
    const puzzleData = {
      1: {
        lines: ["SIXTY", "U--O-", "NAME-", "N--SO", "YOU-N"],
        across: [
          { word: "SIXTY", clue: "The book has S _ _ _ _ pages." },
          { word: "NAME",  clue: "My mother's _ _ _ _ is Tida." },
          { word: "SO",    clue: "It is _ _ hot today!" },
          { word: "YOU",   clue: "What are _ _ _ doing?" }
        ],
        down: [
          { word: "SUNNY", clue: "Today it is hot and S _ _ _ _." },
          { word: "TOES",  clue: "My foot has five _ _ _ _ _." },
          { word: "ON",    clue: "I am sitting _ _ a chair." }
        ]
      },
      2: {
        lines: ["WRITE", "-I-I-", "-V-M-", "-EYES", "OR---"],
        across: [
          { word: "WRITE", clue: "I _ _ _ _ _ in my book." },
          { word: "EYES",  clue: "I see with my _ _ _ _." },
          { word: "OR",    clue: "Do I go left _ _ right?" }
        ],
        down: [
          { word: "RIVER", clue: "The fish live in the _ _ _ _ _." },
          { word: "TIME",  clue: "What's the _ _ _ _?" }
        ]
      }
      // Add puzzles 3-16 following this exact format...
    };

    // --- 2. STATE MANAGEMENT ---
    let currentPuzzleId = null;
    let gridCoordsAcross = [];
    let gridCoordsDown = [];
    let blankCells = [];
    let currentFocus = null;

    // --- 3. LOGIC & EVENTS ---
    $(document).ready(function() {
      // Input configuration
      $("input").attr("maxlength", 1);
      $('[id^=grid]').prop('disabled', true);

      // Select a puzzle
      $('[id^=puzzle-]').click(function() {
        const pId = parseInt(this.id.split("-")[1]);
        if (puzzleData[pId]) {
          alert("Puzzle number " + pId);
          loadPuzzle(pId);
        } else {
          alert("Puzzle " + pId + " data not yet added!");
        }
      });

      // Clear grid
      $("#retry").click(function() {
        if (currentPuzzleId) loadPuzzle(currentPuzzleId);
      });

      // Check answers
      $("#check").click(function() {
        if (!currentPuzzleId) return;
        const pData = puzzleData[currentPuzzleId];
        let hasLost = false;

        for (let r = 0; r < pData.lines.length; r++) {
          let rowGuess = "";
          for (let c = 0; c < 5; c++) {
            rowGuess += ($('#grid' + r + c).val() || "-").toUpperCase();
          }
          if (rowGuess !== pData.lines[r]) hasLost = true;
        }

        if (hasLost) {
          alert("Keep trying.");
        } else {
          alert("You win!");
          $('#puzzle-' + currentPuzzleId)
            .text('!')
            .prop('disabled', true)
            .css({"background-color":"yellow", "color":"black"});
        }
      });

      // Track input focus
      $(':input').on('focus click', function() {
        currentFocus = this.id;
      });

      // Handle custom on-screen keypad (if used in your HTML include)
      $("[id^=key-]").click(function() {
        if (!currentFocus) return;
        const val = this.id.replace("key-", "");
        $('#' + currentFocus).val(val);
      });

      // Handle clue clicking to highlight grid
      $(document).on('click', '.clue-label', function() {
        $('.clue-label').removeClass('clue-active');$(this).addClass('clue-active');

        // Reset grid colors
        $('[id^=grid]').css({"background-color":"lightblue"}).prop('disabled', true);
        blankCells.forEach(id => $('#' + id).css({"background-color":"black"}).prop('disabled', true));

        // Highlight selected
        const type = $(this).data('type');
        const index = $(this).data('index');
        const coords = type === 'across' ? gridCoordsAcross[index] : gridCoordsDown[index];

        coords.forEach(cellId => {
          $('#' + cellId).css({"background-color":"lightgreen"}).prop('disabled', false);
        });
        $('#' + coords[0]).focus();
      });
    });

    // --- 4. CORE FUNCTIONS ---
    function loadPuzzle(id) {
      currentPuzzleId = id;
      const data = puzzleData[id];
      
      // Reset DOM
      $('[id^=grid]').val("").prop('disabled', true).css({"background-color":"lightblue", "color":"black"});
      $('#clues-across, #clues-down').empty();
      
      blankCells = [];
      gridCoordsAcross = [];
      gridCoordsDown = [];

      // 1. Map Blanks
      for (let r = 0; r < data.lines.length; r++) {
        for (let c = 0; c < data.lines[r].length; c++) {
          if (data.lines[r][c] === '-') {
            const cellId = `grid${r}${c}`;
            blankCells.push(cellId);
            $(`#${cellId}`).prop('disabled', true).css({"background-color":"black", "color":"black"}).val("-");
          }
        }
      }

      // 2. Render Clues
      data.across.forEach((item, i) => {
        $('#clues-across').append(`<label class="clue-label" id="${i+1}A" data-type="across" data-index="${i}">${i+1}. ${item.clue}</label>`);
      });
      data.down.forEach((item, i) => {
        $('#clues-down').append(`<label class="clue-label" id="${i+1}D" data-type="down" data-index="${i}">${i+1}. ${item.clue}</label>`);
      });
      MathJax.Hub.Queue(["Typeset", MathJax.Hub]); // Re-render math if present

      // 3. Map Coordinates (Across)
      data.across.forEach((item, i) => {
        let coords = [];
        for (let r = 0; r < data.lines.length; r++) {
          let c = data.lines[r].indexOf(item.word);
          if (c > -1) {
            for (let k = 0; k < item.word.length; k++) coords.push(`grid${r}${c+k}`);
            break;
          }
        }
        gridCoordsAcross.push(coords);
      });

      // 4. Map Coordinates (Down)
      let wordColumns = [];
      for (let c = 0; c < 5; c++) {
        wordColumns[c] = data.lines.map(row => row[c]).join('');
      }
      data.down.forEach((item, i) => {
        let coords = [];
        for (let c = 0; c < 5; c++) {
          let r = wordColumns[c].indexOf(item.word);
          if (r > -1) {
            for (let k = 0; k < item.word.length; k++) coords.push(`grid${r+k}${c}`);
            break;
          }
        }
        gridCoordsDown.push(coords);
      });
    }
  </script>
</body>
</html>