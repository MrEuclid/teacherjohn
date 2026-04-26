

// useful js functions 
/*
  continued fraction(simple)
  dataTableTo2DArray(dataTable)
	factorial(n)
	findPrimes(n)
	makePrimes(n)
	gcd(a,b)
	randomInteger(a,b)
  round2DP(n)
	shuffle(array)
  solveQuadractic(a,b,c) real roots

*/


 




function continuedFractionConvergents(cf) {
  // Initialize empty arrays for numerators and denominators
  const numerators = [];
  const denominators = [];
  let max = cf.length;

  // Handle edge case for single element
  if (cf.length === 1) {
    numerators.push(cf[0]);
    denominators.push(1);
    return { numerators, denominators };
  }

  // Initialize first two convergents
  numerators.push(cf[0]);
  denominators.push(1);
  numerators.push(cf[0] * cf[1] + 1);
  denominators.push(cf[1]);

  // Calculate remaining convergents up to max (or all)
  for (let i = 2; i < max; i++) {
    const newNumerator = numerators[i - 1] * cf[i] + numerators[i - 2];
    const newDenominator = denominators[i - 1] * cf[i] + denominators[i - 2];
    numerators.push(newNumerator);
    denominators.push(newDenominator);
  }

  return { numerators, denominators };
}


 
  function dataTableTo2DArray(dataTable) {
  const numRows = dataTable.getNumberOfRows();
  const numCols = dataTable.getNumberOfColumns();
  const twoDimArray = [];

  // Extract column names (headers)
  const headers = [];
  for (let i = 0; i < numCols; i++) {
    headers.push(dataTable.getColumnLabel(i));
  }
  twoDimArray.push(headers); // Add headers as first row

  // Extract data for each row
  for (let i = 0; i < numRows; i++) {
    const row = [];
    for (let j = 0; j < numCols; j++) {
      row.push(dataTable.getValue(i, j));
    }
    twoDimArray.push(row);
  }

  return twoDimArray;
}

function factorial(n) {

        var f = 1 ;
        for (var i = 1 ; i <= n ; i++)
            {f = f * i;}
  return f;
}

   function gcd(a, b) {
   
   a = Math.abs(a) ;
   b = Math.abs(b) ;

//alert('Now ' + a + ' ' + b);

    if (a == 0)
        return b;

    if (b == 0)
       return a ;  

    while (b != 0) 
    {
        if (a > b)
            a = a - b;
        else
            b = b - a;
    }

    return a;
}



    function findPrimes(max) {
  // Create an array to store if a number is prime
  const isPrime = new Array(max + 1).fill(true);

  isPrime[0] = isPrime[1] = false;

  for (let i = 2; i * i <= max; i++) {
    if (isPrime[i]) {
      // If the number is prime, mark its multiples as composite (not prime)
      for (let j = i * i; j <= max; j += i) {
        isPrime[j] = false;
      }
    }
  }

  // Collect prime numbers from the isPrime array
  const primes = [];
  for (let i = 2; i <= max; i++) {
    if (isPrime[i]) {
      primes.push(i);
    }
  }

  return primes;
}



  function makePrimes(max)
{

  // a list of primes up to max
  var max_sqrt = Math.sqrt(max) ;
  var  range = [] ;
  var  current = 0;
  
  //generate array of numbers
  for (var i = 2; i <= max; i++)
      range.push(i);
  
  //filter multiples out
  while (range[current] <= max_sqrt)
  {
      range = range.filter(function(n)
      {
          return (n == range[current] || n % range[current] != 0);
      });
      
      current++;
  }
  
  return range;
}




      function randomInteger(min, max) { // min and max included 
  return Math.floor(Math.random() * (max - min + 1) + min);
}

function round2DP(n)
{
roundedNum = (Math.round( n * 100 ) / 100);

return roundedNum;

}
   
