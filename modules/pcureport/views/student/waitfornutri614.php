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
            'attribute' => 'person_id',
            'label' => "PID",
            
        ],
        
        
            [
            'attribute' => 'pname',
            'label' => "คำนำหน้า",
        ],
            [
            'attribute' => 'fname',
            'label' => "ชื่อ",
        ],
             [
            'attribute' => 'lname',
            'label' => "นามสกุล",
        ],
        [
            'attribute' => 'age_',
                'label' => "อายุ(ปี)",
        ],
        [
            'attribute' => 'school_name',
            'label' => "ชื่อโรงเรียน",
        ],
          
         [
            'attribute' => 'village_school_class_name',
            'label' => "ชั้นเรียน",
        ],
        
        [
            'attribute' => 'screen_date',
            'label' => "วันที่คัดกรอง",
        ],
            
    
    ]
]);
?>

