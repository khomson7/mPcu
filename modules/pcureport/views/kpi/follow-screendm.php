<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use yii\helpers\Url;

$this->title = $base_data;
?>

<div class="panel panel-primary">
    <div class="panel-heading"><i class="glyphicon glyphicon-paperclip"></i> รายการ LAB ใน HOSxP_PCU </div>
    <div class="panel-body">
<?php
        echo GridView::widget([
            'dataProvider' => $data2,
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
               'attribute' => 'lab_items_name',
            'label' => "รายการ Lab",
        ],
        [
               'attribute' => 'lab_items_group_name',
            'label' => "LAB GROUP",
        ],
		[
               'attribute' => 'lab_form',
            'label' => "FORM LAB",
        ],
		 
    ]
]);
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
               'attribute' => 'PID',
            'label' => "เลขรหัสบุคคล PID",
        ],
        [
               'attribute' => 'ptname',
            'label' => "ชื่อ - สกุล",
        ],
		  [
               'attribute' => 'sex2',
            'label' => "เพศ",
        ],
		 [
               'attribute' => 'birthdate',
            'label' => "ว/ด/ป เกิด",
        ],
        
        [
               'attribute' => 'addr',
            'label' => "ที่อยู่",
        ],
        
       
         
            
    
    ]
]);
?>

