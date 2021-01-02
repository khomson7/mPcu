<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'หน้าหลัก';
?>


 
 <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <!--<li data-target="#carousel-example-generic" data-slide-to="1"></li> -->
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="./images/pic2.jpg" alt="Mountain View" style="width:1024px;height:500px" alt="">
      <div class="carousel-caption">
          <p><?php echo Html::a('<h2 class="panel-title">
                  <button type="button" class="btn btn-danger btn-lg">บันทึกรายการยา</button></h3>',['/pcu/mdrugitems/index'])?></p>
      </div>
    </div>
    <div class="item">
      <img src="./images/pic2.jpg" alt="Mountain View" style="width:1024px;height:500px" alt="ทดสอบการเขียน 2">
      <div class="carousel-caption">
       ทดสอบการเขียน 2
      </div>
    </div>
   
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function () {
        $('#myModal').model('show');
    });

</script>

</div>