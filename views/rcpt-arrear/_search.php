<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RcptArrearSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rcpt-arrear-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'arrear_id') ?>

    <?= $form->field($model, 'vn') ?>

    <?= $form->field($model, 'arrear_date') ?>

    <?= $form->field($model, 'arrear_time') ?>

    <?= $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'staff') ?>

    <?php // echo $form->field($model, 'rcpno') ?>

    <?php // echo $form->field($model, 'finance_number') ?>

    <?php // echo $form->field($model, 'paid') ?>

    <?php // echo $form->field($model, 'pt_type') ?>

    <?php // echo $form->field($model, 'hn') ?>

    <?php // echo $form->field($model, 'receive_money_date') ?>

    <?php // echo $form->field($model, 'receive_money_time') ?>

    <?php // echo $form->field($model, 'receive_money_staff') ?>

    <?php // echo $form->field($model, 'hos_guid') ?>

    <?php // echo $form->field($model, 'an') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
