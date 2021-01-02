<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\MOpdAllergySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mopd-allergy-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'hn') ?>

    <?= $form->field($model, 'report_date') ?>

    <?= $form->field($model, 'agent') ?>
    
    <?= $form->field($model, 'agent2') ?>

    <?= $form->field($model, 'symptom') ?>

    <?= $form->field($model, 'reporter') ?>

    <?php // echo $form->field($model, 'relation_level') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'allergy_type') ?>

    <?php // echo $form->field($model, 'display_order') ?>

    <?php // echo $form->field($model, 'begin_date') ?>

    <?php // echo $form->field($model, 'allergy_group_id') ?>

    <?php // echo $form->field($model, 'seriousness_id') ?>

    <?php // echo $form->field($model, 'allergy_result_id') ?>

    <?php // echo $form->field($model, 'allergy_relation_id') ?>

    <?php // echo $form->field($model, 'ward') ?>

    <?php // echo $form->field($model, 'department') ?>

    <?php // echo $form->field($model, 'spclty') ?>

    <?php // echo $form->field($model, 'entry_datetime') ?>

    <?php // echo $form->field($model, 'update_datetime') ?>

    <?php // echo $form->field($model, 'depcode') ?>

    <?php // echo $form->field($model, 'no_alert') ?>

    <?php // echo $form->field($model, 'naranjo_result_id') ?>

    <?php // echo $form->field($model, 'force_no_order') ?>

    <?php // echo $form->field($model, 'opd_allergy_alert_type_id') ?>

    <?php // echo $form->field($model, 'hos_guid') ?>

    <?php // echo $form->field($model, 'adr_preventable_score') ?>

    <?php // echo $form->field($model, 'preventable') ?>

    <?php // echo $form->field($model, 'patient_cid') ?>

    <?php // echo $form->field($model, 'adr_consult_dialog_id') ?>

    <?php // echo $form->field($model, 'opd_allergy_report_type_id') ?>

    <?php // echo $form->field($model, 'hos_guid_ext') ?>

    <?php // echo $form->field($model, 'agent_code24') ?>

    <?php // echo $form->field($model, 'officer_confirm') ?>

    <?php // echo $form->field($model, 'icode') ?>

    <?php // echo $form->field($model, 'opd_allergy_symtom_type_id') ?>

    <?php // echo $form->field($model, 'opd_allergy_id') ?>

    <?php // echo $form->field($model, 'cross_group_check') ?>

    <?php // echo $form->field($model, 'opd_allergy_source_id') ?>

    <?php // echo $form->field($model, 'opd_allergy_type_id') ?>

    <?php // echo $form->field($model, 'doctor_code') ?>

    <?php // echo $form->field($model, 'dosage_text') ?>

    <?php // echo $form->field($model, 'usage_text') ?>

    <?php // echo $form->field($model, 'lab_text') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
