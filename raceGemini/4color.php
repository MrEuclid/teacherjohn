<?php 
 $question = isset($_POST['question']) ? $_POST['question'] : '';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>4 Colour Game</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"></script>
  <script src="javascript/utilities.js"></script>

  <style>
    .game-container { text-align: center; margin-top: 20px; }
    canvas {
      border: 3px solid #212529;
      border-radius: 8px;
      margin: 10px auto;
      cursor: pointer;
      background-color: #f8f9fa;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .instructions { font-size: 1.1em; margin-bottom: 15px; }
    #feedback { height: 30px; margin-top: 10px; }
  </style>
</head>

<body>
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 game-container">
        
        <h2 class="fw-bold text-primary">The 4-Colour Map Challenge</h2>
        <p class="instructions text-muted">
          Click the regions below to cycle through 4 different colours.<br>
          <strong>Rule:</strong> No two touching regions can share the same colour!
        </p>

        <div>
          <canvas id="canvas" width="400" height="400"></canvas>
        </div>
        
        <div id="feedback">
          <span class="text-primary fw-bold">Fill all regions to win.</span>
        </div>
        
        <button id="resetBtn" class="btn btn-outline-danger mt-3 btn-sm">Reset Map</button>

      </div>
    </div>
  </div>

  <script type="text/javascript">
    var questionID = '<?php echo $question; ?>';
    
    // The 4 colours (plus the default uncoloured white state)
    const colors = ['white', '#FF5733', '#33FF57', '#3357FF', '#F1C40F']; 
    
    let regions = [];

    function initRegions() {
      // This map features a K4 graph core (Regions 0, 1, 2, and 3 all mutually touch each other).
      // This mathematically GUARANTEES that exactly 4 colours are required to solve it.
      regions = [
        // Inner Core (K4 Graph)
        { id: 0, path: new Path2D('M 200 140 L 140 220 L 260 220 Z'), color: 'white', neighbours: [1, 2, 3] },
        { id: 1, path: new Path2D('M 200 140 L 200 50 L 80 260 L 140 220 Z'), color: 'white', neighbours: [0, 2, 3, 4] },
        { id: 2, path: new Path2D('M 200 140 L 260 220 L 320 260 L 200 50 Z'), color: 'white', neighbours: [0, 1, 3, 5] },
        { id: 3, path: new Path2D('M 140 220 L 80 260 L 200 310 L 320 260 L 260 220 Z'), color: 'white', neighbours: [0, 1, 2, 6, 7] },
        
        // Outer Shell
        { id: 4, path: new Path2D('M 200 50 L 200 10 L 20 150 L 80 260 Z'), color: 'white', neighbours: [1, 5, 6] },
        { id: 5, path: new Path2D('M 200 50 L 320 260 L 380 150 L 200 10 Z'), color: 'white', neighbours: [2, 4, 7] },
        { id: 6, path: new Path2D('M 80 260 L 20 150 L 100 380 L 200 380 L 200 310 Z'), color: 'white', neighbours: [3, 4, 7] },
        { id: 7, path: new Path2D('M 200 310 L 200 380 L 300 380 L 380 150 L 320 260 Z'), color: 'white', neighbours: [3, 5, 6] }
      ];
    }

    const canvas = document.getElementById('canvas');
    const ctx = canvas.getContext('2d');

    function drawMap() {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      ctx.lineWidth = 4;
      ctx.strokeStyle = '#212529';
      ctx.lineJoin = 'round';

      regions.forEach(r => {
        ctx.fillStyle = r.color;
        ctx.fill(r.path);
        ctx.stroke(r.path);
      });
    }

    function checkWinCondition() {
      let filledCount = 0;
      let conflictCount = 0;

      for (let i = 0; i < regions.length; i++) {
        if (regions[i].color !== 'white') {
          filledCount++;
        }

        // Check against neighbours for rule violations
        for (let j = 0; j < regions[i].neighbours.length; j++) {
          let nIdx = regions[i].neighbours[j];
          if (regions[i].color !== 'white' && regions[i].color === regions[nIdx].color) {
            conflictCount++;
          }
        }
      }

      if (conflictCount > 0) {
        $('#feedback').html('<span class="text-danger fw-bold">Careful! Adjacent regions share a colour.</span>');
      } else if (filledCount < regions.length) {
        $('#feedback').html('<span class="text-primary fw-bold">Looking good! Keep going...</span>');
      } else {
        // Map is full and has 0 conflicts!
        $('#feedback').html('<span class="text-success fw-bold fs-4">⭐ Map Solved! ⭐</span>');
        
        // Disable further clicking
        canvas.style.pointerEvents = 'none'; 
        
        // Trigger dashboard logic
        if (typeof handleCorrectAnswer === "function") {
          handleCorrectAnswer();
        } else if (typeof processWin === "function") {
          processWin(questionID);
        } else {
          alert("Congratulations! You've successfully coloured the map!");
        }
      }
    }

    // Handle clicks to cycle colours
    canvas.addEventListener('mousedown', function(event) {
      const rect = canvas.getBoundingClientRect();
      const scaleX = canvas.width / rect.width;
      const scaleY = canvas.height / rect.height;
      
      const x = (event.clientX - rect.left) * scaleX;
      const y = (event.clientY - rect.top) * scaleY;

      for (let i = 0; i < regions.length; i++) {
        if (ctx.isPointInPath(regions[i].path, x, y)) {
          let currentColorIndex = colors.indexOf(regions[i].color);
          let nextColorIndex = (currentColorIndex + 1) % colors.length;
          
          regions[i].color = colors[nextColorIndex];
          drawMap();
          checkWinCondition();
          break; // Stop checking paths once we found the clicked one
        }
      }
    });

    // Reset Map logic
    $('#resetBtn').on('click', function() {
      initRegions();
      drawMap();
      canvas.style.pointerEvents = 'auto';
      $('#feedback').html('<span class="text-primary fw-bold">Fill all regions to win.</span>');
    });

    // Kickoff
    $(document).ready(function() {
      initRegions();
      drawMap();
    });

  </script>
</body>
</html>