<!DOCTYPE html>
<html lang="en">
  <head>
 
 
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
  <script type="text/x-mathjax-config">
    MathJax.Hub.Config({
      extensions: ["tex2jax.js"],
      jax: ["input/TeX","output/HTML-CSS"],
      tex2jax: {inlineMath: [["$","$"],["\\(","\\)"]]}
    });
  </script>   
  
   <script type="text/javascript">
    MathJax.Hub.Queue(["Typeset",MathJax.Hub]);
  </script>

  <script type="text/javascript" src="../javaScript/mathJax/MathJax-2.7.7/MathJax.js"></script>


    
    <title>Cross number 5x5 competition </title>

<style>

 
label {font-size: 1em; font-weight:bolder; color:blue;}

#home , #retry , #check {font-size:1.2em ; font-weight:bolder;}

  [id^=grid]{
              width: 50px ; 
              height: 50px; 
              background-color: lightblue;
              color: black;
              font-size: 1.2em;
              text-align: center;
              vertical-align: center;
              font-weight: bolder;
              margin-right: 1px;
              margin-bottom: 1px;
            }

[id^=puzzle] {
  color:black; 
  background-color:pink; 
  font-weight:bolder ; 
  font-size:1.2em; 
  width:40px ; 
  height:40px;
  margin-top:10px;
  padding-bottom:5px;

}



#message {text-align: center; font-size: 3vw; ; color:green;}

img {display: inline-block;}
input {width: 50px ; height: 50px; display: inline-block; text-align: center; text-transform:uppercase;}
	div {display: inline-block;}

.wrapper{
  margin:2px ;
 
 width: 50px ; height: 50px;
  position:relative;


}
[id^=num] {
  width:20px;
  line-height:20px;
  font-size: 10pt;
  color:black;
  
  position:absolute;

  left:0.31em;
  top:0;
}

.crossnumber {background-color:blue; color:white;}

.senior {color:yellow; background-color: green;}

.c {text-align: center;}

#lblStudentID {display: inline; font-size: 1.2em ; background-color: lightgrey;}
#studentIDNumber {background-color: lightgreen; text-align: center; width:6em; height: 2em;}
</style>

</head>

<body>


     <div class  = "container-fluid" id = "register">

      <div class = "row text-center">
        <div class = "col-">
            <p class="h2 text-center-info">Cross Number Puzzles</p>
        </div></div>

      <div class = "row text-center">
        <div class = "col- ">
          <p id = "lblStudentID">School ID</p>
          <input type="text"  id ="studentIDNumber">
          <button class = "btn btn-success" id = "login">Login</button>
        </div></div>


</div><!-- container -->

</body>
</html>