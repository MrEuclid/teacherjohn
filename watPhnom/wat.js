

<script type="text/javascript">
  function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

</script>



<script type="text/javascript">
  function makeShiftPlusMinus(n)
  // caesar code 
  {
   start = 65 ;
   end = 91 ;

   $('#letters').empty() ;
  
   var forwardShift = 0 ;
   var backShift  = 0 ;
  
  for (i = 0 ;i <= 25; i++)
  {
  letters[i] = String.fromCharCode(i+65) ;
  $('#letters').append(letters[i] + "\t") ;
}

$('#letters').append('<br><br>') ;
 for (i = 0  ;i <= 25  ; i++)

  {
   place = i + n ;
   if (place > 25) {place = place % 25 -1 ;}
   shiftForward[i] = letters[place] ;
    $('#letters').append(shiftForward[i] + "\t") ;
}

$('#letters').append('<br><br>') ;
 for (i = 0  ;i <= 25  ; i++)

  {
   place = i - n ;
   if (place < 0 ) {place = 25 + place + 1 ; ;}
   shiftBack[i] = letters[place] ;
    $('#letters').append(shiftBack[i] + "\t") ;
}



  }
</script>

<script type="text/javascript">
  
  function isPrime(num) {
  var sqrtnum=Math.floor(Math.sqrt(num));
    var prime = num != 1;
    for(var i=2; i<sqrtnum+1; i++) { // sqrtnum+1
        if(num % i == 0) {
            prime = false;
            break;
        }
    }
    return prime;
}
</script>

