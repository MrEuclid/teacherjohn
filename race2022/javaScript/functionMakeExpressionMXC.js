function makeExpressionMXC(lowX,highX)

  {

// return y = mx + c

      var m = randomInteger(lowX,highX) ;
      if (m == 0 | m == 1) {m = '' ;}   // avoid writing coefficient as 1
      if (m == -1  ) {m = '-' ;}   // avoid writing coefficient as 1

      var c = randomInteger(lowX,highX) ;
      if (c == 0) {c = randomInteger(lowX,-1) ;} 
      
      if (c > 0)
      {var exp = m+'x + ' + c;}

       if (c < 0)
      {var exp = m+'x '+ c;}

    return exp ;
  }