function shuffle(array) {
  let currentIndex = array.length;

  // While there remain elements to shuffle...
  while (currentIndex != 0) {

    // Pick a remaining element...
    let randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex--;

    // And swap it with the current element.
    [array[currentIndex], array[randomIndex]] = [
      array[randomIndex], array[currentIndex]];
  }
}

    function solveQuadratic(a,b,c)
    {
        let x = [];

        let det = b*b -4*a*c;
        x1 = (-b - Math.sqrt(det))/ (2*a);
        x2 = (-b + Math.sqrt(det))/ (2*a);

        // sort x1, x2
        let t = x1 ;
        if (x2 < x1)
            {
                x1 = x2;
                x2 = t;
            }
        num1 = -b - Math.sqrt(det);
        num2 = -b + Math.sqrt(det);
        denom = 2*a;
        x1 = round2DP(x1);
        x2 = round2DP(x2);
        x[0] = [x1,x2,num1,num2,denom];
        return x[0];
    }

function checkAnswer(totalParts) {
    // .off('click') prevents duplicate triggers when loading multiple questions
    $('[id^=check]').off('click').on('click', function() {
        var clicked = this.id;
        var qNumber = clicked.slice(-1);
        var rawGuess = $('#solution' + qNumber).val().trim();
        
        // Ensure the answer array exists (failsafe)
        if (typeof answer === 'undefined' || answer[qNumber] === undefined) {
            console.error("Error: Answer array is missing or undefined for Q" + qNumber);
            return;
        }

        var expectedAnswer = answer[qNumber];
        var processedGuess;

        // If the expected answer is a Number, do the math rounding
        if (typeof expectedAnswer === 'number') {
            processedGuess = parseFloat(parseFloat(rawGuess).toFixed(2));
            expectedAnswer = parseFloat(expectedAnswer.toFixed(2));
        } 
        // If the expected answer is a String, do the uppercase conversion
        else if (typeof expectedAnswer === 'string') {
            processedGuess = rawGuess.toUpperCase();
        }

      //  alert(processedGuess + " " + expectedAnswer);

        // Now compare safely!
        if (processedGuess === expectedAnswer) {
            // Mark Correct
            $('#solution' + qNumber).prop('disabled', true).css({"background-color":"#c8e6c9", "color":"black"});
            $('#' + clicked).prop('disabled', true).removeClass('btn-primary').addClass('btn-success').text('✓');
            
            correct++;
            
            // Check if all parts are complete
            if (correct === totalParts) {
                if (typeof parent.handleCorrectAnswer === "function") {
                    parent.handleCorrectAnswer(); 
                } else if (typeof handleCorrectAnswer === "function") {
                    handleCorrectAnswer();
                }
            }
        } else {
            // Mark Incorrect (Flash Red)
            $('#solution' + qNumber).css({"background-color":"#ffcdd2"});
            setTimeout(() => $('#solution' + qNumber).css({"background-color":"white"}), 800);
        }
    });
}

function formatComplex(obj) {
    // Assuming your object uses 're' for real and 'im' for imaginary
    let re = obj.re;
    let im = obj.im;

    // Case 1: Both are zero
    if (re === 0 && im === 0) return "0";

    // Case 2: Purely real (imaginary is 0)
    if (im === 0) return `${re}`;

    // Case 3: Purely imaginary (real is 0)  // i instead of I to allow for answerchecking using toUpper
    if (re === 0) {
        if (im === 1) return "I";
        if (im === -1) return "-I";
        return `${im}I`;
    }

    // Case 4: Mixed real and imaginary
    let imPart = "";
    if (im === 1) {
        imPart = "+I";
    } else if (im === -1) {
        imPart = "-I";
    } else if (im > 0) {
        imPart = `+${im}I`; // Add explicit plus for positive imaginary numbers
    } else {
        imPart = `${im}I`;  // Negative numbers naturally include their own minus sign
    }

    return `${re}${imPart}`;
}