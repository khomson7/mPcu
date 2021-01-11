<?php

use kartik\grid\GridView;
use yii\helpers\Html;

$this->title = $base_data;
?>

<div class="panel panel-primary">
    <div class="panel-heading"><i class="glyphicon glyphicon-paperclip"></i> <?=$base_data?> </div>
    <div class="panel-body">


        <?php
echo GridView::widget([
    'dataProvider' => $dataProvider,

    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
    'exportConfig' => [
        GridView::EXCEL => [],
    ],
    'panel' => [
        'type' => GridView::TYPE_SUCCESS,
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
            'attribute' => 'ptname',
            'label' => "ชื่อ - สกุล",
            'contentOptions' => [
                'style' => 'background-color:;color:white',
            ],
            'format' => 'raw',
            'value' => function ($data) {
                return Html::a(Html::encode($data['ptname']), 'index.php?r=pcureport/apidata/epidetail&user=' . $data['cid_encode'], ['data-pjax' => 0, 'target' => "_blank"]);
            },
        ],

        [
            'attribute' => 'age_y',
            'label' => "ปี",
        ],
        [
            'attribute' => 'age_m',
            'label' => "เดือน",
        ],
        [
            'attribute' => 'age_d',
            'label' => "วัน",
        ],
        [
            'attribute' => 'list_vaccine',
            'label' => "รายการวัคซีนที่ได้รับ",
            'contentOptions' => [
                'style' => 'background-color:;color:green',
            ],
        ],
        [
            'attribute' => 'vv',
            'label' => "วัคซีนทียังไม่ได้รับ",
            'contentOptions' => [
                'style' => 'background-color:;color:red',
            ],
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
        'type' => GridView::TYPE_INFO,
        'heading' => 'หมายเหตุ : รายละเอียดชื่อวัคซีน 0-1 ปี',
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
            'attribute' => 'export_vaccine_code',
            'label' => "รหัสวัคซีน",
        ],

        [
            'attribute' => 'wbc_vaccine_name',
            'label' => "ชื่อวัคซีน",
        ],

    ],
]);
?>

