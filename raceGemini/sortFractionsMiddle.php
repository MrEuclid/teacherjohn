<?php 
 $question = isset($_POST['question']) ? $_POST['question'] : 'Sort Fractions';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sort Fractions Challenge</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"></script>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
  
  <script type="text/x-mathjax-config">
    MathJax.Hub.Config({
      extensions: ["tex2jax.js"],
      jax: ["input/TeX","output/HTML-CSS"],
      tex2jax: {inlineMath: [["$","$"],["\\(","\\)"]]}
    });
  </script>   
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.7/MathJax.js"></script>
  <script src="javascript/utilities.js"></script>

  <style>
    .game-container { text-align: center; margin-top: 20px; }
    
    #sortable { 
        list-style-type: none; 
        margin: 30px auto; 
        padding: 0; 
        display: flex;
        flex-wrap: nowrap; /* FORCES a single horizontal row */
        justify-content: center;
        align-items: center;
        width: 100%;
        overflow-x: auto; /* Allows smooth touch-scrolling if screen is extremely narrow */
        padding-bottom: 15px; 
    }
    
    /* The fraction tiles (Now responsive!) */
    .sortable-tile { 
        flex: 1 1 0; /* Allows tiles to shrink equally to fit the row */
        max-width: 100px; /* Prevents them from getting too big on large screens */
        aspect-ratio: 1 / 1; /* Keeps them perfectly square as they shrink */
        margin: 0 5px; 
        font-size: clamp(1.1em, 2.5vw, 1.6em); /* Scales the font size based on screen width */
        background-color: #0d6efd;
        color: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: grab;
        transition: transform 0.1s;
    }
    
    /* When a student clicks and drags a tile */
    .sortable-tile:active {
        cursor: grabbing;
        transform: scale(1.08);
        background-color: #0b5ed7;
        box-shadow: 0 8px 15px rgba(0,0,0,0.2);
    }

    /* The empty slot where the tile will drop */
    .ui-sortable-placeholder {
        border: 2px dashed #adb5bd;
        background-color: transparent;
        visibility: visible !important;
        border-radius: 12px;
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12 col-md-10 game-container">
        
        <h3 class="fw-bold text-primary">Sort the Fractions</h3>
        <p class="text-muted fs-5">Drag and drop the tiles to sort them from <strong>smallest to largest</strong>.</p>

        <div id="play-area">
            <ul id="sortable">
                </ul>
        </div>

        <div class="mt-4">
          <button id="check-btn" class="btn btn-success btn-lg px-5 fw-bold shadow-sm">Check</button>
          <button id="reset-btn" class="btn btn-warning btn-lg px-5 ms-2 text-dark fw-bold shadow-sm">New</button>
        </div>
        
        <div id="feedback" class="mt-4 fs-4 fw-bold"></div>

      </div>
    </div>
  </div>

  <script type="text/javascript">
    var questionID = '<?php echo $question; ?>';
    
    // Ensure MathJax renders the equations beautifully after we inject them
    function typesetMath() {
        if (typeof MathJax !== 'undefined') {
            MathJax.Hub.Queue(["Typeset", MathJax.Hub, "sortable"]);
        }
    }

    // Generate the game board
    function initGame() {
        // The list of prime numbers from your original code
        var primes = [7, 11, 13, 17, 19, 23, 29, 31];
        var allFractions = [];
        
        // Generate all valid proper fractions (numerator is strictly less than denominator)
        for (let i = 0; i < primes.length; i++) {
            for (let j = i + 1; j < primes.length; j++) {
                allFractions.push({
                    num: primes[i],
                    den: primes[j],
                    val: primes[i] / primes[j] // Storing actual decimal value for easy checking
                });
            }
        }

        // Shuffle the array and select exactly 6 random fractions
        allFractions.sort(() => 0.5 - Math.random());
        var selected = allFractions.slice(0, 6);

        // Empty the board and inject the chosen tiles
        $('#sortable').empty();
        selected.forEach((frac) => {
            // Notice we put 'data-val' inside the HTML. This hides the decimal value in the element!
            let li = `<li class="ui-state-default sortable-tile" data-val="${frac.val}">
                        \\( \\frac{${frac.num}}{${frac.den}} \\)
                      </li>`;
            $('#sortable').append(li);
        });

        // Initialize jQuery UI Sortable
        $( "#sortable" ).sortable({
            placeholder: "ui-sortable-placeholder sortable-tile",
            forcePlaceholderSize: true,
            tolerance: "pointer",
            containment: "parent" // Prevents dragging tiles off the screen
        });
        $( "#sortable" ).disableSelection();

        // Reset the UI components
        $('#feedback').text('');
        $('#check-btn').prop('disabled', false).show();
        $('#sortable').sortable('enable');
        
        // Render MathJax
        typesetMath();
    }

    $(document).ready(function() {
        
        // 1. Start the Game
        initGame();

        // 2. Handle 'Check' Button
        $('#check-btn').click(function() {
            let isSorted = true;
            let prevVal = -1;
            
            // Loop through the fraction tiles in the exact order they currently sit on the screen
            $('#sortable li').each(function() {
                let currentVal = parseFloat($(this).attr('data-val')); // Read the hidden decimal value
                
                // If the current tile is smaller than the previous tile, they are out of order!
                if (currentVal < prevVal) {
                    isSorted = false;
                    return false; // Break out of the loop early
                }
                prevVal = currentVal;
            });

            if (isSorted) {
                // Success! Lock the board
                $('#sortable').sortable('disable'); 
                $(this).hide(); 
                
                $('#feedback').html('<span class="text-success">⭐ Perfectly Sorted! ⭐</span>');
                
                // Trigger Dashboard logic
                if (typeof handleCorrectAnswer === "function") {
                    handleCorrectAnswer();
                } else if (typeof processWin === "function") {
                    processWin(questionID);
                } else {
                    setTimeout(() => alert("Great job! You sorted them correctly."), 500);
                }
            } else {
                // Failure
                $('#feedback').html('<span class="text-danger">Not quite. Try rearranging them!</span>');
                // Briefly flash the error message
                setTimeout(() => $('#feedback').text(''), 3000);
            }
        });

        // 3. Handle 'New' Button
        $('#reset-btn').click(function() {
            initGame();
        });

    });
  </script> 
</body>
</html>