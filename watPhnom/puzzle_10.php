<?php 
 $question = isset($_POST['question']) ? $_POST['question'] : 'Puzzle 10';

include "../connectTeacherJohn.php";

$query = "select UPPER(word) from spellingWords where level >= 6 AND LENGTH(word) = 3 ORDER BY RAND()
LIMIT 1" ;
$result = mysqli_query($dbServer,$query) ;
$data = mysqli_fetch_array($result) ;
$codeWord = $data[0] ;

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Race to Wat Phnom - Puzzle 10</title>
  
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


<!--
  <script src="wat.js"></script>  

--> 
</head>


<body>
<input id = "codeWord" type = "hidden" value = "<?php echo $codeWord ; ?>">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12 col-md-10 col-lg-6" style="text-align: center; margin-top: 20px;">
        
          <img id="picture" src="" alt="Location Image" style="max-width: 100%; max-height: 250px; border-radius: 12px; margin-bottom: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); display: none;">
          
          <h2 class="fw-bold text-primary" id="location-10"></h2>
          <p class="text-muted fs-5" id="description-10"></p>
          <h3 class="fw-bold text-dark mt-4" id="title-10"></h3>
          
          <div class="mt-4 mb-3">
             <div id="question-10" style="font-size: 1.5em; background: #f8f9fa; border: 3px dashed #ced4da; border-radius: 12px; padding: 20px;"></div>
          </div>
          
          <div id="answer-10" class="d-flex justify-content-center align-items-center gap-3 mt-4 mb-4 flex-wrap">
              <label id="label-10a" class="fs-2 fw-bold">a =</label>
              <input id="input-10a" type="text" class="form-control fw-bold" style="width: 80px; height: 60px; font-size: 1.8em; text-align: center; border: 2px solid #ced4da; border-radius: 10px;">
             
              <label id="label-10b" class="fs-2 fw-bold">b =</label>  
              <input id="input-10b" type="text" class="form-control fw-bold" style="width: 80px; height: 60px; font-size: 1.8em; text-align: center; border: 2px solid #ced4da; border-radius: 10px;">

              <label id="label-10c" class="fs-2 fw-bold">c =</label>  
              <input id="input-10c" type="text" class="form-control fw-bold" style="width: 80px; height: 60px; font-size: 1.8em; text-align: center; border: 2px solid #ced4da; border-radius: 10px;">
              
              <button id="check-btn" class="btn btn-primary btn-lg px-4 fw-bold shadow-sm" style="height: 60px; margin-left: 10px;">Check</button>
          </div>

          <div id="comment-10" class="mt-4 fs-4 fw-bold"></div>
          <div id="visited" class="mt-4"></div>

      </div>
    </div>
  </div> 
<script type="text/javascript">

  
  function powerMod(base, exponent, modulus) {
    if (modulus === 1) return 0;
    var result = 1;
    base = base % modulus;
    while (exponent > 0) {
        if (exponent % 2 === 1)  //odd number
            result = (result * base) % modulus;
        exponent = exponent >> 1; //divide by 2
        base = (base * base) % modulus;
    }
    return result;
}
  
  // 1. Put encodeWord OUTSIDE and ABOVE the document ready function
  function encodeWord(word) {
      var numbers = []; 
      
      // Get the ASCII value and deduct 64 so A=1, B=2, etc.
      var n1 = word.charCodeAt(0) - 64;  
      var n2 = word.charCodeAt(1) - 64; 
      var n3 = word.charCodeAt(2) - 64; 

      var n = 33; // modulus 
      var e = 3;  // encryption exponent

      // encode letters using powerMod from utilities.js
      numbers[0] = powerMod(n1, e, n);
      numbers[1] = powerMod(n2, e, n);
      numbers[2] = powerMod(n3, e, n);

      return numbers;
  }

  // 2. Start the main page logic
  $(document).ready(function() {
      
      // Initialize State
      window.solved = window.solved || []; 
      
      var secretWord = $('#codeWord').val() ;

      // Extract the 3 letters
      var h1 = secretWord.substr(0,1) ;
      var h2 = secretWord.substr(1,1) ;
      var h3 = secretWord.substr(2,1) ;

      var numbers = encodeWord(secretWord) ;  // get coded numbers for the chosen word

      var numberP = numbers[0] ;
      var numberQ = numbers[1] ;
      var numberR = numbers[2] ; 

      // Build the UI
      $('#label-10a').text(numberP + ' = ').show() ;
      $('#label-10b').text(numberQ + ' = ').show() ;
      $('#label-10c').text(numberR + ' = ').show() ;

      var photo = "images/watPhnom.jpg" ;
      $("#picture").attr("src", photo).show();  
      
      var location = "Wat Phnom";
      var description = 'Wat Phnom is the oldest pagoda in Phnom Penh it on top of the only hill in the city.'
        + '<br>'
        + 'Many people visit Wat Phnom. At Khmer New Year people go there to pray at the pagoda and to celebrate the New Year with singing and dancing.';
      
      $('#location-10').text(location).show() ;
      $('#description-10').text(description).show() ;

      var question =  "To finish the game you need to break the code. Here is what you need to do."
        + '<br><br>' 
        + 'To break the code you need to raise each number to the power of 3. '
        + "Then you divide your answer by 33 and find out what the remainder is."
        + "<br><br>"
        + "After that, change the remainder into a letter using 1 = A, 2 = B, 3 = C etc. Type the letters below!";
      
      $('#question-10').html(question);

      // Render MathJax
      MathJax.Hub.Queue(["Typeset", MathJax.Hub, "question-10"]);

      // Interaction Logic (Read inputs ONLY when clicked!)
      $('#check-btn').off('click').on('click', function() {
          // Get the user's guessed letters
          var answerP = $('#input-10a').val().toUpperCase() ;
          var answerQ = $('#input-10b').val().toUpperCase() ;
          var answerR = $('#input-10c').val().toUpperCase() ;

          // Check if they match the original secret word letters
          if (answerP === h1 && answerQ === h2 && answerR === h3) {
              
              // SUCCESS
              $('#comment-10').html('<span class="text-success fs-3">⭐ Correct! You broke the code! ⭐</span>');
              
              if (typeof window.solved !== 'undefined') {
                  window.solved[10] = 1; // Mark puzzle 10 as solved
              }
              
              // Add thumbnail
              if ($('#visited').length) {
                  $('#visited').append('<img src="' + photo + '" style="width: 100px; border-radius: 8px; margin-top: 15px; border: 2px solid #198754; margin-right: 5px;" title="' + location + '">');
              }
              
              if (typeof displayUnsolved === "function") {
                  displayUnsolved();
              }
              
              // Lock inputs
              $('[id^="input-10"]').prop('disabled', true).css({"background-color": "lightgreen", "color": "black"});
              $(this).hide(); 
              
              var questionID = '<?php echo $question; ?>';
              if (typeof processWin === "function") {
                  processWin(questionID);
              }
              
         } else {
            // FAILURE
            $('#comment-10').html(`<span class="text-danger">Incorrect! Keep trying!</span>`);

            // Wiggle animation
            $('[id^="input-10"]').animate({marginLeft: '-10px'}, 100).animate({marginLeft: '10px'}, 100).animate({marginLeft: '0'}, 100);
        }
      });
  });
</script>

</body>
</html>