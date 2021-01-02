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
            'dataProvider' => $data,
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
               'attribute' => 'pid',
            'label' => "เลขรหัสบุคคล PID",
        ],
        [
               'attribute' => 'ptname',
            'label' => "ชื่อ - สกุล",
        ],
        
        [
               'attribute' => 'vname',
            'label' => "ที่อยู่",
        ],
        
        [
               'attribute' => 'agemonth',
            'label' => "อายุเดือน",
        ],
        [
               'attribute' => 'date_start',
            'label' => "วันที่เริ่ม",
        ],
        [
               'attribute' => 'date_end',
            'label' => "วันที่สิ้นสุด",
        ],
         
            
    
    ]
]);
?>

