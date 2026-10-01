function drawGraph(eqtn1,eqtn2)

{
// alert('Graph function received ' + eqtn1 + ' and ' + eqtn2);
var eAnswer = $('#equationAnswer').val() ;

if (eqtn2 == '') {answerColor = 'white' ;} else {answerColor = 'red' ;}
if (eqtn2 == eqtn1) {answerColor = 'blue' ;} 

      var minX = parseInt($('#lowX').val()) ;
      var maxX = parseInt($('#highX').val()) ;

   // alert('Graphing rqtn 1 '+ eqtn1 + '  eqtn2 ' + eqtn2) ; 
      var stepX = 0.1 ;
      
      var n = 10 ;
   //   var correctEquation = eqtn ;  // hide later on
// uses content of input boxes
      
var layout = {


  autosize: true,
 

  // title: 'y = ' + correctEquation ,
  xaxis: {
    showgrid: true,
    zeroline: true,
    showline: true,
   // mirror: 'ticks',
    autoscale:false ,
    gridcolor: '#bdbdbd',
    tickmode: "auto" ,
    nticks: 10,
    gridwidth: 1,
    zerolinecolor: 'green',
    zerolinewidth: 4,
    linecolor: '#636363',
    title: 'X',
    
    linewidth: 6
  },
  yaxis: {
    showgrid: true,
    zeroline: true,
    showline: true,
  //  mirror: 'ticks',
    gridcolor: '#bdbdbd',
    autoscale:false,
   range: [minX*2,maxX*2],
   tickmode: "auto" ,
    nticks : 10,
    gridwidth: 1,
    zerolinecolor: 'green',
    zerolinewidth: 4,
    linecolor: '#636363',
    title: 'Y',
    linewidth: 6
  }
};    
      // this is the data for trace1 - the question
      // compile the expression once
      const expressionQuestion = document.getElementById('equationQuestion').value
      const exprQuestion = math.compile(expressionQuestion)

      // evaluate the expression repeatedly for different values of x
      const xValuesQuestion = math.range(minX, maxX, stepX).toArray()
      const yValuesQuestion = xValuesQuestion.map(function (x) {
        return exprQuestion.evaluate({x: x})
      })

      const expressionTableQuestion = document.getElementById('equationQuestion').value
      const exprTableQuestion = math.compile(expressionTableQuestion)

      // evaluate the expression repeatedly for different values of x
      const xTableQuestion = math.range(minX, maxX, 1).toArray()
      const yTableQuestion = xTableQuestion.map(function (x) {
        return exprTableQuestion.evaluate({x: x})
      })

// data for answer = trace2

      const expressionAnswer = document.getElementById('equationAnswer').value
      const exprAnswer = math.compile(expressionAnswer)

      // evaluate the expression repeatedly for different values of x
      const xValuesAnswer = math.range(minX, maxX, stepX).toArray()
      const yValuesAnswer = xValuesAnswer.map(function (x) {
        return exprAnswer.evaluate({x: x})
      })

      const expressionTableAnswer = document.getElementById('equationAnswer').value
      const exprTableAnswer = math.compile(expressionTableAnswer)

      // evaluate the expression repeatedly for different values of x
      const xTableAnswer = math.range(minX, maxX, 1).toArray()
      const yTableAnswer = xTableAnswer.map(function (x) {
        return exprTableAnswer.evaluate({x: x})
      })

for (var i = 0 ; i <= 9; i++)
{

  var xQuestion = xTableQuestion[i] ;
  var yQuestion = yTableQuestion[i] ;
    var x1 = Math.round(xQuestion * 1000) / 1000;
    var y1 = Math.round(yQuestion * 1000) / 1000;
  $('#x-'+i).text(x1) ;
  $('#y-'+i).text(y1) ;
   
}

// data for tableAnswer

for (var i = 0; i < 10 ; i++)
{

  var xAnswer = xTableAnswer[i] ;
  var yAnswer = yTableAnswer[i] ;
    var x1 = Math.round(xAnswer * 1000) / 1000;
    var y1 = Math.round(yAnswer * 1000) / 1000;
  $('#x-'+i).text(x1) ;
  $('#yA-'+i).text(y1) ;
   
}

 
var arrayLength = yValuesQuestion.length;
 for (var i = 0; i < arrayLength ; i++) {

  if (yValuesQuestion[i] > yMax){yValuesQuestion.splice(i, 1); xValuesQuestion.splice(i,1);}
  if (yValuesQuestion[i] < -yMax ){yValuesQuestion.splice(i, 1); xValuesQuestion.splice(i,1);}

}
   
    // scan for extreme values

// put into array for trace2

 
var arrayLength = yValuesAnswer.length;
 for (var i = 0; i < arrayLength ; i++) {

  if (yValuesAnswer[i] > yMax){yValuesAnswer.splice(i, 1); xValuesAnswer.splice(i,1);}
  if (yValuesAnswer[i] < -yMax ){yValuesAnswer.splice(i, 1); xValuesAnswer.splice(i,1);}

}
   

  
  //    alert(xStored  + yStored);

      // render the plot using plotly
      var question = {
        x: xValuesQuestion,
        y: yValuesQuestion,
        line: {color: 'blue'},
        type: 'scatter',
        name : 'Q',
         mode: 'markers + line',
         marker: {color: "black", size:10 ,  symbol: 'x' }
        
      }

         var yourAnswer = {
        x: xValuesAnswer,
        y: yValuesAnswer,
        line: {color: answerColor},
        type: 'scatter',
        name: 'A',
         mode: 'markers + line',
         marker: {color: "yellow", size:10 ,  symbol: 'x' }
        
      }

 
      const data = [question,yourAnswer]
     // Plotly.newPlot('myDiv', data, layout, {responsive: true});
      Plotly.react('plot', data, layout,{responsive: true,displayModeBar: false});

 

      }

  

 // document.getElementById('draw').onclick = function (event) {
 //   event.preventDefault()
 //   draw()
  

  // draw()


