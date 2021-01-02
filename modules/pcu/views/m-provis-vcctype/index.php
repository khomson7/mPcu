<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\pcu\models\MProvisVcctypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mprovis Vcctypes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mprovis-vcctype-index">



    <?= GridView::widget([
       
        'dataProvider' => $dataProvider,
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
        //'filterModel' => $searchModel,
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-calendar"> นำเข้าตารางหลักวัคซีน คลิกที่ <span class="glyphicon glyphicon-pencil"></span>และบันทึก เพื่อนำเข้า</i>
               </h3>',
            'type' => GridView::TYPE_PRIMARY,
   
            'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> โหลดข้อมูลใหม่', ['/pcu/m-provis-vcctype/index'], ['class' => 'btn btn-info']),
           // 'footer' => true,
        ],
        'responsive' => true,
        'hover' => true,
        'bordered' => true,
        'striped' => true,
        
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'code',
            'name',
          ['class' => 'yii\grid\ActionColumn',
                'template' => ' {view}',
                'contentOptions' => ['style' => 'width: 8.7%'],
                // 'visible' => Yii::$app->user->isGuest ? false : true,
                'buttons' => [
                    'view' => function ($url, $model) {
                        $t = 'index.php?r=pcu/m-provis-vcctype/update&id=' . $model->code;
                        return Html::button('<span class="glyphicon glyphicon-pencil"></span>', ['value' => Url::to($t), 'class' => 'showModalButton btn btn-success']);
                    },
                ], 
            ],
        ],
    ]); ?>
</div>
