<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\pcu\models\MPersonVaccineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mperson Vaccines';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mperson-vaccine-index">



    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
        //'filterModel' => $searchModel,
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-calendar"> ข้อมูลวัคซีนบุคคล(one stop service) คลิกที่ <span class="glyphicon glyphicon-pencil"></span>และบันทึก เพื่อนำเข้า</i>
               </h3>',
            'type' => GridView::TYPE_PRIMARY,
            'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> โหลดข้อมูลใหม่', ['/pcu/m-person-vaccine/index2'], ['class' => 'btn btn-info']),
          //  'footer' => true,
        ],
        'responsive' => true,
        'hover' => true,
        'bordered' => true,
        'striped' => true,
        'filterModel' => $searchModel,
        'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
      //      'person_vaccine_id',
            'vaccine_name',
            'vaccine_code',
          //  'vaccine_group',
            'export_vaccine_code',
            //'hos_guid',
            //'combine_vaccine',
            //'icode',
             ['class' => 'yii\grid\ActionColumn',
                'template' => ' {view}',
                'contentOptions' => ['style' => 'width: 8.7%'],
                // 'visible' => Yii::$app->user->isGuest ? false : true,
                'buttons' => [
                    'view' => function ($url, $model) {
                        $t = 'index.php?r=pcu/m-person-vaccine/update2&id=' . $model->person_vaccine_id;
                        return Html::button('<span class="glyphicon glyphicon-pencil"></span>', ['value' => Url::to($t), 'class' => 'showModalButton btn btn-success']);
                    },
                ], 
            ],
        ],
    ]);
    ?>
</div>
