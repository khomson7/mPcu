<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\DrugusageSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="drugusage-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'drugusage') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'name1') ?>

    <?= $form->field($model, 'name2') ?>

    <?= $form->field($model, 'name3') ?>

    <?php // echo $form->field($model, 'shortlist') ?>

    <?php // echo $form->field($model, 'idrlink') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'interval1') ?>

    <?php // echo $form->field($model, 'interval2') ?>

    <?php // echo $form->field($model, 'interval3') ?>

    <?php // echo $form->field($model, 'interval4') ?>

    <?php // echo $form->field($model, 'interval5') ?>

    <?php // echo $form->field($model, 'interval6') ?>

    <?php // echo $form->field($model, 'iperday') ?>

    <?php // echo $form->field($model, 'dosageform') ?>

    <?php // echo $form->field($model, 'ename1') ?>

    <?php // echo $form->field($model, 'ename2') ?>

    <?php // echo $form->field($model, 'ename3') ?>

    <?php // echo $form->field($model, 'iperdose') ?>

    <?php // echo $form->field($model, 'drugusage_guid') ?>

    <?php // echo $form->field($model, 'divide_amount') ?>

    <?php // echo $form->field($model, 'common_name') ?>

    <?php // echo $form->field($model, 'drugusage_active') ?>

    <?php // echo $form->field($model, 'opi_acpc_id') ?>

    <?php // echo $form->field($model, 'opi_usage_code') ?>

    <?php // echo $form->field($model, 'opi_dose') ?>

    <?php // echo $form->field($model, 'opi_unit_name') ?>

    <?php // echo $form->field($model, 'opi_frequency_code') ?>

    <?php // echo $form->field($model, 'opi_usage_unit_code') ?>

    <?php // echo $form->field($model, 'opi_time_code') ?>

    <?php // echo $form->field($model, 'ipt_injection_sticker_count') ?>

    <?php // echo $form->field($model, 'hos_guid') ?>

    <?php // echo $form->field($model, 'hos_guid_ext') ?>

    <?php // echo $form->field($model, 'no_disp_machine') ?>

    <?php // echo $form->field($model, 'use_opi_mode2') ?>

    <?php // echo $form->field($model, 'display_order') ?>

    <?php // echo $form->field($model, 'doctor_use') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
