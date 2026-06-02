
<!DOCTYPE html>
<html lang="en">

  <head>
 
    <meta charset="utf-8">


  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../javaScript/bootStrap/bootstrap-3.3.7-dist/css/bootstrap.min.css">
  <script src="../javaScript/jQuery/jquery-3.3.1.min.js"></script>
  <script src="../javaScript/bootStrap/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    


<link rel="stylesheet" href="../css/templeStyles.css">
 


    
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>Dashboard</title>
<style type="text/css">

label {font-weight:bolder ; font-size:12pt;}

input {
  background-color:lightblue; 
  color:black; 
  font-size:14pt ; 
  font-weight:bolder ;
  text-align:center ;
  }

[id^=shop] {

  border-color: red ; 
  border-width: 2pt ; 
  font-weight: bolder ;
  color:white;
  margin: 20px ;
  background-color: green ;
  font-size: 14pt ;
  display: inline-block ;
  width:120px ;
  height:80px ;

  }

#imgPhone, #imgAlien {
  display: inline-block; 
  width:50px ; 
  height:50px ;
  margin: 20px ;

}

#saucer {width:250px ; 
  height:150px ;}
  
 </style>

  </head>
  <body>

  
    <div class  = "container-fluid">
      
      <div class = "row">
        <div class = "col-md-12 c">
<h1>Teacher Dashboard</h1>
<label>Round</label>
<br>
<input type = "text" id = "currentRound"><input type = "text" id = "alienCount">
</div></div>

<div class = "row">
        <div class = "col-md-12 c">
        <label>Shop data</label>
<p id = "checkShops"></p>
</div></div>
      <div class = "row">
        <div class = "col-md-12 c">
<button id = "initialiseTables">Initialise</button>
<button id = "updateShops">Update shops</button>
<button id = "aliens">Aliens land</button>
<button id = "nextRound">Next round </button> <!-- update sales and set new round -->
</div></div>

<div id = "market">
<div class = "row">
<div class = "col-md-12 c">
  <button id = "shop0"></button>
   <button id = "shop1"></button>
   <button id = "shop2"></button>
   <button id = "shop3"></button>
</div></div>

<div class = "row">
<div class = "col-md-12 c">
  <button id = "shop4"></button>
   <button id = "shop5"></button>
   <button id = "shop6"></button>
   <button id = "shop7"></button>
</div></div>

<div class = "row">
<div class = "col-md-12 c">
  <button id = "shop8"></button>
   <button id = "shop9"></button>
   <button id = "shop10"></button>
   <button id = "shop11"> </button>
</div></div>

</div> <!-- shops -->


  <div class = "col-md-12 c">
    <h2>Statistics</h2>
     <div id = "statistcs"></div> <!-- stats -->
        </div></div>

  <div class = "row">
  <div class = "col-sm-12 c">
    <div id = "graphics">
      
<div class = "row">
  <div class = "col-md-12 c">
<img src = "images/flyingSaucer.png" id = "saucer">
</div></div>

<div class = "row">
  <div class = "col-md-12 c">
   <img id = "imgPhone" src = "images/iphone.png">
   <img id = "imgPhone" src = "images/oppo.jpeg">
   <img id = "imgPhone" src = "images/nokia.jpg">
  </div></div>

<div class = "row">
  <div class = "col-md-12 c">
   <img id = "imgAlien" src = "images/alien.png">
   <img id = "imgAlien" src = "images/alien.png">
   <img id = "imgAlien" src = "images/alien.png">
  </div></div>

    </div>
  </div></div> 

  <div class = "row">
  <div class = "col-md-12 c">
    <p id = "results"></p>
</div></div>
  
</div> <!-- container -->

</body>
</html>

<script>
function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}
  </script>


