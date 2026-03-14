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
}