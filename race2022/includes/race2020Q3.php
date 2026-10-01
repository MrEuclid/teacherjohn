

  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" id="myBtn3">Open Modal</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal3" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

  <script>
$(document).ready(function(){
  $("#myBtn3").click(function(){
    $("#myModal3").modal();
  });
});
</script>


<div class = "row">
     <div class="col-sm-12 c">
<h1>Make the lights green</h1>
</div></div>
<input type = "text" hidden = "true" id = "level"> <!-- record level -->
<input type = "text" hidden = "true" id = "total"> <!-- record total -->
<?php $op = 'a + b + ab' ; ?>

<div id = "example">


<?php include "../includes/exampleX+.html" ; ?>
</div> <!-- example -->


<div class = "row">
     <div class="col-sm-12 c">
<div id = "grid">
  <?php 
// new one to allow for correct end button

  include "includes/grid2x2.php" ; ?>
</div> <!-- grid -->
</div></div>

<div class = "row">
     <div class="col-sm-12 c">     
        <button id = "go3" class="btn btn-success rectangle" >Go</button>
</div></div>




<div class = "row">
     <div class="col-sm-12 c">
 <p>
 <div  id = "message" >
  <ul>
 <li>Put numbers in each row so that the sum of the numbers plus the product of the numbers make the number at the end of the row.</li>
 
 <li>Put numbers in each column so that the sum of the numbers plus the product of the numbers make the number at the top of the column.</li>
 <li>You can only use <strong>whole numbers</strong> -  1,2,3,...</li>
 
  <li> Use the <strong>?</strong> button to check you answer.</li>
</ul>


</ul>
</p>
</div> <!-- message -->

    </div></div>


<div class = "row">
     <div class="col-sm-12 c">
 <button id = "help" class="btn btn-info rectangle" >Calculations</button>
    </div></div>

  <div class = "row">
     <div class="col-sm-12 c">
 <p id = "listCalculations" ></p></button>
    </div></div>
