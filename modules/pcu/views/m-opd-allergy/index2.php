<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\pcu\models\MOpdAllergySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mopd Allergies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mopd-allergy-index">

    <h1><?= Html::encode($this->title) ?></h1>
    

    <p>
        <?= Html::a('Create Mopd Allergy', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $person,
        
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
          [
                'class' => 'yii\grid\ActionColumn',
                'options' => ['style' => 'width:90px;'],
                'template' => '<div class="btn-group btn-group-sm" role="group" aria-label="...">{staffedit}{update}</div>',
                'buttons' => [
                    'update2' => function($url, $model, $key) {
                        return Html::a('<i class="glyphicon glyphicon-wrench"></i>', $url, ['class' => 'btn btn-info']);
                    }, // 

                    'staffedit' => function($url, $model, $key) {
                        return Html::a('<i class="glyphicon glyphicon-pencil"></i>', $url, ['class' => 'btn btn-warning']);
                    }, // 
                ]
            ],
            'patient_cid',
           // 'report_date',
           'agent',
         //   'symptom',
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
