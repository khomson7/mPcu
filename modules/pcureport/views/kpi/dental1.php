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
<div class='well'>
     <form method="POST">       

                เลือกช่วงวันที่
                <?php
                echo yii\jui\DatePicker::widget([
                    'name' => 'date1',
                    'value' => $date1,
                    'language' => 'th',
                    'dateFormat' => 'yyyy-MM-dd',
                    'clientOptions' => [
                        'changeMonth' => true,
                        'changeYear' => true,
                    ],
                ]);
                ?>
                ถึง:
                <?php
                echo yii\jui\DatePicker::widget([
                    'name' => 'date2',
                    'value' => $date2,
                    'language' => 'th',
                    'dateFormat' => 'yyyy-MM-dd',
                    'clientOptions' => [
                        'changeMonth' => true,
                        'changeYear' => true,
                    ]
                ]);
                ?>
                <button class='btn btn-danger'> ตกลง </button>
            </form>
        </div>

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
               'attribute' => 'vstdate',
            'label' => "ว/ด/ป รับบริการ",
        ],
        [
               'attribute' => 'hn',
            'label' => "HN",
        ],
         [
                'attribute' => 'ptname',
            'label' => "ชื่อ - สกุล",
        ],
        
        [
                'attribute' => 'age_y',
            'label' => "อายุ (ปี)",
        ],
        [
                'attribute' => 'A16',
            'label' => "Sealant per tooth, permanent #16",
        ],
        [
                'attribute' => 'B17',
            'label' => "Sealant per tooth, permanent #17",
        ],
        [
                'attribute' => 'C26',
            'label' => "Sealant per tooth, permanent #26",
        ],
        [
                'attribute' => 'D27',
            'label' => "Sealant per tooth, permanent #27",
        ],
        [
                'attribute' => 'E36',
            'label' => "Sealant per tooth, permanent #36",
        ],
        [
                'attribute' => 'F37',
            'label' => "Sealant per tooth, permanent #37",
        ],
        [
                'attribute' => 'G46',
            'label' => "Sealant per tooth, permanent #46",
        ],
        [
                'attribute' => 'H47',
            'label' => "Sealant per tooth, permanent #47",
        ],
        [
                'attribute' => 'Flu1',
            'label' => "ทาฟลูออไรด์ Flu1",
        ],
        [
                'attribute' => 'Flu2',
            'label' => "ทาฟลูออไรด์ Flu2",
        ],
            
    
    ]
]);
?>

