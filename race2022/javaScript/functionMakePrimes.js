
/*
To return an array of all prime numbers below 1000:
primeRange(1000);
*/

function makeprimes(max)
{
  var max_sqrt = Math.sqrt(max),
    range = [],
    current = 0;
  
  //generate array of numbers
  for (i = 2; i <= max; i++)
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
