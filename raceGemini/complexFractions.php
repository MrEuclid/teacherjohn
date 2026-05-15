<?php 
$question = isset($_POST['question']) ? $_POST['question'] : 'Complex Fraction';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
  <title>Complex fractions 2</title>

  <style>
    h1 { font-weight: bolder; font-size: 24pt; color: green; }
    h2 { font-weight: bolder; font-size: 20pt; color: blue; }
    h3 { font-weight: bolder; font-size: 16pt; color: green; }
    h4 { font-weight: bold; font-size: 14pt; color: orange; text-align: center; color: black; }
    p { font-weight: bold; font-style: italic; font-size: medium; }
    #message { font-size: 10pt; font-style: italic; color: black; text-align: justify; }
    #answer { text-align: center; background-color: lightblue; font-size: 1.2em; font-weight: bolder; }
    
  

    [id^=equation] {
        font-weight: bolder;
        color: blue;
        font-size: 1.5em;
    }
  </style>
</head>
<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 c">
                <p id="stars"></p>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 c">
                <h1>Complex fractions</h1>
                <h2 id="complexNumbers"></h2>
            </div>
        </div>
<?php include "answerBootstrap3.html"; ?>
    </div>

<script>
    // 1. GLOBAL VARIABLES
    var answer = [];
    var correct = 0;
    var points = 0;
    var questionID = '<?php echo $question; ?>';

    function makeQuestion1(z1,z2,z3,z4) {
        let numerator1 = math.multiply(z1,z4) ;
        let numerator2 = math.multiply(z2,z3) ;
        let numerator = math.add(numerator1,numerator2);
        let denominator = math.multiply(z3,z4);
        let a = math.divide(numerator,denominator);

        let expr = '$ z_1 + z_2 = $ ';
        $('#equation1').html(expr);
        
        a.re = round2DP(a.re);
        a.im = round2DP(a.im); 
        let z = formatComplex(a);
        return z;    
    }

    function makeQuestion2(z1,z2,z3,z4) {
        let numerator1 = math.multiply(z1,z4) ;
        let numerator2 = math.multiply(z2,z3) ;
        let numerator = math.subtract(numerator1,numerator2);
        let denominator = math.multiply(z3,z4);
        let a = math.divide(numerator,denominator);

        let expr = '$ z_1 - z_2 = $ ';
        $('#equation2').html(expr);
        
        a.re = round2DP(a.re);
        a.im = round2DP(a.im); 
        let z = formatComplex(a);
        return z; 
    }

    function makeQuestion3(z1,z2,z3,z4) {
        let p = math.multiply(z1,z2);
        let q = math.multiply(z3,z4);
        let a = math.divide(p,q);

        let expr = '$ z_1 \\times  z_2 = $ ';
        $('#equation3').html(expr);
      
        a.re = round2DP(a.re);
        a.im = round2DP(a.im); 
        let z = formatComplex(a);
        return z;        
    }

    $(document).ready(function(){
        let a = 2; 
        let b = 4;
        while (gcd(a,b) != 1) { 
            a = randomInteger(2,10);
            b = randomInteger(2,10);
        }
        
        let c = 2; 
        let d = 4;
        while (gcd(c,d) != 1) { 
            c = randomInteger(2,10);
            d = randomInteger(2,10);
        }

        let z1 = math.complex(a,b);
        let z2 = math.complex(c,d);
        let z3 = math.complex(a,-1);  
        let z4 = math.complex(a,1); 
     
        let num1 = a + ' + ' + b + 'i';
        let num2 = c + ' + ' + d + 'i';
        let denom1 = a + ' - ' +  'i';
        let denom2 = a + ' + ' +  'i';
       
        let expr = '$ z_1 = \\frac{' + num1 + '}{' + denom1 + '} \\quad \\text{and} \\quad z_2 = \\frac{' + num2 + '}{' + denom2 + '} $';

        $('#complexNumbers').html(expr);

        answer = [];
        answer[1] = makeQuestion1(z1,z2,z3,z4);
        answer[2] = makeQuestion2(z1,z2,z3,z4);
        answer[3] = makeQuestion3(z1,z2,z3,z4);

     //   console.log("answers", answer);
        
        correct = 0; 
        points = 0;

        checkAnswer(3);

        // BULLETPROOF MATHJAX RENDER
        // Now that all HTML is injected, we queue MathJax once for the whole document
        if (typeof MathJax !== 'undefined' && MathJax.Hub) {
            MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
        }
    });
</script>
</body>
</html>