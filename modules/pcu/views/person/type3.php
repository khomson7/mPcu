<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use frontend\models\ChospitalAmp;
use frontend\models\Csex;
use kartik\grid\GridView;
use yii\helpers\Url;

$this->title = 'ประชากร Type3';

$this->params['breadcrumbs'][] = ['label' => 'ระบบรายงานแฟ้มบุคคลบัญชี1 (person)', 'url' => ['person/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php

echo GridView::widget([
    'dataProvider' => $dataProvider,
    //'summary' => "",
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
    
    'panel' => [
        'before' => 'รายละเอียด (<b style="color: blue"></b>)',
    //'type' => \kartik\grid\GridView::TYPE_SUCCESS,
    ],
    'hover' => true,
    'exportConfig' => [
                    //    GridView::PDF => [],
                    GridView::EXCEL => []
                ],
    'columns' => [
            [
            'class' => 'yii\grid\SerialColumn',
        ]
        ,
            [
            'attribute' => 'person_id',
            'label' => "PERSON_ID",
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
            'attribute' => 'last_update',
            'label' => "วันที่ปรับปรุงข้อมูล",
        ],
        
         ['class' => 'yii\grid\ActionColumn',
                'template' => ' {view}',
                'contentOptions' => ['style' => 'width: 8.7%'],
                // 'visible' => Yii::$app->user->isGuest ? false : true,
                'buttons' => [
                    'view' => function ($url, $model) {
                        $t = 'index.php?r=pcu/person/update&id=' . $model->person_id;
                        return Html::button('<span class="glyphicon glyphicon-pencil"></span>', ['value' => Url::to($t), 'class' => 'showModalButton btn btn-success']);
                    },
                ], 
            ],
       
    ],
]);
?>