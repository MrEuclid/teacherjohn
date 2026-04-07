
<!DOCTYPE html>
<html lang="en">
  <head>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/7.5.1/math.min.js"></script>

    
<title>MBooks v2</title>

<style type="text/css">
  body {
   background-color: lightyellow;
   color: black;
}

h1 {display: inline-block; font-size:2em; font-weight:bolder; color:green; text-align:center;}


#topLine {text-align: center;}
input {
    
    background-color: lightgreen; 
    text-align: center;
    height:3em;
    width: 8em;
    color:black;
    font-weight: bold;
    margin:1em;
   
}

#note {

 
    text-align: left;
    height:2em;
    width: 24em;
 
}

#assets,#liabilities ,#equity, #income, #expenses, #profit,#value
  {
    font-weight: bolder;
    color:green;
    font-size: 1em;

  }

.accountValue {font-size: 1.2em; font-weight: bold;}
.subLabel {font-size: 1.4em; font-weight: bolder;}

.highlight {color:white; background-color:blue;}
label {inset-block: font-weight:bolder; color:black; margin-right: 1em;}

input { background-color: lightgreen; 
    text-align: center;
    height:2em;
    width: 8em;
    color:black;
    font-weight: bold;
    margin:1em;
}

p {display:inline-block; font-size: 1em;margin:right:1em}

 .positive {color:green;}
  .negative {color:red;}
  .zeto {color:black;}

#submitAccount {background-color: lightblue; color: black; width: 4em;}

#error {color:red;}

.head {font-size: 1em; font-weight: bold;}

#transactions {color:black; font-size: 1em ;}

td,th {border-color: blue; border-width: 0.2em;}
th {text-align: center;}

#transactionStr {color:blue; font-weight: bolder; font-size: 1.2em; margin:2em;}
  </style>

  </head>
  <body>

      <div class  = "container-fluid">
     

   <a href = "makeGridv2.php" target = "_blank" >Leader board</a>
&nbsp; &nbsp; 
<p id = "person">X</p>
<p id = "gameID">0</p>
<p id = "studentID">9999</p>
<p id = "otherParty">Y</p>
<p id = "transID"></p>
  <div id = "topLine">
    <div class = "row text-center">
  <div class = "col ">
<p id = "who"></p>
<label class = "head">Assets</label>
<p id = "assets"></p>
<label class = "head">Liabilities</label>
<p id = "liabilities"></p>
<label class = "head">Capital</label>
<p id = "equity"></p>
<label class = "head">Income</label>
<p id = "income"></p>
<label class = "head">Expenses</label>
<p id = "expenses"></p>
<label class = "head">Profit</label>
<p id = "profit"></p>

<label class = "head">Cash</label>
<p id = "money">$0</p>
</div></div>



</div> <!-- topLine -->



<div class = "row text-center">
  <div class = "col-12 text-center">
   <h3 id = "header">mBooksv2 Login</h3>
</div></div>

<div class = "row text-center">
  <div class = "col">
  <img src = "images/accountsImage.jpeg">
</div></div>


<!--

<div class = "row">

  <div class = "col-12 text-center">
  <input type="text" id="student" list="studentList" placeholder="Student ID">
<datalist id="studentList"></datalist>

    <button id = "submit" class = "btn btn-info btn-lg">Register</button>
  </div></div>
-->
</div> <!--  container -->
