<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\pcu\models\MOpdAllergySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'นำเข้าข้อมูลแพ้ยา';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mopd-allergy-index">



    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
        //'filterModel' => $searchModel,
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-calendar"> นำเข้าข้อมูลแพ้ยา คลิกที่ <span class="glyphicon glyphicon-pencil"></span>และบันทึก เพื่อนำเข้า</i>
               </h3>',
            'type' => GridView::TYPE_PRIMARY,
			'before' => Html::a('<i class="glyphicon glyphicon-refresh"></i> ประมวลผลข้อมูลแพ้ยา', ['/pcu/m-opd-allergy/up-process'], ['class' => 'btn btn-danger']),
        //  'after' => Html::a('<i class="glyphicon glyphicon-pencil"></i> ปรับข้อมูล', ['/pcu/m-person-vaccine/index2'], ['class' => 'btn btn-danger']),
        //  'footer' => true,
        ],
        'responsive' => true,
        'hover' => true,
        'bordered' => true,
        'striped' => true,
        'filterModel' => $searchModel,
        'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
            'hn',
            // 'report_date',
            'agent',
            'symptom',
            //  'reporter',
            //'relation_level',
            //'note:ntext',
            //'allergy_type',
            //'display_order',
            //'begin_date',
            //'allergy_group_id',
            //'seriousness_id',
            //'allergy_result_id',
            //'allergy_relation_id',
            //'ward',
            //'department',
            //'spclty',
            //'entry_datetime',
            //'update_datetime',
            //'depcode',
            //'no_alert',
            //'naranjo_result_id',
            //'force_no_order',
            //'opd_allergy_alert_type_id',
            //'hos_guid',
            //'adr_preventable_score',
            //'preventable',
            //'patient_cid',
            //'adr_consult_dialog_id',
            //'opd_allergy_report_type_id',
            //'hos_guid_ext',
            //'agent_code24',
            //'officer_confirm',
            //'icode',
            //'opd_allergy_symtom_type_id',
            //'opd_allergy_id',
            //'cross_group_check',
            //'opd_allergy_source_id',
            //'opd_allergy_type_id',
            //'doctor_code',
            //'dosage_text:ntext',
            //'usage_text:ntext',
            //'lab_text:ntext',
            ['class' => 'yii\grid\ActionColumn',
                    'template' => ' {view}',
                'contentOptions' => ['style' => 'width: 8.7%'],
                'buttons' => [
                      'view' => function ($url, $model) {
                    
                   $t = 'index.php?r=pcu/m-opd-allergy/update&hn='.$model->hn.'&agent2='.$model->agent2;
                   return Html::button('<span class="glyphicon glyphicon-pencil"></span>', ['value' => Url::to($t), 'class' => 'showModalButton btn btn-success']);
                      },             
                ],
                ],
        /*    
          ['class' => 'yii\grid\ActionColumn',
                'template' => ' {view}',
                'contentOptions' => ['style' => 'width: 8.7%'],
                // 'visible' => Yii::$app->user->isGuest ? false : true,
                'buttons' => [
                    'view' => function ($url, $model) {
                        $t = 'index.php?r=pcu/m-opd-allergy/update&hn='.$model->id.'&agent='.$model->agent;
                        return Html::button('<span class="glyphicon glyphicon-pencil"></span>', ['value' => Url::to($t), 'class' => 'showModalButton btn btn-success']);
                    },
                ],
            ],
                            */
        ],
    ]);
    ?>
</div>
