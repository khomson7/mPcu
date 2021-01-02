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
        
        [
               'attribute' => 'age_screen',
            'label' => "อายุเดือน",
        ],
        [
               'attribute' => 'first_to_screen2',
            'label' => "วันที่เริ่มให้ได้",
        ],
        [
               'attribute' => 'end_to_screen2',
            'label' => "วันที่สิ้นสุด",
        ],
         
            
    
    ]
]);
?>

