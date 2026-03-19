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
  
<script src="javascript/utilities.js"></script>
  <script src="wat.js"></script>  
</head>
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
  $(document).ready(function() {

      // 1. Setup the Puzzle Data
      window.solved = window.solved || []; 
      
    
var answerP =  $('#input-tena').val() ;
var answerQ =  $('#input-tenb').val() ;
var answerR =  $('#input-tenc').val() ;



var secretWord = $('#codeWord').val() ;

var h1 = secretWord.substr(0,1) ;
var h2 = secretWord.substr(1,1) ;
var h3 = secretWord.substr(2,1) ;

$('#hiddenAnswerP').val(h1) ;
$('#hiddenAnswerQ').val(h2) ;
$('#hiddenAnswerR').val(h3) ;

console.log(10,secretWord,h1,h2,h3) ;

// alert('Hiddens ' + h1 + ' ' + h2 + ' ' + h3) ;

var numbers = [] ;
numbers = encodeWord(secretWord) ;  // get coded lettes for the chosen word

// alert('My numbers = ' + numbers + 'My word ' + secretWord) ;

numberP = numbers[0] ;
numberQ = numbers[1] ;
numberR = numbers[2] ; 

// alert('Codes are ' + numbers) ;

  $('#label-tena').text(numberP).show() ;
  $('#label-tenb').text(numberQ).show() ;
  $('#label-tenc').text(numberR).show() ;



      // 2. Build the UI
   
  var photo = "images/watPhnom.jpg" ;
  $("#picture").attr("src",photo);  
  var location = "Wat Phnom ";
  var description = 'Wat Phnom is the oldest pagoda in Phnom Penh it on top of the only hill in the city.'
  + '<br>'
 +  'Many people visit Wat Phnom. At Khmer New Year people go there to pray at the pagoda and to celebrate the New Year with singing and dancing.';
  $('#location-ten').text(location).show() ;
  $('#description-ten').text(description).show() ;
 // $('#title-ten').text(title).show() ;
  $('#question-ten').html(question).show() ;
     
      $("#picture").attr("src", photo).show();  
      $('#location-10').text(location);
      $('#description-10').text(description);
     

    var solved = false ;    
      
  var question =  "To finish the game you need to break the code."
  + 'Here is what you need to do.'
  + '<br>' 
  + 'To break the code you need to raise each number to the power of 3, '
  + "Then you divide your answer by 33 and find out what the remainder is."
  + "<br>"
  + "After that change the remainder into  number using "
   + " using 1 = A, 2 = B, 3 = C etc. ";
      
      $('#question-10').html(question);

      // Render MathJax
      MathJax.Hub.Queue(["Typeset", MathJax.Hub, "question-10"]);

      // 3. Interaction Logic (Read inputs ONLY when clicked!)
      $('#check-btn').off('click').on('click', function() {
       solutionP = $('#hiddenAnswerP').val() ;
solutionQ = $('#hiddenAnswerQ').val() ;
solutionR = $('#hiddenAnswerR').val() ;



var answerP = $('#input-tena').val() ;
var answerQ = $('#input-tenb').val() ;
var answerR = $('#input-tenc').val() ;

solutionP = solutionP.toUpperCase() ;
solutionq = solutionQ.toUpperCase() ;
solutionR = solutionR.toUpperCase() ;

//alert('Solution Q. = ' + solutionQ) ;

answerP = answerP.toUpperCase() ;
answerQ = answerQ.toUpperCase() ;
answerR = answerR.toUpperCase() ;

//alert('Answer Q. = ' + answerQ) ;

//alert(answerP+answerQ+answerR+' compared with ' + solutionP+solutionQ+solutionR) ;

$('#puzzle-10').show() ;
if (answerP == solutionP & answerQ == solutionQ  & solutionR == answerR 
  & (answerA > '' & answerB > '' & answerC > ''))
          if (userGuesses[0] === targetPrimes[0] && 
              userGuesses[1] === targetPrimes[1] && 
              userGuesses[2] === targetPrimes[2]) {
              
              // SUCCESS
              $('#comment-10').html('<span class="text-success fs-3">⭐ Correct! ⭐</span>');
              
              if (typeof window.solved !== 'undefined') {
                  window.solved[9] = 1;
              }
              
              // Add thumbnail
              if ($('#visited').length) {
                  $('#visited').append('<img src="' + photo + '" style="width: 100px; border-radius: 8px; margin-top: 15px; border: 2px solid #198754; margin-right: 5px;" title="' + location + '">');
              }
              
              if (typeof displayUnsolved === "function") {
                  displayUnsolved();
              }
              
              // Lock inputs (Fixed the selector syntax)
              $('[id^="input-10"]').prop('disabled', true).css({"background-color": "lightgreen", "color": "black"});
              $(this).hide(); 
              
              var questionID = '<?php echo $question; ?>';
              if (typeof processWin === "function") {
                  processWin(questionID);
              }
              
         } else {
            // FAILURE
            $('#comment-10').html(`<span class="text-danger">Incorrect! Keep trying!</span>`);

            // Wiggle animation (Fixed the selector syntax)
            $('[id^="input-10"]').animate({marginLeft: '-10px'}, 100).animate({marginLeft: '10px'}, 100).animate({marginLeft: '0'}, 100);
        }
      });
  });
</script>

</body>
</html>