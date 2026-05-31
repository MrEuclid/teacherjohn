<!DOCTYPE html>

<html lang="en">
  <head>
    <title>Factor game Bootstrap and javascript</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="javaScript/bootStrap/bootstrap-3.3.7-dist/css/bootstrap.min.css">
  <script src="javaScript/jQuery/jquery-3.3.1.min.js"></script>
  <script src="javaScript/bootStrap/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
 
</head>

<style type="text/css">

.c {margin-left: auto; margin-right: auto;}

 #total , #maxPossible, #gameStatus  {background-color: blue ; 
  color : white; font-size: 24pt ;}

#myChoices {background-color: yellow ; 
  color : black; font-size: 16pt ;}


button.num {
    
    border: none;
    
    padding: 10px;
    width: 60px ;
    height: 60px ; 
    text-align: center;
    text-decoration: none;
    display: inline-block;
    
    margin: 4px 2px;
    border-radius : 12px;
}



button.smaller {padding: 2px ; width: 60px ; margin-bottom: 5px ;margin-top: 2px;}
button.largerer {padding: 2px ; width: 240px ; margin-bottom: 5px ;margin-top: 2px;}

 li {font-size: 14pt ; color: blue ; font-family: sans-serif;} 
</style>


<body>
  <div class = "container-fluid">
<div class = "row">
  <div class = "col-sm-1">

   <a href="indexSecondaryMaths.php" 
   class="btn btn-info btn-sm">
          <span class="glyphicon glyphicon-arrow-left"></span>
        </a>

     <a href="factorGameJSv2.php" class="btn btn-info btn-sm">
          <span class="glyphicon glyphicon-repeat"></span>
        </a>
     
    </div>

<div class = "col-sm-10">

<h3>The Factor Game v2.2
  <select id = "level">
       <option value="" disabled selected>Select level</option>
    
    <option value="6">Easy</option>
    <option value="12">Medium</option>
    <option value="18">Hard</option>
    <option value="24">Difficult</option>
    <option value="30">Very difficult</option>
    <option value="36">Extreme</option>
    
</select>
  

</h3>


</div>
</span>
</div> <!-- row -->

<div class = "row">
  <div class = "col-sm-8 col-sm-offset-2">
<button id = "howMany"></button>

<button id = "gameStatus" >Waiting</button>
<button id = "total">Score</button>
<button id = "maxPossible">Maximum</button>

<button id = "myChoices"> * </button>

</div></div>


<div class = "row">
  <div class = "col-sm-8 col-sm-offset-2">
 
    <p id = "numberBalls"></p>
 
  </div>
</div>
<div class = "row">
  <div class = "col-sm-8 col-sm-offset-2">
  <h1>Rules</h1>
  <br>
  <strong>
  <ul>
    <li>
      You can only choose numbers which still have factors
    </li>
    <li>
      The numbers you can choose are green
    </li>
    <li>
      When you choose a number it is added to your score
    </li>
    <li>
      When you choose a number its factors are removed
    </li>
    <li>
      If you get the maximum possible score you win
    </li>
  </ul>
</strong>
  </div>
</div>

</div> <!-- container -->
  
</body>
</html>


<script type="text/javascript">
 $(document).ready(function(){
     $('#level').on('change', function(){
    
 level = $(this).val() ;
 // alert('Selected ' + level) ;
 $('p#numberBalls').text('') ; // clear existing numbers
 $('#gameStatus').text('Playing') ;
 $('#total').text('0') ;
 $('#myChoices').text(' * ') ;



  
                $.ajax({
                    url:"factorv2Scripts.php",
                    type:"GET",
                    data:{level:level},
                    success:function(data){
                        $("#howMany").html(data);
                    //  alert('q ' + q) ;
                    },
                    error: function(xhr, textStatus, errorThrown){
                        alert('request failed');
                    }
                });
            });
        });


</script>

<script type="text/javascript">
  $('#howMany').hide() ;
  $('#maxScore').hide() ;
  $('#maxPossible').hide() ;
</script>
