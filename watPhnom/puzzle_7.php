<?php 
 $question = isset($_POST['question']) ? $_POST['question'] : '7';
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
  <title>Race to Wat Phnom - Puzzle 7</title>
  
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
  

  <script src="wat.js"></script>  
</head>

<body>

  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-6" style="text-align: center; margin-top: 20px;">
        
          <img id="picture" src="" alt="Location Image" style="max-width: 100%; max-height: 250px; border-radius: 12px; margin-bottom: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); display: none;">
          
          <h2 id="location-7" class="fw-bold text-primary"></h2>
          <p id="description-7" class="text-muted fs-5"></p>
          <h5 id="title-6" class="fw-bold text-dark mt-4"></h5>
          
          <div class="mt-4 mb-3">
            <div id="question-7" style="font-size: 1.5em; background: #f8f9fa; border: 3px dashed #ced4da; border-radius: 12px; padding: 20px;"></div>
          </div>

          <div id="answer-7" class="d-flex justify-content-center align-items-center gap-3 mt-4 mb-4">
            <label id="label-7a" class="fs-2 fw-bold"></label>
            <input id="input-7a" type="text" class="form-control fw-bold" style="width: 150px; height: 60px; font-size: 1.8em; text-align: center; background-color: lightgreen; border: 2px solid #198754; border-radius: 10px; color: #000;" placeholder="n = ?">
            <input id="hiddenN" type="hidden"> 
            <button id="check-btn" class="btn btn-primary btn-lg px-4 fw-bold shadow-sm" style="height: 60px;">Check Answer</button>
          </div>

          <div id="comment-7" class="mt-4 fs-4 fw-bold"></div>
          
          <div id="visited" class="mt-4"></div>

      </div>
    </div>
  </div> 


<script type="text/javascript">
  $(document).ready(function() {

// 3 equations
     
  $('#puzzle-7').show() ;
  $('#question-7').show() ;
  $('#answer-7').show() ;
   $('#comment-7').show() ;
 
  
 //  $('[id^=puzzle]').show() ;
  // $('[id^=answer]').show() ;
// $('[id^=place]').hide() ;
// alert('Place = ' +place) ;



 
var p = getRandomInt(10,20) ;
if (p % 2 != 0){p = p + 1 ;}



var q = getRandomInt(10,20) ;
 if (q % 2 != 0){q = q + 1 ;}



var r = getRandomInt(10,20) ;
 if (r % 2 != 0){r = r + 1 ; }



var c = (q+r-2*p) / 2 ;
var b = (r - c) / 2 ;
var a = p - b ;
var n = a + b + c ;

// console.log(7,a,b,c,n);

// alert(' A + B + C = ' + n) ;

$('#label-7a').text('A + B + C = ')

 

  $('#answer-7').show() ;
  
  var solved = false ;
 // var n = getRandomInt(12,20) ;
  
//  if (n % 2 ==0 ){n = n + 1 ;}

//   var m = Math.pow(2,n)-1 ;
  $('#hiddenAnswer').val(n) ;

   $('#label-7a').show() ;
  $('#label-7a').text('A + B + C  = ') ;


 
  var question = 'Find the value of A + B + C  using these equations '+ '<br>' + 
  'A + B = ' + p + '<br>' + ' 2A + C = ' + q + '<br>' + ' C + 2B =  ' + r;
  

  const photo = "images/silverPagoda.jpg" ;
  $("#picture").attr("src",photo).show();  
  var location = "Silver Pagoda" ;
  var description = "The Silver Pagoda is a very beautiful temple It is next to the Royal Palace. It is very popular with tourists and locals. Inside the pagoda is a golden Buddha made from 90kg of gold. "  ; 

  var title = "Question 7" ;
 
  $('#location-7').text(location).show() ;
 
  $('#description-7').text(description).show() ;
  
  $('#title-7').text(title).show() ;
  $('#question-7').html(question).show() ;
   
  MathJax.Hub.Queue(["Typeset", MathJax.Hub, "question-7"]);

    // 3. Interaction Logic
      $('#check-btn').off('click').on('click', function() {
          const guessN = parseInt($('#input-7a').val());
          
          if (isNaN(guessN)) {
              $('#comment-7').html('<span class="text-danger">Please enter a valid number!</span>');
              return;
          }

          if (guessN === n) {
              // SUCCESS
              $('#comment-7').html('<span class="text-success fs-3">⭐ Correct! ⭐</span>');
              
              if (typeof solved !== 'undefined') {
                  solved[7] = 1;
              }
              
              // Add thumbnail
              if ($('#visited').length) {
                  $('#visited').append('<img src="' + photo + '" style="width: 100px; border-radius: 8px; margin-top: 15px; border: 2px solid #198754; margin-right: 5px;" title="' + location + '">');
              }
              
              if (typeof displayUnsolved === "function") {
                  displayUnsolved();
              }
              
              // Lock inputs
              $('#input-7a').prop('disabled', true).css({"background-color": "lightgreen", "color": "black"});
              $(this).hide(); // Hide the check button
              
              var questionID = '<?php echo $question; ?>';
              if (typeof processWin === "function") {
                  processWin(questionID);
              }
              
         } else {
            // Calculate what their guess actually equals
            const userResult = Math.pow(2, guessN) - 1;

            // FAILURE - Show their calculated value
            $('#comment-7').html(`<span class="text-danger">Incorrect! $2^{${guessN}} - 1 = ${userResult.toLocaleString()}$. Keep trying!</span>`);
            
            // Tell MathJax to render the new math equation in the comment box
            MathJax.Hub.Queue(["Typeset", MathJax.Hub, "comment-6"]);

            // Wiggle animation
            $('#input-7a').animate({marginLeft: '-10px'}, 100).animate({marginLeft: '10px'}, 100).animate({marginLeft: '0'}, 100);
        }
      });
  })

</script>

</body>
</html>