<script type="text/javascript">

  
   $(document).ready(function(){

  //  alert("page loaded");

 // get update of teams and whether they have all set prices for this round
 console.log("Getting round") ;
 // need to get roundNUmber as well ;

 $.ajax({    
        type: "POST",
        url: "getRoundDashboard.php",             
        dataType: "json",   //expect html to be returned   
                 
        success: function(response){                    
        currentRound = response['currentRound'] ;
        let alienArrivals = response['alienArrivals'] ;
        console.log("Round data", currentRound,alienArrivals) ;
        $('#currentRound').val(currentRound);
        $('#alienCount').val(alienArrivals) ;
        
        }  // success

 }); // ajax

 // myTimer = setInterval(markShops,5000)

 // stop with clearInterval(myTimer)
   
setInterval(function(){//setInterval() method execute on every interval until called clearInterval()
  currentRound = $('#currentRound').val() ;

 $("[id^=shop]").css('background-color', 'blue');
// onsole.log("round data now ",currentRound) ;
  $.ajax({    
        type: "POST",
        url: "getShopData.php",             
        dataType: "json",   //expect html to be returned   
        data: {currentRound: currentRound}  , 
        success: function(response){                    
    
      //  console.log("Response received",currentRound,response) ;
        $('#checkShops').empty() ;
        for (let i = 0 ; i < response.length ;i++)
          {
            teamID = response[i]['teamID'] ;
            sellingPrice = response[i]['sellingPrice'] ;
            $('#checkShops').append(teamID + ' ' + sellingPrice + '<br>'); 
       //     console.log("shops",teamID) ;
            // colour shop and add price
            $("button:contains('" + teamID + "')").css('background-color', 'red');
          }
        
        }  // success

 }); // ajax

 console.log("Getting round") ;
 // need to get roundNUmber as well ;

 $.ajax({    
        type: "POST",
        url: "getRoundDashboard.php",             
        dataType: "json",   //expect html to be returned   
                 
        success: function(response){                    
        currentRound = response['currentRound'] ;
        let alienArrivals = response['alienArrivals'] ;
     //   console.log("Round data", currentRound,alienArrivals) ;
        $('#currentRound').val(currentRound);
        $('#alienCount').val(alienArrivals) ;
        
        }  // success

 }); // ajax

  //load() method fetch data from getRound.php page
 }, 5000); // set to 5 seconds

 
shops = [] ;
for (let i = 0 ; i < 12 ; i++)
{
  let data = [0,0,0,0];  // price,stock, sold, teamID
  shops[i] = data ;
}
console.log("Initialised shops",shops) ;


     $.ajax({    //loads shop names
        type: "POST",
       url: "loadShopNames.php",             
        dataType: "json",   // using JSON data  
                 
        success: function(shopNames){                    
      //   alert('Student is  ' + shopNames) ;

        for (let i = 0 ; i < shopNames.length ; i++)
        {
          let prefix = parseInt(shopNames[i][0]);
          $('#shop'+ i).text(prefix+'*'+i+'*' + shopNames[i][1]) ;
        }
        }  // success

 }); // ajax



})  // function

</script>

<script type="text/javascript">
  
  function numberWithCommas(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}
</script>

<script>

function makeAliens()
{


 // get number of aliens
 let n = $('#alienCount').val() ;
 let a = [] ;
 for (let i = 0 ; i < n ; i++)
  {  
  let  category =  getRandomInt(6,10); // buying preference
  let  priceLimit = 100*category ;
  let  boughtAt = 0 ; // supplier

    a[i] = [priceLimit,boughtAt] ;
  }
   return a; 
}
  </script>


