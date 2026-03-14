<?php 
 $question = isset($_POST['question']) ? $_POST['question'] : 'Puzzle 1';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Race to Wat Phnom - Puzzle 1</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"></script>

  <script type="text/x-mathjax-config">
    MathJax.Hub.Config({
      extensions: ["tex2jax.js"],
      jax: ["input/TeX","output/HTML-CSS"],
      tex2jax: {inlineMath: [["$","$"],["\\(","\\)"]]}
    });
  </script>   
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.7/MathJax.js"></script>
  
  <script src="javascript/utilities.js"></script>
  <script src="wat.js"></script>  

  <style>
    .game-container { text-align: center; margin-top: 20px; padding-bottom: 30px; }
    
    /* Beautiful rounded image styling */
    .landmark-img { 
        max-width: 100%; 
        height: auto; 
        max-height: 250px; 
        object-fit: cover; 
        border-radius: 16px; 
        box-shadow: 0 6px 12px rgba(0,0,0,0.15); 
        margin-bottom: 25px;
        border: 3px solid #dee2e6;
    }

    /* Target number styling */
    .target-box {
        font-size: 3em;
        font-weight: bold;
        color: #0d6efd;
        margin: 15px 0;
    }

    /* Input styling */
    .prime-input { 
        width: 100px; 
        height: 60px;
        text-align: center; 
        font-size: 1.8em; 
        font-weight: bold; 
        background-color: lightgreen; 
        border: 2px solid #198754;
        border-radius: 10px;
        margin: 0 10px; 
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-6 game-container">
        
        <img src="images/temple.png" class="landmark-img" alt="Temple of Learning" onerror="this.src='https://via.placeholder.com/400x200?text=Temple+Image'">
        
        <h2 id="location-1" class="fw-bold text-primary"></h2>
        <p id="description-1" class="text-muted fs-5"></p>
        
        <div class="card shadow-sm mt-4 border-primary">
            <div class="card-body">
                <h4 id="question-1" class="fw-bold text-dark mt-2"></h4>
                
                <div class="target-box" id="label-1a"></div>

                <div class="d-flex justify-content-center align-items-center my-4">
                    <input type="number" id="input-1a" class="form-control prime-input" placeholder="p1">
                    <span class="fs-1 fw-bold mx-2">+</span>
                    <input type="number" id="input-1b" class="form-control prime-input" placeholder="p2">
                </div>

                <button id="check-1" class="btn btn-primary btn-lg px-5 fw-bold shadow-sm">Check</button>
            </div>
        </div>
        
        <div id="feedback-1" class="mt-4 fs-4 fw-bold"></div>

      </div>
    </div>
  </div>

  <script type="text/javascript">
    var questionID = '<?php echo $question; ?>';
    
    // Puzzle Data
    var locName = "PIO - Temple of Learning";
    var locDesc = "A place where students study, learn and achieve!";  
    var questionText = "Find two prime numbers that add up to the target number below:";
    
    // Generate a random EVEN number between 52 and 198 to guarantee it can be solved with two primes
    var targetNumber = (Math.floor(Math.random() * 74) + 26) * 2;

    $(document).ready(function() {
        
        // Initialize UI
        $('#location-1').text(locName);
        $('#description-1').text(locDesc);
        $('#question-1').text(questionText);
        $('#label-1a').text(targetNumber);

        // Check Logic
        $('#check-1').click(function() {
            var answerA = parseInt($('#input-1a').val());
            var answerB = parseInt($('#input-1b').val());
            
            // Validate inputs
            if (isNaN(answerA) || isNaN(answerB)) {
                $('#feedback-1').html('<span class="text-danger">Please enter numbers in both boxes.</span>');
                return;
            }
            
            // Check if numbers are prime (relies on wat.js)
            var pA = isPrime(answerA);
            var pB = isPrime(answerB);

            if (!pA || !pB) {
                $('#feedback-1').html('<span class="text-danger">Both numbers must be prime numbers!</span>');
                return;
            }

            if (answerA <= 0 || answerB <= 0) {
                 $('#feedback-1').html('<span class="text-danger">Numbers must be greater than 0!</span>');
                return;
            }

            // Check the math
            var solution = answerA + answerB;

            if (solution === targetNumber) {
                // Success Measure
                $('#feedback-1').html('<span class="text-success fs-3">⭐ Correct! Well done! ⭐</span>');
                $('#input-1a, #input-1b').prop('disabled', true).css({"background-color": "lightgreen", "color": "black"});
                $(this).hide(); // Hide check button on success
                
                // Trigger Dashboard Logic
                if (typeof handleCorrectAnswer === "function") {
                    handleCorrectAnswer();
                } else if (typeof processWin === "function") {
                    processWin(questionID);
                } else {
                    setTimeout(() => alert("Puzzle Solved!"), 500);
                }
            } else {
                // Failure Measure
                $('#feedback-1').html('<span class="text-danger">That adds up to ' + solution + '. Try again!</span>');
                
                // Shake effect on wrong answer
                $('#input-1a, #input-1b').animate({marginLeft: '-10px'}, 100).animate({marginLeft: '10px'}, 100).animate({marginLeft: '0'}, 100);
            }
        });
    });
  </script> 
</body>
</html>