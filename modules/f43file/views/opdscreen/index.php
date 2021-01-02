<?php

use aryelds\sweetalert\SweetAlert;
use yii\bootstrap\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use kartik\select2\Select2;
use yii\widgets\Pjax;

$this->title = 'ปรับข้อมูล';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="panel panel-primary">
    <div class="panel-heading"><h4><i class="glyphicon glyphicon-book"> <?= $this->title ?></i></h4></div>
    <div class="panel-body">
        <div class="alert bg_col_pinkligth" role="alert">
            <div class="row">

                <div class="col-xs-5 col-sm-3 col-md-2">
                    
                    <p>
                        <?= Html::a('<i class="glyphicon glyphicon-refresh"></i> นำเข้าตัวเลือกบุหรี่ - สุรา', ['/f43file/opdscreen/smoking'], ['class' => 'btn btn-warning']) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
           