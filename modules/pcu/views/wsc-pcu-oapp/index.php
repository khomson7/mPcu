<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\pcu\models\WscPcuOappSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ตั้งค่าจำนวนนัดคลินิก';
$this->params['breadcrumbs'][] = $this->title;
?>


<?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
        //'filterModel' => $searchModel,
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-calendar"> ตั้งค่าจำนวนนัดคลินิก</i>
               </h3>',
            'type' => GridView::TYPE_PRIMARY,
             'before' => Html::button('<i class="glyphicon glyphicon-plus"></i> เพิ่มข้อมูล', ['value' => Url::to(['wsc-pcu-oapp/create']), 'title' => 'Creating New Company', 'class' => 'showModalButton btn btn-danger']),
            'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> โหลดข้อมูลใหม่', ['/pcu/wsc-pcu-oapp/index'], ['class' => 'btn btn-info']),
            
          //  'footer' => true,
        ],
        'responsive' => true,
        'hover' => true,
        'bordered' => true,
        'striped' => true,
        
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           
           // 'hospcode',
            'date_app',
            'result',
            'remark',
            /*
             ['class' => 'yii\grid\ActionColumn',
                'template' => ' {view}',
                'contentOptions' => ['style' => 'width: 8.7%'],
                // 'visible' => Yii::$app->user->isGuest ? false : true,
                'buttons' => [
                    'view' => function ($url, $model) {
                        $t = 'index.php?r=pcu/wsc-pcu-oapp/update&id=' . $model->id;
                        return Html::button('<span class="glyphicon glyphicon-pencil"></span>', ['value' => Url::to($t), 'class' => 'showModalButton btn btn-success']);
                    },
                ], 
            ], */
                            
                          /*  ['class' => 'yii\grid\ActionColumn'],*/
        ],
    ]); ?>
</div>