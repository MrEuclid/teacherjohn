<?php 
 $question = isset($_POST['question']) ? $_POST['question'] : 'Puzzle 5';
?>

<?php
include "../connectTeacherJohn.php" ;
$query = "select UPPER(word) from spellingWords where level >= 6 AND LENGTH(word) = 6 ORDER BY RAND() LIMIT 1" ;
$result = mysqli_query($dbServer,$query) ;
$data = mysqli_fetch_array($result) ;
$word = $data[0] ;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Race to Wat Phnom - Puzzle 5</title>
  
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
</head>
<body>

  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-6" style="text-align: center; margin-top: 20px;">
        
          <img id="picture" src="" alt="Location" style="max-width: 100%; max-height: 250px; border-radius: 12px; margin-bottom: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
          
          <h2 id="location-5" class="fw-bold text-primary"></h2>
          <p id="description-5" class="text-muted fs-5"></p>
          <h5 id="question-5" class="fw-bold text-dark mt-4"></h5>
          
          <div class="mt-4 mb-3">
            <div id="label-5a" style="font-size: 3.5em; font-weight: bold; color: #dc3545; letter-spacing: 5px; background: #f8f9fa; border: 3px dashed #ced4da; border-radius: 12px; padding: 10px;"></div>
          </div>

          <div id="answer-5" class="d-flex justify-content-center align-items-center gap-3 mt-4 mb-4">
            
            <input id="input-5a" type="text" class="form-control fw-bold" style="width: 250px; height: 60px; font-size: 1.8em; text-align: center; text-transform: uppercase; background-color: lightgreen; border: 2px solid #198754; border-radius: 10px; color: #000;" placeholder="ENTER WORD">
            
            <input id="myWord" type="hidden" value="<?php echo htmlspecialchars($word); ?>">

            <button id="check-btn" class="btn btn-primary btn-lg px-4 fw-bold shadow-sm" style="height: 60px;">Check Answer</button>

          </div>

          <div id="comment-5" class="mt-4 fs-4 fw-bold"></div>
          
          <div id="visited" class="mt-4"></div>

      </div>
    </div>
  </div> 

  <script type="text/javascript">
  $(document).ready(function(){  

      // 1. HTML SETUP
      var photo = "images/independenceMonument.jpg";
      var locationName = "Independence Monument";
      var description = "The Independence Monument was built to celebrate Cambodia gaining its independence from France. Cambodia became independent in 1953 after being ruled by the French for more than 100 years.";  
      var questionText = "The word below has been encoded by changing each letter to either the NEXT or PREVIOUS letter in the alphabet. Break the code!";
     
      $("#picture").attr("src", photo);  
      $('#location-5').text(locationName);
      $('#description-5').text(description);
      $('#question-5').text(questionText);

      // 2. ROBUST ENCRYPTION LOGIC
      // This self-contained function ensures it never crashes due to wat.js scoping issues
      function generateCode(word) {
          let encoded = "";
          for (let i = 0; i < word.length; i++) {
              let charCode = word.charCodeAt(i);
              
              // Only shift uppercase A-Z
              if (charCode >= 65 && charCode <= 90) {
                  // Randomly pick +1 (forward) or -1 (backward)
                  let shift = Math.random() < 0.5 ? 1 : -1; 
                  let newCode = charCode + shift;
                  
                  // Wrap around Z to A and A to Z
                  if (newCode > 90) newCode = 65;
                  if (newCode < 65) newCode = 90;
                  
                  encoded += String.fromCharCode(newCode);
              } else {
                  encoded += word[i]; // Leave spaces/punctuation alone
              }
          }
          return encoded;
      }

      // Fetch the word from the hidden PHP input and encrypt it
      var originalWord = $('#myWord').val().toUpperCase().trim();
      var encryptedWord = generateCode(originalWord);
      
      // Display the encrypted word on the screen
      $('#label-5a').text(encryptedWord);

      // 3. EVENT LISTENER
      $('#check-btn').click(function() {
          var userGuess = $('#input-5a').val().toUpperCase().trim();

          if (userGuess === "") {
              $('#comment-5').html('<span class="text-danger">Please enter a word!</span>');
              return;
          }

          if (userGuess === originalWord) {
              // SUCCESS
              $('#comment-5').html('<span class="text-success fs-3">⭐ Correct! The word is ' + originalWord + ' ⭐</span>');
              
              if (typeof solved !== 'undefined') {
                  solved[5] = 1;
              }
              
              // Add thumbnail
              $('#visited').append('<img src="' + photo + '" style="width: 100px; border-radius: 8px; margin-top: 15px; border: 2px solid #198754;">');
              
              if (typeof displayUnsolved === "function") {
                  displayUnsolved();
              }
              
              // Lock inputs
              $('#input-5a').prop('disabled', true).css({"background-color": "lightgreen", "color": "black"});
              $(this).hide();
              
              var questionID = '<?php echo $question; ?>';
              if (typeof processWin === "function") {
                  processWin(questionID);
              }
              
          } else { 
              // FAILURE
              $('#comment-5').html('<span class="text-danger">Incorrect. Keep trying!</span>');
              $('#input-5a').animate({marginLeft: '-10px'}, 100).animate({marginLeft: '10px'}, 100).animate({marginLeft: '0'}, 100);
          }
      });

  });
  </script>
</body>
</html>