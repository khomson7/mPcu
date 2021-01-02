<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\pcu\models\MLabItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$provis_labcode = '-';
$this->title = 'ปรับรายการ Provis Labcode';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mlab-items-index">


    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
       // 'filterModel' => $searchModel,
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-calendar"> ปรับรายการ Provis Labcode คลิกที่ <span class="glyphicon glyphicon-pencil"></span>และบันทึก เพื่อปรับรายการ</i>
               </h3>',
            'type' => GridView::TYPE_PRIMARY,
            'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> โหลดข้อมูลใหม่', ['/pcu/m-lab-items/indexproviscode'], ['class' => 'btn btn-info']),
        // 'footer' => true,
        ],
        'responsive' => true,
        'hover' => true,
        'bordered' => true,
        'striped' => true,
       // 'filterModel' => $searchModel,
        'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
            'lab_items_code',
            'lab_items_name',
            
            ['attribute' => 'lab_items_name',
                'label' => 'ชื่อ Lab ของหน่วยบริการ',
                'value' => function($model) {
                    if ($model->lab_items_name != null) {
                        return $model->labitems->lab_items_name;
                    } else {
                        return $provis_labcode;
                    }
                },
                'options' => ['style' => 'width:100px;'],
                'headerOptions' => ['class' => 'text-center']
            ],
                  /*      
                ['attribute' => 'provis_labcode',
                'label' => 'Provis Labcode',
                'value' => function($model) {
                    if ($model->lab_items_code != null) {
                        return $model->labitems->provis_labcode;
                    } else {
                        return $provis_labcode;
                    }
                },
                'options' => ['style' => 'width:100px;'],
                'headerOptions' => ['class' => 'text-center']
            ],
                        */
                    'provis_labcode',    
                ['class' => 'yii\grid\ActionColumn',
                'template' => ' {view}',
                'contentOptions' => ['style' => 'width: 8.7%'],
                // 'visible' => Yii::$app->user->isGuest ? false : true,
                'buttons' => [
                    'view' => function ($url, $model) {
                        $t = 'index.php?r=pcu/m-lab-items/update&id=' . $model->lab_items_code;
                        return Html::button('<span class="glyphicon glyphicon-pencil"></span>', ['value' => Url::to($t), 'class' => 'showModalButton btn btn-success']);
                    },
                ],
            ],
        ],
    ]);
    ?>
</div>