<script type="text/javascript">
  
   $(document).ready(function(){
     $('#updateShops').on('click', function(){

       // zero the array length to clear it
      shops.length = 0 ;
      shops = [] ;
      for (let i = 0 ; i < 12 ; i++)
      {
        
          shops[i] = [0,0,0,0] ;
        
      }

      copyShops = [...shops];
      console.log("Clone of shops ",copyShops);
      //  alert('Updating shop detaila' + shops[2]) ;
 //    provide selling price and stock 
        roundNumber = $('#currentRound').val() ;
      alert("Round number = " + roundNumber) ;
        console.log("Updating shops",shops) ;
      $.ajax({    //loads shop names
        type: "POST",
        url: "loadShopPricesStock.php",             
        dataType: "json",   //expect html to be returned   
        data:{roundNumber:roundNumber},
                 
        success: function(shopPriceStock){                    
        console.log("prices and stock",roundNumber,shopPriceStock) ;

        for (let i = 0 ; i < shopPriceStock.length ; i++)
        {
          $('#shop'+ i).append('<br>$'+shopPriceStock[i]['sellingPrice'] + '<br>' + shopPriceStock[i]['stock']) ;
          let data = [shopPriceStock[i]['sellingPrice'],shopPriceStock[i]['stock'],0,shopPriceStock[i]['teamID'],]
         shops[i][0] = shopPriceStock[i]['sellingPrice'] ; // price
         shops[i][1] = shopPriceStock[i]['stock'] ; // stock
         shops[i][2] = 0 ; // sold to aliens
         shops[i][3] = shopPriceStock[i]['teamID'] ; 

         shops[i] = data ;
         console.log("Loading shops",i,data);

        }
     
        }  // success

 }); // ajax

 console.log("Shops before aliens", shops) ;
     })
   })

 </script>


 <script type="text/javascript">
  
   $(document).ready(function(){
     $('#initialiseTables').on('click', function(){


 var r = confirm("Clear all tables!");
  if (r == true) {
    txt = "Initialising tables for a new game";
  } else {
    txt = "You pressed Cancel!";
  }

if (r == true)
{
     $.ajax({    //create an ajax request to saveResponse.php
        type: "POST",
       url: "initialiseTables.php",             
        dataType: "json",   //expect html to be returned   
                 
        success: function(response){                    
     //      alert('Student is  ' + response) ;

    alert('Tables ckeared') ;
        }  // success

 }); // ajax
}

else {alert('Tables unchanged') ;}

     })
   })

 </script>


<script>

function cheapestWithStock(priceLimit)  // must be <= priceLimit
  
  {
    let min = 99999 ;
    let places = [] ;
    let sortedPrices = [] ;

    for (let i = 0 ; i < shops.length ; i++)
    {
      sortedPrices[i] = [i,shops[i][0],shops[i][1]] ; // location, price, stock
    }

  //WITH 2nd COLUMN
sortedPrices = sortedPrices.sort(function(a,b) {
    return a[1] - b[1];
});
console.log("Sorted prices", sortedPrices) ;
/*
//WITH 3rd COLUMN
arr = arr.sort(function(a,b) {
    return a[2] - b[2];
});

*/
 var n = 0 ;
 places.length = 0 ;
 found = false ;
// look for the lowest price with stock less than the price limit
while (n < sortedPrices.length && !found)  /// looking for first one with stock at an affordable price
    {
      
      var location = sortedPrices[n][0] ;  // location
      var price   = sortedPrices[n][1] ; //  price
      var stock   = sortedPrices[n][2] ; //  stock

      if (stock > 0 && price <= priceLimit)
        {found = true ;}
    
     console.log("Checking best deal",n,sortedPrices[n]);
     n++ ;
     // need to find the lowest priced shop, with stock and at or below the price limit
    }
  if (found)  
  {
  usedLocation = sortedPrices[n-1][0]   ;  
  trueStock = sortedPrices[n-1][2] ;
  bestPrice = sortedPrices[n-1][1] ;
  places.push(usedLocation) ;
  console.log("Pushing to places ", usedLocation,places) ;


  // now look for any others at the same price

  for (let i = 0 ; i < sortedPrices.length ; i++)
{
  let location = sortedPrices[i][0] ;  // location
  let price   = sortedPrices[i][1] ; //  price
  let stock   = sortedPrices[i][2] ; //  stock
  if (price <= priceLimit && stock > 0  && location != usedLocation  && price == bestPrice)
    {places.push(location) ;
    console.log("pushing others to places ",location,"stock",stock,"@",price) ; }
}
  } // found 
console.log("Places = ",places) ;
  return places ;
  
    }
  </script>  

