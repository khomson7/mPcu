<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\pcu\models\MPpSpecialCodeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'M Pp Special Type';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mpp-special-code-index">


   <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
        //'filterModel' => $searchModel,
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-calendar"> นำเข้าตาราง PP_SPECIAL_TYPE คลิกที่ <span class="glyphicon glyphicon-pencil"></span>และบันทึก เพื่อนำเข้า</i>
               </h3>',
            'type' => GridView::TYPE_PRIMARY,
            'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> โหลดข้อมูลใหม่', ['/pcu/m-pp-special-code/index'], ['class' => 'btn btn-info']),
        // 'footer' => true,
        ],
        'responsive' => true,
        'hover' => true,
        'bordered' => true,
        'striped' => true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'pp_special_type_id',
            'pp_special_type_name',
      //      'hos_guid',
      //      'pp_special_code',

                 ['class' => 'yii\grid\ActionColumn',
                'template' => ' {view}',
                'contentOptions' => ['style' => 'width: 8.7%'],
                // 'visible' => Yii::$app->user->isGuest ? false : true,
                'buttons' => [
                    'view' => function ($url, $model) {
                        $t = 'index.php?r=pcu/m-pp-special-type/update&id=' . $model->pp_special_type_id;
                        return Html::button('<span class="glyphicon glyphicon-pencil"></span>', ['value' => Url::to($t), 'class' => 'showModalButton btn btn-success']);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
