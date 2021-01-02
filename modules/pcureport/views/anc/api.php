<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use yii\helpers\Url;


?>

<div class="panel panel-primary">
    
    <div class="panel-body">
    

        <?php
        echo GridView::widget([
            'dataProvider' => $dataProvider,
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
            'label' => "ชื่อ",
        ],
        [
                'attribute' => 'lname',
            'label' => "สกุล",
        ],
    
    ]
]);
?>

