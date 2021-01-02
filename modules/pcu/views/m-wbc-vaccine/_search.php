<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\MWbcVaccineSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mwbc-vaccine-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'wbc_vaccine_id') ?>

    <?= $form->field($model, 'wbc_vaccine_name') ?>

    <?= $form->field($model, 'wbc_vaccine_code') ?>

    <?= $form->field($model, 'age_min') ?>

    <?= $form->field($model, 'age_max') ?>

    <?php // echo $form->field($model, 'export_vaccine_code') ?>

    <?php // echo $form->field($model, 'check_code') ?>

    <?php // echo $form->field($model, 'vaccine_in_use') ?>

    <?php // echo $form->field($model, 'hos_guid') ?>

    <?php // echo $form->field($model, 'icode') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'combine_vaccine') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
