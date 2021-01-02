<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HosBasedataSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hos-basedata-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'base_data') ?>

    <?= $form->field($model, 'detail') ?>

    <?= $form->field($model, 'link') ?>

    <?= $form->field($model, 'active') ?>

    <?php // echo $form->field($model, 'count_report') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
