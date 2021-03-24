<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use yii\helpers\Url;

$this->title = $base_data;
?>

<div class="panel panel-primary">
    <div class="panel-heading"><i class="glyphicon glyphicon-paperclip"></i> <?= $base_data ?> </div>
    <div class="panel-body">


        <?php
        echo GridView::widget([
            'dataProvider' => $anc,
            'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
            'exportConfig' => [
                GridView::EXCEL => []
            ],
            'panel' => [
                'type' => GridView::TYPE_INFO,
            // 'heading' => $heading,
            // 'before' => '<div><font color="blue">' . '(' . $this->title . ')' . '</font></div>',
            ],
            'responsive' => true,
            'hover' => true,
            'columns' => [
                [
                    'class' => 'yii\grid\SerialColumn',
                ]
                ,
               [
                    'attribute' => 'cid',
                    'label' => "เลขบัตรประชาชน",
                    'contentOptions' => [
                        'style' => 'background-color:;color:white'
                    ],
                    'format' => 'raw',
                    'value' => function($data) {
                        return Html::a(Html::encode($data['cid']), 'index.php?r=pcureport/anc/fanc&user=' . $data['cid'], ['data-pjax' => 0, 'target' => "_blank"]);
                    }
                ],
                [
                    'attribute' => 'ptname',
                    'label' => "ชื่อ - สกุล",
                ],
                
            ]
        ]);
        ?>

