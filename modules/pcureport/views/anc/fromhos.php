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
                'attribute' => 'ptname',
            'label' => "ชื่อ - สกุล",
        ],
		[
               'attribute' => 'addrpart',
            'label' => "บ้านเลขที่",
        ],
        [
               'attribute' => 'moopart',
            'label' => "หมู่",
        ],
       
        [
                'attribute' => 'full_name',
            'label' => "ตำบล",
        ],
         [
                'attribute' => 'birthdate',
            'label' => "ว/ด/ป เกิด",
        ],
		
           [
                'attribute' => 'lmp',
            'label' => "LMP",
        ],
  [
                'attribute' => 'edc',
            'label' => "EDC",
        ],		
    
    ]
]);
?>

