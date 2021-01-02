<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\TblToken */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-token-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username_id')->textInput() ?>

    <?= $form->field($model, 'token_')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_access_group')->textInput() ?>

    <?= $form->field($model, 'group_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'group_status')->dropDownList([ 1 => '1', 0 => '0', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'department_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'active')->dropDownList([ 'Y' => 'Y', 'N' => 'N', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
