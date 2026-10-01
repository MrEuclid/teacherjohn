
  function levelFinished(lev)

  {


total = parseInt($('#total').val()) ;
lev = parseInt(lev) ;
total = total + lev ;

$('#total').val(total) ;
$('[id^=score]').show() ;
$('#check').html('&#10004;');
$('#options').show() ;
$('#clear').hide() ;
$('#help').hide() ;
$('#listCalculations').hide() ;

var text = '<span>&#10035;</span>' ;
// add level times
for (var cnt = 1 ; cnt <= lev ; cnt++)
{$('#score').append(text) ;}

alert('You win at level ' + lev + '. Your score is now ' + total) ;



}
