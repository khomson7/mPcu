<?php

use kartik\grid\GridView;
use yii\widgets\Pjax;

//use yii\grid\GridView;

$this->title = 'ข้อมูลวัคซีน';
$this->params['breadcrumbs'][] = $this->title;
?>



<?php

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
    'exportConfig' => [
        GridView::EXCEL => [],
    ],
    'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => 'ประวัติวัคซีนหน่วยบริการ',
        'before' => '<div><font color="blue">' . '(ชื่อ - สกุล: ' . $ptname . ')' . '</font></div>'
        . '<div><font color="red">' . '(ว/ด/ป เกิด: ' . $birthdate . ')' . '</font>'
        . '<font color="green">' . ' (อายุ: ' . $age_y . '  ปี )' . '</font>'
        . '<font color="blue">' . ' (ที่อยู่: ' . $address . ' ' . $village_name . ')' . '</font>'
        . '</div>',
    ],
    'responsive' => true,
    'hover' => true,
    'columns' => [
        [
            'attribute' => 'VaccineType',
            'label' => "รหัสวัคซีน",

        ],

        [
            'attribute' => 'VaccineName',
            'label' => "ชื่อวัคซีน",
            'contentOptions' => [
                'style' => 'background-color:;color:green',
            ],
        ],
        [
            'attribute' => 'Date_Serv',
            'label' => "วันที่รับบริการ",
        ],
        [
            'attribute' => 'VaccinePlace',
            'label' => "รหัสหน่วยบริการให้วัคซีน",
        ],
        [
            'attribute' => 'type',
            'label' => "CODE",
        ],

    ],
]);
?>


<?php

echo GridView::widget([
    'dataProvider' => $dataProvider2,
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
    'exportConfig' => [
        GridView::EXCEL => [],
    ],
    'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => 'ประวัติวัคซีนจากโรงพยาบาล',

    ],
    'responsive' => true,
    'hover' => true,
    'columns' => [
        [
            'attribute' => 'vaccinetype',
            'label' => "รหัสวัคซีน",

        ],

        [
            'attribute' => 'vaccinename',
            'label' => "ชื่อวัคซีน",
            'contentOptions' => [
                'style' => 'background-color:;color:green',
            ],
        ],
        [
            'attribute' => 'epi_date',
            'label' => "วันที่รับบริการ",
        ],
        [
            'attribute' => 'vaccineplace',
            'label' => "รหัสหน่วยบริการให้วัคซีน",
        ],
        [
            'attribute' => 'type',
            'label' => "CODE",
        ],

    ],
]);
?>

