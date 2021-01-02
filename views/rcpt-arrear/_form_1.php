<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RcptArrear */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rcpt-arrear-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'arrear_id')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'vn')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'arrear_date')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'arrear_time')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'amount')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'staff')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'rcpno')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'finance_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'paid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pt_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'receive_money_date')->textInput() ?>

    <?= $form->field($model, 'receive_money_time')->textInput() ?>

    <?= $form->field($model, 'receive_money_staff')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hos_guid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'an')->textInput(['readonly' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
