<?php

use yii\helpers\Html;
use kartik\grid\GridView;
//use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'แลกเปลี่ยนข้อมูล';
?>

<?php
yii\bootstrap\Modal::begin([
    'headerOptions' => ['id' => 'modalHeader'],
    'id' => 'modal',
    'size' => 'modal-lg',
    'closeButton' => [
        'id'=>'close-button',
        'class'=>'close',
        'data-dismiss' =>'modal',
        ],
    //keeps from closing modal with esc key or by clicking out of the modal.
    // user must click cancel or X to close
    'clientOptions' => [
        'backdrop' => false, 'keyboard' => true
        ]
]);
echo "<div id='modalContent'> <h3> กำลังประมวลผลข้อมูลกรุณารอสักครู่ </h3> <div style='text-align:center'>" . Html::img('@web/images/ajax-loader.gif')  . "</div></div>";
yii\bootstrap\Modal::end();
?>





    <div class="row">
        <div class="col-md-6">

            <div class="row">


                <div class="panel panel-danger">
                    <div class="panel-heading"><h4>1. แลกเปลี่ยนข้อมูล</h4>
                   
                    <div class="panel panel-default">
                    <div class="panel-heading"><h4>1.1 (ประมวลผล) </h4>
                        <?= Html::button('<i class="glyphicon glyphicon-repeat"></i> รายการสั่ง Lab เรื้อรัง ', ['value' => Url::to(['default/wsc-chronic-lab']), 'title' => 'ปรับข้อมูลยา', 'class' => 'showModalButton btn btn-success']); ?>
                    
                    </div>
                    </div>
                   
               
                </div>

                

    </div>





