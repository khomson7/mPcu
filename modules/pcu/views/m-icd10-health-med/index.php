<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\pcu\models\MIcd10HealthMedSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'M Icd10 Health Meds';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="micd10-health-med-index">

     <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
        //'filterModel' => $searchModel,
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-calendar"> ข้อมูลICD10แพทย์แผนไทย คลิกที่ <span class="glyphicon glyphicon-pencil"></span>และบันทึก เพื่อนำเข้า</i>
               </h3>',
            'type' => GridView::TYPE_PRIMARY,
        
        ],
        'responsive' => true,
        'hover' => true,
        'bordered' => true,
        'striped' => true,
        'filterModel' => $searchModel,
        'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

            'icd10',
            'name',
          //  'hos_guid',
         //   'hos_guid_ext',

               ['class' => 'yii\grid\ActionColumn',
                'template' => ' {view}',
                'contentOptions' => ['style' => 'width: 8.7%'],
                // 'visible' => Yii::$app->user->isGuest ? false : true,
                'buttons' => [
                    'view' => function ($url, $model) {
                        $t = 'index.php?r=pcu/m-icd10-health-med/update&id=' . $model->icd10;
                        return Html::button('<span class="glyphicon glyphicon-pencil"></span>', ['value' => Url::to($t), 'class' => 'showModalButton btn btn-success']);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
