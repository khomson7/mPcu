<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\MDttmSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mdttm-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'requiredtc') ?>

    <?= $form->field($model, 'vorder') ?>

    <?= $form->field($model, 'treatment') ?>

    <?php // echo $form->field($model, 'icd10') ?>

    <?php // echo $form->field($model, 'icd9cm') ?>

    <?php // echo $form->field($model, 'icode') ?>

    <?php // echo $form->field($model, 'opd_price1') ?>

    <?php // echo $form->field($model, 'opd_price2') ?>

    <?php // echo $form->field($model, 'opd_price3') ?>

    <?php // echo $form->field($model, 'ipd_price1') ?>

    <?php // echo $form->field($model, 'ipd_price2') ?>

    <?php // echo $form->field($model, 'ipd_price3') ?>

    <?php // echo $form->field($model, 'dttm_group_id') ?>

    <?php // echo $form->field($model, 'unit') ?>

    <?php // echo $form->field($model, 'charge_per_qty') ?>

    <?php // echo $form->field($model, 'active_status') ?>

    <?php // echo $form->field($model, 'dttm_guid') ?>

    <?php // echo $form->field($model, 'thai_name') ?>

    <?php // echo $form->field($model, 'charge_area_qty') ?>

    <?php // echo $form->field($model, 'dttm_subgroup_id') ?>

    <?php // echo $form->field($model, 'icd10tm_operation_code') ?>

    <?php // echo $form->field($model, 'dttm_dw_report_group_id') ?>

    <?php // echo $form->field($model, 'export_proced') ?>

    <?php // echo $form->field($model, 'dent2006_item_code') ?>

    <?php // echo $form->field($model, 'hos_guid') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
