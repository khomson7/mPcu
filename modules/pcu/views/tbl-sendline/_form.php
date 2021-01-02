<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\TblSendline */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-sendline-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username_id')->textInput() ?>

    <?= $form->field($model, 'send_id')->textInput() ?>
    
    <?= $form->field($model, 'hoscode')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
