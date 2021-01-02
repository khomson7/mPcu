<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use frontend\models\ChospitalAmp;
use frontend\models\Csex;
use kartik\grid\GridView;
$this->title = 'Pramid';

$this->params['breadcrumbs'][] = ['label' => 'ระบบรายงานแฟ้มบุคคลบัญชี1 (person)', 'url' => ['person/index']];
$this->params['breadcrumbs'][] = 'รายงานจำนวนประชากรแยกตามช่วงอายุ';
?>

<?php

echo GridView::widget([
    'dataProvider' => $person,
    //'summary' => "",
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
    
    'panel' => [
        'before' => 'รายละเอียด (<b style="color: blue">จำนวนประชากรแยก Type</b>)',
    //'type' => \kartik\grid\GridView::TYPE_SUCCESS,
    ],
    'hover' => true,
    'columns' => [
            [
            'class' => 'yii\grid\SerialColumn',
        ]
        ,
            [
            'attribute' => 'type1',
            'label' => "จำนวนประชากร type1",
        ],
            [
            'attribute' => 'type2',
            'label' => "จำนวนประชากร type2",
        ],
           [
            'attribute' => 'type3',
            'label' => "จำนวนประชากร type3",
        ],
           [
            'attribute' => 'type4',
            'label' => "จำนวนประชากร type4",
        ],
        
    ]
]);
?>