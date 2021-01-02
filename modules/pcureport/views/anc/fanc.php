<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;

//use yii\grid\GridView;

$this->title = 'ข้อมูลฝากครรภ์';
$this->params['breadcrumbs'][] = $this->title;
?>


<?php

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
    'exportConfig' => [
        GridView::EXCEL => []
    ],
    'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        //  'heading' => '111',
        'before' => '<div><font color="blue">' . '(ชื่อ - สกุล: ' . $ptname . ')' . '</font></div>'
        . '<div><font color="red">' . '(ว/ด/ป เกิด: ' . $birthdate . ')'. '</font>' 
        . '<font color="green">'. ' (อายุ: ' . $age_y . '  ปี )' . '</font>'
        . '<font color="blue">'. ' (ที่อยู่: ' . $address .' '. $village_name .')' . '</font>'
        . '</div>',
    ],
    'responsive' => true,
    'hover' => true,
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn',
        ]
        ,
        [
            'attribute' => 'anc_service_date2',
            'label' => "วันที่รับบริการ",
        ],
        [
            'attribute' => 'pa_week',
            'label' => "อายุครรภ์",
        ],
        [
            'attribute' => 'preg_no',
            'label' => "ครรภ์ที่",
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
         