<script type="text/javascript">
  
  $(document).ready(function(){
    $('#aliens').on('click', function(){   
      
    //  alert('The aliens ahve landed!  ') ;


    
    aliens = [] ;
    aliens = makeAliens() ;
    originalAliens = JSON.parse(JSON.stringify(aliens)); // deep clone doe n dimensional arrays
// console.log("Aliens",aliens);
//shops = makeShops() ;

//shops= [] ; // loaded when they are updated



console.log("Aliens",originalAliens) ;
originalShops = JSON.parse(JSON.stringify(shops)); // deep clone doe n dimensional arrays
console.log("Original shops",originalShops) ;

for (let i = 0 ; i < shops.length ; i++)
  {
    $('#original').append(i + " - " + shops[i][0] + " - " + shops[i][1] + " - " + shops[i][2]  + "<br>") ;
  }
// loop through aliens visiting shops  

cheapShops = [] ;
for (let i = 0 ; i < aliens.length;i++)
// for (let i = 0 ; i < 10 ;i++)
{
  //  let min = minPrice(shops);
 
    cheapShops.length = 0  ;
    cheapShops = cheapestWithStock(aliens[i][0]); // find cheapest places with stock for current alien
  //  alert(i + 'price limit ' + aliens[i][0]) ;
    console.log(i,"price limit",aliens[i][0], "Cheap shop ", cheapShops);
    console.log("Alien",i,aliens[i][0]) ;
    $('#results').append("Alien " + i + " - level " + aliens[i][0] +  " buys from... " ) ;
    let nCheap = cheapShops.length -1 ;
    if (cheapShops.length ==  0)
      {
        console.log("Couldn't find an affordable phone"); 
        $('#results').append(" could not buy a phone at that price level.<br>") ;
      }
  else 
      {
        console.log(nCheap,"shops available",cheapShops) ;
        let location = getRandomInt(0,nCheap) ;
        let shop = cheapShops[location] ;
        let currentStock = shops[shop][2] ;
        console.log("Shopping at ","location = ",location," = shop",shop,shops[shop]) ;
        shops[shop][2] = shops[shop][2] + 1 ; // add 1 to sold 
        shops[shop][1] = shops[shop][1] - 1 ; // reduce stock by 1 
        let t = $('#shop' + shop).text() ;
        $('#shop' + shop).html('$' + shops[shop][0] + '<br>' + shops[shop][1] + ' -- > ' + shops[shop][2]);
        aliens[i][1] = shop; // place of purchase
        $('#results').append(shop + ' @price level ' + shops[shop][0] + "<br>") ;
        console.log("Shop now has",shops[shop][1],shops[shop][2]) ;
        console.log(shop,"Updated",shops[shop]) ;
      }
  
} // for

for (let i = 0 ; i < shops.length ; i++)
  {
    $('#new').append(i + " - " + shops[i][3] + " - " + shops[i][0] + " - " + shops[i][1]  + "<br>") ;
  }


// write shops to the phoneSales table
console.log("New", shops);


console.log("purchases", aliens);

    })
  })
</script>


<script type="text/javascript">
  
   $(document).ready(function(){
     $('#nextRound').on('click', function(){
      var roundNumber = $('#currentRound').val() ;
      console.log("moving on ",shops,roundNumber) ;
       // write the sales table and update rounds and aliens numbers

       $.ajax({    //create an ajax request to saveResponse.php
        type: "POST",
        url: "updateSales.php",             
        dataType: "json",   //expect html to be returned   
        data: {roundNumber:roundNumber,shops:shops}    , 
        success: function(response){                    
     //      alert('Student is  ' + response) ;

      
        console.log("New round",response) ;

        $('#currentRound').val(response[0]) ; // update round
        $('#alienCount').val(response[1]) ; // update round

        }  // success
        

 }); // ajax 

     })
   })

   </script>






