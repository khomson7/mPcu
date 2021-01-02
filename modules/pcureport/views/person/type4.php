<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use frontend\models\ChospitalAmp;
use frontend\models\Csex;
use kartik\grid\GridView;
$this->title = 'ประชากร Type4';

$this->params['breadcrumbs'][] = ['label' => 'ระบบรายงานแฟ้มบุคคลบัญชี1 (person)', 'url' => ['person/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php

echo GridView::widget([
    'dataProvider' => $person,
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
        
    ]
]);
?>