<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use yii\helpers\Url;

$this->title = $base_data;
?>

<div class="panel panel-danger">
    
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
                // 'heading' => $heading,
               'before' => '<div><font color="red">' . '(สีแดง คือ ข้อมูลไม่ถูกต้อง' . ')' . '</font></div>',
            ],
            'responsive' => true,
            'hover' => true,
           /*
            'rowOptions' => function($data) {
                    if ($data['HN'] === 'X')  {
                        return['class' => 'danger'];
                    } if ($data['PreName'] === 'X') {
                        return['class' => 'danger'];
                    }
                    if ($data['sex'] === 'X') {
                        return['class' => 'danger'];
                    }
                    if ($data['PreName'] === 'X') {
                        return['class' => 'danger'];
                    }
                     if ($data['TypeArea'] === 'X') {
                        return['class' => 'danger'];
                    }
                },*/
   
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
               'attribute' => 'cid',
            'label' => "CID",
        ],
         [
    'attribute' => 'HN',
    'label' => '<abbr title="ไม่มีการเชื่อมโยงเวชระเบียนกับบัญชี1">HN</abbr>',
    'encodeLabel' => false,
    'headerOptions' => ['style'=>'text-align:center'],
    'contentOptions' => function ($data) {
             if ($data['HN'] === 'X')  {
        return ['style' => 'background-color:red'];
             } 
    },
],
	[
    'attribute' => 'pname',
    'label' => '<abbr title="คำนำหน้าชื่อไม่ถูกต้อง">คำนำหน้าชื่อ</abbr>',
    'encodeLabel' => false,
    'headerOptions' => ['style'=>'text-align:center'],
    'contentOptions' => function ($data) {
             if ($data['PreName'] === 'X')  {
        return ['style' => 'background-color:red'];
             } 
    },
],
            [
               'attribute' => 'Name',
            'label' => "ชื่อ",
        ],
            [
               'attribute' => 'Lname',
            'label' => "สกุล",
        ],
        
       [
    'attribute' => 'sex',
    'label' => '<abbr title="เพศเป็นค่าว่าง">เพศ</abbr>',
    'encodeLabel' => false,
    'headerOptions' => ['style'=>'text-align:center'],
    'contentOptions' => function ($data) {
             if ($data['sex'] === 'X')  {
        return ['style' => 'background-color:red'];
             } 
    },
],
            [
    'attribute' => 'birth',
    'label' => '<abbr title="ข้อมูลวันเกิดว่าง">วันเกิด</abbr>',
    'encodeLabel' => false,
    'headerOptions' => ['style'=>'text-align:center'],
    'contentOptions' => function ($data) {
             if ($data['birth'] === 'X')  {
        return ['style' => 'background-color:red'];
             } 
    },
],
        
         
            
    
    ]
]);
?>

