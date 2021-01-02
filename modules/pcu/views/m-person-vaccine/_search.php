<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\MPersonVaccineSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mperson-vaccine-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'person_vaccine_id') ?>

    <?= $form->field($model, 'vaccine_name') ?>

    <?= $form->field($model, 'vaccine_code') ?>

    <?= $form->field($model, 'vaccine_group') ?>

    <?= $form->field($model, 'export_vaccine_code') ?>

    <?php // echo $form->field($model, 'hos_guid') ?>

    <?php // echo $form->field($model, 'combine_vaccine') ?>

    <?php // echo $form->field($model, 'icode') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