<script type="text/javascript">
  
  function makePrimes(limit) 
  {
 // var limit = 999 ;
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
</script>


<script type="text/javascript">
  
  function makeCubes() 
  {

  $('#cubeNumbers').empty() ;   
  var limit = 40 ;
  var cnt = 1 ;
  n = 1 ;

  for (i = 1 ; i <= limit ; i++)
  {
  
  
    {  n = i*i*i ;
      cubes[i] = n ;
        $('#cubeNumbers').append(n + "\t") ;
      cnt = cnt + 1 ;
    if (cnt % 10 == 0) { $('#cubeNumbers').append('<br>') ;} 
    }
  

  }
}
</script>


<script type="text/javascript">
  
  function makeSquares() 
  {

  $('#squareNumbers').empty() ;   
  var limit = 99 ;
  var cnt = 1 ;
  n = 1 ;

  for (i = 1 ; i <= limit ; i++)
  {
  
  
    {  n = i*i ;
      squares[i] = n ;
        $('#squareNumbers').append(n + "\t") ;
      cnt = cnt + 1 ;
    if (i% 10 == 0) { $('#squareNumbers').append('<br>') ;} 
    }
  

  }
}
</script>

<script type="text/javascript">
  function makeFactors(n) 
  {

  $('#factorList').empty() ;   
 
var cnt = 0 ;

  for (i = 1 ; i <= n ; i++)
  {
  
  
    if (n % i == 0 )
       { $('#factorList').append(i + "\t") ;
      cnt = cnt + 1 ;
    if (cnt % 20 == 0) { $('#factorList').append('<br>') ;} 
    }
  

  }
}
</script>


<script type="text/javascript">

  function hideAll()
  {
  $('#squares').hide() ;
  $('#cubes').hide() ;
  $('#primes').hide() ;
  $('#primeNumbers').hide() ;
  $('#squareNumbers').hide() ;
  $('#cubeNumbers').hide() ;
  $('#letters').hide() ;
  $('#factors').hide() ;
  $('#factorList').hide() ;
  $('#code').hide() ;
  $('[id^=puzzle]').hide() ;


 //  $('[id^=words]').hide() ;
 //  $('[id^=puzzle]').hide() ;
     $('[id^=answer]').hide() ;
     $('[id^=question]').hide() ;
      $('[id^=location]').hide() ;
       $('[id^=description]').hide() ;
     $('[id^=title]').hide() ;
     $('[id^=feedback]').hide() ;
     $('[id^=comment-]').hide() ;
  // $('[id^=place]').hide() ;
}

</script>


<script type="text/javascript">
  
  primes  = [] ;
  squares = [] ;
  cubes   = [] ;
  factors = [] ;
  letters = [] ;
  shiftForward = [] ;
  shiftBack = [] ;
  numbers = [] ;
  solved = [] ;




  makePrimes(200) ;
  makeSquares() ;
  makeFactors()  ;
  makeCubes() ;
  makeShiftPlusMinus(1) ;
  hideAll() ;

  $('#escapeKey').hide() ;

</script>
=


<script type="text/javascript">
  
function encryptWord(word) 

{
 
var l = word.length ;
var changed = word.split("") ;
// alert(letters + shiftForward + shiftBack) ;
var code= [] ;
var changed = [] ;
changed = word ;  
var str = '' ;
var newLetter ;
// alert('Changed = ' + word + '  ' + changed  + '  ' +  word[3] + ' c3 ' + changed[3] ) ;
for (var i = 0 ; i < l ; i++)
{
var x = getRandomInt(1,2) ;
var index = letters.indexOf(word[i]) ;

if (x == 1 ) {newLetter = shiftForward[index] ;} 
else {newLetter = shiftBack[index] ; }

// Split string into an array


// Replace char at index
str = str + newLetter;


// Output new string
changed = str ;
// alert(' x ' + x + 'str' + str +  ' i = '  + i + ' index ' + index + ' changed i' + changed[i] + ' ' + changed
//  + ' forward ' + shiftForward[index] + ' back ' + shiftBack[index]) ;

}
  

 code = str ; 
// alert('Code = ' + code) ;
code = code.toUpperCase() ;
console.log(5,changed,code,word) ;
return code ;  
}

</script>

<script type="text/javascript">
  
  function factorOf(n)

  {
    factors = [] ;
    cnt = 0 ;
for (i = 1 ; i < n ;i++)
if (n % i == 0)
  {cnt = cnt + 1 ;
    factors[cnt] = i ;
  }
}
</script>

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
</script>


<script type="text/javascript">
  
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
</script>



<script type="text/javascript">
  
  function isSquare(num) {
  var sqrtNum=Math.floor(Math.sqrt(num));
   
   if (sqrtNum*sqrtNum == num)
    {square = true ; } else {square = false ;}
   
    
    return square;
}
</script>


<script type="text/javascript">
  
  function displayUnsolved()
  {
     
    var escapeCode = 0 ;
    for (var x = 1 ; x <= 10 ; x++)
    {if (solved[x] == 1) {escapeCode = escapeCode + Math.pow(2,x) ; }}

escapeCode = parseInt(escapeCode) ;

  $('#escapeKey').text(escapeCode) ;

  // alert('Escape code = ' + escapeCode + '  ' + solved) ;


  var cnt = 0 ;  
   
// alert('Showing unsolved display ' + solved);
   $('[id^=place]').show() ;
   for (var i = 1 ; i <=10 ; i++)
   {
    if (solved[i] == 1)
      {cnt = cnt + 1 ;
        $('#place'+i).attr('disabled',true).css({"background-color":"green"}) ;
       }
// replaced < 9 with < 1
     if (cnt < 9 ) {$('#place10').attr('disabled',true).css({"background-color":"red"}) ;} 
     else {$('#place10').attr('disabled',false).css({"background-color":"blue"}) ;
    $('[id^=place]').show() ; }

     // change after debugging
     
   hideAll() ;
   }  
  }
</script>

<script type="text/javascript">
  
  function decodeQ(n) 
  {
 // converts n to binary 
 var temp =  [] ;
 n = parseInt(n) ;
 var base2 = n.toString(2);
 // alert('Base 2 = ' + base2) ;
 var l = base2.length ;


 for (var i = 0 ; i <= 10 ; i++)   // zero all places 
  {temp[i] = 0 ; }



//  alert('Base 2 = ' + base2 + ' length = ' + l) ;

for (var i = 0 ; i < l ;  i++)
  {temp[i+1] = base2[i] ;}



 return temp  ;

  }
</script>

