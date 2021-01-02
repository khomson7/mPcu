<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\Drugusage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="drugusage-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'drugusage')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shortlist')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idrlink')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'interval1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'interval2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'interval3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'interval4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'interval5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'interval6')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'iperday')->textInput() ?>

    <?= $form->field($model, 'dosageform')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ename1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ename2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ename3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'iperdose')->textInput() ?>

    <?= $form->field($model, 'drugusage_guid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'divide_amount')->textInput() ?>

    <?= $form->field($model, 'common_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'drugusage_active')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'opi_acpc_id')->textInput() ?>

    <?= $form->field($model, 'opi_usage_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'opi_dose')->textInput() ?>

    <?= $form->field($model, 'opi_unit_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'opi_frequency_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'opi_usage_unit_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'opi_time_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ipt_injection_sticker_count')->textInput() ?>

    <?= $form->field($model, 'hos_guid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hos_guid_ext')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_disp_machine')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'use_opi_mode2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'display_order')->textInput() ?>

    <?= $form->field($model, 'doctor_use')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
