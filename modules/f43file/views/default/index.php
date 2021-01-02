<?php

use yii\bootstrap\Progress;
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */

$this->title = 'จัดการข้อมูล';


?>

<div id="statusMsg" >
    

<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="panel panel-primary">
           
            <div class="panel-body"

                 <div class="alert bg_col_pinkligth" role="alert">  
                <div class="btn-group btn-group-lg" role="group" aria-label="..."><p>
                        <?= Html::a('<i class="fa fa-cloud"></i> ปรับโครงสร้างกรณีโหลด version ใหม่', ['/f43file/default/wpa'], ['class' => 'btn btn-warning']) ?>
                    </p></div>
                
                <div class="panel panel-primary">
            <div class="text-success"><h4>ดำเนินการปรับตาราง Hosxp ดังนี้</h4></div>
            
            <div> &nbsp;&nbsp;1. ปรับเพิ่ม fild หรือ ตารางในโปรแกรม hosxp_pcu เพื่อการดึงรายงาน</div>
            
            </div>
               
                
            </div>

        </div>
    </div>
    


  
</div>

    