<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\MIcd101Search */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="micd101-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'spclty') ?>

    <?= $form->field($model, 'tname') ?>

    <?= $form->field($model, 'code3') ?>

    <?php // echo $form->field($model, 'code4') ?>

    <?php // echo $form->field($model, 'code5') ?>

    <?php // echo $form->field($model, 'sex') ?>

    <?php // echo $form->field($model, 'ipd_valid') ?>

    <?php // echo $form->field($model, 'icd10compat') ?>

    <?php // echo $form->field($model, 'icd10tmcompat') ?>

    <?php // echo $form->field($model, 'active_status') ?>

    <?php // echo $form->field($model, 'hos_guid') ?>

    <?php // echo $form->field($model, 'hos_guid_ext') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
