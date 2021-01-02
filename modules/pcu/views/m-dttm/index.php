<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\pcu\models\MDttmSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'M Dttms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mdttm-index">



    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
        //'filterModel' => $searchModel,
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-calendar"> นำเข้าตาราง DTTM คลิกที่ <span class="glyphicon glyphicon-pencil"></span>และบันทึก เพื่อนำเข้า</i>
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
            //  'requiredtc',
            //  'vorder',
            //  'treatment',
            //'icd10',
            'icd9cm',
            //'icode',
            //'opd_price1',
            //'opd_price2',
            //'opd_price3',
            //'ipd_price1',
            //'ipd_price2',
            //'ipd_price3',
            //'dttm_group_id',
            //'unit',
            //'charge_per_qty',
            //'active_status',
            //'dttm_guid',
            //'thai_name',
            //'charge_area_qty',
            //'dttm_subgroup_id',
            //'icd10tm_operation_code',
            //'dttm_dw_report_group_id',
            //'export_proced',
            //'dent2006_item_code',
            //'hos_guid',
            ['class' => 'yii\grid\ActionColumn',
                'template' => ' {view}',
                'contentOptions' => ['style' => 'width: 8.7%'],
                // 'visible' => Yii::$app->user->isGuest ? false : true,
                'buttons' => [
                    'view' => function ($url, $model) {
                        $t = 'index.php?r=pcu/m-dttm/update&id=' . $model->code;
                        return Html::button('<span class="glyphicon glyphicon-pencil"></span>', ['value' => Url::to($t), 'class' => 'showModalButton btn btn-success']);
                    },
                ],
            ],
        ],
    ]);
    ?>
</div>
