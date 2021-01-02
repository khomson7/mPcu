<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use hauntd\vote\widgets\Vote;
use kartik\widgets\StarRating;
use kartik\widgets\Alert;
?>

<?php
echo Alert::widget([
    'type' => Alert::TYPE_DANGER,
    'title' => 'Note',
    'titleOptions' => ['icon' => 'info-sign'],
    'body' => 'รายการที่ท่านเลือกจะถูกนำเข้าไปที่ฐานข้อมูลอัตโนมัติ'
]);
?>

<div class="mopd-allergy-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hn')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'report_date')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'agent')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'symptom')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'reporter')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'relation_level')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'note')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'allergy_type')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'display_order')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'begin_date')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'allergy_group_id')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'seriousness_id')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'allergy_result_id')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'allergy_relation_id')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'ward')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'department')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'spclty')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'entry_datetime')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'update_datetime')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'depcode')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'no_alert')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'naranjo_result_id')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'force_no_order')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'opd_allergy_alert_type_id')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'hos_guid')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'adr_preventable_score')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'preventable')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'patient_cid')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'adr_consult_dialog_id')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'opd_allergy_report_type_id')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'hos_guid_ext')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'agent_code24')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'officer_confirm')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'icode')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'opd_allergy_symtom_type_id')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'opd_allergy_id')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'cross_group_check')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'opd_allergy_source_id')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'opd_allergy_type_id')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'doctor_code')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'dosage_text')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'usage_text')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'lab_text')->hiddenInput()->label(FALSE) ?>

    <div class="form-group">
        <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
