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
                        <?= Html::a('<i class="fa fa-cloud"></i> ปรับโครงสร้างเพื่อนำเข้า/ส่งข้อมูล', ['/f43file/default/modify'], ['class' => 'btn btn-warning']) ?>
                    </p></div>
                
                <div class="panel panel-primary">
            <div class="text-success"><h4>ดำเนินการปรับตาราง Hosxp ดังนี้</h4></div>
            
            <div> &nbsp;&nbsp;1. ปรับเพิ่ม fild apicheck ในตาราง person ใช้ตรวจสอบการส่งข้อมูลเข้า datacenter อำเภอ</div>
            <div> &nbsp;&nbsp;2. ปรับเพิ่ม สร้างตาราง hos_smdr เก็บข้อมูลคัดกรอง บุหรี่ - สุรา จากโรงพยาบาล</div>
            </div>
                <div class="btn-group btn-group-lg" role="group" aria-label="..."><p>
                        <?= Html::a('<i class="fa fa-cloud"></i> เพิ่มคัดกรองบุหรี่-สุรา pp_special', ['/f43file/default/sm-dr-pps'], ['class' => 'btn btn-success']) ?>
                    </p></div>
                
            </div>

        </div>
    </div>
    


    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="panel panel-primary">
            <div class="text-success"><h4><?= $this->title ?> MENU</h4></div>
            <div class="panel-body"

                 <div class="alert bg_col_pinkligth" role="alert">  
               
                <div class="btn-group" role="group" aria-label="..."><p>
                        <?= Html::a('<i class="fa fa-cloud"></i> ส่งข้อมูลบุคคล', ['/f43file/default/wscperson'], ['class' => 'btn btn-success']) ?>
                    </p></div>
                <div class="btn-group btn-group-sm" role="group" aria-label="..."><p>
                        <?= Html::a('<i class="fa fa-cloud"></i> รอดำเนินการ', ['/f43file/default/'], ['class' => 'btn btn-info']) ?>
                    </p></div>
                
            </div>

        </div>
    </div>
</div>

    