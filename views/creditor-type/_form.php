<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CreditorType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="creditor-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'creditor_type_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
