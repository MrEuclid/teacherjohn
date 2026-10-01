

// swap on basis of decimal value data[i][2] for each index i
function bubbleSort(a,index,tdata) {
    var swapped;

 //  alert(' bubble ' + a + ' ' + index + ' data ' + tdata);
    do {
        swapped = false;
        for (var i=0; i < a.length-1; i++) {
            if (tdata[a[i]][index] > tdata[a[i+1]][index]) {
                var temp = a[i];
                a[i] = a[i+1];
                a[i+1] = temp;
                swapped = true;
            }
        }
    } while (swapped);

  //   alert(' bubble ' + a + ' ' + index);
 
    
    return a ;
  }




// returns a random integer between min and max
  function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

  // gcd of a,b - recursive method
   var gcd = function(a, b) {
  if (!b) {
    return a;
  }

  return gcd(b, a % b);
}



  
  function makeRandomList(l,nOptions) 

  {
  
  // receives length of the data array
 var randomList = []; // indexes of questions
var originalList = [] ; // indexes from 0 to l-1



var n = nOptions;

for (var i = 0; i < l; i++)
  {
    originalList.push(i);  // has the indexes of the data array
  }

//alert(' original list ' + originalList);
// select n randomly chosen indexes and place in randomOrder

for (var i = 0 ; i < n ; i++)    // make randomList of length equal to the number of questions required
{
  var indexLast = originalList.length-1 ;
  var position = getRandomInt(0,indexLast-1); // choose randomly from original
  randomList.push(originalList[position]); // put into the randomList

  // reduce original list by removing element at position
   originalList.splice(position, 1);
}

return randomList ;

}
    

