<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\MDttm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mdttm-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'requiredtc')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'vorder')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'treatment')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'icd10')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'icd9cm')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'icode')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'opd_price1')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'opd_price2')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'opd_price3')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'ipd_price1')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'ipd_price2')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'ipd_price3')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'dttm_group_id')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'unit')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'charge_per_qty')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'active_status')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'dttm_guid')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'thai_name')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'charge_area_qty')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'dttm_subgroup_id')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'icd10tm_operation_code')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'dttm_dw_report_group_id')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'export_proced')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'dent2006_item_code')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'hos_guid')->hiddenInput()->label(FALSE) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
