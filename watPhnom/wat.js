// Add these to the very top of wat.js
var primes = [];
var solved = [];

function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function makeShiftPlusMinus(n) {
    // caesar code 
    let start = 65;
    let end = 91;
    let letters = [];
    let shiftForward = [];
    let shiftBack = [];
    let place;

    $('#letters').empty();

    let forwardShift = 0;
    let backShift = 0;

    for (let i = 0; i <= 25; i++) {
        letters[i] = String.fromCharCode(i + 65);
        $('#letters').append(letters[i] + "\t");
    }

    $('#letters').append('<br><br>');
    
    for (let i = 0; i <= 25; i++) {
        place = i + n;
        if (place > 25) { place = place % 25 - 1; }
        shiftForward[i] = letters[place];
        $('#letters').append(shiftForward[i] + "\t");
    }

    $('#letters').append('<br><br>');
    
    for (let i = 0; i <= 25; i++) {
        place = i - n;
        // Fixed: Removed the double semicolon here
        if (place < 0) { place = 25 + place + 1; }
        shiftBack[i] = letters[place];
        $('#letters').append(shiftBack[i] + "\t");
    }
}

function isPrime(num) {
    if (num <= 1) return false;
    if (num % 2 == 0 && num > 2) return false;
    const s = Math.sqrt(num);
    for(let i = 3; i <= s; i += 2) {
        if(num % i === 0) return false;
    }
    return true;
}

function isSquare(num) {
    let square = false;
    let sqrtNum = Math.floor(Math.sqrt(num));
    if (sqrtNum * sqrtNum == num) {
        square = true; 
    } else {
        square = false;
    }
    return square;
}

function displayUnsolved() {
    var escapeCode = 0;
    for (var x = 1; x <= 10; x++) {
        if (solved[x] == 1) { 
            escapeCode = escapeCode + Math.pow(2, x); 
        }
    }

    escapeCode = parseInt(escapeCode);
    $('#escapeKey').text(escapeCode);

    var cnt = 0;  
    $('[id^=place]').show();
    
    for (var i = 1; i <= 10; i++) {
        if (solved[i] == 1) {
            cnt = cnt + 1;
            $('#place' + i).attr('disabled', true).css({"background-color": "green"});
        }
    }
    
    if (cnt < 9) {
        $('#place10').attr('disabled', true).css({"background-color": "red"});
    } else {
        $('#place10').attr('disabled', false).css({"background-color": "blue"});
        // Re-enable other logic if needed here
    }
}

 
  function makePrimes() 
  {
  var limit = 999 ;
  var cnt = 1 ;
  primes = [];
  n = 2 ;
  primes[1] = n ;
  $('#primeNumbers').empty() ;
  $('#primeNumbers').append(n + "\t") ;
    var n = 3  ;
      $('#primeNumbers').append(n + "\t") ;
  while (n <= limit)
  {
   n = n + 2 ;
   if (isPrime(n) == true) 
    {primes[cnt] = n ;
        $('#primeNumbers').append(n + "\t") ;
      cnt = cnt + 1 ;
    if (cnt % 10 == 0) { $('#primeNumbers').append('<br>') ;} 
    }
  

  }
  return primes ;
}

function encryptWord(word) {
    var l = word.length;
    var str = '';
    var newLetter;
    var code = '';

    for (var i = 0; i < l; i++) {
        var x = getRandomInt(1, 2);
        // Ensure we are looking up the uppercase version to match the 'letters' array
        var index = letters.indexOf(word[i].toUpperCase());

        if (index === -1) {
            // If the character isn't a letter (like a space), keep it as is
            str += word[i];
        } else {
            if (x == 1) {
                newLetter = shiftForward[index];
            } else {
                newLetter = shiftBack[index];
            }
            str += newLetter;
        }
    }

    code = str.toUpperCase();
    console.log("Original:", word, "Encrypted:", code);
    return code;
}
 
 function decodeQ(n) {
    var temp = [];
    n = parseInt(n);
    // Convert to binary and split into an array
    var base2 = n.toString(2).split(""); 
    
    // Reverse it so index 0 is the 2^0 bit, index 1 is 2^1, etc.
    base2.reverse(); 

    // Initialize the array with 0s (for 10 puzzles)
    for (var i = 0; i <= 10; i++) {
        temp[i] = 0;
    }

    // Fill temp array from the reversed binary
    for (var i = 0; i < base2.length; i++) {
        // If your puzzles are 1-indexed, use i+1
        temp[i + 1] = parseInt(base2[i]);
    }

    return temp;
}


  function encodeWord(word) 

  {
    var numbers = [] ; // array to hold codes.

    // based on RSA
  //  n = 33 , e = 7 (d = 3)
  // powerMod(base, exponent modulus). e.g. 3^7 mod 35 = powerMod(3,7,50)

  var n = 33 ;
  var e = 7 ;
  var firstLetter = word.substr(0,1);
  var secondLetter = word.substr(1,2);
  var thirdLetter  = word.substr(2); 


  var n1 = firstLetter.charCodeAt(0) - 64;
  var n2 = secondLetter.charCodeAt(0) - 64 ;
  var n3 = thirdLetter.charCodeAt(0) - 64 ;

//  alert('hiddens to be encoded ' + n1+n2+n3) ;

  // now get ascii - 65 ;
numbers[0] = powerMod(n1,e,n) ;
numbers[1] = powerMod(n2,e,n) ;
numbers[2] = powerMod(n3,e,n) ;

// alert('Word ' + word + ' numbers ' + numbers) ;

    return numbers ;
  }