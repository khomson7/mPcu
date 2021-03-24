<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use yii\helpers\Url;

$this->title = $base_data;
?>

<div class="panel panel-danger">
    <div class="panel-heading"><i class="glyphicon glyphicon-paperclip"></i> <?=  Html::a(Html::encode($base_data), $hdc_link, ['data-pjax' => 0, 'target' => "_blank"]); ?> <=คลิ๊กเพื่อไปที่ HDC </div>
    <div class="panel-body">

        <?php
        echo GridView::widget([
            'dataProvider' => $data,
            'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
            'exportConfig' => [
                GridView::EXCEL => []
            ],
            'panel' => [
                'type' => GridView::TYPE_PRIMARY,
                //  'heading' => '111',
                'before' => '<div><font color="blue">' . '(ข้อมูลวันที่ ' . $tdate . ')' . '</font></div>',
            ],
            'responsive' => true,
            'hover' => true,
            'columns' => [
                [
                    'class' => 'yii\grid\SerialColumn',
                ]
                ,
                [
                    'attribute' => 'PID',
                    'label' => "PID",
                ],
                [
                    'attribute' => 'NAME',
                    'label' => "ชื่อ",
                ],
                [
                    'attribute' => 'LNAME',
                    'label' => "สกุล",
                ],
                [
                    'attribute' => 'birthdate',
                    'label' => "ว/ด/ป เกิด",
                ],
                [
                    'attribute' => 'age_y',
                    'label' => "อายุ",
                ],
                [
                    'attribute' => 'after_birth',
                    'label' => "ว/ด/ป ที่รับ dT ครั้งล่าสุด",
                ],
                [
                    'attribute' => 'total_befor_birth',
                    'label' => "จำนวนครั้งที่เคยได้รับวัคซีน dT",
                ],
                [
                    'attribute' => 'vaccine_date',
                    'label' => "ว/ด/ป ที่ควรได้รับวัคซีนเข็มแรก",
                ],
                [
                    'attribute' => 'vaccine_date2',
                    'label' => "ว/ด/ป ที่ควรได้รับวัคซีนเข็มที่2",
                ],
                [
                    'attribute' => 'vaccine_date3',
                    'label' => "ว/ด/ป ที่ควรได้รับวัคซีนเข็มที่3",
                ],
            ]
        ]);
        ?>

